<?php
require __DIR__ . '/config/database.php';
require __DIR__ . '/config/helpers.php';
$pageTitle = 'Privacy Policy - Sahyog';
require __DIR__ . '/includes/header.php';
?>
<section class="section">
    <div class="container">
        <div class="section-title"><h2>Privacy Policy</h2></div>
        <div class="content-card">
            <p>Sahyog collects contact, enrollment, and subscription details only to respond to users, manage programs, and share organizational updates.</p>
            <p>Information submitted through this website is stored in the local application database and can be reviewed by authorized administrators only.</p>
            <p>For any correction or deletion request, contact <?= e(setting($pdo, 'email', 'support@nirmalc.com')) ?>.</p>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
