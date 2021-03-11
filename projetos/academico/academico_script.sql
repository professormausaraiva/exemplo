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
  `usu_nome` VARCHAR(100) NOT NULL,
  `usu_email` VARCHAR(100) NOT NULL,
  `usu_senha` VARCHAR(10) NOT NULL,
  `usu_ativo` CHAR(1) NOT NULL,
  UNIQUE INDEX `usu_email_UNIQUE` (`usu_email` ASC),
  PRIMARY KEY (`usu_cpf`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = dec8;


-- -----------------------------------------------------
-- Table `db_pessoal`.`CURSO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_pessoal`.`CURSO` (
  `cur_codigo` INT NOT NULL AUTO_INCREMENT,
  `cur_descricao` VARCHAR(80) NOT NULL,
  `cur_ativo` CHAR(1) NOT NULL,
  PRIMARY KEY (`cur_codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_pessoal`.`DISCIPLINA`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_pessoal`.`DISCIPLINA` (
  `dis_codigo` INT NOT NULL AUTO_INCREMENT,
  `dis_nome` VARCHAR(100) NOT NULL,
  `dis_ativo` CHAR(1) NOT NULL,
  PRIMARY KEY (`dis_codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_pessoal`.`TURMA`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_pessoal`.`TURMA` (
  `tur_codigo` INT NOT NULL AUTO_INCREMENT,
  `tur_data_inicio` DATE NOT NULL,
  `tur_data_fim` DATE NULL,
  `cur_codigo` INT NOT NULL,
  `dis_codigo` CHAR(11) NOT NULL,
  PRIMARY KEY (`tur_codigo`),
  INDEX `in_cur_codigo` (`cur_codigo` ASC),
  INDEX `in_pro_cpf` (`dis_codigo` ASC),
  CONSTRAINT `fk_cur_codigo`
    FOREIGN KEY (`cur_codigo`)
    REFERENCES `db_pessoal`.`CURSO` (`cur_codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `kf_dis_codigo`
    FOREIGN KEY (`dis_codigo`)
    REFERENCES `db_pessoal`.`DISCIPLINA` (`dis_codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_pessoal`.`ALUNO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_pessoal`.`ALUNO` (
  `alu_cpf` CHAR(11) NOT NULL,
  `alu_nome` VARCHAR(100) NOT NULL,
  `alu_email` VARCHAR(100) NOT NULL,
  `alu_senha` VARCHAR(10) NOT NULL,
  `alu_ativo` CHAR(1) NOT NULL,
  PRIMARY KEY (`alu_cpf`),
  UNIQUE INDEX `alu_email_UNIQUE` (`alu_email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_pessoal`.`TURMA_ALUNO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_pessoal`.`TURMA_ALUNO` (
  `tur_codigo` INT NOT NULL,
  `alu_cpf` CHAR(11) NOT NULL,
  PRIMARY KEY (`tur_codigo`, `alu_cpf`),
  INDEX `in_alu_cpf` (`alu_cpf` ASC),
  CONSTRAINT `fk_tur_codigo`
    FOREIGN KEY (`tur_codigo`)
    REFERENCES `db_pessoal`.`TURMA` (`tur_codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_alu_cpf`
    FOREIGN KEY (`alu_cpf`)
    REFERENCES `db_pessoal`.`ALUNO` (`alu_cpf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
