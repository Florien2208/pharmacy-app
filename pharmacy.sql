-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2024 at 10:38 AM
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
-- Database: `pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_credentials`
--

CREATE TABLE `admin_credentials` (
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `PHARMACY_NAME` varchar(120) NOT NULL,
  `ADDRESS` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `CONTACT_NUMBER` double NOT NULL,
  `IS_LOGGED_IN` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `admin_credentials`
--

INSERT INTO `admin_credentials` (`USERNAME`, `PASSWORD`, `PHARMACY_NAME`, `ADDRESS`, `EMAIL`, `CONTACT_NUMBER`, `IS_LOGGED_IN`) VALUES
('Florien', 'user1234', 'INEZA PHARMACY', 'KIGALI', 'user@gmail.com', 4567898, 0),
('admin', 'user1234', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(20) NOT NULL,
  `CONTACT_NUMBER` varchar(10) NOT NULL,
  `ADDRESS` varchar(100) NOT NULL,
  `DOCTOR_NAME` varchar(20) NOT NULL,
  `DOCTOR_ADDRESS` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`ID`, `NAME`, `CONTACT_NUMBER`, `ADDRESS`, `DOCTOR_NAME`, `DOCTOR_ADDRESS`) VALUES
(4, 'Kiran Suthar', '1234567690', 'Andheri East', 'Anshari', 'Andheri East'),
(6, 'Aditya', '7365687269', 'Virar West', 'Xyz', 'Virar West'),
(11, 'Shivam Tiwari', '6862369896', 'Dadar West', 'Dr Kapoor', 'Dadar East'),
(13, 'Varsha Suthar', '7622369694', 'Rani Station', 'Dr Ramesh', 'Rani Station'),
(14, 'Prakash Bhattarai', '9802851472', 'Pokhara-16, Dhikidada', 'Hari Bahadur', 'Matepani-12');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `INVOICE_ID` int(11) NOT NULL,
  `NET_TOTAL` double NOT NULL DEFAULT 0,
  `INVOICE_DATE` date NOT NULL DEFAULT current_timestamp(),
  `CUSTOMER_ID` int(11) NOT NULL,
  `TOTAL_AMOUNT` double NOT NULL,
  `TOTAL_DISCOUNT` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`INVOICE_ID`, `NET_TOTAL`, `INVOICE_DATE`, `CUSTOMER_ID`, `TOTAL_AMOUNT`, `TOTAL_DISCOUNT`) VALUES
(1, 30, '2021-10-19', 14, 30, 0),
(2, 2626, '2021-10-19', 6, 2626, 0),
(3, 2626, '2024-03-30', 6, 2626, 0),
(4, 136.5, '2024-04-21', 6, 195, 58.5),
(5, 9, '2024-04-22', 14, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `PACKING` varchar(20) NOT NULL,
  `GENERIC_NAME` varchar(100) NOT NULL,
  `SUPPLIER_NAME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`ID`, `NAME`, `PACKING`, `GENERIC_NAME`, `SUPPLIER_NAME`) VALUES
(1, 'Nicip Plus', '10tab', 'Paracetamole', 'BDPL PHARMA'),
(2, 'Crosin', '10tab', 'Hdsgvkvajkcbja', 'Kiran Pharma'),
(4, 'Dolo 650', '15tab', 'paracetamole', 'BDPL PHARMA'),
(5, 'Gelusil', '10tab', 'mint fla', 'Desai Pharma'),
(6, 'Fghj', '3', 'Rtyui', 'Desai Pharma'),
(7, 'Djflo', '32', 'Djflo', 'Avceve'),
(8, 'Yola', '30TAB', 'Paracetamole', 'SS Distributors'),
(9, 'Yve', '10 TAB', 'Y', 'Kiran Pharma'),
(10, 'Dfg', 'ERR', 'Erft', 'Desai Pharma'),
(11, 'Eeeeee', 'EE', 'Eeeeeeeeeeeeeeeee1', 'BDPL PHARMA'),
(12, 'Crosin', 'EE', 'Eeeeeeeeeeeeeeeee1', 'BDPL PHARMA'),
(13, 'Florien', 'QW', 'Flooooo', 'SS Distributors'),
(14, 'Gelusil', 'QW', 'Flooooo', 'SS Distributors'),
(15, 'Gelusil', 'FGHJ', 'Hhhhhhhhhhhh', 'SS Distributors'),
(16, 'Test', '20TAB', 'Test', 'Kiran Pharma'),
(17, 'Test2', '4567', 'Test2', 'BDPL PHARMA'),
(18, 'Test3', '54', 'Test3', 'Fndn'),
(19, 'Test4', '2345', 'Test4', 'SS Distributors'),
(20, 'Gelusil', '345', 'Hyne', 'Hmrxfmgtmt'),
(21, 'Gelusil34567890', '345', 'Hyne234567u8', 'Hmrxfmgtmt'),
(22, 'Florien', '20TAB', 'Florien', 'Desai Pharma'),
(23, 'Nicip Plus', '20TAB', 'Ttttttttttttttttt', 'tttttttttttttttttttttttt'),
(24, 'DOLO327', '80TAB', 'Ddddddddddddddddd', 'Kiran Pharma'),
(25, 'Dolo 650', '80TAB', 'Dolo 650', 'Kiran Pharma'),
(26, 'Hhhhhhhhhhhh', '4', 'Hhhhhhhhhhhrrrrrrrrrrrrr', 'Gahgkakbvkv'),
(27, 'Dolo 650', '70', 'Dolo 650', 'SS Distributors'),
(28, 'Dolo 650', '567', 'Dolo 650', 'BDPL PHARMA'),
(29, 'Rrrrrrrrrrrrrrrr', 'RTY', 'Rrrrrrrrrrrrrrrrrrrrrrrrrrrrr', 'Kiran Pharma');

-- --------------------------------------------------------

--
-- Table structure for table `medicines_stock`
--

CREATE TABLE `medicines_stock` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `BATCH_ID` varchar(20) NOT NULL,
  `EXPIRY_DATE` varchar(10) NOT NULL,
  `QUANTITY` int(11) NOT NULL,
  `MRP` double NOT NULL,
  `RATE` double NOT NULL,
  `INVOICE_NUMBER` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `medicines_stock`
--

INSERT INTO `medicines_stock` (`ID`, `NAME`, `BATCH_ID`, `EXPIRY_DATE`, `QUANTITY`, `MRP`, `RATE`, `INVOICE_NUMBER`) VALUES
(1, 'Crosin', 'CROS12', '12/34', 13, 2626, 26, 0),
(2, 'Gelusil', 'G327', '12/42', 22, 15, 12, 0),
(3, 'Dolo 650', 'DOLO327', '01/23', 3, 30, 24, 0),
(4, 'Nicip Plus', 'NI325', '05/25', 3, 32.65, 28, 0),
(5, 'Fghj', 'tyu', '12/42', 0, 0, 0, 0),
(6, 'Hhhhhhhhhhhh', 'DHGT345', '05/25', 3, 65, 45, 646854),
(7, 'Dolo 650', '87654', '05/25', 258, 12, 8, 345678987654),
(8, 'Rrrrrrrrrrrrrrrr', 'IUYFTY45', '05/25', 6, 5, 3, 3456789098765);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `SUPPLIER_NAME` varchar(100) NOT NULL,
  `INVOICE_NUMBER` int(11) NOT NULL,
  `VOUCHER_NUMBER` int(11) NOT NULL,
  `PURCHASE_DATE` varchar(10) NOT NULL,
  `TOTAL_AMOUNT` double NOT NULL,
  `PAYMENT_STATUS` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`SUPPLIER_NAME`, `INVOICE_NUMBER`, `VOUCHER_NUMBER`, `PURCHASE_DATE`, `TOTAL_AMOUNT`, `PAYMENT_STATUS`) VALUES
('Desai Pharma', 34567, 1, '2024-04-01', 20, 'PAID'),
('Avceve', 234567, 2, '2024-04-01', 32, 'PAID'),
('SS Distributors', 12345678, 3, '2024-04-01', 64, 'PAID'),
('Kiran Pharma', 45678, 4, '2024-04-01', 18, 'PAID'),
('BDPL PHARMA', 1, 5, '2024-04-01', 27, 'PAID'),
('Hmrxfmgtmt', 4, 6, '2024-04-01', 24, 'PAID'),
('Desai Pharma', 23456, 7, '2024-04-01', 690, 'PAID'),
('BDPL PHARMA', 1234567, 8, '2024-04-01', 12, 'PAID'),
('BDPL PHARMA', 1234561, 9, '2024-04-01', 12, 'PAID'),
('SS Distributors', 90, 10, '2024-04-01', 50, 'PAID'),
('SS Distributors', 91, 11, '2024-04-01', 50, 'PAID'),
('SS Distributors', 92, 12, '2024-04-01', 50, 'PAID'),
('SS Distributors', 93, 13, '2024-04-01', 50, 'PAID'),
('SS Distributors', 679, 14, '2024-04-01', 30, 'PAID'),
('SS Distributors', 6790, 15, '2024-04-01', 30, 'PAID'),
('BDPL PHARMA', 56, 16, '2024-04-01', 18, 'PAID'),
('BDPL PHARMA', 560, 17, '2024-04-01', 18, 'PAID'),
('BDPL PHARMA', 563, 18, '2024-04-01', 18, 'PAID'),
('Kiran Pharma', 2343, 19, '2024-04-21', 18, 'PAID'),
('BDPL PHARMA', 123456, 20, '2024-04-21', 680, 'PAID'),
('Fndn', 4356, 21, '2024-04-21', 268, 'PAID'),
('Hmrxfmgtmt', 2345, 22, '2024-04-21', 24, 'PAID'),
('Hmrxfmgtmt', 2348, 23, '2024-04-21', 24, 'PAID'),
('Hmrxfmgtmt', 2344, 24, '2024-04-21', 24, 'PAID'),
('Desai Pharma', 23450, 25, '2024-04-21', 32, 'PAID'),
('Tttttttttttttttttttttttt', 23456786, 26, '2024-04-21', 63, 'PAID'),
('Kiran Pharma', 987654, 27, '2024-04-21', 2700, 'PAID'),
('Kiran Pharma', 9876545, 28, '2024-04-21', 2700, 'PAID'),
('Kiran Pharma', 98765450, 29, '2024-04-21', 2700, 'PAID'),
('Kiran Pharma', 987654507, 30, '2024-04-21', 2700, 'PAID'),
('Kiran Pharma', 2147483647, 31, '2024-04-21', 2700, 'PAID'),
('Kiran Pharma', 2147483647, 32, '2024-04-21', 2700, 'PAID'),
('Kiran Pharma', 2147483647, 33, '2024-04-21', 2700, 'PAID'),
('Gahgkakbvkv', 646854, 34, '2024-04-21', 270, 'PAID'),
('SS Distributors', 2147483647, 35, '2024-04-21', 624, 'PAID'),
('BDPL PHARMA', 4567800, 36, '2024-04-21', 2700, 'PAID'),
('BDPL PHARMA', 45678000, 37, '2024-04-21', 2700, 'PAID'),
('Kiran Pharma', 2147483647, 38, '2024-04-21', 24, 'PAID');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `SALES_ID` int(11) NOT NULL,
  `CUSTOMER_ID` int(11) NOT NULL,
  `INVOICE_NUMBER` double NOT NULL,
  `MEDICINE_NAME` varchar(100) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `BATCH_ID` varchar(20) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `EXPIRY_DATE` varchar(10) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `QUANTITY` int(11) NOT NULL,
  `MRP` double NOT NULL,
  `DISCOUNT` double NOT NULL,
  `TOTAL` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`SALES_ID`, `CUSTOMER_ID`, `INVOICE_NUMBER`, `MEDICINE_NAME`, `BATCH_ID`, `EXPIRY_DATE`, `QUANTITY`, `MRP`, `DISCOUNT`, `TOTAL`) VALUES
(1, 14, 5, 'Rrrrrrrrrrrrrrrr', 'IUYFTY45', '05/25', 2, 5, 10, 9);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `CONTACT_NUMBER` varchar(10) NOT NULL,
  `ADDRESS` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`ID`, `NAME`, `EMAIL`, `CONTACT_NUMBER`, `ADDRESS`) VALUES
(1, 'Desai Pharma', 'desai@gmail.com', '9948724242', 'Mahim East'),
(2, 'BDPL PHARMA', 'bdpl@gmail.com', '8645632963', 'Santacruz West'),
(9, 'Kiran Pharma', 'kiranpharma@gmail.com', '7638683637', 'Andheri East'),
(10, 'Rsrnrnrndnn', 'ydj', '3737355538', '3fndfndfndndfnfdndfn'),
(11, 'Dfnsfndfndf', 'fnsn', '5475734385', 'Ndnss4yrhrhdhrdhrh'),
(12, 'SS Distributors', 'ssdis@gamil.com', '3867868752', 'Matunga West'),
(13, 'Avceve', 'ehh', '3466626226', 'Eteh266266262'),
(14, 'Hrshrhrjher', 'dzgdg', '4636347335', 'Rhrswjrnswjn'),
(15, 'Hmrxfmgtmt', 'trmtrm gm tr', '6553838835', '38ejtdjtdxetjdt'),
(20, 'Dtdxtkmtdshrrhhsrjrs', 'trmtrm gm tr', '6553838835', '38ejtdjtdxetjdt'),
(23, 'Fndn', 'nena ena', '3462462642', 'Ebsbsdbsdndsnsdfns'),
(24, 'Fndnbrwh', 'nena ena', '3462462642', 'Ebsbsdbsdndsnsdfns'),
(25, 'Jnentjrtj', 'nena ena', '3462462642', 'Ebsbsdbsdndsnsdfns'),
(26, 'Jerthjrtjtjr', 'nena ena', '3462462642', 'Ebsbsdbsdndsnsdfns'),
(28, 'Gahgkakbvkv', 'nena ena', '3462462642', 'Ebsbsdbsdndsnsdfns'),
(29, 'Hywhwhrhdw', 'nena ena', '3462462642', 'Ebsbsdbsdndsnsdfns'),
(30, 'Tttttttttttttttttttttttt', 'tttttttttttttt', '8765435544', 'Ttttttttttttttttttt');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_credentials`
--
ALTER TABLE `admin_credentials`
  ADD PRIMARY KEY (`USERNAME`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`INVOICE_ID`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `medicines_stock`
--
ALTER TABLE `medicines_stock`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `BATCH_ID` (`BATCH_ID`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`VOUCHER_NUMBER`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`SALES_ID`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `INVOICE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `medicines_stock`
--
ALTER TABLE `medicines_stock`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `VOUCHER_NUMBER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `SALES_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
