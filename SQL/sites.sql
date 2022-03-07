-- Exportiere Struktur von Tabelle schulung_php1_CMS.sites
CREATE TABLE IF NOT EXISTS `sites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` mediumtext NOT NULL,
  `type` enum('txt','html','php') NOT NULL,
  `ordernumber` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `cat` (`categorie`),
  CONSTRAINT `cat` FOREIGN KEY (`categorie`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
