CREATE TABLE IF NOT EXISTS `wi_economy_money` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CentsPerMoneyUnit` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `wi_economy_money` (`id`, `CentsPerMoneyUnit`) VALUES (1, 0.386);
