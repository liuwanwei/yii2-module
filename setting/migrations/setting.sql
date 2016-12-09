-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2016-11-19 10:02:02
-- 服务器版本： 5.6.27
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jlzx`
--

-- --------------------------------------------------------

--
-- 表的结构 `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `key` varchar(64) NOT NULL,
  `value` text,
  `description` text,
  `weight` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `setting`
--

INSERT INTO `setting` (`id`, `name`, `key`, `value`, `description`, `weight`) VALUES
(1, '二星使者收益', 'kclass_sz2_earning', '43', '二星使者共3次收益机会', 0),
(2, '三星使者收益', 'kclass_sz3_earning', '31', '三星使者共9次收益机会', 1),
(3, '一星大使收益', 'kclass_ds1_earning', '48', '一星大使共27次收益机会', 2),
(4, '二星大使收益', 'kclass_ds2_earning', '38', '二星大使共81次收益机会', 3),
(5, '三星大使收益', 'kclass_ds3_earning', '28', '三星大使共243次收益机会', 4),
(6, '升级爱心大使要求', 'grade_ds_requirements', '1-3-9', '要求分为 1-3-9 和 1-3-3-9 型两种，请严格按照格式设置', -1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
