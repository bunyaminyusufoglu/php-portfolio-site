<?php
// SEO ayarlarını çek
require_once __DIR__ . '/db.php';
$seo = $db->fetch("SELECT * FROM seo_settings WHERE id = 1");
$site_title = isset($seo['site_title']) && $seo['site_title'] !== '' ? $seo['site_title'] : (isset($page_title) ? $page_title . ' - Portfolio' : 'Portfolio');
$site_description = isset($seo['site_description']) ? $seo['site_description'] : '';
$site_keywords = isset($seo['site_keywords']) ? $seo['site_keywords'] : '';
?>
<!DOCTYPE html>
<html lang="tr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($page_title)): ?><?php echo htmlspecialchars($page_title . ' - '); ?><?php endif; ?><?php echo htmlspecialchars($site_title); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($site_description); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($site_keywords); ?>">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navigation Header -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand text-primary" href="index.php">
                <i class="fas fa-code me-2"></i>
                <?php echo htmlspecialchars($site_title); ?>
            </a>
            
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">
                            <i class="fas fa-home me-1"></i>
                            Ana Sayfa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>" href="about.php">
                            <i class="fas fa-user me-1"></i>
                            Hakkımda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'projects.php' ? 'active' : ''; ?>" href="projects.php">
                            <i class="fas fa-project-diagram me-1"></i>
                            Projelerim
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'skills.php' ? 'active' : ''; ?>" href="skills.php">
                            <i class="fas fa-tools me-1"></i>
                            Yeteneklerim
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'education.php' ? 'active' : ''; ?>" href="education.php">
                            <i class="fas fa-graduation-cap me-1"></i>
                            Eğitim Geçmişim
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>" href="contact.php">
                            <i class="fas fa-envelope me-1"></i>
                            İletişim
                        </a>
                    </li>
                    <!-- Dark Mode Toggle Button -->
                    <li class="nav-item d-flex align-items-center">
                        <button class="theme-toggle" id="themeToggle" aria-label="Karanlık modu aç/kapat">
                            <i class="fas fa-moon" id="themeIcon"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Wrapper -->
    <main class="main-content">

    <!-- Dark Mode JavaScript -->
    <script>
        // Theme toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = document.getElementById('themeIcon');
            const html = document.documentElement;
            
            // Check for saved theme preference or default to light mode
            const currentTheme = localStorage.getItem('theme') || 'light';
            html.setAttribute('data-theme', currentTheme);
            updateThemeIcon(currentTheme);
            
            // Theme toggle click handler
            themeToggle.addEventListener('click', function() {
                const currentTheme = html.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                html.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateThemeIcon(newTheme);
            });
            
            // Update theme icon based on current theme
            function updateThemeIcon(theme) {
                if (theme === 'dark') {
                    themeIcon.className = 'fas fa-sun';
                    themeIcon.setAttribute('title', 'Açık moda geç');
                } else {
                    themeIcon.className = 'fas fa-moon';
                    themeIcon.setAttribute('title', 'Karanlık moda geç');
                }
            }
            
            // Check system preference on load
            if (!localStorage.getItem('theme')) {
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                const defaultTheme = prefersDark ? 'dark' : 'light';
                html.setAttribute('data-theme', defaultTheme);
                localStorage.setItem('theme', defaultTheme);
                updateThemeIcon(defaultTheme);
            }
        });
    </script>
</body>
</html> 