-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2024 at 07:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flowershop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_username` varchar(100) NOT NULL,
  `admin_password` text NOT NULL,
  `admin_email` varchar(100) DEFAULT NULL,
  `admin_phone` varchar(12) DEFAULT NULL,
  `admin_fullname` text DEFAULT NULL,
  `active` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_username`, `admin_password`, `admin_email`, `admin_phone`, `admin_fullname`, `active`) VALUES
('admin', '$2y$10$YKUb72m8pPkF/aUrRfT8F.deJ1N3VfiLUQTfWYCEyKq/uCfUUL2Ca', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cate_ID` int(11) NOT NULL,
  `cate_name` varchar(100) NOT NULL,
  `cate_img_link` varchar(100) DEFAULT NULL,
  `cate_desc` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cate_ID`, `cate_name`, `cate_img_link`, `cate_desc`) VALUES
(1, 'Grand Opening Flower', NULL, NULL),
(2, 'Wedding Flower', NULL, NULL),
(3, 'Valetine Flower', NULL, NULL),
(4, 'Graduation Flower', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_username` varchar(50) NOT NULL,
  `customer_password` text NOT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `customer_phone` varchar(12) DEFAULT NULL,
  `customer_fullname` text DEFAULT NULL,
  `customer_address` text DEFAULT NULL,
  `customer_district` varchar(50) DEFAULT NULL,
  `customer_city` varchar(50) DEFAULT NULL,
  `customer_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_username`, `customer_password`, `customer_email`, `customer_phone`, `customer_fullname`, `customer_address`, `customer_district`, `customer_city`, `customer_status`) VALUES
('chinchin2109Haha', 'ce67443fc5c149c71d2320ed91656f4c', 'chinchin2109Haha@gmail.com', NULL, NULL, NULL, NULL, NULL, 1),
('hongphucledoan', 'd198271e650a2776a9654fec644cd60c', 'hongphucledoan@gmail.com', '0348009880', 'Lê Đoàn Hồng Phúc', '818/75 Xô Viết Nghệ Tĩnh, Phường 25', 'Quận Bình Thạnh', 'TPHCM', 1),
('quynhhuong', 'e3e1f591407fe0e980ede6f1e441a8bc', 'huongnguyen@gmail.com', NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_ID` int(11) NOT NULL,
  `customer_username` varchar(50) NOT NULL,
  `order_date` date NOT NULL,
  `order_status` tinyint(4) NOT NULL,
  `order_total_price` double NOT NULL,
  `order_payment_method` varchar(50) DEFAULT NULL,
  `order_address` text DEFAULT NULL,
  `order_district` varchar(50) DEFAULT NULL,
  `order_city` varchar(50) DEFAULT NULL,
  `order_receiver` text DEFAULT NULL,
  `order_phone` varchar(12) DEFAULT NULL,
  `order_email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_ID`, `customer_username`, `order_date`, `order_status`, `order_total_price`, `order_payment_method`, `order_address`, `order_district`, `order_city`, `order_receiver`, `order_phone`, `order_email`) VALUES
(1, 'hongphucledoan', '2024-05-12', 1, 15065000, 'cod', '818/75 Xô Viết Nghệ Tĩnh, Phường 25', 'Quận Bình Thạnh', 'TPHCM', 'Lê Đoàn Hồng Phúc', '0348009880', 'hongphucledoan@gmail.com'),
(2, 'quynhhuong', '2024-05-01', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `generate_order_ID` BEFORE INSERT ON `orders` FOR EACH ROW BEGIN
	DECLARE max_order_id INT;
    
    -- Lấy số order_ID lớn nhất từ bảng
    SELECT MAX(order_ID) INTO max_order_id FROM orders;
    
    -- Nếu không có order_ID nào tồn tại, gán giá trị đầu tiên là 1
    IF max_order_id IS NULL THEN
        SET max_order_id = 1;
    END IF;
    
    
    -- Tăng giá trị order_ID lớn nhất lên 1 và cập nhật cho bản ghi mới
    SET NEW.order_ID = max_order_id + 1;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `od_ID` int(11) NOT NULL,
  `prd_ID` char(5) NOT NULL,
  `od_name` varchar(100) NOT NULL,
  `od_img` varchar(100) NOT NULL,
  `order_ID` int(11) NOT NULL,
  `od_quantity` int(11) NOT NULL,
  `od_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`od_ID`, `prd_ID`, `od_name`, `od_img`, `order_ID`, `od_quantity`, `od_price`) VALUES
(101, 'DC001', 'Sweet Love(Tulip)', 'images/WeddingFlower/SweetLoveTulip.jpg', 1, 3, 880000),
(103, 'TN003', 'Greeny', 'images/GraduationFlowers/Greeny.jpg', 1, 2, 680000),
(104, 'TN001', 'Mother\'s Dream', 'images/GraduationFlowers/MothersDream.jpg', 1, 2, 700000),
(105, 'TN002', 'Miracle', 'images/GraduationFlowers/Miracle.jpg', 1, 3, 875000),
(106, 'TN004', 'Oceanic', 'images/GraduationFlowers/Oceanic.jpg', 1, 2, 570000),
(107, 'TN005', 'Sunny Day', 'images/GraduationFlowers/SunnyDays.jpg', 1, 3, 820000),
(108, 'TN006', 'New Journey', 'images/GraduationFlowers/TheNewJourney.jpg', 1, 1, 760000),
(109, 'TN007', 'Warm Affection', 'images/GraduationFlowers/WarmAffection.jpg', 1, 4, 670000),
(202, 'TN004', 'Oceanic', 'images/GraduationFlowers/Oceanic.jpg', 2, 0, 570000);

--
-- Triggers `order_details`
--
DELIMITER $$
CREATE TRIGGER `compare_od_and_prd` BEFORE INSERT ON `order_details` FOR EACH ROW BEGIN
    DECLARE prd_price_val DECIMAL(10,2);
    DECLARE prd_image VARCHAR(100);
    DECLARE prd_name_val VARCHAR(100);
    
    -- Lấy giá trị prd_price tương ứng với prd_ID được thêm vào order_details
    SELECT prd_price INTO prd_price_val
    FROM products
    WHERE prd_ID = NEW.prd_ID;
    
    -- Cập nhật giá trị của od_price bằng giá trị mới lấy được
    SET NEW.od_price = prd_price_val;
    
    -- Lấy ảnh sản phẩm từ bảng products dựa trên prd_ID của sản phẩm mới được thêm vào
    SELECT prd_img INTO prd_image 
    FROM products 
    WHERE prd_ID = NEW.prd_ID;
    -- Cập nhật giá trị cho cột od_img của sản phẩm mới được thêm vào
    SET NEW.od_img = prd_image;
    
    -- Lấy tên sản phẩm từ bảng products dựa trên prd_ID của sản phẩm mới được thêm vào
    SELECT prd_name INTO prd_name_val 
    FROM products 
    WHERE prd_ID = NEW.prd_ID;
    -- Cập nhật giá trị cho cột od_name của sản phẩm mới được thêm vào
    SET NEW.od_name = prd_name_val;
    
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `generate_od_ID` BEFORE INSERT ON `order_details` FOR EACH ROW BEGIN
    DECLARE new_od_ID INT;
    SET new_od_ID = NEW.order_ID * 100 + (SELECT IFNULL(MAX(od_ID % 100), 0) + 1 FROM order_details WHERE order_ID = NEW.order_ID);
    SET NEW.od_ID = new_od_ID;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `cate_ID` int(11) NOT NULL,
  `prd_ID` char(5) NOT NULL,
  `prd_name` varchar(100) NOT NULL,
  `prd_desc` varchar(200) DEFAULT NULL,
  `prd_img` varchar(100) DEFAULT NULL,
  `prd_status` decimal(10,0) DEFAULT NULL,
  `prd_size` varchar(10) DEFAULT NULL,
  `prd_price` double DEFAULT NULL,
  `prd_description` varchar(355) DEFAULT NULL,
  `prd_detail` varchar(355) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`cate_ID`, `prd_ID`, `prd_name`, `prd_desc`, `prd_img`, `prd_status`, `prd_size`, `prd_price`, `prd_description`, `prd_detail`) VALUES
(2, 'DC001', 'Sweet Love(Tulip)', NULL, 'images/WeddingFlower/SweetLoveTulip.jpg', NULL, NULL, 880000, 'The Tulip bouquet with sweet pink tones is like a hope for a full, romantic, and adorable love. If their smile, their gaze is the miraculous cure that dispels life\'s worries, then spend a little time surprising them and adding happiness to that smile. The bouquet consists of sweet pink tulips, pure white statice, and adorable baby\'s breath.', '{\r\n    \"Pink tulips\": \"10 stems\",\r\n    \"White baby\'s breath\": \"50 grams\"\r\n}\r\n'),
(2, 'DC002', 'Together', NULL, 'images/WeddingFlower/TogetherForever.jpg', NULL, NULL, 670000, 'Roses are always a symbol of survival, eternity, representing intense, eternal, unchanging love. Don\'t hesitate to send this adorable bouquet to your loved one.', '{\r\n    \"Pastel pink roses\": \"20 stems\",\r\n    \"Supplementary flowers\": \"Purple statice\"\r\n}'),
(2, 'DC003', 'Complete', NULL, 'images/WeddingFlower/Complete.jpg', NULL, NULL, 810000, 'The bouquet is designed with vibrant red roses, romantic as a dream. It\'s not easy to find someone who loves and cares for you, so cherish and let this bouquet help you convey your sincere thanks to them. These fresh, sweet flowers symbolize your beautiful and sweet love.', '{\r\n    \"Red roses\": \"101 stems\",\r\n    \"White baby\'s breath\": \"300 grams\"\r\n}'),
(2, 'DC004', 'Enternal Love', NULL, 'images/WeddingFlower/EnternalLove.jpg', NULL, NULL, 640000, 'Eternal love, never apart, is the desire of every couple. The Eternal Love bouquet is designed with 33 blue roses, symbolizing eternal, unchanging love. The blue roses of Eternal Love are the perfect choice to give to your wife or girlfriend on birthdays or wedding anniversaries.', '{\r\n    \"Imported blue roses\": \"35 stems\"\r\n  }'),
(2, 'DC005', 'First Love', NULL, 'images/WeddingFlower/FirstLove.jpg', NULL, NULL, 910000, 'White roses represent the budding, pure, and sincere love. The \"First Love\" bouquet of white roses is the perfect choice to give to your newly met girlfriend.', '{\r\n    \"White roses\": \"15 stems\",\r\n    \"White chrysanthemums\": \"3 stems\",\r\n    \"Silver leaves\": \"4 stems\"\r\n }'),
(2, 'DC006', 'Lonely Dress', NULL, 'images/WeddingFlower/LovelyDress.jpg', NULL, NULL, 720000, 'The Lovely Dress bouquet features a pastel Pink - Gray tone as the main theme. It\'s extremely sweet and adorable, combining 10 stems of pastel cream roses, 10 stems of blush pink roses, green baby\'s breath, pink statice, white baby\'s breath, various decorative leaves. It\'s suitable for many important occasions such as birthdays, love anniversaries, prop', '{\r\n    \"Pastel cream roses\": \"30 stems\",\r\n    \"White statice\": \"5 stems\",\r\n    \"Various decorative leaves\": \"Silver leaves\"\r\n}'),
(2, 'DC007', 'My Princess', NULL, 'images/WeddingFlower/MyPrincess.jpg', NULL, NULL, 690000, 'Premium O\'Hara roses have a shape like lipstick with a gentle but elegant pink color. The bouquet symbolizes the ironclad heart in love and friendship. The My Princess bouquet is designed with special O\'Hara roses accompanied by cedar leaves, making it a meaningful gift for your loved ones.', '{\r\n    \"O\'Hara roses\": \"30 stems\",\r\n    \"Supplementary flowers\": \"Silver leaves\"\r\n  }'),
(2, 'DC008', 'Only Love', NULL, 'images/WeddingFlower/OnlyLove.jpg', NULL, NULL, 730000, 'Only one person in my heart\\\" is the message that the Only Love bouquet wants to convey. Designed with only 10 bright red roses, it symbolizes intense, sincere love. Love is always about sharing, caring, and understanding your loved one. Don\'t hesitate to send them the most sincere love with a red rose adorned with other adorable supplementary flowers.', '{\r\n    \"Red roses\": \"10 stems\",\r\n    \"Supplementary flowers\": \"Silver leaves\"\r\n}'),
(2, 'DC009', 'Sweet Love', NULL, 'images/WeddingFlower/SweetLove.jpg', NULL, NULL, 950000, 'The bouquet is designed with adorable sweetheart roses, which are very popular. It symbolizes the message \"You are my only love, and my feelings for you are the deepest, without any hesitation or calculation. No matter what happens, whether sad or happy, I will always be by your side till the end.\" Don\'t wait, let the bouquet convey the sweetest love me', '{\r\n    \"Sweetheart roses\": \"30 stems\",\r\n    \"Pink carnations\": \"5 stems\"\r\n}'),
(2, 'DC010', 'Sweet And Lonely', NULL, 'images/WeddingFlower/SweetAndLonely.jpg', NULL, NULL, 760000, 'As dawn breaks and the sun rises,\" red roses, the brightest ones, wrapped in cute pink paper like the most sincere message of love. Amidst life\'s challenges, a little sharing and sending of the utmost love will warm their heart and give them extra strength.', '{\r\n    \"Red roses\": \"20 stems\",\r\n    \"Supplementary flowers\": \"Waxflowers\"\r\n}'),
(1, 'KT001', 'Radiant Day', NULL, 'images/GrandOpeningFlower/RadiantDayFlower.jpg', NULL, NULL, 1000000, 'The Radiant Day Flower Basket features the red color of roses, the purple hue of carnations, and Mokara orchids as the dominant colors, creating a vibrant yet elegant combination. Paired with sunflowers, lilies, and decorative foliage, it presents an impressive gift for any recipient.', '{\r\n    \"Red roses\": \"20 stems\",\r\n    \"Purple carnations\": \"9 stems\",\r\n    \"Purple Mokara orchids\": \"6 stems\",\r\n    \"Sunflowers\": \"4 stems\",\r\n    \"White lilies\": \"4 stems\",\r\n    \"Green chrysanthemums\": \"16 stems\",\r\n    \"Silver leaves\": \"8 stems\"\r\n}'),
(1, 'KT002', 'Smooth Sailing', NULL, 'images/GrandOpeningFlower/SmoothSailing.jpg', NULL, NULL, 690000, 'A jubilant ode crafted from the freshest blooms, the Smooth Sailing Opening Flower Shelf is a tribute to joy, crafted from a selection of the most beautiful flowers. It sends warm wishes and heartfelt congratulations to friends, colleagues, or partners on their grand opening, inauguration, or anniversary.', '{\r\n  \"Orange money flowers\": \"15 stems\",\r\n  \"Orchids\": \"1 stem (6-8 blooms/stem)\",\r\n  \"Yellow lilies\": \"10 stems\",\r\n  \"Pink lac thần roses\": \"20 stems\"\r\n}'),
(1, 'KT003', 'Wishful Prosperity', NULL, 'images/GrandOpeningFlower/WishfulProsperity.jpg', NULL, NULL, 640000, 'Designed with red roses, red peonies, and red Mokara orchids combined with various decorative foliage, the Wishful Prosperity Flower Shelf, with its tone of red symbolizing luck, passion, and enthusiasm, is a perfect choice for grand opening ceremonies or business inaugurations.', '{\r\n  \"Red roses\": \"25 stems\",\r\n  \"Red peony leaves\": \"10 stems\",\r\n  \"Red Mokara orchids\": \"10 stems\"\r\n}'),
(1, 'KT004', 'Golden Time', NULL, 'images/GrandOpeningFlower/GoldenTime.jpg', NULL, NULL, 920000, 'With its refreshing green theme, the Golden Time Opening Flower Shelf, crafted by skilled artisans, offers a unique and exquisite design. This shelf, a small source of joy and sincere wishes, spreads goodwill and happiness to its recipient on this significant day.', '{\r\n  \"Light green sprayed roses\": \"30 stems\",\r\n  \"White carnations\": \"20 stems\",\r\n  \"Green carnations\": \"10 stems\",\r\n  \"Light green sprayed daisies\": \"10 stems\",\r\n  \"White ping pong flowers\": \"15 stems\",\r\n  \"Bouvardia flowers\": \"8 stems\",\r\n  \"Ying-yang chrysanthemums\": \"10 stems\",\r\n  \"Light green baby\'s breath\": \"150 stems\"\r\n}'),
(1, 'KT005', 'Great Prosperity', NULL, 'images/GrandOpeningFlower/GreatProsperity.jpg', NULL, NULL, 830000, 'Adorned with white dendrobium orchids as highlights, this congratulatory flower shelf bursts with vitality and vibrant hues, symbolizing hope for a bright future filled with achievements and glorious victories.', '{\r\n  \"White single chrysanthemums\": \"5 stems\",\r\n  \"Deep pink single chrysanthemums\": \"15 stems\",\r\n  \"Red Ohara roses\": \"50 stems\",\r\n  \"Orange-edged roses\": \"30 stems\",\r\n  \"Clustered orange roses\": \"12 stems\",\r\n  \"Red paper lantern orchids\": \"20 stems\",\r\n  \"Lotus flowers\": \"10 stems\",\r\n  \"Bird of Paradise flowers\": \"10 stems\",\r\n  \"White phalaenopsis orch'),
(1, 'KT006', 'Lucky Charm', NULL, ' images/GrandOpeningFlower/LuckyCharm.jpg', NULL, NULL, 590000, 'The Lucky Charm Congratulations Flower Shelf is designed with cream roses, pink peonies, white denro orchids, and other colorful flowers, radiating joy and conveying heartfelt wishes for upcoming successes and auspicious beginnings.', '{\r\n    \"Purple daisies\": \"10 stems\",\r\n    \"Single chrysanthemums\": \"15 stems\",\r\n    \"Pink bouvardias\": \"10 stems\",\r\n    \"Coral roses\": \"50 stems\",\r\n    \"Purple roses\": \"50 stems\",\r\n    \"Pink Ohara roses\": \"30 stems\",\r\n    \"Phalaenopsis orchids\": \"10 stems\",\r\n    \"Money flowers\": \"20 stems\"\r\n}'),
(1, 'KT007', 'New Begining', NULL, 'images/GrandOpeningFlower/NewBegining.jpg', NULL, NULL, 800000, 'The New Beginning Grand Opening Flower Shelf is filled with well-wishes and prosperity for those who have supported and uplifted you in your endeavors. Designed with lucky flowers, it symbolizes success and good fortune for the new journey ahead.', '{\r\n  \"Spirit orange roses\": \"40 stems\",\r\n  \"Cream roses\": \"40 stems\",\r\n  \"Pink phalaenopsis orchids\": \"20 stems\",\r\n  \"White baby\'s breath\": \"100 grams\",\r\n  \"Various decorative foliage\": \"Silver leaves\"\r\n}'),
(1, 'KT008', 'New Staircase', NULL, 'images/GrandOpeningFlower/NewStaircase.jpg', NULL, NULL, 780000, 'Designed in a modern style with bright yellow tones from roses, sunflowers, ping pong flowers, and various decorative foliage, the New Staircase Opening Flower Shelf brings both elegance and profound meaning, wishing for prosperity and luck in the new venture.', '{\r\n  \"Yellow roses\": \"20 stems\",\r\n  \"Sunflowers\": \"10 stems\",\r\n  \"Pink money flowers\": \"20 stems\"\r\n}'),
(1, 'KT009', 'Prosperity', NULL, 'images/GrandOpeningFlower/Prosperity.jpg', NULL, NULL, 940000, 'This shelf, adorned with vibrant and colorful flowers, brings forth a sense of freshness, brightness, and anticipation for unexpected success. Designed with a special message, it expresses joy and well-wishes for the recipient\'s upcoming successes and new beginnings.', '{\r\n  \"Orange money flowers\": \"15 stems\",\r\n  \"Orchids\": \"1 stem (6-8 blooms/stem)\",\r\n  \"Yellow lilies\": \"10 stems\",\r\n  \"Pink lac thần roses\": \"20 stems\"\r\n}'),
(1, 'KT010', 'Prosperous', NULL, 'images/GrandOpeningFlower/Prosperous.jpg', NULL, NULL, 870000, 'With a theme of bright yellow, the Prosperous Opening Flower Shelf is far from simple. Crafted with artistic flair, it delivers a unique and distinctive design, spreading good wishes and happiness to its recipient on this significant occasion.', '{\r\n  \"Sunflowers\": \"15 stems\",\r\n  \"Gold money flowers\": \"15 stems\",\r\n  \"Red money flowers\": \"15 stems\"\r\n}'),
(4, 'TN001', 'Mother\'s Dream', NULL, 'images/GraduationFlowers/MothersDream.jpg', NULL, '', 700000, 'Soothing and peaceful are the feelings that \"Mother\'s Dream\" brings to the recipient. White roses and white orchids symbolize purity along with a touch of gentle, soft purple. \"Mother\'s dream\" is like a sincere wish for the recipient: \"Every day that comes will be a peaceful and lucky day\"', '{\r\n  \"Sunflowers\": \"5 stems\",\r\n  \"Pink carnations\": \"10 stems\",\r\n  \"Cream roses\": \"5 stems\"\r\n}\r\n'),
(4, 'TN002', 'Miracle', NULL, 'images/GraduationFlowers/Miracle.jpg', NULL, '', 875000, 'The Miracle bouquet is designed with purple statice, representing loyal love, cuteness, strength, and miracles. It\'s a perfect choice to give to girls on special occasions like birthdays, graduation ceremonies, or anniversaries.', '{\n  \"Purple statice\": \"3 bunches\"\n}\n'),
(4, 'TN003', 'Greeny', NULL, 'images/GraduationFlowers/Greeny.jpg', NULL, NULL, 680000, 'Greeny is designed with green curly chrysanthemums, symbolizing luck, success, and fortune. It\'s a perfect choice to give to a close female friend on birthdays or graduation ceremonies.', '{\n  \"Green curly chrysanthemums\": \"20 stems\"\n}'),
(4, 'TN004', 'Oceanic', NULL, 'images/GraduationFlowers/Oceanic.jpg', NULL, NULL, 570000, 'Oceanic is the perfect combination of blue tinted roses symbolizing eternal love, with white baby\'s breath and tana chrysanthemums. The Oceanic bouquet is a perfect choice to give to your wife, girlfriend on birthdays or any special day of the year.', '{\r\n  \"Blue tinted roses\": \"6 stems\",\r\n  \"White baby\'s breath\": \"10 stems\",\r\n  \"Other supplementary flowers\": \"Statice\"\r\n}\r\n'),
(4, 'TN005', 'Sunny Day', NULL, 'images/GraduationFlowers/SunnyDays.jpg', NULL, NULL, 820000, 'Sunny Days, like a belief in brighter tomorrows, pointing forward, true to the meaning of Sunflowers. Even if today is dark and gloomy, the sun still rises, and we keep moving forward.', '{\n  \"Sunflowers\": \"6 stems\",\n  \"White baby\'s breath\": \"150 grams\"\n}'),
(4, 'TN006', 'New Journey', NULL, 'images/GraduationFlowers/TheNewJourney.jpg', NULL, NULL, 760000, 'The New Journey bouquet is designed with sunflowers combined with various supplementary flowers. This is a perfect choice to give to close friends, colleagues on birthdays or graduation ceremonies.', '{\r\n  \"Sunflowers\": \"10 stems\",\r\n  \"Supplementary flowers\": \"Liatris\"\r\n}\r\n'),
(4, 'TN007', 'Warm Affection', NULL, 'images/GraduationFlowers/WarmAffection.jpg', NULL, NULL, 670000, 'On the journey of career, education, or beginnings, the sincere wishes and concerns from friends, family, or loved ones are always the most precious gift. Flower Corner would like to help you convey those meaningful wishes with this bright sunflower bouquet.', '{\r\n  \"Sunflowers\": \"10 stems\",\r\n  \"Supplementary flowers\": \"Red amaranths\"\r\n}\r\n'),
(4, 'TN008', 'Colorful', NULL, 'images/GraduationFlowers/Colorful.jpg', NULL, NULL, 840000, 'Colorful is a vibrant bouquet with sunflowers, pink carnations, cream roses combined with various supplementary flowers. It\'s a perfect choice to give to relatives, friends on any occasion.', '{\r\n  \"Sunflowers\": \"3 stems\",\r\n  \"Pink statice\": \"5 stems\",\r\n  \"Pink carnations\": \"10 stems\",\r\n  \"Cream roses\": \"5 stems\",\r\n  \"Other supplementary flowers\": \"Silver leaves\"\r\n}'),
(4, 'TN009', 'Cozy', NULL, 'images/GraduationFlowers/Cozy.jpg', NULL, '', 580000, 'Cozy is a bouquet with sweet colors, combining sunflowers and pink carnations, bringing joy, optimism, love for life, and the message \"Always believe in a brighter tomorrow.\"', '{\r\n  \"Sunflowers\": \"3 stems\",\r\n  \"Orange-edged pink carnations\": \"5 stems\",\r\n  \"Other supplementary flowers\": \"Silver leaves\"\r\n}'),
(4, 'TN010', 'Gracias', NULL, 'images/GraduationFlowers/Gracias.jpg ', NULL, '', 790000, 'Sunflowers always bring a fresh, positive, and warm energy. The Gracias bouquet symbolizes that no matter how life goes, good things will eventually come.', '{\r\n  \"Sunflowers\": \"10 stems\",\r\n  \"Supplementary flowers\": \"Purple asters\"\r\n}\r\n'),
(3, 'VL001', 'Sweet Pink', NULL, 'images/ValentineFlower/SweetPink.jpg', NULL, NULL, 875000, 'If red isn\'t her favorite color, then this bouquet of 100 sweet pink roses will surely be a perfect choice for her. A stressful and pressure-filled day will definitely become brighter and full of joy thanks to this lovely bouquet.', '{\n  \"Pastel pink roses\": \"100 stems\",\n  \"White baby\'s breath\": \"300 grams\"\n}\n'),
(3, 'VL002', 'Sunshine Beam', NULL, 'images/ValentineFlower/SunshineBeam.jpg', NULL, NULL, 920000, 'You are the sunshine of my life, illuminating the darkest moments within me, making me stronger than ever. Give her the Sunshine Beam bouquet instead of words of thanks!', '{\n  \"Red roses\": \"25 stems\",\n  \"Supplementary flowers\": \"Silver leaves\"\n}'),
(3, 'VL003', 'Togerther Love', NULL, 'images/ValentineFlower/Together.jpg', NULL, NULL, 600000, 'A bouquet of 50 vibrant red roses wrapped in lovely pink paper, conveying the most sincere message of love. Amidst life\'s challenges, a little sharing and sending of heartfelt love will warm the heart and give extra strength to your beloved.', '{\n  \"Red roses\": \"50 stems\",\n  \"White baby\'s breath\": \"150 grams\"\n}\n'),
(3, 'VL004', 'True Love', NULL, 'images/ValentineFlower/TrueLove.jpg', NULL, NULL, 790000, 'Love is from caring for each other, understanding, empathy, and sharing - voluntarily, sincerely, and elegantly. Sometimes, to show your care is to present a overflowing love bouquet made of roses on birthdays or anniversaries.', '{\n  \"Red roses\": \"100 stems\"\n}\n'),
(3, 'VL005', 'Bright Day', NULL, 'images/ValentineFlower/BrightDay.jpg', NULL, NULL, 710000, 'Wherever you are, red roses always represent an intense, romantic, and passionate love. Red roses convey deep emotions - it could be love, expectation, or desire. The Bright Day bouquet with 50 red roses will be a meaningful and unforgettable gift for your better half.', '{\n  \"Red roses\": \"50 stems\",\n  \"Supplementary flowers\": \"Silver leaves\"\n}\n'),
(3, 'VL006', 'Cuteness', NULL, 'images/ValentineFlower/Cuteness.jpg', NULL, NULL, 690000, 'Roses symbolize happiness, joy, and luck. A sweet and adorable bouquet of 50 pink roses will be a meaningful congratulations and best wishes to those who have always stood by you in life. Love expressed through flowers becomes meaningful.', '{\n  \"Pink roses\": \"50 stems\",\n  \"White baby\'s breath\": \"150 grams\"\n}\n'),
(3, 'VL007', 'Forever Love', NULL, 'images/ValentineFlower/Forever.jpg', NULL, NULL, 580000, '\"I love you to the moon and back\". This flowers bouquet includes 99 Pastel Roses to help you express your permanent love to your dear!', '{\n  \"Pastel pink roses\": \"99 stems\"\n}\n'),
(3, 'VL008', 'Dress Love', NULL, 'images/ValentineFlower/LovelyDress.jpg', NULL, NULL, 750000, 'The Lovely Dress bouquet with pastel Pink - Gray tones as the dominant colors. Extremely sweet and adorable. It\'s a combination of 10 pastel pink roses, 10 blush pink roses, green carnations, pink carnations, white baby\'s breath, various decorative leaves, suitable for many important occasions such as birthdays, love anniversaries, confession, proposals', '{\n  \"Pastel pink roses\": \"30 stems\",\n  \"White statice flowers\": null,\n  \"Supplementary flowers\": \"Silver leaves\"\n}\n'),
(3, 'VL009', 'Passionate Heart', NULL, 'images/ValentineFlower/PassionateHeart.jpg', NULL, NULL, 1100000, 'Are you deeply immersed in a love filled with passion, with a heart burning more fiercely than ever? To express your sincere love for them, the Passionate Heart bouquet with 30 vibrant red roses is the perfect choice.', '{\n  \"Red roses\": \"30 stems\",\n  \"Supplementary flowers\": \"Purple starflowers\"\n}\n'),
(3, 'VL010', 'Season Love', NULL, 'images/ValentineFlower/SeasonOfLove.jpg', NULL, NULL, 640000, 'Their smile, their eyes always sparkle in your heart but you\'ve never dared to say it. Don\'t be shy, you don\'t need much, just a cute bouquet of roses and a card with a sweet message will help you express your love sincerely. A combination of 50 red roses, featuring gentle pink roses, adorable baby\'s breath, and romantic salem purple, brings the atmosph', '{\n  \"Red roses\": \"50 stems\",\n  \"White baby\'s breath\": \"100 grams\",\n  \"Supplementary flowers\": \"Silver leaves\"\n}\n');

--
-- Triggers `products`
--
DELIMITER $$
CREATE TRIGGER `generate_prd_id` BEFORE INSERT ON `products` FOR EACH ROW BEGIN
    DECLARE last_id CHAR(3);
    DECLARE new_id CHAR(5);

    SET last_id = (
        SELECT SUBSTRING(prd_ID, 3) 
        FROM products 
        WHERE cate_ID = NEW.cate_ID 
        ORDER BY prd_ID DESC 
        LIMIT 1
    );

    CASE NEW.cate_ID
        WHEN 1 THEN SET new_id = CONCAT('KT', LPAD(IFNULL(CAST(last_id AS UNSIGNED) + 1, 1), 3, '0'));
        WHEN 2 THEN SET new_id = CONCAT('DC', LPAD(IFNULL(CAST(last_id AS UNSIGNED) + 1, 1), 3, '0'));
        WHEN 3 THEN SET new_id = CONCAT('VL', LPAD(IFNULL(CAST(last_id AS UNSIGNED) + 1, 1), 3, '0'));
        WHEN 4 THEN SET new_id = CONCAT('TN', LPAD(IFNULL(CAST(last_id AS UNSIGNED) + 1, 1), 3, '0'));
        ELSE SET new_id = NULL; -- Handle invalid category ID
    END CASE;

    SET NEW.prd_ID = new_id;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_username`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cate_ID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_username`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_ID`),
  ADD KEY `customer_username` (`customer_username`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`od_ID`),
  ADD KEY `prd_ID` (`prd_ID`),
  ADD KEY `order_ID` (`order_ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prd_ID`),
  ADD KEY `cate_ID` (`cate_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cate_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_username`) REFERENCES `customers` (`customer_username`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`prd_ID`) REFERENCES `products` (`prd_ID`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_ID`) REFERENCES `orders` (`order_ID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cate_ID`) REFERENCES `categories` (`cate_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
