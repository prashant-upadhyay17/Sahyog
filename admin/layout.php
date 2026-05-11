<?php
$adminMenu = [
    'index.php' => 'Dashboard',
    'manage.php?entity=programs' => 'Programs',
    'manage.php?entity=team_members' => 'Leadership',
    'manage.php?entity=impact_stories' => 'Voices',
    'manage.php?entity=partners' => 'Partners',
    'manage.php?entity=knowledge_posts' => 'Blogs',
    'manage.php?entity=gallery_items' => 'Gallery',
    'manage.php?entity=contact_messages' => 'Messages',
    'manage.php?entity=enrollments' => 'Enrollments',
    'manage.php?entity=newsletter_subscribers' => 'Subscribers',
    'admins.php' => 'Admin Users',
    'settings.php' => 'Settings',
];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($adminTitle ?? 'Admin') ?> - Sahyog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body class="admin-shell">
<!-- Admin layout adapted from Bootstrap 5.3 Dashboard and Offcanvas navbar templates. -->
<header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="index.php">Sahyog Admin</a>
    <button class="navbar-toggler d-md-none collapsed me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar" aria-controls="adminSidebar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</header>
<div class="container-fluid">
    <div class="row">
        <div class="sidebar border-end col-md-3 col-lg-2 p-0 bg-body-tertiary">
            <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="adminSidebar" aria-labelledby="adminSidebarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="adminSidebarLabel">Sahyog Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#adminSidebar" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                    <ul class="nav flex-column">
                        <?php foreach ($adminMenu as $href => $label): ?>
                            <li class="nav-item"><a class="nav-link d-flex align-items-center gap-2" href="<?= e($href) ?>"><i class="bi bi-chevron-right"></i><?= e($label) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <hr class="my-3">
                    <ul class="nav flex-column mb-auto">
                        <li class="nav-item"><a class="nav-link d-flex align-items-center gap-2" href="../index.php" target="_blank"><i class="bi bi-box-arrow-up-right"></i>View Website</a></li>
                        <li class="nav-item"><a class="nav-link d-flex align-items-center gap-2" href="logout.php"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-3 mb-4 border-bottom">
                <div>
                    <h1 class="h2 mb-0"><?= e($adminTitle ?? 'Dashboard') ?></h1>
                    <p class="text-muted mb-0">Welcome, <?= e($_SESSION['admin_name'] ?? 'Admin') ?></p>
                </div>
            </div>
            <?= $content ?>
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
