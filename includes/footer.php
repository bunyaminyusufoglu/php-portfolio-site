    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Footer -->
    <footer class="bg-dark text-light py-5 mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Brand Section -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <?php
                    if (isset($db)) {
                        $row = $db->fetch("SELECT content_value FROM about_page WHERE section_name = 'profile' AND content_key = 'title' AND is_active = 1 LIMIT 1");
                        if ($row && !empty($row['content_value'])) {
                            $footer_name = htmlspecialchars($row['content_value']);
                        }
                        $row = $db->fetch("SELECT content_value FROM about_page WHERE section_name = 'profile' AND content_key = 'description' AND is_active = 1 LIMIT 1");
                        if ($row && !empty($row['content_value'])) {
                            $footer_title = htmlspecialchars($row['content_value']);
                        }
                    }
                    ?>
                    <h4 class="text-white mb-1">
                        <i class="fas fa-code me-2"></i>
                        <?php echo $footer_name; ?>
                    </h4>
                    <p class="text-white-50 mb-4" style="font-size:1.1rem;">
                        <?php echo $footer_title; ?>
                    </p>
                    <?php
                    // Sosyal medya linklerini çek
                    if (isset($db)) {
                        $social_media = $db->fetchAll("SELECT * FROM social_media WHERE is_active = 1 ORDER BY sort_order ASC");
                        if (!empty($social_media)) {
                            echo '<div class="social-links">';
                            foreach ($social_media as $social) {
                                echo '<a href="' . htmlspecialchars($social['url']) . '" 
                                       class="text-white me-3 fs-5" 
                                       target="_blank" 
                                       rel="noopener noreferrer"
                                       title="' . htmlspecialchars($social['platform']) . '">
                                        <i class="' . htmlspecialchars($social['icon']) . '"></i>
                                    </a>';
                            }
                            echo '</div>';
                        }
                    } ?>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="text-white mb-3">Hızlı Linkler</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="about.php" class="text-white-50 text-decoration-none hover-white">Hakkımda</a>
                        </li>
                        <li class="mb-2">
                            <a href="projects.php" class="text-white-50 text-decoration-none hover-white">Projelerim</a>
                        </li>
                        <li class="mb-2">
                            <a href="skills.php" class="text-white-50 text-decoration-none hover-white">Yeteneklerim</a>
                        </li>
                        <li class="mb-2">
                            <a href="education.php" class="text-white-50 text-decoration-none hover-white">Eğitim</a>
                        </li>
                        <li class="mb-2">
                            <a href="contact.php" class="text-white-50 text-decoration-none hover-white">İletişim</a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="text-white mb-3">İletişim</h5>
                    <?php
                    // İletişim bilgilerini çek
                    if (isset($db)) {
                        $contact_info = $db->fetchAll("SELECT * FROM contact_info WHERE is_active = 1 ORDER BY sort_order ASC LIMIT 3");
                        if (!empty($contact_info)) {
                            echo '<div class="contact-info">';
                            foreach ($contact_info as $contact) {
                                echo '<p class="text-white-50 mb-2">';
                                echo '<i class="' . htmlspecialchars($contact['icon']) . ' me-2"></i>';
                                if ($contact['type'] === 'email') {
                                    echo '<a href="mailto:' . htmlspecialchars($contact['value']) . '" class="text-white-50 text-decoration-none">';
                                    echo htmlspecialchars($contact['value']);
                                    echo '</a>';
                                } elseif ($contact['type'] === 'phone') {
                                    echo '<a href="tel:' . htmlspecialchars($contact['value']) . '" class="text-white-50 text-decoration-none">';
                                    echo htmlspecialchars($contact['value']);
                                    echo '</a>';
                                } else {
                                    echo htmlspecialchars($contact['value']);
                                }
                                echo '</p>';
                            }
                            echo '</div>';
                        } else {
                            echo '<p class="text-white-50">İletişim bilgileri yakında eklenecek.</p>';
                        }
                    } else {
                        echo '<p class="text-white-50">İletişim bilgileri yakında eklenecek.</p>';
                    } ?>
                </div>
            </div>

            <!-- Footer Bottom -->
            <hr class="my-4 bg-secondary">
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <?php
                    require_once __DIR__ . '/db.php';
                    $seo = $db->fetch("SELECT * FROM seo_settings WHERE id = 1");
                    $site_title = isset($seo['site_title']) && $seo['site_title'] !== '' ? $seo['site_title'] : 'Portfolio';
                    ?>
                    <p class="text-white-50 mb-0">
                        &copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($site_title); ?>. Tüm hakları saklıdır.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="btn btn-primary position-fixed bottom-0 end-0 m-4 d-none" style="z-index: 1000;">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Custom CSS -->
    <style>
        .hover-white:hover {
            color: white !important;
            transition: color 0.3s ease;
        }
        
        .social-links a:hover {
            transform: translateY(-2px);
            transition: transform 0.3s ease;
        }
        
        footer {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        }
    </style>

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