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

CREATE TABLE ow_animated_shorts_heroes (
  asid int(11) NOT NULL,
  hid int(11) NOT NULL,
  PRIMARY KEY (asid, hid),
  FOREIGN KEY (asid) REFERENCES ow_animated_shorts(id),
  FOREIGN KEY (hid) REFERENCES ow_heroes(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE ow_counter_heroes (
  hid int(11) NOT NULL,
  chid int(11) NOT NULL,
  PRIMARY KEY (hid, chid),
  FOREIGN KEY (hid) REFERENCES ow_heroes(id),
  FOREIGN KEY (chid) REFERENCES ow_heroes(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
*/

-- INSERT INTO ow_heroes VALUES (NULL, 'Ana','Second in Command, Overwatch (formerly), Bounty Hunter', 'Support', 3), (NULL,'Bastion', 'Battle Automaton', 'Defense', 1), (NULL,'D.Va', 'Former pro gamer, Mech pilot', 'Tank', 2), (NULL,'Genji', 'Adventurer', 'Offense', 3);
-- INSERT INTO ow_players VALUES (NULL, 'Kruser',414,366,11200,4855), (NULL, 'Grazgul',233,250,4517,2851);
-- INSERT INTO ow_players_heroes VALUES (1,22,2462,992,'18:00:00.0000000'), (1,23,1945,713,'15:00:00.0000000'), (1,24,711,424,'08:00:00.0000000');

