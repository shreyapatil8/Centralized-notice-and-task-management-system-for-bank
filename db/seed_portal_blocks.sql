-- Restore portal_blocks data from screenshot
SET NAMES utf8mb4;

TRUNCATE TABLE portal_blocks;

INSERT INTO portal_blocks (block_title, file_type, file_name, color_class, display_order, is_active) VALUES
('Current Society Acc. Opened in Person ID List', 'excel', NULL, '', 1, 1),
('शासकीय अनुदान माहिती', 'excel', NULL, '', 2, 1),
('भाग १ व २ Index PDF', 'pdf', '1775303803_Experiment No 0.pdf', '', 3, 1),
('भाग २ सर्व फॉर्म PDF', 'pdf', NULL, '', 4, 1),
('भाग २ सर्व फॉर्म excel', 'excel', NULL, '', 5, 1),
('CKYC Policy', 'pdf', NULL, '', 6, 1);
