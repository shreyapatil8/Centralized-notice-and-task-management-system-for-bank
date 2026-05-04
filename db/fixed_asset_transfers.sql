-- =============================================
-- FIXED ASSET TRANSFERS TABLE
-- Database: demo_project
-- =============================================

CREATE TABLE IF NOT EXISTS `fixed_asset_transfers` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `asset_id` INT NOT NULL,
    `from_branch` VARCHAR(255) NOT NULL,
    `to_branch` VARCHAR(255) NOT NULL,
    `category` VARCHAR(100) NOT NULL,
    `product` VARCHAR(255) NOT NULL,
    `company` VARCHAR(255) DEFAULT NULL,
    `label` VARCHAR(255) DEFAULT NULL,
    `amount` DECIMAL(12,2) DEFAULT 0,
    `status` VARCHAR(100) DEFAULT NULL,
    `transfer_status` VARCHAR(50) DEFAULT 'Pending',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `approved_at` DATETIME DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
