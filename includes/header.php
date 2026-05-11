<?php
$siteName = setting($pdo, 'site_name', 'Sahyog');
$phone = setting($pdo, 'phone', '8318453235');
$email = setting($pdo, 'email', 'prashant.upadhyay7080@gmail.com');
$logo = setting($pdo, 'logo_url', 'assets/img/rebrand/logo.jpg');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle ?? $siteName) ?></title>
    <meta name="description" content="<?= e(setting($pdo, 'meta_description', 'Sahyog works for rehabilitation, skills, livelihoods, and community empowerment.')) ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<!-- Public layout adapted from Bootstrap 5.3 Headers, Heroes, Features, Cards, and Footer templates. -->
<header class="site-header sticky-top">
    <div class="topbar">
        <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="mailto:<?= e($email) ?>"><i class="bi bi-envelope"></i> <?= e($email) ?></a>
                <a href="tel:<?= e(str_replace(' ', '', $phone)) ?>"><i class="bi bi-telephone"></i> <?= e($phone) ?></a>
            </div>
            <div class="social-links">
                <a href="<?= e(setting($pdo, 'twitter_url', '#')) ?>" aria-label="X"><i class="bi bi-twitter-x"></i></a>
                <a href="<?= e(setting($pdo, 'facebook_url', '#')) ?>" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                <a href="<?= e(setting($pdo, 'instagram_url', '#')) ?>" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                <a href="<?= e(setting($pdo, 'linkedin_url', '#')) ?>" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-xl bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
                <img src="<?= e($logo) ?>" alt="<?= e($siteName) ?>" class="brand-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto align-items-xl-center">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">About</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php#about">About Us</a></li>
                            <li><a class="dropdown-item" href="index.php#leadership">Leadership</a></li>
                            <li><a class="dropdown-item" href="index.php#partners">Partners and Networks</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Programs</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php#programs">Programs and Initiatives</a></li>
                            <li><a class="dropdown-item" href="index.php#stories">Voices of Change</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Resources</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="gallery.php">Gallery</a></li>
                            <li><a class="dropdown-item" href="blogs.php">Blogs</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="index.php#contact">Contact</a></li>
                    <li class="nav-item ms-xl-2"><a class="btn btn-enroll" href="enrollment.php">Enrollment</a></li>
                    <li class="nav-item ms-xl-2"><a class="btn btn-enroll" href="admin/login.php">Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<main>
