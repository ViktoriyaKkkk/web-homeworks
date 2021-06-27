/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/ youla /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE youla;

DROP TABLE IF EXISTS category;
CREATE TABLE `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `name_category` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS product;
CREATE TABLE `product` (
  `id_product` int NOT NULL AUTO_INCREMENT,
  `name_product` varchar(100) DEFAULT NULL,
  `price_product` int DEFAULT NULL,
  `description_product` text,
  `types_id` int DEFAULT NULL,
  PRIMARY KEY (`id_product`),
  KEY `types_id` (`types_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`types_id`) REFERENCES `types` (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS subcategory;
CREATE TABLE `subcategory` (
  `id_subcategory` int NOT NULL AUTO_INCREMENT,
  `category_id` int DEFAULT NULL,
  `name_subcategory` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_subcategory`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS types;
CREATE TABLE `types` (
  `id_type` int NOT NULL AUTO_INCREMENT,
  `subcategory_id` int DEFAULT NULL,
  `name_type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_type`),
  KEY `subcategory_id` (`subcategory_id`),
  CONSTRAINT `types_ibfk_1` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`id_subcategory`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

INSERT INTO category(id_category,name_category) VALUES(1,'Вещи, электроника и прочее'),(2,'Услуги исполнителей'),(3,'Недвижимость');

INSERT INTO product(id_product,name_product,price_product,description_product,types_id) VALUES(1,'Меховая жилетка',6000,X'd096d0b8d0bbd0b5d182d0bad0b020d0b8d0b720d0bcd0b5d185d0b020d0bbd0b8d181d18b20d187d0b5d180d0bdd0bed0b1d183d180d0bad0b820d18120d0bdd0b0d182d183d180d0b0d0bbd18cd0bdd0bed0b920d0b7d0b0d0bcd188d0b5d0b9202cd0bfd180d0b8d182d0b0d0bbd0b5d0bdd0bdd18bd0b920d181d0b8d0bbd183d18dd182d096d0b8d0bbd0b5d182d0bad0b020d0b8d0b720d0bcd0b5d185d0b020d0bbd0b8d181d18b20d187d0b5d180d0bdd0bed0b1d183d180d0bad0b820d18120d0bdd0b0d182d183d180d0b0d0bbd18cd0bdd0bed0b920d0b7d0b0d0bcd188d0b5d0b9202cd0bfd180d0b8d182d0b0d0bbd0b5d0bdd0bdd18bd0b920d181d0b8d0bbd183d18dd182',1),(2,'Мото школа',1500,X'd0bed0b1d183d187d0b0d0b5d18220d0bcd0bed182d0be20d0b2d0bed0b6d0b4d0b5d0bdd0b8d18e',3);

INSERT INTO subcategory(id_subcategory,category_id,name_subcategory) VALUES(1,1,'Женский гардероб'),(2,1,'Мужской гардероб'),(3,1,'Детский гардероб'),(4,2,'Обучение'),(5,3,'Аренда квартиры');
INSERT INTO types(id_type,subcategory_id,name_type) VALUES(1,1,'Верхняя одежда'),(2,1,'Аксессуары'),(3,2,'Обучение вождению'),(4,3,'2 комнаты');