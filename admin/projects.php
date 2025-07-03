<?php
require_once __DIR__ . '/../includes/db.php';
$page_title = "Projeler";
include 'includes/header.php';

// --- Proje Silme ---
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $db->delete('projects', 'id = :id', ['id' => $_GET['delete']]);
    header('Location: projects.php');
    exit();
}

// --- Proje Ekleme ---
$success = false;
if (isset($_POST['add_project'])) {
    $db->insert('projects', [
        'title'        => $_POST['title'],
        'description'  => $_POST['description'],
        'technologies' => $_POST['technologies'],
        'detail_link'  => $_POST['detail_link'],
        'is_active'    => isset($_POST['is_active']) ? 1 : 0
    ]);
    $success = true;
}

// --- Proje Güncelleme ---
if (isset($_POST['edit_project'])) {
    $db->update('projects', [
        'title'        => $_POST['title'],
        'description'  => $_POST['description'],
        'technologies' => $_POST['technologies'],
        'detail_link'  => $_POST['detail_link'],
        'is_active'    => isset($_POST['is_active']) ? 1 : 0
    ], 'id = :id', ['id' => $_POST['project_id']]);
    $success = true;
}

// --- Projeleri Listele ---
$projects = $db->fetchAll('SELECT * FROM projects ORDER BY id DESC');
// --- Düzenlenecek proje (varsa) ---
$edit_project = null;
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $edit_project = $db->fetch('SELECT * FROM projects WHERE id = :id', ['id' => $_GET['edit']]);
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
                                <h5 class="mb-0"><?php echo $edit_project ? 'Projeyi Düzenle' : 'Yeni Proje Ekle'; ?></h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="">
                                    <?php if ($edit_project): ?>
                                        <input type="hidden" name="project_id" value="<?php echo $edit_project['id']; ?>">
                                    <?php endif; ?>
                                    <div class="mb-3">
                                        <label class="form-label">Başlık</label>
                                        <input type="text" name="title" class="form-control" required value="<?php echo $edit_project['title'] ?? ''; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Açıklama</label>
                                        <textarea name="description" class="form-control" rows="3"><?php echo $edit_project['description'] ?? ''; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Teknolojiler (virgülle ayırın)</label>
                                        <input type="text" name="technologies" class="form-control" value="<?php echo $edit_project['technologies'] ?? ''; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Detay Linki</label>
                                        <input type="text" name="detail_link" class="form-control" value="<?php echo $edit_project['detail_link'] ?? ''; ?>">
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" <?php if (($edit_project['is_active'] ?? 1) == 1) echo 'checked'; ?>>
                                        <label class="form-check-label" for="is_active">Aktif</label>
                                    </div>
                                    <button type="submit" name="<?php echo $edit_project ? 'edit_project' : 'add_project'; ?>" class="btn btn-<?php echo $edit_project ? 'warning' : 'success'; ?> w-100">
                                        <?php echo $edit_project ? 'Güncelle' : 'Ekle'; ?>
                                    </button>
                                    <?php if ($edit_project): ?>
                                        <a href="projects.php" class="btn btn-secondary w-100 mt-2">Vazgeç</a>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="mb-0">Projeler</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Başlık</th>
                                                <th>Teknolojiler</th>
                                                <th>Aktif</th>
                                                <th>İşlem</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($projects as $project): ?>
                                                <tr>
                                                    <td><?php echo $project['id']; ?></td>
                                                    <td><?php echo htmlspecialchars($project['title']); ?></td>
                                                    <td><?php echo htmlspecialchars($project['technologies']); ?></td>
                                                    <td><?php echo $project['is_active'] ? '<span class="badge bg-success">Evet</span>' : '<span class="badge bg-danger">Hayır</span>'; ?></td>
                                                    <td>
                                                        <a href="projects.php?edit=<?php echo $project['id']; ?>" class="btn btn-sm btn-warning">Düzenle</a>
                                                        <a href="projects.php?delete=<?php echo $project['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğinize emin misiniz?');">Sil</a>
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