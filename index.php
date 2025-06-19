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
                    <img src="assets/img/profil.jpg" alt="Profil Resmi">
                    <h3 class="mt-3">Bünyamin YUSUFOĞLU</h3>
                    <p class="text-muted">Full Stack Developer</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Projects Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Projeler</h2>
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
                <div class="bg-light p-4 rounded-3 h-100 shadow-sm">
                    <h4 class="text-center mb-4">Frontend</h4>
                    <div class="d-flex flex-wrap justify-content-center gap-2">
                        <span class="badge bg-primary p-3">HTML5</span>
                        <span class="badge bg-primary p-3">CSS3</span>
                        <span class="badge bg-primary p-3">JavaScript</span>
                        <span class="badge bg-primary p-3">React</span>
                        <span class="badge bg-primary p-3">Angular</span>
                        <span class="badge bg-primary p-3">Vue.js</span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="bg-light p-4 rounded-3 h-100">
                    <h4 class="text-center mb-4">Backend</h4>
                    <div class="d-flex flex-wrap justify-content-center gap-2">
                        <span class="badge bg-primary p-3">PHP</span>
                        <span class="badge bg-primary p-3">Node.js</span>
                        <span class="badge bg-primary p-3">Python</span>
                        <span class="badge bg-primary p-3">Laravel</span>
                        <span class="badge bg-primary p-3">Express.js</span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="bg-light p-4 rounded-3 h-100">
                    <h4 class="text-center mb-4">Veritabanı</h4>
                    <div class="d-flex flex-wrap justify-content-center gap-2">
                        <span class="badge bg-primary p-3">MySQL</span>
                        <span class="badge bg-primary p-3">MongoDB</span>
                        <span class="badge bg-primary p-3">PostgreSQL</span>
                        <span class="badge bg-primary p-3">Redis</span>
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

<!-- Education Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Eğitim</h2>
            <p class="lead text-muted">Aldığım eğitimler ve sertifikalar</p>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-12 col-lg-6">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title mb-1">İstanbul Teknik Üniversitesi</h5>
                        <p class="text-primary mb-1">Bilgisayar Mühendisliği (Lisans)</p>
                        <p class="text-muted mb-2">2018 - 2022</p>
                        <p class="mb-0">Bilgisayar mühendisliği alanında kapsamlı eğitim ve projeler.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title mb-1">Udemy</h5>
                        <p class="text-primary mb-1">Full Stack Web Development (Sertifika)</p>
                        <p class="text-muted mb-2">2021</p>
                        <p class="mb-0">Modern web teknolojileri ile full stack geliştirme eğitimi.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="education.php" class="btn btn-outline-primary btn-lg">
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
            <h2 class="display-5 fw-bold">İletişim</h2>
            <p class="lead text-muted">Bana ulaşmak için aşağıdaki iletişim bilgilerimi kullanabilirsiniz.</p>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="bg-light p-4 rounded-3 h-100 text-center shadow-sm">
                    <i class="fas fa-map-marker-alt fa-2x text-primary mb-3"></i>
                    <h5 class="mb-2">Adres</h5>
                    <p class="mb-0">İstanbul, Türkiye</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-light p-4 rounded-3 h-100 text-center shadow-sm">
                    <i class="fas fa-phone fa-2x text-primary mb-3"></i>
                    <h5 class="mb-2">Telefon</h5>
                    <p class="mb-0"><a href="tel:+905551112233" class="text-decoration-none text-dark">+90 555 111 22 33</a></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-light p-4 rounded-3 h-100 text-center shadow-sm">
                    <i class="fas fa-envelope fa-2x text-primary mb-3"></i>
                    <h5 class="mb-2">E-Posta</h5>
                    <p class="mb-0"><a href="mailto:info@bunyaminyusufoglu.com" class="text-decoration-none text-dark">info@bunyaminyusufoglu.com</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
