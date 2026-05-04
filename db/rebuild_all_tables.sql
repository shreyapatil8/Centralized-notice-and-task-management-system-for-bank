-- ==========================================================
-- Rebuild ALL broken tables for demo_project
-- These tables have orphaned .frm/.ibd files (InnoDB corruption)
-- Fix: stop MySQL → delete orphaned files → restart → run this SQL
-- ==========================================================

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET NAMES utf8mb4;

-- ----------------------------------------------------------
-- 1. circulars
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `circulars`;
CREATE TABLE `circulars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `circular_no` varchar(100) NOT NULL,
  `title` text NOT NULL,
  `department` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `original_file_name` varchar(255) DEFAULT NULL,
  `publish_date` date NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------------------------------------
-- 2. departments
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed departments
INSERT INTO `departments` (`department_name`) VALUES
('Data Center (DC)'),
('स्टेशनरी'),
('टपाल'),
('इतर सहकारी संस्था कर्ज - बचत गट'),
('ईएसडी.'),
('ऑडिट/इन्स्पे.'),
('वसुली'),
('कायदा'),
('कृषी औद्योगिक सह. संस्था कर्ज'),
('शेती कर्ज'),
('इतर सहकारी संस्था कर्ज'),
('सचिवालय'),
('अकाउंट्स / बँकिंग'),
('नियोजन'),
('प्रशासन'),
('आय.टी.'),
('सीकेवायसी'),
('एच.आर.'),
('फंड मॅनेजमेंट'),
('सिस्टीम ऑडिट'),
('CKYC'),
('बोर्ड'),
('Disaster Recovery (DR)');

-- ----------------------------------------------------------
-- 3. inwards
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `inwards`;
CREATE TABLE `inwards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inward_no` int(11) NOT NULL,
  `letter_date` date NOT NULL,
  `inward_from` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `entry_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `inward_no` (`inward_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------------------------------------
-- 4. outwards
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `outwards`;
CREATE TABLE `outwards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `outward_no` int(11) NOT NULL,
  `outward_title` varchar(255) NOT NULL,
  `entry_by` varchar(255) NOT NULL,
  `outward_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `entry_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `outward_no` (`outward_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------------------------------------
-- 5. news
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `summary` text NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------------------------------------
-- 6. portal_policies
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `portal_policies`;
CREATE TABLE `portal_policies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `policy_key` varchar(100) DEFAULT NULL,
  `policy_title` varchar(255) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed default policies
INSERT INTO `portal_policies` (`policy_key`, `policy_title`) VALUES
('it_policy', 'आयटी धोरण'),
('cyber_security', 'सायबर सिक्युरिटी धोरण');

-- ----------------------------------------------------------
-- 7. portal_blocks
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `portal_blocks`;
CREATE TABLE `portal_blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `block_title` varchar(255) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_type` varchar(20) DEFAULT 'pdf',
  `color_class` varchar(100) DEFAULT '',
  `display_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------------------------------------
-- 8. employees (legacy – not actively used but has disk files)
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------------------------------------
-- 9. notices (legacy – not actively used but has disk files)
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `notices`;
CREATE TABLE `notices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS=1;
