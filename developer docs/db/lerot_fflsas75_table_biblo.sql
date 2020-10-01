
-- --------------------------------------------------------

--
-- Table structure for table `biblo`
--

DROP TABLE IF EXISTS `biblo`;
CREATE TABLE `biblo` (
  `bookid` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET latin1 NOT NULL,
  `subtitle` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `author` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `publisher` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `year` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `ISBN` varchar(40) CHARACTER SET latin1 DEFAULT NULL,
  `tags` varchar(40) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `biblo`
--

INSERT INTO `biblo` (`bookid`, `title`, `subtitle`, `author`, `publisher`, `year`, `ISBN`, `tags`) VALUES
(1, 'Remember', 'les parachutistes de la France Libre - 40 à 43', 'Raymond Forgeat', 'Service historique', '1990.', 'ISBN 2-86323-064-6', 'BTAG01'),
(3, 'Qui ose gagne', ' les parachutistes du 2ème R.C.P. « France-Belgique 1943-1945 »', ' Henri Corta, Noël Créau, Philippe Reinhart', ' Service historique ', ' 1997', ' ISBN 2-86323-103-0 ', 'BTAG01'),
(5, 'Qui ose gagne', ' les parachutistes de la France Libre 3ème S.A.S « Grande Bretagne-France 1943-1944 »', ' Roger Flamand', ' Service historique ', ' 1998', ' ISBN 2-907-341-63-3', 'BTAG01'),
(6, 'Amherst', 'les parachutistes de la France Libre 3e et 4e S.A.S « Hollande 1945 »', 'Roger Flamand', 'Atlante Editions', 'Paris 1998', 'ISBN 2-912671-05-1', 'BTAG01'),
(7, 'Aux carrefours de la guerre', 'x', 'P.-A. Léger', 'Editions Albin Michel', 'Paris 13 avril 1983', 'ISBN-13: 978-2226017642', 'BTAG01'),
(8, 'Du maquis aux parachutistes SAS', ' ', '  J. Quillet ', ' Atlante éditions ', ' 2008', '', 'BTAG03'),
(9, 'Emile Bouétard', ' caporal dans les Free French Paratroops', '  F. Souquet ', ' Edition d\'auteur', '  2006', '', 'BTAG03'),
(10, 'Feux et lumières sur ma trace', ' ', '   P. Chateau-Jobert ', ' Edition d\'auteur ', ' 1988', '', 'BTAG01'),
(11, 'Ils ont choisi de vivre la France Libre', ' ', ' R. Forgeat ', ' Atlante Editions ', ' Paris 1999 ', 'ISBN 2-912671-10-8', 'BTAG01'),
(12, 'J\'ai choisi la tempête ', '  ', '  M. Chamming\'s ', ' Editions France-Emp', '  Paris 1965 - 1985', '', 'BTAG03'),
(13, 'La liberté tombée du ciel', ' ', '  H. Déplante ', ' Editions Ramsay', ' Paris 1977', ' ISBN 02-85956-015-7', 'BTAG01'),
(14, 'La rage au coeur ', ' ', '  p J. Paulin ', ' Librairie Damidot', ' Dijon 1948', '', 'BTAG01'),
(15, 'Le refus de la honte', ' ', '  R. Hourdin ', ' Mémoires et Culture', ' 2005', '', 'BTAG01'),
(16, 'Les bérets rouges', ' ', ' H. Corta ', ' Edition de l\'Amical', ' Paris 1952', '', 'BTAG01'),
(17, 'Les compagnons du clair de lune ', ' ', '  H. Déplante ', ' Edition d\'auteur ', ' 1984', '', 'BTAG01'),
(18, 'Les Parachutistes SAS de la France libre', '', 'D. Portier', 'Edition Nimrod', '2011', '', 'BTAG01'),
(19, 'L\'Inconnu du french squadron ', ' ', '  R. Flamand ', 'Edition d\'auteur ', ' 1983', '', 'BTAG01'),
(20, 'Ma guerre à seize ans ', ' ', '  par L. Neuwirth ', ' Editions Plon ', ' Paris 1986', '', 'BTAG03'),
(21, 'Paras calédoniens de la France Libre ', ' ', ' P. Robineau ', ' Les Editions du Cag', ' Nouméa 1989', '', 'BTAG01'),
(22, 'Paras de la France Libre ', ' ', ' R. Flamand  ', 'Presses de la cité', ' Paris 1976', ' ISBN 2-258-00036-X', 'BTAG01'),
(23, 'Qui ose vaincra ', ' ', '   P Bonnecarrère ', ' Editions Fayard ', ' Paris 1971', '  ISBN 20253-01011-1', 'BTAG01'),
(24, 'Special Air Service', ' ', '  E. Thomé ', ' Editions Grasset', ' Paris 1980', '', 'BTAG01'),
(29, 'Victor Iturria, un héros Basque.', '', 'Catherine Marchand', 'Editions Kilika', '2016?', '', 'BTAG03');
