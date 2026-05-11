CREATE DATABASE IF NOT EXISTS nirmal_council CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE nirmal_council;

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    username VARCHAR(60) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS site_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT NULL
);

CREATE TABLE IF NOT EXISTS programs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(180) NOT NULL,
    description TEXT NOT NULL,
    icon VARCHAR(80) DEFAULT 'bi-heart',
    image_url TEXT,
    sort_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS team_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(140) NOT NULL,
    designation VARCHAR(140) NOT NULL,
    bio TEXT,
    image_url TEXT,
    sort_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS impact_stories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(180) NOT NULL,
    description TEXT,
    image_url TEXT,
    sort_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS partners (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(180) NOT NULL,
    website_url TEXT,
    sort_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS knowledge_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    category VARCHAR(90) DEFAULT 'Resource',
    excerpt TEXT,
    body TEXT,
    image_url TEXT,
    sort_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS gallery_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(180) NOT NULL,
    description TEXT,
    image_url TEXT,
    sort_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(140) NOT NULL,
    email VARCHAR(180) NOT NULL,
    phone VARCHAR(40),
    subject VARCHAR(180),
    message TEXT NOT NULL,
    status VARCHAR(40) DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(140) NOT NULL,
    email VARCHAR(180) NOT NULL,
    phone VARCHAR(40) NOT NULL,
    city VARCHAR(120),
    interest VARCHAR(120),
    preferred_time VARCHAR(120),
    message TEXT,
    status VARCHAR(40) DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS newsletter_subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(180) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO admins (name, username, password_hash)
VALUES ('Site Administrator', 'admin', '$2y$10$rBjZZksQk2yPwMctUidFl.mYWFrQrXv9gMlDg7oJSmsAHrnd.nsD.')
ON DUPLICATE KEY UPDATE username = username;

INSERT INTO site_settings (setting_key, setting_value) VALUES
('site_name', 'NIRMAL Council'),
('meta_description', 'NIRMAL Council works for rehabilitation, skills, livelihoods, and community empowerment.'),
('phone', '+91 7991226377'),
('email', 'support@nirmalc.org'),
('address', 'Ground Floor 94/A, Gaur City Center, Sec 4, Greater Noida (W), Uttar Pradesh-201318, INDIA'),
('logo_url', 'https://nirmalc.org/assets/img/logo.png'),
('hero_title', 'Empowering Communities. Restoring Dignity. Building Futures'),
('hero_subtitle', 'The NIRMAL Council transforms lives through rehabilitation, skill development, and livelihood programs, empowering rural and riverine communities to achieve independence, inclusion, and lasting change.'),
('hero_image', 'https://nirmalc.org/assets/img/about/about-8.jpeg'),
('twitter_url', 'https://x.com/nirmalcouncil'),
('facebook_url', '#'),
('instagram_url', 'https://www.instagram.com/nirmalcouncil/'),
('linkedin_url', 'https://www.linkedin.com/in/nirmal-council-a1a672395/')
ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value);

INSERT INTO programs (title, description, icon, image_url, sort_order) VALUES
('Community Empowerment', 'Inclusive opportunities for women, youth, and marginalized groups through sustainable livelihood and skill training programs.', 'bi-graph-up', 'https://nirmalc.org/assets/img/about/about-8.jpeg', 1),
('Rehabilitation and Inclusion', 'Holistic support for individuals with disabilities through education, employment readiness, and social participation.', 'bi-lightbulb', 'https://nirmalc.org/assets/uploads/gallery/media/gallery_20260430145721_2015.jpeg', 2),
('Sustainable Livelihoods', 'Capacity building, micro-enterprise development, and eco-friendly livelihood models for self-reliant communities.', 'bi-people', 'https://nirmalc.org/assets/uploads/gallery/media/gallery_20260430145721_5939.jpeg', 3)
ON DUPLICATE KEY UPDATE title = title;

INSERT INTO team_members (name, designation, bio, image_url, sort_order) VALUES
('Mamta Yadav', 'Director', 'A social leader focused on community development, social welfare, and grassroots empowerment.', 'https://nirmalc.org/assets/img/team/mamta_yadav.png', 1),
('Priyanka Mishra', 'Director', 'A health professional and social worker committed to public health and humanitarian service.', 'https://nirmalc.org/assets/img/team/priyanka_mishra.png', 2),
('Jahnavee Singh', 'Director', 'An educator and community development professional working for inclusive education and social transformation.', 'https://nirmalc.org/assets/img/team/jahnavee_singh.png', 3)
ON DUPLICATE KEY UPDATE name = name;

INSERT INTO impact_stories (title, description, image_url, sort_order) VALUES
('Health Awareness Camp', 'Community members participated in awareness sessions focused on preventive health and well-being.', 'https://nirmalc.org/assets/uploads/gallery/media/gallery_20260430145721_3482.jpeg', 1),
('Skill Building Session', 'Youth and women joined practical sessions to strengthen confidence and livelihood readiness.', 'https://nirmalc.org/assets/uploads/gallery/media/gallery_20260430145721_8141.jpeg', 2),
('Community Participation', 'Local stakeholders helped shape program priorities through inclusive dialogue.', 'https://nirmalc.org/assets/uploads/gallery/media/gallery_20260430145722_7112.png', 3)
ON DUPLICATE KEY UPDATE title = title;

INSERT INTO partners (name, website_url, sort_order) VALUES
('Government Bodies', '#', 1),
('Local NGOs', '#', 2),
('Community Institutions', '#', 3),
('Private Partners', '#', 4)
ON DUPLICATE KEY UPDATE name = name;

INSERT INTO knowledge_posts (title, category, excerpt, body, image_url, sort_order) VALUES
('Community Based Rehabilitation', 'Resource', 'A practical note on rehabilitation rooted in community participation.', 'Community based rehabilitation works best when local stakeholders participate in planning, delivery, and follow-up.', 'https://nirmalc.org/assets/uploads/gallery/media/gallery_20260430145721_5240.jpeg', 1),
('Livelihoods for Inclusion', 'Field Note', 'How skill training and enterprise support can restore dignity.', 'Sustainable livelihoods require market-linked skills, mentorship, and long-term community support.', 'https://nirmalc.org/assets/uploads/gallery/media/gallery_20260430150907_6724.jpeg', 2),
('Women and Youth Empowerment', 'Update', 'Program directions for women and youth focused opportunities.', 'Empowerment programs combine confidence building, training, access, and supportive networks.', 'https://nirmalc.org/assets/uploads/gallery/media/gallery_20260430145721_9882.jpeg', 3)
ON DUPLICATE KEY UPDATE title = title;

INSERT INTO gallery_items (title, description, image_url, sort_order) VALUES
('Community Empowerment and Health Awareness Camp', 'Field activity with community participation.', 'https://nirmalc.org/assets/uploads/gallery/media/gallery_20260430145721_2015.jpeg', 1),
('Awareness Session', 'Health and inclusion focused session.', 'https://nirmalc.org/assets/uploads/gallery/media/gallery_20260430145721_5939.jpeg', 2),
('Livelihood Interaction', 'Community dialogue and capacity building.', 'https://nirmalc.org/assets/uploads/gallery/media/gallery_20260430145721_3482.jpeg', 3),
('Training Activity', 'Skill and confidence building activity.', 'https://nirmalc.org/assets/uploads/gallery/media/gallery_20260430145721_8141.jpeg', 4),
('Program Gathering', 'Local beneficiaries and stakeholders.', 'https://nirmalc.org/assets/uploads/gallery/media/gallery_20260430145722_7112.png', 5),
('Community Outreach', 'Outreach program documentation.', 'https://nirmalc.org/assets/uploads/gallery/media/gallery_20260430145721_5240.jpeg', 6)
ON DUPLICATE KEY UPDATE title = title;
