-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 05. Jan 2016 um 16:06
-- Server-Version: 10.0.17-MariaDB
-- PHP-Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `paul`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `accounts`
--

CREATE TABLE `accounts` (
  `ID` int(11) NOT NULL,
  `username` char(20) NOT NULL,
  `passwort` varchar(300) NOT NULL,
  `email` char(50) NOT NULL,
  `name` char(20) DEFAULT NULL,
  `website` char(100) DEFAULT NULL,
  `activation` char(50) DEFAULT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `accounts`
--

INSERT INTO `accounts` (`ID`, `username`, `passwort`, `email`, `name`, `website`, `activation`, `active`) VALUES
(1, 'user1', '$2y$10$3w.1RUCt3XdI0n.5sKLH0.IGLbkYCXp3frhfUAnVv9uQZJBAp.adG', 'org1@test.de', 'orga1', NULL, 'j17(QUCj)IoZ=nv', 1),
(2, 'user2', '$2y$10$pRJw7mTNA0ToI7D6PP48T.ljF7dU.K7OClK64Ma9Gyr7FtcQJMhIy', 'priv1@test.de', 'priv1', NULL, '5W.hH(ZEn!et3(y', 1),
(3, 'reg_Test', '$2y$10$Mj8VvjH0QhQ9fvc95YvaBecDp93dMuMVBNK3uu6prEMvjN9xcviQS', 'reg@test.de', 'Reg Test', NULL, 'QozRzqfz6bkGxkx', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `countries`
--

CREATE TABLE `countries` (
  `ID` int(11) NOT NULL,
  `abbreviation` char(6) NOT NULL,
  `countryName` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `countries`
--

INSERT INTO `countries` (`ID`, `abbreviation`, `countryName`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'EG', 'Ägypten'),
(3, 'AL', 'Albanien'),
(4, 'DZ', 'Algerien'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarktis'),
(9, 'AG', 'Antigua und Barbuda'),
(10, 'GQ', 'Äquatorial Guinea'),
(11, 'AR', 'Argentinien'),
(12, 'AM', 'Armenien'),
(13, 'AW', 'Aruba'),
(14, 'AZ', 'Aserbaidschan'),
(15, 'ET', 'Äthiopien'),
(16, 'AU', 'Australien'),
(17, 'BS', 'Bahamas'),
(18, 'BH', 'Bahrain'),
(19, 'BD', 'Bangladesh'),
(20, 'BB', 'Barbados'),
(21, 'BE', 'Belgien'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermudas'),
(25, 'BT', 'Bhutan'),
(26, 'MM', 'Birma'),
(27, 'BO', 'Bolivien'),
(28, 'BA', 'Bosnien-Herzegowina'),
(29, 'BW', 'Botswana'),
(30, 'BV', 'Bouvet Inseln'),
(31, 'BR', 'Brasilien'),
(32, 'IO', 'Britisch-Indischer O'),
(33, 'BN', 'Brunei'),
(34, 'BG', 'Bulgarien'),
(35, 'BF', 'Burkina Faso'),
(36, 'BI', 'Burundi'),
(37, 'CL', 'Chile'),
(38, 'CN', 'China'),
(39, 'CX', 'Christmas Island'),
(40, 'CK', 'Cook Inseln'),
(41, 'CR', 'Costa Rica'),
(42, 'DK', 'Dänemark'),
(43, 'DE', 'Deutschland'),
(44, 'DJ', 'Djibuti'),
(45, 'DM', 'Dominika'),
(46, 'DO', 'Dominikanische Repub'),
(47, 'EC', 'Ecuador'),
(48, 'SV', 'El Salvador'),
(49, 'CI', 'Elfenbeinküste'),
(50, 'ER', 'Eritrea'),
(51, 'EE', 'Estland'),
(52, 'FK', 'Falkland Inseln'),
(53, 'FO', 'Färöer Inseln'),
(54, 'FJ', 'Fidschi'),
(55, 'FI', 'Finnland'),
(56, 'FR', 'Frankreich'),
(57, 'GF', 'Französisch Guyana'),
(58, 'PF', 'Französisch Polynesi'),
(59, 'TF', 'Französisches Süd-Te'),
(60, 'GA', 'Gabun'),
(61, 'GM', 'Gambia'),
(62, 'GE', 'Georgien'),
(63, 'GH', 'Ghana'),
(64, 'GI', 'Gibraltar'),
(65, 'GD', 'Grenada'),
(66, 'GR', 'Griechenland'),
(67, 'GL', 'Grönland'),
(68, 'UK', 'Großbritannien'),
(69, 'GP', 'Guadeloupe'),
(70, 'GU', 'Guam'),
(71, 'GT', 'Guatemala'),
(72, 'GN', 'Guinea'),
(73, 'GW', 'Guinea Bissau'),
(74, 'GY', 'Guyana'),
(75, 'HT', 'Haiti'),
(76, 'HM', 'Heard und McDonald I'),
(77, 'HN', 'Honduras'),
(78, 'HK', 'Hong Kong'),
(79, 'IN', 'Indien'),
(80, 'ID', 'Indonesien'),
(81, 'IQ', 'Irak'),
(82, 'IR', 'Iran'),
(83, 'IE', 'Irland'),
(84, 'IS', 'Island'),
(85, 'IL', 'Israel'),
(86, 'IT', 'Italien'),
(87, 'JM', 'Jamaika'),
(88, 'JP', 'Japan'),
(89, 'YE', 'Jemen'),
(90, 'JO', 'Jordanien'),
(91, 'YU', 'Jugoslawien'),
(92, 'KY', 'Kaiman Inseln'),
(93, 'KH', 'Kambodscha'),
(94, 'CM', 'Kamerun'),
(95, 'CA', 'Kanada'),
(96, 'CV', 'Kap Verde'),
(97, 'KZ', 'Kasachstan'),
(98, 'KE', 'Kenia'),
(99, 'KG', 'Kirgisistan'),
(100, 'KI', 'Kiribati'),
(101, 'CC', 'Kokosinseln'),
(102, 'CO', 'Kolumbien'),
(103, 'KM', 'Komoren'),
(104, 'CG', 'Kongo'),
(105, 'CD', 'Kongo, Demokratische'),
(106, 'HR', 'Kroatien'),
(107, 'CU', 'Kuba'),
(108, 'KW', 'Kuwait'),
(109, 'LA', 'Laos'),
(110, 'LS', 'Lesotho'),
(111, 'LV', 'Lettland'),
(112, 'LB', 'Libanon'),
(113, 'LR', 'Liberia'),
(114, 'LY', 'Libyen'),
(115, 'LI', 'Liechtenstein'),
(116, 'LT', 'Litauen'),
(117, 'LU', 'Luxemburg'),
(118, 'MO', 'Macao'),
(119, 'MG', 'Madagaskar'),
(120, 'MW', 'Malawi'),
(121, 'MY', 'Malaysia'),
(122, 'MV', 'Malediven'),
(123, 'ML', 'Mali'),
(124, 'MT', 'Malta'),
(125, 'MP', 'Marianen'),
(126, 'MA', 'Marokko'),
(127, 'MH', 'Marshall Inseln'),
(128, 'MQ', 'Martinique'),
(129, 'MR', 'Mauretanien'),
(130, 'MU', 'Mauritius'),
(131, 'YT', 'Mayotte'),
(132, 'MK', 'Mazedonien'),
(133, 'MX', 'Mexiko'),
(134, 'FM', 'Mikronesien'),
(135, 'MZ', 'Mocambique'),
(136, 'MD', 'Moldavien'),
(137, 'MC', 'Monaco'),
(138, 'MN', 'Mongolei'),
(139, 'MS', 'Montserrat'),
(140, 'NA', 'Namibia'),
(141, 'NR', 'Nauru'),
(142, 'NP', 'Nepal'),
(143, 'NC', 'Neukaledonien'),
(144, 'NZ', 'Neuseeland'),
(145, 'NI', 'Nicaragua'),
(146, 'NL', 'Niederlande'),
(147, 'AN', 'Niederländische Anti'),
(148, 'NE', 'Niger'),
(149, 'NG', 'Nigeria'),
(150, 'NU', 'Niue'),
(151, 'KP', 'Nord Korea'),
(152, 'NF', 'Norfolk Inseln'),
(153, 'NO', 'Norwegen'),
(154, 'OM', 'Oman'),
(155, 'AT', 'Österreich'),
(156, 'PK', 'Pakistan'),
(157, 'PS', 'Palästina'),
(158, 'PW', 'Palau'),
(159, 'PA', 'Panama'),
(160, 'PG', 'Papua Neuguinea'),
(161, 'PY', 'Paraguay'),
(162, 'PE', 'Peru'),
(163, 'PH', 'Philippinen'),
(164, 'PN', 'Pitcairn'),
(165, 'PL', 'Polen'),
(166, 'PT', 'Portugal'),
(167, 'PR', 'Puerto Rico'),
(168, 'QA', 'Qatar'),
(169, 'RE', 'Reunion'),
(170, 'RW', 'Ruanda'),
(171, 'RO', 'Rumänien'),
(172, 'RU', 'Rußland'),
(173, 'LC', 'Saint Lucia'),
(174, 'ZM', 'Sambia'),
(175, 'AS', 'Samoa'),
(176, 'SM', 'San Marino'),
(177, 'ST', 'Sao Tome'),
(178, 'SA', 'Saudi Arabien'),
(179, 'SE', 'Schweden'),
(180, 'CH', 'Schweiz'),
(181, 'SN', 'Senegal'),
(182, 'SC', 'Seychellen'),
(183, 'SL', 'Sierra Leone'),
(184, 'SG', 'Singapur'),
(185, 'SK', 'Slowakei'),
(186, 'SI', 'Slowenien'),
(187, 'SB', 'Solomon Inseln'),
(188, 'SO', 'Somalia'),
(189, 'GS', 'South Georgia, South'),
(190, 'ES', 'Spanien'),
(191, 'LK', 'Sri Lanka'),
(192, 'SH', 'St. Helena'),
(193, 'KN', 'St. Kitts Nevis Angu'),
(194, 'PM', 'St. Pierre und Mique'),
(195, 'VC', 'St. Vincent'),
(196, 'KR', 'Süd Korea'),
(197, 'ZA', 'Südafrika'),
(198, 'SD', 'Sudan'),
(199, 'SR', 'Surinam'),
(200, 'SJ', 'Svalbard und Jan May'),
(201, 'SZ', 'Swasiland'),
(202, 'SY', 'Syrien'),
(203, 'TJ', 'Tadschikistan'),
(204, 'TW', 'Taiwan'),
(205, 'TZ', 'Tansania'),
(206, 'TH', 'Thailand'),
(207, 'TP', 'Timor'),
(208, 'TG', 'Togo'),
(209, 'TK', 'Tokelau'),
(210, 'TO', 'Tonga'),
(211, 'TT', 'Trinidad Tobago'),
(212, 'TD', 'Tschad'),
(213, 'CZ', 'Tschechische Republi'),
(214, 'TN', 'Tunesien'),
(215, 'TR', 'Türkei'),
(216, 'TM', 'Turkmenistan'),
(217, 'TC', 'Turks und Kaikos Ins'),
(218, 'TV', 'Tuvalu'),
(219, 'UG', 'Uganda'),
(220, 'UA', 'Ukraine'),
(221, 'HU', 'Ungarn'),
(222, 'UY', 'Uruguay'),
(223, 'UZ', 'Usbekistan'),
(224, 'VU', 'Vanuatu'),
(225, 'VA', 'Vatikan'),
(226, 'VE', 'Venezuela'),
(227, 'AE', 'Vereinigte Arabische'),
(228, 'US', 'Vereinigte countries'),
(229, 'VN', 'Vietnam'),
(230, 'VG', 'Virgin Island (Brit.'),
(231, 'VI', 'Virgin Island (USA)'),
(232, 'WF', 'Wallis et Futuna'),
(233, 'BY', 'Weissrussland'),
(234, 'EH', 'Westsahara'),
(235, 'CF', 'Zentralafrikanische'),
(236, 'ZW', 'Zimbabwe'),
(237, 'CY', 'Zypern');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `deliverer_offer`
--

CREATE TABLE `deliverer_offer` (
  `ID` int(11) NOT NULL,
  `offerer` char(50) NOT NULL,
  `eMail` char(50) NOT NULL,
  `startCountry` int(11) NOT NULL,
  `startVillage` char(50) NOT NULL,
  `destinationCountry` int(11) NOT NULL,
  `destinationVillage` char(50) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `responsibleAcc` int(11) NOT NULL,
  `textField` varchar(3500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `organisation_offer`
--

CREATE TABLE `organisation_offer` (
  `ID` int(11) NOT NULL,
  `offerer` char(50) NOT NULL,
  `contact` char(50) DEFAULT NULL,
  `eMail` char(50) NOT NULL,
  `startCountry` int(11) NOT NULL,
  `startVillage` char(50) NOT NULL,
  `destinationCountry` int(11) NOT NULL,
  `destinationVillage` char(50) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `responsibleAcc` int(11) NOT NULL,
  `textField` varchar(3500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `productname` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`ID`, `productname`) VALUES
(1, 'Medizin'),
(2, 'Nahrungsmittel'),
(3, 'PAUL'),
(4, 'Sonstiges');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `productsdelivererjoin`
--

CREATE TABLE `productsdelivererjoin` (
  `ID_product` int(11) NOT NULL DEFAULT '0',
  `ID_delivererOffer` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `productsorgajoin`
--

CREATE TABLE `productsorgajoin` (
  `ID_product` int(11) NOT NULL DEFAULT '0',
  `ID_organisationOffer` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indizes für die Tabelle `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `abbreviation` (`abbreviation`),
  ADD UNIQUE KEY `countryName` (`countryName`);

--
-- Indizes für die Tabelle `deliverer_offer`
--
ALTER TABLE `deliverer_offer`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `startCountry` (`startCountry`),
  ADD KEY `destinationCountry` (`destinationCountry`),
  ADD KEY `responsibleAcc` (`responsibleAcc`);

--
-- Indizes für die Tabelle `organisation_offer`
--
ALTER TABLE `organisation_offer`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `startCountry` (`startCountry`),
  ADD KEY `destinationCountry` (`destinationCountry`),
  ADD KEY `responsibleAcc` (`responsibleAcc`);

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `productname` (`productname`);

--
-- Indizes für die Tabelle `productsdelivererjoin`
--
ALTER TABLE `productsdelivererjoin`
  ADD PRIMARY KEY (`ID_product`,`ID_delivererOffer`),
  ADD KEY `ID_delivererOffer` (`ID_delivererOffer`);

--
-- Indizes für die Tabelle `productsorgajoin`
--
ALTER TABLE `productsorgajoin`
  ADD PRIMARY KEY (`ID_product`,`ID_organisationOffer`),
  ADD KEY `ID_organisationOffer` (`ID_organisationOffer`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `accounts`
--
ALTER TABLE `accounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `countries`
--
ALTER TABLE `countries`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;
--
-- AUTO_INCREMENT für Tabelle `deliverer_offer`
--
ALTER TABLE `deliverer_offer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `organisation_offer`
--
ALTER TABLE `organisation_offer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `deliverer_offer`
--
ALTER TABLE `deliverer_offer`
  ADD CONSTRAINT `deliverer_offer_ibfk_1` FOREIGN KEY (`startCountry`) REFERENCES `countries` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `deliverer_offer_ibfk_2` FOREIGN KEY (`destinationCountry`) REFERENCES `countries` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `deliverer_offer_ibfk_3` FOREIGN KEY (`responsibleAcc`) REFERENCES `accounts` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `organisation_offer`
--
ALTER TABLE `organisation_offer`
  ADD CONSTRAINT `organisation_offer_ibfk_1` FOREIGN KEY (`startCountry`) REFERENCES `countries` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `organisation_offer_ibfk_2` FOREIGN KEY (`destinationCountry`) REFERENCES `countries` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `organisation_offer_ibfk_3` FOREIGN KEY (`responsibleAcc`) REFERENCES `accounts` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `productsdelivererjoin`
--
ALTER TABLE `productsdelivererjoin`
  ADD CONSTRAINT `productsdelivererjoin_ibfk_1` FOREIGN KEY (`ID_product`) REFERENCES `products` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productsdelivererjoin_ibfk_2` FOREIGN KEY (`ID_delivererOffer`) REFERENCES `deliverer_offer` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `productsorgajoin`
--
ALTER TABLE `productsorgajoin`
  ADD CONSTRAINT `productsorgajoin_ibfk_1` FOREIGN KEY (`ID_product`) REFERENCES `products` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productsorgajoin_ibfk_2` FOREIGN KEY (`ID_organisationOffer`) REFERENCES `organisation_offer` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
