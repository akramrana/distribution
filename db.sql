-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.21-log - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table distribution.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '0',
  `is_deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table distribution.admin: ~5 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`admin_id`, `name`, `email`, `phone`, `password`, `is_active`, `is_deleted`) VALUES
	(1, 'Akram Hossain', 'akram.lezasolutions@gmail.com', '123123', '$2y$13$hFwiiI8oQv1KUvsfCVCWyuDjJmuuoEZNEMlS4tJKsXj5/7MA3vfbO', 1, 0),
	(2, 'Stebin John', 'stebin@lezasolutions.com', '1231231', '$2y$13$3VhEuRng7gWCbJiBWoeChu7f7bq7G3uaA/mlAF8HLsAA4rfWUsvi.', 0, 1),
	(3, 'Rehan Wangde', 'rehan@lezasolutions.com', '9930652325', '$2y$13$Y9k8QgOsLO.mzJT0NOcuR.M9veNhXnLIamNu7f00.SlPJ35OXcsay', 0, 0),
	(4, 'Yusuf', 'yousufisin@hotmail.com', '9993223', '$2y$13$BVyIZcx9ViD1m2qL4AvJj.NdyeT5OCzUT7fDehBu8HcgLNMX/PWEW', 0, 0),
	(5, 'Zaved', 'zaved@yahoo.com', '0145236987', '$2y$13$oIzILCSC/N5846Qgzcl4BOKQXRdhc9NXcq3F/zrWC.5gyA4aoqpQW', 1, 0);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table distribution.company
CREATE TABLE IF NOT EXISTS `company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `distributor_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` text,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`company_id`),
  KEY `FK_company_distributor` (`distributor_id`),
  CONSTRAINT `FK_company_distributor` FOREIGN KEY (`distributor_id`) REFERENCES `distributor` (`distributor_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table distribution.company: ~1 rows (approximately)
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` (`company_id`, `distributor_id`, `name`, `phone`, `email`, `address`, `is_deleted`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Bashundhara Group', '123123123', 'akram@yahoo.com', 'Bashundara road #45,House #12\r\nDhaka', 0, 1, '2018-03-13 23:17:41', '2018-03-13 23:17:41');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;

-- Dumping structure for table distribution.damage_product
CREATE TABLE IF NOT EXISTS `damage_product` (
  `damage_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `update_stock` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`damage_product_id`),
  KEY `FK__product` (`product_id`),
  CONSTRAINT `FK__product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table distribution.damage_product: ~2 rows (approximately)
/*!40000 ALTER TABLE `damage_product` DISABLE KEYS */;
INSERT INTO `damage_product` (`damage_product_id`, `product_id`, `qty`, `update_stock`, `created_at`, `is_deleted`) VALUES
	(4, 5, 10, 0, '2018-03-27 23:20:56', 1),
	(5, 5, 12, 0, '2018-03-27 23:21:59', 1);
/*!40000 ALTER TABLE `damage_product` ENABLE KEYS */;

-- Dumping structure for table distribution.distributor
CREATE TABLE IF NOT EXISTS `distributor` (
  `distributor_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `address` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`distributor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table distribution.distributor: ~2 rows (approximately)
/*!40000 ALTER TABLE `distributor` DISABLE KEYS */;
INSERT INTO `distributor` (`distributor_id`, `name`, `email`, `phone`, `password`, `address`, `created_at`, `updated_at`, `is_active`, `is_deleted`) VALUES
	(1, 'Akram Traders', 'akram.traders@yahoo.com', '14785215', '$2y$13$WgKApvGG23LDAHaqzB16S.9W4DWZnyB9RKsdnt38wJdfcXRLmE6IS', 'House #25,Road #15\r\nShekhertek,Mohammadpur \r\nDhaka 1207', '2018-03-06 23:27:37', '2018-03-06 23:38:45', 1, 0),
	(2, 'Neharika Traders', 'neharika.traders@yahoo.com', '456321', '$2y$13$slkC49mdQltlAQIwB7zOe.9/HDFk8A/OxWLYLfavXyKunYDrsGy3.', 'Dhaka 1208', '2018-03-08 23:45:08', '2018-03-08 23:45:08', 1, 0);
/*!40000 ALTER TABLE `distributor` ENABLE KEYS */;

-- Dumping structure for table distribution.manager
CREATE TABLE IF NOT EXISTS `manager` (
  `manager_id` int(11) NOT NULL AUTO_INCREMENT,
  `distributor_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '0',
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`manager_id`),
  KEY `FK__distributor` (`distributor_id`),
  CONSTRAINT `FK__distributor` FOREIGN KEY (`distributor_id`) REFERENCES `distributor` (`distributor_id`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table distribution.manager: ~2 rows (approximately)
/*!40000 ALTER TABLE `manager` DISABLE KEYS */;
INSERT INTO `manager` (`manager_id`, `distributor_id`, `name`, `email`, `phone`, `password`, `created_at`, `updated_at`, `is_active`, `is_deleted`) VALUES
	(1, 1, 'Afif Ezaz', 'afif.azaz@yahoo.com', '1231312313', '$2y$13$O.VmYKqRbJPGYNm0hUmbC.Yb6iffgdt4X6rS5xxQa2ATN5Qebac2e', '2018-03-08 23:35:12', '2018-03-08 23:39:31', 1, 0),
	(2, 2, 'Habib Ullah', 'habib.ullah@yahoo.com', '123123123', '$2y$13$wi/V9/M7dqTWsF.eIYcsf.zkiLkWQMN1FoIWh7kaKcWur1or7a5PO', '2018-03-08 23:45:51', '2018-03-08 23:45:51', 1, 0);
/*!40000 ALTER TABLE `manager` ENABLE KEYS */;

-- Dumping structure for table distribution.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_number` bigint(20) NOT NULL,
  `distributor_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `recipient_name` varchar(255) DEFAULT NULL,
  `recipient_phone` varchar(15) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `is_processed` int(1) NOT NULL DEFAULT '0',
  `shop_id` int(11) DEFAULT NULL,
  `sales_person_id` int(11) DEFAULT NULL,
  `delivery_time` datetime DEFAULT NULL,
  `delivery_charge` double DEFAULT NULL,
  `is_paid` int(1) NOT NULL DEFAULT '0',
  `discount` double DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_id`),
  KEY `fk_shopping_cart_users1_idx` (`distributor_id`),
  KEY `fk_orders_shipping_addresses1_idx` (`shop_id`),
  KEY `FK_orders_sales_person` (`sales_person_id`),
  KEY `FK_orders_manager` (`manager_id`),
  CONSTRAINT `FK_orders_distributor` FOREIGN KEY (`distributor_id`) REFERENCES `distributor` (`distributor_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_orders_manager` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`manager_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_orders_sales_person` FOREIGN KEY (`sales_person_id`) REFERENCES `sales_person` (`sales_person_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_orders_shop` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`shop_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table distribution.orders: ~0 rows (approximately)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table distribution.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `order_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` float NOT NULL,
  `message` text,
  PRIMARY KEY (`order_item_id`),
  KEY `fk_shopping_cart_product1_idx` (`product_id`),
  KEY `FK_order_items_orders` (`order_id`),
  CONSTRAINT `FK_order_items_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_order_items_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table distribution.order_items: ~0 rows (approximately)
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;

-- Dumping structure for table distribution.order_status
CREATE TABLE IF NOT EXISTS `order_status` (
  `order_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_date` datetime NOT NULL,
  `order_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `comment` text,
  PRIMARY KEY (`order_status_id`),
  KEY `fk_order_status_status1_idx` (`status_id`),
  KEY `fk_order_status_orders1_idx` (`order_id`),
  KEY `FK_order_status_manager` (`manager_id`),
  CONSTRAINT `FK_order_status_manager` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`manager_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_order_status_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_order_status_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table distribution.order_status: ~0 rows (approximately)
/*!40000 ALTER TABLE `order_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_status` ENABLE KEYS */;

-- Dumping structure for table distribution.product
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `distributor_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_description` text,
  `description` text,
  `specification` text,
  `SKU` varchar(255) NOT NULL,
  `manufacturer_number` varchar(255) DEFAULT NULL,
  `regular_price` decimal(10,3) DEFAULT NULL,
  `final_price` decimal(10,3) NOT NULL,
  `width` float DEFAULT NULL,
  `height` float DEFAULT NULL,
  `length` float DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `remaining_quantity` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `is_damage` int(11) NOT NULL DEFAULT '0',
  `is_active` int(11) NOT NULL DEFAULT '0',
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`),
  KEY `FK_product_distributor` (`distributor_id`),
  KEY `FK_product_company` (`supplier_id`),
  CONSTRAINT `FK_product_company` FOREIGN KEY (`supplier_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_product_distributor` FOREIGN KEY (`distributor_id`) REFERENCES `distributor` (`distributor_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table distribution.product: ~2 rows (approximately)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`product_id`, `distributor_id`, `name`, `short_description`, `description`, `specification`, `SKU`, `manufacturer_number`, `regular_price`, `final_price`, `width`, `height`, `length`, `weight`, `remaining_quantity`, `created_at`, `updated_at`, `supplier_id`, `is_damage`, `is_active`, `is_deleted`) VALUES
	(4, 1, 'ULAK Galaxy S6 Case', 'ULAK Galaxy S6 Case', 'ULAK Galaxy S6 Case, [Drop Protection] Knox Armor [Rugged Defense] Heavy Duty with Shock Absorbent [Dual Layered Hybrid Case] Cover for Samsung Galaxy S6 - [Mint Green] ', 'ULAK Galaxy S6 Case, [Drop Protection] Knox Armor [Rugged Defense] Heavy Duty with Shock Absorbent [Dual Layered Hybrid Case] Cover for Samsung Galaxy S6 - [Mint Green] ', 'ADM0001', '', 10.000, 9.500, NULL, NULL, NULL, NULL, 60, '2018-03-20 23:34:04', '2018-03-20 23:36:49', NULL, 0, 1, 0),
	(5, 1, ' Samsung Galaxy S9 ', ' Samsung Galaxy S9 ', ' Samsung Galaxy S9 Unlocked Smartphone - Lilac Purple - US Warranty ', ' Samsung Galaxy S9 Unlocked Smartphone - Lilac Purple - US Warranty ', 'ADM0002', '', 78000.000, 77500.000, NULL, NULL, NULL, NULL, 17, '2018-03-20 23:39:49', '2018-03-20 23:39:49', 1, 0, 1, 0);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- Dumping structure for table distribution.product_stock
CREATE TABLE IF NOT EXISTS `product_stock` (
  `product_stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `is_deleted` varchar(45) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_stock_id`),
  KEY `fk_product_stocks_product1_idx1` (`product_id`),
  CONSTRAINT `fk_product_stocks_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table distribution.product_stock: ~5 rows (approximately)
/*!40000 ALTER TABLE `product_stock` DISABLE KEYS */;
INSERT INTO `product_stock` (`product_stock_id`, `product_id`, `quantity`, `created_date`, `is_deleted`) VALUES
	(2, 4, 50, '2018-03-20 23:34:04', '0'),
	(3, 5, 10, '2018-03-20 23:39:49', '0'),
	(4, 5, 5, '2018-03-20 23:46:42', '0'),
	(5, 4, 10, '2018-03-20 23:46:58', '0'),
	(6, 5, 2, '2018-03-20 23:52:22', '0');
/*!40000 ALTER TABLE `product_stock` ENABLE KEYS */;

-- Dumping structure for table distribution.sales_person
CREATE TABLE IF NOT EXISTS `sales_person` (
  `sales_person_id` int(11) NOT NULL AUTO_INCREMENT,
  `distributor_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `present_address` text,
  `permanent_address` text,
  `national_id_no` varchar(50) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`sales_person_id`),
  KEY `FK_sales_person_distributor` (`distributor_id`),
  CONSTRAINT `FK_sales_person_distributor` FOREIGN KEY (`distributor_id`) REFERENCES `distributor` (`distributor_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table distribution.sales_person: ~1 rows (approximately)
/*!40000 ALTER TABLE `sales_person` DISABLE KEYS */;
INSERT INTO `sales_person` (`sales_person_id`, `distributor_id`, `name`, `phone`, `present_address`, `permanent_address`, `national_id_no`, `joining_date`, `is_deleted`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 2, 'Jalal Hossen', '12312313123', 'Test address', 'Test address', '23423424234', '2018-03-01', 0, 1, '2018-03-13 23:52:11', '2018-03-13 23:52:11');
/*!40000 ALTER TABLE `sales_person` ENABLE KEYS */;

-- Dumping structure for table distribution.shop
CREATE TABLE IF NOT EXISTS `shop` (
  `shop_id` int(11) NOT NULL AUTO_INCREMENT,
  `distributor_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `owner_name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '0',
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`shop_id`),
  KEY `FK_shop_distributor` (`distributor_id`),
  CONSTRAINT `FK_shop_distributor` FOREIGN KEY (`distributor_id`) REFERENCES `distributor` (`distributor_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table distribution.shop: ~2 rows (approximately)
/*!40000 ALTER TABLE `shop` DISABLE KEYS */;
INSERT INTO `shop` (`shop_id`, `distributor_id`, `name`, `owner_name`, `phone`, `address`, `created_at`, `updated_at`, `is_active`, `is_deleted`) VALUES
	(1, 1, 'Mahmud store', 'Al Mahmud', '42342423', 'Shekhertek masjid market', '2018-03-19 23:30:35', '2018-03-19 23:32:07', 1, 0),
	(2, 1, 'Bandhon store', 'Bandhon', '45645665456', 'test test', '2018-03-19 23:32:29', '2018-03-19 23:33:14', 1, 0);
/*!40000 ALTER TABLE `shop` ENABLE KEYS */;

-- Dumping structure for table distribution.status
CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table distribution.status: ~4 rows (approximately)
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`status_id`, `name`, `color`, `is_default`) VALUES
	(1, 'Pending', '#0d7f0d', 1),
	(3, 'In Progress', '#434343', 0),
	(4, 'Delivered', '#ff0000', 0),
	(5, 'Cancelled', '#674ea7', 0);
/*!40000 ALTER TABLE `status` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
