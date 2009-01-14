SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `feeder` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `feeder`;

-- -----------------------------------------------------
-- Table `feeder`.`Users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `feeder`.`Users` ;

CREATE  TABLE IF NOT EXISTS `feeder`.`Users` (
  `id` SMALLINT(6) NOT NULL ,
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
DROP TABLE IF EXISTS `feeder`.`Favourites` ;

CREATE  TABLE IF NOT EXISTS `feeder`.`Favourites` (
  `id` INT(11) NOT NULL ,
  `post_id` INT(11) NOT NULL ,
  `created_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`, `post_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `feeder`.`Planets`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `feeder`.`Planets` ;

CREATE  TABLE IF NOT EXISTS `feeder`.`Planets` (
  `id` SMALLINT(6) NOT NULL ,
  `name` VARCHAR(255) NULL ,
  `user_id` INT(6) NULL ,
  `description` TEXT NULL ,
  `created_at` TIMESTAMP NULL ,
  `feeds_count` INT(11) NULL ,
  `Users_id` SMALLINT(6) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Planets_Users` (`Users_id` ASC) ,
  CONSTRAINT `fk_Planets_Users`
    FOREIGN KEY (`Users_id` )
    REFERENCES `feeder`.`Users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `feeder`.`Feeds_Planets`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `feeder`.`Feeds_Planets` ;

CREATE  TABLE IF NOT EXISTS `feeder`.`Feeds_Planets` (
  `planet_id` SMALLINT(6) NOT NULL ,
  `feeds_id` SMALLINT(6) NULL ,
  `Planets_id` SMALLINT(6) NULL ,
  PRIMARY KEY (`planet_id`) ,
  INDEX `fk_Feeds_Planets_Planets` (`Planets_id` ASC) ,
  CONSTRAINT `fk_Feeds_Planets_Planets`
    FOREIGN KEY (`Planets_id` )
    REFERENCES `feeder`.`Planets` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `feeder`.`Feeds`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `feeder`.`Feeds` ;

CREATE  TABLE IF NOT EXISTS `feeder`.`Feeds` (
  `id` SMALLINT(11) NOT NULL ,
  `url` VARCHAR(255) NULL ,
  `subcriptions_count` INT(11) NULL ,
  `name` VARCHAR(255) NULL ,
  `updated_at` TIMESTAMP NULL ,
  `Feeds_Planets_planet_id` SMALLINT(6) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Feeds_Feeds_Planets` (`Feeds_Planets_planet_id` ASC) ,
  CONSTRAINT `fk_Feeds_Feeds_Planets`
    FOREIGN KEY (`Feeds_Planets_planet_id` )
    REFERENCES `feeder`.`Feeds_Planets` (`planet_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `feeder`.`Post`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `feeder`.`Post` ;

CREATE  TABLE IF NOT EXISTS `feeder`.`Post` (
  `id` SMALLINT(6) NOT NULL ,
  `feed_id` SMALLINT(6) NULL ,
  `title` VARCHAR(255) NULL ,
  `content` TEXT NULL ,
  `published_at` DATETIME NULL ,
  `url` VARCHAR(255) NULL ,
  `description` TEXT NULL ,
  `Feeds_id` SMALLINT(11) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Post_Feeds` (`Feeds_id` ASC) ,
  CONSTRAINT `fk_Post_Feeds`
    FOREIGN KEY (`Feeds_id` )
    REFERENCES `feeder`.`Feeds` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `feeder`.`Profiles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `feeder`.`Profiles` ;

CREATE  TABLE IF NOT EXISTS `feeder`.`Profiles` (
  `id` SMALLINT(6) NOT NULL ,
  `name` VARCHAR(255) NULL ,
  `surname` VARCHAR(255) NULL ,
  `phone` VARCHAR(255) NULL ,
  `city` VARCHAR(255) NULL ,
  `flickr` VARCHAR(255) NULL ,
  `twitter` VARCHAR(255) NULL ,
  `web` VARCHAR(255) NULL ,
  `user_id` SMALLINT(6) NULL ,
  `Users_id` SMALLINT(6) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Profiles_Users` (`Users_id` ASC) ,
  CONSTRAINT `fk_Profiles_Users`
    FOREIGN KEY (`Users_id` )
    REFERENCES `feeder`.`Users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
