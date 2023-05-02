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
	wokerhours INT UNSIGNED,
	created DATETIME DEFAULT CURRENT_TIMESTAMP,
	started DATETIME DEFAULT CURRENT_TIMESTAMP,
	completed DATETIME DEFAULT CURRENT_TIMESTAMP,
);

CREATE TABLE ProjectTask (
	task INT UNSIGNED NOT NULL,
	project INT UNSIGNED NOT NULL,
	FOREIGN KEY (task) REFERENCES Task(uid) ON DELETE CASCADE ON UPDATE CASCADE
	FOREIGN KEY (project) REFERENCES Project(uid) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE TaskUser (
	user INT UNSIGNED NOT NULL,
	task INT UNSIGNED NOT NULL,
	FOREIGN KEY (user) REFERENCES User(uid) ON DELETE CASCADE ON UPDATE CASCADE
	FOREIGN KEY (task) REFERENCES Task(uid) ON DELETE CASCADE ON UPDATE CASCADE
);
