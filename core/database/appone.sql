-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `banks`;
CREATE TABLE `banks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '1=Active;0=Inactive',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `banks` (`id`, `name`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1,	'BCA',	'This is description',	1,	NULL,	'2017-04-05 01:35:10',	NULL),
(2,	'Mandiri',	'This is description',	1,	NULL,	'2017-04-05 01:35:26',	NULL);

DROP TABLE IF EXISTS `branchs`;
CREATE TABLE `branchs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_merchant` int(11) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `information` text COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '1=Active;0=Inactive',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `branchs` (`id`, `id_merchant`, `latitude`, `longitude`, `address`, `phone`, `information`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1,	1,	21324354,	2787665544,	'Jl Mega Kuningan Jakarta',	'8978678987',	'Tests sdgs sg',	1,	NULL,	'2017-04-03 07:52:12',	NULL),
(2,	1,	123123220912,	189912030138,	'Oke asdahsdj',	'085711202889',	'Test',	1,	NULL,	'2017-04-03 19:44:41',	'2017-04-03 19:44:41');

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '1=Active;0=Inactive',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `categories` (`id`, `name`, `description`, `image`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(4,	'Restoran Indonesia',	'Makanan negara sendiri memang yang paling enak dan pas sama lidah kita semua! ',	'restoran-indonesia-rfn.jpg',	1,	NULL,	'2017-03-01 02:23:28',	'2017-03-01 02:23:28'),
(5,	'Jajanan Malam',	'Hayo siapa yang suka laper malem-malem tapi bingung resto mana yang masih buka??',	'jajanan-malam-pgg.jpg',	1,	NULL,	'2017-03-01 02:30:19',	'2017-03-01 02:30:19'),
(6,	'Hot & Spicy',	'We have put together a list of Jakarta\'s best restaurants for hot & spicy food lovers',	'hot-&-spicy-6ve.jpg',	1,	NULL,	'2017-03-01 02:47:27',	'2017-03-01 03:06:31'),
(7,	'Cafe',	'Bukan hal yang baru kalau kopi sekarang jadi trending di Instagram.',	'cafe-8dm.jpg',	1,	NULL,	'2017-03-01 03:36:42',	'2017-03-01 03:36:42');

DROP TABLE IF EXISTS `merchants`;
CREATE TABLE `merchants` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_type` int(10) unsigned DEFAULT NULL,
  `name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) DEFAULT '1' COMMENT '1=Active;0=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_type` (`id_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `merchants` (`id`, `id_type`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1,	0,	'Restaurant 1',	'Test',	1,	NULL,	'2017-04-03 23:23:46'),
(2,	1,	'Merchant 3',	'Description Merchant 3',	1,	'2017-04-03 18:27:48',	'2017-04-04 03:12:21'),
(4,	3,	'Indonesian Food Restaurant',	'Testsetse',	1,	'2017-04-03 19:57:45',	'2017-04-03 19:57:45');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2017_01_22_181301_create_promos_table',	1),
(4,	'2017_03_01_063021_create_types_table',	1),
(5,	'2017_03_01_063301_create_categories_table',	1),
(6,	'2017_03_01_063333_create_branchs_table',	1);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `promos`;
CREATE TABLE `promos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_merchant` int(11) NOT NULL,
  `id_bank` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `promo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `term_condition` text COLLATE utf8_unicode_ci NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `date_start` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_end` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '1=Active;0=Inactive',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `promos` (`id`, `id_merchant`, `id_bank`, `title`, `promo`, `latitude`, `longitude`, `picture`, `description`, `term_condition`, `discount`, `date_start`, `date_end`, `quantity`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1,	1,	1,	'Title Test',	'uiada sdasdsad asdasd',	123123,	768564,	'',	'wer232134c234214',	'',	0,	'2017-09-02',	'2017-10-02',	2,	1,	NULL,	'2017-04-03 07:52:57',	NULL);

DROP TABLE IF EXISTS `promo_categories`;
CREATE TABLE `promo_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '1=Active;0=Inactive',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `promo_categories` (`id`, `name`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1,	'Popular Promotions',	'this is popular promotion sections',	1,	NULL,	'2017-04-03 13:45:02',	NULL),
(2,	'Highlights',	'this is highlight section',	1,	NULL,	'2017-04-03 13:45:52',	NULL);

DROP TABLE IF EXISTS `promo_has_branchs`;
CREATE TABLE `promo_has_branchs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_promo` bigint(20) NOT NULL,
  `id_branch` int(11) unsigned NOT NULL,
  `status` smallint(6) DEFAULT '1' COMMENT '1=Active;0=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_promo` (`id_promo`),
  KEY `id_branch` (`id_branch`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `promo_has_categories`;
CREATE TABLE `promo_has_categories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_promo_category` int(11) NOT NULL,
  `id_promo` bigint(20) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '1=Active;0=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_promo_category` (`id_promo_category`),
  KEY `id_promo` (`id_promo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `promo_review`;
CREATE TABLE `promo_review` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_promo` bigint(20) NOT NULL,
  `id_user` int(11) NOT NULL,
  `cleaniess` smallint(6) NOT NULL,
  `service` smallint(6) NOT NULL,
  `food_dining` smallint(6) NOT NULL,
  `facilities` smallint(6) NOT NULL,
  `room_comfort` smallint(6) NOT NULL,
  `value_for_money` smallint(6) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '1=Active;0=Inactive',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `uodated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `types`;
CREATE TABLE `types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `types` (`id`, `name`, `description`, `icon`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2,	'Indonesian',	'Indonesian Restaurants',	'indonesian-b6b.png',	NULL,	'2017-03-01 04:00:33',	'2017-03-01 04:00:33'),
(3,	'Jawa',	'Jawa Restaurants',	'jawa-yv6.png',	NULL,	'2017-03-01 04:05:06',	'2017-03-01 04:05:06');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` enum('0','1','2') COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `id_merchant` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `id_merchant` (`id_merchant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `roles`, `phone`, `address`, `id_category`, `id_merchant`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1,	'Aldi Maulana',	'aldieemaulana@gmail.com',	'aldieemaulana',	'$2y$10$afR0LXgcE9F/1K1N.tZDQOz5BNRIW7FQQH.Xr.j4C9vD5Kc6rcY8K',	'2',	NULL,	NULL,	NULL,	NULL,	'mCImX1cwKuK002KwQZ9yPzgFZgbbkzKEHznESzbuXeXEyCBTJACpZs0cPfij',	NULL,	'2017-03-01 01:27:35',	'2017-03-14 00:38:57'),
(2,	'Hendri Gunawan',	'hendri.gnw@gmail.com',	'hendri.gunawan',	'$2y$10$jdOFGr0w21rVHmZObD/T7.DBk8AXhSeHYMyjgeIWRw7hSDX/XrhqO',	'2',	NULL,	NULL,	NULL,	NULL,	'8La2tYqfc3b6Vi8ZdrPU2zUlQpBQTMshsQaizGHjM6i0szOj8L7oXseT4TsM',	NULL,	'2017-04-02 20:23:56',	'2017-04-03 18:28:04'),
(5,	'Hendri Gunawan',	'hendri.gnw@gmail.coms',	'hendri.gnw',	'$2y$10$sFWUzEKu.rb9G6i/p9t0COohD7q2OJn0376kyWscYjCOc6YbJO/tq',	'0',	'0',	NULL,	NULL,	NULL,	NULL,	NULL,	'2017-04-04 00:54:36',	'2017-04-04 02:48:19'),
(6,	'Hendri Gunawan',	'hendri.gnw@gmail.comss',	'hendri.gnwn',	'$2y$10$jdOFGr0w21rVHmZObD/T7.DBk8AXhSeHYMyjgeIWRw7hSDX/XrhqO',	'1',	'0',	NULL,	2,	1,	NULL,	NULL,	'2017-04-04 00:55:29',	'2017-04-04 00:55:29');

-- 2017-04-05 02:30:13
