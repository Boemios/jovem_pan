-- MySQL dump 10.13  Distrib 5.1.61, for debian-linux-gnu (i486)
--
-- Host: localhost    Database: JovemPan
-- ------------------------------------------------------
-- Server version	5.1.61-0ubuntu0.10.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `USUARIOS`
--

DROP TABLE IF EXISTS `USUARIOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USUARIOS` (
  `cod` tinyint(1) NOT NULL AUTO_INCREMENT,
  `cod_col` tinyint(1) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`cod`),
  UNIQUE KEY `Key_nome` (`nome`(1)),
  KEY `cod_col` (`cod_col`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `USUARIOS`
--

LOCK TABLES `USUARIOS` WRITE;
/*!40000 ALTER TABLE `USUARIOS` DISABLE KEYS */;
INSERT INTO `USUARIOS` VALUES (2,1,'21232f297a57a5a743894a0e4a801fc3','admin');
/*!40000 ALTER TABLE `USUARIOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cad_col`
--

DROP TABLE IF EXISTS `cad_col`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cad_col` (
  `col_cod` tinyint(1) NOT NULL AUTO_INCREMENT,
  `col_nom` text NOT NULL,
  `col_car` enum('Gerente corporativo','Gerente comercial','Executivo de vendas','Assistente comercial') NOT NULL,
  `col_praca` tinyint(1) NOT NULL,
  `col_mercado` enum('Nacional','Local') NOT NULL,
  PRIMARY KEY (`col_cod`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cad_col`
--

LOCK TABLES `cad_col` WRITE;
/*!40000 ALTER TABLE `cad_col` DISABLE KEYS */;
INSERT INTO `cad_col` VALUES (1,'Colaborar de teste','Gerente corporativo',1,'Nacional');
/*!40000 ALTER TABLE `cad_col` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cad_contratos`
--

DROP TABLE IF EXISTS `cad_contratos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cad_contratos` (
  `con_cod` int(1) NOT NULL AUTO_INCREMENT,
  `con_tip` int(1) NOT NULL,
  `con_cli` int(2) NOT NULL,
  `con_age` text,
  `con_gec` int(1) NOT NULL,
  `con_prc` int(1) NOT NULL,
  `con_con` int(1) NOT NULL,
  `con_dat` datetime NOT NULL,
  `con_ctr` int(1) NOT NULL,
  `con_aut` text NOT NULL,
  `con_bru` float NOT NULL,
  `con_des` float NOT NULL,
  `con_tip_venda` enum('DI','BR','LI') NOT NULL,
  `con_liq` float NOT NULL,
  `con_fat` float NOT NULL,
  PRIMARY KEY (`con_cod`),
  KEY `con_tip` (`con_tip`),
  KEY `con_cli` (`con_cli`),
  KEY `con_gec` (`con_gec`),
  KEY `con_prc` (`con_prc`),
  KEY `con_con` (`con_con`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cad_contratos`
--

LOCK TABLES `cad_contratos` WRITE;
/*!40000 ALTER TABLE `cad_contratos` DISABLE KEYS */;
/*!40000 ALTER TABLE `cad_contratos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cad_entidades`
--

DROP TABLE IF EXISTS `cad_entidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cad_entidades` (
  `ent_cod` int(1) NOT NULL AUTO_INCREMENT,
  `ent_raz` text NOT NULL,
  `ent_fta` text,
  PRIMARY KEY (`ent_cod`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cad_entidades`
--

LOCK TABLES `cad_entidades` WRITE;
/*!40000 ALTER TABLE `cad_entidades` DISABLE KEYS */;
/*!40000 ALTER TABLE `cad_entidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cad_metas`
--

DROP TABLE IF EXISTS `cad_metas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cad_metas` (
  `met_cod` int(1) NOT NULL AUTO_INCREMENT,
  `met_mes` datetime NOT NULL,
  `met_val` float NOT NULL,
  PRIMARY KEY (`met_cod`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cad_metas`
--

LOCK TABLES `cad_metas` WRITE;
/*!40000 ALTER TABLE `cad_metas` DISABLE KEYS */;
/*!40000 ALTER TABLE `cad_metas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cad_parcelas`
--

DROP TABLE IF EXISTS `cad_parcelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cad_parcelas` (
  `par_cod` int(1) NOT NULL AUTO_INCREMENT,
  `par_con` int(1) NOT NULL,
  `par_seq` int(1) NOT NULL DEFAULT '1',
  `par_brt` float NOT NULL DEFAULT '1',
  `par_lqd` float NOT NULL DEFAULT '1',
  `par_fat` float NOT NULL DEFAULT '1',
  `par_nf` text NOT NULL,
  `par_nfemissao` datetime NOT NULL,
  `par_pag` datetime NOT NULL,
  PRIMARY KEY (`par_cod`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cad_parcelas`
--

LOCK TABLES `cad_parcelas` WRITE;
/*!40000 ALTER TABLE `cad_parcelas` DISABLE KEYS */;
/*!40000 ALTER TABLE `cad_parcelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_venda`
--

DROP TABLE IF EXISTS `tipo_venda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_venda` (
  `tip_cod` int(1) NOT NULL AUTO_INCREMENT,
  `tip_des` varchar(255) NOT NULL,
  PRIMARY KEY (`tip_cod`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_venda`
--

LOCK TABLES `tipo_venda` WRITE;
/*!40000 ALTER TABLE `tipo_venda` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_venda` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-03-28 20:10:28
