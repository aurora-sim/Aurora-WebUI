CREATE TABLE `wi_startscreen_infowindow` (
  `gridstatus` varchar(255) NOT NULL,
  `active` varchar(30) NOT NULL,
  `color` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL
) TYPE=MyISAM;

INSERT INTO `wi_startscreen_infowindow` (`gridstatus`, `active`, `color`, `title`, `message`) VALUES
('1', '1', 'yellow', 'Info system Works very well ;-)', 'Today we''ve built a new loginscreen info system and it works very well. You can now see Info windows on the startup screen.');
