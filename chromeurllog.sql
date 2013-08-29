
CREATE TABLE `chromeurllog` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `url` varchar(500) NOT NULL COMMENT 'url',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'time ',
  `ip` varchar(15) NOT NULL COMMENT 'ip',
  `querystring` varchar(500) NOT NULL COMMENT 'all query string',
  `isok` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 is ok ,0 has problem',
  `title` varchar(500) DEFAULT NULL COMMENT 'html title fetched by php',
  `useragent` varchar(500) DEFAULT NULL COMMENT 'useragent',
  PRIMARY KEY (`id`),
  KEY `url` (`url`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `uuidlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id only',
  `uuid` varchar(20) NOT NULL COMMENT 'uuid name ',
  `comment` varchar(1000) NOT NULL COMMENT 'comment of current uuid',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `errorlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `info` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `excludedomain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `domain` (`domain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `excludeurl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

