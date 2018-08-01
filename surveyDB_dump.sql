-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `survey` /*!40100 DEFAULT CHARACTER SET utf16 COLLATE utf16_latvian_ci */;
USE `survey`;

CREATE TABLE `answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) CHARACTER SET utf8 COLLATE utf8_latvian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO `answer` (`id`, `text`) VALUES
(1,	'Dāvis'),
(2,	'Jānis'),
(3,	'Kārlis'),
(4,	'Lācis'),
(5,	'Lietuva'),
(6,	'Igaunija'),
(7,	'Latvija'),
(8,	'Spānija'),
(9,	'Saulains'),
(10,	'Lietains'),
(11,	'Miglains'),
(12,	'Sniegains'),
(13,	'NFS'),
(14,	'Witcher 3'),
(15,	'DOOM'),
(16,	'The Sims 3');

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_latvian_ci DEFAULT NULL,
  `text` varchar(255) CHARACTER SET utf8 COLLATE utf8_latvian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `question` (`id`, `title`, `text`) VALUES
(1,	'Autors',	'Kā sauc autoru?'),
(2,	'Valsts',	'Kurā valstī mēs atrodamies?'),
(3,	'Laikapstākļi',	'Kādi pēdējā laikā ir bijuši laikapstākļi?'),
(4,	'Datorspēle',	'Kas ir autora favorīt-datorspēle?');

CREATE TABLE `question_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questionID` int(11) NOT NULL,
  `answerID` int(11) NOT NULL,
  `isCorrect` bit(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `questionID` (`questionID`),
  KEY `answerID` (`answerID`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO `question_answer` (`id`, `questionID`, `answerID`, `isCorrect`) VALUES
(1,	1,	1,	CONV('1', 2, 10) + 0),
(2,	1,	2,	CONV('0', 2, 10) + 0),
(3,	1,	3,	CONV('0', 2, 10) + 0),
(4,	1,	4,	CONV('0', 2, 10) + 0),
(5,	2,	5,	CONV('0', 2, 10) + 0),
(6,	2,	6,	CONV('0', 2, 10) + 0),
(7,	2,	7,	CONV('1', 2, 10) + 0),
(8,	2,	8,	CONV('0', 2, 10) + 0),
(9,	3,	9,	CONV('1', 2, 10) + 0),
(10,	3,	10,	CONV('0', 2, 10) + 0),
(11,	3,	11,	CONV('1', 2, 10) + 0),
(12,	3,	12,	CONV('0', 2, 10) + 0),
(13,	4,	13,	CONV('0', 2, 10) + 0),
(14,	4,	14,	CONV('1', 2, 10) + 0),
(15,	4,	15,	CONV('0', 2, 10) + 0),
(16,	4,	16,	CONV('0', 2, 10) + 0);

CREATE TABLE `survey` (
  `surveyID` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_latvian_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_latvian_ci NOT NULL,
  PRIMARY KEY (`surveyID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `survey` (`surveyID`, `name`, `description`) VALUES
(1,	'1.aptauja',	'1. testa aptauja'),
(2,	'2.aptauja',	'2. testa aptauja'),
(3,	'Dāvja aptauja',	'Dāvja pirmā aptaujiņa');

CREATE TABLE `survey_question` (
  `surveyID` int(11) NOT NULL,
  `questionID` int(11) NOT NULL,
  KEY `surveyID` (`surveyID`),
  KEY `questionID` (`questionID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `survey_question` (`surveyID`, `questionID`) VALUES
(1,	1),
(1,	4),
(2,	2),
(2,	3);

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_latvian_ci NOT NULL,
  `survey_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `survey_id` (`survey_id`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;


CREATE TABLE `user_answers` (
  `question_answer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  KEY `question_answer_id` (`question_answer_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf16 COLLATE=utf16_latvian_ci;


-- 2018-08-01 03:09:27
