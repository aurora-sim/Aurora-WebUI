DROP TABLE IF EXISTS `wi_pagemanager`;
CREATE TABLE `wi_pagemanager` (
  `id` varchar(255) NOT NULL,
  `rank` float NOT NULL,
  `active` varchar(30) NOT NULL,
  `url` text NOT NULL,
  `target` varchar(255) NOT NULL,
  `display` varchar(255) NOT NULL,
  `parent` varchar(255),
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=9 ;

INSERT INTO `wi_pagemanager` (`id`, `rank`, `active`, `url`, `target`, `display`, `parent`) VALUES
('webui_menu_item_home', 1.0, '1', 'index.php?page=home', '_self', '2', null),

('webui_menu_item_adminhome', 2.0, '1', 'index.php?page=adminhome', '_self', '3', null),
('webui_menu_item_adminmanage', 2.1, '1', 'index.php?page=adminmanage', '_self', '3', 'webui_menu_item_adminhome'),
('webui_menu_item_adminsettings', 2.2, '1', 'index.php?page=adminsettings', '_self', '3', 'webui_menu_item_adminhome'),
('webui_menu_item_adminloginscreen', 2.3, '1', 'index.php?page=adminloginscreen', '_self', '3', 'webui_menu_item_adminhome'),
('webui_menu_item_adminsupport', 2.4, '1', 'index.php?page=adminsupport', '_self', '3', 'webui_menu_item_adminhome'),

('webui_menu_item_account', 3.0, '1', 'index.php?page=account', '_self', '1', null),
('webui_menu_item_changeaccount', 3.1, '1', 'index.php?page=changeaccount', '_self', '1', 'webui_menu_item_account'),

('webui_menu_item_world', 4.0, '1', 'index.php?page=world', '_self', '2', null),
('webui_menu_item_news', 4.1, '1', 'index.php?page=news', '_self', '2', 'webui_menu_item_world'),
('webui_menu_item_regions', 4.2, '1', 'index.php?page=regionlist', '_self', '2','webui_menu_item_world'),
('webui_menu_item_worldmap', 4.3, '1', 'index.php?page=worldmap', '_self', '2', 'webui_menu_item_world'),
('webui_menu_item_gallery', 4.3, '1', 'index.php?page=gallery', '_self', '2', 'webui_menu_item_gallery'),

('webui_menu_item_users', 5.0, '1', 'index.php?page=users', '_self', '1', null),
('webui_menu_item_peoplesearch', 5.1, '1', 'index.php?page=peoplesearch', '_self', '1', 'webui_menu_item_users'),
('webui_menu_item_onlineusers', 5.2, '1', 'index.php?page=onlineusers', '_self', '1', 'webui_menu_item_users'),

('webui_menu_item_register', 6.0, '1', 'index.php?page=register', '_self', '0', null),
('webui_menu_item_login', 7.0, '1', 'index.php?page=login', '_self', '0', null),
('webui_menu_item_logout', 8.0, '1', 'index.php?page=logout', '_self', '1', null),
('webui_menu_item_help', 9.0, '1', 'index.php?page=help', '_self', '1', null);