CREATE DATABASE db_inst_avail;
USE db_inst_avail;

CREATE TABLE app_user (
	id BIGINT PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(255) UNIQUE NOT NULL,
	passwd VARCHAR(255) NOT NULL
);

CREATE TABLE instructor_availability (
	id BIGINT PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
	available TINYINT NOT NULL DEFAULT 0,
	meeting_room_url VARCHAR(255) NOT NULL,
	FOREIGN KEY (id) REFERENCES app_user(id) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO app_user(username, passwd) VALUES
('geethike', '$2a$12$SaAwU92K7ZTeyW60T.6A9.NeuT748da5vlipIpNGiTxyCt43k4onq'),
('tuan', '$2a$12$t7Mbx2Prno6MZVUnkvLDS.821xEASDYPIEeR.KbH7kYbBfbZA46hm'),
('deepthi', '$2a$12$EHZGgVomOHQ5Lwl8kSNbFeOwgbD8OHBZhYzcySVsy7tipRKf2R/um');

INSERT INTO instructor_availability(id, name, available, meeting_room_url) VALUES
(1,'Geethike',0,'https://us05web.zoom.us/j/82618551865?pwd=ZXJKbkV4MHRXMzhJRmd6ZVZ1UmQ4QT09'),
(2,'Tuan',0,'https://us05web.zoom.us/j/82618551865?pwd=ZXJKbkV4MHRXMzhJRmd6ZVZ1UmQ4QT09'),
(3,'Deepthi',1,'https://us05web.zoom.us/j/82618551865?pwd=ZXJKbkV4MHRXMzhJRmd6ZVZ1UmQ4QT09');
