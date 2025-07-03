<?php
$page_title = "Hakkımda";
include 'includes/header.php';
require_once __DIR__ . '/includes/db.php';

// Sadece aktif yetenekleri çek
$skills = $db->fetchAll("SELECT * FROM skills WHERE is_active = 1 ORDER BY id DESC");
?>

<!-- Hero Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 text-center">
                <div class="bg-white p-4 rounded-3 shadow">
                    <img src="assets/img/profil.jpg" alt="Profil Resmi" class="img-fluid rounded-circle mb-3" style="width: 300px; height: 300px; object-fit: cover;">
                    <h3 class="mt-3">Bünyamin YUSUFOĞLU</h3>
                    <p class="text-muted">Full Stack Developer</p>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="bg-light p-4 rounded-3 shadow-sm">
                    <h4 class="text-primary mb-4">İstatistikler</h4>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tamamlanan Proje</span>
                            <span class="fw-bold text-primary">50+</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" style="width: 100%"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Deneyim Yılı</span>
                            <span class="fw-bold text-primary">5+</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" style="width: 100%"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Mutlu Müşteri</span>
                            <span class="fw-bold text-primary">30+</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" style="width: 100%"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Teknoloji</span>
                            <span class="fw-bold text-primary">15+</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Content Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-12">
                <h2 class="display-5 fw-bold mb-4">Ben Kimim?</h2>
                <div class="row g-4 mb-5">
                    <div class="col-md-6">
                        <p class="lead text-muted mb-4">
                            Merhaba! Ben Bünyamin YUSUFOĞLU, tutkulu bir Full Stack Developer'ım. 
                            Web teknolojileri konusunda 5+ yıllık deneyime sahibim ve sürekli kendimi geliştirmeye odaklanıyorum.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h4 class="text-primary mb-3">Deneyimim</h4>
                        <p class="text-muted">
                            Çeşitli sektörlerde web uygulamaları geliştirdim. E-ticaret platformları, 
                            kurumsal web siteleri, mobil uygulamalar ve API geliştirme konularında deneyimliyim.
                        </p>
                        <h4 class="text-primary mb-3">Yaklaşımım</h4>
                        <p class="text-muted">
                            Kullanıcı deneyimini ön planda tutarak, modern ve sürdürülebilir kod yazmaya odaklanırım. 
                            Her projede en güncel teknolojileri kullanmaya özen gösteririm.
                        </p>
                    </div>
                </div>
                <h3 class="fw-bold mb-4">Çalışma Felsefem</h3>
                <div class="row g-4 mb-5">
                    <div class="col-md-4">
                        <div class="bg-light p-4 rounded-3 h-100 text-center shadow-sm">
                            <i class="fas fa-lightbulb fa-2x text-primary mb-3"></i>
                            <h5>Yaratıcılık</h5>
                            <p class="text-muted mb-0">Her projeye özgün çözümler üretirim</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-light p-4 rounded-3 h-100 text-center shadow-sm">
                            <i class="fas fa-cogs fa-2x text-primary mb-3"></i>
                            <h5>Teknik Mükemmellik</h5>
                            <p class="text-muted mb-0">Kod kalitesi ve performans odaklı çalışırım</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-light p-4 rounded-3 h-100 text-center shadow-sm">
                            <i class="fas fa-users fa-2x text-primary mb-3"></i>
                            <h5>İşbirliği</h5>
                            <p class="text-muted mb-0">Müşteri ihtiyaçlarını anlayarak çalışırım</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Skills Overview Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Yeteneklerim</h2>
            <p class="lead text-muted">Kullandığım teknolojiler</p>
        </div>
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-white p-4 rounded-3 h-100 shadow-sm text-center">
                    <?php if (count($skills) > 0): ?>
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <?php foreach ($skills as $skill): ?>
                                <span class="badge bg-primary p-3"><?php echo htmlspecialchars($skill['title']); ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">Henüz yetenek eklenmedi.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>