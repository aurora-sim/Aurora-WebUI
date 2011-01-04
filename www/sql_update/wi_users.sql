CREATE TABLE `wi_users` (
  `UUID` varchar(36) NOT NULL default '',
  `username` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `passwordHash` varchar(32) NOT NULL,
  `passwordSalt` varchar(32) NOT NULL,
  `realname1` varchar(255) NOT NULL,
  `realname2` varchar(255) NOT NULL,
  `adress1` varchar(255) NOT NULL,
  `zip1` varchar(255) NOT NULL,
  `city1` varchar(255) NOT NULL,
  `country1` varchar(255) NOT NULL,
  `emailadress` varchar(255) NOT NULL,
  `agentIP` varchar(255) NOT NULL,
  `active` varchar(255) NOT NULL default '1',
  PRIMARY KEY  (`UUID`),
  UNIQUE KEY `usernames` (`username`,`lastname`)
) TYPE=MyISAM;