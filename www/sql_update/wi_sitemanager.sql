DROP TABLE IF EXISTS `wi_sitemanagement`;
CREATE TABLE `wi_sitemanagement` (
  `pagecase` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `include` varchar(255) NOT NULL,
  PRIMARY KEY (`pagecase`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `wi_sitemanagement` (`pagecase`, `type`, `include`) VALUES
('activate', 'main', 'activate.php'),
('activatemail', 'main', 'activatemail.php'),
('changeaccount', 'account', 'changeaccount.php'),
('forgotpass', 'account', 'forgotpass.php'),
('news', 'news', 'news.php'),
('newshistory', 'news', 'newshistory.php'),
('home', 'main', 'home.php'),
('login', 'main', 'login.php'),
('logout', 'main', 'logout.php'),
('onlineusers', 'main', 'onlineusers.php'),
('peoplesearch', 'main', 'peoplesearch.php'),
('register', 'account', 'register.php'),
('regionlist', 'main', 'regionlist.php'),
('resetpass', 'account', 'resetpass.php'),
('worldmap', 'main', 'worldmap.php'),
('adminhome', 'admin', 'home.php'),
('adminloginscreen', 'admin', 'loginscreenmanager.php'),
('adminmanage', 'admin', 'manage.php');