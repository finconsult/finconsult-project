--
-- Структура на таблица `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `AccountId` int(5) NOT NULL AUTO_INCREMENT,
  `UserId` int(5) NOT NULL,
  `AccountName` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`AccountId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=44 ;

--
-- Схема на данните от таблица `account`
--

INSERT INTO `account` (`AccountId`, `UserId`, `AccountName`) VALUES
(1, 1, 'Cash'),
(2, 1, 'Account'),
(3, 1, 'Card'),
(4, 2, 'Cash'),
(5, 2, 'Account'),
(6, 2, 'Card'),
(7, 3, 'Cash'),
(8, 3, 'Account'),
(9, 3, 'Card'),
(10, 4, 'Cash'),
(11, 4, 'Account'),
(12, 4, 'Card'),
(13, 5, 'Cash'),
(14, 5, 'Account'),
(15, 5, 'Card'),
(16, 6, 'Cash'),
(17, 6, 'Account'),
(18, 6, 'Card'),
(19, 2, 'money'),
(20, 7, 'Cash'),
(21, 7, 'Account'),
(22, 7, 'Card'),
(23, 8, 'Cash'),
(24, 8, 'Account'),
(25, 8, 'Card'),
(26, 9, 'Cash'),
(27, 9, 'Account'),
(28, 9, 'Card'),
(29, 10, 'Cash'),
(30, 10, 'Account'),
(31, 10, 'Card'),
(32, 11, 'Cash'),
(33, 11, 'Account'),
(34, 11, 'Card'),
(35, 12, 'Cash'),
(36, 12, 'Account'),
(37, 12, 'Card'),
(38, 13, 'Cash'),
(39, 13, 'Account'),
(40, 13, 'Card'),
(41, 14, 'Cash'),
(42, 14, 'Account'),
(43, 14, 'Card');

--
-- Тригери `account`
--
DROP TRIGGER IF EXISTS `GenerateAccount`;
DELIMITER //
CREATE TRIGGER `GenerateAccount` AFTER INSERT ON `account`
 FOR EACH ROW INSERT INTO totals(UserId, AccountId, totals) values (new.UserId, new.AccountId, '0')
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура на таблица `assets`
--

CREATE TABLE IF NOT EXISTS `assets` (
  `AssetsId` int(5) NOT NULL AUTO_INCREMENT,
  `UserId` int(5) NOT NULL,
  `Title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Date` date NOT NULL,
  `CategoryId` int(5) NOT NULL,
  `AccountId` int(5) NOT NULL,
  `Amount` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Description` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`AssetsId`),
  KEY `fk_test` (`AccountId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Схема на данните от таблица `assets`
--

INSERT INTO `assets` (`AssetsId`, `UserId`, `Title`, `Date`, `CategoryId`, `AccountId`, `Amount`, `Description`) VALUES
(2, 1, 'Salary ', '2015-12-29', 1, 1, '1000', ''),
(4, 2, 'prihod', '2015-12-30', 15, 4, '1000', ''),
(5, 3, 'naem', '2015-12-31', 32, 7, '1000', '');

--
-- Тригери `assets`
--
DROP TRIGGER IF EXISTS `GenerateTotalAccount`;
DELIMITER //
CREATE TRIGGER `GenerateTotalAccount` AFTER INSERT ON `assets`
 FOR EACH ROW UPDATE totals SET totals.totals=totals.totals + new.amount where totals.userid=new.userid and totals.accountid=new.accountid
//
DELIMITER ;
DROP TRIGGER IF EXISTS `GenerateTotalUpdate`;
DELIMITER //
CREATE TRIGGER `GenerateTotalUpdate` AFTER UPDATE ON `assets`
 FOR EACH ROW UPDATE totals SET totals.totals=(select sum(Amount) from assets where assets.userid=new.userid and assets.accountid=new.accountid) where totals.userid=new.userid and totals.accountid=new.accountid
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура на таблица `bills`
--

CREATE TABLE IF NOT EXISTS `bills` (
  `BillsId` int(5) NOT NULL AUTO_INCREMENT,
  `UserId` int(5) NOT NULL,
  `Title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Dates` date NOT NULL,
  `CategoryId` int(5) NOT NULL,
  `AccountId` int(5) NOT NULL,
  `Amount` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Description` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`BillsId`),
  KEY `fk_testt` (`AccountId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Схема на данните от таблица `bills`
--

INSERT INTO `bills` (`BillsId`, `UserId`, `Title`, `Dates`, `CategoryId`, `AccountId`, `Amount`, `Description`) VALUES
(3, 1, 'internet ', '2015-12-29', 6, 1, '10', ''),
(5, 2, 'razhod', '2015-12-30', 19, 4, '300', ''),
(6, 3, 'koleda', '2015-12-31', 42, 7, '2000', '');

--
-- Тригери `bills`
--
DROP TRIGGER IF EXISTS `GenerateExpense`;
DELIMITER //
CREATE TRIGGER `GenerateExpense` AFTER INSERT ON `bills`
 FOR EACH ROW UPDATE totals SET totals.totals=totals.totals - new.amount where totals.userid=new.userid and totals.accountid=new.accountid
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура на таблица `budget`
--

CREATE TABLE IF NOT EXISTS `budget` (
  `BudgetId` int(5) NOT NULL AUTO_INCREMENT,
  `UserId` int(5) NOT NULL,
  `CategoryId` int(5) NOT NULL,
  `Dates` date NOT NULL,
  `Amount` int(10) NOT NULL,
  PRIMARY KEY (`BudgetId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура на таблица `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `CategoryId` int(5) NOT NULL AUTO_INCREMENT,
  `UserId` int(5) NOT NULL,
  `CategoryName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Level` int(2) NOT NULL,
  PRIMARY KEY (`CategoryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=197 ;

--
-- Схема на данните от таблица `category`
--

INSERT INTO `category` (`CategoryId`, `UserId`, `CategoryName`, `Level`) VALUES
(1, 1, 'Salary', 1),
(2, 1, 'Alowance', 1),
(3, 1, 'Petty Cash', 1),
(4, 1, 'Bonus', 1),
(5, 1, 'Food', 2),
(6, 1, 'Social Life', 2),
(7, 1, 'Self-Development', 2),
(8, 1, 'Transportation', 2),
(9, 1, 'Culture', 2),
(10, 1, 'Household', 2),
(11, 1, 'Apparel', 2),
(12, 1, 'Beauty', 2),
(13, 1, 'Health', 2),
(14, 1, 'Gift', 2),
(15, 2, 'Salary', 1),
(16, 2, 'Alowance', 1),
(17, 2, 'Petty Cash', 1),
(18, 2, 'Bonus', 1),
(19, 2, 'Food', 2),
(20, 2, 'Social Life', 2),
(21, 2, 'Self-Development', 2),
(22, 2, 'Transportation', 2),
(23, 2, 'Culture', 2),
(24, 2, 'Household', 2),
(25, 2, 'Apparel', 2),
(26, 2, 'Beauty', 2),
(27, 2, 'Health', 2),
(28, 2, 'Gift', 2),
(29, 3, 'Salary', 1),
(30, 3, 'Alowance', 1),
(31, 3, 'Petty Cash', 1),
(32, 3, 'Bonus', 1),
(33, 3, 'Food', 2),
(34, 3, 'Social Life', 2),
(35, 3, 'Self-Development', 2),
(36, 3, 'Transportation', 2),
(37, 3, 'Culture', 2),
(38, 3, 'Household', 2),
(39, 3, 'Apparel', 2),
(40, 3, 'Beauty', 2),
(41, 3, 'Health', 2),
(42, 3, 'Gift', 2),
(43, 4, 'Salary', 1),
(44, 4, 'Alowance', 1),
(45, 4, 'Petty Cash', 1),
(46, 4, 'Bonus', 1),
(47, 4, 'Food', 2),
(48, 4, 'Social Life', 2),
(49, 4, 'Self-Development', 2),
(50, 4, 'Transportation', 2),
(51, 4, 'Culture', 2),
(52, 4, 'Household', 2),
(53, 4, 'Apparel', 2),
(54, 4, 'Beauty', 2),
(55, 4, 'Health', 2),
(56, 4, 'Gift', 2),
(57, 5, 'Salary', 1),
(58, 5, 'Alowance', 1),
(59, 5, 'Petty Cash', 1),
(60, 5, 'Bonus', 1),
(61, 5, 'Food', 2),
(62, 5, 'Social Life', 2),
(63, 5, 'Self-Development', 2),
(64, 5, 'Transportation', 2),
(65, 5, 'Culture', 2),
(66, 5, 'Household', 2),
(67, 5, 'Apparel', 2),
(68, 5, 'Beauty', 2),
(69, 5, 'Health', 2),
(70, 5, 'Gift', 2),
(71, 6, 'Salary', 1),
(72, 6, 'Alowance', 1),
(73, 6, 'Petty Cash', 1),
(74, 6, 'Bonus', 1),
(75, 6, 'Food', 2),
(76, 6, 'Social Life', 2),
(77, 6, 'Self-Development', 2),
(78, 6, 'Transportation', 2),
(79, 6, 'Culture', 2),
(80, 6, 'Household', 2),
(81, 6, 'Apparel', 2),
(82, 6, 'Beauty', 2),
(83, 6, 'Health', 2),
(84, 6, 'Gift', 2),
(85, 7, '???????', 1),
(86, 7, '?????', 1),
(87, 7, '???????', 1),
(88, 7, '?????', 1),
(89, 7, '?????', 2),
(90, 7, '???????? ?????', 2),
(91, 7, '????????', 2),
(92, 7, '?????????', 2),
(93, 7, '???????', 2),
(94, 7, '???', 2),
(95, 7, '???????', 2),
(96, 7, '???????', 2),
(97, 7, '??????', 2),
(98, 7, '????????', 2),
(99, 8, '???????', 1),
(100, 8, '?????', 1),
(101, 8, '???????', 1),
(102, 8, '?????', 1),
(103, 8, '?????', 2),
(104, 8, '???????? ?????', 2),
(105, 8, '????????', 2),
(106, 8, '?????????', 2),
(107, 8, '???????', 2),
(108, 8, '???', 2),
(109, 8, '???????', 2),
(110, 8, '???????', 2),
(111, 8, '??????', 2),
(112, 8, '????????', 2),
(113, 9, '???????', 1),
(114, 9, '?????', 1),
(115, 9, '???????', 1),
(116, 9, '?????', 1),
(117, 9, '?????', 2),
(118, 9, '???????? ?????', 2),
(119, 9, '????????', 2),
(120, 9, '?????????', 2),
(121, 9, '???????', 2),
(122, 9, '???', 2),
(123, 9, '???????', 2),
(124, 9, '???????', 2),
(125, 9, '??????', 2),
(126, 9, '????????', 2),
(127, 10, '???????', 1),
(128, 10, '?????', 1),
(129, 10, '???????', 1),
(130, 10, '?????', 1),
(131, 10, '?????', 2),
(132, 10, '???????? ?????', 2),
(133, 10, '????????', 2),
(134, 10, '?????????', 2),
(135, 10, '???????', 2),
(136, 10, '???', 2),
(137, 10, '???????', 2),
(138, 10, '???????', 2),
(139, 10, '??????', 2),
(140, 10, '????????', 2),
(141, 11, '???????', 1),
(142, 11, '?????', 1),
(143, 11, '???????', 1),
(144, 11, '?????', 1),
(145, 11, 'sas', 2),
(146, 11, '???????? ?????', 2),
(147, 11, '????????', 2),
(148, 11, '?????????', 2),
(149, 11, '???????', 2),
(150, 11, '???????', 2),
(151, 11, '???????', 2),
(152, 11, '???????', 2),
(153, 11, '??????', 2),
(154, 11, '????????', 2),
(155, 12, '???????', 1),
(156, 12, '?????', 1),
(157, 12, '???????', 1),
(158, 12, '?????', 1),
(159, 12, '?????', 2),
(160, 12, '???????? ?????', 2),
(161, 12, '????????', 2),
(162, 12, '?????????', 2),
(163, 12, '???????', 2),
(164, 12, '???', 2),
(165, 12, '???????', 2),
(166, 12, '???????', 2),
(167, 12, '??????', 2),
(168, 12, '????????', 2),
(169, 13, 'Заплати', 1),
(170, 13, 'Други', 1),
(171, 13, 'Преводи', 1),
(172, 13, 'Бонус', 1),
(173, 13, 'Храна', 2),
(174, 13, 'Социален живот', 2),
(175, 13, 'Фрийланс', 2),
(176, 13, 'Транспорт', 2),
(177, 13, 'Култура', 2),
(178, 13, 'Дом', 2),
(179, 13, 'Облекло', 2),
(180, 13, 'Красота', 2),
(181, 13, 'Здраве', 2),
(182, 13, 'Подаръци', 2),
(183, 14, 'Заплати', 1),
(184, 14, 'Други', 1),
(185, 14, 'Преводи', 1),
(186, 14, 'Бонус', 1),
(187, 14, 'Храна', 2),
(188, 14, 'Социален живот', 2),
(189, 14, 'Фрийланс', 2),
(190, 14, 'Транспорт', 2),
(191, 14, 'Култура', 2),
(192, 14, 'Дом', 2),
(193, 14, 'Облекло', 2),
(194, 14, 'Красота', 2),
(195, 14, 'Здраве', 2),
(196, 14, 'Подаръци', 2);

-- --------------------------------------------------------

--
-- Структура на таблица `totals`
--

CREATE TABLE IF NOT EXISTS `totals` (
  `TotalsId` int(5) NOT NULL AUTO_INCREMENT,
  `UserId` int(5) NOT NULL,
  `AccountId` int(5) NOT NULL,
  `Totals` int(10) NOT NULL,
  PRIMARY KEY (`TotalsId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=44 ;

--
-- Схема на данните от таблица `totals`
--

INSERT INTO `totals` (`TotalsId`, `UserId`, `AccountId`, `Totals`) VALUES
(1, 1, 1, 1000),
(2, 1, 2, 0),
(3, 1, 3, 0),
(4, 2, 4, 700),
(5, 2, 5, 0),
(6, 2, 6, 0),
(7, 3, 7, -1000),
(8, 3, 8, 0),
(9, 3, 9, 0),
(10, 4, 10, 0),
(11, 4, 11, 0),
(12, 4, 12, 0),
(13, 5, 13, 0),
(14, 5, 14, 0),
(15, 5, 15, 0),
(16, 6, 16, 0),
(17, 6, 17, 0),
(18, 6, 18, 0),
(19, 2, 19, 0),
(20, 7, 20, 0),
(21, 7, 21, 0),
(22, 7, 22, 0),
(23, 8, 23, 0),
(24, 8, 24, 0),
(25, 8, 25, 0),
(26, 9, 26, 0),
(27, 9, 27, 0),
(28, 9, 28, 0),
(29, 10, 29, 0),
(30, 10, 30, 0),
(31, 10, 31, 0),
(32, 11, 32, 0),
(33, 11, 33, 0),
(34, 11, 34, 0),
(35, 12, 35, 0),
(36, 12, 36, 0),
(37, 12, 37, 0),
(38, 13, 38, 0),
(39, 13, 39, 0),
(40, 13, 40, 0),
(41, 14, 41, 0),
(42, 14, 42, 0),
(43, 14, 43, 0);

-- --------------------------------------------------------

--
-- Структура на таблица `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UserId` int(5) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(255) CHARACTER SET latin1 NOT NULL,
  `LastName` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Currency` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Схема на данните от таблица `user`
--

INSERT INTO `user` (`UserId`, `FirstName`, `LastName`, `Email`, `Password`, `Currency`) VALUES
(1, 'Nikolay', 'Chochev', 'demo@mail.bg', 'Jh2AWIzvEBUxr5vVKNnJCZPyEgScxNkFiys+fOtfLZ0=', '$'),
(2, 'Aleksa', 'Tachev', 'aleks.tachev@gmail.com', 'pe4pVOPb0qDjXYfpU8WJHFc1AlZPp+0KhNgp3vtARCc=', '€'),
(3, 'Victoria', 'Raicheva', 'viki.r.r@abv.bg', 'EiHrVGaLAFVyUdisN+FrdAKzSn2RJ5RD1i1LYpbLIeA=', '$'),
(4, 'Aleksa', 'Tachev', 'w1rys@abv.bg', 'pe4pVOPb0qDjXYfpU8WJHFc1AlZPp+0KhNgp3vtARCc=', '€'),
(5, 'Peter', 'Petrov', 'Whey1977@armyspy.com', 'P7xSnVxlXMNtw+5X8mKNAQXFgQfq8ngd8VYH5uIGgiA=', 'лв'),
(6, 'Karolina', 'Stoycheva', 'karolinastt@abv.bg', 'zKiSO73H+3vwTgcQqSQlDs2ZcqiamlVtHfvImnvs91g=', 'лв'),
(7, '???????', '???????', 'studi1966@abv.bg', 'Hk0uh+Cat8J6c+sWr6pgX3FPVsDwCF3OoCt1WHyVRYk=', 'лв'),
(8, 'demo', 'demo2', 'demo2@mail.bg', '0lHA9OTB3bpd6QUKkSFwlGIUhJw0xzvXrHgg67XL7UA=', 'лв'),
(9, 'Radoslav', 'Raichev', 'rado.s.r@abv.bg', 'EiHrVGaLAFVyUdisN+FrdAKzSn2RJ5RD1i1LYpbLIeA=', 'лв'),
(10, 'dsad', 'dsad', 'a@a.bg', '0lHA9OTB3bpd6QUKkSFwlGIUhJw0xzvXrHgg67XL7UA=', 'лв'),
(11, 'dsa', 'dsad', 'a@1.bg', '0lHA9OTB3bpd6QUKkSFwlGIUhJw0xzvXrHgg67XL7UA=', 'лв'),
(12, 'dsad', 'dsdsa', '2@a.bg', '0lHA9OTB3bpd6QUKkSFwlGIUhJw0xzvXrHgg67XL7UA=', 'лв'),
(13, 'dsa', 'dsad', '2@1.bg', '0lHA9OTB3bpd6QUKkSFwlGIUhJw0xzvXrHgg67XL7UA=', 'лв'),
(14, 'Viki', 'Raicheva', 'a22@abv.bg', 'EiHrVGaLAFVyUdisN+FrdAKzSn2RJ5RD1i1LYpbLIeA=', 'лв');

--
-- Тригери `user`
--
DROP TRIGGER IF EXISTS `GenerateDefaultAccount`;
DELIMITER //
CREATE TRIGGER `GenerateDefaultAccount` AFTER INSERT ON `user`
 FOR EACH ROW INSERT INTO account (UserId, AccountName) VALUES (new.UserId, 'Cash'), (new.UserId, 'Account'), (new.UserId, 'Card')
//
DELIMITER ;

--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `assets`
--
ALTER TABLE `assets`
  ADD CONSTRAINT `fk_test` FOREIGN KEY (`AccountId`) REFERENCES `account` (`AccountId`) ON DELETE CASCADE;

--
-- Ограничения за таблица `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `fk_testt` FOREIGN KEY (`AccountId`) REFERENCES `account` (`AccountId`) ON DELETE CASCADE;
