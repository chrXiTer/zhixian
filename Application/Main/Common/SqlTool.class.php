<?php
$sql = array(
  $sqlCreateTable_affair => "CREATE TABLE IF NOT EXISTS `cx_x_affair` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `ParentId` int(11) NOT NULL DEFAULT '0',
    `Name` varchar(100) NOT NULL,
    `Description` text,
    `HotValue` int(11) NOT NULL DEFAULT '1',
    `Status` varchar(100) NOT NULL DEFAULT '使用中',
    PRIMARY KEY (`Id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",
  
  $sqlCreateTable_affairComment => "CREATE TABLE IF NOT EXISTS `cx_x_affair_comment` (
    `Id` int(11) NOT NULL,
    `AuthorId` int(11) NOT NULL,
    `AffairId` int(11) NOT NULL,
    `PreCommentId` int(11) NOT NULL,
    `Content` text NOT NULL,
    PRIMARY KEY (`Id`)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8;",
  
  $sqlCreateTable_affairServiceType => "CREATE TABLE IF NOT EXISTS `cx_x_affair_service_type` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `AffairId` int(11) NOT NULL,
    `ServiceTypeId` int(11) NOT NULL,
    `Description` text NOT NULL,
    PRIMARY KEY (`Id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",

  $sqlCreateTable_baike =>"CREATE TABLE IF NOT EXISTS `cx_x_baike` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(50) NOT NULL,
    `content` text NOT NULL,
    `type` varchar(50) NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",
  
  $sqlCreateTable_need =>"CREATE TABLE IF NOT EXISTS `cx_x_need` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `Title` varchar(50) NOT NULL,
    `Introduction` varchar(200) NOT NULL,
    `Contacts` varchar(50) NOT NULL,
    `Phone` varchar(20) NOT NULL,
    `PublisherId` int(11) NOT NULL,
    PRIMARY KEY (`Id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",
  
  $sqlCreateTable_needComment =>"CREATE TABLE IF NOT EXISTS `cx_x_need_comment` (
    `Id` int(11) NOT NULL,
    `AuthorId` int(11) NOT NULL,
    `NeedId` int(11) NOT NULL,
    `PreCommentId` int(11) NOT NULL,
    `Content` text NOT NULL,
    PRIMARY KEY (`Id`)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8;",
  
  $sqlCreateTable_service =>"CREATE TABLE IF NOT EXISTS `cx_x_service` (
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
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",
  
  $sqlCreateTable_serviceComment =>"CREATE TABLE IF NOT EXISTS `cx_x_service_comment` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `AuthorId` int(11) NOT NULL,
    `ServiceId` int(11) NOT NULL,
    `PreCommentId` int(11) DEFAULT NULL,
    `Content` text NOT NULL,
    PRIMARY KEY (`Id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",
)


?>