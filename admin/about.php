<?php
require_once 'includes/auth_check.php';
require_once __DIR__ . '/../includes/db.php';
// --- Verileri çek ---
$profile = [];
$stats = [];
$section3 = [];
$section4 = ["main_title" => "", "blocks" => []];

// Profil
$profileRows = $db->fetchAll("SELECT * FROM about_page WHERE page_name='about' AND section_name='profile' AND is_active=1");
foreach ($profileRows as $row) {
    $profile[$row['content_key']] = $row['content_value'];
}
// İstatistikler
for ($i=1; $i<=4; $i++) {
    $row = $db->fetch("SELECT * FROM about_page WHERE page_name='about' AND section_name='stats' AND content_key='stat$i' AND is_active=1");
    if ($row) {
        $stats[$i] = json_decode($row['content_value'], true);
    } else {
        $stats[$i] = ["title" => "", "value" => ""];
    }
}
// Section 3
for ($i=1; $i<=3; $i++) {
    $row = $db->fetch("SELECT * FROM about_page WHERE page_name='about' AND section_name='section3' AND content_key='block$i' AND is_active=1");
    if ($row) {
        $section3[$i] = json_decode($row['content_value'], true);
    } else {
        $section3[$i] = ["title" => "", "desc" => ""];
    }
}
// Section 4
$mainTitleRow = $db->fetch("SELECT * FROM about_page WHERE page_name='about' AND section_name='section4' AND content_key='main_title' AND is_active=1");
$section4["main_title"] = $mainTitleRow ? $mainTitleRow['content_value'] : "";
for ($i=1; $i<=3; $i++) {
    $row = $db->fetch("SELECT * FROM about_page WHERE page_name='about' AND section_name='section4' AND content_key='block$i' AND is_active=1");
    if ($row) {
        $section4["blocks"][$i] = json_decode($row['content_value'], true);
    } else {
        $section4["blocks"][$i] = ["title" => "", "desc" => ""];
    }
}

// --- Formdan gelen verileri işle ---
$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Profil Kartı
    if (isset($_POST['profile_submit'])) {
        $photoPath = $profile['photo'] ?? null;
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../assets/img/';
            $fileName = uniqid() . '_' . basename($_FILES['photo']['name']);
            $targetPath = $uploadDir . $fileName;
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetPath)) {
                $photoPath = $targetPath;
                $db->update('about_page', [
                    'content_value' => $photoPath
                ], "page_name='about' AND section_name='profile' AND content_key='photo'", []);
            }
        }
        $title = $_POST['title'] ?? '';
        $unvan = $_POST['unvan'] ?? '';
        $description = $_POST['description'] ?? '';
        $db->update('about_page', ['content_value' => $title], "page_name='about' AND section_name='profile' AND content_key='title'", []);
        $db->update('about_page', ['content_value' => $unvan], "page_name='about' AND section_name='profile' AND content_key='unvan'", []);
        $db->update('about_page', ['content_value' => $description], "page_name='about' AND section_name='profile' AND content_key='description'", []);
        $success = true;
    }
    // İstatistik Kartı
    if (isset($_POST['stats_submit'])) {
        for ($i = 1; $i <= 4; $i++) {
            $stat_title = $_POST['stat_title'.$i] ?? '';
            $stat_value = $_POST['stat_value'.$i] ?? '';
            $db->update('about_page', [
                'content_value' => json_encode(['title'=>$stat_title, 'value'=>$stat_value])
            ], "page_name='about' AND section_name='stats' AND content_key='stat$i'", []);
        }
        $success = true;
    }
    // Bölüm 3
    if (isset($_POST['section3_submit'])) {
        for ($i = 1; $i <= 3; $i++) {
            $title = $_POST['section3_title'.$i] ?? '';
            $desc  = $_POST['section3_desc'.$i] ?? '';
            $db->update('about_page', [
                'content_value' => json_encode(['title'=>$title, 'desc'=>$desc])
            ], "page_name='about' AND section_name='section3' AND content_key='block$i'", []);
        }
        $success = true;
    }
    // Bölüm 4
    if (isset($_POST['section4_submit'])) {
        $main_title = $_POST['section4_main_title'] ?? '';
        $db->update('about_page', ['content_value' => $main_title], "page_name='about' AND section_name='section4' AND content_key='main_title'", []);
        for ($i = 1; $i <= 3; $i++) {
            $title = $_POST['section4_title'.$i] ?? '';
            $desc  = $_POST['section4_desc'.$i] ?? '';
            $db->update('about_page', [
                'content_value' => json_encode(['title'=>$title, 'desc'=>$desc])
            ], "page_name='about' AND section_name='section4' AND content_key='block$i'", []);
        }
        $success = true;
    }
    // Güncellemeden sonra tekrar verileri çek
    header('Location: about.php?success=1');
    exit();
}
if (isset($_GET['success'])) $success = true;
$page_title = "Hakkımda";
include 'includes/header.php';
?>
<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <div class="app-wrapper">
        <?php include 'includes/sidebar.php'; ?>
        <main class="app-main">
        <div class="container mt-2">
        <?php if ($success): ?>
            <div class="alert alert-success">Bilgiler kaydedildi!</div>
        <?php endif; ?>
        </div>
        <div class="container mt-2 d-flex justify-content-center gap-5">
            <!-- Profil Kartı Formu -->
            <div class="card shadow-lg w-50">
                <div class="card-header bg-secondary text-white">   
                    <h5 class="mb-0">Profil Kartı</h5>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3 text-center">
                            <?php if (!empty($profile['photo'])): ?>
                                <img src="<?php echo $profile['photo']; ?>" alt="Profil Fotoğrafı" class="rounded-circle mb-2" style="width: 100px; height: 100px; object-fit: cover;">
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Bir fotoğraf seçin</label>
                            <input class="form-control" type="file" id="photo" name="photo" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Adınız Soyadınız</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($profile['title'] ?? ''); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="unvan" class="form-label">Ünvan Giriniz</label>
                            <input type="text" class="form-control" id="unvan" name="unvan" value="<?php echo htmlspecialchars($profile['unvan'] ?? ''); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Açıklama Giriniz</label>
                            <textarea class="form-control" id="description" name="description" rows="3"><?php echo htmlspecialchars($profile['description']); ?></textarea>
                        </div>
                        <button type="submit" name="profile_submit" class="btn btn-success w-100">Güncelle</button>
                    </form>
                </div>
            </div>
            <!-- İstatistik Kartı Formu -->
            <div class="card shadow-lg w-50">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">İstatistik Kartı</h5>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3 d-flex flex-column gap-2">
                            <label class="form-label">Başlık ve Değerler</label>
                            <?php for ($i=1; $i<=4; $i++): ?>
                            <div class="d-flex gap-2">
                                <input type="text" class="form-control w-75" name="stat_title<?= $i ?>" value="<?php echo htmlspecialchars($stats[$i]['title'] ?? ''); ?>" placeholder="İstatistik Başlığı">
                                <input type="text" class="form-control w-25" name="stat_value<?= $i ?>" value="<?php echo htmlspecialchars($stats[$i]['value'] ?? ''); ?>" placeholder="İstatistik Değeri">
                            </div>
                            <?php endfor; ?>
                        </div>
                        <button type="submit" name="stats_submit" class="btn btn-success w-100">Güncelle</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Bölüm 3 Formu -->
        <div class="container mt-2 d-flex justify-content-center gap-5 w-100">
            <div class="card shadow-lg w-100">
                <div class="card-header bg-secondary text-white w-100">
                    <h5 class="mb-0">Bölüm 3</h5>
                </div>
                <div class="card-body w-100">
                    <form action="" method="POST">
                        <div class="mb-3 d-flex gap-2 w-100">
                            <?php for ($i=1; $i<=3; $i++): ?>
                            <div class="w-100">
                                <label class="form-label">Başlık</label>                                
                                <input type="text" class="form-control" name="section3_title<?= $i ?>" value="<?php echo htmlspecialchars($section3[$i]['title'] ?? ''); ?>" placeholder="Başlık">
                                <label class="form-label mt-2">Açıklama</label>                                
                                <textarea class="form-control" name="section3_desc<?= $i ?>" placeholder="Açıklama" rows="7"><?php echo htmlspecialchars($section3[$i]['desc'] ?? ''); ?></textarea>
                            </div>
                            <?php endfor; ?>
                        </div>
                        <button type="submit" name="section3_submit" class="btn btn-success w-100">Güncelle</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Bölüm 4 Formu -->
        <div class="container mt-2 d-flex justify-content-center gap-5 w-100">
            <div class="card shadow-lg w-100">
                <div class="card-header bg-secondary text-white w-100">
                    <h5 class="mb-0">Bölüm 4</h5>
                </div>
                <div class="card-body w-100">
                    <form action="" method="POST">
                        <label class="form-label">Başlık</label>
                        <input type="text" class="form-control" name="section4_main_title" value="<?php echo htmlspecialchars($section4['main_title']); ?>" placeholder="Çalışma Felsefem">
                        <div class="mb-3 mt-2 d-flex gap-2 w-100">
                            <?php for ($i=1; $i<=3; $i++): ?>
                            <div class="w-100">
                                <label class="form-label">Başlık</label>                                
                                <input type="text" class="form-control" name="section4_title<?= $i ?>" value="<?php echo htmlspecialchars($section4['blocks'][$i]['title'] ?? ''); ?>" placeholder="Başlık">
                                <label class="form-label mt-2">Açıklama</label>                                
                                <textarea class="form-control" name="section4_desc<?= $i ?>" placeholder="Açıklama" rows="3"><?php echo htmlspecialchars($section4['blocks'][$i]['desc'] ?? ''); ?></textarea>
                            </div>
                            <?php endfor; ?>
                        </div>
                        <button type="submit" name="section4_submit" class="btn btn-success w-100">Güncelle</button>
                    </form>
                </div>
            </div>
        </div>
        </main>   
    </div>
</body>
</html>