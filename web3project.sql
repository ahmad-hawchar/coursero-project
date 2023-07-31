-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2023 at 12:55 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web3project`
--

-- --------------------------------------------------------

--
-- Table structure for table `approved`
--

CREATE TABLE `approved` (
  `appr` int(1) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blocked`
--

CREATE TABLE `blocked` (
  `teacher_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`name`) VALUES
('informatique');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(5) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fav`
--

CREATE TABLE `fav` (
  `id_student` int(11) NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fav`
--

INSERT INTO `fav` (`id_student`, `id_post`) VALUES
(42, 43),
(42, 43),
(42, 44),
(42, 45),
(42, 46),
(42, 47),
(42, 48),
(42, 49),
(42, 50),
(42, 51),
(42, 52);

-- --------------------------------------------------------

--
-- Table structure for table `featured`
--

CREATE TABLE `featured` (
  `featured-id` int(30) NOT NULL,
  `id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `Id` int(5) NOT NULL,
  `Date` date NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Id_t` int(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `picture` varchar(30) NOT NULL,
  `price` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`Id`, `Date`, `Description`, `Id_t`, `category`, `picture`, `price`) VALUES
(43, '2023-06-04', 'testA0', 44, 'informatique', 'image.jpeg', 25),
(44, '2023-06-04', 'testA1', 44, 'informatique', 'image.jpeg', 25),
(45, '2023-06-04', 'testA2', 44, 'informatique', 'image.jpeg', 25),
(46, '2023-06-04', 'testA3', 44, 'informatique', 'image.jpeg', 25),
(47, '2023-06-04', 'testA4', 44, 'informatique', 'image.jpeg', 25),
(48, '2023-06-04', 'testA5', 44, 'informatique', 'image.jpeg', 25),
(49, '2023-06-04', 'testA6', 44, 'informatique', 'image.jpeg', 25),
(50, '2023-06-04', 'testA7', 44, 'informatique', 'image.jpeg', 25),
(51, '2023-06-04', 'testA8', 44, 'informatique', 'image.jpeg', 25),
(52, '2023-06-04', 'testA9', 44, 'informatique', 'image.jpeg', 25),
(53, '2023-06-04', 'testB0', 44, 'informatique', 'image.jpeg', 25),
(54, '2023-06-04', 'testB1', 44, 'informatique', 'image.jpeg', 25),
(55, '2023-06-04', 'testB2', 44, 'informatique', 'image.jpeg', 25),
(56, '2023-06-04', 'testB3', 44, 'informatique', 'image.jpeg', 25),
(57, '2023-06-04', 'testB4', 44, 'informatique', 'image.jpeg', 25),
(58, '2023-06-04', 'testB5', 44, 'informatique', 'image.jpeg', 25),
(59, '2023-06-04', 'testB6', 44, 'informatique', 'image.jpeg', 25),
(60, '2023-06-04', 'testB7', 44, 'informatique', 'image.jpeg', 25),
(61, '2023-06-04', 'testB8', 44, 'informatique', 'image.jpeg', 25),
(62, '2023-06-04', 'testB9', 44, 'informatique', 'image.jpeg', 10),
(63, '2023-06-04', 'testF2', 44, 'informatique', 'image.jpeg', 10),
(64, '2023-06-04', 'testC1', 44, 'informatique', 'image.jpeg', 10),
(65, '2023-06-04', 'testC2', 44, 'informatique', 'image.jpeg', 10),
(66, '2023-06-04', 'testC3', 44, 'informatique', 'image.jpeg', 10),
(67, '2023-06-04', 'testC4', 44, 'informatique', 'image.jpeg', 10),
(68, '2023-06-04', 'testC5', 44, 'informatique', 'image.jpeg', 10),
(69, '2023-06-04', 'testC6', 44, 'informatique', 'image.jpeg', 10),
(70, '2023-06-04', 'testC7', 44, 'informatique', 'image.jpeg', 10),
(71, '2023-06-04', 'testC8', 44, 'informatique', 'image.jpeg', 10),
(72, '2023-06-04', 'testC9', 44, 'informatique', 'image.jpeg', 10),
(73, '2023-06-04', 'testD1', 44, 'informatique', 'image.jpeg', 10),
(74, '2023-06-04', 'testD2', 44, 'informatique', 'image.jpeg', 10),
(75, '2023-06-04', 'testD3', 44, 'informatique', 'image.jpeg', 10),
(76, '2023-06-04', 'testD4', 44, 'informatique', 'image.jpeg', 10),
(77, '2023-06-04', 'testD5', 44, 'informatique', 'image.jpeg', 10),
(78, '2023-06-04', 'testD6', 44, 'informatique', 'image.jpeg', 10),
(79, '2023-06-04', 'testD7', 44, 'informatique', 'image.jpeg', 10),
(80, '2023-06-04', 'testD8', 44, 'informatique', 'image.jpeg', 10),
(81, '2023-06-04', 'testD9', 44, 'informatique', 'image.jpeg', 10),
(82, '2023-06-04', 'testE1', 44, 'informatique', 'image.jpeg', 10),
(83, '2023-06-04', 'testE2', 44, 'informatique', 'image.jpeg', 10),
(84, '2023-06-04', 'testE3', 44, 'informatique', 'image.jpeg', 10),
(85, '2023-06-04', 'testE4', 44, 'informatique', 'image.jpeg', 10),
(86, '2023-06-04', 'testE5', 44, 'informatique', 'image.jpeg', 10),
(87, '2023-06-04', 'testE6', 44, 'informatique', 'image.jpeg', 10),
(88, '2023-06-04', 'testE7', 44, 'informatique', 'image.jpeg', 10),
(89, '2023-06-04', 'testE8', 44, 'informatique', 'image.jpeg', 10),
(90, '2023-06-04', 'testE9', 44, 'informatique', 'image.jpeg', 10),
(91, '2023-06-04', 'testF1', 44, 'informatique', 'image.jpeg', 10);

-- --------------------------------------------------------

--
-- Table structure for table `review_courses`
--

CREATE TABLE `review_courses` (
  `student_id` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `rating` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review_post`
--

CREATE TABLE `review_post` (
  `post_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review_teacher`
--

CREATE TABLE `review_teacher` (
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(3) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `description`) VALUES
(1, 'teacher'),
(2, 'student'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `id_student` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `Fname` varchar(50) NOT NULL,
  `Lname` varchar(50) NOT NULL,
  `Date_Of_Birth` date NOT NULL,
  `gender` varchar(30) NOT NULL,
  `Role_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `Fname`, `Lname`, `Date_Of_Birth`, `gender`, `Role_Id`) VALUES
(1, 'teachertest', 'abc', 'teacher', 'teacher', '2023-06-13', 'female', 1),
(2, 'admintest', 'abc', 'admin', 'admin', '2023-06-07', '', 3),
(41, 'loob', 'adc', 'buhmed', 'hawchar', '2023-06-13', '', 1),
(42, 'kl', 'abc', 'buhmed', 'hawchar', '2023-06-27', '', 1),
(43, 'dsa', 'md5(abc)', 'test', 'hawchar', '2023-05-31', '', 2),
(44, 'daddad', 'daddad', 'test1', 'hawchar', '2023-06-01', 'female', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approved`
--
ALTER TABLE `approved`
  ADD PRIMARY KEY (`appr`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `blocked`
--
ALTER TABLE `blocked`
  ADD KEY `student_id` (`student_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_teacher` (`id_teacher`);

--
-- Indexes for table `fav`
--
ALTER TABLE `fav`
  ADD KEY `id_post` (`id_post`),
  ADD KEY `id_student` (`id_student`);

--
-- Indexes for table `featured`
--
ALTER TABLE `featured`
  ADD PRIMARY KEY (`featured-id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_t` (`Id_t`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `review_courses`
--
ALTER TABLE `review_courses`
  ADD KEY `id_course` (`id_course`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `review_post`
--
ALTER TABLE `review_post`
  ADD KEY `post_id` (`post_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `review_teacher`
--
ALTER TABLE `review_teacher`
  ADD KEY `student_id` (`student_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_course` (`id_course`),
  ADD KEY `id_student` (`id_student`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `Role_Id` (`Role_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `featured`
--
ALTER TABLE `featured`
  MODIFY `featured-id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `Id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approved`
--
ALTER TABLE `approved`
  ADD CONSTRAINT `approved_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `approved_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`Id`);

--
-- Constraints for table `blocked`
--
ALTER TABLE `blocked`
  ADD CONSTRAINT `blocked_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `blocked_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`id_teacher`) REFERENCES `user` (`id`);

--
-- Constraints for table `fav`
--
ALTER TABLE `fav`
  ADD CONSTRAINT `fav_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`Id`),
  ADD CONSTRAINT `fav_ibfk_2` FOREIGN KEY (`id_student`) REFERENCES `user` (`id`);

--
-- Constraints for table `featured`
--
ALTER TABLE `featured`
  ADD CONSTRAINT `id` FOREIGN KEY (`id`) REFERENCES `post` (`Id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`Id_t`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `post_ibfk_3` FOREIGN KEY (`category`) REFERENCES `categories` (`name`);

--
-- Constraints for table `review_courses`
--
ALTER TABLE `review_courses`
  ADD CONSTRAINT `review_courses_ibfk_1` FOREIGN KEY (`id_course`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `review_courses_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `review_post`
--
ALTER TABLE `review_post`
  ADD CONSTRAINT `review_post_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`Id`),
  ADD CONSTRAINT `review_post_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `review_teacher`
--
ALTER TABLE `review_teacher`
  ADD CONSTRAINT `review_teacher_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `review_teacher_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD CONSTRAINT `subscribe_ibfk_1` FOREIGN KEY (`id_course`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `subscribe_ibfk_2` FOREIGN KEY (`id_student`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`Role_Id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
