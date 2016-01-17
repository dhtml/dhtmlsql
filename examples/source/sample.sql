-- DHTMLSQL Dump
-- http://dhtml.github.io/dhtmlsql
--
-- Host: localhost
-- Generation Time: 01/17/2016 02:28:am

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtest`
--

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `text` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=243 DEFAULT CHARSET=latin1;


--
-- Export data for table `country`
--

INSERT INTO `country` VALUES ('1','AF','Afghanistan');
INSERT INTO `country` VALUES ('2','AL','Albania');
INSERT INTO `country` VALUES ('3','DZ','Algeria');
INSERT INTO `country` VALUES ('4','AS','American Samoa');
INSERT INTO `country` VALUES ('5','AD','Andorra');
INSERT INTO `country` VALUES ('6','AO','Angola');
INSERT INTO `country` VALUES ('7','AI','Anguilla');
INSERT INTO `country` VALUES ('8','AQ','Antarctica');
INSERT INTO `country` VALUES ('9','AG','Antigua and Barbuda');
INSERT INTO `country` VALUES ('10','AR','Argentina');
INSERT INTO `country` VALUES ('11','AM','Armenia');
INSERT INTO `country` VALUES ('12','AW','Aruba');
INSERT INTO `country` VALUES ('13','AU','Australia');
INSERT INTO `country` VALUES ('14','AT','Austria');
INSERT INTO `country` VALUES ('15','AZ','Azerbaijan');
INSERT INTO `country` VALUES ('16','BS','Bahamas');
INSERT INTO `country` VALUES ('17','BH','Bahrain');
INSERT INTO `country` VALUES ('18','BD','Bangladesh');
INSERT INTO `country` VALUES ('19','BB','Barbados');
INSERT INTO `country` VALUES ('20','BY','Belarus');
INSERT INTO `country` VALUES ('21','BE','Belgium');
INSERT INTO `country` VALUES ('22','BZ','Belize');
INSERT INTO `country` VALUES ('23','BJ','Benin');
INSERT INTO `country` VALUES ('24','BM','Bermuda');
INSERT INTO `country` VALUES ('25','BT','Bhutan');
INSERT INTO `country` VALUES ('26','BO','Bolivia');
INSERT INTO `country` VALUES ('27','BA','Bosnia and Herzegovina');
INSERT INTO `country` VALUES ('28','BW','Botswana');
INSERT INTO `country` VALUES ('29','BV','Bouvet Island');
INSERT INTO `country` VALUES ('30','BR','Brazil');
INSERT INTO `country` VALUES ('31','IO','British Indian Ocean Territory');
INSERT INTO `country` VALUES ('32','BN','Brunei');
INSERT INTO `country` VALUES ('33','BG','Bulgaria');
INSERT INTO `country` VALUES ('34','BF','Burkina Faso');
INSERT INTO `country` VALUES ('35','BI','Burundi');
INSERT INTO `country` VALUES ('36','KH','Cambodia');
INSERT INTO `country` VALUES ('37','CM','Cameroon');
INSERT INTO `country` VALUES ('38','CA','Canada');
INSERT INTO `country` VALUES ('39','CV','Cape Verde');
INSERT INTO `country` VALUES ('40','KY','Cayman Islands');
INSERT INTO `country` VALUES ('41','CF','Central African Republic');
INSERT INTO `country` VALUES ('42','TD','Chad');
INSERT INTO `country` VALUES ('43','CL','Chile');
INSERT INTO `country` VALUES ('44','CN','China');
INSERT INTO `country` VALUES ('45','CX','Christmas Island');
INSERT INTO `country` VALUES ('46','CC','Cocos (Keeling) Islands');
INSERT INTO `country` VALUES ('47','CO','Colombia');
INSERT INTO `country` VALUES ('48','KM','Comoros');
INSERT INTO `country` VALUES ('49','CG','Congo');
INSERT INTO `country` VALUES ('50','CD','Congo (DRC)');
INSERT INTO `country` VALUES ('51','CK','Cook Islands');
INSERT INTO `country` VALUES ('52','CR','Costa Rica');
INSERT INTO `country` VALUES ('53','CI','Côte d\'Ivoire');
INSERT INTO `country` VALUES ('54','HR','Croatia');
INSERT INTO `country` VALUES ('55','CU','Cuba');
INSERT INTO `country` VALUES ('56','CY','Cyprus');
INSERT INTO `country` VALUES ('57','CZ','Czech Republic');
INSERT INTO `country` VALUES ('58','DK','Denmark');
INSERT INTO `country` VALUES ('59','DJ','Djibouti');
INSERT INTO `country` VALUES ('60','DM','Dominica');
INSERT INTO `country` VALUES ('61','DO','Dominican Republic');
INSERT INTO `country` VALUES ('62','EC','Ecuador');
INSERT INTO `country` VALUES ('63','EG','Egypt');
INSERT INTO `country` VALUES ('64','SV','El Salvador');
INSERT INTO `country` VALUES ('65','GQ','Equatorial Guinea');
INSERT INTO `country` VALUES ('66','ER','Eritrea');
INSERT INTO `country` VALUES ('67','EE','Estonia');
INSERT INTO `country` VALUES ('68','ET','Ethiopia');
INSERT INTO `country` VALUES ('69','FK','Falkland Islands (Islas Malvinas)');
INSERT INTO `country` VALUES ('70','FO','Faroe Islands');
INSERT INTO `country` VALUES ('71','FJ','Fiji Islands');
INSERT INTO `country` VALUES ('72','FI','Finland');
INSERT INTO `country` VALUES ('73','FR','France');
INSERT INTO `country` VALUES ('74','GF','French Guiana');
INSERT INTO `country` VALUES ('75','PF','French Polynesia');
INSERT INTO `country` VALUES ('76','TF','French Southern and Antarctic Lands');
INSERT INTO `country` VALUES ('77','GA','Gabon');
INSERT INTO `country` VALUES ('78','GM','Gambia, The');
INSERT INTO `country` VALUES ('79','GE','Georgia');
INSERT INTO `country` VALUES ('80','DE','Germany');
INSERT INTO `country` VALUES ('81','GH','Ghana');
INSERT INTO `country` VALUES ('82','GI','Gibraltar');
INSERT INTO `country` VALUES ('83','GR','Greece');
INSERT INTO `country` VALUES ('84','GL','Greenland');
INSERT INTO `country` VALUES ('85','GD','Grenada');
INSERT INTO `country` VALUES ('86','GP','Guadeloupe');
INSERT INTO `country` VALUES ('87','GU','Guam');
INSERT INTO `country` VALUES ('88','GT','Guatemala');
INSERT INTO `country` VALUES ('89','GG','Guernsey');
INSERT INTO `country` VALUES ('90','GN','Guinea');
INSERT INTO `country` VALUES ('91','GW','Guinea-Bissau');
INSERT INTO `country` VALUES ('92','GY','Guyana');
INSERT INTO `country` VALUES ('93','HT','Haiti');
INSERT INTO `country` VALUES ('94','HM','Heard Island and McDonald Islands');
INSERT INTO `country` VALUES ('95','HN','Honduras');
INSERT INTO `country` VALUES ('96','HK','Hong Kong SAR');
INSERT INTO `country` VALUES ('97','HU','Hungary');
INSERT INTO `country` VALUES ('98','IS','Iceland');
INSERT INTO `country` VALUES ('99','IN','India');
INSERT INTO `country` VALUES ('100','ID','Indonesia');
INSERT INTO `country` VALUES ('101','IR','Iran');
INSERT INTO `country` VALUES ('102','IQ','Iraq');
INSERT INTO `country` VALUES ('103','IE','Ireland');
INSERT INTO `country` VALUES ('104','IM','Isle of Man');
INSERT INTO `country` VALUES ('105','IL','Israel');
INSERT INTO `country` VALUES ('106','IT','Italy');
INSERT INTO `country` VALUES ('107','JM','Jamaica');
INSERT INTO `country` VALUES ('108','JP','Japan');
INSERT INTO `country` VALUES ('109','JE','Jersey');
INSERT INTO `country` VALUES ('110','JO','Jordan');
INSERT INTO `country` VALUES ('111','KZ','Kazakhstan');
INSERT INTO `country` VALUES ('112','KE','Kenya');
INSERT INTO `country` VALUES ('113','KI','Kiribati');
INSERT INTO `country` VALUES ('114','KR','Korea');
INSERT INTO `country` VALUES ('115','KW','Kuwait');
INSERT INTO `country` VALUES ('116','KG','Kyrgyzstan');
INSERT INTO `country` VALUES ('117','LA','Laos');
INSERT INTO `country` VALUES ('118','LV','Latvia');
INSERT INTO `country` VALUES ('119','LB','Lebanon');
INSERT INTO `country` VALUES ('120','LS','Lesotho');
INSERT INTO `country` VALUES ('121','LR','Liberia');
INSERT INTO `country` VALUES ('122','LY','Libya');
INSERT INTO `country` VALUES ('123','LI','Liechtenstein');
INSERT INTO `country` VALUES ('124','LT','Lithuania');
INSERT INTO `country` VALUES ('125','LU','Luxembourg');
INSERT INTO `country` VALUES ('126','MO','Macao SAR');
INSERT INTO `country` VALUES ('127','MK','Macedonia, Former Yugoslav Republic of');
INSERT INTO `country` VALUES ('128','MG','Madagascar');
INSERT INTO `country` VALUES ('129','MW','Malawi');
INSERT INTO `country` VALUES ('130','MY','Malaysia');
INSERT INTO `country` VALUES ('131','MV','Maldives');
INSERT INTO `country` VALUES ('132','ML','Mali');
INSERT INTO `country` VALUES ('133','MT','Malta');
INSERT INTO `country` VALUES ('134','MH','Marshall Islands');
INSERT INTO `country` VALUES ('135','MQ','Martinique');
INSERT INTO `country` VALUES ('136','MR','Mauritania');
INSERT INTO `country` VALUES ('137','MU','Mauritius');
INSERT INTO `country` VALUES ('138','YT','Mayotte');
INSERT INTO `country` VALUES ('139','MX','Mexico');
INSERT INTO `country` VALUES ('140','FM','Micronesia');
INSERT INTO `country` VALUES ('141','MD','Moldova');
INSERT INTO `country` VALUES ('142','MC','Monaco');
INSERT INTO `country` VALUES ('143','MN','Mongolia');
INSERT INTO `country` VALUES ('144','ME','Montenegro');
INSERT INTO `country` VALUES ('145','MS','Montserrat');
INSERT INTO `country` VALUES ('146','MA','Morocco');
INSERT INTO `country` VALUES ('147','MZ','Mozambique');
INSERT INTO `country` VALUES ('148','MM','Myanmar');
INSERT INTO `country` VALUES ('149','NA','Namibia');
INSERT INTO `country` VALUES ('150','NR','Nauru');
INSERT INTO `country` VALUES ('151','NP','Nepal');
INSERT INTO `country` VALUES ('152','NL','Netherlands');
INSERT INTO `country` VALUES ('153','AN','Netherlands Antilles');
INSERT INTO `country` VALUES ('154','NC','New Caledonia');
INSERT INTO `country` VALUES ('155','NZ','New Zealand');
INSERT INTO `country` VALUES ('156','NI','Nicaragua');
INSERT INTO `country` VALUES ('157','NE','Niger');
INSERT INTO `country` VALUES ('158','NG','Nigeria');
INSERT INTO `country` VALUES ('159','NU','Niue');
INSERT INTO `country` VALUES ('160','NF','Norfolk Island');
INSERT INTO `country` VALUES ('161','KP','North Korea');
INSERT INTO `country` VALUES ('162','MP','Northern Mariana Islands');
INSERT INTO `country` VALUES ('163','NO','Norway');
INSERT INTO `country` VALUES ('164','OM','Oman');
INSERT INTO `country` VALUES ('165','PK','Pakistan');
INSERT INTO `country` VALUES ('166','PW','Palau');
INSERT INTO `country` VALUES ('167','PS','Palestinian Authority');
INSERT INTO `country` VALUES ('168','PA','Panama');
INSERT INTO `country` VALUES ('169','PG','Papua New Guinea');
INSERT INTO `country` VALUES ('170','PY','Paraguay');
INSERT INTO `country` VALUES ('171','PE','Peru');
INSERT INTO `country` VALUES ('172','PH','Philippines');
INSERT INTO `country` VALUES ('173','PN','Pitcairn Islands');
INSERT INTO `country` VALUES ('174','PL','Poland');
INSERT INTO `country` VALUES ('175','PT','Portugal');
INSERT INTO `country` VALUES ('176','PR','Puerto Rico');
INSERT INTO `country` VALUES ('177','QA','Qatar');
INSERT INTO `country` VALUES ('178','RE','Reunion');
INSERT INTO `country` VALUES ('179','RO','Romania');
INSERT INTO `country` VALUES ('180','RU','Russia');
INSERT INTO `country` VALUES ('181','RW','Rwanda');
INSERT INTO `country` VALUES ('182','WS','Samoa');
INSERT INTO `country` VALUES ('183','SM','San Marino');
INSERT INTO `country` VALUES ('184','ST','São Tomé and Príncipe');
INSERT INTO `country` VALUES ('185','SA','Saudi Arabia');
INSERT INTO `country` VALUES ('186','SN','Senegal');
INSERT INTO `country` VALUES ('187','RS','Serbia');
INSERT INTO `country` VALUES ('188','SC','Seychelles');
INSERT INTO `country` VALUES ('189','SL','Sierra Leone');
INSERT INTO `country` VALUES ('190','SG','Singapore');
INSERT INTO `country` VALUES ('191','SK','Slovakia');
INSERT INTO `country` VALUES ('192','SI','Slovenia');
INSERT INTO `country` VALUES ('193','SB','Solomon Islands');
INSERT INTO `country` VALUES ('194','SO','Somalia');
INSERT INTO `country` VALUES ('195','ZA','South Africa');
INSERT INTO `country` VALUES ('196','GS','South Georgia and the South Sandwich Islands');
INSERT INTO `country` VALUES ('197','ES','Spain');
INSERT INTO `country` VALUES ('198','LK','Sri Lanka');
INSERT INTO `country` VALUES ('199','SH','St. Helena');
INSERT INTO `country` VALUES ('200','KN','St. Kitts and Nevis');
INSERT INTO `country` VALUES ('201','LC','St. Lucia');
INSERT INTO `country` VALUES ('202','PM','St. Pierre and Miquelon');
INSERT INTO `country` VALUES ('203','VC','St. Vincent and the Grenadines');
INSERT INTO `country` VALUES ('204','SD','Sudan');
INSERT INTO `country` VALUES ('205','SR','Suriname');
INSERT INTO `country` VALUES ('206','SJ','Svalbard and Jan Mayen');
INSERT INTO `country` VALUES ('207','SZ','Swaziland');
INSERT INTO `country` VALUES ('208','SE','Sweden');
INSERT INTO `country` VALUES ('209','CH','Switzerland');
INSERT INTO `country` VALUES ('210','SY','Syria');
INSERT INTO `country` VALUES ('211','TW','Taiwan');
INSERT INTO `country` VALUES ('212','TJ','Tajikistan');
INSERT INTO `country` VALUES ('213','TZ','Tanzania');
INSERT INTO `country` VALUES ('214','TH','Thailand');
INSERT INTO `country` VALUES ('215','TP','Timor-Leste (East Timor)');
INSERT INTO `country` VALUES ('216','TG','Togo');
INSERT INTO `country` VALUES ('217','TK','Tokelau');
INSERT INTO `country` VALUES ('218','TO','Tonga');
INSERT INTO `country` VALUES ('219','TT','Trinidad and Tobago');
INSERT INTO `country` VALUES ('220','TN','Tunisia');
INSERT INTO `country` VALUES ('221','TR','Turkey');
INSERT INTO `country` VALUES ('222','TM','Turkmenistan');
INSERT INTO `country` VALUES ('223','TC','Turks and Caicos Islands');
INSERT INTO `country` VALUES ('224','TV','Tuvalu');
INSERT INTO `country` VALUES ('225','UG','Uganda');
INSERT INTO `country` VALUES ('226','UA','Ukraine');
INSERT INTO `country` VALUES ('227','AE','United Arab Emirates');
INSERT INTO `country` VALUES ('228','UK','United Kingdom');
INSERT INTO `country` VALUES ('229','yes','United States');
INSERT INTO `country` VALUES ('230','UM','United States Minor Outlying Islands');
INSERT INTO `country` VALUES ('231','UY','Uruguay');
INSERT INTO `country` VALUES ('232','UZ','Uzbekistan');
INSERT INTO `country` VALUES ('233','VU','Vanuatu');
INSERT INTO `country` VALUES ('234','VA','Vatican City');
INSERT INTO `country` VALUES ('235','VE','Venezuela');
INSERT INTO `country` VALUES ('236','VN','Vietnam');
INSERT INTO `country` VALUES ('237','VG','Virgin Islands, British');
INSERT INTO `country` VALUES ('238','VI','Virgin Islands, U.S.');
INSERT INTO `country` VALUES ('239','WF','Wallis and Futuna');
INSERT INTO `country` VALUES ('240','YE','Yemen');
INSERT INTO `country` VALUES ('241','ZM','Zambia');
INSERT INTO `country` VALUES ('242','ZW','Zimbabwe');

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;


--
-- Export data for table `employees`
--

INSERT INTO `employees` VALUES ('1','Stanley','J.');
INSERT INTO `employees` VALUES ('2','Owen','David');
INSERT INTO `employees` VALUES ('3','Mathew','Randel');
INSERT INTO `employees` VALUES ('4','San','Andy');

--
-- Table structure for table `mails`
--

DROP TABLE IF EXISTS `mails`;
CREATE TABLE `mails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `c` (`email`),
  UNIQUE KEY `d` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


--
-- Export data for table `mails`
--

INSERT INTO `mails` VALUES ('1','tony','tony@africoders.com');

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first` varchar(255) NOT NULL,
  `last` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `variables`
--

DROP TABLE IF EXISTS `variables`;
CREATE TABLE `variables` (
  `vid` varchar(255) NOT NULL,
  `name` varchar(128) NOT NULL,
  `value` longtext NOT NULL,
  `scope` varchar(255) NOT NULL,
  UNIQUE KEY `vid` (`vid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;