
CREATE TABLE `wi_pagemanager` (
  `id` int(15) NOT NULL auto_increment,
  `code` varchar(255) NOT NULL,
  `sitename` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `rank` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `active` varchar(30) NOT NULL,
  `url` text NOT NULL,
  `target` varchar(255) NOT NULL,
  `display` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=9 ;

INSERT INTO `wi_pagemanager` (`id`, `code`, `sitename`, `content`, `rank`, `type`, `active`, `url`, `target`, `display`) VALUES
(1, '1211831857', 'Home', '<p><strong>Welcome to the new Opensimwi Redux !</strong><br />\r\n <br />\r\n Create an Free Account today and Play in our World.<br />\r\n Our World is created by its Residents, you can build everything in here.<br />\r\n Meet Peoples, Chat, Play, Everything is possible in our brandnew 3D World.</p>\r\n <p>Beside you see the Status of our System -&gt; <br />\r\n <br />\r\n Enjoy it. :-)</p>\r\n </td>\r\n </tr>\r\n </tbody>\r\n </p>', '1', '1', '1', 'index.php?page=home', '_self', '2'),
(2, '1211831897', 'Change Account', '', '2', '1', '1', 'index.php?page=change', '_self', '1'),
(3, '1211831925', 'Gridstatus', '', '3', '1', '1', 'index.php?page=gridstatus', '_self', '2'),
(4, '1211832121', 'Transaction History', '', '4', '1', '1', 'index.php?page=transactions', '_self', '1'),
(5, '1213729504', 'Region List', '', '5', '1', '1', 'index.php?page=regions', '_self', '2'),
(6, '1213811351', 'World Map', '', '6', '1', '1', 'index.php?page=map', '_self', '2'),
(7, '1211832149', 'Register', '', '7', '1', '1', 'index.php?page=create', '_self', '0'),
(8, '1211832173', 'Logout', '', '8', '1', '1', 'index.php?page=logout', '_self', '1'),
(9, '1211832174', 'Login', '', '9', '1', '1', 'index.php?page=login', '_self', '0');
