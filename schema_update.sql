SET FOREIGN_KEY_CHECKS = 0;

-- Drop all existing tables
DROP TABLE IF EXISTS `profile`;
DROP TABLE IF EXISTS `about`;
DROP TABLE IF EXISTS `core_expertise`;
DROP TABLE IF EXISTS `skill_categories`;
DROP TABLE IF EXISTS `skills`;
DROP TABLE IF EXISTS `projects`;
DROP TABLE IF EXISTS `project_tech`;
DROP TABLE IF EXISTS `experience`;
DROP TABLE IF EXISTS `experience_highlights`;
DROP TABLE IF EXISTS `awards`;
DROP TABLE IF EXISTS `education`;
DROP TABLE IF EXISTS `stats`;
DROP TABLE IF EXISTS `services`;
DROP TABLE IF EXISTS `social_links`;
DROP TABLE IF EXISTS `contact_messages`;
-- Drop legacy tables if they exist
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `about_features`;
DROP TABLE IF EXISTS `meta`;
DROP TABLE IF EXISTS `nav_links`;

SET FOREIGN_KEY_CHECKS = 1;

-- Profile table
CREATE TABLE `profile` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `title` VARCHAR(100) NOT NULL,
  `hero_text` VARCHAR(255) NOT NULL,
  `tagline` TEXT,
  `location` VARCHAR(100),
  `email` VARCHAR(150) NOT NULL,
  `status` VARCHAR(50) DEFAULT 'Available',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- About table
CREATE TABLE `about` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `profile_id` INT UNSIGNED NOT NULL,
  `role` VARCHAR(100) NOT NULL,
  `about_text` TEXT NOT NULL,
  `personal_statement` VARCHAR(255),
  FOREIGN KEY (`profile_id`) REFERENCES `profile`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Core expertise (linked to about)
CREATE TABLE `core_expertise` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `about_id` INT UNSIGNED NOT NULL,
  `expertise` VARCHAR(100) NOT NULL,
  `sort_order` TINYINT UNSIGNED DEFAULT 0,
  FOREIGN KEY (`about_id`) REFERENCES `about`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Skill categories
CREATE TABLE `skill_categories` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50) NOT NULL,
  `sort_order` TINYINT UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Skills
CREATE TABLE `skills` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `category_id` INT UNSIGNED NOT NULL,
  `name` VARCHAR(50) NOT NULL,
  `is_primary` BOOLEAN DEFAULT FALSE,
  `sort_order` TINYINT UNSIGNED DEFAULT 0,
  FOREIGN KEY (`category_id`) REFERENCES `skill_categories`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Projects
CREATE TABLE `projects` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT NOT NULL,
  `impact_line` VARCHAR(100),
  `is_featured` BOOLEAN DEFAULT FALSE,
  `project_url` VARCHAR(255),
  `sort_order` TINYINT UNSIGNED DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Project tech stack
CREATE TABLE `project_tech` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `project_id` INT UNSIGNED NOT NULL,
  `tech_name` VARCHAR(50) NOT NULL,
  `sort_order` TINYINT UNSIGNED DEFAULT 0,
  FOREIGN KEY (`project_id`) REFERENCES `projects`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Experience
CREATE TABLE `experience` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `role` VARCHAR(100) NOT NULL,
  `company` VARCHAR(100) NOT NULL,
  `description` TEXT,
  `start_date` DATE NOT NULL,
  `end_date` DATE DEFAULT NULL,
  `location` VARCHAR(100),
  `is_featured` BOOLEAN DEFAULT FALSE,
  `sort_order` TINYINT UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Experience highlights
CREATE TABLE `experience_highlights` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `experience_id` INT UNSIGNED NOT NULL,
  `highlight` VARCHAR(255) NOT NULL,
  `sort_order` TINYINT UNSIGNED DEFAULT 0,
  FOREIGN KEY (`experience_id`) REFERENCES `experience`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Awards
CREATE TABLE `awards` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(100) NOT NULL,
  `organization` VARCHAR(100) NOT NULL,
  `description` TEXT,
  `year` YEAR
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Education
CREATE TABLE `education` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `degree` VARCHAR(100) NOT NULL,
  `institution` VARCHAR(150) NOT NULL,
  `year` YEAR
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Stats
CREATE TABLE `stats` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `profile_id` INT UNSIGNED NOT NULL,
  `stat_key` VARCHAR(50) NOT NULL,
  `stat_value` VARCHAR(50) NOT NULL,
  FOREIGN KEY (`profile_id`) REFERENCES `profile`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Services
CREATE TABLE `services` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(100) NOT NULL,
  `description` TEXT NOT NULL,
  `icon` VARCHAR(50),
  `sort_order` TINYINT UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Social links
CREATE TABLE `social_links` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `platform` VARCHAR(50) NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  `handle` VARCHAR(100),
  `sort_order` TINYINT UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Contact messages (for form submissions)
CREATE TABLE `contact_messages` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `message` TEXT NOT NULL,
  `is_read` BOOLEAN DEFAULT FALSE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Profile
INSERT INTO `profile` (`id`, `name`, `title`, `hero_text`, `tagline`, `location`, `email`, `status`) 
VALUES (1, 'ASBube', 'Frappe Developer', 'I build systems that scale.', 'Enterprise-grade web applications, ERP platforms, and business automation—designed for reliability and long-term growth.', 'Philippines', 'bube.dev@gmail.com', 'Open to Work');

-- About
INSERT INTO `about` (`id`, `profile_id`, `role`, `about_text`, `personal_statement`) 
VALUES (1, 1, 'ERP & Business Systems Architect', 'I specialize in the Frappe Framework, building robust ERP systems and internal business applications. From workflow automation to complex data models, I design solutions that streamline operations and scale with business growth.', 'I approach software as systems, not just features.');

-- Core Expertise
INSERT INTO `core_expertise` (`about_id`, `expertise`, `sort_order`) VALUES 
(1, 'ERP & Business Applications', 1),
(1, 'Workflow Automation', 2),
(1, 'API & System Integration', 3),
(1, 'Scalable Architecture', 4);

-- Skill Categories
INSERT INTO `skill_categories` (`id`, `name`, `sort_order`) VALUES 
(1, 'Backend', 1),
(2, 'Database', 2),
(3, 'Frontend', 3),
(4, 'Tools', 4);

-- Skills
INSERT INTO `skills` (`category_id`, `name`, `is_primary`, `sort_order`) VALUES 
(1, 'Frappe', TRUE, 1),
(1, 'PHP', FALSE, 2),
(1, 'CodeIgniter', FALSE, 3),
(1, 'REST APIs', FALSE, 4),
(2, 'MySQL', FALSE, 1),
(2, 'MariaDB', FALSE, 2),
(2, 'PostgreSQL', FALSE, 3),
(3, 'JavaScript', FALSE, 1),
(3, 'React', FALSE, 2),
(3, 'Tailwind', FALSE, 3),
(4, 'Git', FALSE, 1),
(4, 'Linux', FALSE, 2),
(4, 'Docker', FALSE, 3),
(4, 'VS Code', FALSE, 4),
(4, 'Figma', FALSE, 5);

-- Projects
INSERT INTO `projects` (`id`, `name`, `description`, `impact_line`, `is_featured`, `sort_order`) VALUES 
(1, 'EasyTouch', 'POS & Retail System — Multi-branch POS with inventory sync and sales analytics dashboard.', '40% faster checkout times', TRUE, 1),
(2, 'Schoolly', 'School Management System — Complete student lifecycle management from enrollment to graduation.', 'Serving 5+ institutions', FALSE, 2),
(3, 'Cabqari', 'Inventory Management — Real-time stock tracking and automated reorder workflows.', '30% reduction in stockouts', FALSE, 3);

-- Project Tech Stack
INSERT INTO `project_tech` (`project_id`, `tech_name`, `sort_order`) VALUES 
(1, 'Frappe', 1),
(1, 'ERPNext', 2),
(1, 'Python', 3),
(1, 'MariaDB', 4),
(2, 'Frappe', 1),
(2, 'Python', 2),
(2, 'JavaScript', 3),
(3, 'PHP', 1),
(3, 'CodeIgniter', 2),
(3, 'MySQL', 3);

-- Experience
INSERT INTO `experience` (`id`, `role`, `company`, `description`, `start_date`, `end_date`, `location`, `is_featured`, `sort_order`) VALUES 
(1, 'Full Stack Engineer', 'YoolTech', 'Led development of enterprise ERP modules and business automation systems.', '2022-01-01', NULL, 'Remote', TRUE, 1),
(2, 'Software Developer', 'Previous Company', 'Developed and maintained web applications using PHP and JavaScript.', '2020-06-01', '2021-12-31', 'On-site', FALSE, 2);

-- Experience Highlights
INSERT INTO `experience_highlights` (`experience_id`, `highlight`, `sort_order`) VALUES 
(1, 'Built 5+ custom Frappe apps for enterprise clients', 1),
(1, 'Reduced system downtime by 60% through optimization', 2),
(1, 'Mentored junior developers on best practices', 3),
(2, 'Full-stack development', 1),
(2, 'API integrations', 2);

-- Awards
INSERT INTO `awards` (`title`, `organization`, `description`, `year`) VALUES 
('Best Employee 2023', 'YoolTech', 'Recognized for delivering high-impact enterprise solutions', 2023);

-- Education
INSERT INTO `education` (`degree`, `institution`, `year`) VALUES 
('BS Information Technology', 'University', 2020);

-- Stats
INSERT INTO `stats` (`profile_id`, `stat_key`, `stat_value`) VALUES 
(1, 'years_experience', '3+'),
(1, 'projects_completed', '10+');

-- Services
INSERT INTO `services` (`id`, `title`, `description`, `sort_order`) VALUES 
(1, 'ERP Development', 'Custom Frappe/ERPNext solutions tailored to your business processes.', 1),
(2, 'Workflow Automation', 'Streamline operations with automated business workflows and integrations.', 2),
(3, 'API Integration', 'Connect your systems with third-party services and custom APIs.', 3),
(4, 'System Architecture', 'Design scalable, maintainable backend architectures for growth.', 4);

-- Social Links
INSERT INTO `social_links` (`platform`, `url`, `handle`, `sort_order`) VALUES 
('LinkedIn', 'https://linkedin.com/in/asbube', '@asbube', 1),
('GitHub', 'https://github.com/asbube', '@asbube', 2),
('Email', 'mailto:bube.dev@gmail.com', 'bube.dev', 3);
