
-- --------------------------------------------------------

--
-- Table structure for table `linkref`
--

DROP TABLE IF EXISTS `linkref`;
CREATE TABLE `linkref` (
  `linkid` int(6) UNSIGNED NOT NULL,
  `label` varchar(100) DEFAULT NULL,
  `objecttype` varchar(10) NOT NULL,
  `objid` mediumint(9) NOT NULL,
  `path` varchar(200) DEFAULT NULL,
  `doctype` varchar(20) DEFAULT NULL,
  `sequence` tinyint(4) DEFAULT NULL,
  `contributor` varchar(40) DEFAULT NULL,
  `update_dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `linkref`
--

INSERT INTO `linkref` (`linkid`, `label`, `objecttype`, `objid`, `path`, `doctype`, `sequence`, `contributor`, `update_dt`) VALUES
(6, 'http://fflsas.org/index.php?option=com_content&view=article&id=55:priere-des-parachutistes-fr&catid=', 'person', 1606, 'http://fflsas.org/index.php?option=com_content&view=article&id=55:priere-des-parachutistes-fr&catid=39:documents-historiques&lang=fr', NULL, 99, 'paul golder', '2010-07-15 15:30:50'),
(7, 'http://fflsas.org/index.php?option=com_content&view=article&id=122%3Aappel-aux-francais-le-18-juin-1', 'event', 70, 'http://fflsas.org/index.php?option=com_content&view=article&id=122%3Aappel-aux-francais-le-18-juin-1940&catid=39%3Adocuments-historiques', NULL, 99, 'paul golder', '2010-07-16 10:46:31'),
(8, 'https://maps.google.fr/maps/ms?msa=0&msid=205151438022152364157.0004c5fabadfbd521e1fa&hl=fr&ie=UTF8&', 'event', 272, 'https://maps.google.fr/maps/ms?msa=0&msid=205151438022152364157.0004c5fabadfbd521e1fa&hl=fr&ie=UTF8&t=m&ll=52.83264,6.514893&spn=0.663737,0.958557&z=9&source=embed', NULL, 99, 'paul golder', '2012-11-06 10:11:26'),
(9, 'https://maps.google.fr/maps/ms?msid=205151438022152364157.0004cc6dc96153b049c87&msa=0&ll=48.286848,-', 'event', 120, 'https://maps.google.fr/maps/ms?msid=205151438022152364157.0004cc6dc96153b049c87&msa=0&ll=48.286848,-2.304382&spn=1.429177,2.469177&iwloc=0004cca93f60b2025d272', NULL, 99, 'David Portier', '2012-12-06 19:51:58'),
(10, 'https://maps.google.fr/maps/ms?msid=205151438022152364157.0004d00c0b5bf850e045e&msa=0', 'event', 162, 'https://maps.google.fr/maps/ms?msid=205151438022152364157.0004d00c0b5bf850e045e&msa=0', NULL, 99, 'David Portier', '2012-12-06 19:55:36'),
(19, 'Biographie de Jean LARRIEU, Jedburgh', 'person', 1623, '/url/60', NULL, NULL, NULL, '2020-04-03 09:46:26'),
(12, 'André LEMEE', 'person', 967, '/content/233', NULL, NULL, NULL, '2019-12-05 08:34:13'),
(13, 'René MENDIONDO', 'person', 1087, '/content/234', NULL, NULL, NULL, '2019-12-05 08:38:37'),
(14, 'Témoignage de Jean-Pierre LABORDERIE', 'event', 174, '/url/57', NULL, NULL, NULL, '2019-12-21 12:39:45'),
(15, 'Témoignage de R. Kehoe (Jed team Frederick)', 'event', 340, '/url/30', NULL, NULL, NULL, '2020-03-31 09:39:23'),
(16, 'Paul Carron de la Carrière (Jed team Gilbert)', 'event', 386, '/url/33', NULL, NULL, NULL, '2020-03-31 09:45:03'),
(17, 'Les SAS dans la Vienne', 'event', 407, '/url/34', NULL, NULL, NULL, '2020-03-31 09:48:25'),
(18, 'Les SAS dans la Vienne', 'event', 178, '/url/34', NULL, NULL, NULL, '2020-03-31 09:48:43'),
(20, 'Edgard TUPET THOME', 'person', 1527, '/content/236', NULL, NULL, NULL, '2020-04-19 20:08:32');
