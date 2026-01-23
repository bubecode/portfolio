CREATE TABLE IF NOT EXISTS meta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand_name VARCHAR(255) DEFAULT 'ASBube',
    copyright_year VARCHAR(10) DEFAULT '2026'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO meta (brand_name, copyright_year) VALUES ('ASBube', '2026') ON DUPLICATE KEY UPDATE id=id;

CREATE TABLE IF NOT EXISTS nav_links (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    href VARCHAR(255) NOT NULL,
    order_index INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO nav_links (name, href, order_index) VALUES 
('Home', '#home', 1),
('About', '#about', 2),
('Skills', '#skills', 3),
('Projects', '#projects', 4),
('Experience', '#experience', 5),
('Contact', '#contact', 6);
