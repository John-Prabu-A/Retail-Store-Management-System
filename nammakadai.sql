-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2023 at 05:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nammakadai`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE `admin_details` (
  `adminId` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `emailId` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobileNo` int(100) DEFAULT NULL,
  `LastVisited` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`adminId`, `name`, `emailId`, `password`, `mobileNo`, `LastVisited`) VALUES
(1, 'Admin', 'msquaremobilesofficial@gmail.com', '$2y$10$MUiTwQQxoqbLq5HdO6OhLOKXIBCS3mcmu7Zla7EsIELeqqyZYdLDe', 2147483647, '2023-12-12 22:29:52');

-- --------------------------------------------------------

--
-- Table structure for table `admin_profile_pic`
--

CREATE TABLE `admin_profile_pic` (
  `adminId` int(255) NOT NULL,
  `profilePicture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_profile_pic`
--

INSERT INTO `admin_profile_pic` (`adminId`, `profilePicture`) VALUES
(1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logindetails`
--

CREATE TABLE `logindetails` (
  `id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `logindetails`
--

INSERT INTO `logindetails` (`id`, `name`, `email`, `password`) VALUES
(1, 'Admin', 'msquaremobilesofficial@gmail.com', '$2y$10$MUiTwQQxoqbLq5HdO6OhLOKXIBCS3mcmu7Zla7EsIELeqqyZYdLDe'),
(2, 'John Prabu', 'john@gmail.com', '$2y$10$pLzT5cc8RTJzjBeGYYCcu.Y61EUk9q7X/ZrTokg0E19HLT4dA2NwW'),
(3, 'H Bharath', 'h.bharath1506@gmail.com', '$2y$10$JC5AX7p28fFhoLdCfP3hGOA6oCQEFLAZBEu2cDsJrrAW3tPL.crve'),
(4, 'John K', 'johnprabu2005@gmail.com', '$2y$10$epAI7rsPoJIm9Ac4MGsC2uH4VXr.43FFlEUDwmNaQlUe0gojjnn/S');

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `productId` int(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `originalPrice` double DEFAULT NULL,
  `sellingPrice` double DEFAULT NULL,
  `quantity` int(255) DEFAULT NULL,
  `productDescription` varchar(255) DEFAULT NULL,
  `product_type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`productId`, `productName`, `originalPrice`, `sellingPrice`, `quantity`, `productDescription`, `product_type`) VALUES
(1, '14max+ ScreenGuard', 60, 119, 41, 'Brand Perbee Compatible Devices Cellphone Material Tempered Glass Item Hardness 9H Product Dimensions 5.68\"L x 2.69\"W Compatible Phone Models Cellphone Special Feature 9 H Surface Hardness Finish Type Glossy Water Resistance Level Not Water Resist', 'Tempered-Glass'),
(2, 'MicroSD Card', 300, 499, 7, 'Brand Amazon Basics Flash Memory Type Micro SDXC Memory Storage Capacity 128 GB Color Black Read Speed 100 Megabytes Per Second', 'Storage-Devices'),
(3, 'iPhone Charger', 250, 399, 38, 'Brand QUZUDN Connectivity Technology USB, Lightning Connector Type usb Compatible Devices Cellular Phones Compatible Phone Models Compatible with iPhone 14 13 12 11 Pro Max XR XS X,iPad Special Feature Fast Charging Color White Input Voltage 1 Vo', 'Power-Adapters'),
(4, 'Foldable Stereo', 1000, 1999, 2, 'Item Weight 6 ounces ASIN B07ZG1K4TK Item model number K11 Customer Reviews 4.7 out of 5 stars 37,192 ratings Best Sellers Rank #248 in Electronics (See Top 100 in Electronics) #23 in On-Ear Headphones Is Discontinued By Manufacturer No Date Fir', 'Earphones'),
(5, 'Wireless Earbuds', 1100, 2199, 4, 'Product Dimensions 3.54 x 2.36 x 0.79 inches Item Weight 2.82 ounces ASIN B09FLNSYDZ Item model number T16 Batteries 1 Lithium Ion batteries required. (included) Customer Reviews 4.5 out of 5 stars 33,942 ratings Best Sellers Rank #32 in Electron', 'Earphones'),
(6, 'Wireless Headset', 800, 1499, 10, 'Package Dimensions 7.24 x 4.53 x 0.83 inches Item Weight 2.89 ounces ASIN B0BBPWC3H4 Item model number YT-RUNNER PRO Batteries 1 Lithium Polymer batteries required. (included) Customer Reviews 4.0 out of 5 stars 3,147 ratings Best Sellers Rank #7', 'Earphones'),
(7, 'AirPods 2nd generation', 20000, 25000, 4, 'AirPods\r\nWireless. Effortless. Magical.\r\nWith plenty of talk and listen time, voice-activated Siri access, and an available wireless charging case, AirPods deliver an incredible wireless headphone experience. Simply take them out and theyâ€™re ready to us', 'Earphones'),
(8, 'AirPods 3rd generation', 25000, 30000, 14, 'Audio Technology\r\nCustom high-excursion Apple driver\r\nCustom high dynamic range amplifier\r\nPersonalized Spatial Audio with dynamic head tracking1\r\nAdaptive EQ\r\nSensors\r\nDual beamforming microphones\r\nInward-facing microphone\r\nSkin-detect sensor\r\nMotion-det', 'Earphones'),
(9, 'AirPods Max', 45000, 49990, 11, 'Audio Technology\r\nApple-designed dynamic driver\r\nActive Noise Cancellation\r\nTransparency mode\r\nPersonalized Spatial Audio with dynamic head tracking1\r\nAdaptive EQ\r\nSensors\r\nOptical sensor (each ear cup)\r\nPosition sensor (each ear cup)\r\nCase-detect sensor ', 'Earphones'),
(10, 'USB type C adapter HUB', 1199, 1599, 45, '\r\nBrand	Hiearcool\r\nColor	Space grey\r\nHardware Interface	MicroSD, USB Type C, HDMI, USB 3.0\r\nSpecial Feature	Power Delivery, 4K HDMI, Fast Data Transfer, Plug and Play\r\nCompatible Devices	Macbook M1,M2,Type C Laptops,iPad Air/Pro/Mini,iMac,Steam Deck,Type ', 'Power-Adapters'),
(11, 'Temdan USB to USB C Adapter ', 999, 1199, 25, 'Compatible Devices	IPhone 15 14 13 12 11 Pro Max Plus Mini / Samsung Galaxy S21 S20 S22 S23 Fe Plus Ultra 5G Note 20 / Apple Watch iWatch Series 7 8 9 SE / iPad Pro iPad 8 8th 9 9th Air 4 4th Generation Mini Gen 6 2021 / AirPods Pro / USB C Block Plug,iPa', 'Power-Adapters');

-- --------------------------------------------------------

--
-- Table structure for table `product_pic`
--

CREATE TABLE `product_pic` (
  `productId` int(255) NOT NULL,
  `productImageLocation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_pic`
--

INSERT INTO `product_pic` (`productId`, `productImageLocation`) VALUES
(1, 'uploads/productImages/64e3b1d43bfd3_Iphone Temper.jpg'),
(2, 'uploads/productImages/64e3b86bda3ae_Memory card.jpg'),
(3, 'uploads/productImages/64e3b921d9d89_fast charger.jpg'),
(4, 'uploads/productImages/64e3c2130af4e_Foldable sterio.jpg'),
(5, 'uploads/productImages/64e3c46d6bbbf_airpot.jpg'),
(6, 'uploads/productImages/64e3c5852793d_neckband.jpeg'),
(7, 'uploads/productImages/6581c9443d6ef_Screenshot 2023-12-19 221503.png'),
(8, 'uploads/productImages/6581d042a55ff_Screenshot 2023-12-19 221510.png'),
(9, 'uploads/productImages/6581d0e9e3aef_cover7.png'),
(10, 'uploads/productImages/658e9ca74deb7_adapter.jpg'),
(11, 'uploads/productImages/658ea80f883a8_adapter1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `userId` int(255) NOT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `userPassword` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userMobileNo` varchar(100) DEFAULT NULL,
  `pendingStatus` enum('Yes','No') NOT NULL DEFAULT 'No',
  `lastVisited` datetime NOT NULL DEFAULT current_timestamp(),
  `purchaseCount` int(255) NOT NULL DEFAULT 0,
  `bills` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`userId`, `userName`, `userPassword`, `userEmail`, `userMobileNo`, `pendingStatus`, `lastVisited`, `purchaseCount`, `bills`) VALUES
(1, 'Bharath', '$2y$10$w6xxoWD35LYUCqyGTWTgxe.GV/pSCbVt46ACv4tQjQ52.qJRvr6ti', 'bharath@gmail.com', NULL, 'No', '2023-12-12 22:48:23', 2, NULL),
(2, 'John', '$2y$10$pLzT5cc8RTJzjBeGYYCcu.Y61EUk9q7X/ZrTokg0E19HLT4dA2NwW', 'john@gmail.com', '9088776655', 'No', '2023-12-12 22:53:34', 301, NULL),
(3, 'H Bharath', '$2y$10$JC5AX7p28fFhoLdCfP3hGOA6oCQEFLAZBEu2cDsJrrAW3tPL.crve', 'h.bharath1506@gmail.com', '8888888888', 'No', '2023-12-29 15:35:26', 22, NULL),
(4, 'John K', '$2y$10$epAI7rsPoJIm9Ac4MGsC2uH4VXr.43FFlEUDwmNaQlUe0gojjnn/S', 'johnprabu2005@gmail.com', NULL, 'No', '2023-12-29 16:31:48', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile_pic`
--

CREATE TABLE `user_profile_pic` (
  `userId` int(255) NOT NULL,
  `userProfileImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_profile_pic`
--

INSERT INTO `user_profile_pic` (`userId`, `userProfileImage`) VALUES
(2, 'uploads/profilePictures/658e97c136ba1_art.jpg'),
(3, 'uploads/profilePictures/658ea65d8dfbd_Screenshot 2023-12-25 144755.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `admin_profile_pic`
--
ALTER TABLE `admin_profile_pic`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `logindetails`
--
ALTER TABLE `logindetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `product_pic`
--
ALTER TABLE `product_pic`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `user_profile_pic`
--
ALTER TABLE `user_profile_pic`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_details`
--
ALTER TABLE `admin_details`
  MODIFY `adminId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logindetails`
--
ALTER TABLE `logindetails`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `productId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `userId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_profile_pic`
--
ALTER TABLE `admin_profile_pic`
  ADD CONSTRAINT `admin_profile_pic_ibfk_1` FOREIGN KEY (`adminId`) REFERENCES `admin_details` (`adminId`);

--
-- Constraints for table `product_pic`
--
ALTER TABLE `product_pic`
  ADD CONSTRAINT `product_pic_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product_details` (`productId`);

--
-- Constraints for table `user_profile_pic`
--
ALTER TABLE `user_profile_pic`
  ADD CONSTRAINT `user_profile_pic_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user_details` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
