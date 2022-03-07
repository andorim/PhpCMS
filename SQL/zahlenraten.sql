-- Exportiere Struktur von Tabelle schulung_php1_CMS.zahlenraten
CREATE TABLE IF NOT EXISTS `zahlenraten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `randomnumber` int(11) NOT NULL,
  `tries` int(11) NOT NULL DEFAULT 1,
  `solved` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;