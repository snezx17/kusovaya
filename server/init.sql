CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
CREATE USER 'greg'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password';
GRANT SELECT,UPDATE,INSERT,DELETE ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;


USE appDB;

CREATE TABLE IF NOT EXISTS `accounts`(
	acc_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
  	username VARCHAR(50) NOT NULL,
  	passwords VARCHAR(50) NOT NULL,
  	email VARCHAR(100) NOT NULL,
	Darkmode tinyint(1) NOT NULL
);




INSERT INTO accounts (username, passwords, email, darkmode) VALUES ('admin', 'admin', 'test@test.com','1');
INSERT INTO accounts (username, passwords, email, darkmode) VALUES ('test_user1', 'admin', 'test@test.com','0');
INSERT INTO accounts (username, passwords, email, darkmode) VALUES ('test_user2', 'admin', 'test@test.com','0');
INSERT INTO accounts (username, passwords, email, darkmode) VALUES ('test_user3', 'admin', 'test@test.com','0');

CREATE TABLE IF NOT EXISTS `posts`(
	post_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
  	post_user VARCHAR(50) NOT NULL,
  	post_info VARCHAR(500) NOT NULL
);
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password'; 

