-- ******************************* OVERWATCH SQL ******************************

-- DROP TABLE IF EXISTS `ow_heroes`;
-- DROP TABLE IF EXISTS `ow_players`;


/*
CREATE TABLE ow_heroes (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  occupation varchar(255) NOT NULL,
  role varchar(255) NOT NULL,
  skill int(11) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY (name)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE ow_players (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  wins int(11) NOT NULL,
  losses int(11) NOT NULL,
  eliminations int(11) NOT NULL,
  deaths int(11) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY (name)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE ow_players_heroes (
  pid int(11) NOT NULL,
  hid int(11) NOT NULL,
  eliminations int(11) NOT NULL,
  deaths int(11) NOT NULL,
  playtime time NOT NULL,
  PRIMARY KEY (pid, hid),
  FOREIGN KEY (pid) REFERENCES ow_players(id),
  FOREIGN KEY (hid) REFERENCES ow_heroes(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE ow_maps (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  gametype varchar(255) NOT NULL,
  terrain varchar(255) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY (name)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE ow_animated_shorts (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  description varchar(1023) NOT NULL,
  location int(11) NOT NULL,
  duration time NOT NULL,
  release_date date NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY (title),
  FOREIGN KEY (location) REFERENCES ow_maps(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
*/

-- INSERT INTO ow_heroes VALUES (NULL, 'Ana','Second in Command, Overwatch (formerly), Bounty Hunter', 'Support', 3), (NULL,'Bastion', 'Battle Automaton', 'Defense', 1), (NULL,'D.Va', 'Former pro gamer, Mech pilot', 'Tank', 2), (NULL,'Genji', 'Adventurer', 'Offense', 3);
-- INSERT INTO ow_players VALUES (NULL, 'Kruser',414,366,11200,4855), (NULL, 'Grazgul',233,250,4517,2851);
-- INSERT INTO ow_players_heroes VALUES (1,22,2462,992,'18:00:00.0000000'), (1,23,1945,713,'15:00:00.0000000'), (1,24,711,424,'08:00:00.0000000');




-- ******************* Examples For Reference Only *************************************

-- Create a table called operating_system with the following properties:
-- id - an auto incrementing integer which is the primary key
-- name - a varchar of maximum length 255, cannot be null
-- version - a varchar of maximum length 255, cannot be null
-- name version combinations must be unique
/*
CREATE TABLE operating_system (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  version varchar(255) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY (name, version)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Create a table called device with the following properties:
-- id - an auto incrementing integer which is the primary key
-- cid - an integer which is a foreign key reference to the category_tbl table
-- name - a varchar of maximum length 255 which cannot be null
-- received - a date type (you can read about it here http://dev.mysql.com/doc/refman/5.0/en/datetime.html)
-- isbroken - a boolean

CREATE TABLE device (
  id int(11) NOT NULL AUTO_INCREMENT,
  cid int(11) NOT NULL,
  name varchar(255) NOT NULL,
  received date,
  isbroken boolean,
  PRIMARY KEY (id),
  FOREIGN KEY (cid) REFERENCES category_tbl(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Create a table called os_support with the following properties, this is a table representing a many-to-many relationship
-- between devices and operating systems:
-- did - an integer which is a foreign key reference to device
-- osid - an integer which is a foreign key reference to operating_system
-- notes - a text type
-- The primary key is a combination of did and osid

CREATE TABLE os_support (
  did int(11),
  osid int(11),
  notes text, 
  PRIMARY KEY (did, osid),
  FOREIGN KEY (did) REFERENCES device(id),
  FOREIGN KEY (osid) REFERENCES operating_system(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
*/

-- insert the following into the category_tbl table:
-- name: phone
-- subcategory: maybe a tablet?

-- name: tablet
-- subcategory: but kind of a laptop

-- name: tablet
-- subcategory: ereader



/*
-- insert the folowing into the operating_system table:
-- name: Android
-- version: 1.0

-- name: Android
-- version: 2.0

-- name: iOS
-- version: 4.0

INSERT INTO operating_system VALUES (NULL, 'Android','1.0'), (NULL,'Android', '2.0'), (NULL,'iOS', '4.0');

-- insert the following devices instances into the device table (you should use a subquery to set up foriegn keys referecnes, no hard coded numbers):
-- cid - reference to name: phone subcategory: maybe a tablet?
-- name - Samsung Atlas
-- received - 1/2/1970
-- isbroken - True

-- cid - reference to name: tablet subcategory: but kind of a laptop
-- name - Nokia
-- received - 5/6/1999
-- isbroken - False

-- cid - reference to name: tablet subcategory: ereader
-- name - jPad
-- received - 11/18/2005
-- isbroken - False

INSERT INTO device VALUES
	(NULL, (SELECT id FROM category_tbl WHERE subcategory = 'maybe a tablet?'), 'Samsung Atlas','1970-1-2', TRUE),
	(NULL, (SELECT id FROM category_tbl WHERE subcategory = 'but kind of a laptop'), 'Nokia','1999-5-6', FALSE),
	(NULL, (SELECT id FROM category_tbl WHERE subcategory = 'ereader'), 'jPad','2005-11-18', FALSE);

-- insert the following into the os_support table using subqueries to look up data as needed:
-- device: Samsung Atlas
-- os: Android 1.0
-- notes: Works poorly

-- device: Samsung Atlas
-- os: Android 2.0
-- notes: NULL

-- device: jPad
-- os: iOS 4.0
-- notes: NULL

INSERT INTO os_support VALUES
	((SELECT id FROM device WHERE name = 'Samsung Atlas'), (SELECT id FROM operating_system WHERE name = "Android" AND version = '1.0'), 'Works poorly'),
	((SELECT id FROM device WHERE name = 'Samsung Atlas'), (SELECT id FROM operating_system WHERE name = "Android" AND version = '2.0'), NULL),
	((SELECT id FROM device WHERE name = 'jPad'), (SELECT id FROM operating_system WHERE name = "iOS" AND version = '4.0'), NULL);

*/

