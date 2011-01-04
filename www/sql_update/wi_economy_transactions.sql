CREATE TABLE `wi_economy_transactions` (
  `id` int(11) NOT NULL auto_increment,
  `sourceId` varchar(36) NOT NULL,
  `destId` varchar(36) NOT NULL,
  `amount` int(11) NOT NULL default '0',
  `flags` int(11) NOT NULL default '0',
  `aggregatePermInventory` int(11) NOT NULL default '0',
  `aggregatePermNextOwner` int(11) NOT NULL default '0',
  `description` varchar(256) default NULL,
  `transactionType` int(11) NOT NULL default '0',
  `timeOccurred` int(11) NOT NULL,
  `RegionGenerated` varchar(36) NOT NULL,
  `IPGenerated` varchar(64) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=1 ;