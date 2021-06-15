-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 14 Haz 2021, 17:32:52
-- Sunucu sürümü: 10.4.18-MariaDB
-- PHP Sürümü: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `delivery_control`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `category_name` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `category_delivery`
--

CREATE TABLE `category_delivery` (
  `ID` int(11) NOT NULL,
  `category_ID` int(11) NOT NULL,
  `delivery_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `deliveries`
--

CREATE TABLE `deliveries` (
  `ID` int(11) NOT NULL,
  `delivery_title` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `delivery_subtitle` varchar(600) COLLATE utf8_turkish_ci NOT NULL,
  `delivery_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `delivery_checked` tinyint(1) NOT NULL DEFAULT 0,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `categories_user_connect` (`user_ID`);

--
-- Tablo için indeksler `category_delivery`
--
ALTER TABLE `category_delivery`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `category_delivery_category_connect` (`category_ID`),
  ADD KEY `category_delivery_delivery_connect` (`delivery_ID`);

--
-- Tablo için indeksler `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `deliveries_user_connect` (`user_ID`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `category_delivery`
--
ALTER TABLE `category_delivery`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Tablo için AUTO_INCREMENT değeri `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_user_connect` FOREIGN KEY (`user_ID`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `category_delivery`
--
ALTER TABLE `category_delivery`
  ADD CONSTRAINT `category_delivery_category_connect` FOREIGN KEY (`category_ID`) REFERENCES `categories` (`ID`),
  ADD CONSTRAINT `category_delivery_delivery_connect` FOREIGN KEY (`delivery_ID`) REFERENCES `deliveries` (`ID`);

--
-- Tablo kısıtlamaları `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `deliveries_user_connect` FOREIGN KEY (`user_ID`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
