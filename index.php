<?php
require_once 'includes/db.php';

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

// Aktif projeleri çek (en son 3 tanesi)
$projects = $db->fetchAll("SELECT * FROM projects WHERE is_active = 1 ORDER BY id DESC LIMIT 3");

// Aktif yetenekleri çek
$skills = $db->fetchAll("SELECT * FROM skills WHERE is_active = 1 ORDER BY id DESC");

// Eğitim bilgilerini çek (en son 2 tanesi)
$educations = $db->fetchAll("SELECT * FROM education ORDER BY end_year DESC LIMIT 2");

// İletişim bilgilerini çek
$contact_info = $db->fetchAll("SELECT * FROM contact_info WHERE is_active = 1 ORDER BY sort_order ASC");

// Sosyal medya linklerini çek
$social_media = $db->fetchAll("SELECT * FROM social_media WHERE is_active = 1 ORDER BY sort_order ASC");

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold text-primary mb-4">
                    Merhaba, Ben <?php echo htmlspecialchars($profile['title'] ?? 'Bünyamin YUSUFOĞLU'); ?>
                </h1>
                <h2 class="h3 text-secondary mb-4"><?php echo htmlspecialchars($profile['unvan']); ?></h2>
                <p class="lead text-muted mb-4">
                    <?php echo htmlspecialchars($profile['description']); ?>
                </p>
                <div class="d-flex gap-3">
                    <a href="projects.php" class="btn btn-primary btn-md">
                        <i class="fas fa-project-diagram me-2"></i>
                        Projelerimi Gör
                    </a>
                    <a href="contact.php" class="btn btn-outline-primary btn-md">
                        <i class="fas fa-envelope me-2"></i>
                        İletişime Geç
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="bg-white p-4 rounded-3 shadow">
                    <?php if (!empty($profile['photo'])): ?>
                        <img src="<?php echo str_replace('../', '', $profile['photo']); ?>" alt="Profil Resmi" class="img-fluid rounded-circle" style="width: 200px; height: 200px; object-fit: cover;">
                    <?php else: ?>
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 200px; height: 200px;">
                            <i class="fas fa-user fa-4x text-muted"></i>
                        </div>
                    <?php endif; ?>
                    <h3 class="mt-3"><?php echo htmlspecialchars($profile['title'] ?? 'Bünyamin YUSUFOĞLU'); ?></h3>
                    <p class="text-muted"><?php echo htmlspecialchars($profile['unvan'] ?? 'Full Stack Developer'); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Projects Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Projelerim</h2>
        </div>
        
        <?php if (empty($projects)): ?>
            <div class="text-center py-5">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Henüz proje eklenmemiş.
                </div>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($projects as $project): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                    <i class="fas fa-code fa-2x"></i>
                                </div>
                                <h5 class="card-title"><?php echo htmlspecialchars($project['title']); ?></h5>
                                <p class="card-text text-muted"><?php echo htmlspecialchars($project['description']); ?></p>
                                <?php if ($project['technologies']): ?>
                                    <div class="mb-3">
                                        <?php 
                                        $techs = explode(',', $project['technologies']);
                                        foreach ($techs as $tech): 
                                        ?>
                                            <span class="badge bg-light text-dark me-1"><?php echo htmlspecialchars(trim($tech)); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($project['detail_link']): ?>
                                    <a href="<?php echo htmlspecialchars($project['detail_link']); ?>" class="btn btn-outline-primary" target="_blank">Detayları Gör</a>
                                <?php else: ?>
                                    <a href="projects.php" class="btn btn-outline-primary">Detayları Gör</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <div class="text-center mt-5">
            <a href="projects.php" class="btn btn-outline-primary btn-md">
                <i class="fas fa-project-diagram me-2"></i>
                Tüm Projeleri Gör
            </a>
        </div>
    </div>
</section>

<!-- Skills Preview Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Yeteneklerim</h2>
        </div>
        
        <?php if (empty($skills)): ?>
            <div class="text-center py-5">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Henüz yetenek eklenmemiş.
                </div>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="bg-light p-4 rounded-3 h-100 shadow-sm">
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <?php foreach ($skills as $skill): ?>
                                <span class="badge bg-primary px-3 py-4" style="font-size: 1.2rem;"><?php echo htmlspecialchars($skill['title']); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="text-center mt-5">
            <a href="skills.php" class="btn btn-outline-primary btn-md">
                <i class="fas fa-tools me-2"></i>
                Tüm Yeteneklerimi Gör
            </a>
        </div>
    </div>
</section>

<!-- Education Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Eğitim Geçmişim</h2>
        </div>
        <?php if (empty($educations)): ?>
            <div class="text-center py-5">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Henüz eğitim bilgisi eklenmemiş.
                </div>
            </div>
        <?php else: ?>
            <div class="row g-4 justify-content-center">
                <?php foreach ($educations as $education): ?>
                    <div class="col-md-12 col-lg-6">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body p-4 text-center">
                                <?php if ($education['image_path']): ?>
                                    <img src="<?php echo $education['image_path']; ?>" 
                                         alt="<?php echo htmlspecialchars($education['school_name']); ?>" 
                                         class="img-fluid mb-3" 
                                         style="max-height: 120px; object-fit: contain;">
                                <?php else: ?>
                                    <div class="bg-light rounded mb-3 d-flex align-items-center justify-content-center" 
                                         style="height: 120px;">
                                        <i class="fas fa-graduation-cap fa-3x text-muted"></i>
                                    </div>
                                <?php endif; ?>
                                
                                <h5 class="card-title mb-1"><?php echo htmlspecialchars($education['school_name']); ?></h5>
                                
                                <?php if ($education['department']): ?>
                                    <p class="text-primary mb-1"><?php echo htmlspecialchars($education['department']); ?></p>
                                <?php endif; ?>
                                
                                <p class="text-muted mb-2"><?php echo $education['start_year'] . ' - ' . $education['end_year']; ?></p>
                                
                                <?php if ($education['description']): ?>
                                    <p class="mb-0"><?php echo htmlspecialchars($education['description']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="text-center mt-5">
            <a href="education.php" class="btn btn-outline-primary btn-md">
                <i class="fas fa-graduation-cap me-2"></i>
                Tüm Eğitim Geçmişim
            </a>
        </div>
    </div>
</section>

<!-- Contact Info Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">İletişim Bilgilerim</h2>
        </div>
        <?php if (empty($contact_info)): ?>
            <div class="text-center py-5">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Henüz iletişim bilgisi eklenmemiş.
                </div>
            </div>
        <?php else: ?>
            <div class="row g-4 justify-content-center">
                <?php foreach ($contact_info as $contact): ?>
                    <div class="col-md-4">
                        <div class="bg-light p-4 rounded-3 h-100 text-center shadow-sm">
                            <i class="<?php echo htmlspecialchars($contact['icon']); ?> fa-2x text-primary mb-3"></i>
                            <h5 class="mb-2"><?php echo htmlspecialchars($contact['title']); ?></h5>
                            <?php if ($contact['type'] === 'email'): ?>
                                <p class="mb-0">
                                    <a href="mailto:<?php echo htmlspecialchars($contact['value']); ?>" class="text-decoration-none text-dark">
                                        <?php echo htmlspecialchars($contact['value']); ?>
                                    </a>
                                </p>
                            <?php elseif ($contact['type'] === 'phone'): ?>
                                <p class="mb-0">
                                    <a href="tel:<?php echo htmlspecialchars($contact['value']); ?>" class="text-decoration-none text-dark">
                                        <?php echo htmlspecialchars($contact['value']); ?>
                                    </a>
                                </p>
                            <?php else: ?>
                                <p class="mb-0"><?php echo htmlspecialchars($contact['value']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($social_media)): ?>
            <div class="text-center mt-5">
                <h4 class="mb-4">Sosyal Medya Hesaplarım</h4>
                <div class="d-flex justify-content-center gap-3">
                    <?php foreach ($social_media as $social): ?>
                        <a href="<?php echo htmlspecialchars($social['url']); ?>" 
                           class="btn btn-outline-primary btn-md" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           title="<?php echo htmlspecialchars($social['platform']); ?>">
                            <i class="<?php echo htmlspecialchars($social['icon']); ?> fa-2x"></i>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
