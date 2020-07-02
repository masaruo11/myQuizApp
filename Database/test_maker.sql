-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2020-06-18 15:53:15
-- サーバのバージョン： 10.4.11-MariaDB
-- PHP のバージョン: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `test_maker`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `test`
--

CREATE TABLE `test` (
  `q_id` int(11) NOT NULL,
  `question` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `correct_answer` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `wrong_answer1` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `wrong_answer2` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `test_u_id` int(12) NOT NULL,
  `test_group_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `test`
--

INSERT INTO `test` (`q_id`, `question`, `correct_answer`, `wrong_answer1`, `wrong_answer2`, `test_u_id`, `test_group_id`) VALUES
(31, '中国の首都は？', '北京', '222', 'hangzhou', 0, 0),
(33, 'オーストラリアの首都は？', 'キャンベラ', '111', 'パース', 0, 0),
(50, '', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `user`
--

CREATE TABLE `user` (
  `id` int(12) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_password` varchar(12) NOT NULL,
  `life_flag` tinyint(1) NOT NULL DEFAULT 0,
  `indate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `user`
--

INSERT INTO `user` (`id`, `user_name`, `user_email`, `user_password`, `life_flag`, `indate`) VALUES
(7, 'masaruogawa', 'masaruo@gmail.com', '1111', 0, '0000-00-00'),
(8, 'masaru', 'masaruo@hotmail.com', '1111', 0, '0000-00-00'),
(9, 'panda', 'panda@panda', '1111', 0, '0000-00-00');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`q_id`);

--
-- テーブルのインデックス `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `test`
--
ALTER TABLE `test`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- テーブルのAUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
