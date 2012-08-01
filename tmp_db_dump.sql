-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 31, 2012 at 06:39 PM
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `book`
--

INSERT INTO `book` VALUES(12, 'Häxan och lejonet', 9789163846489, 'Clive Staples Lewis', 'http://bks5.books.google.com/books?id=V3xScgAACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_gdata');
INSERT INTO `book` VALUES(13, 'In a sunburned country', 9780767903868, 'Bill Bryson', 'http://bks2.books.google.com/books?id=7ZELqUsksIwC&printsec=frontcover&img=1&zoom=5&source=gbs_gdata');
INSERT INTO `book` VALUES(14, 'Poems New and Collected', 9780156011464, 'Wislawa Szymborska, Stanisław Barańczak, Clare Cavanagh', 'http://bks5.books.google.com/books?id=wt4sO8GUBX8C&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_gdata');
INSERT INTO `book` VALUES(15, 'The Hunger Games', 9780439023528, 'Suzanne Collins', 'http://bks6.books.google.com/books?id=hlb_sM1AN0gC&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_gdata');
INSERT INTO `book` VALUES(16, 'Foundation', 9780553293357, 'Isaac Asimov', 'http://bks1.books.google.com/books?id=IwywDY4P6gsC&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_gdata');
INSERT INTO `book` VALUES(17, 'The End of Eternity', 9780765319197, 'Isaac Asimov', 'http://bks3.books.google.com/books?id=1X5V5kWJgh0C&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_gdata');
INSERT INTO `book` VALUES(18, '127 Hours, Between a Rock and a Hard Place', 9781451618501, 'Aron Ralston', 'http://bks6.books.google.com/books?id=_CJmjFsJY1cC&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_gdata');
INSERT INTO `book` VALUES(19, 'How Google Tests Software', 9780321803023, 'James A. Whittaker, Jason Arbon, Jeff Carollo', 'http://bks3.books.google.com/books?id=vHlTOVTKHeUC&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_gdata');
INSERT INTO `book` VALUES(20, 'Snow Crash', 9780553380958, 'Neal Stephenson', 'http://bks7.books.google.com/books?id=RMd3GpIFxcUC&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_gdata');

-- --------------------------------------------------------

--
-- Table structure for table `book_owner`
--

CREATE TABLE IF NOT EXISTS `book_owner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `book_id` (`book_id`),
  KEY `is_deleted` (`is_deleted`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `book_owner`
--

INSERT INTO `book_owner` VALUES(1, 12, 1, 0, '2012-07-17 14:49:23', '2012-07-17 14:49:23');
INSERT INTO `book_owner` VALUES(2, 13, 1, 0, '2012-07-17 14:50:17', '2012-07-17 14:50:17');
INSERT INTO `book_owner` VALUES(3, 14, 1, 0, '2012-07-17 14:50:29', '2012-07-17 14:50:29');
INSERT INTO `book_owner` VALUES(4, 15, 1, 0, '2012-07-17 17:21:44', '2012-07-17 17:21:44');
INSERT INTO `book_owner` VALUES(5, 16, 1, 0, '2012-07-17 23:13:02', '2012-07-17 23:13:02');
INSERT INTO `book_owner` VALUES(6, 17, 1, 0, '2012-07-18 17:00:13', '2012-07-18 17:00:13');
INSERT INTO `book_owner` VALUES(7, 16, 3, 0, '2012-07-20 17:14:26', '2012-07-20 17:14:26');
INSERT INTO `book_owner` VALUES(8, 18, 5, 0, '2012-07-27 23:33:04', '2012-07-27 23:33:04');
INSERT INTO `book_owner` VALUES(9, 19, 5, 0, '2012-07-27 23:34:03', '2012-07-27 23:34:03');
INSERT INTO `book_owner` VALUES(10, 14, 5, 0, '2012-07-27 23:46:43', '2012-07-27 23:46:43');
INSERT INTO `book_owner` VALUES(11, 20, 1, 0, '2012-07-31 18:09:18', '2012-07-31 18:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `borrow_item`
--

CREATE TABLE IF NOT EXISTS `borrow_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `borrowed_by` int(11) NOT NULL COMMENT 'user id of the person who borrowed the item',
  `item_type` int(11) NOT NULL COMMENT 'An id to match the type of item borrowed. For now this should be 1, to indicate a book was borrowed',
  `item_id` int(11) NOT NULL COMMENT 'foreign key to the item borrowed',
  `borrowed_date` datetime NOT NULL,
  `returned` tinyint(1) NOT NULL,
  `returned_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9C361F3BE44E8C7A` (`borrowed_by`),
  KEY `item_id` (`item_id`),
  KEY `returned` (`returned`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `borrow_item`
--

INSERT INTO `borrow_item` VALUES(4, 1, 1, 7, '2012-07-27 13:22:12', 0, NULL);
INSERT INTO `borrow_item` VALUES(5, 5, 1, 1, '2012-07-27 23:35:07', 0, NULL);
INSERT INTO `borrow_item` VALUES(6, 1, 1, 9, '2012-07-30 17:25:19', 0, NULL);
INSERT INTO `borrow_item` VALUES(7, 3, 1, 6, '2012-07-30 17:26:02', 0, NULL);
INSERT INTO `borrow_item` VALUES(8, 3, 1, 5, '2012-07-30 17:26:14', 0, NULL);
INSERT INTO `borrow_item` VALUES(9, 4, 1, 3, '2012-07-31 18:10:24', 0, NULL);

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

--
-- Dumping data for table `user`
--

INSERT INTO `user` VALUES(1, 'test', 'test', 'test@test.com', 'test@test.com', 1, 'p809uy41s5wogk0kg0kkw0wwo4ws0o4', 'XVGF49rZkkA1Nm54orBNu64XzNbchduevW6ypPgV8FW/lHgZ3UTTBdG00HIeaWo1WoOUJFvdXYW+FMudXNkvvg==', '2012-07-31 18:34:13', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '', '', '', NULL, NULL, '');
INSERT INTO `user` VALUES(2, 'test 2_root', 'test 2_root', 'email2@email.com', 'email2@email.com', 1, '1rphrg564k80cwkk0gwg00ck0cwggc8', 'o7BGDiCgZ7NNKbGJRAofSoYg4BEWsxJ0Oaw3gCBpKEziJDC9r6o3bj3tnMtF0CY552AsK0p+p97p7V/Pp29qow==', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '', '', '', NULL, NULL, '');
INSERT INTO `user` VALUES(3, 'test 3', 'test 3', 'test3@test.com', 'test3@test.com', 1, '30o5xx80huec0wk4ocw48ksscwokoo0', '2ISzXyYPJ6cnPrvayUTQspb6k/k+az4ktUloqscdMCwUvAtakTrKxi0jKAnkGn9/mX7YrbAQP5uuaXMtg6+igA==', '2012-07-31 14:54:53', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'My name is test', '', '', NULL, NULL, '');
INSERT INTO `user` VALUES(4, 'test 4', 'test 4', 'test4@email.com', 'test4@email.com', 1, 'gbw4ezvx3zks8sswws8c408gsswk0ww', 'ilnbS9y05wHfWnKjNnD7r2SDC7yfqmiGqtGNq3oLDzo1hmdPUZZIM3wWe6uhBzxeHOSlPS1h9yvtbKamQt7FhA==', '2012-07-31 18:10:04', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'New test', '', '', NULL, NULL, '');
INSERT INTO `user` VALUES(5, 'galia', 'galia', 'galia.aharoni@gmail.com', 'galia.aharoni@gmail.com', 1, 'ngjjqcbbmu8koc0okowgocg4wock80s', 'LIDd8qy8y9tTuPpvRLLJFZqn+C7fP2I4UYJPMPSRjeAkC9+Jb93oKW9W90fGIMxuS8oj9JmvI6qRywtwpVM97Q==', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'galia', 'aharoni', '2119 Central Ave', 'Apt J', 'Alameda', '7604206913');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrow_item`
--
ALTER TABLE `borrow_item`
  ADD CONSTRAINT `FK_9C361F3BE44E8C7A` FOREIGN KEY (`borrowed_by`) REFERENCES `user` (`id`);

