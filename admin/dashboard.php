<?php
require_once 'includes/auth_check.php';
$page_title = "Dashboard";
include 'includes/header.php';

// Yetenek sayısı
$row = $db->fetch("SELECT COUNT(*) as cnt FROM skills");
$skills_count = $row ? $row['cnt'] : 0;
$last_skills = $db->fetchAll("SELECT title FROM skills ORDER BY id DESC LIMIT 5");

// Eğitim sayısı
$row = $db->fetch("SELECT COUNT(*) as cnt FROM education");
$education_count = $row ? $row['cnt'] : 0;
$last_educations = $db->fetchAll("SELECT school_name, start_year, end_year FROM education ORDER BY id DESC LIMIT 5");

// Proje sayısı
$row = $db->fetch("SELECT COUNT(*) as cnt FROM projects");
$projects_count = $row ? $row['cnt'] : 0;
$last_projects = $db->fetchAll("SELECT title, description FROM projects ORDER BY id DESC LIMIT 5");

// İletişim mesajı sayısı
$row = $db->fetch("SELECT COUNT(*) as cnt FROM contact_messages");
$messages_count = $row ? $row['cnt'] : 0;

// Sosyal medya sayısı
$row = $db->fetch("SELECT COUNT(*) as cnt FROM social_media");
$social_count = $row ? $row['cnt'] : 0;

$last_messages = $db->fetchAll("SELECT first_name, last_name, email, message, created_at FROM contact_messages ORDER BY id DESC LIMIT 5");
?>

    <body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
        <div class="app-wrapper">
            <?php include 'includes/sidebar.php'; ?>
            <main class="app-main">
                <div class="container-fluid">
                    <div class="row mt-3">
                        <!-- Yetenekler Kartı -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?php echo $skills_count; ?></h3>
                                    <p>Yetenek</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-tools"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Eğitim Kartı -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?php echo $education_count; ?></h3>
                                    <p>Eğitim</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Proje Kartı -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3><?php echo $projects_count; ?></h3>
                                    <p>Proje</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-project-diagram"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Sosyal Medya Kartı -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-secondary">
                                <div class="inner">
                                    <h3><?php echo $social_count; ?></h3>
                                    <p>Sosyal Medya Hesabı</p>
                                </div>
                                <div class="icon">
                                    <i class="fab fa-facebook-f"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Son Eklenenler -->
                    <div class="row">
                        <!-- Son 5 Yetenek -->
                        <div class="col-md-4">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Son Eklenen 5 Yetenek</h3>
                                </div>
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush">
                                        <?php foreach ($last_skills as $skill): ?>
                                            <li class="list-group-item"><?php echo htmlspecialchars($skill['title']); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Son 5 Eğitim -->
                        <div class="col-md-4">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Son Eklenen 5 Eğitim</h3>
                                </div>
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush">
                                        <?php foreach ($last_educations as $edu): ?>
                                            <li class="list-group-item">
                                                <?php echo htmlspecialchars($edu['school_name']); ?>
                                                <span class="text-muted small"><?php echo $edu['start_year']; ?> - <?php echo $edu['end_year']; ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Son 5 Proje (Açıklamalı) -->
                        <div class="col-md-4">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Son Eklenen 5 Proje</h3>
                                </div>
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush">
                                        <?php foreach ($last_projects as $proj): ?>
                                            <li class="list-group-item">
                                                <strong><?php echo htmlspecialchars($proj['title']); ?></strong><br>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Son 5 İletişim Mesajı -->
                    <div class="col-md-8 mx-auto">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-envelope-open-text"></i> Son 5 İletişim Mesajı</h3>
                            </div>
                            <div class="card-body p-0">
                                <?php if (empty($last_messages)): ?>
                                    <div class="p-4 text-center text-muted">Hiç mesaj yok.</div>
                                <?php else: ?>
                                    <ul class="list-group list-group-flush">
                                        <?php foreach ($last_messages as $msg): ?>
                                            <li class="list-group-item">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <strong><?php echo htmlspecialchars($msg['first_name'] . ' ' . $msg['last_name']); ?></strong>
                                                    <span class="text-muted small"><?php echo date('d.m.Y H:i', strtotime($msg['created_at'])); ?></span>
                                                </div>
                                                <div class="mb-1">
                                                    <a href="mailto:<?php echo htmlspecialchars($msg['email']); ?>" class="text-primary">
                                                        <?php echo htmlspecialchars($msg['email']); ?>
                                                    </a>
                                                </div>
                                                <div class="bg-light rounded p-2" style="font-size: 0.97em;">
                                                    <?php echo nl2br(htmlspecialchars($msg['message'])); ?>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <!-- AdminLTE JS -->
        <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    </body>
</html>