CREATE TABLE `wi_adminsetting` (
  `id` int(11) NOT NULL auto_increment,
  `startregion` varchar(255) NOT NULL,
  `userdir` varchar(255) NOT NULL,
  `griddir` varchar(255) NOT NULL,
  `assetdir` varchar(255) NOT NULL,
  `lastnames` varchar(10) NOT NULL,
  `adress` varchar(32) NOT NULL,
  `region` text NOT NULL,
  `allowRegistrations` varchar(10) NOT NULL,
  `verifyUsers` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=2 ;

INSERT INTO `wi_adminsetting` (`id`, `startregion`, `userdir`, `griddir`, `assetdir`, `lastnames`, `adress`, `region`, `allowRegistrations`, `verifyUsers`) VALUES 
(1, '', '', '', '', '0', '0', '0','1','1');