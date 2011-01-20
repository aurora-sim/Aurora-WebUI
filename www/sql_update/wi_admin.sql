CREATE TABLE `wi_admin` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=2 ;

-- 
-- Daten für Tabelle `wi_admin`
-- 

INSERT INTO `wi_admin` (`id`, `username`, `password`) VALUES 
(1, 'admin', '5f05d1b5f5edd01114ab7c0d44084cb1'); -- Password is 'admin'
