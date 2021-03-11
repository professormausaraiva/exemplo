-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema db_exemplo
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_exemplo
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_exemplo` DEFAULT CHARACTER SET latin1 ;
USE `db_exemplo` ;

-- -----------------------------------------------------
-- Table `db_exemplo`.`grupo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_exemplo`.`grupo` (
  `gru_codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `gru_descricao` VARCHAR(80) NOT NULL,
  `gru_ativo` CHAR(1) NOT NULL,
  PRIMARY KEY (`gru_codigo`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_exemplo`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_exemplo`.`usuario` (
  `usu_login` CHAR(11) NOT NULL,
  `usu_nome` VARCHAR(100) NOT NULL,
  `usu_email` VARCHAR(100) NOT NULL,
  `usu_senha` VARCHAR(60) NOT NULL,
  `usu_data_atualizacao` DATETIME NOT NULL,
  `usu_ativo` CHAR(1) NOT NULL,
  `gru_codigo` INT(11) NOT NULL,
  PRIMARY KEY (`usu_login`),
  UNIQUE INDEX `usu_email_UNIQUE` (`usu_email` ASC),
  INDEX `fk_usuario_grupo_idx` (`gru_codigo` ASC),
  CONSTRAINT `fk_usuario_grupo`
    FOREIGN KEY (`gru_codigo`)
    REFERENCES `db_exemplo`.`grupo` (`gru_codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = dec8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
