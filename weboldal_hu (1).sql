-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Hoszt: localhost
-- Létrehozás ideje: 2014. Jún 19. 15:48
-- Szerver verzió: 5.6.10
-- PHP verzió: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Adatbázis: `weboldal_hu`
--
CREATE DATABASE IF NOT EXISTS `weboldal_hu` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `weboldal_hu`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(10) unsigned NOT NULL,
  `CountryCode` varchar(2) NOT NULL,
  `City` varchar(100) NOT NULL,
  `Zip` varchar(20) NOT NULL,
  `Street` varchar(100) NOT NULL,
  `addressType` enum('delivery','billing') NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- A tábla adatainak kiíratása `address`
--

INSERT INTO `address` (`ID`, `userID`, `CountryCode`, `City`, `Zip`, `Street`, `addressType`) VALUES
(1, 1, 'HU', 'Budapest', '1062', 'Andrássy 99', 'delivery'),
(2, 1, 'HU', 'Sopron', '9011', 'Lővérek 2', 'billing');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `indexes`
--

CREATE TABLE IF NOT EXISTS `indexes` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `URL` varchar(100) NOT NULL,
  `tableName` varchar(30) NOT NULL,
  `tableID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- A tábla adatainak kiíratása `indexes`
--

INSERT INTO `indexes` (`ID`, `URL`, `tableName`, `tableID`) VALUES
(1, 'cart', 'pages', 2),
(2, 'delivery-address', 'pages', 3),
(3, 'index', 'pages', 1),
(4, 'billing-address', 'pages', 4),
(5, 'payment-method', 'pages', 5),
(6, 'order', 'pages', 6),
(7, 'products', 'pages', 7),
(8, 'userOrders', 'pages', 8);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(10) unsigned NOT NULL,
  `deliveryAddress` tinyint(3) unsigned NOT NULL,
  `billingAddress` tinyint(3) unsigned NOT NULL,
  `paymentMethod` tinyint(3) unsigned NOT NULL,
  `cart` text NOT NULL,
  `orderDate` varchar(11) NOT NULL,
  `cartDate` varchar(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- A tábla adatainak kiíratása `orders`
--

INSERT INTO `orders` (`ID`, `userID`, `deliveryAddress`, `billingAddress`, `paymentMethod`, `cart`, `orderDate`, `cartDate`) VALUES
(1, 1, 1, 2, 1, 'YToxOntpOjE7Tzo0OiJpdGVtIjo2OntzOjg6InF1YW50aXR5IjtzOjE6IjEiO3M6MjoiSUQiO3M6MToiMSI7czo4OiJpdGVtTmFtZSI7czo5OiJUZXJtw6lrIDEiO3M6OToiaXRlbVByaWNlIjtzOjQ6IjI1MDAiO3M6OToiaXRlbVRvdGFsIjtpOjI1MDA7czo3OiJpdGVtVVJMIjtzOjg6InRlcm1lay0xIjt9fQ==', '1401990583', '1401984101'),
(2, 1, 1, 2, 1, 'YToxOntpOjE7Tzo0OiJpdGVtIjo2OntzOjg6InF1YW50aXR5IjtzOjE6IjEiO3M6MjoiSUQiO3M6MToiMSI7czo4OiJpdGVtTmFtZSI7czo5OiJUZXJtw6lrIDEiO3M6OToiaXRlbVByaWNlIjtzOjQ6IjI1MDAiO3M6OToiaXRlbVRvdGFsIjtpOjI1MDA7czo3OiJpdGVtVVJMIjtzOjg6InRlcm1lay0xIjt9fQ==', '1401990704', '1401984101'),
(3, 1, 1, 2, 1, 'YToxOntpOjE7Tzo0OiJpdGVtIjo2OntzOjg6InF1YW50aXR5IjtzOjE6IjEiO3M6MjoiSUQiO3M6MToiMSI7czo4OiJpdGVtTmFtZSI7czo5OiJUZXJtw6lrIDEiO3M6OToiaXRlbVByaWNlIjtzOjQ6IjI1MDAiO3M6OToiaXRlbVRvdGFsIjtpOjI1MDA7czo3OiJpdGVtVVJMIjtzOjg6InRlcm1lay0xIjt9fQ==', '1401991407', '1401990819'),
(4, 1, 1, 2, 1, 'YToxOntpOjE7Tzo0OiJpdGVtIjo2OntzOjg6InF1YW50aXR5IjtzOjE6IjEiO3M6MjoiSUQiO3M6MToiMSI7czo4OiJpdGVtTmFtZSI7czo5OiJUZXJtw6lrIDEiO3M6OToiaXRlbVByaWNlIjtzOjQ6IjI1MDAiO3M6OToiaXRlbVRvdGFsIjtpOjI1MDA7czo3OiJpdGVtVVJMIjtzOjg6InRlcm1lay0xIjt9fQ==', '1402587353', '1402586748'),
(5, 1, 1, 2, 1, 'YToxOntpOjE7Tzo0OiJpdGVtIjo2OntzOjg6InF1YW50aXR5IjtzOjE6IjEiO3M6MjoiSUQiO3M6MToiMSI7czo4OiJpdGVtTmFtZSI7czo5OiJUZXJtw6lrIDEiO3M6OToiaXRlbVByaWNlIjtzOjQ6IjI1MDAiO3M6OToiaXRlbVRvdGFsIjtpOjI1MDA7czo3OiJpdGVtVVJMIjtzOjg6InRlcm1lay0xIjt9fQ==', '1402587536', '1402587353'),
(6, 1, 1, 2, 1, 'YToxOntpOjE7Tzo0OiJpdGVtIjo2OntzOjg6InF1YW50aXR5IjtzOjE6IjEiO3M6MjoiSUQiO3M6MToiMSI7czo4OiJpdGVtTmFtZSI7czo5OiJUZXJtw6lrIDEiO3M6OToiaXRlbVByaWNlIjtzOjQ6IjI1MDAiO3M6OToiaXRlbVRvdGFsIjtpOjI1MDA7czo3OiJpdGVtVVJMIjtzOjg6InRlcm1lay0xIjt9fQ==', '1402588041', '1402587536'),
(7, 1, 1, 2, 1, 'YToxOntpOjE7Tzo0OiJpdGVtIjo2OntzOjg6InF1YW50aXR5IjtzOjE6IjEiO3M6MjoiSUQiO3M6MToiMSI7czo4OiJpdGVtTmFtZSI7czo5OiJUZXJtw6lrIDEiO3M6OToiaXRlbVByaWNlIjtzOjQ6IjI1MDAiO3M6OToiaXRlbVRvdGFsIjtpOjI1MDA7czo3OiJpdGVtVVJMIjtzOjg6InRlcm1lay0xIjt9fQ==', '1402588227', '1402588041'),
(8, 1, 1, 2, 1, 'YTozOntpOjE7Tzo0OiJpdGVtIjo2OntzOjg6InF1YW50aXR5IjtpOjQ7czoyOiJJRCI7czoxOiIxIjtzOjg6Iml0ZW1OYW1lIjtzOjk6IlRlcm3DqWsgMSI7czo5OiJpdGVtUHJpY2UiO3M6NDoiMjUwMCI7czo5OiJpdGVtVG90YWwiO2k6MTAwMDA7czo3OiJpdGVtVVJMIjtzOjg6InRlcm1lay0xIjt9aToyO086NDoiaXRlbSI6Njp7czo4OiJxdWFudGl0eSI7aTozO3M6MjoiSUQiO3M6MToiMiI7czo4OiJpdGVtTmFtZSI7czo5OiJUZXJtw6lrIDIiO3M6OToiaXRlbVByaWNlIjtzOjQ6IjM1MDAiO3M6OToiaXRlbVRvdGFsIjtpOjEwNTAwO3M6NzoiaXRlbVVSTCI7czo4OiJ0ZXJtZWstMiI7fWk6MztPOjQ6Iml0ZW0iOjY6e3M6ODoicXVhbnRpdHkiO3M6MToiMiI7czoyOiJJRCI7czoxOiIzIjtzOjg6Iml0ZW1OYW1lIjtzOjk6IlRlcm3DqWsgMyI7czo5OiJpdGVtUHJpY2UiO3M6MzoiMTAwIjtzOjk6Iml0ZW1Ub3RhbCI7aToyMDA7czo3OiJpdGVtVVJMIjtzOjg6InRlcm1lay0zIjt9fQ==', '1402591675', '1402588227'),
(9, 1, 1, 2, 1, 'YTozOntpOjE7Tzo0OiJpdGVtIjo2OntzOjg6InF1YW50aXR5IjtpOjQ7czoyOiJJRCI7czoxOiIxIjtzOjg6Iml0ZW1OYW1lIjtzOjk6IlRlcm3DqWsgMSI7czo5OiJpdGVtUHJpY2UiO3M6NDoiMjUwMCI7czo5OiJpdGVtVG90YWwiO2k6MTAwMDA7czo3OiJpdGVtVVJMIjtzOjg6InRlcm1lay0xIjt9aToyO086NDoiaXRlbSI6Njp7czo4OiJxdWFudGl0eSI7aTozO3M6MjoiSUQiO3M6MToiMiI7czo4OiJpdGVtTmFtZSI7czo5OiJUZXJtw6lrIDIiO3M6OToiaXRlbVByaWNlIjtzOjQ6IjM1MDAiO3M6OToiaXRlbVRvdGFsIjtpOjEwNTAwO3M6NzoiaXRlbVVSTCI7czo4OiJ0ZXJtZWstMiI7fWk6MztPOjQ6Iml0ZW0iOjY6e3M6ODoicXVhbnRpdHkiO3M6MToiMiI7czoyOiJJRCI7czoxOiIzIjtzOjg6Iml0ZW1OYW1lIjtzOjk6IlRlcm3DqWsgMyI7czo5OiJpdGVtUHJpY2UiO3M6MzoiMTAwIjtzOjk6Iml0ZW1Ub3RhbCI7aToyMDA7czo3OiJpdGVtVVJMIjtzOjg6InRlcm1lay0zIjt9fQ==', '1402591742', '1402588227'),
(10, 1, 1, 2, 1, 'YTozOntpOjE7Tzo0OiJpdGVtIjo2OntzOjg6InF1YW50aXR5IjtpOjQ7czoyOiJJRCI7czoxOiIxIjtzOjg6Iml0ZW1OYW1lIjtzOjk6IlRlcm3DqWsgMSI7czo5OiJpdGVtUHJpY2UiO3M6NDoiMjUwMCI7czo5OiJpdGVtVG90YWwiO2k6MTAwMDA7czo3OiJpdGVtVVJMIjtzOjg6InRlcm1lay0xIjt9aToyO086NDoiaXRlbSI6Njp7czo4OiJxdWFudGl0eSI7aTozO3M6MjoiSUQiO3M6MToiMiI7czo4OiJpdGVtTmFtZSI7czo5OiJUZXJtw6lrIDIiO3M6OToiaXRlbVByaWNlIjtzOjQ6IjM1MDAiO3M6OToiaXRlbVRvdGFsIjtpOjEwNTAwO3M6NzoiaXRlbVVSTCI7czo4OiJ0ZXJtZWstMiI7fWk6MztPOjQ6Iml0ZW0iOjY6e3M6ODoicXVhbnRpdHkiO3M6MToiMiI7czoyOiJJRCI7czoxOiIzIjtzOjg6Iml0ZW1OYW1lIjtzOjk6IlRlcm3DqWsgMyI7czo5OiJpdGVtUHJpY2UiO3M6MzoiMTAwIjtzOjk6Iml0ZW1Ub3RhbCI7aToyMDA7czo3OiJpdGVtVVJMIjtzOjg6InRlcm1lay0zIjt9fQ==', '1402591842', '1402588227'),
(11, 1, 1, 2, 1, 'YToxOntpOjE7Tzo0OiJpdGVtIjo2OntzOjg6InF1YW50aXR5IjtzOjE6IjEiO3M6MjoiSUQiO3M6MToiMSI7czo4OiJpdGVtTmFtZSI7czo5OiJUZXJtw6lrIDEiO3M6OToiaXRlbVByaWNlIjtzOjQ6IjI1MDAiO3M6OToiaXRlbVRvdGFsIjtpOjI1MDA7czo3OiJpdGVtVVJMIjtzOjg6InRlcm1lay0xIjt9fQ==', '1402592054', '1402591845'),
(12, 1, 1, 2, 1, 'YTozOntpOjE7Tzo0OiJpdGVtIjo2OntzOjg6InF1YW50aXR5IjtzOjE6IjEiO3M6MjoiSUQiO3M6MToiMSI7czo4OiJpdGVtTmFtZSI7czo5OiJUZXJtw6lrIDEiO3M6OToiaXRlbVByaWNlIjtzOjQ6IjI1MDAiO3M6OToiaXRlbVRvdGFsIjtpOjI1MDA7czo3OiJpdGVtVVJMIjtzOjg6InRlcm1lay0xIjt9aToyO086NDoiaXRlbSI6Njp7czo4OiJxdWFudGl0eSI7czoxOiIxIjtzOjI6IklEIjtzOjE6IjIiO3M6ODoiaXRlbU5hbWUiO3M6OToiVGVybcOpayAyIjtzOjk6Iml0ZW1QcmljZSI7czo0OiIzNTAwIjtzOjk6Iml0ZW1Ub3RhbCI7aTozNTAwO3M6NzoiaXRlbVVSTCI7czo4OiJ0ZXJtZWstMiI7fWk6MztPOjQ6Iml0ZW0iOjY6e3M6ODoicXVhbnRpdHkiO3M6MToiMSI7czoyOiJJRCI7czoxOiIzIjtzOjg6Iml0ZW1OYW1lIjtzOjk6IlRlcm3DqWsgMyI7czo5OiJpdGVtUHJpY2UiO3M6MzoiMTAwIjtzOjk6Iml0ZW1Ub3RhbCI7aToxMDA7czo3OiJpdGVtVVJMIjtzOjg6InRlcm1lay0zIjt9fQ==', '1402592411', '1402592056'),
(13, 1, 1, 2, 1, 'YToyOntpOjE7Tzo0OiJpdGVtIjo2OntzOjg6InF1YW50aXR5IjtzOjE6IjIiO3M6MjoiSUQiO3M6MToiMSI7czo4OiJpdGVtTmFtZSI7czo5OiJUZXJtw6lrIDEiO3M6OToiaXRlbVByaWNlIjtzOjQ6IjI1MDAiO3M6OToiaXRlbVRvdGFsIjtpOjUwMDA7czo3OiJpdGVtVVJMIjtzOjg6InRlcm1lay0xIjt9aTozO086NDoiaXRlbSI6Njp7czo4OiJxdWFudGl0eSI7czoxOiI1IjtzOjI6IklEIjtzOjE6IjMiO3M6ODoiaXRlbU5hbWUiO3M6OToiVGVybcOpayAzIjtzOjk6Iml0ZW1QcmljZSI7czozOiIxMDAiO3M6OToiaXRlbVRvdGFsIjtpOjUwMDtzOjc6Iml0ZW1VUkwiO3M6ODoidGVybWVrLTMiO319', '1402593026', '1402592413'),
(14, 1, 1, 2, 1, 'YToxOntpOjE7Tzo0OiJpdGVtIjo2OntzOjg6InF1YW50aXR5IjtzOjE6IjEiO3M6MjoiSUQiO3M6MToiMSI7czo4OiJpdGVtTmFtZSI7czo5OiJUZXJtw6lrIDEiO3M6OToiaXRlbVByaWNlIjtzOjQ6IjI1MDAiO3M6OToiaXRlbVRvdGFsIjtpOjI1MDA7czo3OiJpdGVtVVJMIjtzOjg6InRlcm1lay0xIjt9fQ==', '1402593737', '1402593028'),
(15, 1, 1, 2, 1, 'YToxOntpOjE7Tzo0OiJpdGVtIjo2OntzOjg6InF1YW50aXR5IjtzOjE6IjEiO3M6MjoiSUQiO3M6MToiMSI7czo4OiJpdGVtTmFtZSI7czo5OiJUZXJtw6lrIDEiO3M6OToiaXRlbVByaWNlIjtzOjQ6IjI1MDAiO3M6OToiaXRlbVRvdGFsIjtpOjI1MDA7czo3OiJpdGVtVVJMIjtzOjg6InRlcm1lay0xIjt9fQ==', '1402593890', '1402593739'),
(16, 1, 1, 2, 1, 'YTozOntpOjE7Tzo0OiJpdGVtIjo2OntzOjg6InF1YW50aXR5IjtzOjE6IjEiO3M6MjoiSUQiO3M6MToiMSI7czo4OiJpdGVtTmFtZSI7czo5OiJUZXJtw6lrIDEiO3M6OToiaXRlbVByaWNlIjtzOjQ6IjI1MDAiO3M6OToiaXRlbVRvdGFsIjtpOjI1MDA7czo3OiJpdGVtVVJMIjtzOjg6InRlcm1lay0xIjt9aToyO086NDoiaXRlbSI6Njp7czo4OiJxdWFudGl0eSI7czoxOiIxIjtzOjI6IklEIjtzOjE6IjIiO3M6ODoiaXRlbU5hbWUiO3M6OToiVGVybcOpayAyIjtzOjk6Iml0ZW1QcmljZSI7czo0OiIzNTAwIjtzOjk6Iml0ZW1Ub3RhbCI7aTozNTAwO3M6NzoiaXRlbVVSTCI7czo4OiJ0ZXJtZWstMiI7fWk6MztPOjQ6Iml0ZW0iOjY6e3M6ODoicXVhbnRpdHkiO3M6MToiMSI7czoyOiJJRCI7czoxOiIzIjtzOjg6Iml0ZW1OYW1lIjtzOjk6IlRlcm3DqWsgMyI7czo5OiJpdGVtUHJpY2UiO3M6MzoiMTAwIjtzOjk6Iml0ZW1Ub3RhbCI7aToxMDA7czo3OiJpdGVtVVJMIjtzOjg6InRlcm1lay0zIjt9fQ==', '1402595256', '1402593892');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page` varchar(100) NOT NULL,
  `position` tinyint(3) unsigned NOT NULL,
  `menuOrder` int(10) unsigned NOT NULL,
  `URL` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `visible` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- A tábla adatainak kiíratása `pages`
--

INSERT INTO `pages` (`ID`, `page`, `position`, `menuOrder`, `URL`, `type`, `visible`) VALUES
(1, 'index', 1, 1, 'index', 'file', 1),
(2, 'Kosár', 2, 1, 'cart', 'file', 1),
(3, 'Szállítási cím', 2, 2, 'delivery-address', 'file', 1),
(4, 'Számlázási cím', 2, 3, 'billing-address', 'file', 1),
(5, 'Fizetési mód', 2, 4, 'payment-method', 'file', 1),
(6, 'Megrendelés', 2, 5, 'order', 'file', 1),
(7, 'maci', 1, 2, 'products', 'file', 1),
(8, 'Korábbi megrendeléseim', 3, 2, 'userOrders', 'file', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `paymentmethod`
--

CREATE TABLE IF NOT EXISTS `paymentmethod` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payment` varchar(30) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- A tábla adatainak kiíratása `paymentmethod`
--

INSERT INTO `paymentmethod` (`ID`, `payment`, `description`) VALUES
(1, 'Kártyás', 'Fizetés kártyával'),
(2, 'Postai', 'Fizetés utánvétel');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `categoryID` int(10) unsigned NOT NULL,
  `URL` varchar(200) NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `stock` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- A tábla adatainak kiíratása `products`
--

INSERT INTO `products` (`ID`, `product`, `description`, `categoryID`, `URL`, `price`, `stock`) VALUES
(1, 'Termék 1', 'Termék 1 leírása', 1, 'termek-1', 2500, 10),
(2, 'Termék 2', 'Termék 2 laírása', 2, 'termek-2', 3500, 2),
(3, 'Termék 3', 'kljasdhfsadgfj', 3, 'termek-3', 100, 10);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `rights` tinyint(4) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`ID`, `firstName`, `lastName`, `description`, `rights`, `email`, `password`) VALUES
(1, 'László', 'Ambrus', 'Magamról néhány sor...', 3, 'info@immi.hu', 'immi');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
