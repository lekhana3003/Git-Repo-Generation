-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2019 at 12:40 AM
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
-- Database: `gitrepo`
--

--
-- Dumping data for table `dir`
--

INSERT INTO `dir` (`dir_id`, `repo_id`, `name`, `parent_dir`) VALUES
(1, 1010, 'root', NULL),
(2, 1010, 'F2', 1),
(4, 1010, 'F4', 2);

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`f_id`, `name`, `parent_dir`, `repo_id`) VALUES
(3, 'F3', 1, 1010),
(5, 'F5', 2, 1010),
(6, 'file', 1, 1010);

--
-- Dumping data for table `repo`
--

INSERT INTO `repo` (`repo_id`, `name`, `description`, `pub`) VALUES
(1010, 'rewq', 'ewevew', 0),
(1011, 'cd', 'ecwewq', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
