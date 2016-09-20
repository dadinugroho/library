/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  dadinugroho
 * Created: Sep 20, 2016
 */

-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema library
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema library
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `library` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `library` ;

-- -----------------------------------------------------
-- Table `library`.`book`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `library`.`book` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT NULL,
  `publisher` VARCHAR(50) NOT NULL,
  `isbn` VARCHAR(10) NOT NULL,
  `published_date` DATE NOT NULL,
  `status` TINYINT(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `isbn_UNIQUE` (`isbn` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `library`.`author`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `library`.`author` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(100) NOT NULL,
  `lastname` VARCHAR(100) NOT NULL,
  `status` TINYINT(4) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `library`.`book_author`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `library`.`book_author` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `bookFk` INT NOT NULL,
  `authorFk` INT NOT NULL,
  PRIMARY KEY (`id`, `authorFk`, `bookFk`),
  INDEX `book_idx` (`bookFk` ASC),
  INDEX `author_idx` (`authorFk` ASC),
  CONSTRAINT `book`
    FOREIGN KEY (`bookFk`)
    REFERENCES `library`.`book` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `author`
    FOREIGN KEY (`authorFk`)
    REFERENCES `library`.`author` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
