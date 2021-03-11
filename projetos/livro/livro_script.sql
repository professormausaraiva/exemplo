-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`GENERO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`GENERO` (
  `gen_codigo` INT NOT NULL AUTO_INCREMENT,
  `gen_descricao` VARCHAR(30) NOT NULL,
  `gen_ativo` CHAR(1) NOT NULL,
  PRIMARY KEY (`gen_codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`AUTOR`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`AUTOR` (
  `aut_codigo` INT NOT NULL AUTO_INCREMENT,
  `aut_nome` VARCHAR(80) NOT NULL,
  PRIMARY KEY (`aut_codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`LIVRO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`LIVRO` (
  `liv_isbn` CHAR(17) NOT NULL,
  `liv_titulo` VARCHAR(200) NOT NULL,
  `gen_codigo` INT NOT NULL,
  `aut_codigo` INT NOT NULL,
  `liv_disponivel` CHAR(1) NOT NULL,
  `liv_ativo` CHAR(1) NOT NULL,
  PRIMARY KEY (`liv_isbn`),
  INDEX `fk_gen_codigo_idx` (`gen_codigo` ASC),
  INDEX `fk_LIVRO_AUTOR1_idx` (`aut_codigo` ASC),
  CONSTRAINT `fk_gen_codigo`
    FOREIGN KEY (`gen_codigo`)
    REFERENCES `mydb`.`GENERO` (`gen_codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_LIVRO_AUTOR1`
    FOREIGN KEY (`aut_codigo`)
    REFERENCES `mydb`.`AUTOR` (`aut_codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`USUARIO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`USUARIO` (
  `usu_cpf` CHAR(11) NOT NULL,
  `usu_email` VARCHAR(80) NULL,
  `usu_senha` VARCHAR(20) NOT NULL,
  `usu_administrador` CHAR(1) NOT NULL,
  `usu_ativo` CHAR(1) NOT NULL,
  PRIMARY KEY (`usu_cpf`),
  UNIQUE INDEX `usu_email_UNIQUE` (`usu_email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`LOCACAO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`LOCACAO` (
  `loc_codigo` INT NOT NULL AUTO_INCREMENT,
  `liv_isbn` CHAR(17) NOT NULL,
  `usu_cpf` CHAR(11) NOT NULL,
  `loc_data_locacao` DATETIME NOT NULL,
  `loc_data_previsao_retorno` DATETIME NOT NULL,
  `loc_data_devolucao` DATETIME NOT NULL,
  `loc_ativa` CHAR(1) NOT NULL,
  PRIMARY KEY (`loc_codigo`),
  INDEX `fk_liv_isbn_idx` (`liv_isbn` ASC),
  INDEX `fk_usu_cpf_idx` (`usu_cpf` ASC),
  CONSTRAINT `fk_liv_isbn`
    FOREIGN KEY (`liv_isbn`)
    REFERENCES `mydb`.`LIVRO` (`liv_isbn`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usu_cpf`
    FOREIGN KEY (`usu_cpf`)
    REFERENCES `mydb`.`USUARIO` (`usu_cpf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
