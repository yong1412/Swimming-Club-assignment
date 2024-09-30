-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2024 at 04:56 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swimming_society`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `name` varchar(100) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `ic` varchar(20) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`name`, `gender`, `age`, `ic`, `phone`, `email`, `password`) VALUES
('Fiona Black', 'F', 22, '020125-03-1234', '+60123456786', 'fiona.b@example.com', 'fiona456'),
('Chris Wong', 'M', 18, '051015-02-2234', '+60123456783', 'chris.w@example.com', 'chrisSecret!'),
('Bob Smith', 'M', 35, '890623-01-1234', '+60123456782', 'bob.s@example.com', 'bobSecure123'),
('Hannah Scott', 'F', 34, '901130-05-4567', '+60123456788', 'hannah.s@example.com', 'hannah7890'),
('Jessica Brown', 'F', 30, '940403-07-1234', '+60123456790', 'jessica.b@example.com', 'jessicaB@123'),
('Diana Green', 'F', 29, '940909-10-3456', '+60123456784', 'diana.g@example.com', 'greenPass987'),
('George Harris', 'M', 29, '950510-04-5678', '+60123456787', 'george.h@example.com', 'georgeHarris123'),
('Edward White', 'M', 27, '971020-11-7890', '+60123456785', 'edward.w@example.com', 'edward7890'),
('Ian Blue', 'M', 26, '980712-06-7890', '+60123456789', 'ian.b@example.com', 'ianBlue123');

-- --------------------------------------------------------

--
-- Table structure for table `society`
--

CREATE TABLE `society` (
  `event_id` varchar(10) NOT NULL,
  `event_name` varchar(100) DEFAULT NULL,
  `event_date` varchar(11) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `fare` decimal(10,2) DEFAULT NULL,
  `tickets_available` int(11) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ;

--
-- Dumping data for table `society`
--

INSERT INTO `society` (`event_id`, `event_name`, `event_date`, `location`, `start_time`, `end_time`, `fare`, `tickets_available`, `category`, `description`) VALUES
('EV001', 'Night Swimming Party', '25/NOV/2023', 'Riverside Pool', '18:00:00', '23:00:00', 45.00, 150, 'Night Event', 'A fun-filled evening with swimming, music, and dancing under the stars.'),
('EV002', 'Summer Swimming Bash', '10/DEC/2023', 'Beach Resort', '10:00:00', '17:00:00', 55.00, 250, 'Day Event', 'Join us for a day of summer fun at the beach with swimming, games, and food stalls.'),
('EV003', 'Glow-in-the-Dark Swim Party', '15/JAN/2024', 'Community Pool', '19:00:00', '23:00:00', 50.00, 200, 'Night Event', 'Experience the thrill of swimming with glow-in-the-dark effects. Enjoy music and games.'),
('EV004', 'Rooftop Pool Party', '28/FEB/2024', 'Skyline Hotel', '17:00:00', '21:00:00', 60.00, 100, 'Evening Event', 'Party on a rooftop with a stunning skyline view. Swim, dance, and enjoy gourmet food.'),
('EV005', 'Underwater Disco Party', '22/MAR/2024', 'Aquatic Center', '20:00:00', '01:00:00', 70.00, 300, 'Night Event', 'Dive into an underwater disco with vibrant lights and great music at the Aquatic Center.'),
('EV006', 'Tropical Swim Party', '10/APR/2024', 'Resort Pool', '13:00:00', '18:00:00', 65.00, 250, 'Afternoon Event', 'Escape to a tropical paradise for a day of swimming, cocktails, and live entertainment.'),
('EV007', 'Backyard Pool BBQ', '01/MAY/2024', 'Private Residence', '12:00:00', '16:00:00', 40.00, 75, 'Day Event', 'A relaxed afternoon with swimming and a BBQ party in a private backyard setting.'),
('EV008', 'Infinity Pool Party', '05/JUN/2024', 'Luxury Condo', '16:00:00', '20:00:00', 80.00, 300, 'Evening Event', 'Enjoy a luxury pool party with infinity views, gourmet food, and a live DJ.'),
('EV009', 'Sunset Beach Swim Party', '14/JUL/2024', 'Coastal Beach', '18:00:00', '22:00:00', 75.00, 150, 'Evening Event', 'Celebrate at the beach with swimming, sunset views, and a bonfire. Live music and games included.'),
('EV010', 'Spring Splash Pool Party', '18/AUG/2024', 'Water Park', '11:00:00', '17:00:00', 35.00, 200, 'Day Event', 'A family-friendly pool party with water slides, games, and plenty of food options. Perfect for all ages.');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` varchar(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `ic` varchar(20) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `name`, `position`, `gender`, `age`, `ic`, `phone`, `email`, `password`) VALUES
('STF001', 'John Doe', 'Manager', 'M', 42, '790315-10-2345', '+60123456701', 'john.d@example.com', 'securePass1'),
('STF002', 'Sarah Lee', 'Assistant Manager', 'F', 36, '850422-01-1234', '+60123456702', 'sarah.l@example.com', 'sarahsSecret123'),
('STF003', 'Michael Tan', 'Developer', 'M', 28, '930112-08-5678', '+60123456703', 'michael.t@example.com', 'myDevPass!'),
('STF004', 'Jessica Brown', 'Designer', 'F', 30, '940403-07-9876', '+60123456704', 'jessica.b@example.com', 'designerPass!23'),
('STF005', 'Karen White', 'Accountant', 'F', 34, '870515-02-1234', '+60123456705', 'karen.w@example.com', 'accountant_789'),
('STF006', 'Thomas Green', 'Sales', 'M', 26, '980625-03-2345', '+60123456706', 'thomas.g@example.com', 'salesForce1'),
('STF007', 'Emily Black', 'HR Executive', 'F', 32, '910809-04-5678', '+60123456707', 'emily.b@example.com', 'HRpass123'),
('STF008', 'Charles Brown', 'Project Manager', 'M', 38, '850720-05-7890', '+60123456708', 'charles.b@example.com', 'projectManager!23'),
('STF009', 'Amanda Grey', 'Admin Assistant', 'F', 25, '980311-06-3456', '+60123456709', 'amanda.g@example.com', 'adminAss_111'),
('STF010', 'David White', 'IT Support', 'M', 29, '950711-07-6789', '+60123456710', 'david.w@example.com', 'supportPass123');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` varchar(10) NOT NULL,
  `member_ic` varchar(20) DEFAULT NULL,
  `event_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `member_ic`, `event_id`) VALUES
('TK002', '890623-01-1234', 'EV002'),
('TK003', '051015-02-2234', 'EV003'),
('TK004', '940909-10-3456', 'EV004'),
('TK005', '971020-11-7890', 'EV005'),
('TK006', '020125-03-1234', 'EV006'),
('TK007', '950510-04-5678', 'EV007'),
('TK008', '901130-05-4567', 'EV008'),
('TK009', '980712-06-7890', 'EV009'),
('TK010', '940403-07-1234', 'EV010');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`ic`);

--
-- Indexes for table `society`
--
ALTER TABLE `society`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `member_ic` (`member_ic`),
  ADD KEY `event_id` (`event_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`member_ic`) REFERENCES `member` (`ic`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `society` (`event_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
