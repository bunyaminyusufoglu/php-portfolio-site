<?php
require_once __DIR__ . '/../includes/db.php';
$page_title = "Yetenekler";
include 'includes/header.php';

// Silme işlemi
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $db->delete('skills', 'id = :id', ['id' => $_GET['delete']]);
    header('Location: skills.php');
    exit();
}

// Ekleme işlemi
$success = false;
if (isset($_POST['add_skill'])) {
    $db->insert('skills', [
        'title'       => $_POST['title'],
        'description' => $_POST['description'],
        'is_active'   => isset($_POST['is_active']) ? 1 : 0
    ]);
    $success = true;
}

// Güncelleme işlemi
if (isset($_POST['edit_skill'])) {
    $db->update('skills', [
        'title'       => $_POST['title'],
        'description' => $_POST['description'],
        'is_active'   => isset($_POST['is_active']) ? 1 : 0
    ], 'id = :id', ['id' => $_POST['skill_id']]);
    $success = true;
}

// Listele
$skills = $db->fetchAll('SELECT * FROM skills ORDER BY id DESC');
$edit_skill = null;
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $edit_skill = $db->fetch('SELECT * FROM skills WHERE id = :id', ['id' => $_GET['edit']]);
}
?>
<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <div class="app-wrapper">
        <?php include 'includes/sidebar.php'; ?>
        <main class="app-main">
            <div class="container mt-4">
                <?php if ($success): ?>
                    <div class="alert alert-success">İşlem başarılı!</div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-5">
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><?php echo $edit_skill ? 'Yetenek Düzenle' : 'Yeni Yetenek Ekle'; ?></h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="">
                                    <?php if ($edit_skill): ?>
                                        <input type="hidden" name="skill_id" value="<?php echo $edit_skill['id']; ?>">
                                    <?php endif; ?>
                                    <div class="mb-3">
                                        <label class="form-label">Başlık</label>
                                        <input type="text" name="title" class="form-control" required value="<?php echo $edit_skill['title'] ?? ''; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Açıklama</label>
                                        <textarea name="description" class="form-control" rows="3"><?php echo $edit_skill['description'] ?? ''; ?></textarea>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" <?php if (($edit_skill['is_active'] ?? 1) == 1) echo 'checked'; ?>>
                                        <label class="form-check-label" for="is_active">Aktif</label>
                                    </div>
                                    <button type="submit" name="<?php echo $edit_skill ? 'edit_skill' : 'add_skill'; ?>" class="btn btn-<?php echo $edit_skill ? 'warning' : 'success'; ?> w-100">
                                        <?php echo $edit_skill ? 'Güncelle' : 'Ekle'; ?>
                                    </button>
                                    <?php if ($edit_skill): ?>
                                        <a href="skills.php" class="btn btn-secondary w-100 mt-2">Vazgeç</a>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="mb-0">Yetenekler</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Başlık</th>
                                                <th>Açıklama</th>
                                                <th>Aktif</th>
                                                <th>İşlem</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($skills as $skill): ?>
                                                <tr>
                                                    <td><?php echo $skill['id']; ?></td>
                                                    <td><?php echo htmlspecialchars($skill['title']); ?></td>
                                                    <td><?php echo htmlspecialchars($skill['description']); ?></td>
                                                    <td><?php echo $skill['is_active'] ? '<span class="badge bg-success">Evet</span>' : '<span class="badge bg-danger">Hayır</span>'; ?></td>
                                                    <td>
                                                        <a href="skills.php?edit=<?php echo $skill['id']; ?>" class="btn btn-sm btn-warning">Düzenle</a>
                                                        <a href="skills.php?delete=<?php echo $skill['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğinize emin misiniz?');">Sil</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>   
    </div>
</body>
</html>
