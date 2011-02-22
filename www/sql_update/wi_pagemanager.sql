DROP TABLE IF EXISTS `wi_pagemanager`;
CREATE TABLE `wi_pagemanager` (
  `id` varchar(255) NOT NULL,
  `rank` varchar(30) NOT NULL,
  `active` varchar(30) NOT NULL,
  `url` text NOT NULL,
  `target` varchar(255) NOT NULL,
  `display` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=9 ;

INSERT INTO `wi_pagemanager` (`id`, `rank`, `active`, `url`, `target`, `display`) VALUES
('webui_menu_item_home', '1', '1', 'index.php?page=home', '_self', '2'),
('webui_menu_item_changeaccount', '2', '1', 'index.php?page=changeaccount', '_self', '1'),
('webui_menu_item_news', '3', '1', 'index.php?page=news', '_self', '2'),
('webui_menu_item_regions', '4', '1', 'index.php?page=regionlist', '_self', '2'),
('webui_menu_item_worldmap', '5', '1', 'index.php?page=worldmap', '_self', '2'),
('webui_menu_item_register', '6', '1', 'index.php?page=register', '_self', '0'),
('webui_menu_item_logout', '7', '1', 'index.php?page=logout', '_self', '1'),
('webui_menu_item_login', '8', '1', 'index.php?page=login', '_self', '0'),
('webui_menu_item_onlineusers', '9', '1', 'index.php?page=onlineusers', '_self', '2'),
('webui_menu_item_peoplesearch', '10', '1', 'index.php?page=peoplesearch', '_self', '1'),
('webui_menu_item_adminhome', '11', '1', 'index.php?page=adminhome', '_self', '3'),
('webui_menu_item_adminloginscreen', '12', '1', 'index.php?page=adminloginscreen', '_self', '3'),
('webui_menu_item_adminmanage', '13', '1', 'index.php?page=adminmanage', '_self', '3'),
('webui_menu_item_adminsettings', '13', '1', 'index.php?page=adminsettings', '_self', '3');