SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `feeder` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `feeder`;

-- -----------------------------------------------------
-- Table `feeder`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `feeder`.`users` (
  `id` SMALLINT(6) NOT NULL AUTO_INCREMENT ,
  `login` VARCHAR(255) NOT NULL ,
  `password` VARCHAR(255) NOT NULL ,
  `email` VARCHAR(255) NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `feeder`.`feeds`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `feeder`.`feeds` (
  `id` SMALLINT(11) NOT NULL AUTO_INCREMENT ,
  `url` VARCHAR(255) NOT NULL ,
  `subcriptions_count` INT(11) NOT NULL DEFAULT 0 ,
  `name` VARCHAR(255) NOT NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `feeder`.`posts`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `feeder`.`posts` (
  `id` SMALLINT(6) NOT NULL AUTO_INCREMENT ,
  `feed_id` SMALLINT(6) NOT NULL ,
  `title` VARCHAR(255) NOT NULL ,
  `content` TEXT NULL ,
  `published_at` DATETIME NOT NULL ,
  `url` VARCHAR(255) NOT NULL ,
  `description` TEXT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `feed_i` (`feed_id` ASC) ,
  CONSTRAINT `feed_i`
    FOREIGN KEY (`feed_id` )
    REFERENCES `feeder`.`feeds` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `feeder`.`favourites`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `feeder`.`favourites` (
  `post_id` INT(11) NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `user_id` SMALLINT(6) NOT NULL ,
  PRIMARY KEY (`post_id`, `user_id`) ,
  INDEX `post_id` (`post_id` ASC) ,
  INDEX `user_id` (`user_id` ASC) ,
  CONSTRAINT `post_id`
    FOREIGN KEY (`post_id` )
    REFERENCES `feeder`.`posts` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `user_id`
    FOREIGN KEY (`user_id` )
    REFERENCES `feeder`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE RESTRICT)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `feeder`.`planets`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `feeder`.`planets` (
  `id` SMALLINT(6) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `user_id` INT(6) NOT NULL ,
  `description` TEXT NOT NULL ,
  `created_at` TIMESTAMP NOT NULL ,
  `feeds_count` INT(11) NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  INDEX `user_id` (`user_id` ASC) ,
  CONSTRAINT `user_id`
    FOREIGN KEY (`user_id` )
    REFERENCES `feeder`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `feeder`.`feeds_planets`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `feeder`.`feeds_planets` (
  `planet_id` SMALLINT(6) NOT NULL ,
  `feed_id` SMALLINT(6) NOT NULL ,
  PRIMARY KEY (`planet_id`, `feed_id`) ,
  INDEX `planet_id` (`planet_id` ASC) ,
  INDEX `feed_id` (`feed_id` ASC) ,
  CONSTRAINT `planet_id`
    FOREIGN KEY (`planet_id` )
    REFERENCES `feeder`.`planets` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `feed_id`
    FOREIGN KEY (`feed_id` )
    REFERENCES `feeder`.`feeds` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `feeder`.`profiles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `feeder`.`profiles` (
  `id` SMALLINT(6) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  `surname` VARCHAR(255) NULL ,
  `phone` VARCHAR(255) NULL ,
  `city` VARCHAR(255) NULL ,
  `flickr` VARCHAR(255) NULL ,
  `twitter` VARCHAR(255) NULL ,
  `web` VARCHAR(255) NULL ,
  `user_id` SMALLINT(6) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `users_id` (`user_id` ASC) ,
  CONSTRAINT `users_id`
    FOREIGN KEY (`user_id` )
    REFERENCES `feeder`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
