-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2020-06-10 17:27:00
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
  `id` int(11) NOT NULL,
  `question` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `correct_answer` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `wrong_answer1` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `wrong_answer2` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `test`
--

INSERT INTO `test` (`id`, `question`, `correct_answer`, `wrong_answer1`, `wrong_answer2`) VALUES
(7, 'where is the capital of China?', 'Beijing', 'test', 'test'),
(8, 'where is the capital of the UK?', 'London', 'Edinburgh', 'Aberdeen'),
(9, 'where is the capital of Japan?', 'Tokyo', 'Kyoto', 'Fukuoka'),
(17, '小島さんのタイプは？', '釘宮さん', '小川', 'すがやん'),
(28, 'test1', '4', '5', '6');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
