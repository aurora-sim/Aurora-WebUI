DROP TABLE IF EXISTS `wi_pagemanager`;
CREATE TABLE `wi_pagemanager` (
  `id` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `rank` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `active` varchar(30) NOT NULL,
  `url` text NOT NULL,
  `target` varchar(255) NOT NULL,
  `display` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=9 ;

INSERT INTO `wi_pagemanager` (`id`, `code`, `rank`, `type`, `active`, `url`, `target`, `display`) VALUES
('wiredux_menu_item_1_name', '1211831857', '1', '1', '1', 'index.php?page=home', '_self', '2'),
('wiredux_menu_item_2_name', '1211831897', '2', '1', '1', 'index.php?page=change', '_self', '1'),
('wiredux_menu_item_3_name', '1211831925', '3', '1', '1', 'index.php?page=gridstatus', '_self', '2'),
('wiredux_menu_item_4_name', '1211832121', '4', '1', '1', 'index.php?page=transactions', '_self', '1'),
('wiredux_menu_item_5_name', '1213729504', '5', '1', '1', 'index.php?page=regions', '_self', '2'),
('wiredux_menu_item_6_name', '1213811351', '6', '1', '1', 'index.php?page=map', '_self', '2'),
('wiredux_menu_item_7_name', '1211832149', '7', '1', '1', 'index.php?page=create', '_self', '0'),
('wiredux_menu_item_8_name', '1211832173', '8', '1', '1', 'index.php?page=logout', '_self', '1'),
('wiredux_menu_item_9_name', '1211832174', '9', '1', '1', 'index.php?page=login', '_self', '0'),
('wiredux_menu_item_10_name', '1211832175', '10', '1', '1', 'index.php?page=online', '_self', '2');