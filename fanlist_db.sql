-- MySQL Script generated by MySQL Workbench
-- Sat Feb 17 11:57:47 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema fanlist
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema fanlist
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `fanlist` DEFAULT CHARACTER SET utf8 ;
USE `fanlist` ;

-- -----------------------------------------------------
-- Table `fanlist`.`settings`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fanlist`.`settings` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `setting` VARCHAR(255) NULL,
  `value` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fanlist`.`temp`
-- -----------------------------------------------------
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
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fanlist`.`member`
-- -----------------------------------------------------
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
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fanlist`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fanlist`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL,
  `mail` VARCHAR(255) NULL,
  `username` VARCHAR(255) NULL,
  `password` VARCHAR(255) NULL,
  `url` VARCHAR(255) NULL,
  `profile_pic` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fanlist`.`news`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fanlist`.`news` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NULL,
  `content` VARCHAR(255) NULL,
  `date` DATETIME NULL,
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
-- Table `fanlist`.`rules`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fanlist`.`rules` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
