<?php
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../config/helpers.php';
require __DIR__ . '/auth.php';
require_admin();

$counts = [];
foreach (['programs', 'team_members', 'impact_stories', 'partners', 'knowledge_posts', 'gallery_items', 'contact_messages', 'enrollments', 'newsletter_subscribers'] as $table) {
    $counts[$table] = (int) $pdo->query("SELECT COUNT(*) FROM {$table}")->fetchColumn();
}

$adminTitle = 'Dashboard';
ob_start();
?>
<div class="row g-4">
    <?php foreach ($counts as $table => $count): ?>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="admin-card p-4">
                <div class="text-muted text-uppercase small"><?= e($table === 'knowledge_posts' ? 'Blogs' : str_replace('_', ' ', $table)) ?></div>
                <div class="display-6 fw-bold"><?= $count ?></div>
                <a href="manage.php?entity=<?= e($table) ?>">Manage</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
