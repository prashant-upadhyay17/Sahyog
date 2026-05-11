<?php
require __DIR__ . '/config/database.php';
require __DIR__ . '/config/helpers.php';
$pageTitle = 'Enrollment - Sahyog';
require __DIR__ . '/includes/header.php';
?>
<section class="section soft">
    <div class="container">
        <div class="section-title">
            <h2>Enrollment</h2>
            <p>Submit your details for programs, volunteering, partnership, or community support.</p>
        </div>
        <?php if (!empty($_GET['sent'])): ?><div class="alert alert-success">Enrollment request submitted successfully.</div><?php endif; ?>
        <div class="contact-panel">
            <form action="actions/enroll.php" method="post" class="row g-3">
                <div class="col-md-6"><label class="form-label">Full Name</label><input class="form-control" name="full_name" required></div>
                <div class="col-md-6"><label class="form-label">Email</label><input class="form-control" name="email" type="email" required></div>
                <div class="col-md-6"><label class="form-label">Phone</label><input class="form-control" name="phone" required></div>
                <div class="col-md-6"><label class="form-label">City / District</label><input class="form-control" name="city"></div>
                <div class="col-md-6">
                    <label class="form-label">Enrollment Type</label>
                    <select class="form-select" name="interest" required>
                        <option value="">Select</option>
                        <option>Skill Training</option>
                        <option>Rehabilitation Support</option>
                        <option>Livelihood Program</option>
                        <option>Volunteer</option>
                        <option>Partner Organization</option>
                    </select>
                </div>
                <div class="col-md-6"><label class="form-label">Preferred Contact Time</label><input class="form-control" name="preferred_time" placeholder="Morning, afternoon, evening"></div>
                <div class="col-12"><label class="form-label">Message</label><textarea class="form-control" name="message" rows="5"></textarea></div>
                <div class="col-12"><button class="btn btn-brand btn-lg" type="submit">Submit Enrollment</button></div>
            </form>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
