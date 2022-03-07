-- Exportiere Struktur von Tabelle schulung_php1_CMS.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `ordernumber` int(11) NOT NULL,
  `authlevel` enum('PUBLIC','USER','ADMIN') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

