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
(1, 'admin', '84e78b596fa8e391c49f3c4df7b9c57f'); -- No, we dont know what the default admin password is.  You'll have to change it when you get logged in ;)
