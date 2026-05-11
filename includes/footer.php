<?php
$address = setting($pdo, 'address', '123, Sahyog Sadan, Janpath Road, New Delhi, Delhi - 110001, INDIA');
?>
</main>
<footer class="footer">
    <section class="newsletter-section">
        <div class="container text-center">
            <h2>Join Our Newsletter</h2>
            <p>Subscribe to receive program updates, announcements, and community stories.</p>
            <?php if (!empty($_GET['subscribed'])): ?>
                <div class="alert alert-success mx-auto" style="max-width: 640px;">Thank you for subscribing.</div>
            <?php endif; ?>
            <form action="actions/subscribe.php" method="post" class="newsletter-form mx-auto">
                <input type="email" name="email" class="form-control" placeholder="Email address" required>
                <button class="btn btn-brand" type="submit">Subscribe</button>
            </form>
        </div>
    </section>
    <section class="footer-main">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5 col-md-6">
                    <h3>SAHYOG</h3>
                    <p><?= e($address) ?></p>
                    <p class="mb-1"><strong>Phone:</strong> <?= e($phone) ?></p>
                    <p><strong>Email:</strong> <?= e($email) ?></p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3>Useful Links</h3>
                    <ul class="footer-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="gallery.php">Gallery</a></li>
                        <li><a href="privacy_policy.php">Privacy Policy</a></li>
                        <li><a href="tnc.php">Terms & Conditions</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h3>Follow Us</h3>
                    <p>Be part of a growing community for dignity and inclusion.</p>
                    <div class="social-links footer-social">
                        <a href="<?= e(setting($pdo, 'twitter_url', '#')) ?>" aria-label="X"><i class="bi bi-twitter-x"></i></a>
                        <a href="<?= e(setting($pdo, 'facebook_url', '#')) ?>" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="<?= e(setting($pdo, 'instagram_url', '#')) ?>" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="<?= e(setting($pdo, 'linkedin_url', '#')) ?>" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="copyright">Copyright &copy; <?= date('Y') ?> Sahyog. All Rights Reserved.</div>
        </div>
    </section>
</footer>
<a href="#" class="scroll-top" aria-label="Back to top"><i class="bi bi-arrow-up-short"></i></a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/app.js"></script>
</body>
</html>
