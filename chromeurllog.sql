DROP TABLE IF EXISTS `chromeurllog`;

CREATE TABLE `chromeurllog` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `url` varchar(500) NOT NULL COMMENT 'url',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'time ',
  `ip` varchar(15) NOT NULL COMMENT 'ip',
  `querystring` varchar(500) NOT NULL COMMENT 'all query string',
  `isok` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 is ok ,0 has problem',
  `title` varchar(500) DEFAULT NULL COMMENT 'html title fetched by php',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `searchlog`;

CREATE TABLE `searchlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id and  A_I ',
  `keyword` varchar(2000) NOT NULL COMMENT 'keywords searched',
  `machineid` varchar(32) NOT NULL COMMENT 'macid.{linux|win7|winxp}',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isuploaded` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否已被同步，默认否，值为0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

