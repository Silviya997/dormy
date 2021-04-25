-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2021 at 09:49 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dormy`
--

-- --------------------------------------------------------

--
-- Table structure for table `accdata`
--

CREATE TABLE `accdata` (
  `data_id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `accommodated` date NOT NULL,
  `is_left` date NOT NULL,
  `RoomNo` int(11) NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accdata`
--

INSERT INTO `accdata` (`data_id`, `userId`, `accommodated`, `is_left`, `RoomNo`, `room_id`) VALUES
(90, 72, '2021-04-24', '2021-10-24', 205, 5),
(91, 85, '2021-04-25', '2021-10-25', 211, 11),
(92, 79, '2021-04-25', '2021-10-25', 204, 4),
(93, 1, '2021-04-25', '2021-10-25', 222, 22);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `January` double NOT NULL,
  `February` double NOT NULL,
  `March` double NOT NULL,
  `April` double NOT NULL,
  `May` double NOT NULL,
  `June` double NOT NULL,
  `July` double NOT NULL,
  `August` double NOT NULL,
  `September` double NOT NULL,
  `October` double NOT NULL,
  `November` double NOT NULL,
  `December` double NOT NULL,
  `Total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `roomNo` int(11) NOT NULL,
  `stateOfroom` varchar(30) NOT NULL DEFAULT 'free'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `roomNo`, `stateOfroom`) VALUES
(1, 201, 'free'),
(2, 202, 'free'),
(3, 203, 'free'),
(4, 204, 'occupied'),
(5, 205, 'occupied'),
(6, 206, 'free'),
(7, 207, 'free'),
(8, 208, 'free'),
(9, 209, 'free'),
(10, 210, 'free'),
(11, 211, 'occupied'),
(12, 212, 'free'),
(13, 213, 'free'),
(14, 214, 'free'),
(15, 215, 'free'),
(16, 216, 'free'),
(17, 217, 'free'),
(18, 218, 'free'),
(19, 219, 'free'),
(20, 220, 'free'),
(21, 221, 'free'),
(22, 222, 'occupied'),
(23, 223, 'free'),
(24, 224, 'free'),
(25, 225, 'free'),
(26, 226, 'free'),
(27, 227, 'free'),
(28, 228, 'free'),
(29, 229, 'free'),
(30, 230, 'free');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `m_name` varchar(30) NOT NULL,
  `l_name` varchar(30) NOT NULL,
  `egn` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pass1` varchar(60) NOT NULL,
  `pass2` varchar(60) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `salt` varchar(60) NOT NULL,
  `fakNo` varchar(30) NOT NULL,
  `university` varchar(20) NOT NULL,
  `course` varchar(20) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `f_name`, `m_name`, `l_name`, `egn`, `email`, `username`, `pass1`, `pass2`, `phone`, `salt`, `fakNo`, `university`, `course`, `semester`, `role`) VALUES
(1, 'Silvija', 'Gerov', 'Stankov', '9865486314', 'siki@gmail.com', 'siki', 'dc5742e9b0c07893e1e98c3a299edcdc', '', '0897578403', 'dorm987', '220001', 'VUTP', 'BK', '4', 0),
(2, 'Dragana', '', 'Mitic', '984937593', 'gaga@gmail.com', 'gaga', 'fc135761cce1b79cbb8b44b977e3470d', '', '0394038503', 'dorm987', '', '', '', '', 2),
(3, 'Nikola', 'Milanov', 'Nikolov', '956845684', 'silvija.gerov97@gmail.com', 'niki', 'cb8621c487bf0545869f216882310cba', '', '0103678956', 'dorm987', '22005', 'VUTP', 'TT', '1', 0),
(4, 'Miodrag', '', 'Stankov', '96578320387', 'misa.stankov95@gmail.com', 'misa', '2633b08e6e17619623183824cdb84740', '', '03814569875', 'dorm987', '220002', 'VUTP', 'IT', '3', 0),
(5, 'Ana', 'Ivanova', 'Ivanova', '99789789', 'ana@gmail.com', 'ana', '53e88e72acf931dfcbe732df7f32bb53', '', '0284830308', 'dorm987', '', '', '', '', 1),
(6, 'Ivan', 'Kostov', 'Ivanov', '997665544', 'ivan@gmail.com', 'ivan', '9330f1e84a37dd86c38d7e0371b89120', '', '0284759400', 'dorm987', '220005', 'VUTP', 'TT', '2', 0),
(9, 'Maria', '', 'Petkova', '965432158', 'phpexample356@gmail.com', 'maka', 'de76b2f324161dc634c3d97b7582fd11', '', '+35978546321', 'dorm987', '010101', 'UNSS', 'ECONOMY', '4', 0),
(72, 'Mila', 'Arsova', 'Dimitrova', '200045789', 'mila@gmail.com', 'mila1234', '2c3f87fc0d8d226f70871795d73d7f20', '', '+381789456', 'dorm987', '220010', 'VUTP', 'BK', '3', 0),
(77, 'Silvija', 'Misa', 'Stankov', '541653131', 'ss@gmail.com', '123', '4b23391840f0e3e32dc56744d77d3e08', '', '017624826320', 'dorm987', '26321', 'VUTP', 'TT', '5', 0),
(78, 'Daniel', 'Georgiev', 'Kostov', '789654123', 'dani@gmail.com', 'Daniel12', 'a80203814c0e72cf3af776678d41eff0', '', '+3812654789', 'dorm987', '220006', 'VUTP', 'TT', '4', 0),
(79, 'Milena', 'Asenova', 'Metodieva', '8845654569', 'milena@gmail.com', 'Milena12', 'd89846c18944ea3eb8c45094c0a3a167', '', '0035945698', 'dorm987', '010107', 'VUTP', 'BK', '1', 0),
(80, 'Denis', 'Manov', 'Simov', '745698546', 'denis@gmail.com', 'Denis123', '06011bbe34f077916a3b68e0870e5e59', '', '0884569856', 'dorm987', '010138', 'VUTP', 'IT', '4', 0),
(84, 'Damir', '', 'Aleksov', '854695654', 'damir@gmail.com', 'Damir123', '7273ed1c534e14111768b4e5f09f50cf', '', '+656465413', 'dorm987', '010139', 'SU', 'HISTORY', '5', 0),
(85, 'Georgi', 'Georgiev', 'Petrov', '45698465151', 'gogi@gmail.com', 'Georgi1@', '8c883611537e380349c4dc318e73d6ac', '', '+4965413669', 'dorm987', '306', 'TU', 'MEHATRONIC', '1', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accdata`
--
ALTER TABLE `accdata`
  ADD PRIMARY KEY (`data_id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `roomNo` (`RoomNo`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roomNo` (`roomNo`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accdata`
--
ALTER TABLE `accdata`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accdata`
--
ALTER TABLE `accdata`
  ADD CONSTRAINT `accdata_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `accdata_ibfk_3` FOREIGN KEY (`RoomNo`) REFERENCES `rooms` (`roomNo`),
  ADD CONSTRAINT `accdata_ibfk_4` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
