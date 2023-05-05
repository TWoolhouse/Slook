CREATE TABLE User (
	uid INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	email VARCHAR(32) NOT NULL UNIQUE,
	name VARCHAR(32),
	password CHAR(60),
	role TINYINT UNSIGNED
);

CREATE TABLE Thread (
	uid INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(32)
);

CREATE TABLE Message (
	uid BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	thread INT UNSIGNED NOT NULL,
	owner INT UNSIGNED NOT NULL,
	content VARCHAR(128) NOT NULL,
	created DATETIME DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (thread) REFERENCES Thread(uid) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (owner) REFERENCES User(uid) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE ThreadViewer (
	thread INT UNSIGNED NOT NULL,
	user INT UNSIGNED NOT NULL,
	FOREIGN KEY (thread) REFERENCES Thread(uid) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (user) REFERENCES User(uid) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Project (
	uid INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(128),
	leader INT UNSIGNED NOT NULL,
	FOREIGN KEY (leader) REFERENCES User(uid) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Task (
	uid INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(60) NOT NULL,
	wokerhours INT UNSIGNED,
	created DATETIME DEFAULT CURRENT_TIMESTAMP,
	started DATETIME,
	completed DATETIME
);

CREATE TABLE ProjectTask (
	task INT UNSIGNED,
	project INT UNSIGNED,
	FOREIGN KEY (task) REFERENCES Task(uid) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (project) REFERENCES Project(uid) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT PT_BindingPK PRIMARY KEY (task,project)
);


CREATE TABLE TaskUser (
	user INT UNSIGNED,
	task INT UNSIGNED,
	FOREIGN KEY (user) REFERENCES User(uid) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (task) REFERENCES Task(uid) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT TU_BindingPK PRIMARY KEY (user, task)
);

/*INSERTING DATA INTO DB FOR DATA ANALYTICS*/

INSERT INTO `User` (email, name, password, role) VALUES ("louiemthomas02@gmail.com", "Louie Thomas", "SecurePassword123", 1);

INSERT INTO `User` (email, name, password, role) VALUES ("adalovelace1@make-it-all.com", "Ada Lovelace", "LaceLover01", 3);

INSERT INTO `User` (email, name, password, role) VALUES ("bertthebuilder@make-it-all.com", "Bert Smith", "BertieIsTheBest1!", 2);

INSERT INTO `User` (email, name, password, role) VALUES ("clarajohnson01@make-it-all.com", "Clara Johnson", "MeEncantaEspana2006", 2);

INSERT INTO `User` (email, name, password, role) VALUES ("dilip-the-dodo@make-it-all.com", "Dilip Schmidt", "IAmNotADodo123", 1);

INSERT INTO `User` (email, name, password, role) VALUES ("emilysgarn1996@make-it-all.com", "Emily Garn", "EmmaStone2006", 3);

INSERT INTO `Project` (name, leader) VALUES ("Spring Cleaning", 1);

INSERT INTO `Project` (name, leader) VALUES ("Destroying the One Ring", 3);

INSERT INTO `Task` (wokerhours, name) VALUES (4368, "Walking to Mordor");

INSERT INTO `Task` (wokerhours, name) VALUES (192, "Attend the Council of Elrond");

INSERT INTO `Task` (wokerhours, name) VALUES (432, "Pass through the Mines of Moria");

INSERT INTO `Task` (wokerhours, name) VALUES (2, "Tidy up Room");

INSERT INTO `Task` (wokerhours, name) VALUES (1, "Go down to the Tip");

INSERT INTO `Task` (wokerhours, name) VALUES (2, "Vacuum House");

INSERT INTO `ProjectTask` VALUES (1, 2), (2, 2), (3, 2);
INSERT INTO `ProjectTask` VALUES (4, 1), (5, 1), (6, 1);

INSERT INTO `TaskUser` VALUES (2,3) , (4,3) , (4,1) , (2,6) , (3,2) , (1,5) , (3,1) , (3,1);