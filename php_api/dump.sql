CREATE TABLE `api_currency_rate` (
 `from` varchar(3) NOT NULL,
 `to` varchar(3) NOT NULL,
 `rate` decimal(16,8) unsigned NOT NULL,
 `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`from`,`to`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `api_currency_stat` (
 `date` date NOT NULL,
 `google` int(10) unsigned NOT NULL DEFAULT '0',
 `xe` int(10) unsigned NOT NULL DEFAULT '0',
 PRIMARY KEY (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;