-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           5.7.24 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para diztribui
DROP DATABASE IF EXISTS `diztribui`;
CREATE DATABASE IF NOT EXISTS `diztribui` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `diztribui`;

-- Copiando estrutura para tabela diztribui.alertas
DROP TABLE IF EXISTS `alertas`;
CREATE TABLE IF NOT EXISTS `alertas` (
  `pkAlerta` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Mensagem` text COLLATE utf8mb4_unicode_ci,
  `setor_pk_setor` bigint(20) unsigned DEFAULT NULL,
  `pkUsuario` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`pkAlerta`),
  KEY `alertas_setor_pk_setor_foreign` (`setor_pk_setor`),
  KEY `alertas_pkusuario_foreign` (`pkUsuario`),
  CONSTRAINT `alertas_pkusuario_foreign` FOREIGN KEY (`pkUsuario`) REFERENCES `usuario` (`pkUsuario`),
  CONSTRAINT `alertas_setor_pk_setor_foreign` FOREIGN KEY (`setor_pk_setor`) REFERENCES `setor` (`pkSetor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela diztribui.alertas: ~0 rows (aproximadamente)
DELETE FROM `alertas`;
/*!40000 ALTER TABLE `alertas` DISABLE KEYS */;
/*!40000 ALTER TABLE `alertas` ENABLE KEYS */;

-- Copiando estrutura para tabela diztribui.cargo
DROP TABLE IF EXISTS `cargo`;
CREATE TABLE IF NOT EXISTS `cargo` (
  `pkCargo` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fkEmpresa` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`pkCargo`),
  KEY `cargo_fkempresa_foreign` (`fkEmpresa`),
  CONSTRAINT `cargo_fkempresa_foreign` FOREIGN KEY (`fkEmpresa`) REFERENCES `empresa` (`pkEmpresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela diztribui.cargo: ~0 rows (aproximadamente)
DELETE FROM `cargo`;
/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
/*!40000 ALTER TABLE `cargo` ENABLE KEYS */;

-- Copiando estrutura para tabela diztribui.empresa
DROP TABLE IF EXISTS `empresa`;
CREATE TABLE IF NOT EXISTS `empresa` (
  `pkEmpresa` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `razaoSocial` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomeFantasia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnpj` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redeSocial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ramoDeAtividade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `responsavelMarketing` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `responsavelFinanceiro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `responsavelComercial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `complemento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bairro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cidade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cep` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pkEmpresa`),
  UNIQUE KEY `empresa_cnpj_unique` (`cnpj`),
  UNIQUE KEY `empresa_nomefantasia_unique` (`nomeFantasia`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela diztribui.empresa: ~1 rows (aproximadamente)
DELETE FROM `empresa`;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` (`pkEmpresa`, `razaoSocial`, `nomeFantasia`, `cnpj`, `endereco`, `site`, `telefone`, `redeSocial`, `ramoDeAtividade`, `responsavelMarketing`, `responsavelFinanceiro`, `responsavelComercial`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `cep`, `created_at`, `updated_at`) VALUES
	(1, 'TecTeste Tecnologia', 'Tectest', '60.542.678/0001-28', 'Rua Aderbal Rodrigues Vaz', NULL, '(31) 33333-3333', NULL, NULL, NULL, NULL, NULL, 120, NULL, NULL, 'Belo Horizonte', 'MG', '30690-000', '2020-05-19 08:45:32', '2020-05-19 08:45:32');
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;

-- Copiando estrutura para tabela diztribui.gestor
DROP TABLE IF EXISTS `gestor`;
CREATE TABLE IF NOT EXISTS `gestor` (
  `pkGestor` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fkSetor` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fkEmpresa` bigint(20) unsigned DEFAULT NULL,
  `fkUsuario` bigint(20) unsigned DEFAULT NULL,
  `ehmaster` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`pkGestor`),
  KEY `gestor_fkempresa_foreign` (`fkEmpresa`),
  KEY `gestor_fksetor_foreign` (`fkSetor`),
  KEY `gestor_fkusuario_foreign` (`fkUsuario`),
  CONSTRAINT `gestor_fkempresa_foreign` FOREIGN KEY (`fkEmpresa`) REFERENCES `empresa` (`pkEmpresa`),
  CONSTRAINT `gestor_fksetor_foreign` FOREIGN KEY (`fkSetor`) REFERENCES `setor` (`pkSetor`),
  CONSTRAINT `gestor_fkusuario_foreign` FOREIGN KEY (`fkUsuario`) REFERENCES `usuario` (`pkUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela diztribui.gestor: ~0 rows (aproximadamente)
DELETE FROM `gestor`;
/*!40000 ALTER TABLE `gestor` DISABLE KEYS */;
/*!40000 ALTER TABLE `gestor` ENABLE KEYS */;

-- Copiando estrutura para tabela diztribui.items
DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `pkItem` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fkMateria` bigint(20) unsigned DEFAULT NULL,
  `fkTipoDeItem` bigint(20) unsigned DEFAULT NULL,
  `texto` longtext COLLATE utf8mb4_unicode_ci,
  `videoIncorporado` longtext COLLATE utf8mb4_unicode_ci,
  `ordem` int(11) DEFAULT NULL,
  PRIMARY KEY (`pkItem`),
  KEY `items_fkmateria_foreign` (`fkMateria`),
  KEY `items_fktipodeitem_foreign` (`fkTipoDeItem`),
  CONSTRAINT `items_fkmateria_foreign` FOREIGN KEY (`fkMateria`) REFERENCES `materias` (`pkMateria`),
  CONSTRAINT `items_fktipodeitem_foreign` FOREIGN KEY (`fkTipoDeItem`) REFERENCES `tipo_deitems` (`pkTipoDeItem`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela diztribui.items: ~6 rows (aproximadamente)
DELETE FROM `items`;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` (`pkItem`, `created_at`, `updated_at`, `fkMateria`, `fkTipoDeItem`, `texto`, `videoIncorporado`, `ordem`) VALUES
	(3, '2020-05-19 07:54:09', '2020-05-19 07:54:09', 2, 1, 'adadadasd', NULL, NULL),
	(4, '2020-05-19 07:54:47', '2020-05-19 07:54:47', 2, 2, NULL, 'dsfsfsf', NULL),
	(5, '2020-05-19 07:54:57', '2020-05-19 07:54:57', 2, 3, NULL, NULL, NULL),
	(6, '2020-05-19 07:55:42', '2020-05-19 07:55:42', 2, 3, NULL, NULL, NULL),
	(7, '2020-05-19 07:55:44', '2020-05-19 07:55:44', 2, 3, NULL, NULL, NULL),
	(8, '2020-05-19 07:56:10', '2020-05-19 07:56:10', 2, 3, NULL, NULL, NULL);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;

-- Copiando estrutura para tabela diztribui.materias
DROP TABLE IF EXISTS `materias`;
CREATE TABLE IF NOT EXISTS `materias` (
  `pkMateria` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fkTema` bigint(20) unsigned DEFAULT NULL,
  `titulo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`pkMateria`),
  KEY `materias_fktema_foreign` (`fkTema`),
  CONSTRAINT `materias_fktema_foreign` FOREIGN KEY (`fkTema`) REFERENCES `temas` (`pkTema`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela diztribui.materias: ~2 rows (aproximadamente)
DELETE FROM `materias`;
/*!40000 ALTER TABLE `materias` DISABLE KEYS */;
INSERT INTO `materias` (`pkMateria`, `created_at`, `updated_at`, `fkTema`, `titulo`, `descricao`) VALUES
	(1, '2020-05-18 20:19:12', '2020-05-18 20:19:12', NULL, 'hgfhfgh', 'fghfhfgh'),
	(2, '2020-05-19 07:52:10', '2020-05-19 07:52:10', NULL, 'fdsfsf', 'dfsfsfsdf');
/*!40000 ALTER TABLE `materias` ENABLE KEYS */;

-- Copiando estrutura para tabela diztribui.menus
DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `pkMenu` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pai` bigint(20) unsigned DEFAULT NULL,
  `administrador` tinyint(1) DEFAULT NULL,
  `master` tinyint(1) DEFAULT NULL,
  `gestor` tinyint(1) DEFAULT NULL,
  `usuario` tinyint(1) DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  PRIMARY KEY (`pkMenu`),
  KEY `menus_pai_foreign` (`pai`),
  CONSTRAINT `menus_pai_foreign` FOREIGN KEY (`pai`) REFERENCES `menus` (`pkMenu`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela diztribui.menus: ~10 rows (aproximadamente)
DELETE FROM `menus`;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` (`pkMenu`, `created_at`, `updated_at`, `descricao`, `url`, `pai`, `administrador`, `master`, `gestor`, `usuario`, `icon`, `ordem`) VALUES
	(1, NULL, NULL, 'Administracao', '/cadastros', NULL, 1, 1, 1, 0, 'mdi  mdi-account-details menu-icon', NULL),
	(3, NULL, NULL, 'Empresas', '/cadastros/empresa', 1, 1, 0, 0, 0, NULL, 1),
	(4, NULL, NULL, 'Setor', '/cadastros/setor', 1, 1, 1, 0, 0, NULL, 2),
	(5, NULL, NULL, 'Cargo', '/cadastros/cargo', 1, 1, 1, 1, 0, NULL, 3),
	(6, NULL, NULL, 'Usuários', '/cadastros/usuario', 1, 1, 1, 1, 0, NULL, 5),
	(7, NULL, NULL, 'Gestor', '/cadastros/gestor', 1, 1, 1, 0, 0, NULL, 6),
	(8, NULL, NULL, 'Matérias', '/conteudo/materia', 1, 1, 1, 1, 0, NULL, 7),
	(10, NULL, NULL, 'Conteudo', '/conteudo', NULL, 0, 0, 0, 1, 'mdi  mdi-post-outline menu-icon', NULL),
	(11, NULL, NULL, 'Favoritos', '/favoritos', NULL, 0, 0, 0, 1, 'mdi  mdi-star menu-icon', NULL),
	(12, NULL, NULL, 'Envio de alertas', '/alertas', NULL, 1, 1, 1, 1, 'mdi  mdi-email-send-outline menu-icon', NULL);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;

-- Copiando estrutura para tabela diztribui.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela diztribui.migrations: ~1 rows (aproximadamente)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2020_05_18_170733_skipper_migrations_2020051817073340', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Copiando estrutura para tabela diztribui.questionarios
DROP TABLE IF EXISTS `questionarios`;
CREATE TABLE IF NOT EXISTS `questionarios` (
  `pkQuestionario` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pontuacaoPorQuestao` double(8,2) DEFAULT NULL,
  `minimoAprovacao` double(8,2) DEFAULT NULL,
  `enunciado` text COLLATE utf8mb4_unicode_ci,
  `fkItem` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`pkQuestionario`),
  KEY `questionarios_pkitem_foreign` (`fkItem`),
  CONSTRAINT `questionarios_pkitem_foreign` FOREIGN KEY (`fkItem`) REFERENCES `items` (`pkItem`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela diztribui.questionarios: ~1 rows (aproximadamente)
DELETE FROM `questionarios`;
/*!40000 ALTER TABLE `questionarios` DISABLE KEYS */;
INSERT INTO `questionarios` (`pkQuestionario`, `created_at`, `updated_at`, `pontuacaoPorQuestao`, `minimoAprovacao`, `enunciado`, `fkItem`) VALUES
	(1, '2020-05-19 07:56:10', '2020-05-19 07:56:10', 10.00, 50.00, 'sdfsfsd', 8);
/*!40000 ALTER TABLE `questionarios` ENABLE KEYS */;

-- Copiando estrutura para tabela diztribui.redes_sociais
DROP TABLE IF EXISTS `redes_sociais`;
CREATE TABLE IF NOT EXISTS `redes_sociais` (
  `pkRedesSociais` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fkUsuario` bigint(20) unsigned DEFAULT NULL,
  `fkTipoRedeSocial` bigint(20) unsigned DEFAULT NULL,
  `fkEmpresa` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`pkRedesSociais`),
  KEY `redes_sociais_fkusuario_foreign` (`fkUsuario`),
  KEY `redes_sociais_fktiporedesocial_foreign` (`fkTipoRedeSocial`),
  KEY `redes_sociais_fkempresa_foreign` (`fkEmpresa`),
  CONSTRAINT `redes_sociais_fkempresa_foreign` FOREIGN KEY (`fkEmpresa`) REFERENCES `empresa` (`pkEmpresa`),
  CONSTRAINT `redes_sociais_fktiporedesocial_foreign` FOREIGN KEY (`fkTipoRedeSocial`) REFERENCES `tipos_redes_sociais` (`pkTiposRedesSociais`),
  CONSTRAINT `redes_sociais_fkusuario_foreign` FOREIGN KEY (`fkUsuario`) REFERENCES `usuario` (`pkUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela diztribui.redes_sociais: ~0 rows (aproximadamente)
DELETE FROM `redes_sociais`;
/*!40000 ALTER TABLE `redes_sociais` DISABLE KEYS */;
/*!40000 ALTER TABLE `redes_sociais` ENABLE KEYS */;

-- Copiando estrutura para tabela diztribui.respostas
DROP TABLE IF EXISTS `respostas`;
CREATE TABLE IF NOT EXISTS `respostas` (
  `pkRespostas` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fkQuestao` bigint(20) unsigned DEFAULT NULL,
  `texto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correta` tinyint(1) DEFAULT NULL,
  `fkQuestionario` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`pkRespostas`),
  KEY `respostas_fkquestionario_foreign` (`fkQuestionario`),
  CONSTRAINT `respostas_fkquestionario_foreign` FOREIGN KEY (`fkQuestionario`) REFERENCES `questionarios` (`pkQuestionario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela diztribui.respostas: ~0 rows (aproximadamente)
DELETE FROM `respostas`;
/*!40000 ALTER TABLE `respostas` DISABLE KEYS */;
/*!40000 ALTER TABLE `respostas` ENABLE KEYS */;

-- Copiando estrutura para tabela diztribui.setor
DROP TABLE IF EXISTS `setor`;
CREATE TABLE IF NOT EXISTS `setor` (
  `pkSetor` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fkEmpresa` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`pkSetor`),
  KEY `setor_fkempresa_foreign` (`fkEmpresa`),
  CONSTRAINT `setor_fkempresa_foreign` FOREIGN KEY (`fkEmpresa`) REFERENCES `empresa` (`pkEmpresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela diztribui.setor: ~0 rows (aproximadamente)
DELETE FROM `setor`;
/*!40000 ALTER TABLE `setor` DISABLE KEYS */;
/*!40000 ALTER TABLE `setor` ENABLE KEYS */;

-- Copiando estrutura para tabela diztribui.temas
DROP TABLE IF EXISTS `temas`;
CREATE TABLE IF NOT EXISTS `temas` (
  `pkTema` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`pkTema`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela diztribui.temas: ~0 rows (aproximadamente)
DELETE FROM `temas`;
/*!40000 ALTER TABLE `temas` DISABLE KEYS */;
/*!40000 ALTER TABLE `temas` ENABLE KEYS */;

-- Copiando estrutura para tabela diztribui.tipos_redes_sociais
DROP TABLE IF EXISTS `tipos_redes_sociais`;
CREATE TABLE IF NOT EXISTS `tipos_redes_sociais` (
  `pkTiposRedesSociais` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pkTiposRedesSociais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela diztribui.tipos_redes_sociais: ~0 rows (aproximadamente)
DELETE FROM `tipos_redes_sociais`;
/*!40000 ALTER TABLE `tipos_redes_sociais` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipos_redes_sociais` ENABLE KEYS */;

-- Copiando estrutura para tabela diztribui.tipo_deitems
DROP TABLE IF EXISTS `tipo_deitems`;
CREATE TABLE IF NOT EXISTS `tipo_deitems` (
  `pkTipoDeItem` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`pkTipoDeItem`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela diztribui.tipo_deitems: ~3 rows (aproximadamente)
DELETE FROM `tipo_deitems`;
/*!40000 ALTER TABLE `tipo_deitems` DISABLE KEYS */;
INSERT INTO `tipo_deitems` (`pkTipoDeItem`, `created_at`, `updated_at`, `descricao`) VALUES
	(1, NULL, NULL, 'Texto'),
	(2, NULL, NULL, 'Video'),
	(3, NULL, NULL, 'Questionario');
/*!40000 ALTER TABLE `tipo_deitems` ENABLE KEYS */;

-- Copiando estrutura para tabela diztribui.usuario
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `pkUsuario` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urlImage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fkEmpresa` bigint(20) unsigned DEFAULT NULL,
  `fkSetor` bigint(20) unsigned DEFAULT NULL,
  `fkCargo` bigint(20) unsigned DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `administrador` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`pkUsuario`),
  UNIQUE KEY `pessoa_cpf_unique` (`cpf`),
  UNIQUE KEY `pessoa_email_unique` (`email`),
  KEY `usuario_fkempresa_foreign` (`fkEmpresa`),
  KEY `usuario_fksetor_foreign` (`fkSetor`),
  KEY `usuario_fkcargo_foreign` (`fkCargo`),
  CONSTRAINT `usuario_fkcargo_foreign` FOREIGN KEY (`fkCargo`) REFERENCES `cargo` (`pkCargo`),
  CONSTRAINT `usuario_fkempresa_foreign` FOREIGN KEY (`fkEmpresa`) REFERENCES `empresa` (`pkEmpresa`),
  CONSTRAINT `usuario_fksetor_foreign` FOREIGN KEY (`fkSetor`) REFERENCES `setor` (`pkSetor`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela diztribui.usuario: ~1 rows (aproximadamente)
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`pkUsuario`, `nome`, `email`, `cpf`, `telefone`, `urlImage`, `created_at`, `updated_at`, `fkEmpresa`, `fkSetor`, `fkCargo`, `facebook`, `instagram`, `twitter`, `linkedin`, `site`, `password`, `administrador`) VALUES
	(1, 'Lucas Borges', 'ryok21@gmail.com', '06460094608', '31975380034', NULL, '2020-05-13 12:47:25', '2020-05-13 12:47:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$vJfykP7PRwKsbv5aYF7VzOFo/IptsfK3Az9NmHFzt7trovmQNLtQC', 1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
