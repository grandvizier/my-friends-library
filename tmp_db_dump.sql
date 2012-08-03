-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 03, 2012 at 03:39 PM
-- Server version: 5.1.63
-- PHP Version: 5.3.5-1ubuntu7.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `isbn` bigint(13) unsigned DEFAULT NULL COMMENT 'International Standard Book Number',
  `author` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `image` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `isbn` (`isbn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

--
-- Table structure for table `borrow_user_book`
--

CREATE TABLE IF NOT EXISTS `borrow_user_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `borrowed_by` int(11) NOT NULL COMMENT 'user id of the person who borrowed the item',
  `user_book_id` int(11) NOT NULL COMMENT 'foreign key to user_book table',
  `borrowed_date` datetime NOT NULL,
  `returned` tinyint(1) NOT NULL,
  `returned_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`user_book_id`),
  KEY `returned` (`returned`),
  KEY `IDX_9C361F3BE44E8C7A` (`borrowed_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `username_canonical` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_canonical` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_book`
--

CREATE TABLE IF NOT EXISTS `user_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `is_deleted` (`is_deleted`),
  KEY `FK_B164EFF816A2B381` (`book_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrow_user_book`
--
ALTER TABLE `borrow_user_book`
  ADD CONSTRAINT `FK_7E849724EAFAD8B` FOREIGN KEY (`user_book_id`) REFERENCES `user_book` (`id`),
  ADD CONSTRAINT `FK_9C361F3BE44E8C7A` FOREIGN KEY (`borrowed_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `user_book`
--
ALTER TABLE `user_book`
  ADD CONSTRAINT `FK_B164EFF8A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_B164EFF816A2B381` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`);

