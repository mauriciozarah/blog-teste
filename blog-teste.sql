USE `wmaco071_blog-teste`;
-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: blog_teste
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.14.04.1

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
-- Table structure for table `tab_comentarista`
--

DROP TABLE IF EXISTS `tab_comentarista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tab_comentarista` (
  `idcomentarista` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `data_hora_entrada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`idcomentarista`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_comentarista`
--

LOCK TABLES `tab_comentarista` WRITE;
/*!40000 ALTER TABLE `tab_comentarista` DISABLE KEYS */;
/*!40000 ALTER TABLE `tab_comentarista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_comentarios`
--

DROP TABLE IF EXISTS `tbl_comentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_comentarios` (
  `idcomentario` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `data_hora_publicacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_comentarista` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  PRIMARY KEY (`idcomentario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_comentarios`
--

LOCK TABLES `tbl_comentarios` WRITE;
/*!40000 ALTER TABLE `tbl_comentarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_comentarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_postador`
--

DROP TABLE IF EXISTS `tbl_postador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_postador` (
  `idpostador` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`idpostador`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_postador`
--

LOCK TABLES `tbl_postador` WRITE;
/*!40000 ALTER TABLE `tbl_postador` DISABLE KEYS */;
INSERT INTO `tbl_postador` VALUES (1,'Mauricio Zaha','mzaha@hotmail.com','1234567');
/*!40000 ALTER TABLE `tbl_postador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_posts`
--

DROP TABLE IF EXISTS `tbl_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_posts` (
  `idpost` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `conteudo` longtext NOT NULL,
  `descricao_slug` varchar(255) NOT NULL,
  `ativo` char(1) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `data_hora` date NOT NULL,
  `breve_descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`idpost`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_posts`
--

LOCK TABLES `tbl_posts` WRITE;
/*!40000 ALTER TABLE `tbl_posts` DISABLE KEYS */;
INSERT INTO `tbl_posts` VALUES (1,'A descrição da concorrida corrida de abudab','A corrida de Abudab é uma das mais concorridas corridas mundiais. Sobre o deserto escaldante os carros têm que aguentar altas temperaturas e terrenos acidentados.','<p>\n A corrida de Abudab é uma das mais concorridas corridas mundiais. Sobre o deserto escaldante os carros têm que aguentar altas temperaturas e terrenos acidentados.</p>\n<p>\n Ésta grande corrida conta com marcas automotivas de grande vulto mundial, carros preparados para suportarem terrenos acidentados e altas temperaturas são prioridade nessa corrida.</p>\n','a-descricao-da-concorrida-corrida-de-abudab','S','corrida-56c09bc304d38.jpg','2016-02-14','A corrida de Abudab é uma das mais concorridas corridas mundiais. Sobre o deserto escaldante os carros têm que aguentar altas temperaturas e terrenos acidentados.'),(2,'Dilma teme impetchment','A Presidenta da República Dilma Russef teme proximidade de Impetchment','<p>\n A Presidenta da República Dilma Russef teme proximidade de Impetchment alega jornal do Senado.</p>\n<p>\n Com a frequente crise política e estouros de escandalos envolvendo a Petrobras, incluindo planos de delação premiada, a presidenta da república teme proximidade de Impeachment.</p>\n<p>\n Vice presidente, Michael Temer, diz temer a proximidade de queda da Presidenta, tendo em vista a crescente manifestação popular.</p>\n','dilma-teme-impetchment','S','dilma-óculos-56c0b461495fa.jpg','2016-02-14','A Presidenta da República Dilma Russef teme proximidade de Impetchment'),(4,'A busca incessante de Deus na vida dos cristãos','A busca de Deus na vida dos cristãos está voltada incessantemente no recebimento do Espírito Santo. Falar em linguas e ter o Senhor Jesus como único Senhor e Salvador é a finalidade da fé cristã','<p>\n A incessante busca pelo Espírito Santo de Deus pelos cristãos, principalmente das igrejas evangélicas, é a grande chamada para os cultos de adoração ao Senhor Jesus.</p>\n<p>\n Aqueles que esperam no Senhor voam como águias, correm como as corças e não se fatigam, pois são guiados pelo Espirito Santo de Deus.</p>\n<p>\n  </p>\n','a-busca-incessante-de-deus-na-vida-dos-cristaos','S','fe-56c09c4546525.jpg','2016-02-14','A busca de Deus na vida dos cristãos está voltada incessantemente no recebimento do Espírito Santo. Falar em linguas e ter o Senhor Jesus como único Senhor e Salvador é a finalidade da fé cristã'),(5,'Procure a Deus todos os dias e ore incessantemente','A procura a Deus e a Oração feita pelo Espírito Santo de Jesus(Deus) tem que ser feita todos os dias e incessantemente.','<p>\n A oração pelo Espírito Santo de Deus(Jesus) tem que ser feita todos os dias incessantemente mesmo que em pensamento.</p>\n<p>\n Pois Deus quer que estejamos com Ele todos os dias de nossa vida.</p>\n<p>\n É com ciumes que o Espirito de Deus quer a todos os seus Santos.</p>\n<p>\n Pratiquemos a oração do Espírito de Deus todos os dias incessantemente...</p>\n','procure-a-deus-todos-os-dias-e-ore-incessantemente','S','ora_o-56c0a322bcd3d.jpg','2016-02-14','A procura a Deus e a Oração feita pelo Espírito Santo de Jesus(Deus) tem que ser feita todos os dias e incessantemente.'),(6,'A Glória de Deus e a benção aos seus seguidores','A Glória de Deus é a benção aos que seguem seus mandamentos e procuram nas suas palavras a incansável fonte da Vida','<p>\n A incansável fonte de Vida está nas palavras de Deus, isto já é conhecido no meio evangélico há muito tempo.</p>\n<p>\n A benção por seguir a Deus, nosso Senhor e Salvador Jesus, são as dádivas que a fiél palavra nos traz.</p>\n<p>\n Não há dor, nem peso em seguir as palavras de Deus, \"Vinde a Mim os que estão cansados\", assim diz a palavra</p>\n','a-gloria-de-deus-e-a-bencao-aos-seus-seguidores','S','espirito_santo_blog-56c0be441c6d7.jpg','2016-02-14','A Glória de Deus é a benção aos que seguem seus mandamentos e procuram nas suas palavras a incansável fonte da Vida');
/*!40000 ALTER TABLE `tbl_posts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-14 21:47:19
