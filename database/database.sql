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

-- Dumping database structure for awt_cw
DROP DATABASE IF EXISTS `awt_cw`;
CREATE DATABASE IF NOT EXISTS `awt_cw` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `awt_cw`;


-- Dumping structure for table awt_cw.answer
DROP TABLE IF EXISTS `answer`;
CREATE TABLE IF NOT EXISTS `answer` (
  `answer_id` varchar(4) NOT NULL,
  `question_id` varchar(4) NOT NULL,
  `status` int(1) NOT NULL,
  `answer_description` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`answer_id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `question_id` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table awt_cw.answer: ~54 rows (approximately)
DELETE FROM `answer`;
/*!40000 ALTER TABLE `answer` DISABLE KEYS */;
INSERT INTO `answer` (`answer_id`, `question_id`, `status`, `answer_description`) VALUES
	('A001', 'Q001', 1, 'PHP: Hypertext Preprocessor'),
	('A002', 'Q001', 0, 'Personal Hypertext Processor'),
	('A003', 'Q001', 0, 'Private Home Page'),
	('A004', 'Q002', 0, 'Document.Write("Hello World");'),
	('A005', 'Q002', 0, '"Hello World";'),
	('A006', 'Q002', 1, 'echo "Hello World";'),
	('A007', 'Q003', 0, '#'),
	('A008', 'Q003', 1, '$'),
	('A009', 'Q003', 0, '!'),
	('A010', 'Q004', 1, 'Perl and C'),
	('A011', 'Q004', 0, 'VBScript'),
	('A012', 'Q004', 0, 'JavaScript'),
	('A013', 'Q005', 0, 'Request.Form;'),
	('A014', 'Q005', 1, '$_GET[];'),
	('A015', 'Q005', 0, 'Request.QueryString;'),
	('A016', 'Q006', 0, 'True'),
	('A017', 'Q006', 1, 'False'),
	('A018', 'Q007', 0, 'False'),
	('A019', 'Q007', 1, 'True'),
	('A020', 'Q008', 0, 'True'),
	('A021', 'Q008', 1, 'False'),
	('A022', 'Q009', 0, 'create myFunction()'),
	('A023', 'Q009', 1, 'function myFunction()'),
	('A024', 'Q009', 0, 'new_function myFunction()'),
	('A025', 'Q010', 1, 'True'),
	('A026', 'Q010', 0, 'False'),
	('A027', 'Q011', 0, '$_GLOBALS'),
	('A028', 'Q011', 0, '$_GET'),
	('A029', 'Q011', 1, '$_SERVER'),
	('A030', 'Q011', 0, '$_SESSION'),
	('A031', 'Q012', 0, ' count++;'),
	('A032', 'Q012', 0, '$count =+1'),
	('A033', 'Q012', 1, '$count++;'),
	('A034', 'Q012', 0, '++count'),
	('A035', 'Q013', 1, 'True'),
	('A036', 'Q013', 0, 'False'),
	('A037', 'Q014', 1, 'True'),
	('A038', 'Q014', 0, 'False'),
	('A039', 'Q015', 0, '$myVar'),
	('A040', 'Q015', 0, '$my_Var'),
	('A041', 'Q015', 1, '$my-Var'),
	('A042', 'Q016', 1, 'True'),
	('A043', 'Q016', 0, 'False'),
	('A044', 'Q017', 0, 'True'),
	('A045', 'Q017', 1, 'False'),
	('A046', 'Q018', 0, '$cars = array["Volvo", "BMW", "Toyota"];'),
	('A047', 'Q018', 1, '$cars = array("Volvo", "BMW", "Toyota");'),
	('A048', 'Q018', 0, '$cars = "Volvo", "BMW", "Toyota";'),
	('A049', 'Q019', 0, 'True'),
	('A050', 'Q019', 1, 'False'),
	('A051', 'Q020', 0, '!='),
	('A052', 'Q020', 1, '=='),
	('A053', 'Q020', 0, '='),
	('A054', 'Q020', 0, '>');
/*!40000 ALTER TABLE `answer` ENABLE KEYS */;


-- Dumping structure for table awt_cw.attempt
DROP TABLE IF EXISTS `attempt`;
CREATE TABLE IF NOT EXISTS `attempt` (
  `attempt_id` varchar(4) NOT NULL,
  `attempt_score` int(4) NOT NULL,
  `user_id` varchar(4) NOT NULL,
  PRIMARY KEY (`attempt_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table awt_cw.attempt: ~0 rows (approximately)
DELETE FROM `attempt`;
/*!40000 ALTER TABLE `attempt` DISABLE KEYS */;
/*!40000 ALTER TABLE `attempt` ENABLE KEYS */;


-- Dumping structure for table awt_cw.attempt_question
DROP TABLE IF EXISTS `attempt_question`;
CREATE TABLE IF NOT EXISTS `attempt_question` (
  `aq_attempt_id` varchar(4) NOT NULL,
  `aq_question_id` varchar(4) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`aq_attempt_id`,`aq_question_id`),
  KEY `aq_question_id` (`aq_question_id`),
  CONSTRAINT `aq_attempt_id` FOREIGN KEY (`aq_attempt_id`) REFERENCES `attempt` (`attempt_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `aq_question_id` FOREIGN KEY (`aq_question_id`) REFERENCES `question` (`question_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table awt_cw.attempt_question: ~0 rows (approximately)
DELETE FROM `attempt_question`;
/*!40000 ALTER TABLE `attempt_question` DISABLE KEYS */;
/*!40000 ALTER TABLE `attempt_question` ENABLE KEYS */;


-- Dumping structure for table awt_cw.permission
DROP TABLE IF EXISTS `permission`;
CREATE TABLE IF NOT EXISTS `permission` (
  `permission_id` varchar(4) NOT NULL,
  `permission_name` varchar(100) NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table awt_cw.permission: ~0 rows (approximately)
DELETE FROM `permission`;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;


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
DELETE FROM `question`;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` (`question_id`, `question_detail`, `difficulty`, `explanation`) VALUES
	('Q001', 'What does PHP stand for?', 1, 'While PHP originally stood for Personal Home Page, it now stands for the recursive backronym PHP: Hypertext Preprocessor.'),
	('Q002', 'How do you write "Hello World" in PHP', 1, 'echo "Hello World";'),
	('Q003', 'All variables in PHP start with which symbol?', 1, 'All variables in PHP start with $'),
	('Q004', 'The PHP syntax is most similar to:', 2, 'Perl and C'),
	('Q005', 'How do you get information from a form that is submitted using the "get" method?', 2, '$_GET[];'),
	('Q006', 'When using the POST method, variables are displayed in the URL:', 2, 'Information sent from a form with the POST method is invisible to others (all names/values are embedded within the body of the HTTP request) and has no limits on the amount of information to send.'),
	('Q007', 'In PHP you can use both single quotes ( \' \' ) and double quotes ( " " ) for strings:', 1, 'PHP strings can be specified not just in two ways, but in four ways.'),
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


-- Dumping structure for table awt_cw.role
DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` varchar(4) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table awt_cw.role: ~0 rows (approximately)
DELETE FROM `role`;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
/*!40000 ALTER TABLE `role` ENABLE KEYS */;


-- Dumping structure for table awt_cw.role_permission
DROP TABLE IF EXISTS `role_permission`;
CREATE TABLE IF NOT EXISTS `role_permission` (
  `rp_role_id` varchar(4) NOT NULL,
  `rp_permission_id` varchar(4) NOT NULL,
  PRIMARY KEY (`rp_role_id`,`rp_permission_id`),
  KEY `rp_permission_id` (`rp_permission_id`),
  CONSTRAINT `rp_role_id` FOREIGN KEY (`rp_role_id`) REFERENCES `role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `rp_permission_id` FOREIGN KEY (`rp_permission_id`) REFERENCES `permission` (`permission_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table awt_cw.role_permission: ~0 rows (approximately)
DELETE FROM `role_permission`;
/*!40000 ALTER TABLE `role_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_permission` ENABLE KEYS */;


-- Dumping structure for table awt_cw.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(4) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `role_id` varchar(4) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table awt_cw.user: ~0 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
