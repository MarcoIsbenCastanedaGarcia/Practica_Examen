-- ============================================================
-- BASE DE DATOS DEL CONSULTORIO NUTRICIONAL
-- ============================================================

CREATE DATABASE IF NOT EXISTS `nutriologo_db`
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;


CREATE USER IF NOT EXISTS
'nutriologo_user'@'localhost'
IDENTIFIED BY
'NutriDB_2026!';


CREATE USER IF NOT EXISTS
'nutriologo_user'@'127.0.0.1'
IDENTIFIED BY
'NutriDB_2026!';


GRANT ALL PRIVILEGES
ON `nutriologo_db`.*
TO
'nutriologo_user'@'localhost';


GRANT ALL PRIVILEGES
ON `nutriologo_db`.*
TO
'nutriologo_user'@'127.0.0.1';


FLUSH PRIVILEGES;