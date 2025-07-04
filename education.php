<?php
require_once 'includes/db.php';
$page_title = "Eğitim";

// Eğitim verilerini veritabanından çek
$educations = $db->fetchAll('SELECT * FROM education ORDER BY end_year DESC');

include 'includes/header.php';
?>

<section class="py-5 bg-light">
    <div class="container">
        
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
                    <div class="col-lg-6">
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
    </div>
</section>




<?php include 'includes/footer.php'; ?>