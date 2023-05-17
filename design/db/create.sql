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
	workerhours INT UNSIGNED,
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

/* FAUX DATA */

INSERT INTO `User` (email, name, password, role) VALUES ("adalovelace1@make-it-all.co.uk", "Ada Lovelace", "LaceLover01", 3);
INSERT INTO `User` (email, name, password, role) VALUES ("bertthebuilder@make-it-all.co.uk", "Bert Smith", "BertieIsTheBest1!", 2);
INSERT INTO `User` (email, name, password, role) VALUES ("clarajohnson01@make-it-all.co.uk", "Clara Johnson", "MeEncantaEspana2006", 2);
INSERT INTO `User` (email, name, password, role) VALUES ("dilip-the-dodo@make-it-all.co.uk", "Dilip Schmidt", "IAmNotADodo123", 1);
INSERT INTO `User` (email, name, password, role) VALUES ("emilysgarn1996@make-it-all.co.uk", "Emily Garn", "EmmaStone2006", 3);
INSERT INTO `User` (email, name, password, role) VALUES ("felix@make-it-all.co.uk", "Felix the Cat", "Felixx", 3);



INSERT INTO `Project` (name, leader) VALUES ("Spring Cleaning", 1);
INSERT INTO `Task` (workerhours, name, created, started, completed) VALUES (2, "Tidy up Room", "2023-05-01 12:00:00", NULL, NULL);
INSERT INTO `Task` (workerhours, name, created, started, completed) VALUES (1, "Go down to the Tip", "2023-05-01 12:00:00", NULL, NULL);
INSERT INTO `Task` (workerhours, name, created, started, completed) VALUES (2, "Vacuum House", "2023-05-01 12:00:00", NULL, NULL);
INSERT INTO `ProjectTask` VALUES (1,1), (2,1), (3,1);
INSERT INTO `TaskUser` VALUES (1, 1), (3, 1), (1, 2), (2, 2), (2, 3), (3, 3), (3, 2);

INSERT INTO `Project` (name, leader) VALUES ("Creating API Routes", 1);
INSERT INTO `Task` (workerhours, name, created, started, completed) VALUES (6, "Send Message", "2023-05-01 12:00:00", NULL, NULL);
INSERT INTO `Task` (workerhours, name, created, started, completed) VALUES (9, "Receive Message", "2023-05-01 12:00:00", NULL, NULL);
INSERT INTO `Task` (workerhours, name, created, started, completed) VALUES (15, "Create Thread", "2023-05-01 12:00:00", NULL, NULL);
INSERT INTO `ProjectTask` VALUES (4,2), (5,2), (6,2);
INSERT INTO `TaskUser` VALUES (4, 4), (5, 5), (4, 6), (5, 6), (1, 4);

INSERT INTO `Project` (name, leader) VALUES ("Destroying the One Ring", 2);
INSERT INTO `Task` (workerhours, name, created, started, completed) VALUES (2, "Eating Breakfast", "2023-04-29 12:00:00", "2023-05-03 12:00:00", NULL);
INSERT INTO `Task` (workerhours, name, created, started, completed) VALUES (53, "Walking to Mordor", "2023-05-01 12:00:00", "2023-05-10 12:00:00", "2023-05-15 12:00:00");
INSERT INTO `Task` (workerhours, name, created, started, completed) VALUES (9, "Attend the Council of Elrond", "2023-05-06 12:00:00", "2023-05-15 12:00:00", "2023-05-17 12:00:00");
INSERT INTO `Task` (workerhours, name, created, started, completed) VALUES (42, "Pass through the Mines of Moria", "2023-05-10 12:00:00", "2023-05-16 12:00:00", NULL);
INSERT INTO `Task` (workerhours, name, created, started, completed) VALUES (5, "Cast the Ring into the fire", "2023-05-18 12:00:00", NULL, NULL);
INSERT INTO `ProjectTask` VALUES (7,3), (8,3), (9,3);
INSERT INTO `TaskUser` VALUES (1, 7), (2, 8), (3, 9), (4, 7), (5, 8);
