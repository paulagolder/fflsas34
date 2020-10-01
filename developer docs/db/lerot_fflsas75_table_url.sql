
-- --------------------------------------------------------

--
-- Table structure for table `url`
--

DROP TABLE IF EXISTS `url`;
CREATE TABLE `url` (
  `id` int(11) NOT NULL,
  `url` varchar(200) NOT NULL,
  `label` varchar(200) NOT NULL,
  `tags` varchar(20) DEFAULT NULL,
  `visits` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `url`
--

INSERT INTO `url` (`id`, `url`, `label`, `tags`, `visits`) VALUES
(2, 'http://www.resistance-bretonne.com/', 'Musée de Saint-Marcel', 'TAG75', 209),
(3, 'http://marsandminerva.co.uk/', 'Official Website of the SAS Regiment Association', 'TAG75', 208),
(4, 'https://www.defense.gouv.fr/fre/terre/l-armee-de-terre/le-niveau-divisionnaire/commandement-des-forces-speciales-terre/1er-regiment-de-parachutistes-d-infanterie-de-marine', 'Le 1er RPIMa', 'TAG75', 183),
(5, 'http://www.quiosegagne.asso.fr/', 'Amicale Qui Ose Gagne', 'TAG75', 283),
(6, 'http://le.cos.free.fr/accueil.htm', 'Le COS', 'TAG75', 173),
(7, 'http://www.servicehistorique.sga.defense.gouv.fr/', 'Service Historique de la Défense', 'TAG75', 202),
(8, 'http://www.memoiredeshommes.sga.defense.gouv.fr/?page=mpf3945_recherche', 'Mémoire des Hommes', 'TAG73', 206),
(9, 'http://www.nationalarchives.gov.uk/catalogue/default.asp?j=1', 'The National Archives', 'TAG75', 193),
(10, 'http://secretdefense.blogs.liberation.fr/defense/', 'Blog Secret Défense', 'TAG75', 169),
(11, 'http://lemamouth.blogspot.com/', 'Blog Le Mamouth', 'TAG75', 166),
(12, 'http://philippe.chapill.pagesperso-orange.fr/index.htm', 'Matériels de parachutage', 'TAG73', 246),
(13, 'http://www.soldatsdefrance.fr/', 'Soldats de France', 'TAG75', 169),
(14, 'http://www.39-45.org/portailv2/news/news.php', '39/45 Le Monde en Guerre', 'TAG74', 214),
(17, 'http://www.6juin1944.com/', 'Forum D Day: état des lieux', 'TAG74', 195),
(18, 'http://www.dday-overlord.com/forums.htm', 'Site D Day Overlord', 'TAG74', 280),
(19, 'http://www.secondeguerre.net', 'Seconde guerre . Net', 'TAG74', 156),
(20, 'http://maquisardsdefrance.jeun.fr/', 'Maquisards de France', 'TAG74', 207),
(21, 'http://www.france-libre.net/', 'La Fondation de la France libre', 'TAG71', 458),
(22, 'https://www.ordredelaliberation.fr/fr', 'L\'Ordre de la Libération', 'TAG71', 330),
(23, 'http://www.francaislibres.net/', 'Histoires de Français Libres', 'TAG71', 459),
(24, 'http://adrienhb.free.fr/Hollande/', 'Photos souvenirs Amherst avril 2005', 'TAG72', 970),
(26, 'http://www.brigade-piron.be/paras-cdo/zy-Parachutistes_en.html', 'Belgian SAS', 'TAG72', 400),
(27, 'http://www.onderscheidingen.nl/decorandi/wo2/f.html', 'Décorations Néerlandaises', 'TAG72', 505),
(30, 'https://www.cia.gov/library/center-for-the-study-of-intelligence/csi-publications/csi-studies/studies/winter98_99/art03.html', 'Témoignage de R. Kehoe (Jed team Frederick)', 'TAG73', 452),
(31, 'http://largo-area-cc.org.uk/', 'Largo community', 'TAG75', 487),
(32, 'http://www.inverlochycastlehotel.com/', 'Inverlochy Castle', 'TAG75', 283),
(33, 'https://www.norrac.com/jedburgh.html', 'Paul Carron de la Carrière (Jed team Gilbert)', 'TAG73', 350),
(34, 'https://www.vrid-memorial.com/articles/?_sft_sujets=les-s-a-s-special-air-service', 'Les SAS dans la Vienne', 'TAG72', 694),
(35, 'http://www.resistance-deportation.org/spip.php?article59', 'L\'opération Loyton', 'TAG72', 311),
(37, 'https://www.photo.rmn.fr/CS.aspx?VP3=SearchResult&VBID=2CMFCIXKS9YDN&SMLS=1&RW=1920&RH=944', 'Photos souvenirs d\'Alain de Kerillis', 'TAG72', 451),
(39, 'http://www.raf38group.org/', 'RAF 38th Group', 'TAG75', 176),
(41, 'http://www.osssociety.org/', 'OSS Society', 'TAG73', 170),
(42, 'http://www.specialforcesroh.com/browse.php', 'Special Forces ROH', 'TAG72', 172),
(43, 'http://www.plan-sussex-1944.net/', 'Plan Sussex', 'TAG73', 1252),
(44, 'http://www.memoresist.org/', 'Mémoire Espoirs de la Résistance', 'TAG73', 185),
(46, 'http://www.fondationresistance.org/pages/accueil/', 'Fondation de la Résistance', 'TAG73', 173),
(47, 'http://www.cndp.fr/crdp-reims/memoire/', 'Histoire et Mémoire CRDP Reims', 'TAG73', 197),
(55, 'http://www.afpsas.fr/', 'L\'Association des Familles des Parachutistes SAS de la France libre', 'TAG72', 99),
(56, 'http://fflsas.org/fr/mailto', 'contactez nous', 'admin', NULL),
(57, 'http://memoires-resistances.dordogne.fr/temoignages-audio/1015-extraits-sonores/59-parachutages-en-dordogne.html', 'Témoignage de Jean-Pierre LABORDERIE', 'TAG72', NULL),
(58, 'http://museedelaresistanceenligne.org/media5755-OpA', 'Mission GAFF', 'TAG72', NULL),
(60, 'https://fr.wikipedia.org/wiki/Jean_Larrieu_(militaire)', 'Biographie de Jean LARRIEU, Jedburgh', 'TAG73', NULL);
