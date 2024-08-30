-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema db-joille
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db-joille
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db-joille` DEFAULT CHARACTER SET utf8 ;
USE `db-joille` ;

-- -----------------------------------------------------
-- Table `db-joille`.`status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db-joille`.`status` (
  `id` INT NOT NULL,
  `details` VARCHAR(255) NULL,
  `endDate` VARCHAR(255) NULL,
  `startDate` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db-joille`.`payments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db-joille`.`payments` (
  `id` INT NOT NULL,
  `price` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db-joille`.`services`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db-joille`.`services` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `payment_id` INT NOT NULL,
  `idUser` INT NULL,
  `type` VARCHAR(255) NULL,
  `value` VARCHAR(15) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_services_payment1_idx` (`payment_id` ASC) VISIBLE,
  CONSTRAINT `fk_services_payment1`
    FOREIGN KEY (`payment_id`)
    REFERENCES `db-joille`.`payments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db-joille`.`users_categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db-joille`.`users_categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db-joille`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db-joille`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `status_id` INT NOT NULL,
  `services_id` INT NOT NULL,
  `users_categories_id` INT NOT NULL,
  `user` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `atributes` TEXT(255) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_status1_idx` (`status_id` ASC) VISIBLE,
  INDEX `fk_users_services1_idx` (`services_id` ASC) VISIBLE,
  INDEX `fk_users_usersCategories1_idx` (`users_categories_id` ASC) VISIBLE,
  CONSTRAINT `fk_users_status1`
    FOREIGN KEY (`status_id`)
    REFERENCES `db-joille`.`status` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_services1`
    FOREIGN KEY (`services_id`)
    REFERENCES `db-joille`.`services` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_usersCategories1`
    FOREIGN KEY (`users_categories_id`)
    REFERENCES `db-joille`.`users_categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db-joille`.`contact`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db-joille`.`contact` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `users_id` INT NOT NULL,
  `contactEmaill` VARCHAR(255) NULL,
  `contactName` VARCHAR(255) NULL,
  `message` MEDIUMTEXT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_contact_users_idx` (`users_id` ASC) VISIBLE,
  CONSTRAINT `fk_contact_users`
    FOREIGN KEY (`users_id`)
    REFERENCES `db-joille`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
