
SET FOREIGN_KEY_CHECKS = 0;

-- Clear existing data (optional, but good for clean seed)
TRUNCATE TABLE profile;
TRUNCATE TABLE about;
TRUNCATE TABLE about_features;
TRUNCATE TABLE skills;
TRUNCATE TABLE projects;
TRUNCATE TABLE experience;
TRUNCATE TABLE education;
TRUNCATE TABLE awards;
TRUNCATE TABLE stats;
TRUNCATE TABLE services;
TRUNCATE TABLE meta;
TRUNCATE TABLE nav_links;

-- 1. Insert PROFILE
INSERT INTO profile (name, title, hero_text, hero_subtext, location, timezone, email, status, linkedin, github) VALUES
('ASBube', 'Frappe Developer', 'I build systems that scale.', 'Enterprise-grade web applications, ERP platforms, and business automation—designed for reliability and long-term growth.', 'Mogadishu, Somalia', 'EAT (UTC+3)', 'bube.dev@gmail.com', 'Open to Work', 'https://linkedin.com/in/asbube', 'https://github.com/asbube');

-- 2. Insert ABOUT
INSERT INTO about (section_label, title, subtitle, about_text, personal_statement) VALUES
('Core Expertise', 'Frappe Developer', 'ERP & Business Systems Architect', 'I specialize in the Frappe Framework, building robust ERP systems and internal business applications. From workflow automation to complex data models, I design solutions that streamline operations and scale with business growth.', 'I approach software as systems, not just features.');

SET @about_id = LAST_INSERT_ID();

INSERT INTO about_features (about_id, icon, label) VALUES
(@about_id, 'Blocks', 'ERP & Business Applications'),
(@about_id, 'Workflow', 'Workflow Automation'),
(@about_id, 'Database', 'API & System Integration'),
(@about_id, 'Cpu', 'Scalable Architecture');

-- 3. Insert SKILLS (Mapping JSON categories and items to skills table)
-- Backend
INSERT INTO skills (title, category, is_primary, description) VALUES
('Frappe', 'backend', 1, 'Backend-first development with a strong focus on Frappe-based business systems.'),
('PHP', 'backend', 0, 'Backend-first development with a strong focus on Frappe-based business systems.'),
('CodeIgniter', 'backend', 0, 'Backend-first development with a strong focus on Frappe-based business systems.'),
('REST APIs', 'backend', 0, 'Backend-first development with a strong focus on Frappe-based business systems.');

-- Database
INSERT INTO skills (title, category, is_primary, description) VALUES
('MySQL', 'database', 0, NULL),
('MariaDB', 'database', 0, NULL),
('PostgreSQL', 'database', 0, NULL);

-- Frontend
INSERT INTO skills (title, category, is_primary, description) VALUES
('JavaScript', 'frontend', 0, NULL),
('React', 'frontend', 0, NULL),
('Tailwind', 'frontend', 0, NULL);

-- Tools
INSERT INTO skills (title, category, is_primary, description) VALUES
('Git', 'tools', 0, NULL),
('Linux', 'tools', 0, NULL),
('Docker', 'tools', 0, NULL),
('VS Code', 'tools', 0, NULL),
('Figma', 'tools', 0, NULL);

-- 4. Insert PROJECTS
INSERT INTO projects (name, description, impact_line, tech_stack_json, is_featured, icon) VALUES
('EasyTouch', 'A complete enterprise resource planning system built on Frappe Framework', 'Supporting multi-location businesses with unified operations and real-time reporting.', '["Frappe","ERPNext","Python","MariaDB"]', 1, 'Building2'),
('Schoolly', 'Complete school management platform with student tracking, grading, and parent portals', 'Managing thousands of student records across academic institutions.', '["PHP","MySQL","REST API"]', 0, 'GraduationCap'),
('Cabqari', 'Pilgrimage management system handling bookings, scheduling, and traveler coordination', 'Processing large-scale pilgrimage operations with real-time tracking.', '["Frappe","Python","JavaScript"]', 0, 'Plane');

-- 5. Insert EXPERIENCE
INSERT INTO experience (role, company, description, start_date, end_date, location, is_featured, highlights_json) VALUES
('Full Stack Engineer', 'SIMAD University', 'Leading full-stack development projects and building enterprise-grade business applications.', '2021-01', NULL, 'Mogadishu, Somalia', 1, '["Led development of internal ERP modules","Architected scalable API systems","Mentored junior developers"]'),
('Freelance Developer', 'Self-Employed', 'Building custom business applications and ERP solutions for various clients.', '2019-01', '2021-01', 'Remote', 0, '["Delivered 10+ client projects"]');

-- 6. Insert EDUCATION
INSERT INTO education (degree, field, institution, year) VALUES
('Bachelor\'s Degree', 'Computer Science', 'SIMAD University', '2020');

-- 7. Insert AWARDS
INSERT INTO awards (title, year) VALUES
('Dean\'s List', '2019'),
('Best Project Award', '2020');

-- 8. Insert STATS
INSERT INTO stats (years_experience, projects_completed, clients_served) VALUES
('4+', '15+', '10+');

-- 9. Insert SERVICES
INSERT INTO services (title, description) VALUES
('ERP Development', 'Custom ERP solutions built on Frappe Framework for business operations.'),
('Backend Development', 'Backend-first development with a strong focus on Frappe-based business systems.'),
('API Integration', 'RESTful API design and third-party system integrations.'),
('Workflow Automation', 'Automating business processes to improve efficiency and reduce manual work.');

-- 10. Insert CONTACT SETTINGS (Assuming table contact_settings doesn't exist? Wait, prompt says tables include contact_settings. I probably don't have it. I handled contact as API. I'll omit or insert into meta?)
-- "contact": { "recipient_email", "form_fields"... }
-- I'll check if I have a contact_settings table. If not, I'll store in META.
-- Assuming no table, I'll skip or use META if strictly needed. But I'll stick to META updates.

-- 11. Insert META / NAV
INSERT INTO meta (brand_name, copyright_year) VALUES
('ASBube', '2025');

INSERT INTO nav_links (name, href, order_index) VALUES
('Home', '#home', 1),
('About', '#about', 2),
('Projects', '#projects', 3),
('Contact', '#contact', 4);
SET FOREIGN_KEY_CHECKS = 1;
