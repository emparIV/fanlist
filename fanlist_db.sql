-- MySQL Script generated by MySQL Workbench
-- Tue Feb 13 16:13:21 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema fanlist
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `fanlist` ;

-- -----------------------------------------------------
-- Schema fanlist
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `fanlist` DEFAULT CHARACTER SET utf8 ;
USE `fanlist` ;

-- -----------------------------------------------------
-- Table `fanlist`.`settings`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fanlist`.`settings` ;

CREATE TABLE IF NOT EXISTS `fanlist`.`settings` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `setting` VARCHAR(255) NULL,
  `value` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fanlist`.`temp`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fanlist`.`temp` ;

CREATE TABLE IF NOT EXISTS `fanlist`.`temp` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `mail` VARCHAR(255) NOT NULL,
  `country` VARCHAR(255) NOT NULL,
  `gender` VARCHAR(255) NULL,
  `twitter_url` VARCHAR(255) NULL,
  `facebook_url` VARCHAR(255) NULL,
  `instagram_url` VARCHAR(255) NULL,
  `url` VARCHAR(255) NULL,
  `show_mail` TINYINT(1) NULL,
  `comment` VARCHAR(255) NULL,
  `rules` TINYINT(1) NULL,
  `IP` VARCHAR(255) NULL,
  `add_date` VARCHAR(255) NULL,
  `custom_field1` VARCHAR(255) NULL,
  `custom_field2` VARCHAR(255) NULL,
  `custom_field3` VARCHAR(255) NULL,
  `custom_field4` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fanlist`.`member`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fanlist`.`member` ;

CREATE TABLE IF NOT EXISTS `fanlist`.`member` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `mail` VARCHAR(255) NOT NULL,
  `country` VARCHAR(255) NOT NULL,
  `gender` VARCHAR(255) NULL,
  `twitter_url` VARCHAR(255) NULL,
  `facebook_url` VARCHAR(255) NULL,
  `instagram_url` VARCHAR(255) NULL,
  `url` VARCHAR(255) NULL,
  `show_mail` TINYINT(1) NULL,
  `comment` VARCHAR(255) NULL,
  `profile_pic` VARCHAR(255) NULL,
  `add_date` DATETIME NULL,
  `custom_field1` VARCHAR(255) NULL,
  `custom_field2` VARCHAR(255) NULL,
  `custom_field3` VARCHAR(255) NULL,
  `custom_field4` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fanlist`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fanlist`.`user` ;

CREATE TABLE IF NOT EXISTS `fanlist`.`user` (
  `id` INT NOT NULL,
  `name` VARCHAR(255) NULL,
  `mail` VARCHAR(255) NULL,
  `username` VARCHAR(255) NULL,
  `password` VARCHAR(255) NULL,
  `url` VARCHAR(255) NULL,
  `profile_pic` VARCHAR(255) NULL,
  `custom_field1` VARCHAR(255) NULL,
  `custom_field2` VARCHAR(255) NULL,
  `custom_field3` VARCHAR(255) NULL,
  `custom_field4` VARCHAR(255) NULL,
  `custom_field5` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fanlist`.`news`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fanlist`.`news` ;

CREATE TABLE IF NOT EXISTS `fanlist`.`news` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NULL,
  `content` VARCHAR(255) NULL,
  `date` DATETIME NULL,
  `posted` VARCHAR(255) NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_news_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_news_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `fanlist`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fanlist`.`comments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fanlist`.`comments` ;

CREATE TABLE IF NOT EXISTS `fanlist`.`comments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `date` DATETIME NULL,
  `comment` VARCHAR(255) NULL,
  `edited` TINYINT(1) NULL,
  `news_id` INT NOT NULL,
  `member_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comments_news1_idx` (`news_id` ASC),
  INDEX `fk_comments_member1_idx` (`member_id` ASC),
  INDEX `fk_comments_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_comments_news1`
    FOREIGN KEY (`news_id`)
    REFERENCES `fanlist`.`news` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_member1`
    FOREIGN KEY (`member_id`)
    REFERENCES `fanlist`.`member` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `fanlist`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fanlist`.`giveaways`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fanlist`.`giveaways` ;

CREATE TABLE IF NOT EXISTS `fanlist`.`giveaways` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NULL,
  `content` VARCHAR(255) NULL,
  `start_date` DATETIME NULL,
  `end_date` VARCHAR(255) NULL,
  `winners_num` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fanlist`.`entries`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fanlist`.`entries` ;

CREATE TABLE IF NOT EXISTS `fanlist`.`entries` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `date` VARCHAR(255) NULL,
  `winner` VARCHAR(255) NULL,
  `giveaways_id` INT NOT NULL,
  `member_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_entries_giveaways1_idx` (`giveaways_id` ASC),
  INDEX `fk_entries_member1_idx` (`member_id` ASC),
  CONSTRAINT `fk_entries_giveaways1`
    FOREIGN KEY (`giveaways_id`)
    REFERENCES `fanlist`.`giveaways` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_entries_member1`
    FOREIGN KEY (`member_id`)
    REFERENCES `fanlist`.`member` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;