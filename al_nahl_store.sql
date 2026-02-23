-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2025 at 12:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `al_nahl_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `content`, `created_at`) VALUES
(1, 'The Health Benefits of Pure Honey', 'Honey has been used for centuries not only as a sweetener but also as a natural remedy for various health issues. It is rich in antioxidants, has antimicrobial properties, and can help with digestive issues. Pure honey can also aid in wound healing and improve skin health. In this blog, we’ll explore the numerous health benefits of honey and why it should be a staple in your diet.', '2025-02-06 07:50:09'),
(2, 'How to Choose the Right Honey for Your Health', 'With so many types of honey available on the market, it can be overwhelming to choose the right one for your health needs. Some honeys are better suited for general wellness, while others, like Manuka honey, offer more specific benefits like improving immunity and promoting gut health. In this blog, we discuss how to select the best honey for your personal health and wellness.', '2025-02-06 07:50:09'),
(3, 'The History of Honey: From Ancient Civilizations to Modern-Day Uses', 'Honey is one of the oldest sweeteners known to mankind, with evidence of its use dating back to ancient Egypt. For thousands of years, honey has been cherished not only for its sweetness but also for its medicinal properties. This blog takes a deep dive into the fascinating history of honey, from its use in ancient civilizations to its place in modern-day diets and medicine.', '2025-02-06 07:50:09'),
(4, 'Honey as a Natural Remedy for Common Ailments', 'Did you know that honey can be an effective natural remedy for common ailments such as sore throats, colds, and coughs? Its antibacterial properties make it an excellent alternative to over-the-counter medications. In this blog, we will look at some of the most common ways honey can be used as a natural treatment and why it’s so effective.', '2025-02-06 07:50:09'),
(5, 'The Different Types of Honey and Their Unique Benefits', 'Honey comes in many different varieties, each with its unique flavor profile and health benefits. From the light and floral taste of acacia honey to the rich and robust flavor of buckwheat honey, each type of honey has its own set of benefits. In this blog, we will explore the different types of honey and explain the benefits each one offers, helping you make an informed choice for your health.', '2025-02-06 07:50:09'),
(6, 'Honey for Skin: How to Use Honey in Your Skincare Routine', 'Honey has been used in skincare for centuries due to its moisturizing and healing properties. Whether you have dry skin, acne, or a wound, honey can be an effective natural treatment. This blog will discuss how to incorporate honey into your skincare routine and how it can help you achieve healthier, glowing skin.', '2025-02-06 07:50:09'),
(7, 'Why Local Honey is Better for You', 'Local honey is not only more flavorful, but it also has health benefits that honey from larger commercial producers might lack. Local honey is known to help with seasonal allergies and may have a higher concentration of beneficial nutrients due to the diverse range of flowers in your area. In this blog, we will look at the advantages of choosing local honey over mass-produced varieties.', '2025-02-06 07:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `variant_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `shipping_address` text NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `quantity`, `status`, `created_at`, `variant_id`, `total_price`, `payment_method`, `shipping_address`, `transaction_id`) VALUES
(1, 7, NULL, 1, 'Pending', '2025-02-07 11:58:17', 1, 500.00, 'Cash on Delivery', 'as', NULL),
(2, 7, NULL, 1, 'Pending', '2025-02-07 12:46:12', 14, 2300.00, 'EasyPaisa', 'sd', NULL),
(3, 7, NULL, 1, 'Pending', '2025-02-07 16:44:06', 9, 2300.00, 'easypaisa.php', 's', NULL),
(4, 7, NULL, 1, 'Pending', '2025-02-07 17:30:17', 9, 2300.00, 'php/cod.php', 'sa', NULL),
(5, 7, NULL, 1, 'Pending', '2025-02-07 17:31:25', 9, 2300.00, 'php/cod.php', 'as', NULL),
(6, 7, NULL, 1, 'Pending', '2025-02-07 17:31:29', 9, 2300.00, 'php/cod.php', 'as', NULL),
(7, 7, NULL, 1, 'Pending', '2025-02-07 17:32:10', 11, 1700.00, 'php/cod.php', 'as', NULL),
(8, 7, NULL, 1, 'Pending', '2025-02-07 17:41:00', 11, 1700.00, 'php/cod.php', 'sa', NULL),
(9, 7, NULL, 1, 'Pending', '2025-02-07 17:42:14', 11, 1700.00, 'php/cod.php', 'sa', NULL),
(10, 7, NULL, 1, 'Pending', '2025-02-07 17:42:39', 11, 1700.00, 'php/cod.php', 'sa', NULL),
(11, 7, NULL, 1, 'Pending', '2025-02-07 17:43:47', 11, 1700.00, 'php/cod.php', 'sa', NULL),
(12, 7, NULL, 1, 'Pending', '2025-02-07 17:44:16', 11, 1700.00, 'php/cod.php', 'hu', NULL),
(13, 7, NULL, 1, 'Completed', '2025-02-07 17:51:05', 11, 1700.00, 'php/cod.php', 'df', NULL),
(14, 7, NULL, 1, 'Completed', '2025-02-07 18:08:59', 11, 1700.00, 'EasyPaisa', 's', '03150105973'),
(15, 7, NULL, 1, 'Completed', '2025-02-07 18:10:27', 11, 1700.00, 'EasyPaisa', 's', '03150105973'),
(16, 7, NULL, 1, 'Completed', '2025-02-07 18:14:50', 11, 1700.00, 'EasyPaisa', 's', '03150105973'),
(17, 7, NULL, 1, 'Completed', '2025-02-07 18:17:45', 11, 1700.00, 'EasyPaisa', 's', '03150105973'),
(18, 7, NULL, 1, 'Completed', '2025-02-07 18:22:07', 11, 1700.00, 'EasyPaisa', 's', '03150105973'),
(19, 7, NULL, 1, 'Completed', '2025-02-07 18:27:04', 1, 500.00, 'EasyPaisa', 'sd', '03150105973'),
(20, 8, NULL, 1, 'Completed', '2025-02-08 05:52:52', 7, 2300.00, 'EasyPaisa', 'jk', '03150105973'),
(21, 8, NULL, 1, 'Pending', '2025-02-08 06:01:12', 7, 2300.00, 'php/easypaisa.php', 'jk', NULL),
(22, 8, NULL, 1, 'Pending', '2025-02-08 06:11:36', 7, 2300.00, 'php/easypaisa.php', 'jk', NULL),
(23, 8, NULL, 1, 'Completed', '2025-02-10 04:37:44', 13, 1200.00, 'php/cod.php', 'sa', NULL),
(24, 8, NULL, 1, 'Completed', '2025-07-06 09:12:31', 3, 1800.00, 'php/cod.php', 'jgjfgj', NULL),
(25, 8, NULL, 1, 'Pending', '2025-07-06 09:27:05', 13, 1200.00, 'php/easypaisa.php', 'rhh', NULL),
(26, 8, NULL, 1, 'Pending', '2025-07-06 09:27:27', 13, 1200.00, 'php/bank.php', 'rhh', NULL),
(27, 8, NULL, 1, 'Pending', '2025-07-06 09:27:31', 13, 1200.00, 'php/jazzcash.php', 'rhh', NULL),
(28, 8, NULL, 1, 'Completed', '2025-07-06 09:27:36', 13, 1200.00, 'php/cod.php', 'rhh', NULL),
(29, 8, NULL, 2, 'Completed', '2025-07-06 11:55:26', 8, 2400.00, 'php/cod.php', 'vcvdxc', NULL),
(30, 8, NULL, 2, 'Completed', '2025-07-06 11:55:42', 8, 2400.00, 'php/cod.php', 'vcvdxc', NULL),
(31, 8, NULL, 2, 'Pending', '2025-07-06 11:55:58', 8, 2400.00, 'php/easypaisa.php', 'vcvdxc', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `sku` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `description`, `price`, `image_url`, `created_at`) VALUES
(1, 'AN-FMT100', 'AL NAHL Premium Family Mixture Tea - 100 gm', 'Experience the perfect blend of flavor and quality with AL NAHL Premium Family Mixture Tea in a 100 gm pack. Specially crafted for families, this premium tea delivers a refreshing taste and rich aroma with every cup. Ideal for daily use, it’s a trusted choice for tea lovers who value quality and consistency.', 500.00, 'images/tea-100gm.jpg', '2025-01-31 11:03:31'),
(2, 'AN-FMT250', 'AL NAHL Premium Family Mixture Tea - 250 gm', 'AL NAHL Premium Family Mixture Tea - 250 gm combines robust flavor and superior quality for the ultimate tea experience. Perfect for families, this premium blend is crafted to deliver a consistent, aromatic cup of tea every time. Ideal for those who enjoy tea regularly and appreciate a perfect family brew.', 1000.00, 'images/tea-250gm.jpg', '2025-01-31 11:03:31'),
(3, 'AN-FMT500', 'AL NAHL Premium Family Mixture Tea - 500 gm', 'AL NAHL Premium Family Mixture Tea in a 500 gm pack is the ideal choice for families who enjoy tea together. Its perfectly balanced blend ensures a rich taste and fresh aroma in every cup. A premium tea that combines quality and quantity for daily use.', 1800.00, 'images/tea-500gm.jpg', '2025-01-31 11:03:31'),
(4, 'AN-FMT1KG', 'AL NAHL Premium Family Mixture Tea - 1000 gm', 'AL NAHL Premium Family Mixture Tea - 1000 gm offers a long-lasting supply of premium tea for families who value tradition and quality. This special blend provides a rich, aromatic flavor and a satisfying tea experience, making it perfect for daily enjoyment and family gatherings.', 3200.00, 'images/tea-1000gm.jpg', '2025-01-31 11:03:31'),
(5, 'AN-HPS', 'AL NAHL Premium Himalayan Pink Salt', 'AL NAHL Premium Himalayan Pink Salt is a 100% natural, unrefined salt rich in essential minerals and trace elements. Perfect for cooking, grilling, and seasoning, it adds a burst of flavor and health benefits to your meals. Sustainably sourced from the Himalayan mountains, this pink salt is free from additives and preservatives.', 800.00, 'images/pink-salt.jpg', '2025-01-31 11:03:31'),
(6, 'AN-EVOO500', 'AL NAHL Premium Extra Virgin Olive Oil - 500 ml', 'Discover the rich flavor and exceptional quality of AL NAHL Premium Extra Virgin Olive Oil. Cold-pressed from the finest olives, this 500 ml bottle delivers a smooth, aromatic oil that’s perfect for salads, dressings, cooking, and dipping. Packed with antioxidants and heart-healthy fats, it’s a natural choice for enhancing your meals and well-being.', 1500.00, 'images/olive-oil-500ml.jpg', '2025-01-31 11:03:31'),
(7, 'AN-EVOO1000', 'AL NAHL Premium Extra Virgin Olive Oil - 1000 ml', 'Indulge in the superior quality of AL NAHL Premium Extra Virgin Olive Oil. Cold-pressed from carefully selected olives, this 1000 ml bottle offers a rich, aromatic oil ideal for cooking, dressings, and dipping. Loaded with antioxidants and healthy fats, it’s the perfect addition to a wholesome and flavorful lifestyle.', 2800.00, 'images/olive-oil-1000ml.jpg', '2025-01-31 11:03:31'),
(8, 'AN-CG500', 'AL NAHL Pure Cow Ghee - 500 gm', 'AL NAHL Pure Cow Ghee is a premium, golden-yellow ghee made from the milk of grass-fed cows. Packed with rich aroma and traditional flavor, this 500 gm jar is ideal for cooking, frying, or as a healthy addition to your meals. High in essential nutrients and free from additives, it’s the perfect choice for a wholesome lifestyle.', 1200.00, 'images/cow-ghee-500gm.jpg', '2025-01-31 11:03:31'),
(9, 'AN-CG1000', 'AL NAHL Pure Cow Ghee - 1000 gm', 'Experience the rich taste and nutrition of AL NAHL Pure Cow Ghee. Made from high-quality milk of grass-fed cows, this 1000 gm jar is perfect for daily use in cooking, frying, or as a flavorful topping. With its pure, natural goodness and no additives, it’s an essential addition to your kitchen.', 2200.00, 'images/cow-ghee-1000gm.jpg', '2025-01-31 11:03:31'),
(10, 'AN-BH500', 'AL NAHL Premium Berry Honey - 500 gm', 'Savor the sweet and tangy goodness of AL NAHL Premium Berry Honey. Harvested from bees that forage on berry blossoms, this 500 gm jar delivers a unique flavor profile with natural antioxidants and nutrients. Perfect as a spread, sweetener, or natural remedy, it’s a delightful addition to your pantry.', 1500.00, 'images/berry-honey-500gm.jpg', '2025-01-31 11:03:31'),
(11, 'AN-BH1000', 'AL NAHL Premium Berry Honey - 1000 gm', 'Discover the rich, fruity taste of AL NAHL Premium Berry Honey. Sourced from the nectar of berry blossoms, this 1000 gm jar offers a burst of natural sweetness and nutritional benefits. Ideal for teas, desserts, or as a health-boosting treat, it’s the perfect choice for your family’s well-being.', 2800.00, 'images/berry-honey-1000gm.jpg', '2025-01-31 11:03:31'),
(12, 'AN-EVOO250', 'AL NAHL Premium Extra Virgin Olive Oil - 250 ml', 'Enjoy the exquisite taste of AL NAHL Premium Extra Virgin Olive Oil in a convenient 250 ml bottle. Cold-pressed from the finest olives, this oil delivers a smooth, fresh flavor perfect for drizzling, dipping, or light cooking. Rich in antioxidants and heart-healthy fats, it’s an essential addition to your daily diet.', 800.00, 'images/olive-oil-250ml.jpg', '2025-01-31 11:03:31'),
(13, 'AN-PH500', 'Paloosa Honey 500 Gm', 'A premium, dark, and earthy honey packed with antioxidants and nutrients. Perfect for sweetening teas, enhancing desserts, or enjoying as a natural health elixir.', 1200.00, 'images/paloosa-honey-500gm.jpg', '2025-01-31 11:03:31'),
(14, 'AN-PH001', 'Paloosa Honey 1000 gm', 'A premium, dark, and earthy honey packed with antioxidants and nutrients. Perfect for sweetening teas, enhancing desserts, or enjoying as a natural health elixir.', 2200.00, 'images/paloosa-honey-1000gm.jpg', '2025-01-31 11:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `rating`, `comment`, `created_at`, `user_id`) VALUES
(1, 1, 5, 'amazing', '2025-02-07 08:54:28', 0),
(2, 1, 5, 'amazing', '2025-02-07 09:31:16', 4),
(3, 1, 2, 'good', '2025-02-07 09:42:38', 4),
(4, 1, 5, 'good', '2025-02-07 11:28:19', 7),
(5, 5, 5, 'best', '2025-07-06 09:50:20', 8),
(6, 8, 5, 'best', '2025-07-06 11:54:59', 8),
(7, 8, 4, 'hgjyd', '2025-07-06 11:55:06', 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(4, 'goldenrout99', 'goldenrout99@gmail.com', '$2y$10$IuwpnpXAm3whWdnc4rK3BePrL6M9rpC6reEWSUq2GLQffRRmadxs.', '2025-02-07 09:22:45'),
(5, 'noone', 'noone@gmail.com', '$2y$10$mv.zJ700JaFOu5O7p5.khODhi0YhiZaojmQYVHgOqLEZGSnG8u5Ze', '2025-02-07 10:38:46'),
(7, 'noone', 'jh@gmail.com', '$2y$10$cpg22B5SSEBMg.U1vdFpSOAZ6dNBmhd2j5GUNdhTRCfX3WEDxrZMi', '2025-02-07 10:38:55'),
(8, 'df', 'df@gmail.com', '$2y$10$gycT8pyDXAejl9vmLbr7eugWrGHM6WYviRDFLpJX9WxzXjdDdj1U6', '2025-02-08 04:46:48'),
(9, 'Hanzala', 'anthony112@gmail', '$2y$10$I4aL9Tzbu3uppguZ3/pwnO8N8FPnqoFjgUWv.hxXHKD/0n/K.IGGe', '2025-08-31 11:51:16'),
(10, 'Hanzala', 'anthony112@gmail.com', '$2y$10$mZuhYQxdASzBoyOMhT/fg.cjRSU.Bt/gsoPRkclXUSRmMH/iAnTHG', '2025-08-31 11:52:05');

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `sku` varchar(50) DEFAULT NULL,
  `weight` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `variants`
--

INSERT INTO `variants` (`id`, `product_id`, `sku`, `weight`, `price`, `description`, `image_url`, `name`) VALUES
(1, 1, 'AN-FMT100', '100 gm', 500.00, 'Experience the perfect blend of flavor and quality with AL NAHL Premium Family Mixture Tea in a 100 gm pack. Specially crafted for families, this premium tea delivers a refreshing taste and rich aroma with every cup. Ideal for daily use, it’s a trusted choice for tea lovers who value quality and consistency.', 'images/tea-100gm.jpg', 'AL NAHL Premium Family Mixture Tea - 100 gm'),
(2, 2, 'AN-FMT250', '250 gm', 950.00, 'AL NAHL Premium Family Mixture Tea - 250 gm combines robust flavor and superior quality for the ultimate tea experience. Perfect for families, this premium blend is crafted to deliver a consistent, aromatic cup of tea every time. Ideal for those who enjoy tea regularly and appreciate a perfect family brew.', 'images/tea-250gm.jpg', 'AL NAHL Premium Family Mixture Tea - 250 gm'),
(3, 3, 'AN-FMT500', '500 gm', 1800.00, 'AL NAHL Premium Family Mixture Tea in a 500 gm pack is the ideal choice for families who enjoy tea together. Its perfectly balanced blend ensures a rich taste and fresh aroma in every cup. A premium tea that combines quality and quantity for daily use.', 'images/tea-500gm.jpg', 'AL NAHL Premium Family Mixture Tea - 500 gm'),
(4, 4, 'AN-FMT1KG', '1000 gm', 3500.00, 'AL NAHL Premium Family Mixture Tea - 1000 gm offers a long-lasting supply of premium tea for families who value tradition and quality. This special blend provides a rich, aromatic flavor and a satisfying tea experience, making it perfect for daily enjoyment and family gatherings.', 'images/tea-1kg.jpg', 'AL NAHL Premium Family Mixture Tea - 1000 gm'),
(5, 5, 'AN-HPS', '500 gm', 650.00, 'AL NAHL Premium Himalayan Pink Salt is a 100% natural, unrefined salt rich in essential minerals and trace elements. Perfect for cooking, grilling, and seasoning, it adds a burst of flavor and health benefits to your meals. Sustainably sourced from the Himalayan mountains, this pink salt is free from additives and preservatives.', 'images/himalayan-salt.jpg', 'AL NAHL Premium Himalayan Pink Salt'),
(6, 6, 'AN-EVOO500', '500 ml', 1200.00, 'Discover the rich flavor and exceptional quality of AL NAHL Premium Extra Virgin Olive Oil. Cold-pressed from the finest olives, this 500 ml bottle delivers a smooth, aromatic oil that’s perfect for salads, dressings, cooking, and dipping. Packed with antioxidants and heart-healthy fats, it’s a natural choice for enhancing your meals and well-being.', 'images/olive-oil-500ml.jpg', 'AL NAHL Premium Extra Virgin Olive Oil - 500 ml'),
(7, 7, 'AN-EVOO1000', '1000 ml', 2300.00, 'Indulge in the superior quality of AL NAHL Premium Extra Virgin Olive Oil. Cold-pressed from carefully selected olives, this 1000 ml bottle offers a rich, aromatic oil ideal for cooking, dressings, and dipping. Loaded with antioxidants and healthy fats, it’s the perfect addition to a wholesome and flavorful lifestyle.', 'images/olive-oil-1000ml.jpg', 'AL NAHL Premium Extra Virgin Olive Oil - 1000 ml'),
(8, 8, 'AN-CG500', '500 gm', 1200.00, 'AL NAHL Pure Cow Ghee is a premium, golden-yellow ghee made from the milk of grass-fed cows. Packed with rich aroma and traditional flavor, this 500 gm jar is ideal for cooking, frying, or as a healthy addition to your meals. High in essential nutrients and free from additives, it’s the perfect choice for a wholesome lifestyle.', 'images/cow-ghee-500gm.jpg', 'AL NAHL Pure Cow Ghee - 500 gm'),
(9, 9, 'AN-CG1000', '1000 gm', 2300.00, 'Experience the rich taste and nutrition of AL NAHL Pure Cow Ghee. Made from high-quality milk of grass-fed cows, this 1000 gm jar is perfect for daily use in cooking, frying, or as a flavorful topping. With its pure, natural goodness and no additives, it’s an essential addition to your kitchen.', 'images/cow-ghee-1000gm.jpg', 'AL NAHL Pure Cow Ghee - 1000 gm'),
(10, 10, 'AN-BH500', '500 gm', 900.00, 'Savor the sweet and tangy goodness of AL NAHL Premium Berry Honey. Harvested from bees that forage on berry blossoms, this 500 gm jar delivers a unique flavor profile with natural antioxidants and nutrients. Perfect as a spread, sweetener, or natural remedy, it’s a delightful addition to your pantry.', 'images/berry-honey-500gm.jpg', 'AL NAHL Premium Berry Honey - 500 gm'),
(11, 11, 'AN-BH1000', '1000 gm', 1700.00, 'Discover the rich, fruity taste of AL NAHL Premium Berry Honey. Sourced from the nectar of berry blossoms, this 1000 gm jar offers a burst of natural sweetness and nutritional benefits. Ideal for teas, desserts, or as a health-boosting treat, it’s the perfect choice for your family’s well-being.', 'images/berry-honey-1000gm.jpg', 'AL NAHL Premium Berry Honey - 1000 gm'),
(12, 12, 'AN-EVOO250', '250 ml', 650.00, 'Enjoy the exquisite taste of AL NAHL Premium Extra Virgin Olive Oil in a convenient 250 ml bottle. Cold-pressed from the finest olives, this oil delivers a smooth, fresh flavor perfect for drizzling, dipping, or light cooking. Rich in antioxidants and heart-healthy fats, it’s an essential addition to your daily diet.', 'images/olive-oil-250ml.jpg', 'AL NAHL Premium Extra Virgin Olive Oil - 250 ml'),
(13, 13, 'AN-PH500', '500 gm', 1200.00, 'A premium, dark, and earthy honey packed with antioxidants and nutrients. Perfect for sweetening teas, enhancing desserts, or enjoying as a natural health elixir.', 'images/paloosa-honey-500gm.jpg', 'Paloosa Honey 500 gm'),
(14, 14, 'AN-PH001', '1000 gm', 2300.00, 'A premium, dark, and earthy honey packed with antioxidants and nutrients. Perfect for sweetening teas, enhancing desserts, or enjoying as a natural health elixir.', 'images/paloosa-honey-1000gm.jpg', 'Paloosa Honey 1000 gm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `variants`
--
ALTER TABLE `variants`
  ADD CONSTRAINT `variants_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
