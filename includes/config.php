<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'portfolio');
define('DB_USER', 'root');
define('DB_PASS', '');

// Site Configuration
define('SITE_NAME', 'Portfolio');
define('SITE_URL', 'http://localhost/php-portfolio-site');
define('SITE_EMAIL', 'info@siteadresi.com');

// Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Session Configuration
session_start();

// Timezone
date_default_timezone_set('Europe/Istanbul');
?>
