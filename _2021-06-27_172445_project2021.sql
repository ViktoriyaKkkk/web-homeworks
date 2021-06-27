/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/ project2021 /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE project2021;

DROP TABLE IF EXISTS company;
CREATE TABLE `company` (
  `id_company` int NOT NULL AUTO_INCREMENT,
  `name_company` varchar(100) DEFAULT NULL,
  `address_company` text,
  `description_company` text,
  PRIMARY KEY (`id_company`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS department;
CREATE TABLE `department` (
  `id_department` int NOT NULL AUTO_INCREMENT,
  `company_id` int DEFAULT NULL,
  `name_department` varchar(100) DEFAULT NULL,
  `description_department` text,
  PRIMARY KEY (`id_department`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `department_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id_company`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS employee;
CREATE TABLE `employee` (
  `id_employee` int NOT NULL AUTO_INCREMENT,
  `department_id` int DEFAULT NULL,
  `name_employee` varchar(30) DEFAULT NULL,
  `surname_employee` varchar(40) DEFAULT NULL,
  `passport_employee` varchar(10) DEFAULT NULL,
  `phone_employee` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_employee`),
  KEY `department_id` (`department_id`),
  CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id_department`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

INSERT INTO company(id_company,name_company,address_company,description_company) VALUES(1,'Мосполитех',X'd091d0bed0bbd18cd188d0b0d18f20d181d0b5d0bcd0b5d0bdd0bed0b2d181d0bad0b0d18f203338',X'd09cd0bed181d0bad0bed0b2d181d0bad0b8d0b920d0bfd0bed0bbd0b8d182d0b5d185d0bdd0b8d187d0b5d181d0bad0b8d0b920d183d0bdd0b8d0b2d0b5d180d181d0b8d182d0b5d182'),(2,'Пятёрочка',X'd091d0bed180d0b8d181d0b020d0b3d0b0d0bbd183d188d0bad0b8d0bdd0b0203135',X'd0bcd0b0d0b3d0b0d0b7d0b8d0bd20d0bfd18fd182d191d180d0bad0b020d180d0b0d0b1d0bed182d0b0d0b5d18220d0b4d0be203233203030'),(3,'Покрас',X'd0a1d0b8d180d0b5d0bdd0b5d0b2d18bd0b920d0b1d183d0bbd18cd0b2d0b0d1802033',X'd0a1d0b0d0bbd0bed0bd20d0bfd0bed0bad180d0b0d181d0bad0b820d0b2d0bed0bbd0bed181');

INSERT INTO department(id_department,company_id,name_department,description_department) VALUES(1,1,'црс',X'd186d0b5d0bdd182d18020d0bfd0be20d180d0b0d0b1d0bed182d0b520d181d0be20d181d182d183d0b4d0b5d0bdd182d0b0d0bcd0b8'),(2,1,'Бухгалтерия',X'd180d0b0d0b7d0b1d0b8d180d0b0d0b5d182d181d18f20d18120d0b4d0bed0bad183d0bcd0b5d0bdd182d0b0d0bcd0b8'),(3,2,'Бухгалтерия',X'd180d0b0d0b7d0b1d0b8d180d0b0d0b5d182d181d18f20d18120d0b4d0bed0bad183d0bcd0b5d0bdd182d0b0d0bcd0b8'),(4,3,'маркетинговый отдел',X'd0bfd180d0bed0b4d0b2d0b8d0b6d0b5d0bdd0b8d0b520d181d182d183d0b4d0b8d0b8');
INSERT INTO employee(id_employee,department_id,name_employee,surname_employee,passport_employee,phone_employee) VALUES(1,1,'Олег','Полежайкин','123456789','1234567890'),(2,2,'Катерина','Адушкина','54321ё','54312'),(3,2,'Елизавета','Прохорова','5325656','425446546'),(4,4,'Илья','Черепенко','235433','543245554');