    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Footer -->
    <footer class="bg-dark text-light py-5 mt-5">
        <div class="container">
            <div class="row">
                <!-- Brand Section -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h4 class="text-white mb-3">
                        <i class="fas fa-code me-2"></i>
                        Portfolio
                    </h4>
                    <p class="text-white">
                        Modern web teknolojileri ile profesyonel çözümler geliştiren tutkulu bir yazılım geliştiricisiyim.
                    </p>
                    <div class="social-links">
                        <a href="#" class="text-white me-3 fs-5" target="_blank">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="#" class="text-white me-3 fs-5" target="_blank">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="#" class="text-white me-3 fs-5" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-white fs-5" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h4 class="text-white mb-3">Hızlı Linkler</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="about.php" class="text-white text-decoration-none">Hakkımda</a>
                        </li>
                        <li class="mb-2">
                            <a href="projects.php" class="text-white text-decoration-none">Projeler</a>
                        </li>
                        <li class="mb-2">
                            <a href="skills.php" class="text-white text-decoration-none">Yetenekler</a>
                        </li>
                        <li class="mb-2">
                            <a href="contact.php" class="text-white text-decoration-none">İletişim</a>
                        </li>
                    </ul>
                </div>

                <!-- Services -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h4 class="text-white mb-3">Hizmetler</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="#" class="text-white text-decoration-none">Web Geliştirme</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-white text-decoration-none">Mobil Uygulama</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-white text-decoration-none">UI/UX Tasarım</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-white text-decoration-none">Danışmanlık</a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h4 class="text-white mb-3">İletişim</h4>
                    <div class="contact-info">
                        <p class="text-white mb-2">
                            <i class="fas fa-envelope me-2"></i>
                            info@example.com
                        </p>
                        <p class="text-white mb-2">
                            <i class="fas fa-phone me-2"></i>
                            +90 555 123 4567
                        </p>
                        <p class="text-white mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            İstanbul, Türkiye
                        </p>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <hr class="my-4 bg-secondary">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                        <p class="text-white mb-0">
                        &copy; <?php echo date('Y'); ?> Portfolio. Tüm hakları saklıdır.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="text-white mb-0">
                        <a href="#" class="text-white text-decoration-none me-3">Gizlilik Politikası</a>
                        <a href="#" class="text-white text-decoration-none">Kullanım Şartları</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="btn btn-primary position-fixed bottom-0 end-0 m-4 d-none" style="z-index: 1000;">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Custom JavaScript -->
    <script>
        // Scroll to Top functionality
        const scrollToTopBtn = document.getElementById('scrollToTop');
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.remove('d-none');
            } else {
                scrollToTopBtn.classList.add('d-none');
            }
        });
        
        scrollToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Active navigation link highlighting
        const currentPage = window.location.pathname.split('/').pop() || 'index.php';
        document.querySelectorAll('.nav-link').forEach(link => {
            const href = link.getAttribute('href');
            if (href === currentPage) {
                link.classList.add('active');
            }
        });
    </script>
</body>
</html> 