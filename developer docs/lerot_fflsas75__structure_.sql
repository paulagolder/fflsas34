SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


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

CREATE TABLE `content` (
  `contentid` int(10) UNSIGNED NOT NULL,
  `subjectid` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `text` longtext,
  `update_dt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `contributor` varchar(20) NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL COMMENT 'The language code for the article.',
  `access` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `event` (
  `eventid` mediumint(9) NOT NULL,
  `label` varchar(40) NOT NULL,
  `parent` mediumint(9) NOT NULL DEFAULT '0',
  `locid` int(11) DEFAULT NULL,
  `showmap` tinyint(1) NOT NULL DEFAULT '0',
  `date` varchar(12) DEFAULT NULL,
  `startdate` varchar(12) DEFAULT NULL,
  `enddate` varchar(12) DEFAULT NULL,
  `sequence` tinyint(3) UNSIGNED DEFAULT NULL,
  `contributor` varchar(40) NOT NULL,
  `update_dt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `image` (
  `imageid` int(6) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `copyright` varchar(100) DEFAULT NULL,
  `contributor` varchar(30) DEFAULT NULL,
  `update_dt` datetime DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL,
  `imagefile` varchar(50) DEFAULT NULL,
  `format` varchar(10) DEFAULT NULL,
  `access` smallint(6) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `imageref` (
  `id` int(11) NOT NULL,
  `imageid` int(6) UNSIGNED NOT NULL DEFAULT '0',
  `objecttype` varchar(10) NOT NULL,
  `objid` mediumint(9) NOT NULL,
  `mustshow` varchar(5) DEFAULT 'yes',
  `width` int(11) DEFAULT NULL,
  `sequence` tinyint(4) DEFAULT '9'
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
  `comment` varchar(40) DEFAULT NULL,
  `contributor` varchar(20) DEFAULT NULL,
  `update_dt` datetime DEFAULT NULL
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
  `update_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `location` (
  `locid` int(11) NOT NULL,
  `name` varchar(80) DEFAULT '',
  `region` int(11) NOT NULL DEFAULT '1',
  `latitude` double DEFAULT '0',
  `longitude` double DEFAULT '0',
  `zoom` int(11) DEFAULT NULL,
  `kml` longtext,
  `showchildren` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `toname` varchar(40) DEFAULT NULL,
  `toemail` varchar(100) DEFAULT NULL,
  `bcc` varchar(400) DEFAULT NULL,
  `fromname` varchar(100) DEFAULT NULL,
  `fromemail` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `body` mediumtext,
  `date_sent` datetime DEFAULT '0000-00-00 00:00:00',
  `private` tinyint(1) DEFAULT NULL
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
  `comment` varchar(40) DEFAULT NULL,
  `contributor` varchar(20) DEFAULT NULL,
  `update_dt` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `person` (
  `personid` mediumint(9) NOT NULL,
  `surname` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `forename` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `alias` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `contributor` varchar(40) CHARACTER SET utf8 NOT NULL,
  `update_dt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `text` (
  `id` int(11) NOT NULL,
  `objecttype` varchar(20) NOT NULL DEFAULT 'document',
  `objid` varchar(20) NOT NULL,
  `attribute` varchar(20) NOT NULL DEFAULT '',
  `language` varchar(20) NOT NULL DEFAULT '',
  `comment` text,
  `contributor` varchar(20) NOT NULL DEFAULT '',
  `update_dt` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `url` (
  `id` int(11) NOT NULL,
  `url` varchar(200) NOT NULL,
  `label` varchar(200) NOT NULL,
  `tags` varchar(20) DEFAULT NULL,
  `visits` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `biblo`
  ADD PRIMARY KEY (`bookid`);

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


ALTER TABLE `biblo`
  MODIFY `bookid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `content`
  MODIFY `contentid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `event`
  MODIFY `eventid` mediumint(9) NOT NULL AUTO_INCREMENT;

ALTER TABLE `fflsasuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `image`
  MODIFY `imageid` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `imageref`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `incident`
  MODIFY `incidentid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `incidenttype`
  MODIFY `itypeid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `linkref`
  MODIFY `linkid` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `location`
  MODIFY `locid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `participant`
  MODIFY `participationid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `person`
  MODIFY `personid` mediumint(9) NOT NULL AUTO_INCREMENT;

ALTER TABLE `text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
