CREATE DATABASE IF NOT EXISTS  `shopImmoc`;
USE `shopImmoc`;
--
-- 管理员表
--
DROP TABLE IF EXISTS `imooc_admin`;
CREATE TABLE `imooc_admin` (
    `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
    `username` varchar(20) NOT NULL,
    `password` char(32) NOT NULL,
    `email` varchar(50) NOT NULL,
    PRIMARY KEY(`id`),
    UNIQUE KEY `username`
);

-- 分类
DROP TABLE IF EXISTS  `imooc_cate`;
CREATE TABLE `imooc_cate`(
    `id` smallint unsigned AUTO_INCREMENT KEY,
    `cName` varchar(50) UNIQUE
);

--商品
DROP TABLE IF EXISTS `imooc_pro`;
CREATE TABLE `imooc_pro`(
    `id` int unsigned AUTO_INCREMENT KEY,
    `pName` varchar(50) NOT NULL UNIQUE,
    `pSn` varchar(50) NOT NULL,
    `pNum` int unsigned default 1,
    `mPrice` decimal(10,2) NOT NULL,
    `iPrice` decimal(10,2) NOT NULL,
    `pDesc` text,
    `pImg` varchar(50) NOT NULL,
    `pubTime` int unsigned NOT NULL,
    `isShow` tinyint(1) default 1,
    `isHot` tinyint(1) default 0,
    `cId` smallint unsigned NOT NULL
);

-- 用户

DROP TABLE IF EXISTS `imooc_user`;
CREATE TABLE `imooc_user`(
    `id` int unsigned AUTO_INCREMENT KEY,
    `username` varchar(20) NOT NULL UNIQUE,
    `password` char(32) NOT NULL,
    `sex` enum("男","女","保密") NOT NULL default "保密",
    `face` varchar(50) NOT NULL,
    `regTime` int unsigned NOT NULL
);

--相册
DROP TABLE IF EXISTS `imooc_album`;
CREATE TABLE `imooc_album` (
    `id` int unsigned AUTO_INCREMENT key,
    `pid` int unsigned NOT NULL,
    `albumPath` varchar(50) NOT NULL
)
