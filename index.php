<?php
require __DIR__ . '/config/database.php';
require __DIR__ . '/config/helpers.php';

$pageTitle = 'Sahyog';
$programs = rows($pdo, 'programs');
$leaders = rows($pdo, 'team_members');
$stories = rows($pdo, 'impact_stories');
$partners = rows($pdo, 'partners');
$posts = rows($pdo, 'knowledge_posts');
$gallery = array_slice(rows($pdo, 'gallery_items'), 0, 6);

require __DIR__ . '/includes/header.php';
?>
<section class="hero">
    <div class="container col-xxl-10 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-lg-4">
            <div class="col-10 col-sm-8 col-lg-6 mx-auto">
                <div class="hero-image">
                    <img src="<?= e(setting($pdo, 'hero_image', 'assets/img/rebrand/hero.jpg')) ?>" class="d-block mx-lg-auto img-fluid" alt="Community empowerment" width="700" height="500">
                </div>
            </div>
            <div class="col-lg-6">
                <h1><?= e(setting($pdo, 'hero_title', 'Empowering Communities. Restoring Dignity. Building Futures')) ?></h1>
                <p><?= e(setting($pdo, 'hero_subtitle', 'Sahyog transforms lives through rehabilitation, skill development, and livelihood programs.')) ?></p>
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="#programs" class="btn btn-brand btn-lg">Explore Programs</a>
                    <a href="enrollment.php" class="btn btn-outline-success btn-lg">Enroll Now</a>
                </div>
            </div>
        </div>
        <div class="feature-strip">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6"><div class="feature-card"><i class="bi bi-graph-up"></i><h4>Community Empowerment</h4><p>Inclusive opportunities for women, youth, and marginalized groups through sustainable livelihood and skill training.</p></div></div>
                <div class="col-lg-3 col-md-6"><div class="feature-card"><i class="bi bi-lightbulb"></i><h4>Rehabilitation & Inclusion</h4><p>Holistic support for people with disabilities through education, employment, and social participation.</p></div></div>
                <div class="col-lg-3 col-md-6"><div class="feature-card"><i class="bi bi-people"></i><h4>Sustainable Livelihoods</h4><p>Self-reliant communities through capacity building, micro-enterprise, and eco-friendly livelihood models.</p></div></div>
                <div class="col-lg-3 col-md-6"><div class="feature-card"><i class="bi bi-award"></i><h4>Collaborative Impact</h4><p>Partnerships with government, NGOs, and local bodies for measurable community-driven transformation.</p></div></div>
            </div>
        </div>
    </div>
</section>

<section id="about" class="section">
    <div class="container">
        <div class="section-title">
            <h2>About Us</h2>
            <p>Rehabilitation, skill training, livelihood generation, and community empowerment rooted in local participation.</p>
        </div>
        <div class="content-card">
            <p>Founded in 2025 with the belief that every person deserves the opportunity to live a dignified life, <strong>Sahyog</strong> works across Purvanchal and communities along the banks of the Ganga.</p>
            <p>Addressing social, health, and environmental challenges faced by riverine and rural populations, Sahyog implements community-based rehabilitation programs, vocational and life skills training, and women- and youth-focused livelihood models.</p>
            <div class="row g-4 mt-2">
                <div class="col-md-6"><h4>Mission</h4><p>To empower vulnerable populations through health, education, skills development, and livelihood support, enabling self-reliance and social inclusion.</p></div>
                <div class="col-md-6"><h4>Vision</h4><p>A society where every individual has access to rehabilitation, skills, livelihoods, and respect as a contributing member of the community.</p></div>
            </div>
            <h4 class="mt-3">Core Values</h4>
            <div class="row g-3">
                <div class="col-md-4"><strong>Inclusion</strong><br>Equitable access for marginalized communities.</div>
                <div class="col-md-4"><strong>Empowerment</strong><br>Confidence, skills, and tools for self-sufficiency.</div>
                <div class="col-md-4"><strong>Sustainability</strong><br>Livelihood models that endure economically and environmentally.</div>
                <div class="col-md-4"><strong>Collaboration</strong><br>Bridges with government, civil society, and private partners.</div>
                <div class="col-md-4"><strong>Integrity</strong><br>Transparency, ethical conduct, and accountability.</div>
                <div class="col-md-4"><strong>Innovation</strong><br>Adapting to local needs and scaling what works.</div>
            </div>
        </div>
    </div>
</section>

<section id="programs" class="section soft">
    <div class="container">
        <div class="section-title"><h2>Programs and Initiatives</h2><p>Practical programs designed for dignity, livelihoods, health, and inclusion.</p></div>
        <div class="row g-4">
            <?php foreach ($programs as $program): ?>
                <div class="col-lg-4 col-md-6">
                    <article class="content-card program-card h-100 p-0">
                        <img src="<?= e($program['image_url']) ?>" alt="<?= e($program['title']) ?>">
                        <div class="p-4">
                            <i class="section-icon bi <?= e($program['icon']) ?>"></i>
                            <h3 class="h5"><?= e($program['title']) ?></h3>
                            <p><?= e($program['description']) ?></p>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="leadership" class="section">
    <div class="container">
        <div class="section-title"><h2>Our Leadership</h2><p>Guided by development professionals, social workers, educators, and healthcare experts.</p></div>
        <div class="row g-4 justify-content-center">
            <?php foreach ($leaders as $leader): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="content-card text-center h-100">
                        <img class="leader-photo mb-3" src="<?= e($leader['image_url']) ?>" alt="<?= e($leader['name']) ?>">
                        <h3 class="h5"><?= e($leader['name']) ?></h3>
                        <p class="text-success fw-bold"><?= e($leader['designation']) ?></p>
                        <p><?= e($leader['bio']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="stories" class="section soft">
    <div class="container">
        <div class="section-title"><h2>Voices of Change</h2><p>Stories from communities and field initiatives.</p></div>
        <div class="row g-4">
            <?php foreach ($stories as $story): ?>
                <div class="col-lg-4 col-md-6"><article class="content-card story-card h-100 p-0"><img src="<?= e($story['image_url']) ?>" alt="<?= e($story['title']) ?>"><div class="p-4"><h3 class="h5"><?= e($story['title']) ?></h3><p><?= e($story['description']) ?></p></div></article></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="partners" class="section">
    <div class="container">
        <div class="section-title"><h2>Partners and Networks</h2><p>Collaborative networks strengthen impact and local delivery.</p></div>
        <div class="row g-3">
            <?php foreach ($partners as $partner): ?>
                <div class="col-lg-3 col-md-4 col-6"><a class="partner-logo text-center" href="<?= e($partner['website_url'] ?: '#') ?>"><?= e($partner['name']) ?></a></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="knowledge" class="section soft">
    <div class="container">
        <div class="section-title"><h2>Blogs</h2><p>Resources, updates, and notes from the field.</p></div>
        <div class="row g-4">
            <?php foreach (array_slice($posts, 0, 3) as $post): ?>
                <div class="col-lg-4 col-md-6"><article class="content-card post-card h-100 p-0"><img src="<?= e($post['image_url']) ?>" alt="<?= e($post['title']) ?>"><div class="p-4"><span class="badge text-bg-success mb-2"><?= e($post['category']) ?></span><h3 class="h5"><?= e($post['title']) ?></h3><p><?= e($post['excerpt']) ?></p><a href="blogs.php" class="fw-bold">Read more</a></div></article></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-title"><h2>Gallery</h2><p>Recent activities and community events.</p></div>
        <div class="row g-4">
            <?php foreach ($gallery as $item): ?>
                <div class="col-lg-4 col-md-6"><a class="content-card gallery-card d-block h-100 p-0" href="gallery.php"><img src="<?= e($item['image_url']) ?>" alt="<?= e($item['title']) ?>"><div class="p-3 fw-bold"><?= e($item['title']) ?></div></a></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="contact" class="section soft">
    <div class="container">
        <div class="section-title"><h2>Contact Us</h2><p>Need help? Send a message to the Sahyog team.</p></div>
        <?php if (!empty($_GET['message'])): ?><div class="alert alert-success">Your message has been sent. Thank you.</div><?php endif; ?>
        <div class="row g-4 align-items-stretch">
            <div class="col-lg-7">
                <div class="contact-panel">
                    <h3>Let's Start a Conversation</h3>
                    <form action="actions/contact.php" method="post" class="row g-3 mt-2">
                        <div class="col-md-6"><label class="form-label">Name</label><input class="form-control" name="name" required></div>
                        <div class="col-md-6"><label class="form-label">Email</label><input class="form-control" name="email" type="email" required></div>
                        <div class="col-md-6"><label class="form-label">Phone</label><input class="form-control" name="phone"></div>
                        <div class="col-md-6"><label class="form-label">Subject</label><input class="form-control" name="subject" required></div>
                        <div class="col-12"><label class="form-label">Message</label><textarea class="form-control" name="message" rows="5" required></textarea></div>
                        <div class="col-12"><button class="btn btn-brand btn-lg" type="submit">Send Message <i class="bi bi-arrow-right"></i></button></div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="contact-sidebar">
                    <h3>Get in Touch</h3>
                    <div class="contact-method mt-4"><i class="bi bi-geo-alt"></i><div><strong>Address</strong><p><?= e(setting($pdo, 'address')) ?></p></div></div>
                    <div class="contact-method"><i class="bi bi-envelope"></i><div><strong>Email</strong><p><?= e(setting($pdo, 'email')) ?></p></div></div>
                    <div class="contact-method"><i class="bi bi-telephone"></i><div><strong>Phone</strong><p><?= e(setting($pdo, 'phone')) ?></p></div></div>
                    <div class="contact-method"><i class="bi bi-clock"></i><div><strong>Hours</strong><p>Monday - Friday: 9AM - 6PM<br>Saturday: 10AM - 4PM</p></div></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
