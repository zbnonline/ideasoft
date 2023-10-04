-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 04 Eki 2023, 11:48:50
-- Sunucu sürümü: 10.4.24-MariaDB
-- PHP Sürümü: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `ideasoft`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `since` varchar(255) NOT NULL,
  `revenue` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `customers`
--

INSERT INTO `customers` (`id`, `name`, `since`, `revenue`) VALUES
(1, 'Türker Jöntürk', '2014-06-28', 492.12),
(2, 'Kaptan Devopuz', '2015-01-15', 1505.95),
(3, 'İsa Sonuyumaz', '2016-02-11', 0.00);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `discount_response_id` int(11) NOT NULL,
  `discount_reason` varchar(155) NOT NULL,
  `discount_amount` float(10,2) NOT NULL,
  `subtotal` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `discounts`
--

INSERT INTO `discounts` (`id`, `discount_response_id`, `discount_reason`, `discount_amount`, `subtotal`) VALUES
(1, 1, 'GETBUY5', 1500.00, 1250.00);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `discount_responses`
--

CREATE TABLE `discount_responses` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `total_discount` float(10,2) NOT NULL,
  `discounted_total` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `discount_responses`
--

INSERT INTO `discount_responses` (`id`, `order_id`, `total_discount`, `discounted_total`) VALUES
(1, 1, 1500.00, 1250.00);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unitPrice` float(10,2) NOT NULL,
  `subTotal` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `items`
--

INSERT INTO `items` (`id`, `orderId`, `productId`, `quantity`, `unitPrice`, `subTotal`) VALUES
(12, 1, 102, 10, 11.28, 112.80),
(13, 2, 101, 2, 49.50, 99.00),
(14, 2, 100, 1, 120.75, 120.75),
(15, 3, 103, 6, 11.28, 67.68),
(16, 3, 100, 10, 120.75, 1207.50);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `total` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `orders`
--

INSERT INTO `orders` (`id`, `customerId`, `total`) VALUES
(1, 1, 112.80),
(2, 2, 219.75),
(3, 3, 1275.18);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `stock`) VALUES
(100, 'Black&Decker A7062 40 Parça Cırcırlı Tornavida Seti', 1, 120.75, 10),
(101, 'Reko Mini Tamir Hassas Tornavida Seti 32\'li', 1, 49.50, 10),
(102, 'Viko Karre Anahtar - Beyaz', 2, 11.28, 10),
(103, 'Legrand Salbei Anahtar, Alüminyum', 2, 22.80, 10),
(104, 'Schneider Asfora Beyaz Komütatör', 2, 12.95, 10),
(105, 'bardak', 3, 25.00, 0);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `discount_responses`
--
ALTER TABLE `discount_responses`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `discount_responses`
--
ALTER TABLE `discount_responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- Tablo için AUTO_INCREMENT değeri `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
