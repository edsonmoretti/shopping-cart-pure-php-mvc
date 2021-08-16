-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.6-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela cursoPhp7.4.addresses
DROP TABLE IF EXISTS `addresses`;
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` int(11) NOT NULL,
  `street` varchar(255) NOT NULL,
  `number` varchar(10) NOT NULL,
  `neighborhood` varchar(150) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_CLIENT_ADDRESSES` (`customer`),
  CONSTRAINT `FK_CLIENT_ADDRESSES` FOREIGN KEY (`customer`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela cursoPhp7.4.addresses: ~0 rows (aproximadamente)
DELETE FROM `addresses`;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;

-- Copiando estrutura para tabela cursoPhp7.4.customer
DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela cursoPhp7.4.customer: ~0 rows (aproximadamente)
DELETE FROM `customer`;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

-- Copiando estrutura para tabela cursoPhp7.4.emails
DROP TABLE IF EXISTS `emails`;
CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_CLIENT_EMAILS` (`customer`),
  CONSTRAINT `FK_CLIENT_EMAILS` FOREIGN KEY (`customer`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela cursoPhp7.4.emails: ~0 rows (aproximadamente)
DELETE FROM `emails`;
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;

-- Copiando estrutura para tabela cursoPhp7.4.phones
DROP TABLE IF EXISTS `phones`;
CREATE TABLE IF NOT EXISTS `phones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` int(11) NOT NULL,
  `number` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_CLIENT_PHONES` (`customer`),
  CONSTRAINT `FK_CLIENT_PHONES` FOREIGN KEY (`customer`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela cursoPhp7.4.phones: ~0 rows (aproximadamente)
DELETE FROM `phones`;
/*!40000 ALTER TABLE `phones` DISABLE KEYS */;
/*!40000 ALTER TABLE `phones` ENABLE KEYS */;

-- Copiando estrutura para tabela cursoPhp7.4.privileges
DROP TABLE IF EXISTS `privileges`;
CREATE TABLE IF NOT EXISTS `privileges` (
  `id` int(11) NOT NULL,
  `registercustomer` tinyint(1) NOT NULL,
  `editcustomer` tinyint(1) NOT NULL,
  `deletecustomer` tinyint(1) NOT NULL,
  `registeruser` tinyint(1) NOT NULL,
  `edituser` tinyint(1) NOT NULL,
  `deleteuser` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela cursoPhp7.4.privileges: ~0 rows (aproximadamente)
DELETE FROM `privileges`;
/*!40000 ALTER TABLE `privileges` DISABLE KEYS */;
INSERT INTO `privileges` (`id`, `registercustomer`, `editcustomer`, `deletecustomer`, `registeruser`, `edituser`, `deleteuser`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 1, 1, 1, 1, 1, '2020-04-22 17:28:35', '2020-04-22 17:28:39', NULL);
/*!40000 ALTER TABLE `privileges` ENABLE KEYS */;

-- Copiando estrutura para tabela cursoPhp7.4.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `gtin` varchar(250) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `price` decimal(20,6) NOT NULL,
  `stock_quantity` decimal(20,6) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela cursoPhp7.4.products: ~1 rows (aproximadamente)
DELETE FROM `products`;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `name`, `gtin`, `description`, `price`, `stock_quantity`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Produto Teste 1', '7894900700046', 'Descrição do produto', 450.000000, 100.000000, 'uploads/c4ca4238a0b923820dcc509a6f75849b.jpg', '2021-08-14 22:46:13', '2021-08-15 15:28:44', NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Copiando estrutura para tabela cursoPhp7.4.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `privilege` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `password` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`),
  KEY `FK_USER_PRIVILEGE` (`privilege`),
  CONSTRAINT `FK_USER_PRIVILEGE` FOREIGN KEY (`privilege`) REFERENCES `privileges` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela cursoPhp7.4.users: ~3 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `privilege`, `name`, `birthday`, `cpf`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 'ADMINISTRADOR', '1990-04-22', '01234567890', 'd9b1d7db4cd6e70935368a1efb10e377', '2020-04-22 17:29:06', '2021-08-15 10:48:14', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
