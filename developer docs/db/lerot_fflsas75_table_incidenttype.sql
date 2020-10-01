
-- --------------------------------------------------------

--
-- Table structure for table `incidenttype`
--

DROP TABLE IF EXISTS `incidenttype`;
CREATE TABLE `incidenttype` (
  `itypeid` int(11) NOT NULL,
  `label` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `incidenttype`
--

INSERT INTO `incidenttype` (`itypeid`, `label`) VALUES
(1, 'tué'),
(2, 'blessé'),
(3, 'capturé'),
(4, 'accidenté'),
(5, 'mort'),
(6, 'parachuté'),
(7, 'noyé'),
(8, 'évadé'),
(9, 'exécuté'),
(10, 'blessé2'),
(11, 'disparu'),
(12, 'capturé à nouveau'),
(13, 'parachuté à nouveau'),
(14, 'libéré'),
(15, 'rejoint'),
(16, 'souffrant'),
(17, 'transféré'),
(18, 'déporté'),
(19, 'mission'),
(20, 'rentré'),
(21, 'retourné'),
(22, 'devenu malade'),
(23, 'muté'),
(26, 'Détaché');
