-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 10, 2019 at 09:09 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `date` date NOT NULL,
  `approval` int(11) NOT NULL DEFAULT '0',
  `reason` text NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`aid`, `uid`, `did`, `date`, `approval`, `reason`) VALUES
(1, 2, 1, '2019-06-11', 1, 'irritation in eyes'),
(2, 4, 2, '2019-06-11', 1, 'chest pain');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `hid` varchar(255) NOT NULL,
  `license` varchar(255) NOT NULL,
  `specialArea` text NOT NULL,
  `avail_from` time NOT NULL,
  `avail_till` time NOT NULL,
  `dapproved` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`did`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`did`, `uid`, `hid`, `license`, `specialArea`, `avail_from`, `avail_till`, `dapproved`) VALUES
(1, 3, 'ChIJixbcngr9mzkRfouU9V00Jjw', '12345', 'eye specialist', '11:00:00', '18:30:00', 1),
(2, 5, 'ChIJI5OrNQz9mzkRl8mJYZILHkk', '456234', 'cardeologist', '10:30:00', '19:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

DROP TABLE IF EXISTS `driver`;
CREATE TABLE IF NOT EXISTS `driver` (
  `dr_id` int(11) NOT NULL AUTO_INCREMENT,
  `driving_license` varchar(255) NOT NULL,
  `vehicle_no` varchar(20) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `uid` int(11) NOT NULL,
  `avail` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`dr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`dr_id`, `driving_license`, `vehicle_no`, `lat`, `lng`, `uid`, `avail`) VALUES
(1, '2324', '567', 26.8552134, 80.95093169999996, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `emergency`
--

DROP TABLE IF EXISTS `emergency`;
CREATE TABLE IF NOT EXISTS `emergency` (
  `emer_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `dr_id` int(11) DEFAULT NULL,
  `elat` double NOT NULL,
  `elng` double NOT NULL,
  `approval` int(11) NOT NULL DEFAULT '0',
  `hid` varchar(255) DEFAULT NULL,
  `dest_reached` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`emer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `ename` varchar(255) NOT NULL,
  `edescription` text NOT NULL,
  `edate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hid` varchar(255) NOT NULL,
  PRIMARY KEY (`eid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eid`, `ename`, `edescription`, `edate`, `hid`) VALUES
(1, 'Blood donation camp', 'Interested people after getting their blood test done can donate blood', '2019-06-10 20:35:53', 'ChIJixbcngr9mzkRfouU9V00Jjw');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

DROP TABLE IF EXISTS `hospital`;
CREATE TABLE IF NOT EXISTS `hospital` (
  `h_id` varchar(255) NOT NULL,
  `hname` varchar(255) NOT NULL,
  `haddr` varchar(255) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `hmail` varchar(255) NOT NULL,
  `hpassword` varchar(255) NOT NULL,
  `hphone` varchar(13) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`h_id`, `hname`, `haddr`, `lat`, `lng`, `hmail`, `hpassword`, `hphone`, `hash`, `active`) VALUES
('ChIJixbcngr9mzkRfouU9V00Jjw', 'Indira IVF Lucknow', 'Ground Floor, Shalimar Logix, 4 A Rana Pratap Marg, Hazratganj, Lucknow, Uttar Pradesh 226001, India', 26.857584, 80.94303500000001, 'apurva.sharma.756@gmail.com', '37a5641dcfd34dc1d5d20906dfd72f25', '1234567890', '0', 1),
('ChIJI5OrNQz9mzkRl8mJYZILHkk', 'Medanta Mediclinic', 'B-25, Ashok Marg, Sikandarbagh Chauraha, Lucknow, Uttar Pradesh 226001, India', 26.8552134, 80.95093169999996, 'apurva_sweet98@yahoo.com', 'dfd54925d0639f7c9d34d6341913bb8c', '987651234', '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `ntype` varchar(255) NOT NULL,
  `notified_by` varchar(255) NOT NULL,
  `notify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notify_read` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`nid`, `uid`, `ntype`, `notified_by`, `notify_time`, `notify_read`) VALUES
(1, 2, 'DA', '3', '2019-06-10 20:38:20', 1),
(2, 4, 'DA', '5', '2019-06-10 20:59:37', 1),
(3, 4, 'DR', '5', '2019-06-10 21:00:05', 1),
(4, 2, 'DR', '3', '2019-06-10 21:02:17', 1),
(6, 2, 'EB', 'ChIJixbcngr9mzkRfouU9V00Jjw', '2019-06-10 21:06:17', 1),
(7, 4, 'EB', 'ChIJixbcngr9mzkRfouU9V00Jjw', '2019-06-10 21:06:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
CREATE TABLE IF NOT EXISTS `report` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL,
  `summary` text NOT NULL,
  `report` varchar(255) NOT NULL,
  `prescription` text NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`rid`, `aid`, `summary`, `report`, `prescription`) VALUES
(1, 2, ' nh', '9251-10.1-new-route.png', 'njfkr'),
(2, 1, 'hii', '66767-nature-night-wallpapers-1080p.jpeg', 'bygjgy');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `emer1` varchar(13) DEFAULT NULL,
  `emer2` varchar(13) DEFAULT NULL,
  `addr` text,
  `dob` date DEFAULT NULL,
  `avatar` varchar(255) NOT NULL,
  `aadhar` int(11) DEFAULT NULL,
  `hash` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `pincode` int(6) DEFAULT NULL,
  `bloodgroup` varchar(3) DEFAULT NULL,
  `medicalHis` text,
  `infoUpdated` int(11) NOT NULL DEFAULT '0',
  `user_type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`, `emer1`, `emer2`, `addr`, `dob`, `avatar`, `aadhar`, `hash`, `active`, `pincode`, `bloodgroup`, `medicalHis`, `infoUpdated`, `user_type`) VALUES
(2, 'apurva', 'apurva.sharma.756@gmail.com', '742bb89ea95b66cc241502312a8ceb22', '1234567890', '1234567890', '45456', 'abcdef', '1999-10-20', 'Love-Sunset-HD-Wallpapers-1080p.jpeg', 8764, '0', 1, 243005, 'B+', 'frequent stomach-ache', 1, 0),
(3, 'apurvadoc', 'apurva_sweet98@yahoo.com', 'd9f0f7ef2039d1ca55604c65a7f7001f', '1234511111', '1234511111', '3433434', 'bcdes', '1989-07-26', '54d4fc76fe7f243433c4e8bbdcf817bf.jpg', 1234, '0', 1, 243005, 'B-', 'Enter Your Previous Medical history', 1, 2),
(4, 'aryan', 'aryanisaboy@gmail.com', 'adcbecb8ca261a14129d21be5ff88dc6', '86786', '232434', '35456', 'qwer4', '1997-06-09', 'idyllic_landscape_italy-wallpaper-1366x768.jpg', 343, '0', 1, 243005, 'B+', 'Enter Your Previous Medical history', 1, 1),
(5, 'aryandoc', 'aryankaushik2023@gmail.com', '4ddef06029b7bc767b3e3d4e9d48f4cc', '565756', '4343', '678', 'trreferg', '1994-05-01', '4865975-laptop-wallpapers.jpg', 2345, '0', 1, 24305, 'O+', 'Enter Your Previous Medical history', 1, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
