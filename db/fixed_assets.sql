-- =========================================================
-- FIXED ASSETS MODULE — Database Table
-- Run this SQL in phpMyAdmin on database: demo_project
-- =========================================================

DROP TABLE IF EXISTS fixed_assets;

CREATE TABLE fixed_assets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATE,
    branch VARCHAR(255),
    category VARCHAR(100),
    product VARCHAR(255),
    company VARCHAR(255),
    rate DECIMAL(10,2),
    quantity INT,
    amount DECIMAL(10,2),
    serial_no VARCHAR(255),
    label VARCHAR(255),
    status VARCHAR(100) DEFAULT 'Available',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
