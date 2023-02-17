-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2023 at 08:50 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `espres`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `userid` varchar(225) NOT NULL,
  `pic` varchar(1000) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `uname` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `userid`, `pic`, `phone`, `address`, `uname`, `password`, `email`) VALUES
(1, '123456', 'image/Ymius9kTn/log.jpg', '0123456789', 'KT', 'arif haikal', '123', 'dlecorre966@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `logbook`
--

CREATE TABLE `logbook` (
  `id` int(11) NOT NULL,
  `date` varchar(225) NOT NULL,
  `starttime` varchar(225) NOT NULL,
  `endtime` varchar(225) NOT NULL,
  `activity` varchar(225) NOT NULL,
  `doc` varchar(1025) NOT NULL,
  `svname` varchar(225) NOT NULL,
  `svid` varchar(225) NOT NULL,
  `userid` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL,
  `totaltime` varchar(225) NOT NULL,
  `discuss` mediumtext NOT NULL,
  `method` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logbook`
--

INSERT INTO `logbook` (`id`, `date`, `starttime`, `endtime`, `activity`, `doc`, `svname`, `svid`, `userid`, `status`, `totaltime`, `discuss`, `method`) VALUES
(231, '2023-02-04', '00:30', '02:30', 'Test', '', 'ts. dr. rashidah mokhtar', '2020123', '2020107119', 'Verified', '02:00', '', 'online'),
(232, '2023-02-11', '15:06', '17:05', '', '', 'ts. dr. rashidah mokhtar', '2020123', '2020107119', 'Verified', '01:59', '', 'Please Select'),
(234, '2023-01-04', '16:02', '18:01', '', '', 'ts. dr. rashidah mokhtar', '2020123', '2020107119', 'Verified', '01:59', '', 'Please Select'),
(235, '2023-02-06', '01:20', '03:20', 'test', '', 'ts. dr. rashidah mokhtar', '2020123', '2020107117', 'submitted', '02:00', '', 'online'),
(236, '2022-10-06', '09:52', '11:52', 'test', '', 'ts. dr. rashidah mokhtar', '2020123', '2020107119', 'Verified', '02:00', '', 'online'),
(237, '2023-02-08', '13:57', '15:57', 'Discussion Chapter 1', '', 'DR. sharifah binti ahmad', '2020122', '2020107111', 'submitted', '02:00', '', 'online'),
(239, '2023-01-29', '13:59', '15:58', 'Discussion Research Title', '', 'DR. sharifah binti ahmad', '2020122', '2020107111', 'submitted', '01:59', '', 'online'),
(240, '2023-02-13', '13:56', '16:56', 'Discussion Research Title', '', 'ts. dr. rashidah mokhtar', '2020123', '2020107119', 'submitted', '03:00', '', 'online');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `year` varchar(100) NOT NULL,
  `month` varchar(100) NOT NULL,
  `userid` varchar(225) NOT NULL,
  `totalhour` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `year`, `month`, `userid`, `totalhour`) VALUES
(48, '2023', '2', '2020107119', ''),
(49, '2023', '2', '2020107117', ''),
(50, '2022', '10', '2020107119', ''),
(51, '2023', '1', '2020107111', ''),
(52, '2023', '2', '2020107111', '');

-- --------------------------------------------------------

--
-- Table structure for table `sadmin`
--

CREATE TABLE `sadmin` (
  `id` int(11) NOT NULL,
  `password` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `uname` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `uname` varchar(225) NOT NULL,
  `userid` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `faculty` varchar(225) NOT NULL,
  `pcode` varchar(225) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `svname` varchar(225) NOT NULL,
  `svid` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `cosv` varchar(225) NOT NULL,
  `cosvid` varchar(225) NOT NULL,
  `pic` varchar(1025) NOT NULL,
  `title` varchar(225) NOT NULL,
  `total_time` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `uname`, `userid`, `email`, `faculty`, `pcode`, `phone`, `address`, `svname`, `svid`, `password`, `cosv`, `cosvid`, `pic`, `title`, `total_time`) VALUES
(520, 'MUHAMMAD ARIF HAIKAL BIN SAMED', '2020107119', 'haikalarif968@gmail.com', 'FSKM', 'CS754', '01140031356', 'SELANGOR', 'ts. dr. rashidah mokhtar', '2020123', '123', '', '', '', 'ESPRES', 2),
(522, 'imran bin kamarul', '2020107118', 'imran98@gmail.com', '', 'CS751', '0198467324', 'terengganu', 'kamarul bin zulkifli', '2020120', '123', '', '', '', '', 2),
(523, 'aminah binti saiful', '2020107117', 'aminah96@gmail.com', 'FSKM', 'CS755', '0136578932', 'perlis', 'ts. dr. rashidah mokhtar', '2020123', '123', '', '', '', 'WEB', 4),
(524, 'johan bin amran', '2020107116', 'johan@live.com', 'FSKM', 'CS750', '0174563784', 'johor', 'jamaluddin bin zakaria', '2020121', '123', '', '', '', 'ANALYTIC DATA', 0),
(525, 'ariffin bin nasri', '2020107115', 'arif675@gmail.com', '', 'CS750', '0135627894', 'perak', 'jamaluddin bin zakaria', '2020121', '123', 'DR. sharifah binti ahmad', '2020122', '', '', 10),
(526, 'naqiuddin bin adzfar', '2020107114', 'naqiuddin96@gmail.com', '', 'CS754', '0128657491', 'kelantan', 'jamaluddin bin zakaria', '2020121', '123', '', '', '', '', 0),
(527, 'anisah binti nasir', '2020107113', 'anisah@gmail.com', '', 'CS754', '0157893214', 'melaka', 'DR. sharifah binti ahmad', '2020122', '123', '', '', '', '', 0),
(528, 'fatimah binti basir', '2020107112', 'fatimah764@gmail.com', '', 'CS755', '0157893214', 'kedah', 'DR. sharifah binti ahmad', '2020122', '123', '', '', '', '', 10),
(529, 'hisham bin faisal', '2020107111', 'hisham@gmail.com', 'Please Choose', 'cs751', '01140031356', 'selangor', 'DR. sharifah binti ahmad', '2020122', '123', 'jamaluddin bin zakaria', '2020121', '', 'Online Effect on Learning', 0);

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE `supervisor` (
  `id` int(11) NOT NULL,
  `userid` varchar(225) NOT NULL,
  `uname` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `pic` varchar(1025) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`id`, `userid`, `uname`, `password`, `email`, `address`, `phone`, `pic`) VALUES
(34, '2020123', 'TS. DR. RASHIDAH MOKHTAR', '123', 'sv@gmail.com', 'JOHOR', '1234567890', ''),
(35, '2020120', 'kamarul bin zulkifli', '123', 'blayklee1@gmail.com', 'terengganu', '1234567890', ''),
(36, '2020121', 'jamaluddin bin zakaria', '123', 'yaneris99@live.com', 'SELANGOR', '01140031356', ''),
(37, '2020122', 'DR. sharifah binti ahmad', '123', 'yaneris99@live.com', 'perlis', '01234567891', ''),
(59, 'guid', 'name', 'guid', 'email', 'address', 'phone', ''),
(60, '3030', 'Nissim Lawrence', '3030', 'ac.arcu.nunc@protonmail.com', '2496 Iaculis St.', '1-457-323-7973', ''),
(61, '3031', 'Dante Mooney', '3031', 'vel.faucibus.id@icloud.org', 'Ap #110-9441 Mauris Street', '1-257-833-8865', ''),
(62, '3032', 'Sade Sullivan', '3032', 'nullam.vitae.diam@protonmail.ca', '169-7592 Risus. Road', '(421) 563-2496', ''),
(63, '3033', 'Lillith Sharp', '3033', 'sit@icloud.org', '553-1564 Rutrum Rd.', '(935) 676-3446', ''),
(64, '3034', 'Maia Figueroa', '3034', 'nascetur.ridiculus.mus@icloud.com', 'Ap #393-6739 Tellus St.', '(583) 568-5033', ''),
(65, '3035', 'Christine Jenkins', '3035', 'adipiscing.non.luctus@icloud.com', 'Ap #425-5615 Bibendum Road', '1-952-867-9551', ''),
(66, '3036', 'Raphael Thornton', '3036', 'pellentesque.tellus@outlook.com', 'P.O. Box 395, 3825 Erat. Av.', '(712) 815-9665', ''),
(67, '3037', 'Uta Britt', '3037', 'lorem.tristique.aliquet@outlook.edu', '615-8477 Maecenas St.', '1-488-827-5127', ''),
(68, '3038', 'Reagan Landry', '3038', 'lorem@hotmail.edu', 'Ap #767-4579 Ipsum. Avenue', '1-850-383-5735', ''),
(69, '3039', 'Lillian Cervantes', '3039', 'lacus.ut.nec@hotmail.org', '4172 Magna. Road', '1-723-648-8386', ''),
(70, '3040', 'Joan Howell', '3040', 'tortor.integer@aol.com', '3744 Et Street', '(547) 748-1523', ''),
(71, '3041', 'Avram Atkinson', '3041', 'luctus@icloud.ca', '771-5154 Cras St.', '1-674-982-8514', ''),
(72, '3042', 'Caldwell Cooper', '3042', 'magnis.dis@hotmail.org', '229-9796 Augue Avenue', '1-747-351-6225', ''),
(73, '3043', 'Colin Frank', '3043', 'et.pede.nunc@aol.net', 'Ap #683-3993 Lacinia. Rd.', '(851) 721-7362', ''),
(74, '3044', 'Flynn Gomez', '3044', 'sed@google.edu', 'Ap #857-3601 Curabitur Avenue', '(716) 393-2528', ''),
(75, '3045', 'Fritz Maldonado', '3045', 'ac@hotmail.net', 'P.O. Box 293, 4427 Ipsum Road', '1-174-724-1373', ''),
(76, '3046', 'Felicia Fischer', '3046', 'neque.sed@protonmail.com', 'Ap #148-6573 Eu Avenue', '1-769-263-5358', ''),
(77, '3047', 'Miriam Myers', '3047', 'neque.nullam.ut@hotmail.org', '8272 Bibendum St.', '1-554-724-0053', ''),
(78, '3048', 'Wang Riddle', '3048', 'gravida.sit@google.ca', 'P.O. Box 792, 3731 Lacinia Av.', '1-222-742-3641', ''),
(79, '3049', 'Beatrice Miranda', '3049', 'semper.dui@outlook.edu', 'P.O. Box 459, 2588 Tellus, Ave', '(368) 952-2232', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userid` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `usertype` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userid`, `email`, `usertype`) VALUES
(2, '123456', 'admin@gmail.com', 'admin'),
(453, '2020123', '', 'supervisor'),
(454, '2020107119', 'arifhaikal228@gmail.com', 'student'),
(456, '2020107118', 'dlecorre966@gmail.com', 'student'),
(457, '2020107117', 'yaneris99@live.com', 'student'),
(458, '2020107116', 'yaneris99@live.com', 'student'),
(459, '2020107115', 'arifhaikal228@gmail.com', 'student'),
(460, '2020107114', 'blayklee1@gmail.com', 'student'),
(461, '2020107113', 'sv@gmail.com', 'student'),
(462, '2020107112', 'blayklee1@gmail.com', 'student'),
(463, '2020120', 'blayklee1@gmail.com', 'supervisor'),
(464, '2020121', 'yaneris99@live.com', 'supervisor'),
(465, '2020122', 'yaneris99@live.com', 'supervisor'),
(466, 'guid', 'email', 'supervisor'),
(467, '3030', 'ac.arcu.nunc@protonmail.com', 'supervisor'),
(468, '3031', 'vel.faucibus.id@icloud.org', 'supervisor'),
(469, '3032', 'nullam.vitae.diam@protonmail.ca', 'supervisor'),
(470, '3033', 'sit@icloud.org', 'supervisor'),
(471, '3034', 'nascetur.ridiculus.mus@icloud.com', 'supervisor'),
(472, '3035', 'adipiscing.non.luctus@icloud.com', 'supervisor'),
(473, '3036', 'pellentesque.tellus@outlook.com', 'supervisor'),
(474, '3037', 'lorem.tristique.aliquet@outlook.edu', 'supervisor'),
(475, '3038', 'lorem@hotmail.edu', 'supervisor'),
(476, '3039', 'lacus.ut.nec@hotmail.org', 'supervisor'),
(477, '3040', 'tortor.integer@aol.com', 'supervisor'),
(478, '3041', 'luctus@icloud.ca', 'supervisor'),
(479, '3042', 'magnis.dis@hotmail.org', 'supervisor'),
(480, '3043', 'et.pede.nunc@aol.net', 'supervisor'),
(481, '3044', 'sed@google.edu', 'supervisor'),
(482, '3045', 'ac@hotmail.net', 'supervisor'),
(483, '3046', 'neque.sed@protonmail.com', 'supervisor'),
(484, '3047', 'neque.nullam.ut@hotmail.org', 'supervisor'),
(485, '3048', 'gravida.sit@google.ca', 'supervisor'),
(486, '3049', 'semper.dui@outlook.edu', 'supervisor'),
(487, '2020107111', 'hisham@gmail.com', 'student'),
(488, 'guid', 'email', 'supervisor'),
(489, '3030', 'ac.arcu.nunc@protonmail.com', 'supervisor'),
(490, '3031', 'vel.faucibus.id@icloud.org', 'supervisor'),
(491, '3032', 'nullam.vitae.diam@protonmail.ca', 'supervisor'),
(492, '3033', 'sit@icloud.org', 'supervisor'),
(493, '3034', 'nascetur.ridiculus.mus@icloud.com', 'supervisor'),
(494, '3035', 'adipiscing.non.luctus@icloud.com', 'supervisor'),
(495, '3036', 'pellentesque.tellus@outlook.com', 'supervisor'),
(496, '3037', 'lorem.tristique.aliquet@outlook.edu', 'supervisor'),
(497, '3038', 'lorem@hotmail.edu', 'supervisor'),
(498, '3039', 'lacus.ut.nec@hotmail.org', 'supervisor'),
(499, '3040', 'tortor.integer@aol.com', 'supervisor'),
(500, '3041', 'luctus@icloud.ca', 'supervisor'),
(501, '3042', 'magnis.dis@hotmail.org', 'supervisor'),
(502, '3043', 'et.pede.nunc@aol.net', 'supervisor'),
(503, '3044', 'sed@google.edu', 'supervisor'),
(504, '3045', 'ac@hotmail.net', 'supervisor'),
(505, '3046', 'neque.sed@protonmail.com', 'supervisor'),
(506, '3047', 'neque.nullam.ut@hotmail.org', 'supervisor'),
(507, '3048', 'gravida.sit@google.ca', 'supervisor'),
(508, '3049', 'semper.dui@outlook.edu', 'supervisor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logbook`
--
ALTER TABLE `logbook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sadmin`
--
ALTER TABLE `sadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logbook`
--
ALTER TABLE `logbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `sadmin`
--
ALTER TABLE `sadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=530;

--
-- AUTO_INCREMENT for table `supervisor`
--
ALTER TABLE `supervisor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=509;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
