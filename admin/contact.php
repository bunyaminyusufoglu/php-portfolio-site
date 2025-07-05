<?php
require_once 'includes/auth_check.php';
require_once __DIR__ . '/../includes/db.php';
$page_title = "İletişim Yönetimi";
include 'includes/header.php';

// --- İletişim Bilgisi Silme ---
if (isset($_GET['delete_contact']) && is_numeric($_GET['delete_contact'])) {
    $db->delete('contact_info', 'id = :id', ['id' => $_GET['delete_contact']]);
    header('Location: contact.php');
    exit();
}

// --- Sosyal Medya Silme ---
if (isset($_GET['delete_social']) && is_numeric($_GET['delete_social'])) {
    $db->delete('social_media', 'id = :id', ['id' => $_GET['delete_social']]);
    header('Location: contact.php');
    exit();
}

// --- İletişim Bilgisi Ekleme ---
$success = false;
if (isset($_POST['add_contact'])) {
    $db->insert('contact_info', [
        'type'        => $_POST['type'],
        'title'       => $_POST['title'],
        'value'       => $_POST['value'],
        'icon'        => $_POST['icon'],
        'is_active'   => isset($_POST['is_active']) ? 1 : 0,
        'sort_order'  => $_POST['sort_order']
    ]);
    $success = true;
}

// --- Sosyal Medya Ekleme ---
if (isset($_POST['add_social'])) {
    $db->insert('social_media', [
        'platform'    => $_POST['platform'],
        'url'         => $_POST['url'],
        'icon'        => $_POST['icon'],
        'is_active'   => isset($_POST['is_active']) ? 1 : 0,
        'sort_order'  => $_POST['sort_order']
    ]);
    $success = true;
}

// --- İletişim Bilgisi Güncelleme ---
if (isset($_POST['edit_contact'])) {
    $db->update('contact_info', [
        'type'        => $_POST['type'],
        'title'       => $_POST['title'],
        'value'       => $_POST['value'],
        'icon'        => $_POST['icon'],
        'is_active'   => isset($_POST['is_active']) ? 1 : 0,
        'sort_order'  => $_POST['sort_order']
    ], 'id = :id', ['id' => $_POST['contact_id']]);
    $success = true;
}

// --- Sosyal Medya Güncelleme ---
if (isset($_POST['edit_social'])) {
    $db->update('social_media', [
        'platform'    => $_POST['platform'],
        'url'         => $_POST['url'],
        'icon'        => $_POST['icon'],
        'is_active'   => isset($_POST['is_active']) ? 1 : 0,
        'sort_order'  => $_POST['sort_order']
    ], 'id = :id', ['id' => $_POST['social_id']]);
    $success = true;
}

// --- Verileri Listele ---
$contact_info = $db->fetchAll('SELECT * FROM contact_info ORDER BY sort_order ASC');
$social_media = $db->fetchAll('SELECT * FROM social_media ORDER BY sort_order ASC');

// --- Düzenlenecek veriler (varsa) ---
$edit_contact = null;
$edit_social = null;

if (isset($_GET['edit_contact']) && is_numeric($_GET['edit_contact'])) {
    $edit_contact = $db->fetch('SELECT * FROM contact_info WHERE id = :id', ['id' => $_GET['edit_contact']]);
}

if (isset($_GET['edit_social']) && is_numeric($_GET['edit_social'])) {
    $edit_social = $db->fetch('SELECT * FROM social_media WHERE id = :id', ['id' => $_GET['edit_social']]);
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
                    <!-- İletişim Bilgileri Yönetimi -->
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><?php echo $edit_contact ? 'İletişim Bilgisini Düzenle' : 'Yeni İletişim Bilgisi Ekle'; ?></h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="">
                                    <?php if ($edit_contact): ?>
                                        <input type="hidden" name="contact_id" value="<?php echo $edit_contact['id']; ?>">
                                    <?php endif; ?>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Tür</label>
                                        <select name="type" class="form-select" required>
                                            <option value="">Tür seçiniz</option>
                                            <option value="email" <?php echo ($edit_contact['type'] ?? '') === 'email' ? 'selected' : ''; ?>>E-posta</option>
                                            <option value="phone" <?php echo ($edit_contact['type'] ?? '') === 'phone' ? 'selected' : ''; ?>>Telefon</option>
                                            <option value="address" <?php echo ($edit_contact['type'] ?? '') === 'address' ? 'selected' : ''; ?>>Adres</option>
                                            <option value="working_hours" <?php echo ($edit_contact['type'] ?? '') === 'working_hours' ? 'selected' : ''; ?>>Çalışma Saatleri</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Başlık</label>
                                        <input type="text" name="title" class="form-control" required value="<?php echo $edit_contact['title'] ?? ''; ?>">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Değer</label>
                                        <input type="text" name="value" class="form-control" required value="<?php echo $edit_contact['value'] ?? ''; ?>">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">İkon (FontAwesome)</label>
                                        <input type="text" name="icon" class="form-control" placeholder="fas fa-envelope" value="<?php echo $edit_contact['icon'] ?? ''; ?>">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Sıralama</label>
                                        <input type="number" name="sort_order" class="form-control" value="<?php echo $edit_contact['sort_order'] ?? 0; ?>">
                                    </div>
                                    
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="is_active" id="contact_active" <?php if (($edit_contact['is_active'] ?? 1) == 1) echo 'checked'; ?>>
                                        <label class="form-check-label" for="contact_active">Aktif</label>
                                    </div>
                                    
                                    <button type="submit" name="<?php echo $edit_contact ? 'edit_contact' : 'add_contact'; ?>" class="btn btn-<?php echo $edit_contact ? 'warning' : 'success'; ?> w-100">
                                        <?php echo $edit_contact ? 'Güncelle' : 'Ekle'; ?>
                                    </button>
                                    <?php if ($edit_contact): ?>
                                        <a href="contact.php" class="btn btn-secondary w-100 mt-2">Vazgeç</a>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sosyal Medya Yönetimi -->
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="mb-0"><?php echo $edit_social ? 'Sosyal Medyayı Düzenle' : 'Yeni Sosyal Medya Ekle'; ?></h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="">
                                    <?php if ($edit_social): ?>
                                        <input type="hidden" name="social_id" value="<?php echo $edit_social['id']; ?>">
                                    <?php endif; ?>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Platform</label>
                                        <input type="text" name="platform" class="form-control" required value="<?php echo $edit_social['platform'] ?? ''; ?>">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">URL</label>
                                        <input type="url" name="url" class="form-control" required value="<?php echo $edit_social['url'] ?? ''; ?>">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">İkon (FontAwesome)</label>
                                        <input type="text" name="icon" class="form-control" placeholder="fab fa-linkedin" value="<?php echo $edit_social['icon'] ?? ''; ?>">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Sıralama</label>
                                        <input type="number" name="sort_order" class="form-control" value="<?php echo $edit_social['sort_order'] ?? 0; ?>">
                                    </div>
                                    
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="is_active" id="social_active" <?php if (($edit_social['is_active'] ?? 1) == 1) echo 'checked'; ?>>
                                        <label class="form-check-label" for="social_active">Aktif</label>
                                    </div>
                                    
                                    <button type="submit" name="<?php echo $edit_social ? 'edit_social' : 'add_social'; ?>" class="btn btn-<?php echo $edit_social ? 'warning' : 'success'; ?> w-100">
                                        <?php echo $edit_social ? 'Güncelle' : 'Ekle'; ?>
                                    </button>
                                    <?php if ($edit_social): ?>
                                        <a href="contact.php" class="btn btn-secondary w-100 mt-2">Vazgeç</a>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- İletişim Bilgileri Listesi -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">İletişim Bilgileri</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tür</th>
                                                <th>Başlık</th>
                                                <th>Değer</th>
                                                <th>Durum</th>
                                                <th>İşlem</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($contact_info as $contact): ?>
                                                <tr>
                                                    <td><?php echo $contact['id']; ?></td>
                                                    <td><?php echo htmlspecialchars($contact['type']); ?></td>
                                                    <td><?php echo htmlspecialchars($contact['title']); ?></td>
                                                    <td><?php echo htmlspecialchars($contact['value']); ?></td>
                                                    <td><?php echo $contact['is_active'] ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Pasif</span>'; ?></td>
                                                    <td>
                                                        <a href="contact.php?edit_contact=<?php echo $contact['id']; ?>" class="btn btn-sm btn-warning">Düzenle</a>
                                                        <a href="contact.php?delete_contact=<?php echo $contact['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğinize emin misiniz?');">Sil</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sosyal Medya Listesi -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="mb-0">Sosyal Medya</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Platform</th>
                                                <th>URL</th>
                                                <th>Durum</th>
                                                <th>İşlem</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($social_media as $social): ?>
                                                <tr>
                                                    <td><?php echo $social['id']; ?></td>
                                                    <td><?php echo htmlspecialchars($social['platform']); ?></td>
                                                    <td>
                                                        <a href="<?php echo htmlspecialchars($social['url']); ?>" target="_blank" class="text-decoration-none">
                                                            <?php echo htmlspecialchars(substr($social['url'], 0, 30)) . '...'; ?>
                                                        </a>
                                                    </td>
                                                    <td><?php echo $social['is_active'] ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Pasif</span>'; ?></td>
                                                    <td>
                                                        <a href="contact.php?edit_social=<?php echo $social['id']; ?>" class="btn btn-sm btn-warning">Düzenle</a>
                                                        <a href="contact.php?delete_social=<?php echo $social['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğinize emin misiniz?');">Sil</a>
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
