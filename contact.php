<?php
require_once 'includes/db.php';
$page_title = "İletişim";

// İletişim bilgilerini veritabanından çek
$contact_info = $db->fetchAll('SELECT * FROM contact_info WHERE is_active = 1 ORDER BY sort_order ASC');

// Sosyal medya linklerini veritabanından çek
$social_media = $db->fetchAll('SELECT * FROM social_media WHERE is_active = 1 ORDER BY sort_order ASC');

include 'includes/header.php';
?>

<section class="py-5 bg-light">
    <div class="container">
        
        <div class="row g-5">
            <!-- İletişim Bilgileri -->
            <div class="col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="card-title mb-4">İletişim Bilgileri</h4>
                        
                        <?php if (empty($contact_info)): ?>
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                İletişim bilgileri henüz eklenmemiş.
                            </div>
                        <?php else: ?>
                            <?php foreach ($contact_info as $info): ?>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                        <i class="<?php echo htmlspecialchars($info['icon']); ?>"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1"><?php echo htmlspecialchars($info['title']); ?></h6>
                                        <?php if ($info['type'] === 'email'): ?>
                                            <a href="mailto:<?php echo htmlspecialchars($info['value']); ?>" class="text-muted mb-0 text-decoration-none">
                                                <?php echo htmlspecialchars($info['value']); ?>
                                            </a>
                                        <?php elseif ($info['type'] === 'phone'): ?>
                                            <a href="tel:<?php echo htmlspecialchars($info['value']); ?>" class="text-muted mb-0 text-decoration-none">
                                                <?php echo htmlspecialchars($info['value']); ?>
                                            </a>
                                        <?php else: ?>
                                            <p class="text-muted mb-0"><?php echo htmlspecialchars($info['value']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- İletişim Formu -->
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="card-title mb-4">Mesaj Gönderin</h4>
                        
                        <form method="POST" action="">
                            <?php
                            // Form gönderildi mi kontrol et
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                $first_name = $_POST['first_name'] ?? '';
                                $last_name = $_POST['last_name'] ?? '';
                                $email = $_POST['email'] ?? '';
                                $phone = $_POST['phone'] ?? '';
                                $subject = $_POST['subject'] ?? '';
                                $message = $_POST['message'] ?? '';
                                
                                // Basit doğrulama
                                if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($subject) && !empty($message)) {
                                    // Mesajı veritabanına kaydet
                                    $db->insert('contact_messages', [
                                        'first_name' => $first_name,
                                        'last_name' => $last_name,
                                        'email' => $email,
                                        'phone' => $phone,
                                        'subject' => $subject,
                                        'message' => $message,
                                        'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null
                                    ]);
                                    
                                    echo '<div class="alert alert-success mb-4">
                                            <i class="fas fa-check-circle me-2"></i>
                                            Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağız.
                                          </div>';
                                } else {
                                    echo '<div class="alert alert-danger mb-4">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            Lütfen tüm zorunlu alanları doldurun.
                                          </div>';
                                }
                            }
                            ?>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="firstName" class="form-label">Ad *</label>
                                    <input type="text" class="form-control" id="firstName" name="first_name" required value="<?php echo htmlspecialchars($_POST['first_name'] ?? ''); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName" class="form-label">Soyad *</label>
                                    <input type="text" class="form-control" id="lastName" name="last_name" required value="<?php echo htmlspecialchars($_POST['last_name'] ?? ''); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">E-posta *</label>
                                    <input type="email" class="form-control" id="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Telefon</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
                                </div>
                                <div class="col-12">
                                    <label for="subject" class="form-label">Konu *</label>
                                    <select class="form-select" id="subject" name="subject" required>
                                        <option value="">Konu seçiniz</option>
                                        <option value="proje" <?php echo ($_POST['subject'] ?? '') === 'proje' ? 'selected' : ''; ?>>Proje Teklifi</option>
                                        <option value="isbirligi" <?php echo ($_POST['subject'] ?? '') === 'isbirligi' ? 'selected' : ''; ?>>İş Birliği</option>
                                        <option value="sorular" <?php echo ($_POST['subject'] ?? '') === 'sorular' ? 'selected' : ''; ?>>Genel Sorular</option>
                                        <option value="diger" <?php echo ($_POST['subject'] ?? '') === 'diger' ? 'selected' : ''; ?>>Diğer</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Mesajınız *</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="Mesajınızı buraya yazın..." required><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="privacy" required>
                                        <label class="form-check-label" for="privacy">
                                            <a href="#" class="text-decoration-none">Gizlilik Politikası</a>'nı okudum ve kabul ediyorum *
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-outline-primary btn-md">
                                        <i class="fas fa-paper-plane me-2"></i>
                                        Mesaj Gönder
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sosyal Medya -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body text-center p-4">
                        <h4 class="card-title mb-4">Sosyal Medyada Takip Edin</h4>
                        <?php if (empty($social_media)): ?>
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Sosyal medya linkleri henüz eklenmemiş.
                            </div>
                        <?php else: ?>
                            <div class="d-flex justify-content-center gap-3">
                                <?php foreach ($social_media as $social): ?>
                                    <a href="<?php echo htmlspecialchars($social['url']); ?>" 
                                       class="btn btn-outline-primary btn-lg" 
                                       target="_blank" 
                                       rel="noopener noreferrer"
                                       title="<?php echo htmlspecialchars($social['platform']); ?>">
                                        <i class="<?php echo htmlspecialchars($social['icon']); ?> fa-2x"></i>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>