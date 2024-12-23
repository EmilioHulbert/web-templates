-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2022 at 06:11 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(2, 1, 'Hamim Al Fardin', '0153399595', 'hamim.al.fardin@gmail.com', 'cash on delivery', 'flat no. Mirpur 12, road: 23, Dhaka, Dhaka, Bangladesh - 1216', 'Xiaomi Mijia Dafang Square IP Camera (3490 x 1) - ', 3490, '2022-09-12', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image_01`, `image_02`, `image_03`) VALUES
(1, 'Samsung Galaxy Z Fold4 smartphone', 'Brand	Samsung\r\nSKU	SGZF4\r\nOffers	\r\nAdditional Benefits\r\n1-year screen replacement: Tk.25500\r\nProtector film service- warranty coverage: Free 1-time protector flim replacement\r\nExpress Delivery	No\r\nWarranty Information	12 Months Official Warranty\r\nEmi Available	18 Months\r\nDisplay Size (Inches)	6.00\r\nFront Camera	4 MP\r\nCover Camera	10MP\r\nSystem Storage	256 GB\r\nRAM(GB)	12GB\r\nSIM Card	Nano-SIM & dual stand-by\r\nProcessor	Qualcomm SM8475 Snapdragon 8+ Gen 1 (4 nm)\r\nConnectivity	Wi-Fi 802.11 a/b/g/n/ac', 239999, 'p1.jpg', 'p2.jpg', 'p3.jpg'),
(2, 'realme 9 Pro+ smartphone', 'Specifications:\r\nOperating System: realme UI 3.0 | Based on Android 12\r\nProcessor: MediaTek Dimensity 920 5G Processor\r\nCPU: Octa-core, 6nm, up to 2.5GHz\r\nGPU: Arm Mali-G68 MC4\r\nRAM: Up to 13GB (8GB+5GB) Dynamic RAM\r\nROM: 128GB UFS 2.2\r\nNetwork: 2G/3G/4G/5G\r\nSim Slot: 2 Nano Card Slots\r\nRear Camera: 50MP+2MP+8MP\r\nRear Camera Mechanism: Sony IMX766 Sensor, F/1.8 Aperture, OIS (Primary Camera) | f/2.4 aperture, EIS, 88.8° FOV (Macro Lens) | f/2.2, 5P Lens, EIS, 119° FOV (Ultra Wide-angle Lens)\r\nFr', 39990, 'p11.jpg', 'p12.jpg', 'p13.jpg'),
(3, 'Redmi Note 11 smartphone', 'Brand	Xiaomi\r\nSKU	RDMN11464GB\r\nOffers	Offer Logic: Checkout OR 0% EMI\r\nExpress Delivery	No\r\nWarranty Information	12 Months Official Warranty\r\nEmi Available	3 Months\r\nDisplay Size (Inches)	6.43\r\nFront Camera	13 MP\r\nSystem Storage	64\r\nRAM(GB)	4\r\nSIM Card	Nano-SIM & dual stand-by\r\nProcessor	Qualcomm Snapdragon 680\r\nCPU Speed(Ghz)	Octa-core CPU, up to 2.4GHz\r\nConnectivity	802.11a/b/g/n/ac | Bluetooth: 5.0 | GPS\r\nBattery mAh	5000mAh (typ) battery| 33W Pro fast charging | USB-C\r\nBack Camera	50MP+8MP+2', 19599, '21.jpg', '22.jpg', '23.jpg'),
(4, 'Apple iPad Pro 11 Wi-Fi laptop', 'Color	Silver\r\nRAM(GB)	8\r\nHard Disk	512GB SSD\r\nBrand	Apple\r\nWarranty Information	12 Months International & Local Warranty (Please preserve your box to claim warranty)', 199900, 'era.jpg', 'apple-mneq3zp-a-2.jpg', 'apple-mneq3zp-a-3.jpg'),
(5, 'RedmiBook 15 15.6” 11th generation Core i3 8GB RAM 256GB PCIe NVMe SSD laptop', 'RedmiBook 15 15.6” 11th generation Core i3 8GB RAM 256GB PCIe NVMe SSD Laptop', 49999, 'redmibook-15-15.6-11th-generation-core-i3-8gb-ram-256gb-pcie-nvme-ssd-laptop-3-9-22.jpg', 'rb15pro-2_1.jpg', 'oqwfu_1.jpg'),
(6, 'Sony 65A8H 65 Inch OLED 4K Ultra HD High Dynamic Range (HDR) Smart tv', 'Screen Size (inch, measured diagonally): 65&#34;(64.5&#34;) \r\nWi-Fi Standard: Wi-Fi Certified 802.11a/b/g/n/ac \r\nBluetooth profile support: Version 4.2; HID (mouse/keyboard connectivity)/HOGP (Low Energy device connectivity)/SPP (Serial Port Profile)/A2DP (stereo audio)/AVRCP (AV remote control) \r\nHDCP: HDCP 2.3 (for HDMI™ 1/2/3/4) \r\nHDMI Audio Return Channel (ARC): Yes (eARC/ARC) \r\nDisplay type: OLED \r\nViewing Angle: (X-Wide Angle) \r\nHDR (High Dynamic Range) compatibility: Yes (HDR10, HLG, Dolb', 234390, 'sony-65a8h-new.jpg', 'sony-a8h-oled-4k-ultra-hd-high-dynamic-range-_hdr_-smart-tv-2.jpg', 'sony-a8h-oled-4k-ultra-hd-high-dynamic-range-_hdr_-smart-tv-3.jpg'),
(7, 'Samsung QA65Q70A 65” QLED 4K Smart tv (2021)', 'Series: QLED Q70 Series\r\nDesign: AirSlim\r\nStand Type: Simple Plus-Wide\r\nScreen Size: 64.5&#34;\r\nResolution: 3,840 x 2,160\r\nHDR (High-Dynamic Range): Quantum HDR\r\nPicture Processor: Quantum Processor 4K\r\nAudio: Dolby\r\nSound Output (RMS): 20W\r\nSpeaker Type: 2CH\r\nWireless Connectivity: WiFi5 | BT4.2\r\nProcessor: Quantum Processor 4K\r\nApps Platform: Smart TV Powered by TIZEN™ with Bixby Voice, Apps and Full Web Browser\r\nHDMI Connections: 3\r\nUSB: 2\r\nEthernet (LAN) Port: Yes\r\nTypical Power Consumption:', 141700, 'samsung-65q70a-new.jpg', 'samsung-qa65q70a-uel-2.jpg', 'samsung-qa65q70a-uel-3.jpg'),
(8, 'Razer DeathAdder Essential Gaming mouse', 'Razer DeathAdder Essential Gaming Mouse\r\nKeys: Five independently programmable Hyperesponse buttons\r\nConnection Type: Wired\r\nOptical Sensor Resolution: True 6,400 DPI optical sensor\r\nCable Length: 1.8m / 5.91 ft\r\nAcceleration: Up to 220 inches per second (IPS) / 30 G\r\nButton: 5 Hyperesponse Buttons\r\nColor Option: Single-color green lighting\r\nUltrapolling: 1000 Hz Ultrapolling\r\nTracking Method: True 6,400 DPI Optical Sensor\r\nMechanical Switches: Razer™ Mechanical Mouse Switches with 10 million-cl', 1699, 'razer-deathadder-essential-nagad.jpg', 'razer-deathadder-essential-gaming-mouse.jpg-1.jpg', 'razer-deathadder-essential-gaming-mouse.jpg-3.jpg'),
(9, 'Rapoo V360 IR Optical Gaming mouse – Black', 'Main Features\r\n\r\nKeys: 7 buttons\r\nConnection Type: Wired\r\nOptical Sensor Resolution: 200-6200 DPI\r\nOthers: 9 Programmable Button\r\nGaming Features\r\n\r\nAcceleration: 30G\r\nColor Option: Approx. 16.8 million RGB colors\r\nTracking Method: PMW3327', 2499, 'rapoo-vpro-v360-gaming-mouse-_-black.jpg', 'rapoo-vpro-v360-gaming-mouse-_-black-4.jpg', 'rapoo-vpro-v360-gaming-mouse-_-black-3.jpg'),
(10, 'Amazfit Bip U Pro Smart Watch Global Version', 'Specification\r\nDial Shape: Rectangle\r\nDisplay Size:1.43&#34; / 3.6 cm\r\nDial Type: Digital\r\nGPS: Yes\r\nBattery Life: 9days\r\nWater Rating:5 ATM\r\nWeight:1.1 oz / 31 g (Watch Only)\r\nFeatures             \r\nBlood-oxygen Level Measurement\r\n60+ Sports Modes\r\n5 ATM Water-Resistance\r\n24/7 Heart Rate Monitoring\r\nSleep Quality Monitoring\r\nHigh-precision GPS\r\nPAI Health Assessment System\r\n50 Watch Faces\r\nAlexa Built-in\r\n', 5499, 'amazfit-bip-u-pro-smart-watch-global-version.jpg', 'bipupro-1.jpg', 'bipupro-2.jpg'),
(11, 'OnePlus Smart Watch Global Version', 'Display\r\n1.39 inch AMOLED\r\n454×454\r\n326 PPI\r\nWatch Case\r\n316L stainless steel\r\nWatch Strap\r\nFluoroelastomer strap\r\nSensor\r\nAcceleration sensor\r\nGyroscope sensor\r\nGeomagnetic sensor\r\nOptical heart rate and blood oxygen sensor\r\nAmbient light sensor\r\nAir pressure sensor\r\nCapacitance sensor\r\nPositioning\r\nGPS\r\nGLONASS\r\nGalileo\r\nBeidou\r\nConnectivity\r\nBT 5.0\r\nBLE/BR/EDR\r\nBattery\r\n402mAh\r\nBattery Life\r\nUp to 14 days for typical use.\r\n(The typical usage scenarios are decided based on the user habits. The', 13499, 'oneplus-smart-watch-global-version-3-9-22.jpg', 'oneplus-watch2.jpg', 'oneplus-watch3.jpg'),
(12, 'TP-Link Tapo C320WS 4MP Outdoor Wi-Fi Night Vision Security Camera', 'Specification\r\nNetwork\r\nSecurity 128 bit AES encryption with SSL/TLS\r\nWireless Rate: 11Mbps (802.11b) | 54Mbps (802.11g) | 150Mbps (802.11n)\r\nFrequency: 2.4 GHz\r\nWireless Security: WPA/WPA2-PSK\r\nActivity Notifications\r\nInput Trigger: Motion detection\r\nOutput Notification: Push notification\r\nVideo\r\nVideo Compression: H.264\r\nFrame Rate: 15fps\r\nVideo Streaming: 4MP', 4949, 'TapoC320WS_EU_1.0_01_normal_20210806074340s.png', 'TapoC320WS_EU_1.0_03_normal_20210806074412p.jpg', 'Tapo-C320WS(EU)1.0_normal_20210806074845n.png'),
(13, 'Xiaomi Mijia Dafang Square IP Camera', 'Lens angle: 120°\r\nResolution: 1080P\r\nFocal length: 2.3mm\r\nMonitoring Level (Horizontal): 360°\r\nMonitoring Level (Vertical): 93°\r\nMotion Detection Distance: 9M\r\nVideo Resolution: 1080P HD (1920 x 1080)\r\nFrame Rate (FPS): 15fps\r\nNight Vision: 6 Infrared LED, 960nm, 0.5W', 3490, 'xiaomi-mijia-dafang-square-ip-camera-new.jpg', 'xiaomi-mijia-dafang-square-ip-camera-new-4.jpg', 'xiaomi-mijia-dafang-square-ip-camera-new-2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Hamim Al Fardin', 'hamim.al.fardin@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`) VALUES
(1, 1, 1, 'Samsung Galaxy Z Fold4 smartphone', 239999, 'p1.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
