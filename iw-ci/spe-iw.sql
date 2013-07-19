-- phpMyAdmin SQL Dump
-- version 3.4.10
-- http://www.phpmyadmin.net
--
-- Host: publicdb.cs.princeton.edu
-- Generation Time: Jul 19, 2013 at 12:04 PM
-- Server version: 5.1.67
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spe-iw`
--

-- --------------------------------------------------------

--
-- Table structure for table `advisor_feedback`
--

CREATE TABLE IF NOT EXISTS `advisor_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `research` varchar(128) NOT NULL,
  `research_progress` varchar(128) NOT NULL,
  `paper` varchar(128) NOT NULL,
  `initiative` varchar(128) NOT NULL,
  `plans` varchar(128) NOT NULL,
  `percentile` varchar(128) NOT NULL,
  `suggested_grade` varchar(128) NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `advisor_feedback`
--

INSERT INTO `advisor_feedback` (`id`, `project_id`, `research`, `research_progress`, `paper`, `initiative`, `plans`, `percentile`, `suggested_grade`, `comments`) VALUES
(1, 32, 'Grad Student Level', 'Amazing', '2', '3 = Student''s ideas yiel', '3 = Yes, s/he is the pri', 'Top 5%', 'A+', 'asdf');

-- --------------------------------------------------------

--
-- Table structure for table `checkpoint1`
--

CREATE TABLE IF NOT EXISTS `checkpoint1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `number_of_meetings` tinyint(10) DEFAULT NULL,
  `student_comments` text,
  `advisor_read` tinyint(1) DEFAULT NULL,
  `advisor_more_meetings` tinyint(1) DEFAULT NULL,
  `student_progress_eval` tinyint(1) DEFAULT NULL,
  `advisor_comments` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `checkpoint1`
--

INSERT INTO `checkpoint1` (`id`, `project_id`, `number_of_meetings`, `student_comments`, `advisor_read`, `advisor_more_meetings`, `student_progress_eval`, `advisor_comments`) VALUES
(1, 32, 9, NULL, NULL, NULL, NULL, NULL),
(3, 45, 0, '', 1, 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `checkpoint2`
--

CREATE TABLE IF NOT EXISTS `checkpoint2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `number_of_meetings` text,
  `student_comments` text,
  `advisor_read` tinyint(1) DEFAULT NULL,
  `advisor_more_meetings` tinyint(1) DEFAULT NULL,
  `student_progress_eval` tinyint(1) DEFAULT NULL,
  `advisor_comments` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `checkpoint2`
--

INSERT INTO `checkpoint2` (`id`, `project_id`, `number_of_meetings`, `student_comments`, `advisor_read`, `advisor_more_meetings`, `student_progress_eval`, `advisor_comments`) VALUES
(1, 32, '1000', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `netID` varchar(12) NOT NULL,
  `department` varchar(128) NOT NULL,
  PRIMARY KEY (`netID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `february`
--

CREATE TABLE IF NOT EXISTS `february` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `number_of_meetings` tinyint(10) DEFAULT NULL,
  `student_comments` text,
  `advisor_read` tinyint(1) DEFAULT NULL,
  `advisor_more_meetings` tinyint(1) DEFAULT NULL,
  `student_progress_eval` tinyint(10) DEFAULT NULL,
  `advisor_comments` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `february`
--

INSERT INTO `february` (`id`, `project_id`, `number_of_meetings`, `student_comments`, `advisor_read`, `advisor_more_meetings`, `student_progress_eval`, `advisor_comments`) VALUES
(4, 32, 9, 'asdf', NULL, NULL, NULL, NULL),
(8, 45, 127, '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_netID` varchar(12) NOT NULL,
  `advisor_netID` varchar(12) DEFAULT NULL,
  `second_reader_netID` varchar(12) DEFAULT NULL,
  `semester` varchar(3) DEFAULT NULL,
  `project_title` varchar(128) DEFAULT NULL,
  `description` text,
  `coursework` varchar(20) DEFAULT NULL,
  `date_began` date DEFAULT NULL,
  `date_met` date DEFAULT NULL,
  `advisor_approved` tinyint(1) DEFAULT NULL,
  `second_reader_approved` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `student_netID`, `advisor_netID`, `second_reader_netID`, `semester`, `project_title`, `description`, `coursework`, `date_began`, `date_met`, `advisor_approved`, `second_reader_approved`) VALUES
(32, 'test', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, 1, NULL),
(33, 'stud', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, 1, NULL),
(34, 'test_date', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, 1, NULL),
(35, 'xiaoyanh', 'faculty', NULL, 'F13', 'Optimization of Quantum Vacuum Stars', 'no idea', 'BSE Senior Thesis', '2013-07-17', '2013-07-10', NULL, NULL),
(45, 'Fitz', 'faculty', NULL, 'F13', 'ABC', 'ABC', '497', '2013-07-18', '0000-00-00', 0, NULL),
(46, 'probz', 'faculty', NULL, 'F13', 'probz', 'probz', '497', '2013-07-18', '0000-00-00', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `second_reader_feedback`
--

CREATE TABLE IF NOT EXISTS `second_reader_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `research` varchar(24) NOT NULL,
  `research_progress` varchar(24) NOT NULL,
  `paper` varchar(24) NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `second_reader_feedback`
--

INSERT INTO `second_reader_feedback` (`id`, `project_id`, `research`, `research_progress`, `paper`, `comments`) VALUES
(1, 32, '3', '3', '3', 'asdf'),
(2, 33, 'Grad Student Level', 'Amazing', 'Excellent', 'asdf');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `netID` varchar(12) NOT NULL,
  `class_year` int(4) NOT NULL,
  PRIMARY KEY (`netID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `netID` varchar(12) NOT NULL,
  `user_type` varchar(16) NOT NULL DEFAULT 'student',
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`netID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Parent user table';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`netID`, `user_type`, `name`) VALUES
('admin', 'administrator', NULL),
('asdf', 'faculty', NULL),
('asg4', 'administrator', NULL),
('ayin', 'student', NULL),
('donna', 'faculty', NULL),
('ellenz', 'student', NULL),
('fac', 'faculty', NULL),
('faculty', 'faculty', NULL),
('Fitz', 'student', NULL),
('john_doe', 'student', ''),
('kkoutras', 'administrator', NULL),
('new_guy', 'faculty', NULL),
('opb', 'administrator', NULL),
('probz', 'student', NULL),
('student', 'student', ''),
('xiaoyanh', 'student', NULL),
('yo', 'faculty', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advisor_feedback`
--
ALTER TABLE `advisor_feedback`
  ADD CONSTRAINT `advisor_feedback_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`);

--
-- Constraints for table `checkpoint1`
--
ALTER TABLE `checkpoint1`
  ADD CONSTRAINT `checkpoint1_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`);

--
-- Constraints for table `checkpoint2`
--
ALTER TABLE `checkpoint2`
  ADD CONSTRAINT `checkpoint2_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`);

--
-- Constraints for table `faculty`
--
ALTER TABLE `faculty`
  ADD CONSTRAINT `faculty_ibfk_1` FOREIGN KEY (`netID`) REFERENCES `user` (`netID`);

--
-- Constraints for table `february`
--
ALTER TABLE `february`
  ADD CONSTRAINT `february_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`);

--
-- Constraints for table `second_reader_feedback`
--
ALTER TABLE `second_reader_feedback`
  ADD CONSTRAINT `second_reader_feedback_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`netID`) REFERENCES `user` (`netID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
