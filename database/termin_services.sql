CREATE TABLE IF NOT EXISTS `termin_services` (
  `termin_id` int(30) NOT NULL,
  `doctor_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `termin_id` (`termin_id`),
  KEY `doctor_id` (`doctor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cms_db.invoice_services: ~7 rows (approximately)
/*!40000 ALTER TABLE `invoice_services` DISABLE KEYS */;
REPLACE INTO `termin_services` (`termin_id`, `doctor_id`, `date_created`) VALUES
	(1, 1,  '2021-11-05'),
	(1, 3, '2021-11-05'),
	(2, 3, '2021-11-05'),
	(2, 1, '2021-11-05'),
	(2, 2, '2021-11-05'),
	(3, 2, '2021-11-05'),
	(3, 3, '2021-11-05');