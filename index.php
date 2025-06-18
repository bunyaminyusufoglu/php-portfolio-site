<?php
$page_title = "Ana Sayfa";
include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold text-primary mb-4">
                    Merhaba, Ben Bünyamin YUSUFOĞLU
                </h1>
                <h2 class="h3 text-secondary mb-4">Full Stack Developer</h2>
                <p class="lead text-muted mb-4">
                    Modern web teknolojileri ile kullanıcı dostu ve yenilikçi çözümler geliştiren tutkulu bir yazılım geliştiricisiyim.
                </p>
                <div class="d-flex gap-3">
                    <a href="projects.php" class="btn btn-primary btn-lg">
                        <i class="fas fa-project-diagram me-2"></i>
                        Projelerimi Gör
                    </a>
                    <a href="contact.php" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-envelope me-2"></i>
                        İletişime Geç
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="bg-white p-4 rounded-3 shadow">
                    <i class="fas fa-user-circle text-primary" style="font-size: 8rem;"></i>
                    <h3 class="mt-3">Bünyamin YUSUFOĞLU</h3>
                    <p class="text-muted">Full Stack Developer</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Preview Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="display-5 fw-bold mb-4">Hakkımda</h2>
                <p class="lead text-muted mb-5">
                    5+ yıllık deneyimimle web geliştirme alanında çeşitli projelerde çalıştım. 
                    Modern teknolojileri kullanarak kullanıcı deneyimini ön planda tutan çözümler üretiyorum.
                </p>
                
                <!-- Stats -->
                <div class="row g-4 mb-5">
                    <div class="col-md-4">
                        <div class="bg-light p-4 rounded-3">
                            <h3 class="text-primary fw-bold">50+</h3>
                            <p class="text-muted mb-0">Tamamlanan Proje</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-light p-4 rounded-3">
                            <h3 class="text-primary fw-bold">5+</h3>
                            <p class="text-muted mb-0">Yıl Deneyim</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-light p-4 rounded-3">
                            <h3 class="text-primary fw-bold">30+</h3>
                            <p class="text-muted mb-0">Mutlu Müşteri</p>
                        </div>
                    </div>
                </div>
                
                <a href="about.php" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-user me-2"></i>
                    Daha Fazla Bilgi
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Featured Projects Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Öne Çıkan Projeler</h2>
            <p class="lead text-muted">En son çalışmalarım</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-code fa-2x"></i>
                        </div>
                        <h5 class="card-title">E-Ticaret Platformu</h5>
                        <p class="card-text text-muted">Modern ve kullanıcı dostu e-ticaret çözümü</p>
                        <div class="mb-3">
                            <span class="badge bg-light text-dark me-1">React</span>
                            <span class="badge bg-light text-dark me-1">Node.js</span>
                            <span class="badge bg-light text-dark">MongoDB</span>
                        </div>
                        <a href="projects.php" class="btn btn-outline-primary">Detayları Gör</a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-mobile-alt fa-2x"></i>
                        </div>
                        <h5 class="card-title">Mobil Uygulama</h5>
                        <p class="card-text text-muted">Cross-platform mobil uygulama geliştirme</p>
                        <div class="mb-3">
                            <span class="badge bg-light text-dark me-1">React Native</span>
                            <span class="badge bg-light text-dark me-1">Firebase</span>
                            <span class="badge bg-light text-dark">Redux</span>
                        </div>
                        <a href="projects.php" class="btn btn-outline-primary">Detayları Gör</a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-chart-line fa-2x"></i>
                        </div>
                        <h5 class="card-title">Dashboard Projesi</h5>
                        <p class="card-text text-muted">Veri analizi ve raporlama dashboard'u</p>
                        <div class="mb-3">
                            <span class="badge bg-light text-dark me-1">Vue.js</span>
                            <span class="badge bg-light text-dark me-1">Laravel</span>
                            <span class="badge bg-light text-dark">MySQL</span>
                        </div>
                        <a href="projects.php" class="btn btn-outline-primary">Detayları Gör</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5">
            <a href="projects.php" class="btn btn-primary btn-lg">
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
            <p class="lead text-muted">Kullandığım teknolojiler</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="bg-light p-4 rounded-3 h-100">
                    <h4 class="text-center mb-4">Frontend</h4>
                    <div class="d-flex flex-wrap justify-content-center gap-2">
                        <span class="badge bg-primary">HTML5</span>
                        <span class="badge bg-primary">CSS3</span>
                        <span class="badge bg-primary">JavaScript</span>
                        <span class="badge bg-primary">React</span>
                        <span class="badge bg-primary">Vue.js</span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="bg-light p-4 rounded-3 h-100">
                    <h4 class="text-center mb-4">Backend</h4>
                    <div class="d-flex flex-wrap justify-content-center gap-2">
                        <span class="badge bg-primary">PHP</span>
                        <span class="badge bg-primary">Node.js</span>
                        <span class="badge bg-primary">Python</span>
                        <span class="badge bg-primary">Laravel</span>
                        <span class="badge bg-primary">Express.js</span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="bg-light p-4 rounded-3 h-100">
                    <h4 class="text-center mb-4">Veritabanı</h4>
                    <div class="d-flex flex-wrap justify-content-center gap-2">
                        <span class="badge bg-primary">MySQL</span>
                        <span class="badge bg-primary">MongoDB</span>
                        <span class="badge bg-primary">PostgreSQL</span>
                        <span class="badge bg-primary">Redis</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5">
            <a href="skills.php" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-tools me-2"></i>
                Tüm Yeteneklerimi Gör
            </a>
        </div>
    </div>
</section>

<!-- Contact CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="display-5 fw-bold mb-4">Projeniz İçin Hazırım</h2>
        <p class="lead mb-4">Yaratıcı ve yenilikçi çözümler için benimle iletişime geçin</p>
        <a href="contact.php" class="btn btn-light btn-lg">
            <i class="fas fa-envelope me-2"></i>
            İletişime Geç
        </a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
