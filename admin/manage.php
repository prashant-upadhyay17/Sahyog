<?php
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../config/helpers.php';
require __DIR__ . '/auth.php';
require_admin();

$entities = [
    'programs' => ['label' => 'Programs', 'fields' => ['title', 'description', 'icon', 'image_url', 'sort_order', 'is_active']],
    'team_members' => ['label' => 'Leadership', 'fields' => ['name', 'designation', 'bio', 'image_url', 'sort_order', 'is_active']],
    'impact_stories' => ['label' => 'Voices of Change', 'fields' => ['title', 'description', 'image_url', 'sort_order', 'is_active']],
    'partners' => ['label' => 'Partners', 'fields' => ['name', 'website_url', 'sort_order', 'is_active']],
    'knowledge_posts' => ['label' => 'Knowledge Hub', 'fields' => ['title', 'category', 'excerpt', 'body', 'image_url', 'sort_order', 'is_active']],
    'gallery_items' => ['label' => 'Gallery', 'fields' => ['title', 'description', 'image_url', 'sort_order', 'is_active']],
    'contact_messages' => ['label' => 'Messages', 'fields' => ['name', 'email', 'phone', 'subject', 'message', 'status'], 'readonly' => true],
    'enrollments' => ['label' => 'Enrollments', 'fields' => ['full_name', 'email', 'phone', 'city', 'interest', 'preferred_time', 'message', 'status'], 'readonly' => true],
    'newsletter_subscribers' => ['label' => 'Subscribers', 'fields' => ['email'], 'readonly' => true],
];

$entity = $_GET['entity'] ?? 'programs';
if (!isset($entities[$entity])) {
    redirect('index.php');
}

$meta = $entities[$entity];
$fields = $meta['fields'];
$readonly = !empty($meta['readonly']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$readonly) {
    $id = (int) ($_POST['id'] ?? 0);
    $values = [];
    foreach ($fields as $field) {
        $values[$field] = in_array($field, ['sort_order', 'is_active'], true) ? (int) ($_POST[$field] ?? 0) : trim($_POST[$field] ?? '');
    }
    if ($id > 0) {
        $set = implode(', ', array_map(fn($field) => "{$field} = ?", $fields));
        $stmt = $pdo->prepare("UPDATE {$entity} SET {$set} WHERE id = ?");
        $stmt->execute([...array_values($values), $id]);
    } else {
        $columns = implode(', ', $fields);
        $marks = implode(', ', array_fill(0, count($fields), '?'));
        $stmt = $pdo->prepare("INSERT INTO {$entity} ({$columns}) VALUES ({$marks})");
        $stmt->execute(array_values($values));
    }
    redirect("manage.php?entity={$entity}&saved=1");
}

if (isset($_GET['delete']) && !$readonly) {
    $stmt = $pdo->prepare("DELETE FROM {$entity} WHERE id = ?");
    $stmt->execute([(int) $_GET['delete']]);
    redirect("manage.php?entity={$entity}&deleted=1");
}

if (isset($_GET['status']) && in_array($entity, ['contact_messages', 'enrollments'], true)) {
    $stmt = $pdo->prepare("UPDATE {$entity} SET status = ? WHERE id = ?");
    $stmt->execute([$_GET['status'], (int) $_GET['id']]);
    redirect("manage.php?entity={$entity}");
}

$editRow = null;
if (isset($_GET['edit']) && !$readonly) {
    $stmt = $pdo->prepare("SELECT * FROM {$entity} WHERE id = ?");
    $stmt->execute([(int) $_GET['edit']]);
    $editRow = $stmt->fetch();
}

$items = $pdo->query("SELECT * FROM {$entity} ORDER BY id DESC")->fetchAll();
$adminTitle = $meta['label'];
ob_start();
?>
<?php if (!empty($_GET['saved'])): ?><div class="alert alert-success">Saved successfully.</div><?php endif; ?>
<?php if (!$readonly): ?>
<div class="admin-card p-4 mb-4">
    <h3 class="h5"><?= $editRow ? 'Edit' : 'Add New' ?> <?= e($meta['label']) ?></h3>
    <form method="post" class="row g-3">
        <input type="hidden" name="id" value="<?= e($editRow['id'] ?? '') ?>">
        <?php foreach ($fields as $field): ?>
            <div class="<?= in_array($field, ['description', 'bio', 'body'], true) ? 'col-12' : 'col-md-6' ?>">
                <label class="form-label"><?= e(ucwords(str_replace('_', ' ', $field))) ?></label>
                <?php if (in_array($field, ['description', 'bio', 'body', 'excerpt'], true)): ?>
                    <textarea class="form-control" name="<?= e($field) ?>" rows="4"><?= e($editRow[$field] ?? '') ?></textarea>
                <?php elseif ($field === 'is_active'): ?>
                    <select class="form-select" name="is_active"><option value="1" <?= (string)($editRow[$field] ?? '1') === '1' ? 'selected' : '' ?>>Active</option><option value="0" <?= (string)($editRow[$field] ?? '') === '0' ? 'selected' : '' ?>>Hidden</option></select>
                <?php else: ?>
                    <input class="form-control" name="<?= e($field) ?>" value="<?= e($editRow[$field] ?? ($field === 'sort_order' ? '0' : '')) ?>">
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <div class="col-12"><button class="btn btn-brand">Save</button> <?php if ($editRow): ?><a class="btn btn-outline-secondary" href="manage.php?entity=<?= e($entity) ?>">Cancel</a><?php endif; ?></div>
    </form>
</div>
<?php endif; ?>

<div class="admin-card p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead><tr><th>ID</th><?php foreach ($fields as $field): ?><th><?= e(ucwords(str_replace('_', ' ', $field))) ?></th><?php endforeach; ?><th>Created</th><th>Actions</th></tr></thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= e((string) $item['id']) ?></td>
                    <?php foreach ($fields as $field): ?>
                        <?php
                        $cellValue = (string) ($item[$field] ?? '');
                        $cellValue = strlen($cellValue) > 90 ? substr($cellValue, 0, 87) . '...' : $cellValue;
                        ?>
                        <td style="max-width: 260px;"><?= e($cellValue) ?></td>
                    <?php endforeach; ?>
                    <td><?= e($item['created_at'] ?? '') ?></td>
                    <td class="text-nowrap">
                        <?php if (!$readonly): ?>
                            <a class="btn btn-sm btn-outline-success" href="manage.php?entity=<?= e($entity) ?>&edit=<?= e((string) $item['id']) ?>">Edit</a>
                            <a class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this item?')" href="manage.php?entity=<?= e($entity) ?>&delete=<?= e((string) $item['id']) ?>">Delete</a>
                        <?php elseif (in_array($entity, ['contact_messages', 'enrollments'], true)): ?>
                            <a class="btn btn-sm btn-outline-success" href="manage.php?entity=<?= e($entity) ?>&id=<?= e((string) $item['id']) ?>&status=completed">Mark Completed</a>
                            <a class="btn btn-sm btn-outline-secondary" href="manage.php?entity=<?= e($entity) ?>&id=<?= e((string) $item['id']) ?>&status=new">Mark New</a>
                        <?php else: ?>
                            <span class="text-muted">View only</span>
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
