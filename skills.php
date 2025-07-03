<?php
$page_title = "Yeteneklerim";
include 'includes/header.php';
require_once __DIR__ . '/includes/db.php';

// Sadece aktif yetenekleri çek
$skills = $db->fetchAll("SELECT * FROM skills WHERE is_active = 1 ORDER BY id DESC");

// Başlığa göre ikon eşleştirme fonksiyonu
function skill_icon($title) {
    $map = [
        'HTML5' => 'fa-brands fa-html5',
        'CSS3' => 'fa-brands fa-css3',
        'JavaScript' => 'fa-brands fa-js',
        'React' => 'fa-brands fa-react',
        'Angular' => 'fa-brands fa-angular',
        'Vue.js' => 'fa-brands fa-vuejs',
        'Node.js' => 'fa-brands fa-node-js',
        'PHP' => 'fa-brands fa-php',
        'Laravel' => 'fa-brands fa-laravel',
        'MySQL' => 'fa-solid fa-database',
        'MongoDB' => 'fa-solid fa-database',
        'PostgreSQL' => 'fa-solid fa-database',
    ];
    return $map[$title] ?? 'fa-solid fa-star';
}
?>

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <?php foreach ($skills as $skill): ?>
            <div class="col-lg-2 col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="<?php echo skill_icon($skill['title']); ?> fa-2x"></i>
                        </div>
                        <h5 class="card-title"><?php echo htmlspecialchars($skill['title']); ?></h5>
                        <p class="card-text text-muted"><?php echo htmlspecialchars($skill['description']); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php if (count($skills) === 0): ?>
            <div class="alert alert-info text-center mt-5">Henüz yetenek eklenmedi.</div>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>