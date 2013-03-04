/*
Navicat MySQL Data Transfer

Source Server         : db
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : fuel_intro

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2013-03-04 18:32:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `categorias`
-- ----------------------------
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categorias
-- ----------------------------
INSERT INTO `categorias` VALUES ('1', 'ALIMENTACIÓN', '1362417563', '1362417563');
INSERT INTO `categorias` VALUES ('2', 'EDUCACI&Oacute;N', '1362417571', '1362417571');
INSERT INTO `categorias` VALUES ('3', 'SALUD', '1362417579', '1362417579');
INSERT INTO `categorias` VALUES ('4', 'VESTIMENTA', '1362417587', '1362417587');
INSERT INTO `categorias` VALUES ('5', 'VIVIENDA', '1362417593', '1362417593');

-- ----------------------------
-- Table structure for `facturas`
-- ----------------------------
DROP TABLE IF EXISTS `facturas`;
CREATE TABLE `facturas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ruc` varchar(13) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `fecha` datetime NOT NULL,
  `tipo` int(1) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `comentario` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of facturas
-- ----------------------------

-- ----------------------------
-- Table structure for `migration`
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `type` varchar(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `migration` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('app', 'default', '001_create_facturas');
INSERT INTO `migration` VALUES ('app', 'default', '002_create_rucs');
INSERT INTO `migration` VALUES ('app', 'default', '003_create_categorias');

-- ----------------------------
-- Table structure for `rucs`
-- ----------------------------
DROP TABLE IF EXISTS `rucs`;
CREATE TABLE `rucs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ruc` varchar(13) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rucs
-- ----------------------------
