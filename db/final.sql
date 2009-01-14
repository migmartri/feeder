-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.75


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema feeder
--

CREATE DATABASE IF NOT EXISTS feeder;
USE feeder;

--
-- Definition of table `feeder`.`favourites`
--

DROP TABLE IF EXISTS `feeder`.`favourites`;
CREATE TABLE  `feeder`.`favourites` (
  `post_id` smallint(6) NOT NULL,
  `created_at` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `user_id` smallint(6) NOT NULL,
  PRIMARY KEY  (`post_id`,`user_id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `favourites_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `favourites_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `feeder`.`favourites`
--

/*!40000 ALTER TABLE `favourites` DISABLE KEYS */;
LOCK TABLES `favourites` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `favourites` ENABLE KEYS */;


--
-- Definition of table `feeder`.`feeds`
--

DROP TABLE IF EXISTS `feeder`.`feeds`;
CREATE TABLE  `feeder`.`feeds` (
  `id` smallint(11) NOT NULL auto_increment,
  `url` varchar(255) collate utf8_spanish_ci NOT NULL,
  `subcriptions_count` int(11) NOT NULL default '0',
  `name` varchar(255) collate utf8_spanish_ci NOT NULL,
  `updated_at` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `feeder`.`feeds`
--

/*!40000 ALTER TABLE `feeds` DISABLE KEYS */;
LOCK TABLES `feeds` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `feeds` ENABLE KEYS */;


--
-- Definition of table `feeder`.`feeds_planets`
--

DROP TABLE IF EXISTS `feeder`.`feeds_planets`;
CREATE TABLE  `feeder`.`feeds_planets` (
  `planet_id` smallint(6) NOT NULL,
  `feed_id` smallint(6) NOT NULL,
  PRIMARY KEY  (`planet_id`,`feed_id`),
  KEY `planet_id` (`planet_id`),
  KEY `feed_id` (`feed_id`),
  CONSTRAINT `feed_id` FOREIGN KEY (`feed_id`) REFERENCES `feeds` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `planet_id` FOREIGN KEY (`planet_id`) REFERENCES `planets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `feeder`.`feeds_planets`
--

/*!40000 ALTER TABLE `feeds_planets` DISABLE KEYS */;
LOCK TABLES `feeds_planets` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `feeds_planets` ENABLE KEYS */;


--
-- Definition of table `feeder`.`planets`
--

DROP TABLE IF EXISTS `feeder`.`planets`;
CREATE TABLE  `feeder`.`planets` (
  `id` smallint(6) NOT NULL auto_increment,
  `name` varchar(255) collate utf8_spanish_ci NOT NULL,
  `user_id` smallint(6) NOT NULL,
  `description` text collate utf8_spanish_ci NOT NULL,
  `created_at` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `feeds_count` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `feeder`.`planets`
--

/*!40000 ALTER TABLE `planets` DISABLE KEYS */;
LOCK TABLES `planets` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `planets` ENABLE KEYS */;


--
-- Definition of table `feeder`.`posts`
--

DROP TABLE IF EXISTS `feeder`.`posts`;
CREATE TABLE  `feeder`.`posts` (
  `id` smallint(6) NOT NULL auto_increment,
  `feed_id` smallint(6) NOT NULL,
  `title` varchar(255) collate utf8_spanish_ci NOT NULL,
  `content` text collate utf8_spanish_ci,
  `published_at` datetime NOT NULL,
  `url` varchar(255) collate utf8_spanish_ci NOT NULL,
  `description` text collate utf8_spanish_ci,
  PRIMARY KEY  (`id`),
  KEY `feed_i` (`feed_id`),
  CONSTRAINT `feed_i` FOREIGN KEY (`feed_id`) REFERENCES `feeds` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `feeder`.`posts`
--

/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
LOCK TABLES `posts` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;


--
-- Definition of table `feeder`.`profiles`
--

DROP TABLE IF EXISTS `feeder`.`profiles`;
CREATE TABLE  `feeder`.`profiles` (
  `id` smallint(6) NOT NULL auto_increment,
  `name` varchar(255) collate utf8_spanish_ci default NULL,
  `surname` varchar(255) collate utf8_spanish_ci default NULL,
  `phone` varchar(255) collate utf8_spanish_ci default NULL,
  `city` varchar(255) collate utf8_spanish_ci default NULL,
  `flickr` varchar(255) collate utf8_spanish_ci default NULL,
  `twitter` varchar(255) collate utf8_spanish_ci default NULL,
  `web` varchar(255) collate utf8_spanish_ci default NULL,
  `user_id` smallint(6) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `users_id` (`user_id`),
  CONSTRAINT `users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `feeder`.`profiles`
--

/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
LOCK TABLES `profiles` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;


--
-- Definition of table `feeder`.`users`
--

DROP TABLE IF EXISTS `feeder`.`users`;
CREATE TABLE  `feeder`.`users` (
  `id` smallint(6) NOT NULL auto_increment,
  `login` varchar(255) collate utf8_spanish_ci NOT NULL,
  `password` varchar(255) collate utf8_spanish_ci NOT NULL,
  `email` varchar(255) collate utf8_spanish_ci NOT NULL,
  `created_at` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `feeder`.`users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
LOCK TABLES `users` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
