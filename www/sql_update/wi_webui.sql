-- phpMyAdmin SQL Dump
-- version 3.1.3
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 28 Apr 2009 om 17:50
-- Serverversie: 5.1.32
-- PHP-Versie: 5.2.9

--
-- Database: `aurora`
--

-- --------------------------------------------------------

-- Create Tables wi_adminmodules --
DROP TABLE IF EXISTS `wi_adminmodules`;
CREATE TABLE `wi_adminmodules` (
  `id` int(11) NOT NULL auto_increment,
  `displayTopPanelSlider` varchar(10) NOT NULL,
  `displayTemplateSelector` varchar(10) NOT NULL,
  `displayStyleSwitcher` varchar(10) NOT NULL,
  `displayStyleSizer` varchar(10) NOT NULL,
  `displayFontSizer` varchar(10) NOT NULL,
  `displayLanguageSelector` varchar(10) NOT NULL,
  `displayScrollingText` varchar(10) NOT NULL,
  `displayWelcomeMessage` varchar(10) NOT NULL,
  `displayLogo` varchar(10) NOT NULL,
  `displayLogoEffect` varchar(10) NOT NULL,
  `displaySlideShow` varchar(10) NOT NULL,
  `displayMegaMenu` varchar(10) NOT NULL,
  `displayDate` varchar(10) NOT NULL,
  `displayTime` varchar(10) NOT NULL,
  `displayRoundedCorner` varchar(10) NOT NULL,
  `displayBackgroundColorAnimation` varchar(10) NOT NULL,
  `displayPageLoadTime` varchar(10) NOT NULL,
  `displayW3c` varchar(10) NOT NULL,
  `displayRss` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
)AUTO_INCREMENT=16 ;

INSERT INTO `wi_adminmodules` (`id`, `displayTopPanelSlider`, 
                                     `displayTemplateSelector`, 
                                     `displayStyleSwitcher`,
                                     `displayStyleSizer`,
                                     `displayFontSizer`,
                                     `displayLanguageSelector`,
                                     `displayScrollingText`,
                                     `displayWelcomeMessage`,
                                     `displayLogo`,
                                     `displayLogoEffect`,
                                     `displaySlideShow`,
                                     `displayMegaMenu`,
                                     `displayDate`,
                                     `displayTime`,
                                     `displayRoundedCorner`,
                                     `displayBackgroundColorAnimation`,
                                     `displayPageLoadTime`,
                                     `displayW3c`,
                                     `displayRss`) VALUES 
(1, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '1');

-- wi_adminsetting
DROP TABLE IF EXISTS `wi_adminsetting`;
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
  `ForceAge` int NOT NULL,
  PRIMARY KEY  (`id`)
) AUTO_INCREMENT=2 ;

INSERT INTO `wi_adminsetting` (`id`, `startregion`, `userdir`, `griddir`, `assetdir`, `lastnames`, `adress`, `region`, `allowRegistrations`, `verifyUsers`, `ForceAge`) VALUES 
(1, '', '', '', '', '0', '0', '0','1','0',0);

-- --------------------------------------------------------

-- wi_appearance
DROP TABLE IF EXISTS `wi_appearance`;
CREATE TABLE `wi_appearance` (
  `Enabled` varchar(36) NOT NULL default '',
  `Picture` varchar(32) NOT NULL,
  `ArchiveName` varchar(32) NOT NULL,
  PRIMARY KEY  (`ArchiveName`)
);

-- --------------------------------------------------------

-- wi_banned
DROP TABLE IF EXISTS `wi_banned`;
CREATE TABLE `wi_banned` (
  `UUID` varchar(36) NOT NULL,
  `agentIP` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
);

-- --------------------------------------------------------

-- wi_codetable
DROP TABLE IF EXISTS `wi_codetable`;
CREATE TABLE `wi_codetable` (
  `UUID` varchar(36) NOT NULL,
  `code` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
);

-- --------------------------------------------------------

-- wi_country
DROP TABLE IF EXISTS `wi_country`;
CREATE TABLE `wi_country` (
  `name` varchar(100) NOT NULL
);

INSERT INTO `wi_country` (`name`) VALUES 
('Albania'),
('Belgium'),
('Bosnia'),
('Bulgaria'),
('Germany'),
('Denmark'),
('Estonia'),
('Finland'),
('France'),
('Georgia'),
('Greece'),
('United Kingdom'),
('Ireland'),
('Iceland'),
('Italy'),
('Croatia'),
('Latvia'),
('Lithuania'),
('Luxembourg'),
('Malta'),
('Macedonia'),
('Moldova'),
('Netherlands'),
('Norway'),
('Poland'),
('Portugal'),
('Romania'),
('Russia'),
('Sweden'),
('Switzerland'),
('Serbia & Montenegro'),
('Slovakia'),
('Slovenia'),
('Espana'),
('Czech Rep.'),
('Turkey'),
('Ukraine'),
('Hungary'),
('Belarus'),
('Cyprus'),
('Austria'),
('Afghanistan'),
('Armenia'),
('Azerbaijan'),
('Bangladesh'),
('Bhutan'),
('Brunei'),
('India'),
('Indonesia'),
('Japan'),
('Cambodia'),
('Kazakhstan'),
('Kyrgyzstan'),
('Laos'),
('Malaysia'),
('Maldives'),
('Mongolia'),
('Myanmar'),
('Nepal'),
('North Korea'),
('Pakistan'),
('Philippines'),
('Singapore'),
('Sri Lanka'),
('South Korea'),
('Tajikistan'),
('Taiwan'),
('Thailand'),
('Turkmenistan'),
('Uzbekistan'),
('Viet Nam'),
('Canada'),
('Mexico'),
('USA'),
('Antigua und Barbuda'),
('Aruba'),
('Bahamas'),
('Barbados'),
('Belize'),
('Bermuda'),
('Cayman Islands'),
('Costa Rica'),
('Curacao'),
('Dominica'),
('Dominican Rep.'),
('El Salvador'),
('Grenada'),
('Guadeloupe'),
('Guatemala'),
('Haiti'),
('Honduras'),
('Jamaica'),
('Virgin Islands'),
('Cuba'),
('Martinique'),
('Nicaragua'),
('Panama'),
('Puerto Rico'),
('St. Kitts und Nevis'),
('St. Lucia'),
('St. Maarten'),
('St. Vincent & Grenadin'),
('Trinidad & Tobago'),
('Argentina'),
('Bolivia'),
('Brazil'),
('Chile'),
('Ecuador'),
('Guyana'),
('Colombia'),
('Paraguay'),
('Peru'),
('Suriname'),
('Uruguay'),
('Venezuela'),
('Australia'),
('Fiji'),
('Marshall Islands'),
('Micronesia'),
('Nauru'),
('New Zealand'),
('Palau'),
('Papua New Guinea'),
('Samoa'),
('Tonga'),
('Tuvalu'),
('Vanuatu'),
('Bahrain'),
('Iraq'),
('Iran'),
('Israel'),
('Yemen'),
('Jordan'),
('Quatar'),
('Kuwait'),
('Lebanon'),
('Oman'),
('Palestinian authority'),
('Saudi Arabia'),
('Syria'),
('U.A.E.'),
('Algeria'),
('Angola'),
('Benin'),
('Botswana'),
('Burkina Faso'),
('Burundi'),
('Dem. Rep. of the Congo'),
('Djibouti'),
('Céte d''Ivoire'),
('Eritrea'),
('Gabun'),
('Gambia'),
('Ghana'),
('Guinea'),
('Guinea-Bissau'),
('Cameroon'),
('Cape Verde'),
('Kenya'),
('Lesotho'),
('Liberia'),
('Libya'),
('Madagascar'),
('Malawi'),
('Mali'),
('Morocco'),
('Mauritania'),
('Mauritius'),
('Mozambique'),
('Namibia'),
('Niger'),
('Nigeria'),
('Dem. Rep. of the Congo'),
('Zambia'),
('Sao Tomé and Principe'),
('Senegal'),
('Seychelles'),
('Sierra Leone'),
('Simbabwe'),
('Somalia'),
('Sudan'),
('Swaziland'),
('South Africa'),
('Tanzania'),
('Togo'),
('Chad'),
('Tunisia'),
('Uganda'),
('Central African Rep.'),
('Egypt'),
('Guinea Equatorial'),
('Ethiopia'),
('La Réunion'),
('Solomon Islands'),
('French Guiana');

-- --------------------------------------------------------

-- wi_lastnames
DROP TABLE IF EXISTS `wi_lastnames`;
CREATE TABLE `wi_lastnames` (
  `name` varchar(255) NOT NULL,
  `active` varchar(255) NOT NULL default '1'
) ;

INSERT INTO `wi_lastnames` (`name`, `active`) VALUES 
('Binder', '1'),
('Noel', '1'),
('Young', '1'),
('Roux', '1'),
('Allen', '1'),
('Heron', '1'),
('Mansworld', '1'),
('Babbi', '1'),
('Crazys', '1'),
('Linden', '1'),
('Machlam', '1'),
('Notringham', '1'),
('Opus', '1'),
('Hausermann', '1'),
('McLachlan', '1'),
('McKinsey', '1'),
('Pohl', '1'),
('Schwarzenegger', '1'),
('Mueller', '1'),
('Nosemann', '1'),
('Obolus', '1'),
('Himbaer', '1'),
('Nala', '1'),
('Kandee', '1'),
('Bauer', '1'),
('Simons', '1'),
('Raptor', '1'),
('Maek', '1'),
('Huss', '1'),
('Mondial', '1'),
('Moondancer', '1'),
('Sweetheart', '1'),
('Schnuggy', '1'),
('Swindlehurst', '1'),
('Baumeister', '1'),
('Bloomberg', '1'),
('Dredd', '1'),
('Gridlock', '1'),
('Bohlen', '1'),
('Snapper', '1'),
('Tickle', '1'),
('Ewing', '1'),
('Schwinge', '1'),
('Nonsito', '1');

-- --------------------------------------------------------

-- wi_pagemanager
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
) AUTO_INCREMENT=9 ;

INSERT INTO `wi_pagemanager` (`id`, `rank`, `active`, `url`, `target`, `display`, `parent`) VALUES
('webui_menu_item_home', 1.0, '1', 'index.php?page=home', '_self', '2', null),

('webui_menu_item_adminhome', 2.0, '1', 'index.php?page=adminhome', '_self', '3', null),
('webui_menu_item_adminmanage', 2.1, '1', 'index.php?page=adminmanage', '_self', '3', 'webui_menu_item_adminhome'),
('webui_menu_item_adminsettings', 2.2, '1', 'index.php?page=adminsettings', '_self', '3', 'webui_menu_item_adminhome'),
('webui_menu_item_adminmodules', 2.3, '1', 'index.php?page=adminmodules', '_self', '3', 'webui_menu_item_adminhome'),
('webui_menu_item_adminloginscreen', 2.4, '1', 'index.php?page=adminloginscreen', '_self', '3', 'webui_menu_item_adminhome'),
('webui_menu_item_adminnewsmanager', 2.5, '1', 'index.php?page=adminnewsmanager', '_self', '3', 'webui_menu_item_adminhome'),
('webui_menu_item_adminsupport', 2.6, '1', 'index.php?page=adminsupport', '_self', '3', 'webui_menu_item_adminhome'),

('webui_menu_item_account', 3.0, '1', 'index.php?page=account', '_self', '1', null),
('webui_menu_item_changeaccount', 3.1, '1', 'index.php?page=changeaccount', '_self', '1', 'webui_menu_item_account'),

('webui_menu_item_world', 4.0, '1', 'index.php?page=world', '_self', '2', null),
('webui_menu_item_news', 4.1, '1', 'index.php?page=news', '_self', '2', 'webui_menu_item_world'),
('webui_menu_item_regions', 4.2, '1', 'index.php?page=regionlist', '_self', '2','webui_menu_item_world'),
('webui_menu_item_worldmap', 4.3, '1', 'index.php?page=worldmap', '_self', '2', 'webui_menu_item_world'),
('webui_menu_item_quickmap', 4.4, '1', 'index.php?page=quickmap', '_self', '2', 'webui_menu_item_world'),
('webui_menu_item_gallery', 4.5, '1', 'index.php?page=gallery', '_self', '2', 'webui_menu_item_world'),

('webui_menu_item_users', 5.0, '1', 'index.php?page=users', '_self', '1', null),
('webui_menu_item_peoplesearch', 5.1, '1', 'index.php?page=peoplesearch', '_self', '1', 'webui_menu_item_users'),
('webui_menu_item_onlineusers', 5.2, '1', 'index.php?page=onlineusers', '_self', '1', 'webui_menu_item_users'),

('webui_menu_item_register', 6.0, '1', 'index.php?page=register', '_self', '0', null),
('webui_menu_item_login', 7.0, '1', 'index.php?page=login', '_self', '0', null),
('webui_menu_item_forgotpass', 7.1, '1', 'index.php?page=forgotpass', '_self', '0', 'webui_menu_item_login'),
('webui_menu_item_logout', 8.0, '1', 'index.php?page=logout', '_self', '1', null),
('webui_menu_item_help', 9.0, '1', 'index.php?page=help', '_self', '2', null),
('webui_menu_item_chat', 9.1, '1', 'index.php?page=chat', '_self', '2', 'webui_menu_item_help'),
('webui_menu_item_downloads', 9.2, '1', 'index.php?page=downloads', '_self', '2', 'webui_menu_item_help'),
('webui_menu_item_addgrid', 9.3, '1', 'index.php?page=addgrid', '_self', '2', 'webui_menu_item_help'),
('webui_menu_item_addserver', 9.4, '1', 'index.php?page=addserver', '_self', '2', 'webui_menu_item_help');


-- --------------------------------------------------------

-- wi_regions
DROP TABLE IF EXISTS `wi_regions`;
CREATE TABLE IF NOT EXISTS `wi_regions` (
  `serverIP` varchar(64) NOT NULL,
  `serverPort` int(11) NOT NULL,
  `regionMapTexture` varchar(255) NOT NULL,
  `locX` int(11) NOT NULL,
  `locY` int(11) NOT NULL,
  `lastcheck` int(10) NOT NULL,
  `failcounter` int(11) NOT NULL,
  UNIQUE KEY `serverURI` (`serverIP`,`regionMapTexture`)
);

-- --------------------------------------------------------

-- wi_sitemanagement
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
('home', 'main', 'home.php'),
('login', 'main', 'login.php'),
('logout', 'main', 'logout.php'),
('onlineusers', 'main', 'onlineusers.php'),
('peoplesearch', 'main', 'peoplesearch.php'),
('register', 'account', 'register.php'),
('regionlist', 'main', 'regionlist.php'),
('resetpass', 'account', 'resetpass.php'),
('worldmap', 'main', 'worldmap.php'),
('quickmap', 'main', 'quickmap.php'),
('adminhome', 'admin', 'home.php'),
('adminloginscreen', 'admin', 'loginscreenmanager.php'),
('adminnewsmanager', 'admin', 'newsmanager.php'),
('adminmanage', 'admin', 'manage.php'),
('news_add', 'admin', 'news_add.php'),
('news_edit', 'admin', 'news_edit.php'),
('adminsettings', 'admin', 'settings.php'),
('adminmodules', 'admin', 'modules.php'),
('adminedit', 'admin', 'edit.php'),
('account', 'account', 'main.php'),
('world', 'main', 'worldmain.php'),
('users', 'main', 'usersmain.php'),
('help', 'main', 'help.php'),
('chat', 'main', 'chat.php'),
('downloads', 'main', 'downloads.php'),
('addgrid', 'main', 'addgrid.php'),
('addserver', 'main', 'addserver.php'),
('gallery', 'main', 'gallery.php'),
('adminsupport', 'admin', 'support.php');

-- --------------------------------------------------------

-- wi_startscreen_infowindow
DROP TABLE IF EXISTS `wi_startscreen_infowindow`;
CREATE TABLE `wi_startscreen_infowindow` (
  `gridstatus` varchar(255) NOT NULL,
  `active` varchar(30) NOT NULL,
  `color` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL
);

INSERT INTO `wi_startscreen_infowindow` (`gridstatus`, `active`, `color`, `title`, `message`) VALUES
('1', '1', 'yellow', 'Info system Works very well ;-)', 'Today we''ve built a new loginscreen info system and it works very well. You can now see Info windows on the startup screen.');

-- --------------------------------------------------------

-- wi_startscreen_news
DROP TABLE IF EXISTS `wi_startscreen_news`;
CREATE TABLE `wi_startscreen_news` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `time` int(10) unsigned NOT NULL default '0',
  `user` varchar(255) NOT NULL,
  KEY `id` (`id`)
) AUTO_INCREMENT=2 ;

INSERT INTO `wi_startscreen_news` (`id`, `title`, `message`, `time`,`user`) VALUES
(1, '[COMPLETE] The new loginscreen is done and works fine so far', '<p>We built a new loginscreen which will inform you about Grid updates or changes. Also you can now see how many users and regions are online, and more.  Also, you may from time to time see an infowindow, which informs you about important news.  Have Fun !</p>', 1211321439,'Grid News');

-- --------------------------------------------------------

-- wi_statistics
DROP TABLE IF EXISTS `wi_statistics`;
CREATE TABLE IF NOT EXISTS `wi_statistics` (
  `serverIP` varchar(64) NOT NULL,
  `serverPort` int(11) NOT NULL,
  `version` varchar(255) NOT NULL,
  `lastcheck` int(10) NOT NULL,
  `failcounter` int(11) NOT NULL,
  UNIQUE KEY `serverIP` (`serverIP`,`serverPort`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- wi_gallery
DROP TABLE IF EXISTS `wi_gallery`;
CREATE TABLE IF NOT EXISTS `wi_gallery` (
  `picture` varchar(64) NOT NULL,
  `picturethumbnail` varchar(64) NOT NULL,
  `description` varchar(255) NOT NULL,
  `active` int(1) NOT NULL,
  `rank` int(11) NOT NULL,
  UNIQUE KEY (`picture`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

INSERT INTO `wi_gallery` (`picture`, `picturethumbnail`, `description`, `active`, `rank`) VALUES
('login1.jpg', 'image1thumbnail.jpg', 'Image 1 of our world', '1', '1'),
('login2.jpg', 'image2thumbnail.jpg', 'Image 2 of our world', '1', '1'),
('login3.jpg', 'image3thumbnail.jpg', 'Image 3 of our world', '1', '1'),
('login4.jpg', 'image4thumbnail.jpg', 'Image 4 of our world', '1', '1'),
('login5.jpg', 'image5thumbnail.jpg', 'Image 5 of our world', '1', '1');

-- --------------------------------------------------------

-- wi_users
DROP TABLE IF EXISTS `wi_users`;
CREATE TABLE `wi_users` (
  `UUID` varchar(36) NOT NULL default '',
  `username` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `passwordHash` varchar(32) NOT NULL,
  `passwordSalt` varchar(32) NOT NULL,
  `realname1` varchar(255) NOT NULL,
  `realname2` varchar(255) NOT NULL,
  `adress1` varchar(255) NOT NULL,
  `zip1` varchar(255) NOT NULL,
  `city1` varchar(255) NOT NULL,
  `country1` varchar(255) NOT NULL,
  `emailadress` varchar(255) NOT NULL,
  `agentIP` varchar(255) NOT NULL,
  `active` varchar(255) NOT NULL default '1',
  PRIMARY KEY  (`UUID`),
  UNIQUE KEY `usernames` (`username`,`lastname`)
);
