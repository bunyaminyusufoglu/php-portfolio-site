<?php
require_once 'includes/auth_check.php';
require_once '../includes/db.php';
$page_title = "Ayarlar";
include 'includes/header.php';

// Mevcut kullanıcı bilgilerini al
$admin_id = $_SESSION['admin_id'];
$user = $db->fetch("SELECT * FROM admin WHERE id = ?", [$admin_id]);

$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = trim($_POST['username'] ?? '');
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $new_password2 = $_POST['new_password2'] ?? '';

    // Kullanıcı adı güncelleme
    if ($new_username === '') {
        $message = 'Kullanıcı adı boş olamaz!';
        $message_type = 'danger';
    } else {
        // Şifre değiştirilmek isteniyorsa
        if ($current_password || $new_password || $new_password2) {
            // Eski şifre doğru mu?
            if ($current_password !== $user['password']) {
                $message = 'Mevcut şifreniz yanlış!';
                $message_type = 'danger';
            } elseif ($new_password === '' || $new_password2 === '') {
                $message = 'Yeni şifre alanları boş olamaz!';
                $message_type = 'danger';
            } elseif ($new_password !== $new_password2) {
                $message = 'Yeni şifreler eşleşmiyor!';
                $message_type = 'danger';
            } else {
                // Kullanıcı adı ve şifreyi güncelle
                $db->update('admin', ['username' => $new_username, 'password' => $new_password], 'id = ?', [$admin_id]);
                $_SESSION['admin_username'] = $new_username;
                $message = 'Kullanıcı adı ve şifre başarıyla güncellendi!';
                $message_type = 'success';
                // Son güncel bilgileri tekrar al
                $user = $db->fetch("SELECT * FROM admin WHERE id = ?", [$admin_id]);
            }
        } else {
            // Sadece kullanıcı adı güncelleniyor
            $db->update('admin', ['username' => $new_username], 'id = ?', [$admin_id]);
            $_SESSION['admin_username'] = $new_username;
            $message = 'Kullanıcı adı başarıyla güncellendi!';
            $message_type = 'success';
            $user = $db->fetch("SELECT * FROM admin WHERE id = ?", [$admin_id]);
        }
    }
}
?>
<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <div class="app-wrapper">
        <?php include 'includes/sidebar.php'; ?>
        <main class="app-main">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Admin Bilgileri</h5>
                            </div>
                            <div class="card-body">
                                <?php if (
                                isset(
                                    $message
                                ) && $message
                                ): ?>
                                    <div class="alert alert-<?php echo $message_type; ?>"> <?php echo htmlspecialchars($message); ?> </div>
                                <?php endif; ?>
                                <form method="POST">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Kullanıcı Adı</label>
                                        <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Mevcut Şifre</label>
                                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Şifrenizi girin">
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">Yeni Şifre</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Yeni şifre">
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password2" class="form-label">Yeni Şifre (Tekrar)</label>
                                        <input type="password" class="form-control" id="new_password2" name="new_password2" placeholder="Yeni şifre tekrar">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Kaydet</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Web Sitesi SEO Ayarları</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                // SEO ayarlarını veritabanından çek
                                $seo = $db->fetch("SELECT * FROM seo_settings WHERE id = 1");
                                $seo_message = '';
                                $seo_message_type = '';
                                if (isset($_POST['seo_submit'])) {
                                    $site_title = trim($_POST['site_title'] ?? '');
                                    $site_description = trim($_POST['site_description'] ?? '');
                                    $site_keywords = trim($_POST['site_keywords'] ?? '');
                                    if ($site_title === '' || $site_description === '' || $site_keywords === '') {
                                        $seo_message = 'Tüm SEO alanlarını doldurun!';
                                        $seo_message_type = 'danger';
                                    } else {
                                        if ($seo) {
                                            $db->update('seo_settings', [
                                                'site_title' => $site_title,
                                                'site_description' => $site_description,
                                                'site_keywords' => $site_keywords
                                            ], 'id = 1');
                                            $seo_message = 'SEO ayarları başarıyla güncellendi!';
                                            $seo_message_type = 'success';
                                            $seo = $db->fetch("SELECT * FROM seo_settings WHERE id = 1");
                                        } else {
                                            $db->insert('seo_settings', [
                                                'id' => 1,
                                                'site_title' => $site_title,
                                                'site_description' => $site_description,
                                                'site_keywords' => $site_keywords
                                            ]);
                                            $seo_message = 'SEO ayarları başarıyla kaydedildi!';
                                            $seo_message_type = 'success';
                                            $seo = $db->fetch("SELECT * FROM seo_settings WHERE id = 1");
                                        }
                                    }
                                }
                                ?>
                                <?php if ($seo_message): ?>
                                    <div class="alert alert-<?php echo $seo_message_type; ?>"> <?php echo htmlspecialchars($seo_message); ?> </div>
                                <?php endif; ?>
                                <form method="POST">
                                    <div class="mb-3">
                                        <label for="site_title" class="form-label">Site Başlığı</label>
                                        <input type="text" class="form-control" id="site_title" name="site_title" value="<?php echo htmlspecialchars($seo['site_title'] ?? ''); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="site_description" class="form-label">Site Açıklaması</label>
                                        <textarea class="form-control" id="site_description" name="site_description" rows="3" required><?php echo htmlspecialchars($seo['site_description'] ?? ''); ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="site_keywords" class="form-label">Anahtar Kelimeler (virgülle ayırın)</label>
                                        <textarea type="text" class="form-control" id="site_keywords" name="site_keywords" required rows="3"><?php echo htmlspecialchars($seo['site_keywords'] ?? ''); ?></textarea>
                                    </div>
                                    <button type="submit" name="seo_submit" class="btn btn-success">SEO Ayarlarını Kaydet</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
