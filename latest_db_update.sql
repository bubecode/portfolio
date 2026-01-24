-- Database Update: 2026-01-24
-- Add new columns to profile table
ALTER TABLE `profile` 
ADD COLUMN `hero_subtext` TEXT AFTER `hero_text`,
ADD COLUMN `timezone` VARCHAR(100) AFTER `location`,
ADD COLUMN `linkedin` VARCHAR(255) AFTER `status`,
ADD COLUMN `github` VARCHAR(255) AFTER `linkedin`;

-- Cleanup duplicate navigation links
DELETE n1 FROM nav_links n1
INNER JOIN nav_links n2 
WHERE n1.id > n2.id 
AND n1.name = n2.name 
AND n1.href = n2.href;
