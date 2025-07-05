<?php
require_once 'includes/auth_check.php';
require_once __DIR__ . '/../includes/db.php';
$page_title = "Eğitim";
include 'includes/header.php';

// --- Eğitim Silme ---
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    // Silinecek eğitimin resmini al
    $education = $db->fetch('SELECT image_path FROM education WHERE id = :id', ['id' => $_GET['delete']]);
    
    // Veritabanından sil
    $db->delete('education', 'id = :id', ['id' => $_GET['delete']]);
    
    // Resim dosyasını sil
    if ($education && $education['image_path'] && file_exists('../' . $education['image_path'])) {
        unlink('../' . $education['image_path']);
    }
    
    header('Location: education.php');
    exit();
}

// --- Eğitim Ekleme ---
$success = false;
if (isset($_POST['add_education'])) {
    $imagePath = null;
    
    // Resim yükleme işlemi
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/img/';
        $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $fileName;
        
        // Dosya türü kontrolü
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (in_array($_FILES['image']['type'], $allowedTypes)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                $imagePath = 'assets/img/' . $fileName;
            }
        }
    }
    
    $db->insert('education', [
        'school_name'  => $_POST['school_name'],
        'department'   => $_POST['department'],
        'start_year'   => $_POST['start_year'],
        'end_year'     => $_POST['end_year'],
        'description'  => $_POST['description'],
        'image_path'   => $imagePath
    ]);
    $success = true;
}

// --- Eğitim Güncelleme ---
if (isset($_POST['edit_education'])) {
    $imagePath = $edit_education['image_path'] ?? null;
    
    // Yeni resim yüklendiyse
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/img/';
        $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $fileName;
        
        // Dosya türü kontrolü
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (in_array($_FILES['image']['type'], $allowedTypes)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                // Eski resmi sil
                if ($imagePath && file_exists('../' . $imagePath)) {
                    unlink('../' . $imagePath);
                }
                $imagePath = 'assets/img/' . $fileName;
            }
        }
    }
    
    $db->update('education', [
        'school_name'  => $_POST['school_name'],
        'department'   => $_POST['department'],
        'start_year'   => $_POST['start_year'],
        'end_year'     => $_POST['end_year'],
        'description'  => $_POST['description'],
        'image_path'   => $imagePath
    ], 'id = :id', ['id' => $_POST['education_id']]);
    $success = true;
}

// --- Eğitimleri Listele ---
$educations = $db->fetchAll('SELECT * FROM education ORDER BY end_year DESC');

// --- Düzenlenecek eğitim (varsa) ---
$edit_education = null;
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $edit_education = $db->fetch('SELECT * FROM education WHERE id = :id', ['id' => $_GET['edit']]);
}
?>
<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <div class="app-wrapper">
        <?php include 'includes/sidebar.php'; ?>
        <main class="app-main">
            <div class="container mt-4">
                <?php if ($success): ?>
                    <div class="alert alert-success">İşlem başarılı!</div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-5">
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><?php echo $edit_education ? 'Eğitimi Düzenle' : 'Yeni Eğitim Ekle'; ?></h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <?php if ($edit_education): ?>
                                        <input type="hidden" name="education_id" value="<?php echo $edit_education['id']; ?>">
                                    <?php endif; ?>
                                    <div class="mb-3">
                                        <label class="form-label">Okul Adı</label>
                                        <input type="text" name="school_name" class="form-control" required value="<?php echo $edit_education['school_name'] ?? ''; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Bölüm/Dal</label>
                                        <input type="text" name="department" class="form-control" placeholder="Örn: Bilgisayar Mühendisliği, Fen Bilimleri" value="<?php echo $edit_education['department'] ?? ''; ?>">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Başlangıç Yılı</label>
                                                <input type="number" name="start_year" class="form-control" min="1900" max="2030" required value="<?php echo $edit_education['start_year'] ?? ''; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Bitiş Yılı</label>
                                                <input type="number" name="end_year" class="form-control" min="1900" max="2030" required value="<?php echo $edit_education['end_year'] ?? ''; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Açıklama</label>
                                        <textarea name="description" class="form-control" rows="3" placeholder="Eğitim hakkında açıklama..."><?php echo $edit_education['description'] ?? ''; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Okul Resmi</label>
                                        <?php if ($edit_education && $edit_education['image_path']): ?>
                                            <div class="mb-2">
                                                <img src="../<?php echo $edit_education['image_path']; ?>" alt="Mevcut Resim" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                                                <small class="d-block text-muted">Mevcut resim</small>
                                            </div>
                                        <?php endif; ?>
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                        <small class="form-text text-muted">JPG, PNG, GIF formatları desteklenir. Maksimum 5MB.</small>
                                    </div>
                                    <button type="submit" name="<?php echo $edit_education ? 'edit_education' : 'add_education'; ?>" class="btn btn-<?php echo $edit_education ? 'warning' : 'success'; ?> w-100">
                                        <?php echo $edit_education ? 'Güncelle' : 'Ekle'; ?>
                                    </button>
                                    <?php if ($edit_education): ?>
                                        <a href="education.php" class="btn btn-secondary w-100 mt-2">Vazgeç</a>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="mb-0">Eğitim Geçmişi</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Okul Adı</th>
                                                <th>Bölüm/Dal</th>
                                                <th>Yıllar</th>
                                                <th>Açıklama</th>
                                                <th>İşlem</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($educations as $education): ?>
                                                <tr>
                                                    <td><?php echo $education['id']; ?></td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <?php if ($education['image_path']): ?>
                                                                <img src="../<?php echo $education['image_path']; ?>" alt="<?php echo htmlspecialchars($education['school_name']); ?>" class="me-2" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                                            <?php endif; ?>
                                                            <?php echo htmlspecialchars($education['school_name']); ?>
                                                        </div>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($education['department'] ?? '-'); ?></td>
                                                    <td><?php echo $education['start_year'] . ' - ' . $education['end_year']; ?></td>
                                                    <td>
                                                        <?php 
                                                        $description = htmlspecialchars($education['description']);
                                                        echo strlen($description) > 50 ? substr($description, 0, 50) . '...' : $description;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="education.php?edit=<?php echo $education['id']; ?>" class="btn btn-sm btn-warning">Düzenle</a>
                                                        <a href="education.php?delete=<?php echo $education['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğinize emin misiniz?');">Sil</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>   
    </div>
</body>
</html>
