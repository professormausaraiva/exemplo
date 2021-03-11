-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema db_pessoal
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_pessoal
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_pessoal` DEFAULT CHARACTER SET utf8 ;
USE `db_pessoal` ;

-- -----------------------------------------------------
-- Table `db_pessoal`.`USUARIO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_pessoal`.`USUARIO` (
  `usu_cpf` CHAR(11) NOT NULL,
  `usu_email` VARCHAR(100) NOT NULL,
  `usu_senha` VARCHAR(10) NOT NULL,
  `usu_ativo` CHAR(1) NOT NULL,
  UNIQUE INDEX `usu_email_UNIQUE` (`usu_email` ASC),
  PRIMARY KEY (`usu_cpf`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = dec8;


-- -----------------------------------------------------
-- Table `db_pessoal`.`CATEGORIA`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_pessoal`.`CATEGORIA` (
  `cat_codigo` INT NOT NULL AUTO_INCREMENT,
  `cat_descricao` VARCHAR(80) NOT NULL,
  `cat_ativa` CHAR(1) NOT NULL,
  PRIMARY KEY (`cat_codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_pessoal`.`PRODUTO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_pessoal`.`PRODUTO` (
  `pro_codigo` INT NOT NULL AUTO_INCREMENT,
  `pro_descricao` VARCHAR(100) NOT NULL,
  `pro_valor` REAL NOT NULL,
  `cat_codigo` INT NOT NULL,
  `pro_ativo` CHAR(1) NOT NULL,
  PRIMARY KEY (`pro_codigo`),
  INDEX `fk_cat_codigo_idx` (`cat_codigo` ASC),
  CONSTRAINT `fk_cat_codigo`
    FOREIGN KEY (`cat_codigo`)
    REFERENCES `db_pessoal`.`CATEGORIA` (`cat_codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_pessoal`.`PEDIDO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_pessoal`.`PEDIDO` (
  `ped_numero` INT NOT NULL AUTO_INCREMENT,
  `usu_cpf` CHAR(11) NOT NULL,
  `ped_datahora` DATETIME NOT NULL,
  `ped_entregue` CHAR(1) NOT NULL,
  `ped_ativo` CHAR(1) NOT NULL,
  PRIMARY KEY (`ped_numero`),
  INDEX `fk_usu_cpf_idx` (`usu_cpf` ASC),
  CONSTRAINT `fk_usu_cpf`
    FOREIGN KEY (`usu_cpf`)
    REFERENCES `db_pessoal`.`USUARIO` (`usu_cpf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_pessoal`.`ITEM_PEDIDO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_pessoal`.`ITEM_PEDIDO` (
  `ped_numero` INT NOT NULL,
  `pro_codigo` INT NOT NULL,
  `pro_valor` REAL NOT NULL,
  INDEX `fk_ITEM_PEDIDO_PRODUTO1_idx` (`pro_codigo` ASC),
  INDEX `fk_ITEM_PEDIDO_PEDIDO1_idx` (`ped_numero` ASC),
  CONSTRAINT `fk_ITEM_PEDIDO_PRODUTO1`
    FOREIGN KEY (`pro_codigo`)
    REFERENCES `db_pessoal`.`PRODUTO` (`pro_codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ITEM_PEDIDO_PEDIDO1`
    FOREIGN KEY (`ped_numero`)
    REFERENCES `db_pessoal`.`PEDIDO` (`ped_numero`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
