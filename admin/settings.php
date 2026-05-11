<?php
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../config/helpers.php';
require __DIR__ . '/auth.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['settings'] ?? [] as $key => $value) {
        $stmt = $pdo->prepare('UPDATE site_settings SET setting_value = ? WHERE setting_key = ?');
        $stmt->execute([trim($value), $key]);
    }
    redirect('settings.php?saved=1');
}

$settings = $pdo->query('SELECT * FROM site_settings ORDER BY setting_key')->fetchAll();
$adminTitle = 'Settings';
ob_start();
?>
<?php if (!empty($_GET['saved'])): ?><div class="alert alert-success">Settings saved.</div><?php endif; ?>
<div class="admin-card p-4">
    <form method="post" class="row g-3">
        <?php foreach ($settings as $setting): ?>
            <div class="col-md-6">
                <label class="form-label"><?= e(ucwords(str_replace('_', ' ', $setting['setting_key']))) ?></label>
                <textarea class="form-control" name="settings[<?= e($setting['setting_key']) ?>]" rows="2"><?= e($setting['setting_value']) ?></textarea>
            </div>
        <?php endforeach; ?>
        <div class="col-12"><button class="btn btn-brand">Save Settings</button></div>
    </form>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
