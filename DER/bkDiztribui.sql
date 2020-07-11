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

-- Copiando dados para a tabela diztribui.menus: ~10 rows (aproximadamente)
DELETE FROM `menus`;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` (`pkMenu`, `created_at`, `updated_at`, `descricao`, `icon`, `url`, `pai`, `administrador`, `master`, `gestor`, `usuario`,  `ordem`) VALUES
	(1, NULL, NULL, 'Administracao', 'mdi  mdi-account-details menu-icon', '', NULL, 1, 1, 1, 1,  NULL),
	(3, NULL, NULL, 'Empresas', NULL, '/cadastros/empresa', 1, 1, 0, 0, 0,  1),
	(4, NULL, NULL, 'Setor', NULL, '/cadastros/setor', 1, 1, 1, 0, 0,  2),
	(5, NULL, NULL, 'Cargo', NULL, '/cadastros/cargo', 1, 1, 1, 1, 0,  3),
	(6, NULL, NULL, 'Usuários', NULL, '/cadastros/usuario', 1, 1, 1, 1, 0,  5),
	(7, NULL, NULL, 'Gestor', NULL, '/cadastros/gestor', 1, 1, 1, 0, 0,  6),
	(8, NULL, NULL, 'Matérias', NULL, '/conteudo/materia', 1, 1, 1, 1, 1,  7),
	(10, NULL, NULL, 'Conteudo', 'mdi  mdi-post-outline menu-icon', '/conteudo', NULL, 0, 0, 0, 1,  NULL),
	(11, NULL, NULL, 'Favoritos', NULL, '/favoritos', NULL, 0, 0, 0, 1,  NULL),
	(12, NULL, NULL, 'Envio de alertas', 'mdi  mdi-email-send-outline menu-icon', '/alertas', NULL, 1, 1, 1, 0, NULL);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;

-- Copiando dados para a tabela diztribui.usuario: ~1 rows (aproximadamente)
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`pkUsuario`, `nome`, `email`, `cpf`, `telefone`, `urlImage`, `created_at`, `administrador`, `updated_at`, `fkEmpresa`, `fkSetor`, `fkCargo`, `facebook`, `instagram`, `twitter`, `linkedin`, `site`, `password`) VALUES
	(1, 'Lucas Borges', 'ryok21@gmail.com', '06460094608', '31975380034', NULL, '2020-05-13 12:47:25', 1, '2020-05-13 12:47:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$vJfykP7PRwKsbv5aYF7VzOFo/IptsfK3Az9NmHFzt7trovmQNLtQC');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
