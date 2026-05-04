-- Users table for demo_project
-- Required by: index.php (login), manage-users.php, add-profile.php, edit-profile.php, change-password.php

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'employee',
  `branch_name` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed users (password: 1020 → md5 hash: 65cc2c8205a05d7379fa3a6386f710e1)
INSERT INTO `users` (`username`, `password`, `role`, `branch_name`, `is_active`) VALUES
('kundal_admin', '65cc2c8205a05d7379fa3a6386f710e1', 'admin', 'कुंडल', 1);

INSERT INTO `users` (`username`, `password`, `role`, `branch_name`, `is_active`) VALUES
('kundal_employee', '65cc2c8205a05d7379fa3a6386f710e1', 'employee', 'कुंडल', 1);
