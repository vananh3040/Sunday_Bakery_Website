-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 27, 2022 lúc 10:42 PM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `sundaybakery`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accounts`
--

CREATE TABLE `accounts` (
  `Acc_ID` int(11) NOT NULL,
  `Acc_Username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Acc_Password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Acc_Role` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Acc_Status` tinyint(1) NOT NULL DEFAULT 0,
  `Acc_Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Cus_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `accounts`
--

INSERT INTO `accounts` (`Acc_ID`, `Acc_Username`, `Acc_Password`, `Acc_Role`, `Acc_Status`, `Acc_Date`, `Cus_ID`) VALUES
(1, 'vananh', 'e358efa489f58062f10dd7316b65649e', 'admin', 1, '2020-12-10 02:24:46', NULL),
(6, 'vananh3040@gmail.com', 'd81f9c1be2e08964bf9f24b15f0e4900', 'customer', 0, '2020-12-11 01:44:32', 38),
(7, '1', 'c4ca4238a0b923820dcc509a6f75849b', 'customer', 0, '2020-12-18 04:26:19', 42),
(8, 't', 'e358efa489f58062f10dd7316b65649e', 'customer', 0, '2020-12-18 13:51:11', 47),
(50, 'dang', '0cc175b9c0f1b6a831c399e269772661', 'admin', 1, '2022-12-23 06:54:15', NULL),
(51, 'abc', '4124bc0a9335c27f086f24ba207a4912', 'admin', 1, '2022-12-23 09:54:26', NULL),
(52, 'username', '14c4b06b824ec593239362517f538b29', 'customer', 0, '2022-12-23 06:52:04', 68),
(53, 'dangnguyen', '25f9e794323b453885f5181f1b624d0b', 'customer', 0, '2022-12-23 09:06:59', 69);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `Cus_ID` int(11) NOT NULL,
  `Cus_Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Cus_BDay` date NOT NULL,
  `Cus_Gender` tinyint(1) NOT NULL,
  `Cus_Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Cus_Phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`Cus_ID`, `Cus_Name`, `Cus_BDay`, `Cus_Gender`, `Cus_Email`, `Cus_Phone`) VALUES
(23, 'Nguyễn Hải Đăng', '2000-12-28', 1, 'dangnguyen123@gmail.com', '0392915986'),
(38, 'Nguyễn Huỳnh My', '2020-12-24', 0, 'huynhyen@gmail.comm', '0392915985'),
(42, 'Test_12', '2020-12-25', 1, 'test@gmail.com', '0151641889'),
(47, 'Hoàng Hà', '2020-12-28', 1, 'hoangha123@gmail.com', '0392915984'),
(52, 'vananh301@gmail.com', '0000-00-00', 0, '', ''),
(66, 'Nguyễn Vân Anh', '2022-11-29', 1, 'vananh30@gmail.com', '658'),
(67, 'ahn', '2022-12-17', 0, 'aa@gmail.com', '6789'),
(68, 'Trần Huỳnh Mai', '2022-12-08', 0, 'vananh30@gmail.com', '0392915987'),
(69, 'Nguyễn Hải Đăng', '2022-12-02', 1, 'kjdnskfj', '394');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `Ord_ID` int(11) NOT NULL,
  `Ord_Address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `Ord_Date` datetime NOT NULL,
  `Ord_Date_Done` datetime NOT NULL DEFAULT current_timestamp(),
  `Ord_Total` bigint(20) NOT NULL,
  `Ord_Status` int(11) NOT NULL DEFAULT 0,
  `Cus_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`Ord_ID`, `Ord_Address`, `Ord_Date`, `Ord_Date_Done`, `Ord_Total`, `Ord_Status`, `Cus_ID`) VALUES
(72, '5', '2020-12-23 13:10:07', '2020-12-28 02:14:10', 44000, 3, 47),
(73, '5', '2020-12-23 13:10:31', '2020-12-27 01:58:04', 100000, 3, 47),
(74, '6', '2020-12-23 13:10:53', '2020-12-26 02:02:38', 51500, 3, 47),
(78, 'Test Admin', '2020-12-24 21:44:10', '2020-12-27 01:58:04', 100000, 3, 47),
(79, 'ABC', '2020-12-25 14:42:21', '2020-12-27 01:58:04', 90000, 3, 47),
(86, 'TP.HCM', '2020-12-28 09:40:23', '2020-12-28 09:44:32', 305000, 3, 47),
(130, 'o nha tao', '2022-12-23 05:29:17', '2022-12-23 05:29:17', 456000, 2, 67),
(131, '43 Tan Lap, Dong Hoa Di An Binh Duong', '2022-12-23 10:08:55', '2022-12-23 10:08:55', 198000, 2, 38),
(132, '55 To Vinh Dien', '2022-12-23 10:24:54', '2022-12-23 10:24:54', 247000, 1, 38),
(133, 'sdf', '2022-12-23 11:05:06', '2022-12-23 11:05:06', 247000, 0, 38),
(134, 'zd', '2022-12-23 12:50:41', '2022-12-23 12:50:41', 300000, 0, 38),
(135, '23 tan lap', '2022-12-23 17:05:37', '2022-12-23 17:05:37', 700000, 0, 38);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `Ord_ID` int(11) NOT NULL,
  `Pro_ID` int(11) NOT NULL,
  `Ordd_Amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`Ord_ID`, `Pro_ID`, `Ordd_Amount`) VALUES
(72, 5, 2),
(73, 6, 5),
(74, 7, 2),
(78, 6, 5),
(79, 8, 2),
(86, 1, 3),
(86, 6, 4),
(130, 1, 2),
(130, 4, 1),
(130, 6, 1),
(131, 5, 9),
(132, 1, 3),
(132, 5, 1),
(133, 1, 3),
(133, 5, 1),
(134, 2, 10),
(135, 39, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `Pro_ID` int(11) NOT NULL,
  `Pro_Img` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `Pro_Type` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `Pro_Name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `Pro_Price` bigint(20) NOT NULL,
  `Pro_Rate` int(5) NOT NULL,
  `Pro_Info` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `Pro_View` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`Pro_ID`, `Pro_Img`, `Pro_Type`, `Pro_Name`, `Pro_Price`, `Pro_Rate`, `Pro_Info`, `Pro_View`) VALUES
(1, 'img/cake1.webp', 'Event Cake', 'Golden Sparkle', 120000, 5, 'A refreshing 6\" spongy chiffon cake filled with strawberries and pineapples, topped with pineapple jam and fresh strawberries. This cake features minimal white chocolate whip ganache frosting. This cake is perfect for those looking for a more refreshing option for any celebration or afternoon pick me up. It can serve up to 6 - 8 people.', 87),
(2, 'img/cake2.webp', 'Signature Cake', 'MangoTango', 188000, 4, 'A refreshing 6\" spongy chiffon cake filled with mango puree & finished with white chocolate whip ganache. This cake is perfect for any celebration or afternoon pick me up and can serve up to 6 - 8 people.', 36),
(3, 'img/cake3.webp', 'Event Cake', 'Tutti Frutti', 97000, 5, '6\" spongy chiffon cake filled with strawberries and kiwis & finished with white chocolate whip ganache. This cake can serve up to 6 - 8 people.', 23),
(4, 'img/cake4.webp', 'Event Cake', 'Black Sesam', 150000, 3, 'Gluten free and dairy free black sesame chiffon cake, topped with sesame biscuits. This cake is 6 inch wide and can serve around 6 - 8 people. ', 11),
(5, 'img/cake5.webp', 'Signature Cake', 'Chocolate cotton cake', 220000, 4, 'Dairy Free and gluten free fluffy chocolate chiffon cake topped with blueberries, chocolate pearls and gold foil. This cake is 6 inch wide and can serve around 6 - 8 people. ', 12),
(6, 'img/cake6.webp', 'Event Cake', 'Magic Hours', 20000, 5, 'A vegan apple crumble sponge cake filled with biscoff jam. Topped with Lotus biscoff cookies and gold foil, this cake is perfect for any special celebration.', 30),
(7, 'img/cake7.webp', 'Event Cake', 'Mini naked Cake', 250000, 5, 'The mini version of our signature naked cake.\n\nThis 2-layers cake has a minimal amount of frosting, showing off the cake\'s natural texture and color. Topped with strawberries and blueberries, this cake is perfect for any occasion.', 16),
(8, 'img/cake8.webp', 'Event Cake', 'Chocolate Rasberry', 375000, 5, 'Congratulate your loved ones in their big day with this carefully curated healthy sweet treats hamper.', 14),
(9, 'img/cake9.webp', 'Event Cake', 'Chocolate Indulgen', 415000, 5, 'An endearing sheep top-forward cake of your choice covered in delicious chocolate ganache to add to your celebration. Fuzzy will surely bring a lot of joy!', 7),
(10, 'img/cake12.webp', 'Signature Cake', 'Fuzzy', 340000, 4, 'An endearing sheep top-forward cake of your choice covered in delicious chocolate ganache to add to your celebration. Fuzzy will surely bring a lot of joy!', 12),
(11, 'img/cake11.webp', 'Signature Cake', 'Spikey', 340000, 4, 'An adorable hedgehog top-forward cake of your choice covered in delicious chocolate ganache to celebrate your loved ones. From its mouth-watering smell and taste to its endearing handcrafted design, Spikey will for sure put a smile in their face!', 22),
(12, 'img/cake3.webp', 'Signature Cake', 'Essence of love', 320000, 5, 'Inspired by the exquisite flower bouquets that celebrate special occasions, the heavenly Seasonal Essence of Love boasts a blooming decor atop the gold foil-dressed cake. With sending heartfelt blessings to your loved ones in mind, fresh flowers like Spray Rose, Chrysanthemum, Montbretia are carefully arranged to elevate the majestic outlook, perfect to surprise your beloved with a grand gesture that stays in lasting memories.\n\n*The flower arrangement is for reference only as it could be slightly different depending on the season. ', 14),
(25, 'Image/Uploads/cake7.jpg', 'Signature Cake', 'CHOCOLATE BISCOTTI', 356000, 5, 'Dipped in velvety dairy free chocolate sauce, the classic biscotti is loaded with bits of cacao nibs, almond, and a kick of zing from orange zest.', 2),
(39, 'Image/Uploads/che1.jpg', 'Signature Cake', 'Nausicaa ', 350000, 5, 'A sophisticated, chic and elegant classic porcelain vase with a modern twist. This flower arrangement will be a show-stopper for your grand celebration. ', 2),
(41, 'Image/Uploads/1.webp', 'Signature Cake', ' Baby Doll', 50000, 5, 'Gluten free, no added sugar, keto friendly blueberry keto cheesecake. The cheesecake is filled with blueberry jam inside. \r\n ', 0),
(42, 'Image/Uploads/2.webp', 'Event Cake', 'Strawberry Ketto', 67890, 5, 'A sophisticated, chic and elegant classic porcelain vase with a modern twist. This flower arrangement will be a show-stopper for your grand celebration. ', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`Acc_ID`),
  ADD UNIQUE KEY `Acc_Username` (`Acc_Username`),
  ADD KEY `FK_ACCOUNTS_01` (`Cus_ID`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Cus_ID`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Ord_ID`),
  ADD KEY `FK_ORDERS_01` (`Cus_ID`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`Ord_ID`,`Pro_ID`),
  ADD KEY `FK_ORDERDETAILS_02` (`Pro_ID`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Pro_ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `accounts`
--
ALTER TABLE `accounts`
  MODIFY `Acc_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `Cus_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `Ord_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `Pro_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `FK_ACCOUNTS_01` FOREIGN KEY (`Cus_ID`) REFERENCES `customer` (`Cus_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_ORDERS_01` FOREIGN KEY (`Cus_ID`) REFERENCES `customer` (`Cus_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `FK_ORDERDETAILS_01` FOREIGN KEY (`Ord_ID`) REFERENCES `orders` (`Ord_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ORDERDETAILS_02` FOREIGN KEY (`Pro_ID`) REFERENCES `products` (`Pro_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
