-- phpMyAdmin SQL Dump
-- version 3.1.3
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 25 Apr 2009 om 20:00
-- Serverversie: 5.1.32
-- PHP-Versie: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `opensim`
--

CREATE TABLE IF NOT EXISTS `wi_offline_msgs` (
  `uuid` varchar(36) NOT NULL,
  `message` text NOT NULL,
  KEY `uuid` (`uuid`)
) ENGINE=MyISAM
