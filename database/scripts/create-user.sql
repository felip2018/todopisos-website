CREATE USER todopisos_user_db@localhost IDENTIFIED BY 'TODOPISOS_2021*';
GRANT ALL PRIVILEGES ON todopisos_db.* TO todopisos_user_db@localhost;
FLUSH PRIVILEGES;
SHOW GRANTS FOR 'todopisos_user_db'@'localhost';