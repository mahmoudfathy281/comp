-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18 سبتمبر 2019 الساعة 14:12
-- إصدار الخادم: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `complain`
--

-- --------------------------------------------------------

--
-- بنية الجدول `complain_rec`
--

CREATE TABLE `complain_rec` (
  `complain_id` int(11) NOT NULL,
  `complaint_name` varchar(255) NOT NULL,
  `complain_desc` varchar(500) NOT NULL,
  `complain_number` varchar(200) NOT NULL,
  `complain_country` varchar(250) NOT NULL,
  `complain_nat` varchar(250) NOT NULL,
  `Complain_position` varchar(250) NOT NULL,
  `complain_riplay` varchar(200) NOT NULL,
  `complain_status` varchar(250) NOT NULL,
  `attachment` varchar(250) NOT NULL,
  `complain_user` varchar(250) NOT NULL,
  `Efforts` varchar(250) NOT NULL,
  `complain_date` date NOT NULL,
  `complain_entity` int(11) NOT NULL,
  `complain_personal` int(11) NOT NULL,
  `complain_users` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `complain_other` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- بنية الجدول `entity_rec`
--

CREATE TABLE `entity_rec` (
  `entity_id` int(11) NOT NULL,
  `entity_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `entity_rec`
--

INSERT INTO `entity_rec` (`entity_id`, `entity_name`) VALUES
(1, 'فيس بوك'),
(2, 'الخط الساخن'),
(3, 'بريد الكتروني'),
(4, 'مقابلة شخصية'),
(5, 'مكتب الوزيرة'),
(6, 'مجلس النواب'),
(7, 'المجلس القومي لحقوق الانسان'),
(8, 'مؤتمر الكيانات'),
(9, 'محافظات'),
(10, 'الكيانات');

-- --------------------------------------------------------

--
-- بنية الجدول `personal_edu_rec`
--

CREATE TABLE `personal_edu_rec` (
  `edu_rec_id` int(11) NOT NULL,
  `edu_rec_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `personal_edu_rec`
--

INSERT INTO `personal_edu_rec` (`edu_rec_id`, `edu_rec_name`) VALUES
(1, 'اعدادية'),
(2, 'دبلوم ثانوي'),
(3, 'ثانوي عام'),
(4, 'بكالوريوس'),
(5, 'ماجيستير'),
(6, 'دكتوراه'),
(7, 'موظف');

-- --------------------------------------------------------

--
-- بنية الجدول `personal_record`
--

CREATE TABLE `personal_record` (
  `personal_id` int(11) NOT NULL,
  `personal_name` varchar(250) NOT NULL,
  `personal_email` varchar(250) NOT NULL,
  `phone_local` varchar(200) NOT NULL,
  `phone_outside` varchar(200) NOT NULL,
  `address_local` varchar(250) NOT NULL,
  `address_outside` varchar(250) NOT NULL,
  `id_local` varchar(255) NOT NULL,
  `passport` varchar(200) NOT NULL,
  `id_outside` varchar(200) NOT NULL,
  `edu_rec` int(11) NOT NULL,
  `personal_entity` int(11) NOT NULL,
  `personal_jop` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `personal_record`
--

INSERT INTO `personal_record` (`personal_id`, `personal_name`, `personal_email`, `phone_local`, `phone_outside`, `address_local`, `address_outside`, `id_local`, `passport`, `id_outside`, `edu_rec`, `personal_entity`, `personal_jop`) VALUES
(1, 'محمود فتحي احمد', 'midofathy081@gmail.com', '01015354941', '295368752365', 'القليوبية - مصر', 'جده - السعودية', '29409281401275', '25As3356a', '526452AS', 4, 5, 'information technology');

-- --------------------------------------------------------

--
-- بنية الجدول `saving`
--

CREATE TABLE `saving` (
  `complain_id` int(11) NOT NULL,
  `complaint_name` varchar(255) NOT NULL,
  `complain_desc` varchar(500) NOT NULL,
  `complain_number` varchar(200) NOT NULL,
  `complain_country` varchar(250) NOT NULL,
  `complain_nat` varchar(250) NOT NULL,
  `Complain_position` varchar(250) NOT NULL,
  `complain_riplay` varchar(200) NOT NULL,
  `complain_status` varchar(250) NOT NULL,
  `attachment` varchar(250) NOT NULL,
  `complain_user` varchar(250) NOT NULL,
  `Efforts` varchar(250) NOT NULL,
  `complain_date` date NOT NULL,
  `complain_entity` int(11) NOT NULL,
  `complain_personal` int(11) NOT NULL,
  `complain_users` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `User_Id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `GroupId` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`User_Id`, `name`, `password`, `GroupId`) VALUES
(1, 'mohamedsamir', 'b77674bf1552dbd4b95692e127d65a53966a8b24', 1),
(2, 'mariamkamal', '254c42b384060a8e3b27099669491a889b8ac3c5', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complain_rec`
--
ALTER TABLE `complain_rec`
  ADD PRIMARY KEY (`complain_id`),
  ADD KEY `complain_entity` (`complain_entity`),
  ADD KEY `complain_perso` (`complain_personal`),
  ADD KEY `complain_user` (`complain_users`);

--
-- Indexes for table `entity_rec`
--
ALTER TABLE `entity_rec`
  ADD PRIMARY KEY (`entity_id`);

--
-- Indexes for table `personal_edu_rec`
--
ALTER TABLE `personal_edu_rec`
  ADD PRIMARY KEY (`edu_rec_id`);

--
-- Indexes for table `personal_record`
--
ALTER TABLE `personal_record`
  ADD PRIMARY KEY (`personal_id`),
  ADD KEY `personal_edu_rec` (`edu_rec`),
  ADD KEY `personal_entity` (`personal_entity`);

--
-- Indexes for table `saving`
--
ALTER TABLE `saving`
  ADD PRIMARY KEY (`complain_id`),
  ADD KEY `complain_ent` (`complain_entity`),
  ADD KEY `complain_per` (`complain_personal`),
  ADD KEY `complainUser` (`complain_users`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complain_rec`
--
ALTER TABLE `complain_rec`
  MODIFY `complain_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entity_rec`
--
ALTER TABLE `entity_rec`
  MODIFY `entity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_edu_rec`
--
ALTER TABLE `personal_edu_rec`
  MODIFY `edu_rec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_record`
--
ALTER TABLE `personal_record`
  MODIFY `personal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `complain_rec`
--
ALTER TABLE `complain_rec`
  ADD CONSTRAINT `complain_entity` FOREIGN KEY (`complain_entity`) REFERENCES `entity_rec` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complain_perso` FOREIGN KEY (`complain_personal`) REFERENCES `personal_record` (`personal_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complain_user` FOREIGN KEY (`complain_users`) REFERENCES `users` (`User_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `personal_record`
--
ALTER TABLE `personal_record`
  ADD CONSTRAINT `personal_edu_rec` FOREIGN KEY (`edu_rec`) REFERENCES `personal_edu_rec` (`edu_rec_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personal_entity` FOREIGN KEY (`personal_entity`) REFERENCES `entity_rec` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `saving`
--
ALTER TABLE `saving`
  ADD CONSTRAINT `complainUser` FOREIGN KEY (`complain_users`) REFERENCES `users` (`User_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complain_ent` FOREIGN KEY (`complain_entity`) REFERENCES `entity_rec` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complain_per` FOREIGN KEY (`complain_personal`) REFERENCES `personal_record` (`personal_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
