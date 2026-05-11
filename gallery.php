<?php
require __DIR__ . '/config/database.php';
require __DIR__ . '/config/helpers.php';
$pageTitle = 'Gallery - NIRMALC';
$gallery = rows($pdo, 'gallery_items');
require __DIR__ . '/includes/header.php';
?>
<section class="section">
    <div class="container">
        <div class="section-title"><h2>Gallery</h2><p>Community events, camps, and field moments.</p></div>
        <div class="row g-4">
            <?php foreach ($gallery as $item): ?>
                <div class="col-lg-4 col-md-6"><div class="content-card gallery-card h-100 p-0"><img src="<?= e($item['image_url']) ?>" alt="<?= e($item['title']) ?>"><div class="p-4"><h3 class="h5"><?= e($item['title']) ?></h3><p><?= e($item['description']) ?></p></div></div></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
