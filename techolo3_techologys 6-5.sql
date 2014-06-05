
-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2014 at 09:08 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `techolo3_techologys`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail`
--

CREATE TABLE IF NOT EXISTS `detail` (
  `ID` int(32) NOT NULL AUTO_INCREMENT,
  `TYPE` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `USER` tinyint(1) NOT NULL,
  `VALUE` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `USERID` int(32) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `OWNERID` (`USERID`),
  KEY `OWNERID_2` (`USERID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `emailaccount`
--

CREATE TABLE IF NOT EXISTS `emailaccount` (
  `ID` int(32) NOT NULL AUTO_INCREMENT,
  `USERID` int(32) NOT NULL,
  `EMAIL` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `FIRSTNAME` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `LASTNAME` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `HASHPASS` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `USERID` (`USERID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `emailaccount`
--

INSERT INTO `emailaccount` (`ID`, `USERID`, `EMAIL`, `FIRSTNAME`, `LASTNAME`, `HASHPASS`) VALUES
(7, 7, 'jonathanetyler@gmail.com', 'Jonathon', 'Tyler', '$2y$10$iQGo3GP6mqe1m8O.dnBbzOt0xlRvaqPysOqEOYysQH2zwxLZ4YP.u'),
(8, 8, 'gtschroath@gmail.com', 'Garrett', 'Schroath', '$2y$10$id4lJ8msehhynVGvJaABOeH5/hkDpuCrQrGbPvTibLht4gKTepDB.');

-- --------------------------------------------------------

--
-- Table structure for table `listing`
--

CREATE TABLE IF NOT EXISTS `listing` (
  `ID` int(32) NOT NULL AUTO_INCREMENT,
  `USERID` int(32) NOT NULL,
  `SUBCATEGORYID` int(32) NOT NULL,
  `NAME` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `DESC` text COLLATE utf8_unicode_ci NOT NULL,
  `PATENTSTATUS` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `LISTAGREEMENT` tinyint(1) NOT NULL,
  `RIGHTS` tinyint(1) NOT NULL,
  `RIGHTSDETAILS` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`),
  KEY `USERID` (`USERID`),
  KEY `SUBCAT` (`SUBCATEGORYID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=42 ;

--
-- Dumping data for table `listing`
--

INSERT INTO `listing` (`ID`, `USERID`, `SUBCATEGORYID`, `NAME`, `DESC`, `PATENTSTATUS`, `LISTAGREEMENT`, `RIGHTS`, `RIGHTSDETAILS`) VALUES
(33, 1, 3, 'TEST NAME', 'TEST DESC', 'TEST PATENT', 1, 1, 'NONE'),
(34, 1, 3, 'TEST NAME', 'TEST DESC', 'TEST PATENT', 1, 1, 'NONE'),
(35, 1, 3, 'TEST NAME', 'TEST DESC', 'TEST PATENT', 1, 1, 'NONE'),
(40, 1, 2, 'Super new chemistry', 'tester summary', 'Pending', 1, 0, 'Not Applicable'),
(41, 1, 2, 'Super new chemistry', 'tester summary', 'Pending', 1, 0, 'Not Applicable');

-- --------------------------------------------------------

--
-- Table structure for table `maincategory`
--

CREATE TABLE IF NOT EXISTS `maincategory` (
  `ID` int(32) NOT NULL AUTO_INCREMENT,
  `CATEGORY` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `maincategory`
--

INSERT INTO `maincategory` (`ID`, `CATEGORY`) VALUES
(1, 'Life Science'),
(2, 'Nano Technology'),
(3, 'Physical Science'),
(4, 'Wireless');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `ID` int(32) NOT NULL AUTO_INCREMENT,
  `QUESTIONCATEGORYID` int(32) NOT NULL,
  `QUESTION` text COLLATE utf8_unicode_ci NOT NULL,
  `NAME` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `QCID` (`QUESTIONCATEGORYID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10000014 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`ID`, `QUESTIONCATEGORYID`, `QUESTION`, `NAME`) VALUES
(10000007, 1, 'How large is the market?', 'MarketSize0'),
(10000008, 3, 'How novel is the product?', 'Novelty0'),
(10000013, 2, 'Is the potential for growth high?', 'Growth0');

-- --------------------------------------------------------

--
-- Table structure for table `questioncategory`
--

CREATE TABLE IF NOT EXISTS `questioncategory` (
  `ID` int(32) NOT NULL AUTO_INCREMENT,
  `CATEGORY` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `questioncategory`
--

INSERT INTO `questioncategory` (`ID`, `CATEGORY`) VALUES
(1, 'Market Size'),
(2, 'Growth'),
(3, 'Novelty');

-- --------------------------------------------------------

--
-- Table structure for table `questionvalue`
--

CREATE TABLE IF NOT EXISTS `questionvalue` (
  `ID` int(32) NOT NULL AUTO_INCREMENT,
  `LISTINGID` int(32) NOT NULL,
  `VALUE` int(32) NOT NULL,
  `QUESTIONID` int(32) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `LISTINGID` (`LISTINGID`),
  KEY `QUESTIONID` (`QUESTIONID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=76 ;

--
-- Dumping data for table `questionvalue`
--

INSERT INTO `questionvalue` (`ID`, `LISTINGID`, `VALUE`, `QUESTIONID`) VALUES
(57, 33, 1, 10000007),
(70, 40, 4, 10000007),
(71, 40, 2, 10000008),
(72, 40, 4, 10000013),
(73, 41, 4, 10000007),
(74, 41, 2, 10000008),
(75, 41, 4, 10000013);

-- --------------------------------------------------------

--
-- Table structure for table `securityitem`
--

CREATE TABLE IF NOT EXISTS `securityitem` (
  `ID` int(32) NOT NULL AUTO_INCREMENT,
  `SECURITYQUESTIONID` int(32) NOT NULL,
  `EMAILACCOUNTID` int(32) NOT NULL,
  `ANSWER` int(32) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `SECURITYQUESTIONID` (`SECURITYQUESTIONID`),
  KEY `USERID` (`EMAILACCOUNTID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `securityquestion`
--

CREATE TABLE IF NOT EXISTS `securityquestion` (
  `ID` int(32) NOT NULL AUTO_INCREMENT,
  `SECURITYQUESTION` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `securityquestion`
--

INSERT INTO `securityquestion` (`ID`, `SECURITYQUESTION`) VALUES
(1, 'What is the name of your elementary school?'),
(5, 'What is your mother''s maiden name?');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE IF NOT EXISTS `subcategory` (
  `ID` int(32) NOT NULL AUTO_INCREMENT,
  `CATEGORY` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `MAINCATEGORYID` int(32) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `MAINCATID` (`MAINCATEGORYID`),
  KEY `MAINCATID_2` (`MAINCATEGORYID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`ID`, `CATEGORY`, `MAINCATEGORYID`) VALUES
(1, 'Biology', 1),
(2, 'Chemistry', 1),
(3, 'Geology', 3),
(4, 'Nuclear', 2),
(5, 'Routing', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(32) NOT NULL AUTO_INCREMENT,
  `TYPE` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `ADMIN` tinyint(1) NOT NULL,
  `DEMOGRAPHICS` text COLLATE utf8_unicode_ci,
  `POSITION` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `TYPE`, `ADMIN`, `DEMOGRAPHICS`, `POSITION`) VALUES
(1, 'EMAIL', 1, 'stuff', 'CIO of Blank Corp'),
(7, 'EMAIL', 1, NULL, NULL),
(8, 'EMAIL', 1, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail`
--
ALTER TABLE `detail`
  ADD CONSTRAINT `detail_ibfk_1` FOREIGN KEY (`USERID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `emailaccount`
--
ALTER TABLE `emailaccount`
  ADD CONSTRAINT `emailaccount_ibfk_1` FOREIGN KEY (`USERID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `listing`
--
ALTER TABLE `listing`
  ADD CONSTRAINT `listing_ibfk_1` FOREIGN KEY (`USERID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `listing_ibfk_2` FOREIGN KEY (`SUBCATEGORYID`) REFERENCES `subcategory` (`ID`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`QUESTIONCATEGORYID`) REFERENCES `questioncategory` (`ID`);

--
-- Constraints for table `questionvalue`
--
ALTER TABLE `questionvalue`
  ADD CONSTRAINT `questionvalue_ibfk_1` FOREIGN KEY (`LISTINGID`) REFERENCES `listing` (`ID`),
  ADD CONSTRAINT `questionvalue_ibfk_2` FOREIGN KEY (`QUESTIONID`) REFERENCES `question` (`ID`);

--
-- Constraints for table `securityitem`
--
ALTER TABLE `securityitem`
  ADD CONSTRAINT `securityitem_ibfk_1` FOREIGN KEY (`SECURITYQUESTIONID`) REFERENCES `securityquestion` (`ID`),
  ADD CONSTRAINT `securityitem_ibfk_2` FOREIGN KEY (`EMAILACCOUNTID`) REFERENCES `emailaccount` (`ID`);

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`MAINCATEGORYID`) REFERENCES `maincategory` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
