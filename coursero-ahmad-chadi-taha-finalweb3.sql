-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2023 at 02:12 PM
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
('informatique'),
('private-training');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(5) NOT NULL,
  `Id_t` int(11) NOT NULL,
  `thumbnail` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `category` varchar(30) NOT NULL,
  `Date` date NOT NULL,
  `price` int(4) NOT NULL,
  `videos` varchar(500) NOT NULL,
  `num_videos` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `Id_t`, `thumbnail`, `name`, `Description`, `category`, `Date`, `price`, `videos`, `num_videos`) VALUES
(2, 91, 'random.jpg', 'informatique course', 'this is a test course! this is a test course! \r\nthis is a test course! ', '', '0000-00-00', 0, '', 0),
(3, 84, 'random.jpg', 'informatique course', 'this is a test course! this is a test course! this is a test course! this is a test course! this is a test course! this is a test course! this is a test course! ', 'informatique', '2023-07-18', 55, 'video1.png', 1),
(4, 85, 'random.jpg', 'informatique course', 'this is our first course that got added manually!!!!', 'informatique', '2023-06-01', 3, 'video1.png', 1),
(5, 85, 'random.jpg', 'informatique course', 'this is our first course that got added manually!!!!', 'informatique', '2023-06-01', 3, 'video1.png', 1),
(6, 85, 'random.jpg', 'informatique course', 'this is our first course that got added manually!!!!', 'informatique', '2023-06-01', 3, 'video1.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `denied`
--

CREATE TABLE `denied` (
  `Id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Description` varchar(350) NOT NULL,
  `Id_t` int(4) NOT NULL,
  `category` varchar(50) NOT NULL,
  `picture` varchar(50) NOT NULL,
  `price` int(6) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `denied`
--

INSERT INTO `denied` (`Id`, `Date`, `Description`, `Id_t`, `category`, `picture`, `price`, `admin_id`) VALUES
(1, '2023-08-18', 'this is a test post! delete later ', 81, '0', '0', 10000, 1),
(2, '2023-08-18', 'test test test', 85, '0', '0', 123131, 1),
(3, '2023-08-19', 'this post was done during testing all pages', 85, 'private-training', 'linkedin_photo__2_-removebg.pn', 10000, 1);

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
(81, 93),
(81, 95),
(81, 96),
(81, 106),
(82, 93),
(81, 101),
(82, 92),
(81, 94),
(81, 105),
(113, 93),
(113, 97),
(113, 108),
(113, 107),
(113, 109),
(113, 117),
(113, 92),
(113, 100),
(1, 116),
(85, 100),
(85, 92),
(82, 100),
(82, 126),
(82, 127),
(82, 95),
(1, 100);

-- --------------------------------------------------------

--
-- Table structure for table `featured`
--

CREATE TABLE `featured` (
  `featured_id` int(30) NOT NULL,
  `id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `featured`
--

INSERT INTO `featured` (`featured_id`, `id`) VALUES
(1, 100);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(4) NOT NULL,
  `date` date NOT NULL,
  `id_sender` int(20) NOT NULL,
  `id_receiver` int(5) NOT NULL,
  `cont` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `date`, `id_sender`, `id_receiver`, `cont`) VALUES
(14, '2023-07-31', 81, 81, 'hello'),
(15, '2023-07-31', 81, 81, 'test'),
(16, '2023-07-31', 81, 81, 'opk;l;;;;;;;;;;;;;;;;;;4'),
(17, '2023-07-31', 81, 83, ';l,;ll/////////////'),
(18, '2023-07-31', 81, 83, 'test1'),
(19, '2023-07-31', 81, 85, 'asdasdasd'),
(20, '2023-07-31', 81, 81, 'tast'),
(21, '2023-08-03', 81, 83, 'test'),
(22, '2023-08-03', 81, 96, 'hello'),
(23, '2023-08-03', 81, 96, 'test'),
(24, '2023-08-03', 81, 82, 'hvjhvjhvj'),
(25, '2023-08-15', 81, 96, 'dlasda'),
(26, '2023-08-15', 81, 82, 'dasd,asda'),
(27, '2023-08-15', 81, 82, 'sadl;asd;asaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'),
(28, '2023-08-15', 82, 81, 'sadas'),
(29, '2023-08-15', 82, 81, 'sdasda'),
(30, '2023-08-15', 82, 81, 'dasdas'),
(31, '2023-08-15', 82, 81, 'dasdasda'),
(32, '2023-08-15', 82, 81, 'addasdasd'),
(33, '2023-08-15', 82, 81, 'dasdasda'),
(34, '2023-08-15', 82, 81, 'asdasd'),
(35, '2023-08-15', 82, 81, 'asdasd'),
(36, '2023-08-15', 82, 82, 'asdassda'),
(37, '2023-08-16', 81, 1, 'hello admins!'),
(38, '2023-08-18', 113, 81, 'hello!'),
(39, '2023-08-18', 113, 81, 'test'),
(40, '2023-08-18', 113, 81, 'this is my first message'),
(41, '2023-08-18', 81, 113, 'this is also a test message'),
(42, '2023-08-18', 113, 1, 'ahmad'),
(43, '2023-08-18', 113, 1, 'hawchar'),
(44, '2023-08-18', 113, 1, 'testsssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss'),
(45, '2023-08-19', 82, 1, 'test'),
(46, '2023-08-19', 1, 1, 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `pending`
--

CREATE TABLE `pending` (
  `Id` int(5) NOT NULL,
  `Date` date NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Id_t` int(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `picture` varchar(30) NOT NULL,
  `price` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `Id` int(5) NOT NULL,
  `Date` date NOT NULL,
  `Description` varchar(300) NOT NULL,
  `Id_t` int(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `picture` varchar(30) NOT NULL,
  `price` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`Id`, `Date`, `Description`, `Id_t`, `category`, `picture`, `price`) VALUES
(92, '2023-08-19', 'Great laptop for sale!test test test tested!', 81, 'informatique', 'coureso-ahmad-chadi-taha.png', 802),
(93, '2023-07-30', 'Looking to trade my phone.', 82, 'informatique', 'random.png', 300),
(94, '2023-07-29', 'Selling gaming PC setup.', 83, 'informatique', 'random.png', 1500),
(95, '2023-07-28', 'Brand new tablet for sale.', 84, 'informatique', 'random.png', 250),
(96, '2023-07-27', 'Offering coding lessons.', 85, 'informatique', 'random.png', 50),
(97, '2023-07-26', 'Selling graphic design services.', 86, 'informatique', 'random.png', 100),
(98, '2023-07-25', 'Looking for a programming tutor.', 87, 'informatique', 'random.png', 40),
(99, '2023-07-24', 'Selling used camera equipment.', 88, 'informatique', 'random.png', 400),
(100, '2023-07-23', 'Offering web development services.', 89, 'informatique', 'random.png', 80),
(101, '2023-07-22', 'Looking to trade headphones.', 90, 'informatique', 'random.png', 100),
(102, '2023-07-21', 'Selling laptop bag.', 91, 'informatique', 'random.png', 30),
(103, '2023-07-20', 'Brand new computer monitor for sale.', 92, 'informatique', 'random.png', 200),
(104, '2023-07-19', 'Offering programming help.', 93, 'informatique', 'random.png', 20),
(105, '2023-07-18', 'Selling video editing software.', 94, 'informatique', 'random.png', 50),
(106, '2023-07-17', 'Looking for used computer parts.', 95, 'informatique', 'random.png', 150),
(107, '2023-07-16', 'Offering data analysis services.', 96, 'informatique', 'random.png', 70),
(108, '2023-07-15', 'Selling e-book on coding.', 97, 'informatique', 'random.png', 10),
(109, '2023-07-14', 'Looking for coding project partners.', 98, 'informatique', 'random.png', 0),
(110, '2023-07-13', 'Offering software development services.', 99, 'informatique', 'random.png', 90),
(111, '2023-07-12', 'Selling used smartphone.', 100, 'informatique', 'random.png', 180),
(112, '2023-07-11', 'Looking to hire a web designer.', 101, 'informatique', 'random.png', 200),
(113, '2023-07-10', 'Offering IT support.', 102, 'informatique', 'random.png', 60),
(114, '2023-07-09', 'Selling computer peripherals.', 103, 'informatique', 'random.png', 120),
(115, '2023-07-08', 'Looking for help with coding project.', 104, 'informatique', 'random.png', 0),
(116, '2023-07-07', 'Offering digital marketing services.', 105, 'informatique', 'random.png', 80),
(117, '2024-06-04', 'this is the first personal training post on this site!!!!!!', 82, 'private-training', 'random.png', 10),
(119, '2023-08-19', 'this is the first post created manually! test', 81, 'informatique', '', 802),
(120, '2023-08-18', 'this is the first post created manually!', 81, 'informatique', '', 802),
(121, '2023-08-18', 'this is the first post created manually!', 81, 'informatique', '', 802),
(122, '2023-08-18', 'this is the first post created manually!', 81, 'informatique', '', 802),
(123, '2023-08-18', 'this is the first post created manually!', 81, 'informatique', '', 802),
(124, '2023-08-18', 'this is the first post created manually!', 81, 'informatique', 'linkedinprofile.png', 802),
(125, '2023-08-18', 'this is the first post created manually!', 81, 'informatique', 'linkedinprofile.png', 802),
(126, '2023-08-18', 'this is the first post created manually!', 81, 'informatique', 'linkedinprofile.png', 802),
(127, '2023-08-18', 'this is the first post created manually!', 81, 'informatique', 'linkedinprofile.png', 802),
(128, '2023-08-18', 'this is the first post created manually!', 81, 'informatique', 'linkedinprofile.png', 802),
(129, '2023-08-19', 'this was added during testing', 85, 'private-training', 'linkedin_photo__2_-removebg.pn', 1231);

-- --------------------------------------------------------

--
-- Table structure for table `review_courses`
--

CREATE TABLE `review_courses` (
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `rating` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review_courses`
--

INSERT INTO `review_courses` (`student_id`, `course_id`, `rating`) VALUES
(81, 2, 'down'),
(81, 3, 'down'),
(82, 3, 'up'),
(113, 3, 'down'),
(113, 4, 'down'),
(85, 3, 'down'),
(85, 4, 'up'),
(82, 6, 'down'),
(82, 4, 'down'),
(82, 2, 'down');

-- --------------------------------------------------------

--
-- Table structure for table `review_post`
--

CREATE TABLE `review_post` (
  `post_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `rating` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review_post`
--

INSERT INTO `review_post` (`post_id`, `student_id`, `rating`) VALUES
(92, 81, 'down'),
(93, 81, 'down'),
(109, 81, 'up'),
(107, 81, 'up'),
(94, 81, 'up'),
(99, 81, 'up'),
(112, 81, 'up'),
(116, 81, 'down'),
(92, 82, 'up'),
(93, 82, 'down'),
(108, 81, 'up'),
(113, 81, 'up'),
(97, 81, 'down'),
(92, 113, 'up'),
(93, 113, 'down'),
(108, 113, 'down'),
(107, 113, 'up'),
(117, 113, 'up'),
(100, 113, 'down'),
(116, 1, 'down'),
(100, 82, 'up'),
(100, 1, 'down');

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

--
-- Dumping data for table `subscribe`
--

INSERT INTO `subscribe` (`id`, `id_course`, `id_student`) VALUES
(1, 3, 82),
(2, 6, 113),
(3, 6, 113),
(4, 6, 113),
(5, 6, 113),
(6, 6, 113),
(7, 6, 113),
(8, 6, 113),
(9, 6, 113),
(10, 6, 113),
(11, 6, 113),
(12, 6, 113),
(13, 6, 113),
(14, 6, 113),
(15, 6, 113),
(16, 6, 113),
(17, 6, 113),
(18, 6, 113),
(19, 6, 113),
(20, 3, 1),
(21, 6, 113),
(22, 6, 82);

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
  `Role_Id` int(11) NOT NULL,
  `profile_pic` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `Fname`, `Lname`, `Date_Of_Birth`, `gender`, `Role_Id`, `profile_pic`) VALUES
(1, 'customer support', 'admin1', 'admin', 'admin', '2023-06-13', 'male', 3, 'random.png'),
(81, 'user1', 'password1', 'John', 'Doe', '1990-01-01', 'Male', 1, ''),
(82, 'user2', 'password2', 'Jane', 'Smith', '1995-02-15', 'Female', 2, 'random.png'),
(83, 'user3', 'password3', 'Alice', 'Johnson', '1988-11-20', 'Female', 1, 'random.png'),
(84, 'user4', 'password4', 'Bob', 'Brown', '1985-06-30', 'Male', 2, 'random.png'),
(85, 'user5', 'password5', 'Emmaa', 'Wilson', '1992-09-12', 'Female', 1, ''),
(86, 'user6', 'password6', 'Michael', 'Miller', '1989-03-25', 'Male', 1, 'random.png'),
(87, 'user7', 'password7', 'Olivia', 'Jones', '1997-07-08', 'Female', 2, 'random.png'),
(88, 'user8', 'password8', 'William', 'Lee', '1991-12-03', 'Male', 1, 'random.png'),
(89, 'user9', 'password9', 'Sophia', 'Nguyen', '1987-04-17', 'Female', 1, 'random.png'),
(90, 'user10', 'password10', 'James', 'Garcia', '1993-10-21', 'Male', 2, 'random.png'),
(91, 'user11', 'password11', 'Ava', 'Hernandez', '1984-05-29', 'Female', 1, 'random.png'),
(92, 'user12', 'password12', 'Alexander', 'Martinez', '1998-08-14', 'Male', 2, 'random.png'),
(93, 'user13', 'password13', 'Mia', 'Lopez', '1986-02-11', 'Female', 1, 'random.png'),
(94, 'user14', 'password14', 'Ethan', 'Taylor', '1994-09-27', 'Male', 1, 'random.png'),
(95, 'user15', 'password15', 'Isabella', 'Adams', '1999-11-19', 'Female', 2, 'random.png'),
(96, 'user16', 'password16', 'Benjamin', 'Wright', '1983-07-22', 'Male', 1, 'random.png'),
(97, 'user17', 'password17', 'Abigail', 'Scott', '1996-04-02', 'Female', 1, 'random.png'),
(98, 'user18', 'password18', 'Daniel', 'Murphy', '1989-12-13', 'Male', 2, 'random.png'),
(99, 'user19', 'password19', 'Emily', 'Turner', '1987-05-18', 'Female', 1, 'random.png'),
(100, 'user20', 'password20', 'Matthew', 'Cook', '1992-03-07', 'Male', 1, 'random.png'),
(101, 'user21', 'password21', 'Charlotte', 'Baker', '1985-10-09', 'Female', 2, 'random.png'),
(102, 'user22', 'password22', 'Andrew', 'Gonzalez', '1993-08-23', 'Male', 1, 'random.png'),
(103, 'user23', 'password23', 'Sofia', 'Nelson', '1986-06-26', 'Female', 1, 'random.png'),
(104, 'user24', 'password24', 'Joseph', 'Rivera', '1997-01-04', 'Male', 2, 'random.png'),
(105, 'user25', 'password25', 'Scarlett', 'Green', '1988-09-15', 'Female', 1, 'random.png'),
(106, 'user26', 'password26', 'David', 'Harris', '1994-05-11', 'Male', 1, 'random.png'),
(107, 'user27', 'password27', 'Grace', 'Bell', '1999-02-03', 'Female', 2, 'random.png'),
(108, 'user28', 'password28', 'Christopher', 'Cooper', '1984-11-16', 'Male', 1, 'random.png'),
(109, 'user29', 'password29', 'Chloe', 'Rossi', '1987-07-28', 'Female', 1, 'random.png'),
(113, 'ahmadhawchar', 'Pass123@', 'ahmad', 'hawchar', '2004-02-05', 'male', 2, 'linkedin banner.png');

--
-- Indexes for dumped tables
--

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
  ADD KEY `id_teacher` (`Id_t`);

--
-- Indexes for table `denied`
--
ALTER TABLE `denied`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `admin_id` (`Id`),
  ADD KEY `post_id` (`Date`),
  ADD KEY `Id_t` (`Id_t`),
  ADD KEY `admin_id_2` (`admin_id`);

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
  ADD PRIMARY KEY (`featured_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_receiver` (`id_receiver`),
  ADD KEY `id_sender` (`id_sender`);

--
-- Indexes for table `pending`
--
ALTER TABLE `pending`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_t` (`Id_t`),
  ADD KEY `category` (`category`);

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
  ADD KEY `id_course` (`course_id`),
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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `denied`
--
ALTER TABLE `denied`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `featured`
--
ALTER TABLE `featured`
  MODIFY `featured_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `pending`
--
ALTER TABLE `pending`
  MODIFY `Id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `Id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`Id_t`) REFERENCES `user` (`id`);

--
-- Constraints for table `denied`
--
ALTER TABLE `denied`
  ADD CONSTRAINT `denied_ibfk_1` FOREIGN KEY (`Id_t`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `denied_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `user` (`id`);

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
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`id_receiver`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`id_sender`) REFERENCES `user` (`id`);

--
-- Constraints for table `pending`
--
ALTER TABLE `pending`
  ADD CONSTRAINT `pending_ibfk_1` FOREIGN KEY (`Id_t`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `pending_ibfk_2` FOREIGN KEY (`category`) REFERENCES `categories` (`name`);

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
  ADD CONSTRAINT `review_courses_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
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
