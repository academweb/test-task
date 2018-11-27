CREATE TABLE IF NOT EXISTS `huge`.`csv_data` (
 `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `user_id` int(11) unsigned NOT NULL,
 `name` text NOT NULL,
 `value` text NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='csv data';
