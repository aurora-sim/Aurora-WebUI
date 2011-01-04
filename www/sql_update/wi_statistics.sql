-- phpMyAdmin SQL Dump
-- version 3.1.3
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 28 Apr 2009 om 17:50
-- Serverversie: 5.1.32
-- PHP-Versie: 5.2.9

--
-- Database: `opensim`
--

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `wi_statistics` (
  `serverIP` varchar(64) NOT NULL,
  `serverPort` int(11) NOT NULL,
  `version` varchar(255) NOT NULL,
  `lastcheck` int(10) NOT NULL,
  `failcounter` int(11) NOT NULL,
  UNIQUE KEY `serverIP` (`serverIP`,`serverPort`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

