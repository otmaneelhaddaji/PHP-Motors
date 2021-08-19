-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 14, 2021 at 12:34 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int(11) NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used'),
(27, 'Electric');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(6, 'Kobin', 'Howell', 'nibok2000@gmail.com', '$2y$10$e0IFfS0z5COTWQ8nYbcJm.OKNQQ0wkI1HMThkAbROEcYDgF4LF4..', '1', NULL),
(8, 'Test', 'User', 'testuser@gmail.com', '$2y$10$p//Xdv.OKGWz.RFYbEDpf.oxvmHZRDj8DGAUYe8VX7aO423apjdf.', '3', NULL),
(10, 'Admin', 'User', 'admin@cse340.net', '$2y$10$lb1av4gd2RXjSJ8jePM6Gue4l7NsWzx.1iyvQhuydsJ0ivX3p1mx6', '3', NULL),
(13, 'Kim', 'Black', 'kimblackaz@gmail.com', '$2y$10$fO8y3d/mTZtyWhDHGhZeW.RnXtY96cPmHjQ8w9WwF0K9LymnKCxTO', '1', NULL),
(14, 'Abby', 'Howell', 'abbyhowell@gmail.com', '$2y$10$wxsUnB9SQ73d8sMaIbN5bu1bB4FAtn1PEF0tmW5F6XAkob6U2jhei', '1', NULL),
(15, 'Weylin', 'Morris', 'hi@weylin.dev', '$2y$10$HBeAX5ezIVwIxASyQ1pjm.WQTSPwgbAJ8HQfteOjdODhvPRmKysCW', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) CHARACTER SET latin1 NOT NULL,
  `imgPath` varchar(150) CHARACTER SET latin1 NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `imgPrimary` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(39, 1, 'jeep-wrangler.jpg', '/phpmotors/images/vehicles/jeep-wrangler.jpg', '2021-07-01 21:06:33', 1),
(40, 1, 'jeep-wrangler-tn.jpg', '/phpmotors/images/vehicles/jeep-wrangler-tn.jpg', '2021-07-01 21:06:33', 1),
(41, 2, 'ford-modelt.jpg', '/phpmotors/images/vehicles/ford-modelt.jpg', '2021-07-01 21:07:30', 1),
(42, 2, 'ford-modelt-tn.jpg', '/phpmotors/images/vehicles/ford-modelt-tn.jpg', '2021-07-01 21:07:30', 1),
(43, 3, 'adventador.jpg', '/phpmotors/images/vehicles/adventador.jpg', '2021-07-01 21:13:43', 1),
(44, 3, 'adventador-tn.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '2021-07-01 21:13:43', 1),
(45, 4, 'monster.jpg', '/phpmotors/images/vehicles/monster.jpg', '2021-07-01 21:13:59', 1),
(46, 4, 'monster-tn.jpg', '/phpmotors/images/vehicles/monster-tn.jpg', '2021-07-01 21:13:59', 1),
(47, 5, 'no-image.png', '/phpmotors/images/vehicles/no-image.png', '2021-07-01 21:14:57', 0),
(48, 5, 'no-image-tn.png', '/phpmotors/images/vehicles/no-image-tn.png', '2021-07-01 21:14:57', 0),
(49, 6, 'bat.jpg', '/phpmotors/images/vehicles/bat.jpg', '2021-07-01 21:15:13', 1),
(50, 6, 'bat-tn.jpg', '/phpmotors/images/vehicles/bat-tn.jpg', '2021-07-01 21:15:13', 1),
(51, 7, 'mm.jpg', '/phpmotors/images/vehicles/mm.jpg', '2021-07-01 21:15:24', 1),
(52, 7, 'mm-tn.jpg', '/phpmotors/images/vehicles/mm-tn.jpg', '2021-07-01 21:15:24', 1),
(53, 8, 'fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck.jpg', '2021-07-01 21:15:33', 1),
(54, 8, 'fire-truck-tn.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '2021-07-01 21:15:33', 1),
(55, 9, 'crown-vic.jpg', '/phpmotors/images/vehicles/crown-vic.jpg', '2021-07-01 21:15:53', 1),
(56, 9, 'crown-vic-tn.jpg', '/phpmotors/images/vehicles/crown-vic-tn.jpg', '2021-07-01 21:15:53', 1),
(57, 10, 'camaro.jpg', '/phpmotors/images/vehicles/camaro.jpg', '2021-07-01 21:16:02', 1),
(58, 10, 'camaro-tn.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '2021-07-01 21:16:02', 1),
(59, 11, 'escalade.jpg', '/phpmotors/images/vehicles/escalade.jpg', '2021-07-01 21:16:14', 1),
(60, 11, 'escalade-tn.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '2021-07-01 21:16:14', 1),
(61, 12, 'hummer.jpg', '/phpmotors/images/vehicles/hummer.jpg', '2021-07-01 21:16:27', 1),
(62, 12, 'hummer-tn.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '2021-07-01 21:16:27', 1),
(63, 13, 'aerocar.jpg', '/phpmotors/images/vehicles/aerocar.jpg', '2021-07-01 21:16:35', 1),
(64, 13, 'aerocar-tn.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '2021-07-01 21:16:35', 1),
(65, 14, 'fbi.jpg', '/phpmotors/images/vehicles/fbi.jpg', '2021-07-01 21:16:47', 1),
(66, 14, 'fbi-tn.jpg', '/phpmotors/images/vehicles/fbi-tn.jpg', '2021-07-01 21:16:47', 1),
(67, 15, 'dog.jpg', '/phpmotors/images/vehicles/dog.jpg', '2021-07-01 21:16:58', 0),
(68, 15, 'dog-tn.jpg', '/phpmotors/images/vehicles/dog-tn.jpg', '2021-07-01 21:16:58', 0),
(69, 27, 'tesla.jpg', '/phpmotors/images/vehicles/tesla.jpg', '2021-07-01 21:17:14', 1),
(70, 27, 'tesla-tn.jpg', '/phpmotors/images/vehicles/tesla-tn.jpg', '2021-07-01 21:17:14', 1),
(71, 28, 'delorean.jpg', '/phpmotors/images/vehicles/delorean.jpg', '2021-07-01 21:20:46', 1),
(72, 28, 'delorean-tn.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '2021-07-01 21:20:46', 1),
(73, 4, '604a8b629be1b.image.jpg', '/phpmotors/images/vehicles/604a8b629be1b.image.jpg', '2021-07-01 21:22:44', 1),
(74, 4, '604a8b629be1b.image-tn.jpg', '/phpmotors/images/vehicles/604a8b629be1b.image-tn.jpg', '2021-07-01 21:22:44', 0),
(75, 14, 'image_processing20201218-1-1l53vuz.jpg', '/phpmotors/images/vehicles/image_processing20201218-1-1l53vuz.jpg', '2021-07-01 21:23:55', 0),
(76, 14, 'image_processing20201218-1-1l53vuz-tn.jpg', '/phpmotors/images/vehicles/image_processing20201218-1-1l53vuz-tn.jpg', '2021-07-01 21:23:55', 0),
(77, 7, '71Wid21il6L._AC_SL1500_.jpg', '/phpmotors/images/vehicles/71Wid21il6L._AC_SL1500_.jpg', '2021-07-01 21:24:34', 0),
(78, 7, '71Wid21il6L._AC_SL1500_-tn.jpg', '/phpmotors/images/vehicles/71Wid21il6L._AC_SL1500_-tn.jpg', '2021-07-01 21:24:34', 0),
(79, 3, 'JPrice_Lamborghini_MCW18-1755.jpg', '/phpmotors/images/vehicles/JPrice_Lamborghini_MCW18-1755.jpg', '2021-07-06 22:55:33', 0),
(80, 3, 'JPrice_Lamborghini_MCW18-1755-tn.jpg', '/phpmotors/images/vehicles/JPrice_Lamborghini_MCW18-1755-tn.jpg', '2021-07-06 22:55:33', 0),
(81, 3, 'PNG_transparency_demonstration_1.png', '/phpmotors/images/vehicles/PNG_transparency_demonstration_1.png', '2021-07-06 22:56:14', 0),
(82, 3, 'PNG_transparency_demonstration_1-tn.png', '/phpmotors/images/vehicles/PNG_transparency_demonstration_1-tn.png', '2021-07-06 22:56:14', 0),
(83, 29, 's-l1600.jpg', '/phpmotors/images/vehicles/s-l1600.jpg', '2021-07-09 23:09:40', 1),
(84, 29, 's-l1600-tn.jpg', '/phpmotors/images/vehicles/s-l1600-tn.jpg', '2021-07-09 23:09:40', 1),
(85, 5, 'rusty-old-car-old-timer-with-bullet-holes-on-farm-klein-aus-namibiaafrica-MB5G57.jpg', '/phpmotors/images/vehicles/rusty-old-car-old-timer-with-bullet-holes-on-farm-klein-aus-namibiaafrica-MB5G57.jpg', '2021-07-13 20:33:54', 1),
(86, 5, 'rusty-old-car-old-timer-with-bullet-holes-on-farm-klein-aus-namibiaafrica-MB5G57-tn.jpg', '/phpmotors/images/vehicles/rusty-old-car-old-timer-with-bullet-holes-on-farm-klein-aus-namibiaafrica-MB5G57-tn.jpg', '2021-07-13 20:33:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(10) UNSIGNED NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,0) NOT NULL,
  `invStock` smallint(6) NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. Its great for everyday driving as well as offroading weather that be on the the rocks or in the mud!', '/phpmotors/images/jeep-wrangler.jpg', '/phpmotors/images/jeep-wrangler-tn.jpg', '28045', 4, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want as long as it&#39;s black.', '/phpmotors/images/ford-modelt.jpg', '/phpmotors/images/ford-modelt-tn.jpg', '30000', 2, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws.', '/phpmotors/images/adventador-tn.jpg', '/phpmotors/images/lambo-Adve-tn.jpg', '417650', 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. this beast comes with 60in tires giving you tracktions needed to jump and roll in the mud.', '/phpmotors/images/monster.jpg', '/phpmotors/images/monster-tn.jpg', '150000', 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. however with a little tlc it will run as good a new.', '/phpmotors/images/ms.jpg', '/phpmotors/images/ms-tn.jpg', '100', 200, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a super hero? now you can with the batmobile. This car allows you to switch to bike mode allowing you to easily maneuver through trafic during rush hour.', '/phpmotors/images/bat.jpg', '/phpmotors/images/bat-tn.jpg', '65000', 2, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of there 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/phpmotors/images/mm.jpg', '/phpmotors/images/mm-tn.jpg', '10000', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000 gallon tank.', '/phpmotors/images/fire-truck.jpg', '/phpmotors/images/fire-truck-tn.jpg', '50000', 2, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equiped with the siren which is convenient for college students running late to class.', '/phpmotors/images/crown-vic.jpg', '/phpmotors/images/crown-vic-tn.jpg', '10000', 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the ar you need! This car has great performance at an affordable price. Own it today!', '/phpmotors/images/camaro.jpg', '/phpmotors/images/camaro-tn.jpg', '25000', 10, 'Silver', 3),
(11, 'Cadilac', 'Escalade', 'This stylin car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/phpmotors/images/escalade.jpg', '/phpmotors/images/escalade-tn.jpg', '75195', 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go offroading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/phpmotors/images/hummer.jpg', '/phpmotors/images/hummer-tn.jpg', '58800', 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rushhour trafic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get them while they last!', '/phpmotors/images/aerocar.jpg', '/phpmotors/images/aerocar-tn.jpg', '1000000', 6, 'Red', 2),
(14, 'FBI', 'Survalence Van', 'do you like police shows? You\'ll feel right at home driving this van, come complete with survalence equipments for and extra fee of $2,000 a month. ', '/phpmotors/images/fbi.jpg', '/phpmotors/images/fbi-tn.jpg', '20000', 1, 'Green', 1),
(15, 'Dog ', 'Car', 'Do you like dogs? Well this car is for you straight from the 90s from Aspen, Colorado we have the orginal Dog Car complete with fluffy ears.  ', '/phpmotors/images/dog.jpg', '/phpmotors/images/dog-tn.jpg', '35000', 1, 'Brown', 2),
(27, 'Tesla', 'Model 3', 'It never gets dirty', '/phpmotors/images/no-image-tn.png', '/phpmotors/images/no-image.png', '39990', 1, 'blue', 27),
(28, 'DMC', 'Delorean', 'Comes with fuzzy dice', '/images/no-image.png', '/images/no-image.png', '5000', 2, 'silver', 5),
(29, 'Polly Pocket', 'Car', 'It is very small and works good for shoes for small children', '/images/vehicles/no-image.png', '/images/vehicles/no-image.png', '1000000', 2, 'blue', 5);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) UNSIGNED NOT NULL,
  `reviewText` text CHARACTER SET latin1 NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `invId` int(10) UNSIGNED NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(38, 'Great deal. This car actually drives itself. So good for road trips. I named it Jimmy Craig Jr.', '2021-07-13 22:09:11', 27, 10),
(39, 'This car is terrible. The wheels are so tall, a short person like me can&#39;t even get in to the drivers seat.', '2021-07-13 22:11:35', 4, 10),
(40, 'You&#39;ll never find a better price!', '2021-07-13 22:11:51', 5, 10),
(41, 'I think it&#39;s a fake. I thought I was ordering a real car, but instead I got a little plastic toy.', '2021-07-13 22:23:15', 7, 13),
(42, 'This car is so sneaky. Nobody knows I&#39;m an FBI agent when I drive this.', '2021-07-13 22:23:46', 14, 13),
(43, 'I really don&#39;t like Jeeps. And they lied, it is not yellow, it is orange.', '2021-07-13 22:25:02', 1, 14),
(44, 'One of the worst cars ever made.', '2021-07-13 22:26:30', 28, 15),
(45, 'Also one of the worst cars ever made.', '2021-07-13 22:26:43', 12, 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `invId` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `FK_reviews_clients` (`clientId`),
  ADD KEY `FK_reviews_inventory` (`invId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
