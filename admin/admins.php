<?php
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../config/helpers.php';
require __DIR__ . '/auth.php';
require_admin();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) ($_POST['id'] ?? 0);
    $name = trim($_POST['name'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $isActive = (int) ($_POST['is_active'] ?? 0);
    $password = (string) ($_POST['password'] ?? '');

    if ($name === '' || $username === '') {
        $error = 'Name and username are required.';
    } elseif ($id === 0 && $password === '') {
        $error = 'Password is required for a new admin.';
    } else {
        if ($id > 0) {
            if ($password !== '') {
                $stmt = $pdo->prepare('UPDATE admins SET name = ?, username = ?, password_hash = ?, is_active = ? WHERE id = ?');
                $stmt->execute([$name, $username, password_hash($password, PASSWORD_DEFAULT), $isActive, $id]);
            } else {
                $stmt = $pdo->prepare('UPDATE admins SET name = ?, username = ?, is_active = ? WHERE id = ?');
                $stmt->execute([$name, $username, $isActive, $id]);
            }
        } else {
            $stmt = $pdo->prepare('INSERT INTO admins (name, username, password_hash, is_active) VALUES (?, ?, ?, ?)');
            $stmt->execute([$name, $username, password_hash($password, PASSWORD_DEFAULT), $isActive]);
        }
        redirect('admins.php?saved=1');
    }
}

if (isset($_GET['delete'])) {
    $deleteId = (int) $_GET['delete'];
    if ($deleteId !== (int) ($_SESSION['admin_id'] ?? 0)) {
        $stmt = $pdo->prepare('DELETE FROM admins WHERE id = ?');
        $stmt->execute([$deleteId]);
    }
    redirect('admins.php?deleted=1');
}

$editRow = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare('SELECT * FROM admins WHERE id = ?');
    $stmt->execute([(int) $_GET['edit']]);
    $editRow = $stmt->fetch();
}

$admins = $pdo->query('SELECT id, name, username, is_active, created_at FROM admins ORDER BY id DESC')->fetchAll();
$adminTitle = 'Admin Users';
ob_start();
?>
<?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
<?php if (!empty($_GET['saved'])): ?><div class="alert alert-success">Admin saved.</div><?php endif; ?>
<div class="admin-card p-4 mb-4">
    <h3 class="h5"><?= $editRow ? 'Edit Admin' : 'Add Admin' ?></h3>
    <form method="post" class="row g-3">
        <input type="hidden" name="id" value="<?= e($editRow['id'] ?? '') ?>">
        <div class="col-md-6"><label class="form-label">Name</label><input class="form-control" name="name" value="<?= e($editRow['name'] ?? '') ?>" required></div>
        <div class="col-md-6"><label class="form-label">Username</label><input class="form-control" name="username" value="<?= e($editRow['username'] ?? '') ?>" required></div>
        <div class="col-md-6"><label class="form-label">Password <?= $editRow ? '(leave blank to keep current)' : '' ?></label><input class="form-control" name="password" type="password" <?= $editRow ? '' : 'required' ?>></div>
        <div class="col-md-6"><label class="form-label">Status</label><select class="form-select" name="is_active"><option value="1" <?= (string)($editRow['is_active'] ?? '1') === '1' ? 'selected' : '' ?>>Active</option><option value="0" <?= (string)($editRow['is_active'] ?? '') === '0' ? 'selected' : '' ?>>Disabled</option></select></div>
        <div class="col-12"><button class="btn btn-brand">Save Admin</button> <?php if ($editRow): ?><a class="btn btn-outline-secondary" href="admins.php">Cancel</a><?php endif; ?></div>
    </form>
</div>
<div class="admin-card p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead><tr><th>ID</th><th>Name</th><th>Username</th><th>Status</th><th>Created</th><th>Actions</th></tr></thead>
            <tbody>
                <?php foreach ($admins as $admin): ?>
                    <tr>
                        <td><?= e((string) $admin['id']) ?></td>
                        <td><?= e($admin['name']) ?></td>
                        <td><?= e($admin['username']) ?></td>
                        <td><?= $admin['is_active'] ? 'Active' : 'Disabled' ?></td>
                        <td><?= e($admin['created_at']) ?></td>
                        <td>
                            <a class="btn btn-sm btn-outline-success" href="admins.php?edit=<?= e((string) $admin['id']) ?>">Edit</a>
                            <?php if ((int) $admin['id'] !== (int) ($_SESSION['admin_id'] ?? 0)): ?>
                                <a class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this admin?')" href="admins.php?delete=<?= e((string) $admin['id']) ?>">Delete</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
