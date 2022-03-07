-- Exportiere Struktur von Tabelle schulung_php1_CMS.config
CREATE TABLE IF NOT EXISTS `config` (
  `option` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  PRIMARY KEY (`option`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
