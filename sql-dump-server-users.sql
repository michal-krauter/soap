CREATE TABLE IF NOT EXISTS `krauterusers` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `authority` enum('admin','user') COLLATE utf8_czech_ci NOT NULL DEFAULT 'user'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

ALTER TABLE `krauterusers` ADD PRIMARY KEY (`ID`);

INSERT INTO `krauterusers` (`ID`, `name`, `email`, `password`, `authority`) VALUES
(1, 'Michal Krauter', 'krauter@krauter.cz', '87878787', 'user'),
(2, 'Milan Test', 'test@test.cz', 'safasfas', 'user'),
(3, 'Jan Kříž', 'j.kriz@domena.cz', '489sdasfwfwwf', 'admin');