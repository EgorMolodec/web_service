-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Май 27 2019 г., 01:00
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `servis`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tblcourse`
--

CREATE TABLE IF NOT EXISTS `tblcourse` (
  `intCourseID` int(11) NOT NULL AUTO_INCREMENT,
  `intTeacherID` int(11) NOT NULL,
  `txtCourseName` varchar(255) NOT NULL,
  `txtCourseLatName` varchar(255) NOT NULL,
  `txtCourseInfo` text NOT NULL,
  `dateCourseYear` year(4) NOT NULL,
  PRIMARY KEY (`intCourseID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `tblcourse`
--

INSERT INTO `tblcourse` (`intCourseID`, `intTeacherID`, `txtCourseName`, `txtCourseLatName`, `txtCourseInfo`, `dateCourseYear`) VALUES
(6, 0, 'Асу ТП', 'Asu_TP', 'Ничего...', 0000);

-- --------------------------------------------------------

--
-- Структура таблицы `tblreport`
--

CREATE TABLE IF NOT EXISTS `tblreport` (
  `intReportID` int(11) NOT NULL AUTO_INCREMENT,
  `courseName` varchar(258) NOT NULL,
  `taskName` varchar(258) NOT NULL,
  `student` varchar(258) NOT NULL,
  `intCourseID` int(11) NOT NULL,
  `intTaskID` int(11) NOT NULL,
  `txtWorkPath` text NOT NULL,
  `intUserID` int(11) NOT NULL,
  `txtResult` varchar(258) NOT NULL,
  `intDate` varchar(11) NOT NULL,
  `txtWorkName` varchar(258) NOT NULL,
  PRIMARY KEY (`intReportID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbltask`
--

CREATE TABLE IF NOT EXISTS `tbltask` (
  `intTaskID` int(11) NOT NULL AUTO_INCREMENT,
  `intCourseID` int(11) NOT NULL,
  `txtTaskName` varchar(255) NOT NULL,
  `txtTaskLatName` varchar(255) NOT NULL,
  `txtTaskExample` varchar(11) NOT NULL,
  `txtTaskInfo` text NOT NULL,
  PRIMARY KEY (`intTaskID`),
  KEY `intCourseID` (`intCourseID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tbltask`
--

INSERT INTO `tbltask` (`intTaskID`, `intCourseID`, `txtTaskName`, `txtTaskLatName`, `txtTaskExample`, `txtTaskInfo`) VALUES
(3, 6, 'кке', 'kke', 'index.php', 'кеп');

-- --------------------------------------------------------

--
-- Структура таблицы `tbluser`
--

CREATE TABLE IF NOT EXISTS `tbluser` (
  `intUserID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `boolRoot` tinyint(1) NOT NULL,
  `password` int(11) NOT NULL,
  PRIMARY KEY (`intUserID`),
  UNIQUE KEY `name` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tbluser`
--

INSERT INTO `tbluser` (`intUserID`, `email`, `boolRoot`, `password`) VALUES
(2, 'ignatev', 0, 1234),
(3, 'voronov', 1, 1234);

-- --------------------------------------------------------

--
-- Структура таблицы `tblwork`
--

CREATE TABLE IF NOT EXISTS `tblwork` (
  `intWorkID` int(11) NOT NULL AUTO_INCREMENT,
  `intCourseID` int(11) NOT NULL,
  `intTaskID` int(11) NOT NULL,
  `intUserID` int(11) NOT NULL,
  `intDate` int(11) NOT NULL,
  `txtFile` text NOT NULL,
  PRIMARY KEY (`intWorkID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tbltask`
--
ALTER TABLE `tbltask`
  ADD CONSTRAINT `tbltask_ibfk_1` FOREIGN KEY (`intCourseID`) REFERENCES `tblcourse` (`intCourseID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
