-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 11, 2019 at 04:37 PM
-- Server version: 10.3.20-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gopa9677_fflsas75`
--

--
-- Truncate table before insert `label`
--

TRUNCATE TABLE `label`;
--
-- Dumping data for table `label`
--

INSERT INTO `label` (`id`, `tag`, `lang`, `mode`, `text`) VALUES
(1, '.alias', 'fr', 'message', 'Alias'),
(3, '.endroit', 'fr', 'message', 'endroit'),
(4, '.forename', 'fr', 'message', 'Prénom'),
(5, '.surname', 'fr', 'message', 'Nom'),
(6, 'toutes.endroits', 'fr', 'message', 'Tous endroits'),
(7, '.accueil', 'fr', 'message', 'Accueil'),
(8, 'add.new.linkref', 'fr', 'message', 'Créer un lien'),
(9, 'add.participation', 'fr', 'message', 'Ajouter une participation'),
(10, 'add.text', 'fr', 'message', 'Ajouter nouveau texte'),
(11, 'admin.content', 'fr', 'message', 'Gérer Contenu'),
(12, 'admin.images', 'fr', 'message', 'Gérer Images'),
(13, 'admin.locations', 'fr', 'message', 'Gérer Locations'),
(14, 'admin.allusers', 'fr', 'message', 'Gérer Utilisateurs'),
(15, '.annuler', 'fr', 'message', 'Annuler'),
(16, 'at.place', 'fr', 'message', 'à'),
(17, '.at', 'fr', 'message', 'à'),
(18, 'bienvenue.page', 'fr', 'message', 'Bienvenue'),
(19, 'bienvenue.site', 'fr', 'message', 'Bienvenue sur le site des FFLSAS'),
(20, 'bienvenue.visiteur', 'fr', 'message', 'Bienvenue visiteur'),
(21, '.bienvenue', 'fr', 'message', 'Bienvenue'),
(24, 'bookmark.event', 'fr', 'message', 'signet'),
(25, 'bookmark.person', 'fr', 'message', 'signet'),
(26, '.bookmark', 'fr', 'message', 'signet'),
(27, '.bookmarks', 'fr', 'message', 'signets'),
(28, 'chercher.site', 'fr', 'message', 'Chercher dans la Base de Donnees'),
(29, '.chercher', 'fr', 'message', 'Chercher'),
(30, 'child.of', 'fr', 'message', 'Enfant de'),
(31, 'enfants.evenment', 'fr', 'message', 'sous évènements'),
(32, '.comment', 'fr', 'message', 'Commentaire'),
(33, 'compte.de', 'fr', 'message', 'Compte des'),
(34, 'contact.us', 'fr', 'message', 'Nous envoyer un message ou poser une question'),
(35, 'contactez.nous', 'fr', 'message', 'Contactez Nous'),
(36, 'create.incident', 'fr', 'message', 'Créer un incident'),
(37, 'create.newperson', 'fr', 'message', 'Créer un Homme'),
(38, 'create.this', 'fr', 'message', 'Créer ceci'),
(39, '.delete', 'fr', 'message', 'Supprimer'),
(40, '.during', 'fr', 'message', 'pendant'),
(41, 'edit.content', 'fr', 'message', 'éditer'),
(42, 'edit.detail', 'fr', 'message', 'éditer le détail'),
(43, 'edit.event.detail', 'fr', 'message', 'éditer le détail'),
(44, 'edit.event.new', 'fr', 'message', 'Créer nouvel évènement'),
(45, 'edit.event', 'fr', 'message', 'éditer évènement'),
(46, 'edit.image', 'fr', 'message', 'éditer'),
(47, 'edit.images', 'fr', 'message', 'éditer images'),
(48, 'edit.incident', 'fr', 'message', 'éditer incident'),
(49, 'edit.links.for', 'fr', 'message', 'éditer les liens de'),
(50, 'edit.location', 'fr', 'message', 'éditer l\'endroit'),
(51, 'edit.participation', 'fr', 'message', 'éditer'),
(52, 'edit.participations', 'fr', 'message', 'éditer'),
(53, 'edit.person', 'fr', 'message', 'éditer'),
(54, 'edit.refs', 'fr', 'message', 'éditer'),
(55, 'edit.text', 'fr', 'message', 'éditer les textes'),
(56, 'edit.texts', 'fr', 'message', 'éditer les textes'),
(57, 'edit.this', 'fr', 'message', 'éditer'),
(58, '.edit', 'fr', 'message', 'éditer'),
(59, '.email', 'fr', 'message', 'Adresse email'),
(61, '.enregister', 'fr', 'message', 'S\'enregistrer sur le site'),
(62, '.enregistrement', 'fr', 'message', 'Enregistrer'),
(63, '.enregistrer', 'fr', 'message', 'Enregister'),
(64, 'entrez.chercher', 'fr', 'message', 'Entrez le mot à chercher'),
(65, '.evenment', 'fr', 'message', 'Evènement'),
(66, 'evenment.enfants', 'fr', 'message', 'Sous-évènement'),
(67, '.evenments', 'fr', 'message', 'Evènements'),
(68, 'event.a.editer', 'fr', 'message', 'évènement à editer'),
(69, '.event', 'fr', 'message', 'Evènement'),
(70, 'event.links', 'fr', 'message', 'Liens aux évènements'),
(71, '.events', 'fr', 'message', 'Evenements'),
(72, 'found.too.many', 'fr', 'message', 'Trop trouver'),
(73, '.found', 'fr', 'message', 'Retrouvé'),
(74, 'he.was', 'fr', 'message', 'il a été'),
(75, '.homme', 'fr', 'message', 'Homme'),
(76, '.hommes', 'fr', 'message', 'Hommes'),
(77, 'image.chance', 'fr', 'message', 'Image au hasard'),
(78, '.images', 'fr', 'message', 'Images'),
(79, 'incident.rank', 'fr', 'message', 'avec le grade de'),
(80, 'incident.role', 'fr', 'message', 'rôle'),
(81, 'incident.to', 'fr', 'message', 'Incident dans le parcours de'),
(82, '.incidents', 'fr', 'message', 'Incidents'),
(83, '.introduction', 'fr', 'message', 'Introduction'),
(84, '.latitude', 'fr', 'message', 'latitudefr'),
(85, 'les.actions', 'fr', 'message', 'Les Actions'),
(86, 'les.hommes', 'fr', 'message', 'Les Hommes'),
(87, 'liens.a', 'fr', 'message', 'Liens a'),
(88, '.liens', 'fr', 'message', 'Liens'),
(89, 'location.a.editer', 'fr', 'message', 'Editer Location'),
(90, 'location.name', 'fr', 'message', 'Nom'),
(91, 'log.in', 'fr', 'message', 'S\'identifier'),
(92, 'log.out', 'fr', 'message', 'Se déconnecter'),
(275, 'login.message', 'fr', 'message', 'Pour accéder à notre site, identifiez-vous'),
(276, 'mail.us', 'fr', 'message', 'Nous envoyer un message'),
(277, '.message', 'fr', 'message', 'Message'),
(278, '.name', 'fr', 'message', 'Name'),
(279, 'new.content', 'fr', 'message', 'Nouveau contenu'),
(280, 'new.image', 'fr', 'message', 'Nouvelle Image'),
(281, 'new.location', 'fr', 'message', 'Nouvel endroit'),
(282, 'new.person', 'fr', 'message', 'Créer un nouveau homme'),
(283, 'no.text', 'fr', 'message', 'Texte pas encore ajouté'),
(284, 'notre.site', 'fr', 'message', 'Notre Site'),
(285, 'number.of', 'fr', 'message', 'Compte de'),
(286, 'on.date', 'fr', 'message', 'le'),
(287, '.participants', 'fr', 'message', 'Participants'),
(288, 'participated.in.events', 'fr', 'message', 'Participations'),
(289, '.password', 'fr', 'message', 'Mot de passe'),
(290, 'person.links', 'fr', 'message', 'Liens aux Hommes'),
(291, '.people', 'fr', 'message', 'Hommes'),
(292, 'person.a.editer', 'fr', 'message', 'Editer'),
(293, '.person', 'fr', 'message', 'L\'homme'),
(294, 'ref.edit', 'fr', 'message', 'Editez les liens'),
(296, '.retour', 'fr', 'message', 'Retour'),
(297, 'rien.a.chercher', 'fr', 'message', 'Aucune phrase à chercher'),
(640, 'search.results', 'fr', 'message', 'Resultats de recherche pour ='),
(641, 'si.non.enregistre', 'fr', 'message', 'Pas encore enregistré'),
(642, 'sous.evenements', 'fr', 'message', 'Sous Evènements'),
(643, '.subject', 'fr', 'message', 'Sujet'),
(644, '.submit', 'fr', 'message', 'Envoyez'),
(645, '.textes', 'fr', 'message', 'Textes'),
(646, 'the.campaign', 'fr', 'message', 'la campagne'),
(647, 'this.is.an.edit', 'fr', 'message', 'Ceci est une edition'),
(650, 'trouver.tout', 'fr', 'message', 'Tout retrouvé'),
(651, 'trouver.avec', 'fr', 'message', 'Trouvé avec'),
(653, 'under.the.name.of', 'fr', 'message', 'nommé'),
(654, '.username', 'fr', 'message', 'Nom de l\'utilisateur'),
(655, '.for', 'fr', 'message', 'pour'),
(656, 'voir.user', 'fr', 'message', 'Profil de l\'utilisateur'),
(657, 'delete.user', 'fr', 'message', 'supprimer'),
(658, 'edit.user.detail', 'fr', 'message', 'Modifier'),
(659, 'user.email', 'fr', 'message', 'Adresse e-mail'),
(660, 'user.roles', 'fr', 'message', 'rôles d\'utilisateur'),
(661, 'user.lastlogin', 'fr', 'message', 'dernier accès'),
(662, 'contact.list', 'fr', 'message', 'liste de messages'),
(663, 'view.contact', 'fr', 'message', 'voir'),
(664, 'delete.contact', 'fr', 'message', 'supprimer'),
(665, 'message.enyoyer', 'fr', 'message', 'message envoyé'),
(666, '.date', 'fr', 'message', 'envoyé le'),
(667, '.from', 'fr', 'message', 'de'),
(668, 'mail.from', 'fr', 'message', 'de'),
(669, 'mail.subject', 'fr', 'message', 'sujet'),
(670, 'mail.body', 'fr', 'message', 'contenu'),
(671, '.voir', 'fr', 'message', 'voir'),
(672, 'new.incident', 'fr', 'message', 'nouvel incident'),
(673, 'a.link.from', 'fr', 'message', 'lien de'),
(674, 'mail.date.sent', 'fr', 'message', 'envoyé le'),
(675, 'mail.sentby', 'fr', 'message', 'envoyé par'),
(676, 'complete.reg', 'fr', 'message', 'compléter l\'inscription'),
(677, 'sucessful.completion', 'fr', 'message', 'inscription réussie'),
(678, 'you.have.sucessfully.requested.change.password', 'fr', 'message', 'Vous avez demandé à changer votre mot de passe.'),
(679, 'you.must.reregister', 'fr', 'message', 'vous devez vous réinscrire'),
(680, 'welcome.to.our.site', 'fr', 'message', 'Bienvenue sur notre site'),
(681, 'edit.contents', 'fr', 'message', 'modifier'),
(682, 'bookmark.content', 'fr', 'message', 'marquer'),
(683, 'delete.content', 'fr', 'message', 'supprimer'),
(684, 'content.for.subject', 'fr', 'message', 'sujet'),
(685, 'message.forwarded.by.admin', 'fr', 'message', 'de FFLSAS-admin'),
(686, 'message.sent.by', 'fr', 'message', 'envoyé par'),
(687, 'message.to', 'fr', 'message', 'envoyé à'),
(688, 'message.date', 'fr', 'message', 'envoyé le'),
(689, 'message.subject', 'fr', 'message', 'sujet'),
(690, 'to.add.images.use.bookmarks', 'fr', 'message', 'pour ajouter une image, utilisez un signet'),
(691, 'to.add.participation.use.bookmarks', 'fr', 'message', 'pour ajouter un participant, utilisez un signet'),
(692, 'see.admin.messages', 'fr', 'message', 'Messagerie'),
(693, 'edit.message', 'fr', 'message', 'Editer'),
(694, 'send.message', 'fr', 'message', 'Envoyer un message'),
(695, 'delete.message', 'fr', 'message', 'Suprimer'),
(696, 'message.to.user', 'fr', 'message', 'Message a l\'utilisateur'),
(697, 'admin.messages', 'fr', 'message', 'Message de l\'administrateur'),
(698, '.users', 'fr', 'message', 'utiisateurs'),
(699, 'user.show', 'fr', 'message', 'voir utilisateur'),
(700, 'edit.user', 'fr', 'message', 'editer utilisateur'),
(701, 'profil.person', 'fr', 'message', 'profil de l\'utilisateur'),
(702, 'message.list', 'fr', 'message', 'liste des messages'),
(703, 'view.message', 'fr', 'message', 'voir'),
(704, 'message.sentby', 'fr', 'message', 'message de'),
(705, 'new.user', 'fr', 'message', 'nouvel utilisateur'),
(706, '.register', 'fr', 'message', 's\'inscrire'),
(707, 'bookmark.image', 'fr', 'message', 'signet'),
(708, 'see.image', 'fr', 'message', 'voir'),
(709, 'chercher.content', 'fr', 'message', 'Chercher les articles'),
(710, 'user.to.admin', 'fr', 'message', 'à l\'administrateur'),
(711, 'admin.to.user', 'fr', 'message', 'à l\'utilisateur'),
(712, 'message.envoyer.a', 'fr', 'message', 'Destinataire'),
(713, '.toname', 'fr', 'message', 'Destinataire'),
(714, '.toemail', 'fr', 'message', 'Destinataire email'),
(715, '.fromname', 'fr', 'message', 'Expéditeur'),
(716, '.fromemail', 'fr', 'message', 'Expéditeur email'),
(718, '.body', 'fr', 'message', 'Message'),
(719, 'message.enyoyer.a', 'fr', 'message', 'destinataire'),
(720, 'see.content', 'fr', 'message', 'Voir'),
(721, 'Click.me', 'fr', 'message', 'Envoyez'),
(722, 'view.user', 'fr', 'message', 'view.user'),
(723, '.return', 'fr', 'message', 'retour'),
(724, 'admin.copyright', 'fr', 'message', 'droits d\'auteur'),
(725, 'admin.privacy', 'fr', 'message', 'politique de confidentialité'),
(729, 'Repeat.Password', 'fr', 'message', 'Répéter le mot de passe'),
(730, 'tell.us.your.interest.in.our.site', 'fr', 'message', 'dites-nous votre intérêt pour notre site'),
(731, 'when.first.signing', 'fr', 'message', 'lors de la première connexion'),
(732, 'registration.success', 'fr', 'message', 'l\'inscription est réussie'),
(733, 'you.have.sucessfully.completed', 'fr', 'message', 'Vous avez terminé le processus d\'inscription avec succès.'),
(734, 'you.have.commenced.registration', 'fr', 'message', 'Vous avez commence le processus d\'enregistrement.'),
(735, 'to.complete.enter', 'fr', 'message', 'Pour terminer l\'inscription, entrez le code suivant'),
(736, 'to.continue.enter', 'fr', 'message', 'Pour terminer l\'inscription, entrez le code suivant'),
(737, 'to.continue.registration.enter', 'fr', 'message', 'Pour terminer l\'inscription, entrez le code suivant.'),
(738, 'print.transcript', 'fr', 'message', 'imprimer copie'),
(740, '.path', 'fr', 'message', 'Chemin'),
(741, '.copyright', 'fr', 'message', 'Copyright'),
(742, '.format', 'fr', 'message', 'Format'),
(743, '.access', 'fr', 'message', 'Access'),
(744, 'Image.file', 'fr', 'message', 'fichier image(jpg ou png)'),
(745, '.content', 'fr', 'message', 'contenu'),
(746, '.enfrancais', 'fr', 'message', 'Afficher le site en français'),
(747, '.inenglish', 'fr', 'message', 'Show the site in English'),
(748, '.texts', 'fr', 'message', 'Textes'),
(749, 'complete.registration', 'fr', 'message', 'terminer le processus d\'inscription'),
(750, 'delete.image', 'fr', 'message', 'supprimer l\'image'),
(751, 'to.add.location.use.bookmarks', 'fr', 'message', 'Pour ajouter un lieu utilisez un signet'),
(753, 'to.add.link.use.bookmarks', 'fr', 'message', 'Pour ajouter un lien utilisez un signet'),
(754, '.vue', 'fr', 'message', 'Voir'),
(755, '.disabled', 'fr', 'message', 'désactivée'),
(756, 'from.admin.to', 'fr', 'message', 'a'),
(757, 'to.admin', 'fr', 'message', 'a ADMIN'),
(758, 'this.message.was.sent.by', 'fr', 'message', 'message envoyé par'),
(759, 'latest.edits', 'fr', 'message', 'Dernières mises à jour'),
(760, 'remove.bookmarks', 'fr', 'message', 'enlever les signets'),
(761, 'new.book', 'fr', 'message', 'Nouveau Livre'),
(762, 'a.book', 'fr', 'message', 'Livre'),
(763, '.biblolinks', 'fr', 'message', 'Librairie'),
(764, 'link.visit', 'fr', 'message', 'Voir Lien'),
(765, 'bookmark.link', 'fr', 'message', 'signet'),
(766, '.book', 'fr', 'message', 'Livre'),
(767, 'edit.book.detail', 'fr', 'message', 'éditer le livre'),
(768, 'book.title', 'fr', 'message', 'Titre'),
(769, 'book.subtitle', 'fr', 'message', 'Sous-titre'),
(770, 'book.author', 'fr', 'message', 'Auteur'),
(771, 'book.publisher', 'fr', 'message', 'Editeur'),
(772, 'book.year', 'fr', 'message', 'année'),
(773, 'book.isbn', 'fr', 'message', 'ISBN'),
(774, 'new.url', 'fr', 'message', 'créer un URL'),
(775, 'les.liens', 'fr', 'message', 'Gérer liens'),
(776, 'les.livres', 'fr', 'message', 'Gérer nos livres'),
(777, 'voir.urls', 'fr', 'message', 'Voir nos liens'),
(778, 'voir.biblo', 'fr', 'message', 'Voir nos livres'),
(779, '.urlinks', 'fr', 'message', 'Liens'),
(780, 'new.link', 'fr', 'message', 'créer un lien'),
(781, 'edit.link', 'fr', 'message', 'éditer le lien'),
(782, 'delete.link', 'fr', 'message', 'supprimer'),
(783, '.title', 'fr', 'message', 'Titre'),
(784, '.url', 'fr', 'message', 'URL'),
(785, '.visit', 'fr', 'message', 'Visiter'),
(786, 'delete.this', 'fr', 'message', 'supprimer ceci'),
(787, 'browse.locations', 'fr', 'message', 'Naviguer vers les lieux'),
(788, '.reconnect', 'fr', 'message', 'Se déconnecter puis se reconnecter pour continuer comme utilisateur'),
(789, 'cherche.des.hommes', 'fr', 'message', 'Cherchez les hommes'),
(790, '.register!', 'fr', 'message', 'Enregister!'),
(791, 'edit.book', 'fr', 'message', 'Editer'),
(792, 'see.location', 'fr', 'message', 'Voir'),
(793, 'special.function', 'fr', 'message', 'Fonction speciale'),
(794, 'enter.new.password', 'fr', 'message', 'Nouveau mot de passe'),
(795, 'read.message', 'fr', 'message', 'Lire message'),
(796, '.fr', 'fr', 'message', 'FR'),
(797, '.en', 'fr', 'message', 'EN'),
(798, 'linked.from', 'fr', 'message', 'Lien de'),
(799, 'if.password.forgotten', 'fr', 'message', 'mot de passe oublié'),
(800, 'a.link.to', 'fr', 'message', 'Lien a'),
(801, '.tags', 'fr', 'message', 'Étiquettes'),
(802, 'unsucessful.rereg', 'fr', 'message', 're-enregistrement non réussi.'),
(803, 'try.again', 'fr', 'message', 'réessayez'),
(804, 'mot.de.pass.oublier', 'fr', 'message', 'mot de passe oublié'),
(805, 'rereg.user', 'fr', 'message', 'ré-enregistrer un utilisateur'),
(806, 'reset.password', 'fr', 'message', 'réinitialiser le mot de passe'),
(807, 'to.complete.reply.to.email', 'fr', 'message', 'Pour terminer le processus, répondez au courrier électronique que vous recevrez.'),
(808, 'to.continue.reply.to.email', 'fr', 'message', 'Pour continuer le processus, répondez au courrier électronique que vous recevrez.'),
(809, 'await.stage2', 'fr', 'message', 'Apres vérification par l\'administrateur vous recevrez un email'),
(810, 'user.not.recognised', 'fr', 'message', 'Utilisateur non reconnu'),
(811, 'request.new.password', 'fr', 'message', 'Demander un nouveau mot de passe'),
(812, 'sucessfully.registered', 'fr', 'message', 'Enregistrement réussi.'),
(813, 'registration.started', 'fr', 'message', 'Enregistrement commencé.'),
(814, 'you.have.sent.a.message.to.FFLSAS.org', 'fr', 'message', 'Vous avez envoyé un message à FFLSAS.org'),
(815, 'a.copy.has.been.sent.to.your.email.address', 'fr', 'message', 'Une copie a été envoyée à votre adresse email.'),
(816, 'user.locale', 'fr', 'message', 'Langue préférée'),
(817, 'changepass.success', 'fr', 'message', 'Changement de mot de passe réussi.'),
(818, 'admin.has.sent.a.message.to', 'fr', 'message', 'Admin a envoyé un message à'),
(819, 'send.bulk.message', 'fr', 'message', 'Envoyer un message à plusieurs utilisateurs'),
(820, '.recepients', 'fr', 'message', 'destinataires'),
(821, '.send', 'fr', 'message', 'envoyer'),
(822, 'message.bcc', 'fr', 'message', 'des copies cachées'),
(823, 'many.users', 'fr', 'message', 'plusieurs utilisateurs'),
(824, '.envoyer', 'fr', 'message', 'Envoyer'),
(826, 'bulk.message', 'fr', 'message', 'message à plusieurs utilisateurs'),
(827, 'to.send.bulk.email.use.bookmarks', 'fr', 'message', 'Pour envoyer des e-mails en masse, utilisez un signet.'),
(828, 'rereg.group', 'fr', 'message', 'Re-enregistrer un groupe'),
(829, 'delete.messages', 'fr', 'message', 'Supprimer les messages'),
(830, 'from.admin', 'fr', 'message', 'De ADMIN'),
(831, 'forced.registration', 'fr', 'message', 'Demander une réinscription'),
(832, '.friend', 'fr', 'message', 'Ami'),
(833, '.alias', 'en', 'message', 'Alias'),
(834, '.endroit', 'en', 'message', 'location'),
(835, '.forename', 'en', 'message', 'Forename'),
(836, '.name', 'en', 'message', 'Name'),
(837, 'toutes.endroits', 'en', 'message', 'All Places'),
(838, '.accueil', 'en', 'message', 'Home'),
(839, 'add.new.linkref', 'en', 'message', 'Create new Link'),
(840, 'add.participation', 'en', 'message', 'Create new participation'),
(841, 'add.text', 'en', 'message', 'Add a new text'),
(842, 'admin.content', 'en', 'message', 'Edit Content'),
(843, 'admin.images', 'en', 'message', 'Edit images'),
(844, 'admin.locations', 'en', 'message', 'Edit locations'),
(845, 'admin.allusers', 'en', 'message', 'Edit Users'),
(846, '.annuler', 'en', 'message', 'Cancel'),
(847, 'at.place', 'en', 'message', 'at'),
(848, '.at', 'en', 'message', 'at'),
(849, 'bienvenue.page', 'en', 'message', 'Welcome All'),
(850, 'bienvenue.site', 'en', 'message', 'Welcome to the FFLSAS site'),
(851, 'bienvenue.visiteur', 'en', 'message', 'Welcome Guest'),
(852, '.bienvenue', 'en', 'message', 'Welcome'),
(855, 'bookmark.event', 'en', 'message', 'bookmark'),
(856, '.bookmark', 'en', 'message', 'bookmark'),
(857, '.bookmarks', 'en', 'message', 'bookmarks'),
(858, 'bookmark.person', 'en', 'message', 'bookmark'),
(859, 'chercher.site', 'en', 'message', 'Search the database'),
(860, '.chercher', 'en', 'message', 'Search'),
(861, 'child.of', 'en', 'message', 'Child of'),
(862, '.comment', 'en', 'message', 'Comment'),
(863, 'compte.de', 'en', 'message', 'Number of'),
(864, 'contact.us', 'en', 'message', 'Send us a message or ask a question'),
(865, 'contactez.nous', 'en', 'message', 'Contact Us All'),
(866, 'create.incident', 'en', 'message', 'Create an incident'),
(867, 'create.newperson', 'en', 'message', 'Create a Person'),
(868, 'create.this', 'en', 'message', 'Create this'),
(869, '.delete', 'en', 'message', 'Delete'),
(870, '.during', 'en', 'message', 'during'),
(871, 'edit.content', 'en', 'message', 'Edit Content'),
(872, 'edit.detail', 'en', 'message', 'Edit detail'),
(873, 'edit.event.detail', 'en', 'message', 'Edit detail'),
(874, 'edit.event.new', 'en', 'message', 'Create New Event'),
(875, 'edit.event', 'en', 'message', 'Edit event'),
(876, 'edit.image', 'en', 'message', 'Edit image'),
(877, 'edit.images', 'en', 'message', 'Edit images'),
(878, 'edit.incident', 'en', 'message', 'Edit incident'),
(879, 'edit.links.for', 'en', 'message', 'Edit links'),
(880, 'edit.location', 'en', 'message', 'Edit location'),
(881, 'edit.participation', 'en', 'message', 'Edit'),
(882, 'edit.participations', 'en', 'message', 'Edit'),
(883, 'edit.person', 'en', 'message', 'Edit'),
(884, 'edit.refs', 'en', 'message', 'Edit'),
(885, 'edit.text', 'en', 'message', 'Edit texts'),
(886, 'edit.texts', 'en', 'message', 'Edit texts'),
(887, 'edit.this', 'en', 'message', 'Edit'),
(888, '.edit', 'en', 'message', 'Edit'),
(889, '.email', 'en', 'message', 'Email Address'),
(891, '.enregister', 'en', 'message', 'Register'),
(892, '.enregistrement', 'en', 'message', 'Register'),
(893, '.enregistrer', 'en', 'message', 'Save'),
(894, 'entrez.chercher', 'en', 'message', 'Enter Search Term'),
(895, '.evenement', 'en', 'message', 'event'),
(896, '.evenements', 'en', 'message', 'events'),
(897, 'event.a.editer', 'en', 'message', 'Edit Event'),
(898, '.event', 'en', 'message', 'Event'),
(899, 'event.links', 'en', 'message', 'Links to Events'),
(900, '.events', 'en', 'message', 'Events'),
(901, 'found.too.many', 'en', 'message', 'Too many found'),
(902, '.found', 'en', 'message', 'Found'),
(903, 'he.was', 'en', 'message', 'he was'),
(904, '.homme', 'en', 'message', 'person'),
(905, '.hommes', 'en', 'message', 'People'),
(906, 'image.chance', 'en', 'message', 'Lucky Image'),
(907, '.images', 'en', 'message', 'Images'),
(908, 'incident.rank', 'en', 'message', 'with the rank of'),
(909, 'incident.role', 'en', 'message', 'role'),
(910, 'incident.to', 'en', 'message', 'Incident in the service of ='),
(911, '.incidents', 'en', 'message', 'incidents'),
(912, '.introduction', 'en', 'message', 'Introduction'),
(913, '.latitude', 'en', 'message', 'Latitudeen'),
(914, 'les.actions', 'en', 'message', 'The Action'),
(915, 'les.hommes', 'en', 'message', 'The Men'),
(916, 'liens.a', 'en', 'message', 'Links to'),
(917, '.liens', 'en', 'message', 'Links'),
(918, 'location.a.editer', 'en', 'message', 'Edit location'),
(919, 'location.name', 'en', 'message', 'Name'),
(920, 'log.in', 'en', 'message', 'Log In'),
(921, 'log.out', 'en', 'message', 'Log Out'),
(922, 'login.message', 'en', 'message', 'To access all of our site sign in.'),
(923, 'mail.us', 'en', 'message', 'Send us a message'),
(924, '.message', 'en', 'message', 'Message'),
(926, 'new.content', 'en', 'message', 'New Content'),
(927, 'new.image', 'en', 'message', 'New Image'),
(928, 'new.location', 'en', 'message', 'New Location'),
(929, 'new.person', 'en', 'message', 'Create a new Man'),
(930, 'no.text', 'en', 'message', 'No texts added yet'),
(931, 'notre.site', 'en', 'message', 'Our Site'),
(932, 'on.date', 'en', 'message', 'the'),
(933, 'participated.in.events', 'en', 'message', 'Participations'),
(934, '.password', 'en', 'message', 'Password'),
(935, '.people', 'en', 'message', 'People'),
(936, 'person.a.editer', 'en', 'message', 'Editing'),
(937, '.person', 'en', 'message', 'The Men'),
(938, 'person.links', 'en', 'message', 'Links to People'),
(939, 'ref.edit', 'en', 'message', 'Edit links'),
(941, '.retour', 'en', 'message', 'Cancel'),
(942, 'rien.a.chercher', 'en', 'message', 'No search term entered'),
(943, 'search.results', 'en', 'message', 'Results of search for ='),
(944, 'si.non.enregistre', 'en', 'message', 'To Register'),
(945, 'sous.evenements', 'en', 'message', 'Sub-Events'),
(946, '.subject', 'en', 'message', 'Subject'),
(947, '.submit', 'en', 'message', 'Send'),
(948, '.textes', 'en', 'message', 'Texts'),
(949, 'the.campaign', 'en', 'message', 'the campaign'),
(950, 'this.is.an.edit', 'en', 'message', 'This is an edit'),
(953, 'trouver.tout', 'en', 'message', 'All found'),
(954, 'trouver.avec', 'en', 'message', 'Found with'),
(956, 'under.the.name.of', 'en', 'message', 'under the name of'),
(957, '.username', 'en', 'message', 'Username'),
(958, '.for', 'en', 'message', 'for'),
(959, 'voir.user', 'en', 'message', 'User profile'),
(960, 'delete.user', 'en', 'message', 'delete user'),
(961, 'edit.user.detail', 'en', 'message', 'edit user'),
(962, 'user.email', 'en', 'message', 'user email'),
(963, 'user.roles', 'en', 'message', 'user roles'),
(964, 'user.lastlogin', 'en', 'message', 'User Last login'),
(965, 'contact.list', 'en', 'message', 'message list'),
(966, 'view.contact', 'en', 'message', 'see message'),
(967, 'delete.contact', 'en', 'message', 'delete message'),
(968, 'message.enyoyer', 'en', 'message', 'message sent'),
(969, '.date', 'en', 'message', 'on the'),
(970, '.from', 'en', 'message', 'from'),
(971, 'mail.from', 'en', 'message', 'message fropm'),
(972, 'mail.subject', 'en', 'message', 'subject'),
(973, 'mail.body', 'en', 'message', 'message'),
(974, '.voir', 'en', 'message', 'see'),
(975, 'new.incident', 'en', 'message', 'New incident'),
(976, 'a.link.from', 'en', 'message', 'Link from'),
(977, '.participants', 'en', 'message', 'participants'),
(978, 'evenment.enfants', 'en', 'message', 'child events'),
(979, 'mail.date.sent', 'en', 'message', 'message sent on'),
(980, 'mail.sentby', 'en', 'message', 'message sent by'),
(981, 'complete.reg', 'en', 'message', 'Complete registration'),
(982, 'sucessful.completion', 'en', 'message', 'Registartion successful'),
(983, 'welcome.to.our.site', 'en', 'message', 'Welcome to our site'),
(984, 'edit.contents', 'en', 'message', 'edit contents'),
(985, 'bookmark.content', 'en', 'message', 'bookmark content'),
(986, 'delete.content', 'en', 'message', 'delete content'),
(987, 'content.for.subject', 'en', 'message', 'subject'),
(988, 'message.forwarded.by.admin', 'en', 'message', 'forwarded by FFLSAS-admin'),
(989, 'message.sent.by', 'en', 'message', 'sent by'),
(990, 'message.to', 'en', 'message', 'sent to'),
(991, 'message.date', 'en', 'message', 'date sent'),
(992, 'message.subject', 'en', 'message', 'subject'),
(993, 'to.add.images.use.bookmarks', 'en', 'message', 'To add images use bookmarks.'),
(994, 'to.add.participation.use.bookmarks', 'en', 'message', 'To add a participant use a bookmark'),
(995, 'see.admin.messages', 'en', 'message', 'Admin messages'),
(996, 'edit.message', 'en', 'message', 'Edit message'),
(997, 'send.message', 'en', 'message', 'Send message'),
(998, 'delete.message', 'en', 'message', 'Delete message'),
(999, 'message.to.user', 'en', 'message', 'Message to USER'),
(1000, 'admin.messages', 'en', 'message', 'Message to ADMIN'),
(1001, '.users', 'en', 'message', 'users'),
(1002, 'user.show', 'en', 'message', 'Shoe user'),
(1003, 'edit.user', 'en', 'message', 'Edit user'),
(1004, 'profil.person', 'en', 'message', 'User profile'),
(1005, 'message.list', 'en', 'message', 'List of messages'),
(1006, 'view.message', 'en', 'message', 'Read message'),
(1007, 'see.message', 'en', 'message', 'Read messagee'),
(1008, 'message.sentby', 'en', 'message', 'Message sent by'),
(1009, 'new.user', 'en', 'message', 'New user'),
(1010, '.register', 'en', 'message', 'Register'),
(1011, 'bookmark.image', 'en', 'message', 'Bookmark image'),
(1012, 'see.image', 'en', 'message', 'See image'),
(1013, 'chercher.content', 'en', 'message', 'Search Articles'),
(1014, 'user.to.admin', 'en', 'message', 'User to Admin'),
(1015, 'admin.to.user', 'en', 'message', 'Admin to User'),
(1016, 'message.envoyer.a', 'en', 'message', 'Recipient'),
(1017, '.toname', 'en', 'message', 'Destination'),
(1018, '.toemail', 'en', 'message', 'Destination email'),
(1019, '.fromname', 'en', 'message', 'Sender'),
(1020, '.fromemail', 'en', 'message', 'Sender email'),
(1022, '.body', 'en', 'message', 'Message'),
(1024, 'message.enyoyer.a', 'en', 'message', 'destination'),
(1025, 'see.content', 'en', 'message', 'See'),
(1026, 'Click.me', 'en', 'message', 'Send'),
(1027, 'view.user', 'en', 'message', 'See user'),
(1028, '.return', 'en', 'message', 'return'),
(1029, 'admin.copyright', 'en', 'message', 'Copyright'),
(1030, 'admin.privacy', 'en', 'message', 'Privacy'),
(1034, 'Repeat.Password', 'en', 'message', 'Repeat Password'),
(1035, 'tell.us.your.interest.in.our.site', 'en', 'message', 'Tell us why you are interested in our site'),
(1036, 'when.first.signing', 'en', 'message', 'When first signing in'),
(1037, 'registration.success', 'en', 'message', 'Registration is successfull'),
(1038, 'you.have.sucessfully.registered', 'en', 'message', 'You have registered sucessfully.'),
(1039, 'you.have.sucessfully.requested.change.password', 'en', 'message', 'You have requested to change your password.'),
(1040, 'you.must.reregister', 'en', 'message', 'You must reregister'),
(1041, 'you.have.sucessfully.completed', 'en', 'message', 'You have successfully completed the registration process.'),
(1042, 'to.complete.enter', 'en', 'message', 'To complete registration enter the following code'),
(1043, 'print.transcript', 'en', 'message', 'print copy'),
(1044, '.path', 'en', 'message', 'Path'),
(1045, '.copyright', 'en', 'message', 'Copyright'),
(1046, '.format', 'en', 'message', 'Format'),
(1047, '.access', 'en', 'message', 'Access'),
(1048, 'Image.file', 'en', 'message', 'Image file(jpg or png)'),
(1049, '.content', 'en', 'message', 'content'),
(1050, '.inenglish', 'en', 'message', 'Show site in English'),
(1051, '.enfrancais', 'en', 'message', 'Afficher le site en français'),
(1052, '.texts', 'en', 'message', 'Texts'),
(1053, 'complete.registration', 'en', 'message', 'Complete registration'),
(1054, 'delete.image', 'en', 'message', 'Delete Image'),
(1055, 'to.add.location.use.bookmarks', 'en', 'message', 'To add a location use a bookmark'),
(1057, 'to.add.link.use.bookmarks', 'en', 'message', 'To add a link use a bookmark'),
(1058, '.vue', 'en', 'message', 'View'),
(1059, '.disabled', 'en', 'message', 'Disabled'),
(1060, 'from.admin.to', 'en', 'message', 'to'),
(1061, 'to.admin', 'en', 'message', 'To ADMIN'),
(1062, 'this.message.was.sent.by', 'en', 'message', 'This message was sent by'),
(1063, 'latest.edits', 'en', 'message', 'Latest Updates'),
(1064, 'remove.bookmarks', 'en', 'message', 'Remove .bookmarks'),
(1065, 'new.book', 'en', 'message', 'New Book'),
(1066, 'a.book', 'en', 'message', 'Book'),
(1067, '.biblolinks', 'en', 'message', 'Library'),
(1068, 'link.visit', 'en', 'message', 'Visit'),
(1069, 'bookmark.link', 'en', 'message', 'Bookmark link'),
(1070, '.book', 'en', 'message', 'Book'),
(1071, 'edit.book.detail', 'en', 'message', 'Edit Book'),
(1072, 'book.title', 'en', 'message', 'Title'),
(1073, 'book.subtitle', 'en', 'message', 'Subtitle'),
(1074, 'book.author', 'en', 'message', 'Author'),
(1075, 'book.publisher', 'en', 'message', 'Publisher'),
(1076, 'book.year', 'en', 'message', 'Year'),
(1077, 'book.isbn', 'en', 'message', 'ISBN'),
(1078, 'new.url', 'en', 'message', 'New Url Link'),
(1079, 'les.liens', 'en', 'message', 'Links'),
(1080, 'les.livres', 'en', 'message', 'Books'),
(1081, 'voir.urls', 'en', 'message', 'See our Links'),
(1082, 'voir.biblo', 'en', 'message', 'See our Books'),
(1083, '.urlinks', 'en', 'message', 'Links'),
(1084, 'new.link', 'en', 'message', 'New Link'),
(1085, 'edit.link', 'en', 'message', 'Edit Link'),
(1086, 'delete.link', 'en', 'message', 'Delete Link'),
(1087, '.title', 'en', 'message', 'Title'),
(1088, '.url', 'en', 'message', 'URL'),
(1089, '.visit', 'en', 'message', 'Visit'),
(1090, 'delete.this', 'en', 'message', 'Delete'),
(1091, '.reconnect', 'en', 'message', 'Logout and Login again to continue as user'),
(1092, 'cherche.des.hommes', 'en', 'message', 'Search the men'),
(1093, '.register!', 'en', 'message', 'Register!'),
(1094, 'edit.book', 'en', 'message', 'Edit'),
(1095, 'see.location', 'en', 'message', 'See'),
(1096, 'browse.locations', 'en', 'message', 'Browse locations'),
(1097, 'special.function', 'en', 'message', 'Special Functions'),
(1098, 'enter.new.password', 'en', 'message', 'Enter new password'),
(1099, 'read.message', 'en', 'message', 'Read message'),
(1100, '.fr', 'en', 'message', 'FR'),
(1101, '.en', 'en', 'message', 'EN'),
(1102, 'linked.from', 'en', 'message', 'Linked from'),
(1103, 'if.password.forgotten', 'en', 'message', 'Password Forgotten'),
(1104, 'mot.de.pass.oublier', 'en', 'message', 'mot-de-pass oublier'),
(1105, 'a.link.to', 'en', 'message', 'Link To'),
(1106, '.tags', 'en', 'message', 'Tags'),
(1107, 'unsucessful.rereg', 'en', 'message', 'Re-registration unsucessful'),
(1108, 'rereg.user', 'en', 'message', 're-register user'),
(1109, 'reset.password', 'en', 'message', 'reset password'),
(1110, 'to.complete.reply.to.email', 'en', 'message', 'To complete the process reply to the email you will receive.'),
(1111, 'user.not.recognised', 'en', 'message', 'User not recognised'),
(1112, 'request.new.password', 'en', 'message', 'Request a new password'),
(1113, 'sucessfully.registered', 'en', 'message', 'Sucessfully registered'),
(1114, 'you.have.sent.a.message.to.FFLSAS.org', 'en', 'message', 'You have sent a message to FFLSAS.og'),
(1398, 'user.locale', 'en', 'message', 'Prefered language'),
(1399, 'changepass.success', 'en', 'message', 'Password change, succesfull.'),
(1400, 'try.again', 'en', 'message', 'Try again'),
(1401, 'admin.has.sent.a.message.to', 'en', 'message', 'Admin has sent a message to'),
(1402, 'send.bulk.message', 'en', 'message', 'Send a message to multiple users'),
(1403, '.recepients', 'en', 'message', 'recepients'),
(1404, '.send', 'en', 'message', 'send'),
(1405, 'message.bcc', 'en', 'message', 'Blind Copies'),
(1406, 'many.users', 'en', 'message', 'Many users'),
(1407, '.envoyer', 'en', 'message', 'Send'),
(1408, 'a.copy.has.been.sent.to.your.email.address', 'en', 'message', 'A copy has been sent to your email address'),
(1409, 'bulk.message', 'en', 'message', 'Bulk message'),
(1410, 'to.send.bulk.email.use.bookmarks', 'en', 'message', 'To send bulk email use a bookmark'),
(1411, 'rereg.group', 'en', 'message', 'Reregister a group'),
(1412, 'delete.messages', 'en', 'message', 'Delete messages'),
(1413, 'from.admin', 'en', 'message', 'From ADMIN'),
(1414, 'forced.registration', 'en', 'message', 'Force re-registration'),
(1415, '.friend', 'en', 'message', 'Friend'),
(1420, '.fred', 'fr', 'message', '_fred'),
(1421, '.fred', 'en', 'message', '_fred'),
(1422, 'make.roh', 'fr', 'message', 'Export Rôle d\'Honneur'),
(1423, 'make.roh', 'en', 'message', 'Export Role Of Honour'),
(1424, 'make.actions', 'fr', 'message', 'Export Evenements'),
(1425, 'make.actions', 'en', 'message', 'Export Actions'),
(1426, 'admin.labels', 'fr', 'message', 'Gerer étiquettes'),
(1427, 'admin.labels', 'en', 'message', 'Manage Labels'),
(1428, 'new.label', 'fr', 'message', 'Créer une nouvelle étiquette'),
(1429, 'new.label', 'en', 'message', 'Create new Label'),
(1430, 'update.translation.files', 'fr', 'message', 'mettre à jour les fichiers de traduction'),
(1431, 'update.translation.files', 'en', 'message', 'update the translation files'),
(1432, '.reset', 'fr', 'message', 'réinitialiser'),
(1433, '.reset', 'en', 'message', 'clear'),
(1434, 'the.men', 'fr', 'message', 'Les Hommes'),
(1435, 'the.men', 'en', 'message', 'The Men'),
(1436, 'the.events', 'fr', 'message', 'Les Evenements'),
(1437, 'the.events', 'en', 'message', 'The Action'),
(1453, '.tué', 'fr', 'itype', 'tué'),
(1454, '.blessé', 'fr', 'itype', 'blessé'),
(1455, '.capturé', 'fr', 'itype', 'capturé'),
(1456, '.accidenté', 'fr', 'itype', 'accidenté'),
(1457, '.mort', 'fr', 'itype', 'mort'),
(1458, '.parachuté', 'fr', 'itype', 'parachuté'),
(1459, '.noyé', 'fr', 'itype', 'noyé'),
(1460, '.évadé', 'fr', 'itype', 'évadé'),
(1461, '.exécuté', 'fr', 'itype', 'exécuté'),
(1462, '.blessé2', 'fr', 'itype', 'blessé'),
(1463, '.disparu', 'fr', 'itype', 'disparu'),
(1464, '.capturé à nouveau', 'fr', 'itype', 'capturé à nouveau'),
(1465, '.parachuté à nouveau', 'fr', 'itype', 'parachuté à nouveau'),
(1466, '.libéré', 'fr', 'itype', 'libéré'),
(1467, '.rejoint', 'fr', 'itype', 'rejoint'),
(1468, '.souffrant', 'fr', 'itype', 'souffrant'),
(1469, '.transféré', 'fr', 'itype', 'transféré'),
(1470, '.déporté', 'fr', 'itype', 'déporté'),
(1471, '.mission', 'fr', 'itype', 'mission'),
(1472, '.rentré', 'fr', 'itype', 'rentre'),
(1473, '.retourné', 'fr', 'itype', 'retourne'),
(1474, '.devenu malade', 'fr', 'itype', 'tombé malade'),
(1475, '.muté', 'fr', 'itype', 'muté'),
(1476, '.détaché', 'fr', 'itype', 'Détaché'),
(1484, '.tué', 'en', 'itype', 'killed'),
(1485, '.blessé', 'en', 'itype', 'wounded'),
(1486, '.capturé', 'en', 'itype', 'captured'),
(1487, '.accidenté', 'en', 'itype', 'injured'),
(1488, '.mort', 'en', 'itype', 'dead'),
(1489, '.parachuté', 'en', 'itype', 'parachuted'),
(1490, '.noyé', 'en', 'itype', 'drowned'),
(1491, '.évadé', 'en', 'itype', 'escaped'),
(1492, '.exécuté', 'en', 'itype', 'executed'),
(1493, '.blessé2', 'en', 'itype', 'wounded'),
(1494, '.disparu', 'en', 'itype', 'disappeared'),
(1495, '.capturé à nouveau', 'en', 'itype', 're-captured'),
(1496, '.parachuté à nouveau', 'en', 'itype', 're-parachuted'),
(1497, '.libéré', 'en', 'itype', 'freed'),
(1498, '.rejoint', 'en', 'itype', 'rejoined'),
(1499, '.souffrant', 'en', 'itype', 'suffering'),
(1500, '.transféré', 'en', 'itype', 'transfered'),
(1501, '.déporté', 'en', 'itype', 'deported'),
(1502, '.mission', 'en', 'itype', 'mission'),
(1503, '.rentré', 'en', 'itype', 'returned'),
(1504, '.retourné', 'en', 'itype', 'returned'),
(1505, '.devenu malade', 'en', 'itype', 'became ill'),
(1506, '.muté', 'en', 'itype', 'transfered'),
(1507, '.détaché', 'en', 'itype', 'Posted'),
(1515, 'translation.files.produced', 'fr', 'message', 'fichiers de traduction generees'),
(1516, 'translation.files.produced', 'en', 'message', 'Translation files produced'),
(1517, 'email.confirmed', 'fr', 'message', 'Courrier électronique validé'),
(1518, 'email.confirmed', 'en', 'message', 'User Email Confirmed'),
(1519, 'user.profile', 'fr', 'message', 'profil de l\'utilisateur'),
(1520, 'user.profile', 'en', 'message', 'User profile'),
(1521, 'manage.images', 'fr', 'message', 'Gérer Images'),
(1522, 'manage.images', 'en', 'message', 'Manage Images'),
(1523, 'move.new.images', 'fr', 'message', 'Transferer nouveaux images'),
(1524, 'move.new.images', 'en', 'message', 'Transfer new images');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;