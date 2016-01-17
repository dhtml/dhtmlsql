-- phpMyAdmin SQL Dump
-- version 4.4.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2016 at 02:10 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtest`
--

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `text` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=243 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `title`, `text`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'AS', 'American Samoa'),
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
(32, 'BN', 'Brunei'),
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
(50, 'CD', 'Congo (DRC)'),
(51, 'CK', 'Cook Islands'),
(52, 'CR', 'Costa Rica'),
(53, 'CI', 'Côte d''Ivoire'),
(54, 'HR', 'Croatia'),
(55, 'CU', 'Cuba'),
(56, 'CY', 'Cyprus'),
(57, 'CZ', 'Czech Republic'),
(58, 'DK', 'Denmark'),
(59, 'DJ', 'Djibouti'),
(60, 'DM', 'Dominica'),
(61, 'DO', 'Dominican Republic'),
(62, 'EC', 'Ecuador'),
(63, 'EG', 'Egypt'),
(64, 'SV', 'El Salvador'),
(65, 'GQ', 'Equatorial Guinea'),
(66, 'ER', 'Eritrea'),
(67, 'EE', 'Estonia'),
(68, 'ET', 'Ethiopia'),
(69, 'FK', 'Falkland Islands (Islas Malvinas)'),
(70, 'FO', 'Faroe Islands'),
(71, 'FJ', 'Fiji Islands'),
(72, 'FI', 'Finland'),
(73, 'FR', 'France'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern and Antarctic Lands'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia, The'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GR', 'Greece'),
(84, 'GL', 'Greenland'),
(85, 'GD', 'Grenada'),
(86, 'GP', 'Guadeloupe'),
(87, 'GU', 'Guam'),
(88, 'GT', 'Guatemala'),
(89, 'GG', 'Guernsey'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard Island and McDonald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong SAR'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'ID', 'Indonesia'),
(101, 'IR', 'Iran'),
(102, 'IQ', 'Iraq'),
(103, 'IE', 'Ireland'),
(104, 'IM', 'Isle of Man'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'JM', 'Jamaica'),
(108, 'JP', 'Japan'),
(109, 'JE', 'Jersey'),
(110, 'JO', 'Jordan'),
(111, 'KZ', 'Kazakhstan'),
(112, 'KE', 'Kenya'),
(113, 'KI', 'Kiribati'),
(114, 'KR', 'Korea'),
(115, 'KW', 'Kuwait'),
(116, 'KG', 'Kyrgyzstan'),
(117, 'LA', 'Laos'),
(118, 'LV', 'Latvia'),
(119, 'LB', 'Lebanon'),
(120, 'LS', 'Lesotho'),
(121, 'LR', 'Liberia'),
(122, 'LY', 'Libya'),
(123, 'LI', 'Liechtenstein'),
(124, 'LT', 'Lithuania'),
(125, 'LU', 'Luxembourg'),
(126, 'MO', 'Macao SAR'),
(127, 'MK', 'Macedonia, Former Yugoslav Republic of'),
(128, 'MG', 'Madagascar'),
(129, 'MW', 'Malawi'),
(130, 'MY', 'Malaysia'),
(131, 'MV', 'Maldives'),
(132, 'ML', 'Mali'),
(133, 'MT', 'Malta'),
(134, 'MH', 'Marshall Islands'),
(135, 'MQ', 'Martinique'),
(136, 'MR', 'Mauritania'),
(137, 'MU', 'Mauritius'),
(138, 'YT', 'Mayotte'),
(139, 'MX', 'Mexico'),
(140, 'FM', 'Micronesia'),
(141, 'MD', 'Moldova'),
(142, 'MC', 'Monaco'),
(143, 'MN', 'Mongolia'),
(144, 'ME', 'Montenegro'),
(145, 'MS', 'Montserrat'),
(146, 'MA', 'Morocco'),
(147, 'MZ', 'Mozambique'),
(148, 'MM', 'Myanmar'),
(149, 'NA', 'Namibia'),
(150, 'NR', 'Nauru'),
(151, 'NP', 'Nepal'),
(152, 'NL', 'Netherlands'),
(153, 'AN', 'Netherlands Antilles'),
(154, 'NC', 'New Caledonia'),
(155, 'NZ', 'New Zealand'),
(156, 'NI', 'Nicaragua'),
(157, 'NE', 'Niger'),
(158, 'NG', 'Nigeria'),
(159, 'NU', 'Niue'),
(160, 'NF', 'Norfolk Island'),
(161, 'KP', 'North Korea'),
(162, 'MP', 'Northern Mariana Islands'),
(163, 'NO', 'Norway'),
(164, 'OM', 'Oman'),
(165, 'PK', 'Pakistan'),
(166, 'PW', 'Palau'),
(167, 'PS', 'Palestinian Authority'),
(168, 'PA', 'Panama'),
(169, 'PG', 'Papua New Guinea'),
(170, 'PY', 'Paraguay'),
(171, 'PE', 'Peru'),
(172, 'PH', 'Philippines'),
(173, 'PN', 'Pitcairn Islands'),
(174, 'PL', 'Poland'),
(175, 'PT', 'Portugal'),
(176, 'PR', 'Puerto Rico'),
(177, 'QA', 'Qatar'),
(178, 'RE', 'Reunion'),
(179, 'RO', 'Romania'),
(180, 'RU', 'Russia'),
(181, 'RW', 'Rwanda'),
(182, 'WS', 'Samoa'),
(183, 'SM', 'San Marino'),
(184, 'ST', 'São Tomé and Príncipe'),
(185, 'SA', 'Saudi Arabia'),
(186, 'SN', 'Senegal'),
(187, 'RS', 'Serbia'),
(188, 'SC', 'Seychelles'),
(189, 'SL', 'Sierra Leone'),
(190, 'SG', 'Singapore'),
(191, 'SK', 'Slovakia'),
(192, 'SI', 'Slovenia'),
(193, 'SB', 'Solomon Islands'),
(194, 'SO', 'Somalia'),
(195, 'ZA', 'South Africa'),
(196, 'GS', 'South Georgia and the South Sandwich Islands'),
(197, 'ES', 'Spain'),
(198, 'LK', 'Sri Lanka'),
(199, 'SH', 'St. Helena'),
(200, 'KN', 'St. Kitts and Nevis'),
(201, 'LC', 'St. Lucia'),
(202, 'PM', 'St. Pierre and Miquelon'),
(203, 'VC', 'St. Vincent and the Grenadines'),
(204, 'SD', 'Sudan'),
(205, 'SR', 'Suriname'),
(206, 'SJ', 'Svalbard and Jan Mayen'),
(207, 'SZ', 'Swaziland'),
(208, 'SE', 'Sweden'),
(209, 'CH', 'Switzerland'),
(210, 'SY', 'Syria'),
(211, 'TW', 'Taiwan'),
(212, 'TJ', 'Tajikistan'),
(213, 'TZ', 'Tanzania'),
(214, 'TH', 'Thailand'),
(215, 'TP', 'Timor-Leste (East Timor)'),
(216, 'TG', 'Togo'),
(217, 'TK', 'Tokelau'),
(218, 'TO', 'Tonga'),
(219, 'TT', 'Trinidad and Tobago'),
(220, 'TN', 'Tunisia'),
(221, 'TR', 'Turkey'),
(222, 'TM', 'Turkmenistan'),
(223, 'TC', 'Turks and Caicos Islands'),
(224, 'TV', 'Tuvalu'),
(225, 'UG', 'Uganda'),
(226, 'UA', 'Ukraine'),
(227, 'AE', 'United Arab Emirates'),
(228, 'UK', 'United Kingdom'),
(229, 'yes', 'United States'),
(230, 'UM', 'United States Minor Outlying Islands'),
(231, 'UY', 'Uruguay'),
(232, 'UZ', 'Uzbekistan'),
(233, 'VU', 'Vanuatu'),
(234, 'VA', 'Vatican City'),
(235, 'VE', 'Venezuela'),
(236, 'VN', 'Vietnam'),
(237, 'VG', 'Virgin Islands, British'),
(238, 'VI', 'Virgin Islands, U.S.'),
(239, 'WF', 'Wallis and Futuna'),
(240, 'YE', 'Yemen'),
(241, 'ZM', 'Zambia'),
(242, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `FirstName`, `LastName`) VALUES
(1, 'Stanley', 'J.'),
(2, 'Owen', 'David'),
(3, 'Mathew', 'Randel'),
(4, 'San', 'Andy');

-- --------------------------------------------------------

--
-- Table structure for table `mails`
--

DROP TABLE IF EXISTS `mails`;
CREATE TABLE IF NOT EXISTS `mails` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `first` varchar(255) NOT NULL,
  `last` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `variables`
--

DROP TABLE IF EXISTS `variables`;
CREATE TABLE IF NOT EXISTS `variables` (
  `vid` varchar(255) NOT NULL,
  `name` varchar(128) NOT NULL,
  `value` longtext NOT NULL,
  `scope` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mails`
--
ALTER TABLE `mails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `c` (`email`),
  ADD UNIQUE KEY `d` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variables`
--
ALTER TABLE `variables`
  ADD UNIQUE KEY `vid` (`vid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=243;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `mails`
--
ALTER TABLE `mails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
