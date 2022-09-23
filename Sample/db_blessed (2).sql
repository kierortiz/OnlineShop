-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2020 at 01:53 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_blessed`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

CREATE TABLE `tbl_account` (
  `ACC_ID` int(11) NOT NULL,
  `ACC_USER` varchar(25) NOT NULL,
  `ACC_PASS` varchar(25) NOT NULL,
  `ACC_FNAME` text NOT NULL,
  `ACC_LNAME` text NOT NULL,
  `ACC_CONTACT` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_account`
--

INSERT INTO `tbl_account` (`ACC_ID`, `ACC_USER`, `ACC_PASS`, `ACC_FNAME`, `ACC_LNAME`, `ACC_CONTACT`) VALUES
(22, 'user1', '555tuna', 'Alexander', 'Adams', '0936554283'),
(23, 'josiah21', 'nice', 'jos', 'josa', '98123908');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `CART_ID` int(11) NOT NULL,
  `CART_PID` int(11) NOT NULL,
  `CART_PRODUCTNAME` varchar(25) NOT NULL,
  `CART_VARIANT` varchar(25) NOT NULL,
  `CART_QUAN` int(11) NOT NULL,
  `CART_PRICE` double NOT NULL,
  `CART_COMPPRICE` double NOT NULL,
  `CART_TOTAL` double NOT NULL,
  `CART_STATUS` text NOT NULL,
  `CART_CAT` text NOT NULL,
  `CART_OP` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`CART_ID`, `CART_PID`, `CART_PRODUCTNAME`, `CART_VARIANT`, `CART_QUAN`, `CART_PRICE`, `CART_COMPPRICE`, `CART_TOTAL`, `CART_STATUS`, `CART_CAT`, `CART_OP`) VALUES
(134, 201, 'LADYS CHOICE MAYO', '120grams', 5, 160, 800, 0, 'CART', '', ''),
(135, 202, 'pancit canton', 'PANCIT WITH REAL BATO', 4, 20, 80, 0, 'CART', '', ''),
(136, 203, 'lucky me beef', 'BEEF NA BEEF', 4, 21, 84, 0, 'CART', '', ''),
(137, 204, 'NBA 2K21', 'NORMAL EDITION', 1, 2999.99, 2999.99, 0, 'CART', '', ''),
(138, 205, 'DIANA CORTEZ', 'MAY JOWA DI NAMAN MAHA;', 1, 1000000, 1000000, 0, 'CART', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `CAT_ID` int(11) NOT NULL,
  `CAT_NAME` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `PROD_ID` int(11) NOT NULL,
  `PROD_NAME` varchar(25) NOT NULL,
  `PROD_QUANTITY` int(11) NOT NULL,
  `PROD_PRICE` double NOT NULL,
  `PROD_VARIANT` varchar(25) NOT NULL,
  `PROD_CAT` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`PROD_ID`, `PROD_NAME`, `PROD_QUANTITY`, `PROD_PRICE`, `PROD_VARIANT`, `PROD_CAT`) VALUES
(201, 'LADYS CHOICE MAYO', 20, 160, '120grams', 'CONDIMENTS'),
(202, 'pancit canton', 20, 20, 'PANCIT WITH REAL BATO', 'INSTANT NOODLES'),
(203, 'lucky me beef', 20, 21, 'BEEF NA BEEF', 'INSTANT NOODLES'),
(204, 'NBA 2K21', 10, 2999.99, 'NORMAL EDITION', 'GAMES'),
(205, 'DIANA CORTEZ', 200, 1000000, 'MAY JOWA DI NAMAN MAHA;', 'ASO');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_res`
--

CREATE TABLE `tbl_res` (
  `RES_ID` int(11) NOT NULL,
  `RES_PROD_ID` int(11) NOT NULL,
  `RES_PRODNAME` varchar(25) NOT NULL,
  `RES_PRODQUAN` int(11) NOT NULL,
  `RES_PRODVAR` varchar(25) NOT NULL,
  `RES_PRODPRICE` double NOT NULL,
  `RES_PRODOWN` double NOT NULL,
  `RES_PRODTOTAL` double NOT NULL,
  `RES_PRODSTAT` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`ACC_ID`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`CART_ID`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`CAT_ID`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`PROD_ID`);

--
-- Indexes for table `tbl_res`
--
ALTER TABLE `tbl_res`
  ADD PRIMARY KEY (`RES_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_account`
--
ALTER TABLE `tbl_account`
  MODIFY `ACC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `CART_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `CAT_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `PROD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `tbl_res`
--
ALTER TABLE `tbl_res`
  MODIFY `RES_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
