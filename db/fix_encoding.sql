-- Fix Marathi text encoding for all affected tables
-- Must be imported with: mysql --default-character-set=utf8mb4

SET NAMES utf8mb4;

-- Fix departments
TRUNCATE TABLE departments;
INSERT INTO departments (department_name) VALUES
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

-- Fix users (branch_name was corrupted)
UPDATE users SET branch_name = 'कुंडल' WHERE username = 'kundal_admin';
UPDATE users SET branch_name = 'कुंडल' WHERE username = 'kundal_employee';

-- Fix portal_policies
UPDATE portal_policies SET policy_title = 'आयटी धोरण' WHERE policy_key = 'it_policy';
UPDATE portal_policies SET policy_title = 'सायबर सिक्युरिटी धोरण' WHERE policy_key = 'cyber_security';
