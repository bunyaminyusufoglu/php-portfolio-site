<?php
require_once 'includes/db.php';
$page_title = "Hakkımda";

// About sayfasından profil bilgilerini çek
$profile = [];
$about_data = $db->fetchAll("SELECT * FROM about_page WHERE page_name='about' AND section_name='profile'");
foreach ($about_data as $item) {
    $profile[$item['content_key']] = $item['content_value'];
}

// İstatistik verilerini çek
$stats = [];
$stats_data = $db->fetchAll("SELECT * FROM about_page WHERE page_name='about' AND section_name='stats'");
foreach ($stats_data as $item) {
    $data = json_decode($item['content_value'], true);
    $stats[$item['content_key']] = $data;
}

// Bölüm 3 verilerini çek
$section3 = [];
$section3_data = $db->fetchAll("SELECT * FROM about_page WHERE page_name='about' AND section_name='section3'");
foreach ($section3_data as $item) {
    $data = json_decode($item['content_value'], true);
    $section3[$item['content_key']] = $data;
}

// Bölüm 4 verilerini çek
$section4 = [];
$section4_data = $db->fetchAll("SELECT * FROM about_page WHERE page_name='about' AND section_name='section4'");
foreach ($section4_data as $item) {
    if ($item['content_key'] === 'main_title') {
        $section4['main_title'] = $item['content_value'];
    } else {
        $data = json_decode($item['content_value'], true);
        $section4['blocks'][$item['content_key']] = $data;
    }
}

// Sadece aktif yetenekleri çek
$skills = $db->fetchAll("SELECT * FROM skills WHERE is_active = 1 ORDER BY id DESC");

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 text-center">
                <div class="profile-card p-4 rounded-3 shadow">
                    <?php if (!empty($profile['photo'])): ?>
                        <img src="<?php echo str_replace('../', '', $profile['photo']); ?>" alt="Profil Resmi" class="img-fluid rounded-circle mb-3" style="width: 300px; height: 300px; object-fit: cover;">
                    <?php else: ?>
                        <div class="profile-placeholder rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 300px; height: 300px;">
                            <i class="fas fa-user fa-6x"></i>
                        </div>
                    <?php endif; ?>
                    <h3 class="mt-3"><?php echo htmlspecialchars($profile['title'] ?? 'Bünyamin YUSUFOĞLU'); ?></h3>
                    <p class="profile-subtitle"><?php echo htmlspecialchars($profile['description'] ?? 'Full Stack Developer'); ?></p>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="bg-light p-4 rounded-3 shadow-sm">
                    <h4 class="text-primary mb-4">İstatistikler</h4>
                    <?php if (empty($stats)): ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Henüz istatistik bilgisi eklenmemiş.
                        </div>
                    <?php else: ?>
                        <?php for ($i = 1; $i <= 4; $i++): ?>
                            <?php if (isset($stats["stat$i"])): ?>
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span><?php echo htmlspecialchars($stats["stat$i"]['title'] ?? 'İstatistik'); ?></span>
                                        <span class="fw-bold text-primary"><?php echo htmlspecialchars($stats["stat$i"]['value'] ?? '0'); ?></span>
                                    </div>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-primary" style="width: 100%"></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    <?php endif; ?>
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
                <?php if (empty($section3)): ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Henüz hakkımda bilgisi eklenmemiş.
                    </div>
                <?php else: ?>
                    <div class="row g-4 mb-5">
                        <?php for ($i = 1; $i <= 3; $i++): ?>
                            <?php if (isset($section3["block$i"])): ?>
                                <div class="col-md-6">
                                    <h4 class="text-primary mb-3"><?php echo htmlspecialchars($section3["block$i"]['title'] ?? 'Başlık'); ?></h4>
                                    <p class="text-muted">
                                        <?php echo htmlspecialchars($section3["block$i"]['desc'] ?? 'Açıklama'); ?>
                                    </p>
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
                <h3 class="fw-bold mb-4"><?php echo htmlspecialchars($section4['main_title'] ?? 'Çalışma Felsefem'); ?></h3>
                <?php if (empty($section4['blocks'])): ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Henüz çalışma felsefesi bilgisi eklenmemiş.
                    </div>
                <?php else: ?>
                    <div class="row g-4 mb-5">
                        <?php for ($i = 1; $i <= 3; $i++): ?>
                            <?php if (isset($section4['blocks']["block$i"])): ?>
                                <div class="col-md-4">
                                    <div class="bg-light p-4 rounded-3 h-100 text-center shadow-sm">
                                        <i class="fas fa-lightbulb fa-2x text-primary mb-3"></i>
                                        <h5><?php echo htmlspecialchars($section4['blocks']["block$i"]['title'] ?? 'Başlık'); ?></h5>
                                        <p class="text-muted mb-0"><?php echo htmlspecialchars($section4['blocks']["block$i"]['desc'] ?? 'Açıklama'); ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
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
                <div class="profile-card p-4 rounded-3 h-100 shadow-sm text-center">
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