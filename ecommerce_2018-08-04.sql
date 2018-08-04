# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.22)
# Database: ecommerce
# Generation Time: 2018-08-04 08:39:13 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ayar
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ayar`;

CREATE TABLE `ayar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `anahtar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deger` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `ayar` WRITE;
/*!40000 ALTER TABLE `ayar` DISABLE KEYS */;

INSERT INTO `ayar` (`id`, `anahtar`, `deger`)
VALUES
	(1,'anasayfa_slider_urun_adet','5'),
	(2,'anasayfa_liste_urun_adet','4');

/*!40000 ALTER TABLE `ayar` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table kategori
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ust_id` int(11) DEFAULT NULL,
  `kategori_adi` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `olusturma_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `guncelleme_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `silinme_tarihi` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;

INSERT INTO `kategori` (`id`, `ust_id`, `kategori_adi`, `slug`, `olusturma_tarihi`, `guncelleme_tarihi`, `silinme_tarihi`)
VALUES
	(1,NULL,'Elektronik','elektronik','2018-07-19 16:37:18','2018-07-19 16:37:18',NULL),
	(2,1,'Bilgisayar/Tablet','bilgisayar-tablet','2018-07-19 16:37:18','2018-07-19 16:37:18',NULL),
	(3,1,'Telefon','telefon','2018-07-19 16:37:18','2018-07-19 16:37:18',NULL),
	(4,1,'Tv ve Ses Sistemleri','tv-ses-sistemleri','2018-07-19 16:37:18','2018-07-19 16:37:18',NULL),
	(5,1,'Kamera','kamera','2018-07-19 16:37:18','2018-07-19 16:37:18',NULL),
	(6,NULL,'Kitap','kitap','2018-07-19 16:37:18','2018-07-19 16:37:18',NULL),
	(7,6,'Edebiyat','edebiyat','2018-07-19 16:37:18','2018-07-19 16:37:18',NULL),
	(8,6,'Çocuk','cocuk','2018-07-19 16:37:18','2018-07-19 16:37:18',NULL),
	(9,6,'Bilgisayar','bilgisayar','2018-07-19 16:37:18','2018-07-19 16:37:18',NULL),
	(10,6,'Sınavlara Hazırlık','sinavlara-hazirlik','2018-07-19 16:37:18','2018-07-19 16:37:18',NULL),
	(11,NULL,'Dergi','dergi','2018-07-19 16:37:18','2018-07-19 16:37:18',NULL),
	(12,NULL,'Mobilya','mobilya','2018-07-19 16:37:18','2018-07-19 16:37:18',NULL),
	(13,NULL,'Dekorasyon','dekorasyon','2018-07-19 16:37:18','2018-07-19 16:37:18',NULL),
	(14,NULL,'Kozmetik','kozmetik','2018-07-19 16:37:18','2018-07-19 16:37:18',NULL),
	(15,NULL,'Kişisel Bakım','kisisel-bakim','2018-07-19 16:37:18','2018-07-19 16:37:18',NULL),
	(16,NULL,'Giyim ve Moda','giyim-moda','2018-07-19 16:37:18','2018-07-19 16:37:18',NULL),
	(17,NULL,'Anne ve Çocuk','anne-cocuk','2018-07-19 16:37:18','2018-07-19 16:37:18',NULL),
	(18,1,'Elektronik Alt Kategori','elektronik-alt-kategori','2018-07-26 09:45:25','2018-07-26 12:22:10','2018-07-26 12:22:10');

/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table kategori_urun
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kategori_urun`;

CREATE TABLE `kategori_urun` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kategori_id` int(10) unsigned NOT NULL,
  `urun_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kategori_urun_kategori_id_foreign` (`kategori_id`),
  KEY `kategori_urun_urun_id_foreign` (`urun_id`),
  CONSTRAINT `kategori_urun_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE,
  CONSTRAINT `kategori_urun_urun_id_foreign` FOREIGN KEY (`urun_id`) REFERENCES `urun` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `kategori_urun` WRITE;
/*!40000 ALTER TABLE `kategori_urun` DISABLE KEYS */;

INSERT INTO `kategori_urun` (`id`, `kategori_id`, `urun_id`)
VALUES
	(1,1,1),
	(2,1,2),
	(3,1,3),
	(5,5,3),
	(6,6,3),
	(7,7,3),
	(8,1,1),
	(16,1,31),
	(17,5,31),
	(18,1,32),
	(19,3,32);

/*!40000 ALTER TABLE `kategori_urun` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table kullanici
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kullanici`;

CREATE TABLE `kullanici` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adsoyad` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sifre` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktivasyon_anahtari` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aktif_mi` tinyint(1) NOT NULL DEFAULT '0',
  `yonetici_mi` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `olusturma_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `guncelleme_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `silinme_tarihi` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kullanici_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `kullanici` WRITE;
/*!40000 ALTER TABLE `kullanici` DISABLE KEYS */;

INSERT INTO `kullanici` (`id`, `adsoyad`, `email`, `sifre`, `aktivasyon_anahtari`, `aktif_mi`, `yonetici_mi`, `remember_token`, `olusturma_tarihi`, `guncelleme_tarihi`, `silinme_tarihi`)
VALUES
	(1,'Eser TOPÇU','topcueser@gmail.com','$2y$10$wy7zJmWb6nACWUAwHbhKHeNs10BZlClHmHnoXmlB.RKb2yHglvJqC',NULL,1,1,'y6APLo0xERaUe6UofIIWT1NZ0XBB91R4o5IPYVKuvPi5VDoVpxJUDBJ5tV1Q','2018-07-25 14:16:30','2018-07-26 10:24:16',NULL),
	(2,'Toni Boyle','christop.predovic@example.com','$2y$10$X7HBQznlLr14n9Ti6C2WbeJfBN64XUthmb9yH4QYYKVC6Pf.lp4RK',NULL,1,0,NULL,'2018-07-25 14:16:30','2018-07-25 14:16:30',NULL),
	(3,'Brenda Aufderhar','toy.talia@example.net','$2y$10$aTLcRw0YPwz.CQjIAeSpOu/PkZfAamvC7QkkEkIpysxWeASrJ67bC',NULL,1,0,NULL,'2018-07-25 14:16:31','2018-07-25 14:16:31',NULL),
	(4,'Alexandrine Johnston','vida10@example.net','$2y$10$fI.KSslX0Z0K9fxMny4jNuqWhkKlLfyQSUS6TiFY0HMGI/y0O57Ny',NULL,1,0,NULL,'2018-07-25 14:16:31','2018-07-25 14:16:31',NULL),
	(5,'Prof. Leatha Witting','xconroy@example.com','$2y$10$uyaBYSvc8BVBDatXtBWk3e0XCf9.t61DvnRjyG2hpdfRbOHrLAPEe',NULL,1,0,NULL,'2018-07-25 14:16:31','2018-07-25 14:16:31',NULL),
	(6,'Jess Kozey V','clementina.purdy@example.net','$2y$10$6VPFHyqCvR6pOYlMxDdGn.sI168PKlVFFteo6kiF0MvwmrboPaFJy',NULL,1,0,NULL,'2018-07-25 14:16:31','2018-07-25 14:16:31',NULL),
	(7,'Kendra Nader','brenda.gulgowski@example.org','$2y$10$oauotWNHwhHO7l03MbFGV.p9WrehITzVJ09gq4u1YQrtnaZUOuyCK',NULL,1,0,NULL,'2018-07-25 14:16:31','2018-07-25 14:16:31',NULL),
	(8,'Raina Murazik II','sschamberger@example.com','$2y$10$5eHvHIe96QViQp99Qe/wde6P3XAvVS4T69Nf06CfLXP5GISm.QT56',NULL,1,0,NULL,'2018-07-25 14:16:31','2018-07-25 14:16:31',NULL),
	(9,'Jany Boehm','andreane.ondricka@example.net','$2y$10$jYxyLyE9ZuTm1Yvd55bZSuDxL7kLylmLMgNR0IHXaRHou7x7va26i',NULL,1,0,NULL,'2018-07-25 14:16:31','2018-07-25 14:16:31',NULL),
	(10,'Camilla Hirthe I','grady.birdie@example.org','$2y$10$58VOapiqzT7KDwEPFIZj0OPeqk3EFFtmXFsFoMc4hQsoWzqoU6j2W',NULL,1,0,NULL,'2018-07-25 14:16:31','2018-07-25 14:16:31',NULL),
	(11,'Tamara Jenkins','ewillms@example.org','$2y$10$MtKeUn8UdKpQxNz3VuLhDOoz7lEafrmgpipo7LSXtWb/RVVPww5aG',NULL,1,0,NULL,'2018-07-25 14:16:31','2018-07-25 14:16:31',NULL),
	(12,'Mr. Murl Weimann DDS','lmckenzie@example.org','$2y$10$rQ0gL/0rOI5k/miliAMUHOeE9g6RmqWIT5w9CJV0e.pxamDOpPcn2',NULL,1,0,NULL,'2018-07-25 14:16:31','2018-07-25 14:16:31',NULL),
	(13,'Doris Stroman','wstracke@example.net','$2y$10$z1TcYZgsASVdZ23C2yOdhuk4kYBv1Z8xMFBQY2Wj0IH3LxoV69bVq',NULL,1,0,NULL,'2018-07-25 14:16:31','2018-07-25 14:16:31',NULL),
	(14,'Mr. Noble Larkin','harris.lavinia@example.org','$2y$10$veRz1J9WAmGbEZ4m6Sq7xuc/VjipMeLGOa.X10aDuyiVobVSvvAT.',NULL,1,0,NULL,'2018-07-25 14:16:31','2018-07-25 14:16:31',NULL),
	(15,'Valerie Labadie','psenger@example.net','$2y$10$gS4lNeM2AuOcpJrQdw4VC.46kK9Pkj/epxh.yP1cDUwqrOABtawX.',NULL,1,0,NULL,'2018-07-25 14:16:31','2018-07-25 14:16:31',NULL),
	(16,'Dr. Damian Stoltenberg','echristiansen@example.com','$2y$10$nKmW.kBZ0TjyHrzZmW9M6uv99V1L.FlQlKXgO9ne6TgNoR483ZIt.',NULL,1,0,NULL,'2018-07-25 14:16:31','2018-07-25 14:16:31',NULL),
	(17,'Weston Toy','collier.audreanne@example.org','$2y$10$NNT5LIWWwlbMuK30aWktXuMTqHgCmk0yT5cea5UjZN0THaw84krZ.',NULL,1,0,NULL,'2018-07-25 14:16:31','2018-07-25 14:16:31',NULL),
	(18,'Miss Emilie D\'Amore','rau.trevor@example.org','$2y$10$oKeBYotjgpXsvObGPremwey4JWPVRr2OPJFRIjMLUwSXOVVpygpA6',NULL,1,0,NULL,'2018-07-25 14:16:31','2018-07-25 14:16:31',NULL),
	(19,'Domenick Schuppe','marco77@example.net','$2y$10$w1f7P9u6/GPJflfZwkzSwO.b7Kc21FqnEaWm8WBJEADZZ2GNYSkbm',NULL,1,0,NULL,'2018-07-25 14:16:32','2018-07-25 14:16:32',NULL),
	(20,'Destiney Stamm','enrico93@example.org','$2y$10$KLnyuu8RoU8.uOs9kqj9DOCCed.cLE4Sg7CqMUvVuS5uJlrBN6vdq',NULL,1,0,NULL,'2018-07-25 14:16:32','2018-07-25 14:16:32',NULL),
	(21,'Dulce O\'Hara PhD','arunolfsson@example.org','$2y$10$Myw/GlQtqv32G2XX0bTZEOw4r/xfg5kaBEQ9btz.P0Ugv4gPX5IW2',NULL,1,0,NULL,'2018-07-25 14:16:32','2018-07-25 14:16:32',NULL),
	(22,'Kaela Robel','ewell06@example.org','$2y$10$cjIH8GdDl97PfoS/59Fs9uruD39Kf60h/PHk7ukY80S8iZoBn608e',NULL,1,0,NULL,'2018-07-25 14:16:32','2018-07-25 14:16:32',NULL),
	(23,'Ibrahim Gorczany','padams@example.com','$2y$10$0HWdxS0/bNjGWCKgW8gwe.sAeUXxWUGVur9LddSvIGPVcK/1dCW2a',NULL,1,0,NULL,'2018-07-25 14:16:32','2018-07-25 14:16:32',NULL),
	(24,'Suzanne Koch IV','dstark@example.net','$2y$10$DVRjVLK6Ix7SKh3umxXi2.zty.9vz1nlWZ78RR9w2TaqogI22fBWS',NULL,1,0,NULL,'2018-07-25 14:16:32','2018-07-25 14:16:32',NULL),
	(25,'Scarlett Kreiger','davis.lenna@example.org','$2y$10$miD4D/LNA..aenmtcecpSuShmsoe2zw1DmWyD5io0yFshLsndQ1Aa',NULL,1,0,NULL,'2018-07-25 14:16:32','2018-07-25 14:16:32',NULL),
	(26,'Prof. Meghan Schaden','zella.beahan@example.org','$2y$10$5996CtmlRpn7wEHPIIkwseLlzEuiX3BX2B9EBMmtPfUTccKkCdNZK',NULL,1,0,NULL,'2018-07-25 14:16:32','2018-07-25 14:16:32',NULL),
	(27,'Hadley Sanford II','wnitzsche@example.org','$2y$10$ndKAJe7Lu7NwnGAzPPhAk.Pnn2rRPrczbArIAmeU6MY9pcIzX/oTe',NULL,1,0,NULL,'2018-07-25 14:16:32','2018-07-25 14:16:32',NULL),
	(28,'Geraldine Hane Jr.','poberbrunner@example.net','$2y$10$Nb8fyRyQCre30sfcU962b.D6FGSPXNMyEHAuhu94wqIiH92m8ajYa',NULL,1,0,NULL,'2018-07-25 14:16:32','2018-07-25 14:16:32',NULL),
	(29,'Keshawn Christiansen','finn.okon@example.org','$2y$10$1drsag8kXadaBftMljc7Ee7qbmtsEIZk9Vb93qXSWD/cK5tKSimh.',NULL,1,0,NULL,'2018-07-25 14:16:32','2018-07-25 14:16:32',NULL),
	(30,'Mr. Lorenz Collier DVM','fdeckow@example.net','$2y$10$XvNAUxfpcMq4JNHniuhEH.zWjwQHLGT.p76v.GBDeBjpYd5.SNhae',NULL,1,0,NULL,'2018-07-25 14:16:32','2018-07-25 14:16:32',NULL),
	(31,'Mercedes O\'Conner','rasheed48@example.org','$2y$10$.1cqPZZhAWWV1eCNm3iRgu2db3mUas3/WqVA4EgvKdxhYZRJBBUPS',NULL,1,0,NULL,'2018-07-25 14:16:32','2018-07-25 14:16:32',NULL),
	(32,'Ms. Kianna O\'Keefe MD','kub.elwyn@example.com','$2y$10$/NBoAiHQyo2YdoD47rh2SOMFk67.kBiS6G0SfuiTJ9dXYOeA4Manu',NULL,1,0,NULL,'2018-07-25 14:16:32','2018-07-25 14:16:32',NULL),
	(33,'Titus Keeling DDS','linnie.botsford@example.net','$2y$10$qDmQOz04VvT4eSNeb67rheHCSx4QBNSW8CMdTvZnneUGM48.ZrNPW',NULL,1,0,NULL,'2018-07-25 14:16:33','2018-07-25 14:16:33',NULL),
	(34,'Penelope Stark','dickinson.gertrude@example.net','$2y$10$M.oWq2fzNGuMq7gpM8kWpe8msRKydRXbDjybhf9MCRyHRcOtaBTH2',NULL,1,0,NULL,'2018-07-25 14:16:33','2018-07-25 14:16:33',NULL),
	(35,'Shane Erdman','tomasa19@example.org','$2y$10$1Jq3CMMKfWCDYZIVj5lKo.WMvdfMyD7tQ43q/XxGxhFQ/lghSma4.',NULL,1,0,NULL,'2018-07-25 14:16:33','2018-07-25 14:16:33',NULL),
	(36,'Annie Okuneva','jenifer84@example.org','$2y$10$IWmYGolUq0Sk/Ncl2mXIg.oUfOJtSGJgSeC47pKzIi3QR2M256c/O',NULL,1,0,NULL,'2018-07-25 14:16:33','2018-07-25 14:16:33',NULL),
	(37,'Betty White','gleichner.imani@example.org','$2y$10$mfAZcwUp9YVBCaRSXF/07.6H8dPR3J0GaZ5g/TDKIlXyxHFpkBAVS',NULL,1,0,NULL,'2018-07-25 14:16:33','2018-07-25 14:16:33',NULL),
	(38,'Justen Boyle','ostreich@example.net','$2y$10$tzV95.T0sq0H1tlDZKEgm.L2WrL7jKEWFfqGRdeSpy47AnxkjTXrO',NULL,1,0,NULL,'2018-07-25 14:16:33','2018-07-25 14:16:33',NULL),
	(39,'Selena Trantow','nella.zemlak@example.org','$2y$10$I94kRq520M0wm8I.DhjfKe3V8hG11Ib6AAV3UOK2F4QQFeJIiXvUm',NULL,1,0,NULL,'2018-07-25 14:16:33','2018-07-25 14:16:33',NULL),
	(40,'Dr. Scot Halvorson IV','dominique.yost@example.org','$2y$10$VpkfHHraaV1vObufEA/sKenotqMjeNWbZ1pUUxv9WG.cla296JG7G',NULL,1,0,NULL,'2018-07-25 14:16:33','2018-07-25 14:16:33',NULL),
	(41,'Prof. Isom Lueilwitz MD','michale.wolf@example.net','$2y$10$pgODPjxhkbh514mREWaWgOj4O2cFN67zutgxX8o.J6X2DwvqoHIu.',NULL,1,0,NULL,'2018-07-25 14:16:33','2018-07-25 14:16:33',NULL),
	(42,'Prof. Evie Hansen','cecelia21@example.org','$2y$10$2oroaLEta4jXR23KoypHT.o0qEIF3WhAry9FqMI5Yoz5nDDKhheXe',NULL,1,0,NULL,'2018-07-25 14:16:33','2018-07-25 14:16:33',NULL),
	(43,'Florida Kovacek','watson13@example.org','$2y$10$0avIRuhLkm5XI/0s41w0ae4gXaLoWGEI5i5F1DBmiDCuACF6I9AE2',NULL,1,0,NULL,'2018-07-25 14:16:33','2018-07-25 14:16:33',NULL),
	(44,'Denis Pacocha','lindgren.nathanael@example.net','$2y$10$S0Zx.qE95KPwWg0bexh1yObue2nLID3MkRXukSAvnahO4Ydp9ejjW',NULL,1,0,NULL,'2018-07-25 14:16:33','2018-07-25 14:16:33',NULL),
	(45,'Adolf Jones PhD','willard.swaniawski@example.com','$2y$10$A5ip7P0hLnKORJ0a/v7Y7ecI0rMu3dHITGR9pzmmM2y/kq5.MRSkm',NULL,1,0,NULL,'2018-07-25 14:16:33','2018-07-25 14:16:33',NULL),
	(46,'Milan Mayer','dietrich.clarissa@example.org','$2y$10$AgCi126W/mmW/aJuaRo20.mavIWq7PrDZhcCBETvXZcLDoqkArtS6',NULL,1,0,NULL,'2018-07-25 14:16:33','2018-07-25 14:16:33',NULL),
	(47,'Kamren Hayes','skye51@example.com','$2y$10$eFJxS.gmUhkMgtPQT1qPrOywdVdkApo7UtVedl/oIFv3K9YUoD7zu',NULL,1,0,NULL,'2018-07-25 14:16:33','2018-07-25 14:16:33',NULL),
	(48,'Hayden Hills Jr.','willis25@example.net','$2y$10$ras7JAW28NAdrlefXM5/fOikUqPIHjavdmZ7CK2AhsylK4MHDz4xC',NULL,1,0,NULL,'2018-07-25 14:16:33','2018-07-25 14:16:33',NULL),
	(49,'Prof. Sage Ryan','cormier.ayla@example.com','$2y$10$tFbDoe.VPlUJGRQ3uAmVDuuPNUfcaU2Hv4BcpqkRXIkgmPKY2UF3y',NULL,1,0,NULL,'2018-07-25 14:16:34','2018-07-25 14:16:34',NULL),
	(50,'Dr. Madeline Weissnat Jr.','ysporer@example.com','$2y$10$WjWq3WAE.65b3jt2JNy7dOE99TViWHCjErI87oD9vb8.x4/dzmGBa',NULL,1,0,NULL,'2018-07-25 14:16:34','2018-07-25 14:16:34',NULL),
	(51,'Ilene Kilback IV','kokeefe@example.org','$2y$10$R.EKvJnOALDJD7xL/IYE8emCyucdPlZ9szawsxh/TqH/uZn5EW3wa',NULL,1,0,NULL,'2018-07-25 14:16:34','2018-07-25 14:16:34',NULL);

/*!40000 ALTER TABLE `kullanici` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table kullanici_detay
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kullanici_detay`;

CREATE TABLE `kullanici_detay` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kullanici_id` int(10) unsigned NOT NULL,
  `adres` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefon` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ceptelefonu` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kullanici_detay_kullanici_id_foreign` (`kullanici_id`),
  CONSTRAINT `kullanici_detay_kullanici_id_foreign` FOREIGN KEY (`kullanici_id`) REFERENCES `kullanici` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `kullanici_detay` WRITE;
/*!40000 ALTER TABLE `kullanici_detay` DISABLE KEYS */;

INSERT INTO `kullanici_detay` (`id`, `kullanici_id`, `adres`, `telefon`, `ceptelefonu`)
VALUES
	(1,1,'Çanakkale','(312) 111 11 11','(555) 444 33 22'),
	(2,2,'66672 Gaylord Stream\nNew Meaghan, NC 98354','+4198976185979','+5949637884878'),
	(3,3,'359 Janelle Freeway Apt. 660\nMichealshire, CO 44224','+7635058324510','+2072088805358'),
	(4,4,'44418 Denesik Viaduct\nNew Jaunitachester, AL 95992','+2071172581370','+8697597982456'),
	(5,5,'4421 Hunter Roads Suite 285\nNew Aileenville, MI 92258-5536','+9335193007466','+2056082332545'),
	(6,6,'354 Billy Fort\nSchowalterside, NC 31022-7834','+3766178241360','+1726837245855'),
	(7,7,'382 Jessie Prairie\nBoganmouth, ME 61555-1530','+4563493754782','+9911374520201'),
	(8,8,'676 Watsica Prairie\nWest Jacinthe, NJ 05531-5616','+4279892665068','+9586278255262'),
	(9,9,'9159 Hessel Alley Suite 971\nElizabethmouth, WI 90750-1488','+1843198385822','+1027155447692'),
	(10,10,'940 Labadie Mission Suite 419\nCummerataton, MA 69370-9789','+2113198043381','+9488138856216'),
	(11,11,'4709 Heller Fields\nMillerburgh, NE 48641-0595','+1439108966210','+1848896588542'),
	(12,12,'63803 Chaim Ports Apt. 167\nSouth Muhammad, TN 13972','+1719624545083','+3764052777679'),
	(13,13,'8075 Schimmel Fort Apt. 686\nPort Nigel, NV 86629-4569','+5051461238804','+6649885719525'),
	(14,14,'400 Anderson Lock Suite 453\nPort Adolf, SC 84663','+2884255129041','+3866233182744'),
	(15,15,'570 Powlowski Summit Apt. 782\nEulaliaberg, ME 61335-0222','+7342501465605','+8102373712981'),
	(16,16,'5584 Brandi Locks\nDouglasberg, WA 59539-9621','+6459900757683','+9240536111508'),
	(17,17,'92484 Bins Meadow Suite 560\nClintside, SD 62607','+5952238242383','+5021028429895'),
	(18,18,'60686 Vada Tunnel Suite 189\nEast Miguel, IL 65236','+1409396429488','+5976928143980'),
	(19,19,'53395 Chloe Cove Suite 069\nMarquiseport, GA 41605','+5282372478790','+4862189881793'),
	(20,20,'4221 Beer Trafficway Suite 581\nCarrollmouth, KS 44212','+9986268924545','+7544408017125'),
	(21,21,'4784 Gina Prairie Apt. 109\nKaitlintown, WA 41307-1326','+2013337127335','+6657450406581'),
	(22,22,'7934 Dariana Lodge\nPort Sandra, RI 21705','+7844323075522','+9953488606856'),
	(23,23,'72768 Kassulke Ford Suite 755\nJustinachester, OK 67234','+9963249320353','+4819814204721'),
	(24,24,'6344 Metz River Apt. 907\nMeggieborough, RI 44364-9986','+5546595272367','+9055399860985'),
	(25,25,'718 Orville Locks\nHickleberg, IN 73032','+4433167323461','+7990669944723'),
	(26,26,'8331 Baron Avenue Suite 248\nRomaguerabury, ID 30700','+1392098160656','+5084828349621'),
	(27,27,'2038 Parisian Hills\nHaagton, VA 70144','+2252349848818','+7820645598242'),
	(28,28,'847 Noble Isle Apt. 553\nNorth Dane, IN 53185','+7537319128477','+1443925765650'),
	(29,29,'589 Alvera Locks Suite 062\nWest Emmet, HI 20543-8099','+4771363768224','+7052636778659'),
	(30,30,'51302 Weston Trail\nAdelestad, SD 18181','+4500939635772','+6942706997085'),
	(31,31,'1565 Eleazar Street\nWilliamsonstad, TN 03272','+8203407402992','+9667159574051'),
	(32,32,'1132 Johns Road Apt. 291\nPort Jamison, IL 81518','+7632889928693','+1903444447268'),
	(33,33,'8097 Gerda Drive\nPort Erick, IA 87713','+3813620742909','+6021206300524'),
	(34,34,'592 Flo Walks\nBlandashire, NJ 63114-5091','+9246117068572','+3885632153307'),
	(35,35,'1875 Jaquelin Terrace\nAhmadmouth, WV 79907-8942','+4959608288514','+3497942716657'),
	(36,36,'8159 Priscilla Vista\nKyliechester, MA 45984','+7012190744714','+9381644281310'),
	(37,37,'6238 Mayer Trafficway\nNew Claude, MN 98958-6559','+9712474489580','+8648515578126'),
	(38,38,'69115 Alexis Rue\nWest Deionmouth, HI 38831','+4135352120801','+1903450470305'),
	(39,39,'35599 Dietrich Keys\nWest Judahborough, IA 27902-1862','+6223233222067','+3794111125317'),
	(40,40,'92362 Renee Village\nSouth Maggieville, ME 91815-3203','+4586584097050','+2560999813775'),
	(41,41,'4335 Grimes Terrace Apt. 034\nZitafort, ND 53005-3858','+3346322849720','+2791988632642'),
	(42,42,'92060 Konopelski Pine Apt. 124\nEloymouth, CA 79055-5000','+7873357877649','+5035149292195'),
	(43,43,'6314 Dach Road\nEast Gillianside, ND 59944-1405','+9162395899511','+9701820564196'),
	(44,44,'9609 Brakus Crossing Suite 999\nEast Zelma, ME 72762-0375','+8048674613250','+1475803186041'),
	(45,45,'4052 Vince Light\nRaymundoshire, ME 71920-6883','+7515812925187','+1640440977532'),
	(46,46,'36849 Layla Course\nNorth Estevanport, NY 55499-7978','+1450846771884','+2094035537615'),
	(47,47,'934 Dicki Corners\nSouth Kavonborough, LA 01724-6242','+7627733662091','+2739357813977'),
	(48,48,'3891 Kelton Turnpike\nEast Marjoriechester, NM 59406-7248','+2925831504707','+6625952427233'),
	(49,49,'658 Marvin Forks\nLake Lisandrochester, GA 82156','+5707979484827','+2988164678376'),
	(50,50,'165 Heathcote Lodge\nHermannchester, MD 90232-6168','+7463558165883','+9320135103401'),
	(51,51,'7499 Frami Dam Apt. 433\nPort Armand, HI 10753','+3189947828650','+2031806630778');

/*!40000 ALTER TABLE `kullanici_detay` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(2,'2018_07_19_122048_create_kategori_table',1),
	(3,'2018_07_19_134929_create_urun_table',2),
	(4,'2018_07_19_140706_create_kategori_urun_table',3),
	(5,'2018_07_20_064037_create_urun_detay_table',4),
	(8,'2018_07_20_215325_create_kullanici_table',5),
	(9,'2018_07_21_115411_create_sepet_table',6),
	(11,'2018_07_21_115814_create_sepet_urun_table',7),
	(16,'2018_07_21_195536_create_siparis_table',8),
	(17,'2018_07_22_184220_create_kullanici_detay_table',8),
	(18,'2018_08_04_074933_create_ayar_table',9);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sepet
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sepet`;

CREATE TABLE `sepet` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kullanici_id` int(10) unsigned NOT NULL,
  `olusturma_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `guncelleme_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `silinme_tarihi` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sepet_kullanici_id_foreign` (`kullanici_id`),
  CONSTRAINT `sepet_kullanici_id_foreign` FOREIGN KEY (`kullanici_id`) REFERENCES `kullanici` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `sepet` WRITE;
/*!40000 ALTER TABLE `sepet` DISABLE KEYS */;

INSERT INTO `sepet` (`id`, `kullanici_id`, `olusturma_tarihi`, `guncelleme_tarihi`, `silinme_tarihi`)
VALUES
	(4,1,'2018-07-21 19:51:42','2018-07-21 19:51:42',NULL),
	(5,1,'2018-07-24 12:55:01','2018-07-24 12:55:01',NULL),
	(6,1,'2018-07-25 09:34:15','2018-07-25 09:34:15',NULL),
	(7,1,'2018-07-26 07:22:22','2018-07-26 07:22:22',NULL),
	(8,1,'2018-08-03 12:21:40','2018-08-03 12:21:40',NULL);

/*!40000 ALTER TABLE `sepet` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sepet_urun
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sepet_urun`;

CREATE TABLE `sepet_urun` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sepet_id` int(10) unsigned NOT NULL,
  `urun_id` int(10) unsigned NOT NULL,
  `adet` int(11) NOT NULL,
  `fiyati` decimal(5,2) NOT NULL,
  `durum` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `olusturma_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `guncelleme_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `silinme_tarihi` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sepet_urun_sepet_id_foreign` (`sepet_id`),
  KEY `sepet_urun_urun_id_foreign` (`urun_id`),
  CONSTRAINT `sepet_urun_sepet_id_foreign` FOREIGN KEY (`sepet_id`) REFERENCES `sepet` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sepet_urun_urun_id_foreign` FOREIGN KEY (`urun_id`) REFERENCES `urun` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `sepet_urun` WRITE;
/*!40000 ALTER TABLE `sepet_urun` DISABLE KEYS */;

INSERT INTO `sepet_urun` (`id`, `sepet_id`, `urun_id`, `adet`, `fiyati`, `durum`, `olusturma_tarihi`, `guncelleme_tarihi`, `silinme_tarihi`)
VALUES
	(11,4,2,2,8.12,'Beklemede','2018-07-24 12:26:29','2018-07-24 12:26:35',NULL),
	(12,4,8,2,3.80,'Beklemede','2018-07-24 12:26:34','2018-07-24 12:26:36',NULL),
	(13,5,8,1,3.80,'Beklemede','2018-07-24 12:55:05','2018-07-24 12:55:05',NULL),
	(14,7,1,1,11.98,'Beklemede','2018-07-26 07:22:22','2018-07-26 07:22:36','2018-07-26 07:22:36'),
	(15,7,5,1,13.53,'Beklemede','2018-07-26 07:22:33','2018-07-26 07:22:36','2018-07-26 07:22:36');

/*!40000 ALTER TABLE `sepet_urun` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table siparis
# ------------------------------------------------------------

DROP TABLE IF EXISTS `siparis`;

CREATE TABLE `siparis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sepet_id` int(10) unsigned NOT NULL,
  `siparis_tutari` decimal(10,4) NOT NULL,
  `durum` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adsoyad` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adres` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefon` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ceptelefonu` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banka` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taksit_sayisi` int(11) DEFAULT NULL,
  `olusturma_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `guncelleme_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `silinme_tarihi` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `siparis_sepet_id_unique` (`sepet_id`),
  CONSTRAINT `siparis_sepet_id_foreign` FOREIGN KEY (`sepet_id`) REFERENCES `sepet` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `siparis` WRITE;
/*!40000 ALTER TABLE `siparis` DISABLE KEYS */;

INSERT INTO `siparis` (`id`, `sepet_id`, `siparis_tutari`, `durum`, `adsoyad`, `adres`, `telefon`, `ceptelefonu`, `banka`, `taksit_sayisi`, `olusturma_tarihi`, `guncelleme_tarihi`, `silinme_tarihi`)
VALUES
	(1,4,23.8400,'Siparişiniz alındı','Eser TOPÇU','Çanakkale','(546) 208-81-24','(546) 208-81-24','Garanti',1,'2018-07-24 12:43:09','2018-07-24 15:43:55',NULL),
	(2,5,3.8000,'Ödeme onaylandı','Eser TOPÇU','Çanakkale','(546) 208-81-24','(546) 208-81-24','Garanti',1,'2018-07-24 12:55:18','2018-08-03 12:27:06',NULL);

/*!40000 ALTER TABLE `siparis` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table urun
# ------------------------------------------------------------

DROP TABLE IF EXISTS `urun`;

CREATE TABLE `urun` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urun_adi` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aciklama` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fiyati` decimal(10,3) NOT NULL,
  `olusturma_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `guncelleme_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `silinme_tarihi` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `urun` WRITE;
/*!40000 ALTER TABLE `urun` DISABLE KEYS */;

INSERT INTO `urun` (`id`, `slug`, `urun_adi`, `aciklama`, `fiyati`, `olusturma_tarihi`, `guncelleme_tarihi`, `silinme_tarihi`)
VALUES
	(1,'ut-rerum','Ut rerum.','Totam qui qui id sequi odio enim eveniet possimus assumenda laboriosam est blanditiis aut.',11.978,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(2,'quae-adipisci','Quae adipisci.','Atque assumenda velit veniam quas ex nulla eligendi molestiae atque ducimus aut quae in voluptatum ut explicabo sunt modi.',8.118,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(3,'rerum-laudantium-quis','Rerum laudantium quis.','Non quia minus aliquam cupiditate velit natus voluptatem corrupti est accusamus cumque aut reprehenderit at consequatur aliquam dignissimos qui quae.',7.056,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(4,'facere-fugit','Facere fugit.','Et maxime saepe nulla possimus voluptas nulla aspernatur sapiente consequatur quia quis quasi minima qui quidem laboriosam eum non aut.',8.542,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(5,'tempora-a','Tempora a.','Dolorem recusandae est tenetur aut itaque est velit doloremque quia quae dolor suscipit.',13.529,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(6,'adipisci-commodi','Adipisci commodi.','Quis ad voluptatum rem ratione vel in qui voluptas voluptatibus voluptas et earum cupiditate et in ex hic porro excepturi vel vitae laudantium voluptatem et laboriosam consequatur recusandae.',1.696,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(7,'enim-minus-accusamus','Enim minus accusamus.','Porro doloribus totam sit veniam quod hic inventore molestiae architecto ut sint doloremque omnis assumenda inventore ratione ab illum vel ad placeat ex tenetur excepturi.',3.770,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(8,'et-voluptas','Et voluptas.','Magnam qui qui non assumenda reiciendis dolorem amet mollitia recusandae ipsum ullam accusantium labore blanditiis est sit fugiat temporibus repellat maiores et minima et aperiam.',3.800,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(9,'aspernatur-assumenda-perspiciatis','Aspernatur assumenda perspiciatis.','Dicta corrupti dolores nobis nam explicabo numquam illum eum voluptas qui cupiditate doloremque magnam in quo nulla sint quia delectus animi enim sapiente voluptatem rerum officia dolorem sed.',19.799,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(10,'et-dolor-quos','Et dolor quos.','Nesciunt ratione aut necessitatibus qui et officiis necessitatibus impedit reiciendis doloremque quidem tempore assumenda dolorum maxime rerum exercitationem neque debitis laudantium minima recusandae aut quis accusamus sit ducimus.',13.211,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(11,'nulla-quia-animi','Nulla quia animi.','Illum molestiae magni cupiditate iure eum eos quia iste quae voluptatum et mollitia ea ut.',2.071,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(12,'eveniet-iusto','Eveniet iusto.','Ut quia earum labore veritatis incidunt dolores accusamus animi quidem corporis et itaque deleniti pariatur corrupti ut voluptas.',9.212,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(13,'quo-voluptatibus-pariatur','Quo voluptatibus pariatur.','Aut sapiente impedit molestias laudantium aut sunt ea ipsam vel temporibus qui molestiae et id expedita tempore aut at libero veniam laboriosam.',2.119,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(14,'praesentium-corrupti','Praesentium corrupti.','Omnis quod saepe exercitationem et est adipisci blanditiis ut dolores fugiat perferendis quam quas voluptas repudiandae eum placeat iste sed inventore aut aut ratione exercitationem aperiam esse voluptatem.',19.662,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(15,'iure-qui-eum','Iure qui eum.','Vel accusamus dignissimos corporis inventore qui fuga commodi animi et molestiae aspernatur rem aut aut fuga est enim illum aut earum est nihil veritatis explicabo.',14.220,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(16,'et-fuga','Et fuga.','Qui iste temporibus eveniet rerum deleniti eligendi odio quidem repellat sed pariatur voluptate ut.',12.743,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(17,'culpa-sequi','Culpa sequi.','Quasi esse quibusdam pariatur rerum quia ex distinctio culpa est natus animi rem quod laudantium ut doloribus velit illum dolorem doloribus repellat cum.',2.360,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(18,'reprehenderit-explicabo-optio','Reprehenderit explicabo optio.','Enim debitis omnis mollitia quo facere libero facilis ut nostrum deleniti placeat qui dolor nemo libero in id et dolores quidem minus eaque velit vitae nostrum libero.',9.669,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(19,'sint-aut','Sint aut.','Officiis vel quis soluta ut nobis sunt consectetur labore alias nulla quo minima consequatur excepturi sapiente recusandae iusto alias vitae quia excepturi minus veniam quo laborum a.',16.371,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(20,'et-hic-excepturi','Et hic excepturi.','Doloremque aspernatur accusamus quasi voluptas eum et tempore debitis deserunt perferendis tempore repudiandae qui ad corrupti sit labore sit occaecati cupiditate non pariatur cupiditate et quo.',7.999,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(21,'inventore-sit-eius','Inventore sit eius.','Fuga ut molestiae consequatur et sunt est consequuntur fugit dolorum quos perspiciatis animi iusto iste dolorem nobis quia voluptates.',17.081,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(22,'laborum-quaerat','Laborum quaerat.','Molestias deserunt iusto eum excepturi nemo explicabo repudiandae excepturi voluptatibus nemo saepe ab saepe voluptatem quia est excepturi incidunt fugit tempora quam.',8.587,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(23,'temporibus-eum-quo','Temporibus eum quo.','Dolore pariatur aperiam quo ullam illo necessitatibus explicabo id neque earum dolores corrupti sed et asperiores.',3.849,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(24,'quis-sunt-ea','Quis sunt ea.','Impedit voluptas et perspiciatis quo eum atque ut sint sint delectus minima vel omnis adipisci est assumenda odio ut in ut eveniet excepturi exercitationem.',6.058,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(25,'in-a-aperiam','In a aperiam.','Et et alias aut perferendis quia molestiae itaque perspiciatis doloribus sequi rerum repellendus dolorem in.',3.356,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(26,'illo-excepturi','Illo excepturi.','Ratione minima doloremque sed dolorem et aut quia doloremque itaque quia sed enim eos id aliquam id dolores qui qui enim assumenda est dolores velit ea et.',2.743,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(27,'aperiam-ut','Aperiam ut.','Sit dolore rerum earum quae ut quia ex aut corrupti est veritatis nobis error nihil aperiam iste omnis aut omnis et.',16.468,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(28,'qui-non','Qui non.','Porro facere iure nobis quam at eum id voluptate magnam rem vel eius voluptatem nihil et molestiae sit iste quia aut eaque autem doloribus sit qui delectus.',15.538,'2018-07-20 07:00:52','2018-07-31 08:54:20',NULL),
	(29,'cum-aperiam-vel','Cum aperiam vel.','Qui inventore itaque qui repellendus sint exercitationem voluptatem sed architecto aliquid et eum facere culpa sint magni aspernatur omnis.',4.419,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(30,'voluptas-eum-quibusdam','Voluptas eum quibusdam.','Doloremque expedita id aut velit corrupti maxime possimus aperiam iste voluptatem soluta aspernatur aut veniam excepturi totam eos odit fugit.',7.494,'2018-07-20 07:00:52','2018-07-20 07:00:52',NULL),
	(31,'canon-eos-650d-fotograf-makinasi','Canon 650d Fotoğraf Makinası','Ürün açıklaması',2300.000,'2018-07-31 09:08:05','2018-08-04 11:10:07',NULL),
	(32,'samsung-s7-edge-cep-telefonu','Samsung S7 Edge Cep Telefonu','Samsung S7 Edge Cep Telefonu',2890.990,'2018-08-01 07:58:07','2018-08-01 07:58:07',NULL);

/*!40000 ALTER TABLE `urun` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table urun_detay
# ------------------------------------------------------------

DROP TABLE IF EXISTS `urun_detay`;

CREATE TABLE `urun_detay` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `urun_id` int(10) unsigned NOT NULL,
  `goster_slider` tinyint(1) NOT NULL DEFAULT '0',
  `goster_gunun_firsati` tinyint(1) NOT NULL DEFAULT '0',
  `goster_one_cikan` tinyint(1) NOT NULL DEFAULT '0',
  `goster_cok_satan` tinyint(1) NOT NULL DEFAULT '0',
  `goster_indirimli` tinyint(1) NOT NULL DEFAULT '0',
  `urun_resmi` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `urun_detay_urun_id_unique` (`urun_id`),
  CONSTRAINT `urun_detay_urun_id_foreign` FOREIGN KEY (`urun_id`) REFERENCES `urun` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `urun_detay` WRITE;
/*!40000 ALTER TABLE `urun_detay` DISABLE KEYS */;

INSERT INTO `urun_detay` (`id`, `urun_id`, `goster_slider`, `goster_gunun_firsati`, `goster_one_cikan`, `goster_cok_satan`, `goster_indirimli`, `urun_resmi`)
VALUES
	(1,1,1,0,1,1,1,NULL),
	(2,2,1,1,1,0,0,NULL),
	(3,3,1,0,1,0,1,NULL),
	(4,4,1,0,1,0,0,NULL),
	(5,5,1,1,1,0,1,NULL),
	(6,6,1,0,1,1,1,NULL),
	(7,7,1,1,1,0,1,NULL),
	(8,8,0,1,0,1,1,NULL),
	(9,9,1,0,0,0,1,NULL),
	(10,10,1,0,0,1,1,NULL),
	(11,11,0,1,1,1,0,NULL),
	(12,12,1,0,1,0,1,NULL),
	(13,13,1,1,0,1,1,NULL),
	(14,14,0,1,0,1,0,NULL),
	(15,15,0,0,0,0,1,NULL),
	(16,16,0,1,0,0,1,NULL),
	(17,17,0,1,1,1,0,NULL),
	(18,18,0,1,0,0,0,NULL),
	(19,19,0,0,1,1,1,NULL),
	(20,20,1,1,1,0,0,NULL),
	(21,21,1,0,0,1,1,NULL),
	(22,22,0,1,0,1,1,NULL),
	(23,23,0,0,0,0,1,NULL),
	(24,24,1,1,0,0,0,NULL),
	(25,25,0,1,0,1,1,NULL),
	(26,26,0,1,1,1,0,NULL),
	(27,27,1,1,1,1,1,NULL),
	(28,28,0,0,0,0,0,NULL),
	(29,29,1,1,1,0,1,NULL),
	(30,30,0,0,0,0,1,NULL),
	(31,31,1,0,1,0,0,'31_1533134077.png'),
	(32,32,0,1,0,0,0,'32_1533134221.jpeg');

/*!40000 ALTER TABLE `urun_detay` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
