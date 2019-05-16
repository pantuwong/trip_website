-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 07, 2019 at 04:18 PM
-- Server version: 5.7.26-0ubuntu0.16.04.1
-- PHP Version: 7.0.33-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `halalwayz`
--
CREATE DATABASE IF NOT EXISTS `halalwayz` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `halalwayz`;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM AUTO_INCREMENT=247 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `countries`
--

TRUNCATE TABLE `countries`;
--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People\'s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People\'s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'SS', 'South Sudan'),
(203, 'ES', 'Spain'),
(204, 'LK', 'Sri Lanka'),
(205, 'SH', 'St. Helena'),
(206, 'PM', 'St. Pierre and Miquelon'),
(207, 'SD', 'Sudan'),
(208, 'SR', 'Suriname'),
(209, 'SJ', 'Svalbard and Jan Mayen Islands'),
(210, 'SZ', 'Swaziland'),
(211, 'SE', 'Sweden'),
(212, 'CH', 'Switzerland'),
(213, 'SY', 'Syrian Arab Republic'),
(214, 'TW', 'Taiwan'),
(215, 'TJ', 'Tajikistan'),
(216, 'TZ', 'Tanzania, United Republic of'),
(217, 'TH', 'Thailand'),
(218, 'TG', 'Togo'),
(219, 'TK', 'Tokelau'),
(220, 'TO', 'Tonga'),
(221, 'TT', 'Trinidad and Tobago'),
(222, 'TN', 'Tunisia'),
(223, 'TR', 'Turkey'),
(224, 'TM', 'Turkmenistan'),
(225, 'TC', 'Turks and Caicos Islands'),
(226, 'TV', 'Tuvalu'),
(227, 'UG', 'Uganda'),
(228, 'UA', 'Ukraine'),
(229, 'AE', 'United Arab Emirates'),
(230, 'GB', 'United Kingdom'),
(231, 'US', 'United States'),
(232, 'UM', 'United States minor outlying islands'),
(233, 'UY', 'Uruguay'),
(234, 'UZ', 'Uzbekistan'),
(235, 'VU', 'Vanuatu'),
(236, 'VA', 'Vatican City State'),
(237, 'VE', 'Venezuela'),
(238, 'VN', 'Vietnam'),
(239, 'VG', 'Virgin Islands (British)'),
(240, 'VI', 'Virgin Islands (U.S.)'),
(241, 'WF', 'Wallis and Futuna Islands'),
(242, 'EH', 'Western Sahara'),
(243, 'YE', 'Yemen'),
(244, 'ZR', 'Zaire'),
(245, 'ZM', 'Zambia'),
(246, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `setting_id` int(255) NOT NULL AUTO_INCREMENT,
  `sitename` text NOT NULL,
  `customer_commission` float(10,2) NOT NULL,
  `guide_commission` float(10,2) NOT NULL,
  `withdrawal_minimum` double NOT NULL,
  `withdrawal_process_day` int(11) NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `settings`
--

TRUNCATE TABLE `settings`;
--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `sitename`, `customer_commission`, `guide_commission`, `withdrawal_minimum`, `withdrawal_process_day`) VALUES
(1, 'Halalwayz : Discover halal destinations', 5.00, 10.00, 1000, 7);

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

DROP TABLE IF EXISTS `trips`;
CREATE TABLE IF NOT EXISTS `trips` (
  `trip_id` int(11) NOT NULL AUTO_INCREMENT,
  `trip_type_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `users_user_id` text NOT NULL,
  `trip_name` text NOT NULL,
  `trip_sum` text NOT NULL,
  `trip_dest` text NOT NULL,
  `trip_activity` text NOT NULL,
  `trip_cover` varchar(100) NOT NULL,
  `trip_num_day` int(11) NOT NULL DEFAULT '0',
  `trip_meeting_addr` varchar(2000) NOT NULL DEFAULT '0',
  `trip_meeting_lat` double NOT NULL DEFAULT '0',
  `trip_meeting_lng` double NOT NULL DEFAULT '0',
  `trip_condition_casual` int(11) NOT NULL DEFAULT '0',
  `trip_condition_physical` int(11) NOT NULL DEFAULT '0',
  `trip_condition_vegan` int(11) NOT NULL DEFAULT '0',
  `trip_condition_children` int(11) NOT NULL DEFAULT '0',
  `trip_condition_flexible` int(11) NOT NULL DEFAULT '0',
  `trip_condition_seasonal` int(11) NOT NULL DEFAULT '0',
  `trip_status` enum('2','1','0') NOT NULL DEFAULT '0',
  `trip_ver_reason` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`trip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `trips`
--

TRUNCATE TABLE `trips`;
--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`trip_id`, `trip_type_id`, `vehicle_id`, `users_user_id`, `trip_name`, `trip_sum`, `trip_dest`, `trip_activity`, `trip_cover`, `trip_num_day`, `trip_meeting_addr`, `trip_meeting_lat`, `trip_meeting_lng`, `trip_condition_casual`, `trip_condition_physical`, `trip_condition_vegan`, `trip_condition_children`, `trip_condition_flexible`, `trip_condition_seasonal`, `trip_status`, `trip_ver_reason`) VALUES
(2, 3, 1, 'l5DZnXhroaYyvkfpZBk2WcgRepp2', 'Bua Tong Sticky Waterfall Tour with Super Local Expert', 'Bua Tong Waterfall is most unusual because it is limestone waterfall and is not slippery. As a super Local Expert, I know the safest spots to climb and will go into the water with you and show where to step onto and grip!', 'Chiang Mai', 'life learning', '1.jpg', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '0', ''),
(3, 1, 2, 'l5DZnXhroaYyvkfpZBk2WcgRepp2', 'Sunflower Field Tour from Bangkok & Ayothaya Floating Market', 'Sunflowers bloom in Thailand only from November to January, so don\'t miss this rare opportunity. With my private sunflower field tour, we\'ll travel from Bangkok to one of Thailand\'s loveliest sunflower fields in Lopburi. After that, we\'ll have fun at Ayothaya Floating Market in Ayutthaya.', 'Lopburi', 'life learning', '6.jpg', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '0', ''),
(4, 4, 1, 'l5DZnXhroaYyvkfpZBk2WcgRepp2', 'Street Food Tour in Bangkok Chinatown', 'Thai and Chinese cultures are intertwined and there\'s no better place than Yaowarat or Bangkok Chinatown to experience it... especially with your taste buds! Let our Local Expert show you where the delicious hidden treasures are.', 'Bangkok', 'life learning', '3.jpg', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '0', ''),
(5, 1, 2, 'l5DZnXhroaYyvkfpZBk2WcgRepp2', 'Ayutthaya: Historical Park, Temples and Ayothaya Floating Market', 'Slip back in time in the ancient capital of Thailand. This Ayutthaya tour lets you explore the UNESCO-listed temples and palaces at Ayutthaya Historical Park. Then enjoy afternoon shopping and relax at Ayothaya Floating Market.', 'Ayutthaya', 'life learning', '4.jpg', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '0', ''),
(9, 1, 1, 'l5DZnXhroaYyvkfpZBk2WcgRepp2', 'Bangkok Old Town Cafe Hopping Private Tour', 'Let\'s go hopping through the unique cafes in Bangkok Old Town area. Try some special drinks at hidden cafes located in the area. I am waiting for you ', 'Bangkok', 'life learning', '5c89e42bca43f.png', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '0', ''),
(11, 1, 0, 'l5DZnXhroaYyvkfpZBk2WcgRepp2', 'Samut Sakhon from Bangkok: Mangrove, Salt Farm & Fisherman\'s Village', 'In this trip, you will enjoy a first-hand experience as a fisherman. Cook organic seafood, walk with your bare feet in a salt farm, and marvel at the ', 'Bangkok', 'eating', '5c911c3d10856.jpg', 2, 'Unnamed Road, Tambon Bang Ya Praek, Amphoe Mueang Samut Sakhon, Chang Wat Samut Sakhon 74000, Thailand', 13.517222073038608, 100.26986100909835, 0, 0, 0, 0, 0, 0, '0', ''),
(13, 1, 2, 'l5DZnXhroaYyvkfpZBk2WcgRepp2', 'Samut Sakhon from Bangkok: Mangrove, Salt Farm & Fisherman', 'In this trip, you will enjoy a first-hand experience as a fisherman. Cook organic seafood, walk with your bare feet in a salt farm, and marvel at the ', 'Bangkok', 'Eating', '5c927141ae450.jpg', 1, 'Unnamed Road, Tambon Na Klua, Amphoe Phra Samut Chedi, Chang Wat Samut Prakan 10290, Thailand', 13.53118969112651, 100.50121334375001, 0, 0, 0, 0, 0, 0, '0', ''),
(14, 1, 2, 'bHFHKplICKM5WQg0UfVG9hbEkDB2', 'Grand Palace - Rattanakosin Island', 'Visit Grand Palace and drive passing around Rattanakosin Island - (Pom Phra Karn, Golden mount, Democracy Monument, Grand Palace, Sanum Luang. ', 'Bangkok', 'historical', '5cd0e59d886de.jpg', 1, '200 Maha Rat Rd, Khwaeng Phra Borom Maha Ratchawang, Khet Phra Nakhon, Krung Thep Maha Nakhon 10200, Thailand', 13.750098495034333, 100.49129962921143, 0, 0, 0, 0, 0, 0, '0', ''),
(15, 1, 1, 'l5DZnXhroaYyvkfpZBk2WcgRepp2', 'à¸—à¸”à¸ªà¸­à¸š à¸—à¸£à¸´à¸›', 'à¸à¸”à¸«', 'à¸”à¸«à¸à¸”à¸«à¸à¸”à¸«', 'eating', '5cd144c917183.jpg', 1, 'Kaeng Krachan, Kaeng Krachan District, Phetchaburi, Thailand', 12.975118400525243, 99.55638912500001, 0, 0, 0, 0, 0, 0, '0', NULL),
(16, 1, 0, 'bHFHKplICKM5WQg0UfVG9hbEkDB2', 'Damnernsaduak floating market ', 'More than 200 small canals store purchase are particularly food fruit and vegetable, purchase from their  own orchards. Drive 1:30 hours from Bangkok.', 'Rachaburi', 'historical ', '5cd14ad193d7d.jpg', 0, '0', 0, 0, 0, 0, 0, 0, 0, 0, '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trip_date`
--

DROP TABLE IF EXISTS `trip_date`;
CREATE TABLE IF NOT EXISTS `trip_date` (
  `trip_id` int(11) NOT NULL,
  `trip_date` date NOT NULL,
  PRIMARY KEY (`trip_id`,`trip_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `trip_date`
--

TRUNCATE TABLE `trip_date`;
--
-- Dumping data for table `trip_date`
--

INSERT INTO `trip_date` (`trip_id`, `trip_date`) VALUES
(1, '0000-00-00'),
(1, '2019-03-22'),
(1, '2019-03-25'),
(1, '2019-03-29'),
(3, '2019-03-28'),
(3, '2019-03-29'),
(11, '2019-03-25'),
(13, '2019-03-21'),
(14, '2019-05-17'),
(14, '2019-05-18'),
(14, '2019-05-19'),
(14, '2019-05-20'),
(14, '2019-05-21'),
(14, '2019-05-23'),
(14, '2019-05-24'),
(14, '2019-05-25'),
(14, '2019-05-26'),
(14, '2019-05-27'),
(14, '2019-05-31'),
(14, '2019-06-01'),
(14, '2019-06-02'),
(14, '2019-06-03'),
(14, '2019-06-07'),
(14, '2019-06-08'),
(14, '2019-06-09'),
(14, '2019-06-10'),
(14, '2019-06-14'),
(14, '2019-06-15'),
(14, '2019-06-16'),
(14, '2019-06-17'),
(14, '2019-06-21'),
(14, '2019-06-22'),
(14, '2019-06-23'),
(14, '2019-06-24'),
(14, '2019-06-28'),
(14, '2019-06-29'),
(14, '2019-06-30'),
(17, '2019-03-27'),
(17, '2019-03-29'),
(20, '2019-03-27'),
(20, '2019-03-29'),
(20, '2019-03-31'),
(20, '2019-04-01'),
(21, '0000-00-00'),
(22, '0000-00-00'),
(23, '2019-03-03'),
(23, '2019-03-27');

-- --------------------------------------------------------

--
-- Table structure for table `trip_detail`
--

DROP TABLE IF EXISTS `trip_detail`;
CREATE TABLE IF NOT EXISTS `trip_detail` (
  `trip_id` int(11) NOT NULL,
  `trip_day` int(11) NOT NULL,
  `trip_detail_start` time NOT NULL,
  `trip_detail_end` time NOT NULL,
  `trip_detail_start_ap` varchar(2) DEFAULT NULL,
  `trip_detail_end_ap` varchar(2) DEFAULT NULL,
  `trip_detail_description` mediumtext,
  PRIMARY KEY (`trip_id`,`trip_day`,`trip_detail_start`,`trip_detail_end`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `trip_detail`
--

TRUNCATE TABLE `trip_detail`;
--
-- Dumping data for table `trip_detail`
--

INSERT INTO `trip_detail` (`trip_id`, `trip_day`, `trip_detail_start`, `trip_detail_end`, `trip_detail_start_ap`, `trip_detail_end_ap`, `trip_detail_description`) VALUES
(11, 1, '09:00:00', '09:30:00', '0 ', '0 ', 'Meet up at Wutthakat BTS Station'),
(11, 1, '10:00:00', '11:00:00', '0 ', '0 ', 'Arrive at the mangrove forest. Enjoy the view of the Gulf of Thailand and the mangrove forest\'s ecology '),
(11, 1, '11:00:00', '12:00:00', '0 ', '0 ', 'Arrive at the salt farm. Take a walk in the salt farm, learn how salt is made and take pictures with a traditional salt storage. Then enjoy tea and coffee and shop for organic young sea salt from the original place.'),
(11, 2, '09:00:00', '10:00:00', '0 ', '0 ', 'Arrive at the pier and take a 5-10 minute boat ride to Saen Tor Community. You can enjoy a marvelous view of the mangrove forest along the canal.'),
(14, 1, '09:00:00', '14:02:00', '0 ', '2 ', 'We can pick you up at your hotel in the morning'),
(15, 1, '15:42:00', '15:42:00', '2 ', '2 ', 'sdfsdfsfsdfsdfsdfsdfsd'),
(16, 1, '07:15:00', '14:00:00', '5 ', '0 ', 'Halal lunch box.');

-- --------------------------------------------------------

--
-- Table structure for table `trip_photo`
--

DROP TABLE IF EXISTS `trip_photo`;
CREATE TABLE IF NOT EXISTS `trip_photo` (
  `trip_id` int(11) NOT NULL,
  `trip_photo_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `trip_photo`
--

TRUNCATE TABLE `trip_photo`;
--
-- Dumping data for table `trip_photo`
--

INSERT INTO `trip_photo` (`trip_id`, `trip_photo_name`) VALUES
(10, '5c82471e0d9f4.jpg'),
(10, '5c82489b26ee7.PNG'),
(14, '5cd0e6799322b.jpg'),
(14, '5cd0e682a7dd0.jpg'),
(13, '5c926f3e53352.jpg'),
(13, '5c926f3e5a975.jpg'),
(13, '5c926f3e7266e.jpg'),
(13, '5c926f3e8b8f6.jpg'),
(13, '5c926f3eac427.jpg'),
(13, '5c926f3ebffec.jpg'),
(13, '5c926f3f03f1d.jpg'),
(13, '5c926f3f1cc4d.jpg'),
(16, '5cd14ade10b28.jpg'),
(16, '5cd14af15ced3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `trip_price`
--

DROP TABLE IF EXISTS `trip_price`;
CREATE TABLE IF NOT EXISTS `trip_price` (
  `trip_id` int(11) NOT NULL,
  `price_food` varchar(10) NOT NULL,
  `price_extra` mediumtext NOT NULL,
  `price_max_pass` int(11) NOT NULL,
  `price_type` varchar(10) NOT NULL DEFAULT 'basic',
  `price_unit1` float NOT NULL,
  `price_total1` float NOT NULL,
  `price_unit2` float NOT NULL DEFAULT '0',
  `price_total2` float NOT NULL DEFAULT '0',
  `price_unit3` float NOT NULL DEFAULT '0',
  `price_total3` float NOT NULL DEFAULT '0',
  `price_unit4` float NOT NULL DEFAULT '0',
  `price_total4` float NOT NULL DEFAULT '0',
  `price_unit5` float NOT NULL DEFAULT '0',
  `price_total5` float NOT NULL DEFAULT '0',
  `price_unit6` float NOT NULL DEFAULT '0',
  `price_total6` float NOT NULL DEFAULT '0',
  `price_unit7` float NOT NULL DEFAULT '0',
  `price_total7` float NOT NULL DEFAULT '0',
  `price_unit8` float NOT NULL DEFAULT '0',
  `price_total8` float NOT NULL DEFAULT '0',
  `price_children_allow` int(11) NOT NULL DEFAULT '0',
  `price_children` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`trip_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `trip_price`
--

TRUNCATE TABLE `trip_price`;
--
-- Dumping data for table `trip_price`
--

INSERT INTO `trip_price` (`trip_id`, `price_food`, `price_extra`, `price_max_pass`, `price_type`, `price_unit1`, `price_total1`, `price_unit2`, `price_total2`, `price_unit3`, `price_total3`, `price_unit4`, `price_total4`, `price_unit5`, `price_total5`, `price_unit6`, `price_total6`, `price_unit7`, `price_total7`, `price_unit8`, `price_total8`, `price_children_allow`, `price_children`) VALUES
(3, 'included', '', 3, 'advance', 500, 500, 900, 1800, 1200, 3600, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 'included', '', 2, 'basic', 1000, 2000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 500),
(13, 'included', '', 3, 'basic', 500, 1500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 'excluded', 'Lunch at halal restaurant and Solat in Resterant.', 5, 'advance', 900, 900, 500, 1000, 400, 1200, 400, 1600, 400, 2000, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 'included', '', 4, 'advance', 400, 400, 500, 1000, 500, 1500, 500, 2000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `trip_reservation`
--

DROP TABLE IF EXISTS `trip_reservation`;
CREATE TABLE IF NOT EXISTS `trip_reservation` (
  `res_id` int(11) NOT NULL AUTO_INCREMENT,
  `res_no` varchar(100) DEFAULT NULL,
  `trip_id` int(11) DEFAULT NULL,
  `trip_res_adult` int(11) DEFAULT NULL,
  `trip_res_child` int(11) DEFAULT NULL,
  `trip_res_date` date DEFAULT NULL,
  `trip_res_title` varchar(10) DEFAULT NULL,
  `trip_res_fn` varchar(100) DEFAULT NULL,
  `trip_res_ln` varchar(100) DEFAULT NULL,
  `trip_res_email` varchar(100) DEFAULT NULL,
  `trip_res_mobile` varchar(20) DEFAULT NULL,
  `trip_res_country` varchar(50) DEFAULT NULL,
  `trip_res_payment_method` varchar(30) DEFAULT 'paypal',
  `trip_res_payment_status` int(11) DEFAULT '0',
  `trip_res_datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `trip_res_fee` double DEFAULT NULL,
  `trip_res_cust_com` double NOT NULL,
  `trip_res_guide_com` double NOT NULL,
  PRIMARY KEY (`res_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `trip_reservation`
--

TRUNCATE TABLE `trip_reservation`;
-- --------------------------------------------------------

--
-- Table structure for table `trip_type`
--

DROP TABLE IF EXISTS `trip_type`;
CREATE TABLE IF NOT EXISTS `trip_type` (
  `trip_type_id` int(11) NOT NULL,
  `trip_type_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `trip_type`
--

TRUNCATE TABLE `trip_type`;
--
-- Dumping data for table `trip_type`
--

INSERT INTO `trip_type` (`trip_type_id`, `trip_type_name`) VALUES
(1, 'Travel Trip'),
(2, 'Business Trip'),
(3, 'Medical Trip'),
(4, 'Umrah Trip');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` enum('2','1','0') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '1',
  `oauth_provider` varchar(15) DEFAULT NULL,
  `oauth_uid` varchar(25) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `locale` varchar(10) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `user_name` varchar(25) DEFAULT NULL,
  `user_pass` varchar(20) DEFAULT NULL,
  `user_fb_connect` int(1) DEFAULT NULL,
  `user_fb_authorized` varchar(50) DEFAULT NULL,
  `user_gg_connect` int(1) DEFAULT NULL,
  `user_gg_authorized` varchar(50) DEFAULT NULL,
  `user_last_login` datetime DEFAULT NULL,
  `address` text,
  `passportCountry` varchar(255) DEFAULT NULL,
  `currentCity` varchar(255) DEFAULT NULL,
  `languages` text,
  `about` text,
  `evidence_id` varchar(256) DEFAULT NULL,
  `evidence_bank` varchar(256) DEFAULT NULL,
  `evidence_self` varchar(256) DEFAULT NULL,
  `verify_reason` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `created`, `modified`, `status`, `oauth_provider`, `oauth_uid`, `gender`, `locale`, `picture`, `link`, `user_id`, `user_name`, `user_pass`, `user_fb_connect`, `user_fb_authorized`, `user_gg_connect`, `user_gg_authorized`, `user_last_login`, `address`, `passportCountry`, `currentCity`, `languages`, `about`, `evidence_id`, `evidence_bank`, `evidence_self`, `verify_reason`) VALUES
(5, 'Alphonse', 'Mc Clouds', 'alphonse99@gmail.com', NULL, '', '2019-03-08 03:46:41', NULL, '0', NULL, NULL, '1', NULL, 'https://lh3.googleusercontent.com/-KcahFqJ_CNk/AAAAAAAAAAI/AAAAAAABZks/3xPMaKZW9ns/photo.jpg', NULL, 'l5DZnXhroaYyvkfpZBk2WcgRepp2', NULL, '10440516', NULL, NULL, 1, NULL, '2019-05-07 08:29:30', '3/14 Khao Rup Chang Maung', '', '', 'Thai,English', 'I love travel', NULL, NULL, NULL, NULL),
(44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL),
(45, 'Papilo', 'Malaysia', 'papilomalaysia@gmail.com', NULL, '', NULL, NULL, '1', NULL, NULL, '1', NULL, NULL, NULL, 'DyOkIRaOvxf9pdBdnM5uCUyRAAB3', NULL, NULL, NULL, NULL, 1, NULL, '2019-03-29 05:07:44', '64/38 Klongkum Bungkum Bangkok Thailand', '', 'Bangkok', '1', 'I love my live Alhamdulillah', NULL, NULL, NULL, NULL),
(46, 'Alphonse Mc', 'Clouds', 'alphonse_mc_clouds@hotmail.com', NULL, NULL, '2019-03-21 01:28:10', NULL, '0', NULL, NULL, NULL, NULL, '', NULL, '7FmH4fUiZFYVngXHZZVD6fIU08E3', NULL, '10007798', NULL, NULL, 1, NULL, '2019-03-21 01:28:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 'Studio', 'Xpert', 'iamstudioxpert@gmail.com', NULL, NULL, '2019-03-21 03:40:20', NULL, '1', NULL, NULL, NULL, NULL, 'https://lh5.googleusercontent.com/-o6zixe-qz4s/AAAAAAAAAAI/AAAAAAAAABM/Mi-Tc0HkClA/photo.jpg', NULL, 'QhwDStAhLuXA5HTziDwxx0wizXx2', NULL, '10790956', NULL, NULL, 1, NULL, '2019-03-21 03:40:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 'Niruslun', 'Maspo', 'niruslun@hotmail.com', NULL, '0178869877', '2019-03-31 12:53:44', NULL, '0', NULL, NULL, '1', NULL, 'assets/img/avatar.jpg', NULL, 'bHFHKplICKM5WQg0UfVG9hbEkDB2', NULL, '10261076', NULL, NULL, 1, NULL, '2019-05-07 08:45:39', 'Datokeramat  The Chymes condo', 'Thailand', 'Malaysia ', '', 'My live is slow motion, but my dream are faster than rocket ship.', NULL, NULL, NULL, NULL),
(54, 'Natapon', 'Pantuwong', 'pantuwong@gmail.com', NULL, NULL, '2019-05-01 22:25:32', NULL, '0', NULL, NULL, NULL, NULL, 'https://lh6.googleusercontent.com/-jYpRVFUx77Y/AAAAAAAAAAI/AAAAAAAAIjQ/29yQhGLbuXI/photo.jpg', NULL, 'grW03pe8WvT6H6802NMmKgmNFb82', NULL, '10840058', NULL, NULL, 1, NULL, '2019-05-04 08:11:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 'Thai', 'Annotation', 'thai.annotation@gmail.com', NULL, NULL, '2019-05-03 23:18:40', NULL, '0', NULL, NULL, NULL, NULL, 'https://lh5.googleusercontent.com/-ywUV-hXxnDs/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3re97v5CRiVovII2i30d0Q6sN1BzIA/mo/photo.jpg', NULL, 'SMc85zDzFlRySaAOKzJEzWYDWng1', NULL, '11093177', NULL, NULL, 1, NULL, '2019-05-03 23:18:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
CREATE TABLE IF NOT EXISTS `vehicle` (
  `vehicle_id` int(11) NOT NULL,
  `vehicle_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `vehicle`
--

TRUNCATE TABLE `vehicle`;
--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicle_id`, `vehicle_name`) VALUES
(1, 'Walk'),
(2, 'Car'),
(3, 'Van'),
(4, 'Motobike'),
(5, 'Bike'),
(6, 'Boat'),
(7, 'Public');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

DROP TABLE IF EXISTS `wallets`;
CREATE TABLE IF NOT EXISTS `wallets` (
  `wallet_id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `currency` int(255) NOT NULL,
  `res_no` varchar(255) NOT NULL,
  `payment_type` int(2) NOT NULL COMMENT '0 payment,1 witdraw',
  `payment_date_time` datetime NOT NULL,
  PRIMARY KEY (`wallet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `wallets`
--

TRUNCATE TABLE `wallets`;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
