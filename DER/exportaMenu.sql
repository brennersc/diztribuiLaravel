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

-- Copiando dados para a tabela diztribuiold.menus: ~10 rows (aproximadamente)
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

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
