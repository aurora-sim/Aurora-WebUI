CREATE TABLE `wi_startscreen_news` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `time` int(10) unsigned NOT NULL default '0',
  KEY `id` (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=2 ;

INSERT INTO `wi_startscreen_news` (`id`, `title`, `message`, `time`) VALUES
(1, '[COMPLETE] The new loginscreen is done and works fine so far', '<P>We built a new loginscreen which will inform you about Grid updates or changes. Also you can now see how many users and regions are online, and more.  Also, you may from time to time see an infowindow, which informs you about important news.  Have Fun !</P>', 1211321439);