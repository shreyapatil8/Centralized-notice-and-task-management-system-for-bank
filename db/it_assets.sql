-- =============================================
-- IT ASSETS TABLE
-- Database: demo_project
-- =============================================

CREATE TABLE IF NOT EXISTS `it_assets` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `branch_name` VARCHAR(255) NOT NULL,
    `category` VARCHAR(100) NOT NULL,
    `product` VARCHAR(255) NOT NULL,
    `serial_id` VARCHAR(255) DEFAULT NULL,
    `label_name` VARCHAR(255) DEFAULT NULL,
    `status` VARCHAR(100) DEFAULT 'Available',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
