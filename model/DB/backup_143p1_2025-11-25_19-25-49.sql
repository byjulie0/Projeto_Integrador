-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 192.168.22.9    Database: 143p1
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `adm`
--

DROP TABLE IF EXISTS `adm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adm` (
  `id_adm` int(11) NOT NULL AUTO_INCREMENT,
  `adm_nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `funcao` varchar(20) NOT NULL DEFAULT 'ADM',
  PRIMARY KEY (`id_adm`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adm`
--

LOCK TABLES `adm` WRITE;
/*!40000 ALTER TABLE `adm` DISABLE KEYS */;
INSERT INTO `adm` VALUES (1,'Jonh Rooster','johnrooster@gmail.com','(67)99999-7777','johnrooster','52.932.056/0001-88','ADM');
/*!40000 ALTER TABLE `adm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrinho`
--

DROP TABLE IF EXISTS `carrinho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrinho` (
  `id_carrinho` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `selecionado` tinyint(1) DEFAULT 0,
  `id_cliente` int(11) NOT NULL,
  PRIMARY KEY (`id_carrinho`),
  KEY `produto_id_produto` (`id_produto`),
  KEY `carrinho_ibfk_2` (`id_cliente`),
  CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`) ON DELETE CASCADE,
  CONSTRAINT `carrinho_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrinho`
--

LOCK TABLES `carrinho` WRITE;
/*!40000 ALTER TABLE `carrinho` DISABLE KEYS */;
INSERT INTO `carrinho` VALUES (35,8,1,1,7),(36,12,1,1,7),(40,10,1,1,4),(55,4,1,1,4),(63,12,1,1,1),(66,16,1,1,1),(67,7,1,1,1),(68,8,1,1,1);
/*!40000 ALTER TABLE `carrinho` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `cat_nome` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Bovinos'),(2,'Equinos'),(3,'Galináceos'),(4,'Produtos Gerais');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cpf_cnpj` varchar(20) NOT NULL,
  `data_nasc` date NOT NULL,
  `user_ativo` smallint(2) NOT NULL DEFAULT 1,
  `telefone` varchar(20) NOT NULL,
  `funcao` varchar(20) NOT NULL DEFAULT 'CLIENTE',
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `cpf_cnpj` (`cpf_cnpj`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'Gabriela','lagelagera@gmail.com','$2y$10$voOprvkfKUs3P/wcwgjk1uHsFXTUremuwsvD29WwmT2ODuViJP2rC','21776634152','2004-08-17',1,'67986085755','CLIENTE'),(2,'Isabella Miho','isabella.miho@gmail.com','$2y$10$besF8rhZjl/liA0ZCuyDmuE51fY4cHZ16Hcp08CgAE6YXL6sVQNji','04862302106','2006-10-02',1,'67991022736','CLIENTE'),(3,'Julie Vieira Martins','julievieiramartins0@gmail.com','$2y$10$AifgUtfKJfCkEeJknmGslO.9lcYNGzXkCn/zrR4kMWVTpjOrwght.','95422137191','2207-05-21',1,'67991956613','CLIENTE'),(4,'VALDIR NASCIMENTO FERREIRA','prof.valdir.escola@gmail.com','$2y$10$Y7uedjPVHIZ0D6.wLbCI2uGMoCzlYBL0cSbJzelpEyZsMaGZiQYRi','62664987070','1983-10-08',1,'67999687351','CLIENTE'),(5,'VALDIR NASCIMENTO FERREIRA','johnrooster33@gmail.com','$2y$10$NSp3X8PhFkOldabN.v0hCuSmqBmnLekfAHoWcdEdqYWpq9iChHQDG','51738169000184','1986-08-17',0,'67999687351','CLIENTE'),(6,'Nicolas da Silva','nicolas@gmail.com','$2y$10$9l.jgzpqTD9zHpR2.VTcOOVfxUYn8gnK9vcjGWYdTY/tmLQJMYSO.','03878072000124','2005-01-17',1,'67988881111','CLIENTE'),(7,'Maria Clara Pereira','arantesmariana839@gmail.com','$2y$10$zNyGKbUjtPBl4gYVECR6W./Dho303lBbmrFVbqzzIpBrn/A5yNkz6','18815528024','2006-06-19',1,'67997563788','CLIENTE'),(8,'Vinycius','vinyciusmarques43@gmail.com','$2y$10$wX6DsTY2brkPz8uu7z2ZXOhRIW/l0XpqJ4CxhOIjaaj/eLzkAfL/K','53492729002','2007-07-11',1,'(67) 9 9884-2872','CLIENTE'),(9,'Vinicius Marques','vinyciusmarques11@gmail.com','$2y$10$J0pLO7vObnB.yelCL7n0rObobRKtpks1XEKOVzlmHdwY1g0vzxsSO','00633826000198','2006-07-11',1,'(67) 9 9884-2872','CLIENTE');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorito`
--

DROP TABLE IF EXISTS `favorito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorito` (
  `id_favorito` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `id_produto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_favorito`),
  KEY `id_produto` (`id_produto`),
  KEY `favorito_ibfk_1` (`id_cliente`),
  CONSTRAINT `favorito_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `favorito_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorito`
--

LOCK TABLES `favorito` WRITE;
/*!40000 ALTER TABLE `favorito` DISABLE KEYS */;
INSERT INTO `favorito` VALUES (14,4,18),(35,1,12),(38,1,7),(41,2,4),(50,7,12),(51,7,8),(52,3,15),(53,4,6),(57,2,12);
/*!40000 ALTER TABLE `favorito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `qtd_produto` int(11) NOT NULL,
  PRIMARY KEY (`id_item`),
  KEY `item_ibfk_1` (`id_pedido`),
  KEY `item_ibfk_2` (`id_produto`),
  CONSTRAINT `item_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `item_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (1,1,1,1),(2,2,5,1),(3,3,1,1),(7,7,4,1),(11,11,6,10),(12,12,18,2),(13,13,2,1),(14,13,16,1),(15,16,13,1),(16,18,1,1),(17,22,12,1),(18,27,18,1),(19,29,7,1),(20,30,18,1),(21,31,18,1),(22,32,18,1),(23,33,18,1),(24,34,18,1),(25,35,18,1),(26,38,8,1),(27,39,10,1),(28,43,18,1),(29,46,17,1),(30,50,9,1),(31,51,19,2),(32,53,19,1),(33,54,17,1),(34,55,17,1),(35,56,4,1),(36,58,11,1),(37,59,5,1),(40,62,19,1),(41,64,19,1),(42,65,19,3),(43,66,18,1),(44,67,18,2),(57,80,11,1),(58,81,17,1);
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`turma143p1`@`%`*/ /*!50003 TRIGGER before_insert_item
BEFORE INSERT ON item
FOR EACH ROW
BEGIN
    DECLARE v_estoque INT;
    DECLARE v_ativo TINYINT;

    -- Busca o estoque e status do produto
    SELECT quant_estoque, produto_ativo
    INTO v_estoque, v_ativo
    FROM produto
    WHERE id_produto = NEW.id_produto;

    -- Verifica se o produto está ativo
    IF v_ativo = 0 THEN
        SIGNAL SQLSTATE '45000' 
            SET MESSAGE_TEXT = 'Produto inativo. Não é possível inserir item.';
    END IF;

    -- Verifica se há estoque suficiente
    IF v_estoque < NEW.qtd_produto THEN
        SIGNAL SQLSTATE '45000' 
            SET MESSAGE_TEXT = 'Estoque insuficiente para o produto.';
    END IF;

    -- Verifica se a quantidade é positiva
    IF NEW.qtd_produto <= 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Quantidade deve ser positiva.';
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`fabrica32`@`%`*/ /*!50003 TRIGGER after_insert_item
AFTER INSERT ON item
FOR EACH ROW
BEGIN
    UPDATE produto
    SET quant_estoque = quant_estoque - NEW.qtd_produto
    WHERE id_produto = NEW.id_produto;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `notificacoes`
--

DROP TABLE IF EXISTS `notificacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notificacoes` (
  `id_cliente` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `mensagem` tinytext NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `data_recebida` datetime NOT NULL DEFAULT current_timestamp(),
  KEY `id_pedido` (`id_pedido`),
  CONSTRAINT `notificacoes_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificacoes`
--

LOCK TABLES `notificacoes` WRITE;
/*!40000 ALTER TABLE `notificacoes` DISABLE KEYS */;
INSERT INTO `notificacoes` VALUES (1,64,'Pedido criado com sucesso! Número do pedido: #64','Pedidos','2025-11-19 18:15:41'),(1,65,'Pedido criado com sucesso! Número do pedido: #65','Pedidos','2025-11-24 15:25:07'),(1,81,'Pedido criado com sucesso! Número do pedido: #81','Pedidos','2025-11-24 16:50:26');
/*!40000 ALTER TABLE `notificacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificacoes_adm`
--

DROP TABLE IF EXISTS `notificacoes_adm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notificacoes_adm` (
  `id_adm` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `mensagem` tinytext NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `data_recebida` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificacoes_adm`
--

LOCK TABLES `notificacoes_adm` WRITE;
/*!40000 ALTER TABLE `notificacoes_adm` DISABLE KEYS */;
/*!40000 ALTER TABLE `notificacoes_adm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `data_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_pedido` enum('Pendente','Concluído','Cancelado') NOT NULL DEFAULT 'Pendente',
  PRIMARY KEY (`id_pedido`),
  KEY `pedido_ibfk_1` (`id_cliente`),
  CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--

LOCK TABLES `pedido` WRITE;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
INSERT INTO `pedido` VALUES (1,1,'2025-11-12 20:18:42','Cancelado'),(2,1,'2025-11-13 19:13:24','Cancelado'),(3,2,'2025-11-14 18:52:49','Cancelado'),(7,2,'2025-11-14 19:22:55','Cancelado'),(11,2,'2025-11-14 20:10:39','Concluído'),(12,4,'2025-11-17 18:21:34','Pendente'),(13,1,'2025-11-17 18:42:19','Cancelado'),(16,6,'2025-11-17 18:54:22','Cancelado'),(18,6,'2025-11-17 18:56:34','Cancelado'),(22,6,'2025-11-17 19:16:49','Cancelado'),(27,1,'2025-11-17 19:18:16','Cancelado'),(29,6,'2025-11-17 19:18:39','Cancelado'),(30,1,'2025-11-17 20:10:11','Cancelado'),(31,1,'2025-11-17 20:10:12','Cancelado'),(32,1,'2025-11-17 20:10:13','Cancelado'),(33,1,'2025-11-17 20:10:13','Cancelado'),(34,1,'2025-11-17 20:13:03','Cancelado'),(35,1,'2025-11-17 20:13:30','Cancelado'),(38,1,'2025-11-17 20:49:28','Cancelado'),(39,7,'2025-11-18 18:44:43','Pendente'),(43,6,'2025-11-18 19:29:33','Cancelado'),(46,6,'2025-11-19 20:10:51','Cancelado'),(50,1,'2025-11-19 20:19:04','Cancelado'),(51,6,'2025-11-19 20:23:45','Cancelado'),(53,6,'2025-11-19 20:25:34','Cancelado'),(54,1,'2025-11-19 20:38:08','Cancelado'),(55,1,'2025-11-19 20:38:16','Cancelado'),(56,1,'2025-11-19 20:38:30','Cancelado'),(58,1,'2025-11-19 20:43:10','Cancelado'),(59,1,'2025-11-19 20:44:21','Cancelado'),(62,1,'2025-11-19 21:00:09','Cancelado'),(64,1,'2025-11-19 21:15:41','Cancelado'),(65,1,'2025-11-24 18:25:07','Cancelado'),(66,6,'2025-11-24 18:28:57','Cancelado'),(67,6,'2025-11-24 19:11:23','Pendente'),(80,1,'2025-11-24 19:17:46','Cancelado'),(81,1,'2025-11-24 19:50:26','Cancelado');
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto`
--

DROP TABLE IF EXISTS `produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `prod_nome` varchar(100) NOT NULL,
  `valor` float(10,2) NOT NULL,
  `quant_estoque` int(11) NOT NULL DEFAULT 1,
  `path_img` text DEFAULT NULL,
  `descricao` tinytext NOT NULL,
  `sexo` enum('Fêmea','Macho','Não se aplica') DEFAULT NULL,
  `peso` decimal(10,2) DEFAULT 0.00,
  `campeao` tinyint(4) DEFAULT 0,
  `id_categoria` int(11) NOT NULL,
  `id_subcategoria` int(11) NOT NULL,
  `produto_ativo` tinyint(4) NOT NULL DEFAULT 1,
  `idade` date DEFAULT NULL,
  PRIMARY KEY (`id_produto`),
  KEY `produto_ibfk_1` (`id_categoria`),
  KEY `produto_ibfk_2` (`id_subcategoria`),
  CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `produto_ibfk_2` FOREIGN KEY (`id_subcategoria`) REFERENCES `subcategoria` (`id_subcategoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `chk_quant_estoque_nao_negativo` CHECK (`quant_estoque` >= 0)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto`
--

LOCK TABLES `produto` WRITE;
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
INSERT INTO `produto` VALUES (1,'Dragão Negro',12040.50,1,'[\"uploads\\/img1_1762978431.jpg\",null,null,null]','Belíssimo exemplar da raça.','Macho',5000.00,1,2,9,1,'2023-01-25'),(2,'Babezieux',89.00,1,'uploads/6914f5936d6e5.jpg','A raça Barbezieux, originária da França medieval, destaca-se pelo porte alto e penas pretas iridescentes. Produz boa quantidade de ovos brancos e possui carne firme e saborosa, considerada superior à de Bresse. Sua pele assada fica dourada e aromátic','',15.00,0,3,13,1,'2025-02-15'),(3,'Khalil',150000.00,1,'[\"uploads\\/img1_1762980695.jpg\",null,null,null]','é uma raça antiga, conhecida por sua cabeça pequena e côncava, olhos expressivos, pescoço arqueado de cisne e cauda alta.','',450.00,0,2,7,1,'2025-08-05'),(4,'Basque-Chicken',91.00,1,'[\"uploads\\/img1_1762981246.jpg\",\"uploads\\/img2_1762981246.jpg\",null,null]','Originárias da região basca entre a Espanha e a França, as galinhas bascas são resistentes e ideais para criação ao ar livre. De porte médio, produzem boa carne e cerca de 200 ovos marrons por ano. São dóceis, amigáveis e valorizadas por sua con','',21.00,1,3,14,1,'2025-03-21'),(5,'Taurino',12000.00,2,'[\"uploads\\/img1_1763410821_691b83854f7cb.jpg\",\"uploads\\/img2_1763410821_691b83854fa03.png\",\"uploads\\/img3_1763410821_691b83854fbf7.jpg\",null]','Esta raça é conhecida por sua alta produtividade, qualidade de carne com bom marmoreio, rusticidade, adaptabilidade a climas quentes e resistência a parasitas, o que a torna uma das raças de corte de maior sucesso no Brasil.','',800.00,1,1,3,1,'2025-08-06'),(6,'Zebu',19500.00,0,'[\"uploads\\/img1_1763060218.jpg\",\"uploads\\/img2_1763060218.jpg\",\"uploads\\/img3_1763060218.jpg\",\"uploads\\/img4_1763060218.jpg\"]','Nelore é uma raça de gado bovino originária da Índia. Possui a pelagem branca e a pele preta o que lhe confere uma tolerância extraordinária ao calor.','',450.00,1,1,5,1,'2025-08-03'),(7,'Galinha Polonesa',117.00,0,'[\"uploads\\/img1_1763145152.jpg\",\"uploads\\/img2_1763145152.jpg\",null,null]','A galinha Polonesa é facilmente reconhecida por sua imponente “coroa” de penas, que lhe dá um visual exótico e elegante. É uma ave dócil, curiosa e bastante ornamental, muito apreciada em criações de exposição. Suas cores variadas e a plumage','',23.00,1,3,15,1,'2025-07-23'),(8,'Galinha Silkie',219.00,1,'[\"uploads\\/img1_1763145302.webp\",\"uploads\\/img2_1763145302.webp\",null,null]','A galinha Silkie é conhecida por sua plumagem suave e felpuda, que lembra lã ou seda, dando-lhe uma aparência única. De temperamento extremamente dócil e amigável, é muito apreciada como ave ornamental e de companhia. Suas penas fofas, pele escura ','',30.00,1,3,16,1,'2024-11-14'),(9,'Galinha Caipira',75.00,1,'[\"uploads\\/img1_1763145498.jpg\",\"uploads\\/img2_1763145498.jpg\",null,null]','A galinha caipira é uma ave rústica e resistente, criada solta e adaptada ao ambiente natural. Produz carne e ovos de excelente qualidade, muito valorizados pelo sabor mais autêntico. Ágil, ativa e saudável, é símbolo das pequenas propriedades e da','',12.00,1,3,17,1,'2025-01-01'),(10,'Vaca Irlandesa',6800.00,0,'[\"uploads\\/img1_1763145762.webp\",\"uploads\\/img2_1763145762.webp\",null,null]','As vacas irlandesas são conhecidas por sua rusticidade e adaptação ao clima úmido e verdejante da Irlanda. Criadas em pastagens amplas, produzem leite e carne de alta qualidade, apreciados mundialmente. São animais fortes, tranquilos e fundamentais p','',3000.00,1,1,4,1,'2025-06-14'),(11,'Vaca Girolando',13000.00,1,'[\"uploads\\/img1_1763146022.jpg\",\"uploads\\/img2_1763146022.webp\",null,null]','A vaca Girolando é resultado do cruzamento entre as raças Gir e Holandesa, unindo rusticidade e alta produção de leite. Adaptada ao clima brasileiro, destaca-se pela resistência, fertilidade e boa longevidade. É uma das principais escolhas para pecu','',230.00,1,1,2,1,'2024-11-13'),(12,'Boi Canchim',19000.00,0,'[\"uploads\\/img1_1763146287.jpg\",\"uploads\\/img2_1763146287.jpg\",null,null]','O boi da raça Canchim é um gado brasileiro formado a partir do cruzamento entre Charolês e zebuínos, reunindo força e rusticidade. Destaca-se pelo rápido ganho de peso, excelente rendimento de carcaça e alta eficiência em sistemas de corte. Adapta','',400.00,1,1,6,1,'2025-08-10'),(13,'Clydesdale',23000.00,0,'[\"uploads\\/img1_1763147063.webp\",\"uploads\\/img2_1763147063.webp\",null,null]','O cavalo Clydesdale é uma raça de tração escocesa famosa por seu porte imponente, força excepcional e presença marcante. Reconhecido pelas longas franjas brancas nas patas, combina elegância com potência. É dócil, trabalhador e muito utilizado e','',350.00,1,2,8,1,'2024-09-01'),(14,'Paint Horse',14000.00,1,'[\"uploads\\/img1_1763147846.jpg\",\"uploads\\/img2_1763147846.jpg\",\"uploads\\/img3_1763147846.jpg\",null]','O cavalo Paint Horse é conhecido por sua pelagem manchada e marcante, que combina beleza e personalidade únicas. Ágil, inteligente e versátil, destaca-se em atividades esportivas, vaquejada e equitação western. Seu temperamento dócil e cooperativo ','',250.00,1,2,10,1,'2025-09-14'),(15,'Percheron',17500.00,1,'[\"uploads\\/img1_1763148018.jpg\",\"uploads\\/img2_1763148018.webp\",\"uploads\\/img3_1763148018.jpg\",null]','O cavalo Percheron é uma raça francesa de tração reconhecida por sua força, resistência e porte majestoso. Apesar do tamanho imponente, possui temperamento calmo e cooperativo. É amplamente utilizado em trabalhos rurais, desfiles e atividades que e','',500.00,1,2,11,1,'2025-09-10'),(16,'Boi Americano',45000.00,1,'[\"uploads\\/img1_1763151673.png\",null,null,null]','Boi americano','',360.00,0,1,3,1,'2025-01-01'),(17,'Murundu',15000.00,1,'[\"uploads\\/img1_1763403061.jpg\",\"uploads\\/img2_1763403061.jpg\",\"uploads\\/img3_1763403061.jpg\",\"uploads\\/img4_1763403061.jpg\"]','Nelore é uma raça de gado bovino originária da Índia','Macho',462.00,0,1,1,1,'2025-03-01'),(18,'Ração do vale',150.00,6,'[\"uploads\\/img1_1763403643.png\",null,null,null]','A ração bovina é composta por diferentes ingredientes que fornecem nutrientes essenciais para o bom desempenho do rebanho. Isto é, proteínas, energia, vitaminas e minerais são alguns que podemos citar.','Não se aplica',40.00,0,4,18,1,'2025-10-01'),(19,'GALO',47000.00,8,'[\"uploads\\/img1_1763580102.jpg\",\"uploads\\/img2_1763580102.jpg\",\"uploads\\/img3_1763580102.jpg\",\"uploads\\/img4_1763580102.jpg\"]','DTDYDRY','Macho',3.00,0,3,16,1,'2025-01-01');
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategoria`
--

DROP TABLE IF EXISTS `subcategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcategoria` (
  `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `subcat_nome` varchar(100) DEFAULT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id_subcategoria`),
  KEY `subcategoria_ibfk_1` (`id_categoria`),
  CONSTRAINT `subcategoria_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategoria`
--

LOCK TABLES `subcategoria` WRITE;
/*!40000 ALTER TABLE `subcategoria` DISABLE KEYS */;
INSERT INTO `subcategoria` VALUES (1,'Angus',1),(2,'Brahman',1),(3,'Brangus',1),(4,'Hereford',1),(5,'Nelore',1),(6,'Senepol',1),(7,'Árabe',2),(8,'Draft Belga',2),(9,'Mustang',2),(10,'Paint Horse',2),(11,'Percheron',2),(12,'Puro Sangue Inglês',2),(13,'Legorne',3),(14,'Léon',3),(15,'Orpington',3),(16,'Playmouth Rock',3),(17,'Rhode Island Red',3),(18,'Rações e suplementos alimentares',4),(19,'Medicamentos veterinários',4),(20,'Produtos de higiene e cuidado',4),(21,'Equipamentos e utensílios',4),(22,'Suplementos nutricionais e adtivos',4);
/*!40000 ALTER TABLE `subcategoria` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-25 14:25:51
