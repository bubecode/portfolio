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
DROP TABLE IF EXISTS `contacts`;
DROP TABLE IF EXISTS `testimonials`;
-- Drop legacy tables if they exist
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `about_features`;
DROP TABLE IF EXISTS `meta`;
DROP TABLE IF EXISTS `nav_links`;
DROP TABLE IF EXISTS `contact_messages`;

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
  `profile_image` VARCHAR(255) DEFAULT NULL,
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
  `quote` TEXT DEFAULT NULL,
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
  `description` TEXT DEFAULT NULL,
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
  `featured` BOOLEAN DEFAULT FALSE,
  `project_url` VARCHAR(255),
  `tech_stack` TEXT DEFAULT NULL,
  `icon` VARCHAR(50) DEFAULT NULL,
  `sort_order` TINYINT UNSIGNED DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
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
  `featured` BOOLEAN DEFAULT FALSE,
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
  `year` YEAR,
  `set_order` INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Education
CREATE TABLE `education` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `degree` VARCHAR(100) NOT NULL,
  `institution` VARCHAR(150) NOT NULL,
  `year` YEAR,
  `period` VARCHAR(50) DEFAULT NULL
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
  `ip_address` VARCHAR(45) NULL,
  `user_agent` TEXT NULL,
  `is_read` BOOLEAN DEFAULT FALSE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Testimonials
CREATE TABLE `testimonials` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `role` VARCHAR(255) DEFAULT NULL,
  `company` VARCHAR(255) DEFAULT NULL,
  `message` TEXT NOT NULL,
  `rating` INT DEFAULT 5,
  `person_image` VARCHAR(255) DEFAULT NULL,
  `company_logo` VARCHAR(255) DEFAULT NULL,
  `featured` TINYINT(1) DEFAULT 0,
  `status` ENUM('active', 'inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Core Config / Meta Data
CREATE TABLE `meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meta_key` varchar(255) NOT NULL,
  `meta_value` text NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `nav_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Default Data
INSERT INTO `nav_links` (`label`, `url`, `sort_order`) VALUES 
('Home', '#', 1),
('About', '#about', 2),
('Experience', '#experience', 3),
('Projects', '#projects', 4),
('Contact', '#contact', 5);

INSERT INTO `meta` (`meta_key`, `meta_value`, `sort_order`) VALUES 
('marquee_text', 'Building the future with code • ERP Solutions • Full Stack Development • Available for new opportunities •', 1);

-- Profile
INSERT INTO `profile` (`id`, `name`, `title`, `hero_text`, `tagline`, `location`, `email`, `status`) 
VALUES (1, 'Ahmed Salah', 'High Performance Developer', 'I Build World-Class Scalable Applications', 'Experience in developing enterprise-level business applications, ERP systems, and modern web platforms.', 'Remote/Global', 'bube.dev@gmail.com', 'Available for hire');
