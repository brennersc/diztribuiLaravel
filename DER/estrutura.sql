-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

--
-- Set default database
--
USE diztribui;

--
-- Create table `cargo`
--
CREATE TABLE cargo (
  pkCargo bigint(20) NOT NULL AUTO_INCREMENT,
  column1 varchar(255) DEFAULT NULL,
  PRIMARY KEY (pkCargo)
)
ENGINE = INNODB,
CHARACTER SET latin1,
COLLATE latin1_swedish_ci;

--
-- Create table `usuarios`
--
CREATE TABLE usuarios (
  pkUsuarios bigint(20) NOT NULL AUTO_INCREMENT,
  fkCargo bigint(20) DEFAULT NULL,
  PRIMARY KEY (pkUsuarios)
)
ENGINE = INNODB,
CHARACTER SET latin1,
COLLATE latin1_swedish_ci;

--
-- Create foreign key
--
ALTER TABLE usuarios
ADD CONSTRAINT FK_usuarios_cargo_pkCargo FOREIGN KEY (fkCargo)
REFERENCES cargo (pkCargo) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Create table `empresa`
--
CREATE TABLE empresa (
  pkEmpresa bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (pkEmpresa)
)
ENGINE = INNODB,
CHARACTER SET latin1,
COLLATE latin1_swedish_ci;

--
-- Create table `usuario_empresa`
--
CREATE TABLE usuario_empresa (
  fkUsuario bigint(20) DEFAULT NULL,
  fkEmpresa bigint(20) DEFAULT NULL
)
ENGINE = INNODB,
CHARACTER SET latin1,
COLLATE latin1_swedish_ci;

--
-- Create foreign key
--
ALTER TABLE usuario_empresa
ADD CONSTRAINT FK_usuario_empresa_empresa_pkEmpresa FOREIGN KEY (fkEmpresa)
REFERENCES empresa (pkEmpresa) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Create foreign key
--
ALTER TABLE usuario_empresa
ADD CONSTRAINT FK_usuario_empresa_usuarios_pkUsuarios FOREIGN KEY (fkUsuario)
REFERENCES usuarios (pkUsuarios) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Create table `empresa_cargo`
--
CREATE TABLE empresa_cargo (
  fkEmpresa bigint(20) DEFAULT NULL,
  fkCargo bigint(20) DEFAULT NULL
)
ENGINE = INNODB,
CHARACTER SET latin1,
COLLATE latin1_swedish_ci;

--
-- Create foreign key
--
ALTER TABLE empresa_cargo
ADD CONSTRAINT FK_empresa_cargo_cargo_pkCargo FOREIGN KEY (fkCargo)
REFERENCES cargo (pkCargo) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Create foreign key
--
ALTER TABLE empresa_cargo
ADD CONSTRAINT FK_empresa_cargo_empresa_pkEmpresa FOREIGN KEY (fkEmpresa)
REFERENCES empresa (pkEmpresa) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Create table `areas`
--
CREATE TABLE areas (
  pkArea bigint(20) NOT NULL AUTO_INCREMENT,
  fkEmpresa bigint(20) DEFAULT NULL,
  PRIMARY KEY (pkArea)
)
ENGINE = INNODB,
CHARACTER SET latin1,
COLLATE latin1_swedish_ci;

--
-- Create foreign key
--
ALTER TABLE areas
ADD CONSTRAINT FK_areas_empresa_pkEmpresa FOREIGN KEY (fkEmpresa)
REFERENCES empresa (pkEmpresa) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Create table `tema`
--
CREATE TABLE tema (
  pkTema bigint(20) NOT NULL AUTO_INCREMENT,
  fkEmpresa bigint(20) DEFAULT NULL,
  fkArea bigint(20) DEFAULT NULL,
  PRIMARY KEY (pkTema)
)
ENGINE = INNODB,
CHARACTER SET latin1,
COLLATE latin1_swedish_ci;

--
-- Create foreign key
--
ALTER TABLE tema
ADD CONSTRAINT FK_tema_areas_pkArea FOREIGN KEY (fkArea)
REFERENCES areas (pkArea) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Create foreign key
--
ALTER TABLE tema
ADD CONSTRAINT FK_tema_empresa_pkEmpresa FOREIGN KEY (fkEmpresa)
REFERENCES empresa (pkEmpresa) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Create table 'Razão Social'
--
ALTER TABLE `empresas` ADD `RazaoSocial` VARCHAR(255) NOT NULL AFTER `pkEmpresa`;

--
-- Create table 'Nome de Fantasia'
--
ALTER TABLE `empresas` ADD `NomeFantasia` VARCHAR(255) NOT NULL AFTER `RazaoSocial`;


--
-- Create table 'Cnpj'
--
ALTER TABLE `empresas` ADD `Cnpj` INT(11) NOT NULL AFTER `NomeFantasia`;


--
-- Create table 'Logradouro'
--
ALTER TABLE `empresas` ADD `Logradouro` VARCHAR(255) NOT NULL AFTER `Cnpj`;

--
-- Create table 'Cep'
--
ALTER TABLE `empresas` ADD `Cep` VARCHAR(255) NOT NULL AFTER `Logradouro`;

--
-- Create table 'Estado'
--
ALTER TABLE `empresas` ADD `Estado` VARCHAR(255) NOT NULL AFTER `Cep`;

--
-- Create table 'Cidade'
--
ALTER TABLE `empresas` ADD `Cidade` VARCHAR(255) NOT NULL AFTER `Estado`;

--
-- Create table 'Bairro'
--
ALTER TABLE `empresas` ADD `Bairro` VARCHAR(255) NOT NULL AFTER `Cidade`;

--
-- Create table 'Rua'
--
ALTER TABLE `empresas` ADD `Rua` VARCHAR(255) NOT NULL AFTER `Bairro`;

--
-- Create table 'Numero'
--
ALTER TABLE `empresas` ADD `Numero` VARCHAR(255) NOT NULL AFTER `Rua`;

--
-- Create table 'Complemento'
--
ALTER TABLE `empresas` ADD `Complemento` VARCHAR(255) NOT NULL AFTER `Numero`;

--
-- Create table 'Site'
--
ALTER TABLE `empresas` ADD `Site` VARCHAR(255) NOT NULL AFTER `Complemento`;


--
-- Create table 'Telefone'
--
ALTER TABLE `empresas` ADD `Telefone` INT(11) NOT NULL AFTER `Site`;

--
-- Create table 'Celular'
--
ALTER TABLE `empresas` ADD `Celular` INT(11) NOT NULL AFTER `Telefone`;

--
-- Create table 'Rede Social'
--
ALTER TABLE `empresas` ADD `RedeSocial` VARCHAR(255) NOT NULL AFTER `Celular`;

--
-- Create table 'Ramo de Atividade'
--
ALTER TABLE `empresas` ADD `RamoDeAtividade` VARCHAR(255) NOT NULL AFTER `RedeSocial`;

--
-- Create table 'Responsável de Marketing'
--
ALTER TABLE `empresas` ADD `ResponsavelMarketing` VARCHAR(255) NOT NULL AFTER `RamoDeAtividade`;

--
-- Create table 'Responsável Financeiro'
--
ALTER TABLE `empresas` ADD `ResponsavelFinanceiro` VARCHAR(255) NOT NULL AFTER `ResponsavelMarketing`;

--
-- Create table 'Responsável Comercial'
--
ALTER TABLE `empresas` ADD `ResponsavelComercial` VARCHAR(255) NOT NULL AFTER `ResponsavelFinanceiro`;

--
-- Create table 'Número de Licenças'
--
ALTER TABLE `empresas` ADD `Licenças` INT(11) NOT NULL AFTER `ResponsavelComercial`;

--
-- Create table 'Created_at' for Empresas
--
ALTER TABLE `empresas` ADD `created_at` TIMESTAMP NULL DEFAULT NULL AFTER `Licenças`;

--
-- Create table 'Updated_at' for Empresas
--
ALTER TABLE `empresas` ADD `updated_at` TIMESTAMP NULL DEFAULT NULL AFTER `created_at`;

--
-- Create table 'Nome da Area' for Areas
--
ALTER TABLE `areas` ADD `NomeArea` VARCHAR(255) NOT NULL AFTER `fkEmpresa`;

--
-- Create table 'Responsavel pela Area' for Areas
--
ALTER TABLE `areas` ADD `ResponsavelArea` VARCHAR(255) NOT NULL AFTER `NomeArea`;

--
-- Create table 'Created_at' for Areas
--
ALTER TABLE `areas` ADD `created_at` TIMESTAMP NULL DEFAULT NULL AFTER `Licenças`;

--
-- Create table 'Updated_at' for Areas
--
ALTER TABLE `areas` ADD `updated_at` TIMESTAMP NULL DEFAULT NULL AFTER `created_at`;

--
-- Rename table 'Tema' 
--
RENAME TABLE tema TO temas;

--
-- Create table 'Nome do tema' for Temas
--
ALTER TABLE `Temas` ADD `NomeTema` VARCHAR(255) NOT NULL AFTER `fkArea`;

--
-- Create table 'Setor' for Temas
--
ALTER TABLE `Temas` ADD `Setor` VARCHAR(255) NOT NULL AFTER `NomeTema`;

--
-- Create table 'Created_at' for Temas
--
ALTER TABLE `Temas` ADD `created_at` TIMESTAMP NULL DEFAULT NULL AFTER `Setor`;

--
-- Create table 'Updated_at' for Temas
--
ALTER TABLE `Temas` ADD `updated_at` TIMESTAMP NULL DEFAULT NULL AFTER `created_at`;


