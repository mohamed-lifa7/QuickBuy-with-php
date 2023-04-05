-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 06, 2023 at 01:38 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myMagazine`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `full_name`, `email`, `address`, `total`, `order_date`) VALUES
(1, 1, 'Rachad Lifa', 'rachad@gmail.com', 'zgoum', '68.25', '2023-03-27 22:16:44');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `prod_id`, `price`, `quantity`) VALUES
(1, 1, 35, '65.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `image` char(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `user_id`, `name`, `price`, `quantity`, `type`, `image`, `status`, `description`, `created_at`) VALUES
(1, 3, 'DELL Inspiron 15 7000 15.6', '899.00', 3, 'Electronics', 'images/dell-inspiron-15-7000-15-6.jpg', 1, '15-inch laptop ideal for gamers. Featuring the latest Intel® processors for superior gaming performance, and life-like NVIDIA® GeForce® graphics and an advanced thermal cooling design.', '2023-03-20 16:30:26'),
(2, 3, 'MICROSOFT Surface Pro 4 & Typecover - 128 GB', '799.00', 2, 'Electronics', 'images/large-microsoft-surface-pro-4-typecover-128-gb.jpg', 1, 'Surface Pro 4 powers through everything you need to do, while being lighter than ever before\r\n\r\nThe 12.3 PixelSense screen has extremely high contrast and low glare so you can work through the day without straining your eyes\r\n\r\nkeyboard is not included and needed to be purchased separately\r\n\r\nFeatures an Intel Core i5 6th Gen (Skylake) Core,Wireless: 802.11ac Wi-Fi wireless networking; IEEE 802.11a/b/g/n compatible Bluetooth 4.0 wireless technology\r\n\r\nShips in Consumer packaging.', '2023-03-20 16:32:29'),
(3, 3, 'DELL Inspiron 5675 Gaming PC - Recon Blue', '599.99', 3, 'Electronics', 'images/dell-inspiron-5675-gaming-pc-recon-blue.jpg', 1, 'All-new gaming desktop featuring powerful AMD Ryzen™ processors, graphics ready for VR, LED lighting and a meticulous design for optimal cooling.', '2023-03-20 16:58:41'),
(4, 3, 'PC SPECIALIST Vortex Core Lite Gaming PC', '599.99', 5, 'Electronics', 'images/large-pc-specialist-vortex-core-lite-gaming-pc.jpg', 1, '- Top performance for playing eSports and more \r\n\r\n- NVIDIA GeForce GTX graphics deliver smooth visuals \r\n\r\n- GeForce Experience delivers updates straight to your PC \r\n\r\nThe PC Specialist Vortex Core Lite is part of our Gaming range, bringing you the most impressive PCs available today. It has spectacular graphics and fast processing performance to suit the most exacting players.', '2023-03-20 17:01:00'),
(5, 3, 'HP Barebones OMEN X 900-099nn Gaming PC', '489.98', 4, 'Electronics', 'images/hp-barebones-omen-x-900-099nn-gaming-pc.jpg', 1, 'Nine lighting zones accentuate theaggressive lines and smooth blackfinish of this unique galvanized steelcase.', '2023-03-20 17:06:11'),
(6, 3, 'PC SPECIALIST Vortex Minerva XT-R Gaming PC', '999.99', 4, 'Electronics', 'images/large-pc-specialist-vortex-minerva-xt-r-gaming-pc.jpg', 1, 'The PC Specialist Vortex Minerva XT-R Gaming PC is part of our Gaming range, which offers the most powerful PCs available. Its high-performance graphics and processing are made to meet the needs of serious gamers.', '2023-03-20 17:08:00'),
(7, 3, 'ACER Aspire GX-781 Gaming PC', '749.99', 10, 'Electronics', 'images/acer-aspire-gx-781-gaming-pc.jpg', 1, '- GTX 1050 graphics card lets you play huge games in great resolutions \r\n\r\n- Latest generation Core™ i5 processor can handle demanding media software \r\n\r\n- Superfast SSD storage lets you load programs in no time \r\n\r\nThe Acer Aspire GX-781 Gaming PC is part of our Gaming range, which offers the most powerful PCs available today. It has outstanding graphics and processing performance to suit the most demanding gamer.', '2023-03-20 17:10:29'),
(8, 3, 'HP Pavilion Power 580-015na Gaming PC', '799.99', 2, 'Electronics', 'images/hp-pavilion-power-580-015na-gaming-pc.jpg', 1, 'Features the latest quad core Intel i5 processor and discrete graphics. With this power, you’re ready to take on any activity from making digital art to conquering new worlds in VR.\r\n\r\nChoose the performance and storage you need. Boot up in seconds with to 128 GB SSD.\r\n\r\nDitch the dull grey box, this desktop comes infused with style. A new angular bezel and bold green and black design give your workspace just the right amount of attitude.\r\n\r\nUp to 3 times faster performance - GeForce GTX 10-series graphics cards are powered by Pascal to deliver twice the performance of previous-generation graphics cards.', '2023-03-20 17:11:49'),
(9, 3, 'LENOVO Legion Y520 Gaming PC', '899.99', 1, 'Electronics', 'images/large-lenovo-legion-y520-gaming-pc.jpg', 1, '- Multi-task with ease thanks to Intel® i5 processor \r\n\r\n- Prepare for battle with NVIDIA GeForce GTX graphics card \r\n\r\n- VR ready for the next-generation of immersive gaming and entertainment\r\n\r\n- Tool-less upgrade helps you personalise your system to your own demands \r\n\r\nPart of our Gaming range, which features the most powerful PCs available today, the Lenovo Legion Y520 Gaming PC has superior graphics and processing performance to suit the most demanding gamer.\r\n\r\n', '2023-03-20 17:13:40'),
(10, 3, 'PC SPECIALIST Vortex Core II Gaming PC', '649.99', 1, 'Electronics', 'images/pc-specialist-vortex-core-ii-gaming-pc.jpg', 1, 'Processor: Intel® CoreTM i3-6100 Processor- Dual-core- 3.7 GHz- 3 MB cache\r\n\r\nMemory (RAM): 8 GB DDR4 HyperX, Storage: 1 TB HDD, 7200 rpm\r\n\r\nGraphics card: NVIDIA GeForce GTX 950 (2 GB GDDR5), Motherboard: ASUS H110M-R\r\n\r\nUSB: USB 3.0 x 3- USB 2.0 x 5, Video interface: HDMI x 1- DisplayPort x 1- DVI x 2, Audio interface: 3.5 mm jack, Optical disc drive: DVD/RW, Expansion card slot PCIe: (x1) x 2\r\n\r\nSound: 5.1 Surround Sound support PSU Corsair: VS350, 350W, Colour: Black- Green highlights, Box contents: PC Specialist Vortex Core- AC power cable', '2023-03-20 17:15:28'),
(11, 5, 'APPLE 9.7\" iPad - 32 GB, Gold', '339.00', 2, 'Electronics', 'images/apple-9-7-ipad-32-gb-gold.jpg', 1, '9.7 inch Retina Display, 2048 x 1536 Resolution, Wide Color and True Tone Display\r\n\r\nApple iOS 9, A9X chip with 64bit architecture, M9 coprocessor\r\n\r\n12 MP iSight Camera, True Tone Flash, Panorama (up to 63MP), Four-Speaker Audio\r\n\r\nUp to 10 Hours of Battery Life\r\n\r\niPad Pro Supports Apple Smart Keyboard and Apple Pencil', '2023-03-20 17:26:03'),
(12, 5, 'APPLE 9.7\" iPad - 32 GB, Space Grey', '339.00', 3, 'Electronics', 'images/apple-9-7-ipad-32-gb-space-grey.jpg', 1, '9.7-inch Retina display, wide color and true tone\r\n\r\nA9 third-generation chip with 64-bit architecture\r\n\r\nM9 motion coprocessor\r\n\r\n1.2MP FaceTime HD camera\r\n\r\n8MP iSight camera\r\n\r\nTouch ID\r\n\r\nApple Pay', '2023-03-20 17:26:51'),
(13, 5, 'APPLE 10.5\" iPad Pro - 64 GB, Space Grey (2017)', '619.00', 5, 'Electronics', 'images/apple-10-5-ipad-pro-64-gb-space-grey-2017.jpg', 1, '4K video recording at 30 fps\r\n\r\n12-megapixel camera\r\n\r\nFingerprint resistant coating\r\n\r\nAntireflective coating\r\n\r\nFace Time video calling', '2023-03-20 17:27:42'),
(14, 5, 'AMAZON Fire 7 Tablet with Alexa (2017) - 8 GB, Black', '49.99', 3, 'Electronics', 'images/amazon-fire-7-tablet-alexa-2017-8-gb-black.jpg', 1, 'The next generation of our best-selling Fire tablet ever - now thinner, lighter, and with longer battery life and an improved display. More durable than the latest iPad\r\n\r\nBeautiful 7\" IPS display with higher contrast and sharper text, a 1.3 GHz quad-core processor, and up to 8 hours of battery life. 8 or 16 GB of internal storage and a microSD slot for up to 256 GB of expandable storage.', '2023-03-20 17:28:32'),
(15, 5, 'AMAZON Fire HD 8 Tablet with Alexa (2017) - 16 GB, Black', '79.99', 1, 'Electronics', 'images/amazon-fire-hd-8-tablet-alexa-2017-16-gb-black.jpg', 1, 'Take your personal assistant with you wherever you go with this Amazon Fire HD 8 tablet featuring Alexa voice-activated cloud service. The slim design of the tablet is easy to handle, and the ample 8-inch screen is ideal for work or play. This Amazon Fire HD 8 features super-sharp high-definition graphics for immersive streaming.', '2023-03-20 17:29:34'),
(16, 5, 'AMAZON Fire HD 8 Tablet with Alexa (2017) - 32 GB, Black', '99.99', 4, 'Electronics', 'images/amazon-fire-hd-8-tablet-alexa-2017-32-gb-black.jpg', 1, 'The next generation of our best-reviewed Fire tablet, with up to 12 hours of battery life, a vibrant 8\" HD display, a 1.3 GHz quad-core processor, 1.5 GB of RAM, and Dolby Audio. More durable than the latest iPad.\r\n\r\n16 or 32 GB of internal storage and a microSD slot for up to 256 GB of expandable storage.', '2023-03-20 17:30:25'),
(17, 5, 'APPLE 9.7\" iPad - 32 GB, Space Grey', '339.00', 5, 'Electronics', 'images/apple-9-7-ipad-32-gb-space-grey.jpg', 1, '9.7-inch Retina display, wide color and true tone\r\n\r\nA9 third-generation chip with 64-bit architecture\r\n\r\nM9 motion coprocessor\r\n\r\n1.2MP FaceTime HD camera\r\n\r\n8MP iSight camera\r\n\r\nTouch ID\r\n\r\nApple Pay', '2023-03-20 17:31:54'),
(18, 6, 'Samsung Note 8', '829.00', 10, 'Electronics', 'images/samsung-note-8.jpg', 1, 'See the bigger picture and communicate in a whole new way. With the Galaxy Note8 in your hand, bigger things are just waiting to happen. ', '2023-03-20 17:37:04'),
(19, 6, 'Samsung Galaxy S9+ [128 GB]', '889.99', 8, 'Electronics', 'images/samsung-galaxy-s9-128-gb.jpg', 1, 'Our category-defining Dual Aperture lens adapts like the human eye.\r\n*Dual Aperture supports F1.5 and F2.4 modes. Installed on the rear camera (Galaxy S9)/rear wide camera (Galaxy S9+).', '2023-03-20 17:38:48'),
(20, 7, 'Air-Force', '49.00', 3, 'Fashion', 'images/shoes1.webp', 1, '100 % Suede/Mesh\r\nImported\r\nRelax fit\r\nSynthetic sole\r\nMemory foam', '2023-03-21 13:04:54'),
(21, 7, 'Skechers Sport Men', '75.00', 5, 'Fashion', 'images/revolt-164_6wVEHfI-unsplash.jpg', 1, '100% nubuck leather\nImported\nRubber sole\nPadded tongue and collar', '2023-03-21 13:08:49'),
(22, 7, 'Nike Air Max 270', '120.00', 50, 'Fashion', 'images/awjogtdnqxniqqk0wpgf.webp', 1, 'The Nike Air Max 270 features a large Max Air a sleek design thats for everyday wear.', '2023-03-21 13:19:30'),
(23, 7, 'Classic Leather Sneakers', '50.00', 50, 'Fashion', 'images/classic.jpeg', 1, 'These sneakers are made with genuine leather and have a timeless design that never goes out of style', '2023-03-21 13:24:26'),
(24, 7, 'Running Shoes', '80.00', 30, 'Fashion', 'images/download (1).jpeg', 1, 'Designed for runners, these shoes provide excellent support and cushioning for the feet.', '2023-03-21 13:26:14'),
(25, 7, 'Ballet Flats', '40.00', 20, 'Fashion', 'images/download (2).jpeg', 1, 'These comfortable and stylish flats are perfect for everyday wear. They are made with durable material and come in a variety of colors to match any outfit.', '2023-03-21 13:27:47'),
(26, 7, 'High Heels', '70.00', 10, 'Fashion', 'images/download (3).jpeg', 1, 'These elegant and sleek high heels are perfect for formal occasions. They are made with high-quality material and come in a variety of styles to suit your taste.', '2023-03-21 13:29:26'),
(27, 9, 'Garnier SkinActive Micellar Cleansing Water', '8.99', 4, 'Beauty and Personal care', 'images/Garnier-Skin-Active-Micellar-Clear-Water.jpg', 1, 'This all-in-1 cleanser removes makeup, cleanses, and refreshes skin. Its gentle formula is suitable for all skin types, including sensitive skin.\r\n\r\nProduct name: Neutrogena Hydro Boost Gel-Cream', '2023-03-21 13:42:48'),
(28, 9, 'Neutrogena Hydro Boost Gel-Cream', '20.99', 3, 'Beauty and Personal care', 'images/download.jpeg', 1, 'This gel-cream moisturizer instantly quenches dry skin and keeps it looking smooth, supple, and hydrated all day. Its non-greasy, oil-free formula is perfect for all skin types.', '2023-03-21 13:49:21'),
(29, 9, 'LOreal Paris Voluminous Lash Paradise Mascara', '9.99', 6, 'Beauty and Personal care', 'images/LOreal.png', 1, 'This mascara delivers voluptuous volume and intense length for a full dramatic lash look. Its soft wavy brush coats each lash for a feathery flirty effect.', '2023-03-21 13:55:31'),
(30, 9, 'Bioderma Sensibio H2O Micellar Water', '14.00', 50, 'Beauty and Personal care', 'images/Bioderma .jpeg', 1, 'This anti-aging night cream hydrates skin and reduces the appearance of fine lines and wrinkles. Its formula with retinol and Vitamin B3 works overnight to give you visibly smoother, more radiant skin.', '2023-03-21 13:57:08'),
(31, 9, 'Dove Beauty Bar', '3.99', 6, 'Beauty and Personal care', 'images/Dove.jpeg', 1, 'This classic beauty bar gently cleanses and nourishes skin with 1/4 moisturizing cream. Its mild formula is suitable for all skin types, and it leaves skin feeling soft, smooth, and refreshed.', '2023-03-21 13:59:01'),
(32, 9, 'Olay Regenerist Retinol 24 Night Moisturizer', '28.99', 4, 'Beauty and Personal care', 'images/Olay.jpeg', 1, 'Skin type: suitable for all skin types, oily, dry & combination\r\nWake up to plumper, younger-looking skin with Olay Retinol24!\r\nRenews and resurfaces skin as you sleep', '2023-03-21 14:03:04'),
(33, 10, 'Coleman Sundome Tent', '99.99', 6, 'Sports and Outdoors', 'images/Coleman.jpeg', 1, 'The Coleman Sundome Tent is a spacious and easy-to-set-up tent that can accommodate up to 4 people. It features a sturdy frame, waterproof design, and mesh windows for ventilation.', '2023-03-21 14:12:04'),
(34, 10, 'Yeti Rambler Tumbler', '29.99', 5, 'Sports and Outdoors', 'images/Yeti.jpeg', 1, 'The Yeti Rambler Tumbler is a durable and insulated cup that can keep your drinks hot or cold for hours. It has a 20-ounce capacity and is made of stainless steel.', '2023-03-21 14:13:20'),
(35, 10, 'Osprey Daylite Plus Backpack', '65.00', 4, 'Sports and Outdoors', 'images/Osprey.jpeg', 1, 'The Osprey Daylite Plus Backpack is a versatile and lightweight backpack that is perfect for day hikes and outdoor activities. It has a spacious main compartment, multiple pockets, and is hydration-compatible.', '2023-03-21 14:14:31'),
(36, 10, 'Klean Kanteen Water Bottle', '139.00', 10, 'Sports and Outdoors', 'images/klean.jpeg', 1, 'The Klean Kanteen Water Bottle is a reusable and eco-friendly water bottle that is made of stainless steel. It has a 20-ounce capacity, a leak-proof cap, and is compatible with most cup holders.', '2023-03-21 14:17:54'),
(37, 10, 'Adidas Performance Soccer Ball', '29.99', 1, 'Sports and Outdoors', 'images/AdidasBall.jpeg', 1, 'The Adidas Performance Soccer Ball is perfect for soccer players of all levels. It has a durable, machine-stitched TPU cover that can handle tough play and an interior bladder made of butyl that provides excellent air retention. The ball is designed with a classic black and white paneling and features the iconic Adidas logo. It is a great choice for both training and recreational play.', '2023-03-21 14:58:40'),
(38, 10, 'CamelBak Hydration Pack', '89.99', 2, 'Sports and Outdoors', 'images/CamelBak.jpeg', 1, 'The CamelBak Hydration Pack is perfect for outdoor activities such as hiking, running, and biking. It has a 2-liter water reservoir that provides hydration on-the-go, and is made with a durable, lightweight fabric that can withstand tough conditions. The pack features multiple pockets for storing essentials like keys and snacks, and has adjustable straps for a comfortable fit.', '2023-03-21 15:00:21'),
(39, 11, 'Moleskine Classic Notebook', '19.99', 3, 'Books and Stationery', 'images/Moleskine.jpeg', 1, 'The Moleskine Classic Notebook is a high-quality notebook perfect for everyday use. It has a hard cover, elastic closure, and bookmark ribbon, and comes in a variety of colors and page styles. The acid-free paper is perfect for writing, drawing, or doodling.', '2023-03-21 15:10:18'),
(40, 11, 'Pilot G2 Retractable Gel Pen', '11.99', 2, 'Books and Stationery', 'images/Pilot-G2.jpeg', 1, 'The Pilot G2 Retractable Gel Pen is a favorite among stationery enthusiasts. It has a comfortable grip, a smooth-flowing gel ink, and is refillable. The pack of 12 comes in a variety of colors.', '2023-03-21 15:11:33'),
(41, 11, 'Sharpie Permanent Markers', '10.49', 5, 'Books and Stationery', 'images/Sharpie.jpeg', 1, 'Sharpie Permanent Markers are a staple for any office or classroom. The pack of 5 comes in a variety of colors and has a fine point that is perfect for labeling, drawing, or writing on a variety of surfaces.', '2023-03-21 15:12:56'),
(42, 11, 'The New York Times Crossword Puzzle Book', '12.99', 2, 'Books and Stationery', 'images/PuzzleBook.jpeg', 1, 'The New York Times Crossword Puzzle Book is perfect for crossword enthusiasts. It contains 50 Sunday-sized puzzles with varying degrees of difficulty.', '2023-03-21 15:14:31'),
(43, 11, 'The Elements of Style by William Strunk Jr', '7.95', 1, 'Books and Stationery', 'images/ElementsofStyle.jpeg', 1, 'The Elements of Style by William Strunk Jr. is a classic guide to writing well. It contains timeless advice on grammar, style, and usage, and is perfect for students or professionals looking to improve their writing skills.', '2023-03-21 15:16:30'),
(44, 11, 'Staedtler Triplus Fineliner Pens ', '15.99', 6, 'Books and Stationery', 'images/StaedtlerTriplus.jpeg', 1, 'Staedtler Triplus Fineliner Pens are perfect for precise writing or drawing. The pack of 10 comes in a variety of colors and has a 0.3mm fine point that is perfect for detailed work.', '2023-03-21 15:18:56'),
(45, 11, 'The Alchemist by Paulo Coelho', '10.99', 50, 'Books and Stationery', 'images/Alchemist.jpeg', 1, '\"The Alchemist\" is a bestselling novel that tells the story of a shepherd boy named Santiago who goes on a journey to fulfill his personal legend. This book has been praised for its inspirational and philosophical themes.', '2023-03-21 17:20:53'),
(46, 11, '\"The Lean Startup\" by Eric Ries', '12.99', 40, 'Books and Stationery', 'images/TheLeanStartup.jpeg', 1, '\"The Lean Startup\" is a bestselling business book that provides a practical approach to starting and growing a successful business. It emphasizes the importance of testing and validating ideas quickly, and it provides a framework for building a sustainable business. This book is perfect for entrepreneurs and business owners.', '2023-03-21 17:22:31'),
(47, 11, 'Graco Pack-n Play Playard', '99.99', 5, 'Baby and Kids', 'images/Graco.jpeg', 1, 'The Graco Pack-n Play Playard is a portable crib and playpen that is perfect for parents on-the-go. It features a removable bassinet and a changing table, and it can be easily folded and stored in a carrying bag. This playard is perfect for babies and young children.', '2023-03-21 17:26:40'),
(48, 11, 'LEGO Classic Large Creative Brick Box', '49.99', 6, 'Baby and Kids', 'images/LEGO.jpeg', 1, 'The LEGO Classic Large Creative Brick Box is a set of building blocks that encourages creativity and imagination. It includes 790 pieces in a variety of colors and shapes, and it comes with ideas for building different models. This set is perfect for children of all ages.', '2023-03-21 17:27:55'),
(49, 11, 'Fisher-Price Deluxe Kick & Play Piano Gym', '49.99', 15, 'Baby and Kids', 'images/Fisher-Price .jpeg', 1, 'The Fisher-Price Deluxe Kick & Play Piano Gym is an activity mat that helps babies develop their motor skills and coordination. It features a piano that can be kicked to play music, as well as toys and mirrors to stimulate sensory development. This activity gym is perfect for infants and young children.', '2023-03-21 17:29:27'),
(50, 11, 'Melissa &amp; Doug Wooden Railway Set', '79.55', 3, 'Baby and Kids', 'images/Melissa .jpeg', 1, ' The Melissa &amp; Doug Wooden Railway Set is a train set that encourages imaginative play and creativity. It includes a wooden train track, train cars, buildings, and accessories, and it can be configured in many different ways. This train set is perfect for children who love trains and transportation.', '2023-03-21 17:30:58');

-- --------------------------------------------------------

--
-- Table structure for table `product_managers`
--

CREATE TABLE `product_managers` (
  `user_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_managers`
--

INSERT INTO `product_managers` (`user_id`, `name`, `user_name`, `email`, `password`, `type`) VALUES
(4, 'Mohamed Lifa', 'admin', 'admin@admin.com', '$2y$10$AhUUxic27BCx2q.qFWHCkerCds2TTYfwYFs9rJszHY3UzyWu2qsLa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `photo` char(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `user_name`, `email`, `password`, `type`, `created_at`, `photo`, `status`) VALUES
(1, 'Rachad Lifa', 'Rachad-cust7', 'rachad@gmail.com', '$2y$10$lbd.LMzjG1A1JWdJy.JGreNAgoEPIdhRZGDO0x7U.GU3hr/MzhiEC', 0, '2020-02-15', 'images/profiles/641ce72a2b733.jpg', 1),
(2, 'Mohamed', 'Mohamed-admin', 'admin@admin.com', '$2y$10$xPYlXKyOq/Uog/U2ZGn4iuMtND7CWJPWOOrBIXBeLt66dVIAxu8Ty', 1, '2012-01-01', 'images/profiles/641ce9de7c792.jpeg', 1),
(3, 'chaker', 'chaker-seller', 'chaker@gmail.com', '$2y$10$xPYlXKyOq/Uog/U2ZGn4iuMtND7CWJPWOOrBIXBeLt66dVIAxu8Ty', 2, '2012-01-01', 'images/profiles/seller1.png', 1),
(5, 'Smair', 'samir-seller', 'samir@gmail.com', '$2y$10$vtY4IWAq7rZN1BhDPMPqwOCp9dS7YbVqSnmzCwNkF5susQybHWXZW', 2, '2023-03-20', 'images/profiles/seller2.jpg', 1),
(6, 'Ahmed', 'Ahmed-seller', 'ahmed@gmail.com', '$2y$10$6fq0HpB4J0B.iJXwvoxWhON9UhpTWgMqilWAUAtLSGTFkc5M9EfUa', 2, '2023-03-20', 'images/profiles/seller3.jpg', 1),
(7, 'Aymen', 'amen-seller', 'aymen@gmail.com', '$2y$10$9rZO63gsiJ7NRHv24qmDrejGHvsQ4k5AkOdxKrgXkzEbVixVcwvAS', 2, '2023-03-21', 'images/profiles/seller4.jpg', 1),
(9, 'Ossama', 'Ossama', 'Ossma@gmail.com', '$2y$10$tmXxNls/lhLEAbZO8J7PH.VrRQGPjMLKcHpOoHfTXMOAxyMKivASS', 2, '2023-03-21', 'images/profiles/seller5.jpg', 1),
(10, 'Ibrahim', 'ibrahim-seller', 'ibrahim@gmail.com', '$2y$10$WMyQutBLHKlV0YM7cC1TW.W2SelzAkEJZBBy4/.O5hEvYuOFqt42S', 2, '2023-03-21', 'images/profiles/seller6.jpg', 1),
(11, 'Yassin', 'yassin-seller', 'yassin@gmail.com', '$2y$10$kth5.gvRa481n//ObNoX8.Jc.sg21brC3/JrBVUbAWhmSxmEX5tDC', 2, '2023-03-21', 'images/profiles/seller7.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `user` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
