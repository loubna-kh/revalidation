<!--

STATISTICS 

CREATE TABLE `statistic` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
    `DateT` date  NOT NULL,
    `Pnr` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    `NPax` int(11) NOT NULL,
    `Rrevalidate` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
    `Comment` varchar(25) NOT NULL,
    `TypeT` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
    `Qe16` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
    `EMD` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
     PRIMARY KEY(`Id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


USER ADMIN

CREATE TABLE `adminLog` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `pseudo` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
    `password` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
     PRIMARY KEY(`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

  
USER Superviseur

CREATE TABLE `suplog` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `pseudo` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
    `password` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
     PRIMARY KEY(`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `controll` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `nagentT` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
    `DateT` date  NOT NULL,
    `pnr` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    `nagentC` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
    `OptionT` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
    `DateC` date  NOT NULL,
     PRIMARY KEY(`Id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

?>