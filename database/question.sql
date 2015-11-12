-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.12-log - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table awt_cw.question
DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `question_id` varchar(4) NOT NULL,
  `question_detail` varchar(1000) NOT NULL,
  `difficulty` int(11) NOT NULL,
  `explanation` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table awt_cw.question: ~20 rows (approximately)
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` (`question_id`, `question_detail`, `difficulty`, `explanation`) VALUES
	('Q001', 'What does PHP stand for?', 1, NULL),
	('Q002', 'How do you write "Hello World" in PHP', 1, NULL),
	('Q003', 'All variables in PHP start with which symbol?', 1, NULL),
	('Q004', 'The PHP syntax is most similar to:', 2, NULL),
	('Q005', 'How do you get information from a form that is submitted using the "get" method?', 2, NULL),
	('Q006', 'When using the POST method, variables are displayed in the URL:', 2, NULL),
	('Q007', 'In PHP you can use both single quotes ( \' \' ) and double quotes ( " " ) for strings:', 1, NULL),
	('Q008', 'Include files must have the file extension ".inc"', 3, NULL),
	('Q009', 'What is the correct way to create a function in PHP?', 1, NULL),
	('Q010', 'PHP allows you to send emails directly from a script', 3, NULL),
	('Q011', 'Which superglobal variable holds information about headers, paths, and script locations?', 3, NULL),
	('Q012', 'What is the correct way to add 1 to the $count variable?', 2, NULL),
	('Q013', 'PHP can be run on Microsoft Windows IIS(Internet Information Server):', 3, NULL),
	('Q014', 'The die() and exit() functions do the exact same thing.', 3, NULL),
	('Q015', 'Which one of these variables has an illegal name?', 2, NULL),
	('Q016', 'The setcookie() function must appear BEFORE the <html> tag.', 3, NULL),
	('Q017', 'In PHP, the only way to output text is with echo.', 2, NULL),
	('Q018', 'How do you create an array in PHP?', 2, NULL),
	('Q019', 'The if statement is used to execute some code only if a specified condition is true', 2, NULL),
	('Q020', 'Which operator is used to compare two values', 1, NULL);
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
