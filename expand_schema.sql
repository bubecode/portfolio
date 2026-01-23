-- Expand Schema for Frontend Compatibility
USE portfolio_db;

-- Update Projects table to match user's expected fields
ALTER TABLE projects CHANGE COLUMN name title VARCHAR(100) NOT NULL;
ALTER TABLE projects CHANGE COLUMN impact_line impact VARCHAR(150) DEFAULT NULL;
ALTER TABLE projects CHANGE COLUMN is_featured featured TINYINT(1) DEFAULT 0;

-- Update Education table
ALTER TABLE education ADD COLUMN period VARCHAR(50) DEFAULT NULL;

-- Update About table
ALTER TABLE about ADD COLUMN quote TEXT DEFAULT NULL;

-- Update Skills table
ALTER TABLE skills ADD COLUMN description VARCHAR(255) DEFAULT NULL;

-- Update Nav Links table
ALTER TABLE nav_links CHANGE COLUMN order_index sort_order INT(11) DEFAULT 0;

-- Create Marquee table
CREATE TABLE IF NOT EXISTS marquee (
  id INT(11) NOT NULL AUTO_INCREMENT,
  text VARCHAR(255) NOT NULL,
  sort_order INT(11) DEFAULT 0,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
