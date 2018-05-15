-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2017 at 04:12 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stunited`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(255) NOT NULL,
  `member_id` int(255) NOT NULL,
  `comment` varchar(20000) NOT NULL,
  `date_time` datetime NOT NULL,
  `no_of_likes` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `member_id`, `comment`, `date_time`, `no_of_likes`) VALUES
(1, 1, 2, 'non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2017-10-01 00:00:00', 10),
(2, 1, 5, '\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat ', '2017-10-02 00:00:00', 8),
(3, 1, 2, 'non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2017-10-02 00:00:00', 10),
(4, 1, 5, '\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat ', '2017-10-02 00:00:00', 8),
(21, 4, 5, 'hey', '2017-11-04 09:28:29', 0),
(22, 4, 5, 'wazzuppp', '2017-11-04 09:28:36', 0),
(23, 4, 5, 'yoo', '2017-11-04 09:31:25', 0),
(24, 4, 5, 'yoo', '2017-11-04 09:31:33', 0),
(25, 4, 5, 'tyu', '2017-11-04 09:32:51', 0),
(26, 4, 5, 'vfbg7n8j9k[0l', '2017-11-04 09:35:12', 0),
(27, 4, 5, 'tgnhmjop[', '2017-11-04 09:35:18', 0),
(28, 4, 5, 'tgnhmjop[', '2017-11-04 09:35:22', 0),
(29, 4, 5, '77bb689mj9k', '2017-11-04 09:42:07', 0),
(30, 3, 5, 'Hey', '2017-11-13 15:53:54', 0),
(31, 3, 5, 'wazzuppp', '2017-11-13 15:55:31', 0),
(32, 3, 5, 'yoo', '2017-11-13 15:58:47', 0),
(33, 3, 5, 'asdfghjkl', '2017-11-13 15:59:30', 0),
(34, 3, 5, 'kuyvib', '2017-11-13 16:05:13', 0),
(35, 7, 5, 'nothing much', '2017-11-17 12:46:34', 0),
(36, 2, 5, 'yooo', '2017-11-22 14:18:56', 0),
(37, 9, 5, 'dfghj', '2017-12-05 14:15:41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `events` varchar(20000) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `events`, `date`) VALUES
(1, 'consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '0000-00-00 00:00:00'),
(2, 'ecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '0000-00-00 00:00:00'),
(3, 'consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '0000-00-00 00:00:00'),
(4, 'ecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '0000-00-00 00:00:00'),
(5, 'there is an event tomorrow.', '2017-12-08 20:03:12');

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `forum_id` int(11) NOT NULL,
  `forum_topic` varchar(255) NOT NULL,
  `topic_time` datetime NOT NULL,
  `member_email` varchar(255) NOT NULL,
  `total_comments` int(255) NOT NULL,
  `likes` int(255) NOT NULL,
  `dislikes` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`forum_id`, `forum_topic`, `topic_time`, `member_email`, `total_comments`, `likes`, `dislikes`) VALUES
(1, 'dolor sit amet, consectetur adipisicing elit. Itaque atque facere vitae, a labore aperiam maxime ipsam tempora, natus, omnis sunt vero pariatur minus id aliquam quis tenetur eaque cupiditate.', '2017-05-20 00:00:00', 'arpit@gmail.com', 3, 0, 0),
(2, 'dolor sit amet, consectetur adipisicing elit. Itaque atque facere vitae, a labore aperiam maxime ipsam tempora, natus, omnis sunt vero pariatur minus id aliquam quis tenetur eaque cupiditate.', '2017-05-19 00:00:00', 'arpit@gmail.com', 7, 0, 0),
(3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias quos, veniam id eum debitis earum aliquam ullam vero similique omnis. Veritatis amet doloribus eveniet omnis. Doloribus aspernatur, sed. Asperiores, officia.', '2017-06-13 00:00:00', 'arpit@gmail.com', 20, 0, 0),
(4, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis voluptatum quisquam mollitia, sunt ipsa molestiae. Dignissimos quas cum, sint aspernatur blanditiis animi nulla corporis eaque quibusdam facilis rerum voluptate temporibus.', '2017-06-01 03:08:00', 'arpit@gmail.com', 90, 4, 1),
(5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, totam, expedita! Consequuntur ea distinctio, obcaecati adipisci blanditiis quaerat, dolorum maiores numquam, error aliquam ratione. Obcaecati consequuntur vero, et. Magnam, reiciendis.', '2017-06-07 00:00:00', 'arpit@gmail.com', 10, 0, 0),
(6, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, totam, expedita! Consequuntur ea distinctio, obcaecati adipisci blanditiis quaerat, dolorum maiores numquam, error aliquam ratione. Obcaecati consequuntur vero, et. Magnam, reiciendis.', '2017-06-06 00:00:00', 'arpit@gmail.com', 66, 0, 0),
(7, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus dolor alias necessitatibus. Quasi illo debitis vero quaerat, quae distinctio incidunt, veritatis tempora aspernatur ipsa necessitatibus harum odit fugit adipisci perferendis?', '2017-05-13 00:00:00', 'arpit@gmail.com', 77, 2, 0),
(8, 'abcdef', '2017-05-13 00:00:00', 'arpit@gmail.com', 75, 0, 0),
(9, 'abcdef', '2017-05-15 00:00:00', 'arpit@gmail.com', 1, 3, 0),
(10, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro dolore aspernatur cupiditate at quidem nostrum ratione, placeat, in ad, iste beatae commodi eius assumenda reprehenderit itaque perferendis nam nisi architecto.', '2017-06-25 06:42:20', 'arpit@gmail.com', 0, 0, 0),
(11, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro dolore aspernatur cupiditate at quidem nostrum ratione, placeat, in ad, iste beatae commodi eius assumenda reprehenderit itaque perferendis nam nisi architecto.', '2017-06-25 06:42:20', 'arpit@gmail.com', 0, 0, 0),
(12, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro dolore aspernatur cupiditate at quidem nostrum ratione, placeat, in ad, iste beatae commodi eius assumenda reprehenderit itaque perferendis nam nisi architecto.', '2017-06-25 06:42:20', 'arpit@gmail.com', 0, 0, 0),
(13, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro dolore aspernatur cupiditate at quidem nostrum ratione, placeat, in ad, iste beatae commodi eius assumenda reprehenderit itaque perferendis nam nisi architecto.', '2017-06-25 06:42:20', 'arpit@gmail.com', 0, 0, 0),
(14, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro dolore aspernatur cupiditate at quidem nostrum ratione, placeat, in ad, iste beatae commodi eius assumenda reprehenderit itaque perferendis nam nisi architecto.', '2017-06-25 06:42:20', 'arpit@gmail.com', 4, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `forum_comments`
--

CREATE TABLE `forum_comments` (
  `forum_comment_id` int(11) NOT NULL,
  `forum_id` int(255) NOT NULL,
  `member_email` varchar(255) NOT NULL,
  `comments` varchar(20000) NOT NULL,
  `no_of_likes` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum_comments`
--

INSERT INTO `forum_comments` (`forum_comment_id`, `forum_id`, `member_email`, `comments`, `no_of_likes`) VALUES
(1, 1, 'arpit@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco ', 0),
(2, 2, 'abcdef@gmail.com', 'Lorem ipsum dolor sit amet, consec', 0),
(3, 1, 'arpit@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim ven', 0),
(8, 2, 'abcdef@gmail.com', 'yup', 0),
(9, 2, 'abcdef@gmail.com', 'yoo', 0),
(10, 2, 'abcdef@gmail.com', 'yeah', 0),
(11, 2, 'abcdef@gmail.com', '....', 0),
(14, 1, 'arpit@gmail.com', 'gjhjgkhjk', 0),
(15, 5, 'abcdef@gmail.com', 'acdef', 0),
(16, 5, 'abcdef@gmail.com', 'yueiqywnci', 0),
(17, 5, 'abcdef@gmail.com', 'acdef', 0),
(18, 5, 'abcdef@gmail.com', 'yueiqywnci', 0),
(19, 5, 'abcdef@gmail.com', 'acdef', 0),
(20, 5, 'abcdef@gmail.com', 'yueiqywnci', 0),
(21, 5, 'abcdef@gmail.com', 'acdef', 0),
(22, 5, 'abcdef@gmail.com', 'yueiqywnci', 0),
(23, 5, 'abcdef@gmail.com', 'acdef', 0),
(24, 5, 'abcdef@gmail.com', 'yueiqywnci', 0),
(25, 3, 'arpit@gmail.com', 'acdef', 0),
(26, 3, 'arpit@gmail.com', 'yueiqywnci', 0),
(27, 3, 'arpit@gmail.com', 'acdef', 0),
(28, 3, 'arpit@gmail.com', 'yueiqywnci', 0),
(29, 3, 'arpit@gmail.com', 'acdef', 0),
(30, 3, 'arpit@gmail.com', 'yueiqywnci', 0),
(31, 3, 'arpit@gmail.com', 'acdef', 0),
(32, 3, 'arpit@gmail.com', 'yueiqywnci', 0),
(33, 3, 'arpit@gmail.com', 'acdef', 0),
(34, 3, 'arpit@gmail.com', 'yueiqywnci', 0),
(35, 3, 'arpit@gmail.com', 'acdef', 0),
(36, 3, 'arpit@gmail.com', 'yueiqywnci', 0),
(37, 3, 'arpit@gmail.com', 'acdef', 0),
(38, 3, 'arpit@gmail.com', 'yueiqywnci', 0),
(39, 3, 'arpit@gmail.com', 'acdef', 0),
(40, 3, 'arpit@gmail.com', 'yueiqywnci', 0),
(41, 3, 'arpit@gmail.com', 'acdef', 0),
(42, 3, 'arpit@gmail.com', 'yueiqywnci', 0),
(43, 3, 'arpit@gmail.com', 'acdef', 0),
(44, 3, 'arpit@gmail.com', 'yueiqywnci', 0),
(45, 4, 'arpit@gmail.com', 'acdef', 0),
(46, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(47, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(48, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(49, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(50, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(51, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(52, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(53, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(54, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(55, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(56, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(57, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(58, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(59, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(60, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(61, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(62, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(63, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(64, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(65, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(66, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(67, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(68, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(69, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(70, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(71, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(72, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(73, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(74, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(75, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(76, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(77, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(78, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(79, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(80, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(81, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(82, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(83, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(84, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(85, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(86, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(87, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(88, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(89, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(90, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(91, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(92, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(93, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(94, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(95, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(96, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(97, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(98, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(99, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(100, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(101, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(102, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(103, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(104, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(105, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(106, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(107, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(108, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(109, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(110, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(111, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(112, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(113, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(114, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(115, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(116, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(117, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(118, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(119, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(120, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(121, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(122, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(123, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(124, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(125, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(126, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(127, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(128, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(129, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(130, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(131, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(132, 4, 'arpit@gmail.com', 'acdef', 0),
(133, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(134, 4, 'arpit@gmail.com', 'yueiqywnci', 0),
(135, 9, 'arpit.nagpal08@outlook.com', 'hey', 0),
(136, 14, 'arpit@gmail.com', 'trcvybujm,', 0),
(137, 14, 'arpit@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo, veniam consequuntur quas adipisci sunt cum numquam nostrum possimus quibusdam fuga perspiciatis sapiente vitae corrupti blanditiis, repellat, delectus excepturi ex tempore!Lorem ipsum dolor s', 0),
(138, 14, 'arpit@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo, veniam consequuntur quas adipisci sunt cum numquam nostrum possimus quibusdam fuga perspiciatis sapiente vitae corrupti blanditiis, repellat, delectus excepturi ex tempore!Lorem ipsum dolor s', 0),
(139, 14, 'arpit@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo, veniam consequuntur quas adipisci sunt cum numquam nostrum possimus quibusdam fuga perspiciatis sapiente vitae corrupti blanditiis, repellat, delectus excepturi ex tempore!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo, veniam consequuntur quas adipisci sunt cum numquam nostrum possimus quibusdam fuga perspiciatis sapiente vitae corrupti blanditiis, repellat, delectus excepturi ex tempore!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo, veniam consequuntur quas adipisci sunt cum numquam nostrum possimus quibusdam fuga perspiciatis sapiente vitae corrupti blanditiis, repellat, delectus excepturi ex tempore!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo, veniam consequuntur quas adipisci sunt cum numquam nostrum possimus quibusdam fuga perspiciatis sapiente vitae corrupti blanditiis, repellat, delectus excepturi ex tempore!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo, veniam consequuntur quas adipisci sunt cum numquam nostrum possimus quibusdam fuga perspiciatis sapiente vitae corrupti blanditiis, repellat, delectus excepturi ex tempore!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo, veniam consequuntur quas adipisci sunt cum numquam nostrum possimus quibusdam fuga perspiciatis sapiente vitae corrupti blanditiis, repellat, delectus excepturi ex tempore!', 0);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `post_id` int(255) NOT NULL,
  `member_id` int(255) NOT NULL,
  `button` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `member_id`, `button`) VALUES
(7, 3, 5, 1),
(10, 4, 0, 1),
(12, 9, 0, 1),
(14, 2, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `sem` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `designation`, `name`, `email`, `password`, `image`, `sem`) VALUES
(2, 'teacher', 'abcdef', 'abcdef@gmail.com', 'abcdef', '744ce5be-7b26-40a1-adff-71a2c840b442.jpg', 0),
(5, 'student', 'Arpit Nagpal', 'arpit@gmail.com', 'abcdef', 'B612_20170524_131146.jpg', 7),
(6, 'student', 'John', 'john@gmail.com', 'abcdef', 'B612_20170524_131146.jpg', 3),
(7, 'student', 'Tommy', 'tommy@gmail.com', 'abcdef', 'B612_20170524_131146.jpg', 7);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `message` varchar(20000) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `member_id` varchar(2000) NOT NULL,
  `title` varchar(2000) NOT NULL,
  `content` varchar(20000) NOT NULL,
  `date` datetime NOT NULL,
  `no_of_comments` varchar(2000) NOT NULL,
  `no_of_likes` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `member_id`, `title`, `content`, `date`, `no_of_comments`, `no_of_likes`) VALUES
(1, '2', 'lorem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus ab architecto, ipsa veritatis, at iure possimus. Sequi earum a, nihil distinctio commodi, quae at laborum, aspernatur enim ullam fuga excepturi.', '2017-09-08 21:13:02', '10', '66'),
(2, '2', 'abcd', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus ab architecto, ipsa veritatis, at iure possimus. Sequi earum a, nihil distinctio commodi, quae at laborum, aspernatur enim ullam fuga excepturi.', '2017-09-07 21:13:21', '201', '24'),
(3, '5', 'qwerty', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus ab architecto, ipsa veritatis, at iure possimus. Sequi earum a, nihil distinctio commodi, quae at laborum, aspernatur enim ullam fuga excepturi.', '2017-09-08 21:13:59', '60', '106'),
(4, '5', 'asdfghjkl', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus ab architecto, ipsa veritatis, at iure possimus. Sequi earum a, nihil distinctio commodi, quae at laborum, aspernatur enim ullam fuga excepturi.', '2017-09-08 21:14:15', '581', '290'),
(7, '5', 'Hey', 'What Up!', '2017-11-17 12:45:37', '1', '0'),
(8, '5', 'Random', 'Test Post', '2017-11-17 15:06:00', '0', '0'),
(9, '5', 'hey', 'hey', '2017-11-17 15:40:14', '1', '1'),
(10, '5', 'hey', 'hey', '2017-11-17 15:41:42', '0', '0'),
(11, '5', 'whats', 'up', '2017-11-21 15:59:00', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `staff_id` int(255) NOT NULL,
  `sem` text NOT NULL,
  `subjects` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `staff_id`, `sem`, `subjects`) VALUES
(8, 2, '7', 'AI'),
(9, 2, '6', 'RDBMS'),
(10, 2, '3', 'DS'),
(12, 2, '1', 'FCPIT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
