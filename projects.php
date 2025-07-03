<?php
$page_title = "Projeler";
include 'includes/header.php';
require_once __DIR__ . '/includes/db.php';

// Sadece aktif projeleri çek
$projects = $db->fetchAll("SELECT * FROM projects WHERE is_active = 1 ORDER BY id DESC");
?>

<section class="py-5 bg-light">
    <div class="container">
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
                        <div class="mb-3">
                            <?php foreach (explode(',', $project['technologies']) as $tech): ?>
                                <span class="badge bg-light text-dark me-1"><?php echo htmlspecialchars(trim($tech)); ?></span>
                            <?php endforeach; ?>
                        </div>
                        <?php if (!empty($project['detail_link'])): ?>
                        <a href="<?php echo htmlspecialchars($project['detail_link']); ?>" class="btn btn-outline-primary" target="_blank">Detayları Gör</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php if (count($projects) === 0): ?>
            <div class="alert alert-info text-center mt-5">Henüz proje eklenmedi.</div>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>