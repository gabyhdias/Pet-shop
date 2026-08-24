-- MySQL Workbench Synchronization
-- Generated: 2026-08-24 11:30
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: gabriela_h_dias

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER TABLE `mydb`.`cadastro_clientes` 
DROP FOREIGN KEY `fk_cadastro_clientes_cadastro_pets`;

ALTER TABLE `mydb`.`cadastro_clientes` 
ADD CONSTRAINT `fk_cadastro_clientes_cadastro_pets`
  FOREIGN KEY (`cadastro_pets_idcadastro_pets`)
  REFERENCES `mydb`.`cadastro_pets` (`idcadastro_pets`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
