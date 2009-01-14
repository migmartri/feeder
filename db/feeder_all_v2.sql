SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE DATABASE IF NOT EXISTS `feeder` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci ;
--CREATE DATABASE `feeder`; 
USE `feeder`;

-- -----------------------------------------------------
-- Table `feeder`.`Users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `feeder`.`users` ;

CREATE  TABLE IF NOT EXISTS `feeder`.`users` (
  `id` SMALLINT(6) NOT NULL auto_increment,
  `login` VARCHAR(255) NOT NULL ,
  `password` VARCHAR(255) NOT NULL ,
  `email` VARCHAR(255) NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `feeder`.`Favourites`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `feeder`.`favourites` ;

CREATE  TABLE IF NOT EXISTS `feeder`.`favourites` (
  `user_id` INT(11) NOT NULL ,
  `post_id` INT(11) NOT NULL ,
  `created_at` TIMESTAMP NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `users_id` SMALLINT(6) NULL ,
  PRIMARY KEY (`user_id`, `post_id`) ,
  CONSTRAINT `fk_favourites_users`
    FOREIGN KEY (`users_id` )
    REFERENCES `feeder`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE INDEX `fk_favourites_users` ON `feeder`.`favourites` (`users_id` ASC) ;


-- -----------------------------------------------------
-- Table `feeder`.`Planets`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `feeder`.`planets` ;

CREATE  TABLE IF NOT EXISTS `feeder`.`planets` (
  `id` SMALLINT(6) NOT NULL auto_increment,
  `name` VARCHAR(255) NULL default NULL,
  `user_id` INT(6) NULL NOT NULL,
  `description` TEXT NULL ,
  `created_at` TIMESTAMP NULL NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `feeds_count` INT(11) default '0',
  `users_id` SMALLINT(6) NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_planets_users`
    FOREIGN KEY (`users_id` )
    REFERENCES `feeder`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE INDEX `fk_planets_users` ON `feeder`.`planets` (`users_id` ASC) ;


-- -----------------------------------------------------
-- Table `feeder`.`Feeds_Planets`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `feeder`.`feeds_planets` ;

CREATE  TABLE IF NOT EXISTS `feeder`.`feeds_planets` (
  `planet_id` SMALLINT(6) NOT NULL ,
  `feeds_id` SMALLINT(6) NOT NULL ,
  `planets_id` SMALLINT(6) NULL ,
  PRIMARY KEY (`planet_id`) ,
  CONSTRAINT `fk_feeds_planets_planets`
    FOREIGN KEY (`planets_id` )
    REFERENCES `feeder`.`planets` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE INDEX `fk_feeds_planets_planets` ON `feeder`.`feeds_planets` (`planets_id` ASC) ;


-- -----------------------------------------------------
-- Table `feeder`.`Feeds`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `feeder`.`feeds` ;

CREATE  TABLE IF NOT EXISTS `feeder`.`feeds` (
  `id` SMALLINT(11) NOT NULL auto_increment,
  `url` VARCHAR(255) NULL default NULL,
  `subcriptions_count` INT(11) NULL default '0',
  `name` VARCHAR(255) NULL default NULL,
  `updated_at` TIMESTAMP NULL default NULL,
  `feeds_planets_planet_id` SMALLINT(6) NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_feeds_feeds_planets`
    FOREIGN KEY (`feeds_planets_planet_id` )
    REFERENCES `feeder`.`feeds_planets` (`planet_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE INDEX `fk_feeds_feeds_planets` ON `feeder`.`feeds` (`feeds_planets_planet_id` ASC) ;


-- -----------------------------------------------------
-- Table `feeder`.`Posts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `feeder`.`posts` ;

CREATE  TABLE IF NOT EXISTS `feeder`.`posts` (
  `id` SMALLINT(6) NOT NULL auto_increment,
  `feed_id` SMALLINT(6) NOT NULL,
  `title` VARCHAR(255) default NULL ,
  `content` TEXT  ,
  `published_at` DATETIME default NULL ,
  `url` VARCHAR(255) default NULL ,
  `description` TEXT NULL ,
  `feeds_id` SMALLINT(11) NULL ,
  `favourites_id` INT(11) NULL ,
  `favourites_post_id` INT(11) NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_post_feeds`
    FOREIGN KEY (`feeds_id` )
    REFERENCES `feeder`.`feeds` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_post_favourites`
    FOREIGN KEY (`favourites_id` , `favourites_post_id` )
    REFERENCES `feeder`.`favourites` (`id` , `post_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE INDEX `fk_post_feeds` ON `feeder`.`posts` (`feeds_id` ASC) ;

CREATE INDEX `fk_post_favourites` ON `feeder`.`posts` (`favourites_id` ASC, `favourites_post_id` ASC) ;


-- -----------------------------------------------------
-- Table `feeder`.`Profiles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `feeder`.`profiles` ;

CREATE  TABLE IF NOT EXISTS `feeder`.`profiles` (
  `id` SMALLINT(6) NOT NULL auto_increment ,
  `name` VARCHAR(255) default NULL ,
  `surname` VARCHAR(255) default NULL ,
  `phone` VARCHAR(255) default NULL ,
  `city` VARCHAR(255) default NULL ,
  `flickr` VARCHAR(255) default NULL ,
  `twitter` VARCHAR(255) default NULL ,
  `web` VARCHAR(255) default NULL ,
  `user_id` SMALLINT(6) default NULL ,
  `users_id` SMALLINT(6) NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_profiles_users`
    FOREIGN KEY (`users_id` )
    REFERENCES `feeder`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE INDEX `fk_profiles_users` ON `feeder`.`profiles` (`users_id` ASC) ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

