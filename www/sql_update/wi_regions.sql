CREATE TABLE IF NOT EXISTS `wi_regions` (
  `serverIP` varchar(64) NOT NULL,
  `serverPort` int(11) NOT NULL,
  `regionMapTexture` varchar(255) NOT NULL,
  `locX` int(11) NOT NULL,
  `locY` int(11) NOT NULL,
  `lastcheck` int(10) NOT NULL,
  `failcounter` int(11) NOT NULL,
  UNIQUE KEY `serverURI` (`serverIP`,`regionMapTexture`)
) TYPE=MyISAM