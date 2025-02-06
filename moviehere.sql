-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2025 at 12:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moviehere`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `catid` int(11) NOT NULL,
  `catname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catid`, `catname`) VALUES
(1, 'Hollywood'),
(2, 'Bollywood'),
(3, 'Lollywood'),
(4, 'Nollywood'),
(5, 'France cinéma');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `classid` int(11) NOT NULL,
  `classname` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movieid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `releasedate` date NOT NULL,
  `image` varchar(1000) NOT NULL,
  `trailer` varchar(1000) NOT NULL,
  `movie` varchar(10000) NOT NULL,
  `rating` varchar(50) NOT NULL,
  `catid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movieid`, `title`, `description`, `releasedate`, `image`, `trailer`, `movie`, `rating`, `catid`) VALUES
(1, 'Fight Club', 'Fight Club (1999) is a groundbreaking psychological drama directed by David Fincher, based on Chuck Palahniuk\'s novel. The story follows an unnamed insomniac narrator (Edward Norton), a disillusioned office worker seeking meaning in his mundane life. His ', '1999-10-15', 'Fight Club.jpeg', 'mov_bbb.mp4', 'mov_bbb.mp4', '9', 1),
(2, 'Commando 3', 'Commando 3 is a 2019 Indian Hindi-language action thriller film directed by Aditya Datt and produced by Vipul Amrutlal Shah, Reliance Entertainment.The film is the sequel of Commando: A One Man Army (2013) and Commando 2: The Black Money Trail (2017). The', '2019-11-15', 'commando3.jpg', 'Commando 3 Official Trailer.mp4', 'Commando 3 Official Trailer.mp4', '5', 2),
(3, 'Bharat', 'Bharat is a Bollywood drama film directed by Ali Abbas Zafar, starring Salman Khan, Katrina Kaif, Sunil Grover, Disha Patani, and Jackie Shroff. The film, based on the South Korean movie Ode to My Father (2014), follows the journey of a man named Bharat (', '2019-06-05', 'bharat.jpeg', 'BHARAT Official Trailer.mp4', 'BHARAT Official Trailer.mp4', '5', 2);

-- --------------------------------------------------------

--
-- Table structure for table `theater`
--

CREATE TABLE `theater` (
  `theaterid` int(11) NOT NULL,
  `movieid` varchar(50) NOT NULL,
  `timing` varchar(50) NOT NULL,
  `days` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `userid` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `rotetype` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`userid`, `Name`, `Email`, `Password`, `rotetype`) VALUES
(1, 'Admin', 'mussabzia101@gmail.com', 'minimum1234', 1),
(2, 'Sohaib Zia', 'sohaibzia123@gmail.com', 'iamhere', 0),
(3, 'Ali Sheikh', 'alihere2@gmail.com', 'alihere', 0),
(4, 'hannan', 'hannan.nasir18@gmail.com', 'hannan', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movieid`);

--
-- Indexes for table `theater`
--
ALTER TABLE `theater`
  ADD PRIMARY KEY (`theaterid`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movieid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `theater`
--
ALTER TABLE `theater`
  MODIFY `theaterid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
