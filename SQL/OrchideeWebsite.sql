SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `Orchid` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `Orchid` ;

-- -----------------------------------------------------
-- Table `Orchid`.`Role`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Orchid`.`Role` (
  `Role` VARCHAR(45) NOT NULL ,
  `description` VARCHAR(45) NULL ,
  PRIMARY KEY (`Role`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Orchid`.`User`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Orchid`.`User` (
  `email` VARCHAR(100) NOT NULL ,
  `surname` VARCHAR(60) NOT NULL ,
  `prefix` VARCHAR(11) NULL ,
  `lastname` VARCHAR(60) NOT NULL ,
  `address` VARCHAR(45) NOT NULL ,
  `zipcode` VARCHAR(45) NOT NULL ,
  `residence` VARCHAR(50) NOT NULL ,
  `activated` TINYINT(1) NOT NULL ,
  `rol` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(50) NOT NULL ,
  PRIMARY KEY (`email`) ,
  INDEX `fk_User_Role_idx` (`rol` ASC) ,
  CONSTRAINT `fk_User_Role`
    FOREIGN KEY (`rol` )
    REFERENCES `Orchid`.`Role` (`Role` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Orchid`.`Contact`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Orchid`.`Contact` (
  `id` INT NOT NULL ,
  `email` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Orchid`.`Order`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Orchid`.`Order` (
  `id` INT NOT NULL ,
  `email` VARCHAR(100) NOT NULL ,
  `total_price` FLOAT NOT NULL ,
  `status` ENUM('aanwezig', 'afwezig') NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Order_User_idx` (`email` ASC) ,
  CONSTRAINT `fk_Order_User`
    FOREIGN KEY (`email` )
    REFERENCES `Orchid`.`User` (`email` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Orchid`.`Product`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Orchid`.`Product` (
  `id` INT NOT NULL ,
  `name` VARCHAR(100) NOT NULL ,
  `description` TEXT NOT NULL ,
  `category` VARCHAR(60) NOT NULL ,
  `price` FLOAT NOT NULL ,
  `picture` VARCHAR(70) NOT NULL ,
  `amount` INT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Orchid`.`Order_items`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Orchid`.`Order_items` (
  `id` INT NOT NULL ,
  `order` INT NOT NULL ,
  `product` INT NOT NULL ,
  `quantity` INT NOT NULL ,
  PRIMARY KEY (`id`, `order`, `product`) ,
  INDEX `fk_Orderregel_Order_idx` (`order` ASC) ,
  INDEX `fk_Orderregel_Film_idx` (`product` ASC) ,
  CONSTRAINT `fk_Orderregel_Order`
    FOREIGN KEY (`order` )
    REFERENCES `Orchid`.`Order` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Order_items_Product`
    FOREIGN KEY (`product` )
    REFERENCES `Orchid`.`Product` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Orchid`.`Category`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Orchid`.`Category` (
  `category` VARCHAR(60) NOT NULL ,
  PRIMARY KEY (`category`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Orchid`.`Category_item`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Orchid`.`Category_item` (
  `category` VARCHAR(60) NOT NULL ,
  `product` INT NOT NULL ,
  PRIMARY KEY (`category`, `product`) ,
  INDEX `fk_Category_item_Product_idx` (`product` ASC) ,
  INDEX `fk_Category_item_Category_idx` (`category` ASC) ,
  CONSTRAINT `fk_Category_item_Product`
    FOREIGN KEY (`product` )
    REFERENCES `Orchid`.`Product` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Genreregel_Genre`
    FOREIGN KEY (`category` )
    REFERENCES `Orchid`.`Category` (`category` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Orchid`.`Payment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Orchid`.`Payment` (
  `order_items` INT NOT NULL ,
  `payment` ENUM('card', 'cash') NOT NULL ,
  `delivery` VARCHAR(60) NOT NULL ,
  PRIMARY KEY (`order_items`) ,
  CONSTRAINT `fk_Payment_Order_item`
    FOREIGN KEY (`order_items` )
    REFERENCES `Orchid`.`Order_items` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Orchid`.`Favourite`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Orchid`.`Favourite` (
  `id` INT NOT NULL ,
  `product` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Favourite_Product_idx` (`product` ASC) ,
  CONSTRAINT `fk_Favourite_Product`
    FOREIGN KEY (`product` )
    REFERENCES `Orchid`.`Product` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `Orchid` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
