CREATE DATABASE IF NOT EXISTS portfolio_db;
USE portfolio_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS profile (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    title VARCHAR(255),
    hero_text TEXT,
    hero_subtext TEXT,
    location VARCHAR(255),
    timezone VARCHAR(100),
    email VARCHAR(255),
    status VARCHAR(50),
    linkedin VARCHAR(255),
    github VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS about (
    id INT AUTO_INCREMENT PRIMARY KEY,
    section_label VARCHAR(100),
    title VARCHAR(255),
    subtitle VARCHAR(255),
    about_text TEXT,
    personal_statement TEXT
);

CREATE TABLE IF NOT EXISTS about_features (
    id INT AUTO_INCREMENT PRIMARY KEY,
    about_id INT,
    icon VARCHAR(100),
    label VARCHAR(255),
    FOREIGN KEY (about_id) REFERENCES about(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(100),
    name VARCHAR(255),
    title VARCHAR(255),
    description TEXT,
    is_primary BOOLEAN DEFAULT 0
);

CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    description TEXT,
    impact_line VARCHAR(255),
    tech_stack_json JSON,
    is_featured BOOLEAN DEFAULT 0,
    icon VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS experience (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role VARCHAR(255),
    company VARCHAR(255),
    description TEXT,
    start_date VARCHAR(50),
    end_date VARCHAR(50),
    location VARCHAR(255),
    is_featured BOOLEAN DEFAULT 0,
    highlights_json JSON
);

CREATE TABLE IF NOT EXISTS education (
    id INT AUTO_INCREMENT PRIMARY KEY,
    degree VARCHAR(255),
    field VARCHAR(255),
    institution VARCHAR(255),
    year VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS awards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    year VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS stats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    years_experience VARCHAR(50),
    projects_completed VARCHAR(50),
    clients_served VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    description TEXT
);

CREATE TABLE IF NOT EXISTS meta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand_name VARCHAR(100),
    copyright_year VARCHAR(10)
);

CREATE TABLE IF NOT EXISTS nav_links (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    href VARCHAR(255),
    order_index INT DEFAULT 0
);
