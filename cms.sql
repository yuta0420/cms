-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:8080
-- Generation Time: 2016 年 4 朁E28 日 14:35
-- サーバのバージョン： 10.1.10-MariaDB
-- PHP Version: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `main`
--

CREATE TABLE `main` (
  `id_que` int(11) NOT NULL,
  `title_que` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_que_sub` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `open_flag` tinyint(1) NOT NULL,
  `num_que` int(11) NOT NULL,
  `score_ave` int(11) NOT NULL,
  `id_teach` int(11) NOT NULL,
  `time_made` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `main`
--

INSERT INTO `main` (`id_que`, `title_que`, `title_que_sub`, `open_flag`, `num_que`, `score_ave`, `id_teach`, `time_made`) VALUES
(92, 'タイトル', '', 0, 5, 0, 0, '2016-04-27 19:16:50'),
(93, 'タイトル', 'サブタイトル', 0, 5, 0, 0, '2016-04-27 19:17:39');

-- --------------------------------------------------------

--
-- テーブルの構造 `question`
--

CREATE TABLE `question` (
  `id_sub` int(11) NOT NULL,
  `id_que` int(11) NOT NULL,
  `question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `answer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_teach` int(11) NOT NULL,
  `time_made` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `question`
--

INSERT INTO `question` (`id_sub`, `id_que`, `question`, `answer`, `id_teach`, `time_made`) VALUES
(64, 0, '1', '2', 0, '2016-04-27 19:02:28'),
(65, 0, '3', '4', 0, '2016-04-27 19:02:28'),
(66, 0, '5', '6', 0, '2016-04-27 19:02:28'),
(67, 0, '1', '2', 0, '2016-04-27 19:07:26'),
(68, 0, '3', '4', 0, '2016-04-27 19:07:26'),
(69, 0, '5', '6', 0, '2016-04-27 19:07:26'),
(70, 93, '1', '2', 0, '2016-04-27 19:17:39'),
(71, 93, '3', '4', 0, '2016-04-27 19:17:39'),
(72, 93, '5', '6', 0, '2016-04-27 19:17:39'),
(73, 93, '7', '8', 0, '2016-04-27 19:17:39'),
(74, 93, '9', '10', 0, '2016-04-27 19:17:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `main`
--
ALTER TABLE `main`
  ADD PRIMARY KEY (`id_que`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id_sub`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `main`
--
ALTER TABLE `main`
  MODIFY `id_que` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
