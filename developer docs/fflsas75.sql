SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `newfflsas75` DEFAULT CHARACTER SET utf8 COLLATE utf8_ci;
USE `newfflsas75`;

CREATE TABLE `content` (
  `contentid` int(10) UNSIGNED NOT NULL,
  `subjectid` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `text` longtext DEFAULT NULL,
  `update_dt` datetime NOT NULL NOT NULL DEFAULT current_timestamp(),
  `contributor` varchar(20) NOT NULL ,
  `language` char(7) NOT NULL COMMENT 'The language code for the article.'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `event` (
  `eventid` mediumint(9) NOT NULL,
  `label` varchar(40) NOT NULL,
  `parent` mediumint(9) NOT NULL DEFAULT 0,
  `locid` int(11) DEFAULT NULL,
  `showmap` tinyint(1) NOT NULL DEFAULT 0,
  `date` varchar(12) DEFAULT NULL,
  `startdate` varchar(12) DEFAULT NULL,
  `enddate` varchar(12) DEFAULT NULL,
  `sequence` tinyint(3) UNSIGNED DEFAULT NULL,
  `contributor` varchar(40) NOT NULL,
  `update_dt` datetime NOT NULL NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `fflsasuser` (
  `id` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `rolestr` varchar(50) DEFAULT NULL,
  `locale` varchar(10) DEFAULT NULL,
  `salt` varchar(20) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `registrationcode` mediumint(9) DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `image` (
  `imageid` int(6) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `copyright` varchar(100) DEFAULT NULL,
  `contributor` varchar(30) DEFAULT NULL,
  `update_dt` datetime NOT NULL DEFAULT current_timestamp(),
  `path` varchar(100) DEFAULT NULL,
  `imagefile` varchar(50) DEFAULT NULL,
  `format` varchar(10) DEFAULT NULL,
  `access` smallint(6) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `imageref` (
  `id` int(11) NOT NULL,
  `imageid` int(6) UNSIGNED NOT NULL DEFAULT 0,
  `objecttype` varchar(10) NOT NULL,
  `objid` mediumint(9) NOT NULL,
  `mustshow` varchar(5) DEFAULT 'yes',
  `width` int(11) DEFAULT NULL,
  `sequence` tinyint(4) DEFAULT 9
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `incident` (
  `incidentid` int(11) NOT NULL,
  `personid` mediumint(6) NOT NULL,
  `eventid` mediumint(6) NOT NULL,
  `itypeid` mediumint(9) NOT NULL,
  `locid` int(11) DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `name_recorded` varchar(30) DEFAULT NULL,
  `rank` varchar(20) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `date` varchar(14) DEFAULT NULL,
  `sdate` varchar(14) DEFAULT NULL,
  `edate` varchar(14) DEFAULT NULL,
  `location` varchar(40) DEFAULT NULL,
  `contributor` varchar(20) DEFAULT NULL,
  `update_dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `incidentlabels` (
  `itypeid` int(11) NOT NULL,
  `lang` varchar(6) NOT NULL,
  `label` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `incidenttype` (
  `itypeid` int(11) NOT NULL,
  `label` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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

CREATE TABLE `location` (
  `locid` int(11) NOT NULL,
  `name` varchar(80) DEFAULT '',
  `region` int(11) NOT NULL DEFAULT 1,
  `latitude` double DEFAULT 0,
  `longitude` double DEFAULT 0,
  `zoom` int(11) DEFAULT NULL,
  `kml` longtext DEFAULT NULL,
  `showchildren` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `toname` varchar(40) DEFAULT NULL,
  `toemail` varchar(100) DEFAULT NULL,
  `fromname` varchar(100) DEFAULT NULL,
  `fromemail` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `body` mediumtext DEFAULT NULL,
  `date_sent` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `participant` (
  `participationid` int(11) NOT NULL,
  `personid` mediumint(6) NOT NULL,
  `eventid` mediumint(6) NOT NULL,
  `name_recorded` varchar(30) DEFAULT NULL,
  `rank` varchar(20) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `date` varchar(14) DEFAULT NULL,
  `sdate` varchar(14) DEFAULT NULL,
  `edate` varchar(14) DEFAULT NULL,
  `xxlocation` varchar(40) DEFAULT NULL,
  `contributor` varchar(20) DEFAULT NULL,
  `update_dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `person` (
  `personid` mediumint(9) NOT NULL,
  `surname` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `forename` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `alias` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `contributor` varchar(40) CHARACTER SET utf8 NOT NULL,
  `update_dt` datetime NOT NULL NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `text` (
  `id` int(11) NOT NULL,
  `objecttype` varchar(20) NOT NULL ,
  `objid` varchar(20) NOT NULL,
  `attribute` varchar(20) NOT NULL DEFAULT '',
  `language` varchar(20) NOT NULL DEFAULT '',
  `comment` text DEFAULT NULL,
  `contributor` varchar(20) NOT NULL DEFAULT '',
  `update_dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `url` (
  `id` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `label` varchar(40) NOT NULL,
  `tag` varchar(20) DEFAULT NULL,
  `visits` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


ALTER TABLE `content`
  ADD PRIMARY KEY (`contentid`);

ALTER TABLE `event`
  ADD PRIMARY KEY (`eventid`);

ALTER TABLE `fflsasuser`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `image`
  ADD PRIMARY KEY (`imageid`);

ALTER TABLE `imageref`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index` (`imageid`,`objecttype`,`objid`) USING BTREE;

ALTER TABLE `incident`
  ADD PRIMARY KEY (`incidentid`);

ALTER TABLE `incidentlabels`
  ADD PRIMARY KEY (`itypeid`,`lang`);

ALTER TABLE `incidenttype`
  ADD PRIMARY KEY (`itypeid`);

ALTER TABLE `linkref`
  ADD PRIMARY KEY (`linkid`);

ALTER TABLE `location`
  ADD PRIMARY KEY (`locid`);

ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `participant`
  ADD UNIQUE KEY `index` (`participationid`);

ALTER TABLE `person`
  ADD UNIQUE KEY `index` (`personid`);

ALTER TABLE `text`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index` (`objecttype`,`objid`,`attribute`,`language`) USING BTREE;

ALTER TABLE `url`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `content`
  MODIFY `contentid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;
ALTER TABLE `event`
  MODIFY `eventid` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=439;
ALTER TABLE `fflsasuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
ALTER TABLE `image`
  MODIFY `imageid` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1409;
ALTER TABLE `imageref`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1094;
ALTER TABLE `incident`
  MODIFY `incidentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5772;
ALTER TABLE `linkref`
  MODIFY `linkid` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
ALTER TABLE `location`
  MODIFY `locid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=562;
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
ALTER TABLE `participant`
  MODIFY `participationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5159;
ALTER TABLE `person`
  MODIFY `personid` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1764;
ALTER TABLE `text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5746;
ALTER TABLE `url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
