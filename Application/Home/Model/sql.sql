  CREATE TABLE IF NOT EXISTS `cx_x_affair` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `ParentId` int(11) NOT NULL DEFAULT '0',
    `Name` varchar(100) NOT NULL,
    `Description` text,
    `HotValue` int(11) NOT NULL DEFAULT '1',
    `Status` varchar(100) NOT NULL DEFAULT '使用中',
    PRIMARY KEY (`Id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
  
  CREATE TABLE IF NOT EXISTS `cx_x_affair_comment` (
    `Id` int(11) NOT NULL,
    `AuthorId` int(11) NOT NULL,
    `AffairId` int(11) NOT NULL,
    `PreCommentId` int(11) NOT NULL,
    `Content` text NOT NULL,
    PRIMARY KEY (`Id`)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  
  CREATE TABLE IF NOT EXISTS `cx_x_affair_service_type` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `AffairId` int(11) NOT NULL,
    `ServiceTypeId` int(11) NOT NULL,
    `Description` text NOT NULL,
    PRIMARY KEY (`Id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

  CREATE TABLE IF NOT EXISTS `cx_x_baike` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `EditorId` int(11) NOT NULL,
    `Version` int(11) NOT NULL,
    `Title` varchar(50) NOT NULL,
    `Content` text NOT NULL,
    `Type` varchar(50) NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
  
  
  CREATE TABLE IF NOT EXISTS `cx_x_baike_history` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `BaikeId` int(11) NOT NULL,
  `Version` int(11) NOT NULL,
  `EditorId` int(11) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Content` text NOT NULL,
  `Type` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

  CREATE TABLE IF NOT EXISTS `cx_x_need` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `Title` varchar(50) NOT NULL,
    `Introduction` varchar(200) NOT NULL,
    `Contacts` varchar(50) NOT NULL,
    `Phone` varchar(20) NOT NULL,
    `PublisherId` int(11) NOT NULL,
    PRIMARY KEY (`Id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

  CREATE TABLE IF NOT EXISTS `cx_x_need_comment` (
    `Id` int(11) NOT NULL,
    `AuthorId` int(11) NOT NULL,
    `NeedId` int(11) NOT NULL,
    `PreCommentId` int(11) NOT NULL,
    `Content` text NOT NULL,
    PRIMARY KEY (`Id`)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

  CREATE TABLE IF NOT EXISTS `cx_x_service` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `PublisherId` int(11) NOT NULL,
    `TypeId` int(11) NOT NULL DEFAULT '0',
    `Name` varchar(100) NOT NULL DEFAULT '',
    `Introduction` text,
    `HotValue` int(11) NOT NULL DEFAULT '1',
    `Contacts` varchar(100) NOT NULL DEFAULT '',
    `Phone` varchar(100) NOT NULL DEFAULT '',
    `Address` varchar(500) NOT NULL DEFAULT '',
    `ImgsUrl` text,
    PRIMARY KEY (`Id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

  CREATE TABLE IF NOT EXISTS `cx_x_service_comment` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `AuthorId` int(11) NOT NULL,
    `ServiceId` int(11) NOT NULL,
    `PreCommentId` int(11) DEFAULT NULL,
    `Content` text NOT NULL,
    PRIMARY KEY (`Id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
  
  CREATE TABLE IF NOT EXISTS `cx_x_user` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `Username` varchar(100) NOT NULL DEFAULT '',
    `Realname` varchar(100) NOT NULL DEFAULT '',
    `Password` varchar(100) NOT NULL DEFAULT '',
    `Phone` varchar(100) NOT NULL DEFAULT '',
    `Role` varchar(100) NOT NULL DEFAULT 'user', # admin
    PRIMARY KEY (`Id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
  
  
  CREATE TABLE IF NOT EXISTS `cx_x_news` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `PublisherId` int(11) NOT NULL,
    `Title` varchar(100) NOT NULL DEFAULT '',
    `Content` text NOT NULL,
    PRIMARY KEY (`Id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
  
  
  