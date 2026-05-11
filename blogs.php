<?php
require __DIR__ . '/config/database.php';
require __DIR__ . '/config/helpers.php';
$pageTitle = 'Blogs - NIRMALC';
$posts = rows($pdo, 'knowledge_posts');
require __DIR__ . '/includes/header.php';
?>
<section class="section soft">
    <div class="container">
        <div class="section-title"><h2>Blogs</h2><p>Updates, resources, and field learning from NIRMAL Council.</p></div>
        <div class="row g-4">
            <?php foreach ($posts as $post): ?>
                <div class="col-lg-4 col-md-6"><article class="content-card post-card h-100 p-0"><img src="<?= e($post['image_url']) ?>" alt="<?= e($post['title']) ?>"><div class="p-4"><span class="badge text-bg-success mb-2"><?= e($post['category']) ?></span><h3 class="h5"><?= e($post['title']) ?></h3><p><?= e($post['excerpt']) ?></p><p><?= e($post['body']) ?></p></div></article></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
