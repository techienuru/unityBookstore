-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2024 at 07:44 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unity_bookshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstname`, `lastname`, `username`, `email`, `password`, `created_date`) VALUES
(1, 'Ibrahim', 'Nurudeen', 'El-Nur', 'nur@gmail.com', '$2y$10$vS.z4Xp.MwRJ3vmTZy8j5uQdaRchqY.nsyxsD2XpImslLW1INh8ty', '2024-06-13 17:35:31'),
(2, 'Jibrin', 'Abdullahi', 'JB', 'jb@gmail.com', '$2y$10$q6WuRrcuOW/xZCL0OifZQ.xpOrpp651XEtHY09xZEiN4KqPp1vbbi', '2024-06-14 09:31:16');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `books_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`books_id`, `title`, `author`, `description`, `price`, `image`, `category_id`) VALUES
(1, 'The Friday Afternoon Club: A Family Memoir', 'Griffin Dunne', 'Griffin Dunneâ€™s memoir of growing up among larger-than-life characters in Hollywood and Manhattan finds wicked humor and glimmers of light in even the most painful of circumstances  At eight, Sean Connery saved him from drowning. At thirteen, desperate to hook up with Janis Joplin, he attended his aunt Joan Didion and uncle John Gregory Dunneâ€™s legendary LA launch party for Tom Wolfeâ€™s The Electric Kool-Aid Acid Test. At sixteen, he got kicked out of boarding school, ending his institutional education for good. In his early twenties, he shared an apartment in Manhattanâ€™s Hotel Des Artistes with his best friend and soulmate Carrie Fisher while she was filming some sci-fi movie called Star Wars and he was a struggling actor working as a popcorn concessionaire at Radio City Music Hall. A few years later, he produced and starred in the now-iconic film After Hours, directed by Martin Scorsese. In the midst of it all, Griffinâ€™s twenty-two-year-old sister, Dominique, a rising star i', '2500', 'books-images/Griffin Dunne.jpg', 1),
(3, 'The Uptown Local', 'Cory Leadbeater', 'All about The uptown Local written by an American', '790', 'books-images/The Uptown Local.jpg', 3),
(4, 'The Woman', 'Kristin Hannah ', 'A #1 bestseller on The New York Times, USA Today, Washington Post, and Los Angeles Times!', '8205', 'books-images/The woman.jpg', 4),
(5, 'Swan Song', 'Elin Hilderbrand ', 'The beloved #1 New York Times bestselling author brings her Nantucket novels to a brilliant finish: when rich strangers move to the island, social mayhemâ€”and a possible murder follow. Can Nantucketâ€™s best locals save the day, and their way of life?', '2070', 'books-images/Swan song.jpg', 3),
(6, 'Dad', 'Jeffrey Mason', 'The Gift Your Father Will Enjoy and Appreciate\r\nDad, I Want to Hear Your Story is the popular and cherished way for Fathers to share the memories and joys of their life while also creating a cherished legacy for you and the entire family.', '1600', 'books-images/Dad i want to.jpg', 8),
(7, 'On call', 'Anthony Fauci M.D.', '#1 New York Times Bestseller\r\n\r\nThe memoir by the doctor who became a beacon of hope for millions through the COVID pandemic, and whose six-decade career in high-level public service put him in the room with seven presidents\r\n', '730', 'books-images/On call.jpg', 8),
(8, 'On Call Principles and Protocols: Principles and Protocols', 'Shane A. Marshall MD FRCPC', 'Ideal for any on-call professional, resident, or medical student, this highly templated, best-selling reference covers the common problems youâ€™ll encounter while on call in the hospital. On Call Principles and Protocols, 7th Edition, by Drs. Shane A. Marshall and John Ruedy, provides key information in time-sensitive, challenging situations. Youâ€™ll gain speed, skill, and knowledge with every call - from diagnosing a difficult or life-threatening situation to prescribing the right medication.', '920', 'books-images/On call Protocol.jpg', 9),
(9, 'On Call Psychiatry: On Call Series', ' Carol A. Bernstein MD MAT ', 'Ideal for any on-call professional, resident, or medical student, this best-selling reference by Drs. Carol A. Bernstein, Molly E. Poag, and Mort Rubinstein covers the common problems youâ€™ll encounter while on call without direct supervision in the hospital. On Call Psychiatry, 4th Edition, fits perfectly in your pocket, ready to provide key information in time-sensitive, challenging situations. Youâ€™ll gain speed, skill, and knowledge with every call - from diagnosing a difficult or life-threatening situation to prescribing the right medication.', '9000', 'books-images/On call Psychiatry.jpg', 8);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `books_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `pickup_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `books_id`, `quantity`, `total`, `status`, `pickup_id`) VALUES
(5, '72cfd33320', 4, 4, 31420, 'Pickup', 1),
(8, '72cfd33320', 3, 1, 440, 'Pickup', 1),
(9, '72cfd33320', 1, 1, 2150, 'Pickup', 1),
(10, '72cfd33320', 4, 1, 7855, 'paid', NULL),
(11, '72cfd33320', 1, 1, 2150, 'paid', NULL),
(12, '72cfd33320', 4, 1, 7855, 'Pickup', 2),
(13, '72cfd33320', 1, 1, 2150, 'Pickup', 2),
(14, '72cfd33320', 4, 1, 7855, 'Pickup', 2),
(15, '72cfd33320', 1, 1, 2150, 'Pickup', 2),
(16, '72cfd33320', 5, 1, 1720, 'paid', NULL),
(17, '72cfd33320', 8, 2, 1140, 'paid', NULL),
(18, '72cfd33320', 9, 1, 8650, 'paid', NULL),
(19, '72cfd33320', 5, 1, 1720, 'paid', NULL),
(20, '72cfd33320', 4, 1, 7855, 'paid', NULL),
(21, '72cfd33320', 1, 4, 8600, 'Pickup', 3),
(22, '72cfd33320', 4, 1, 7855, 'Pickup', 3),
(23, '72cfd33320', 5, 1, 1720, 'Pickup', 4),
(24, '72cfd33320', 3, 1, 440, 'Pickup', 4),
(25, '72cfd33320', 1, 1, 2150, 'Pickup', 4);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `category_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'Biographies & Memoirs', 'Memoirs | Historical | Professionals & Academics | Arts & Literature | Community & Culture'),
(2, 'Children Books', 'Books for every age and stage'),
(3, 'Literature & Fiction', 'Genre Fiction | Literacy | Essays & Correspondence | History & Criticism'),
(4, 'Romance', 'Contemporary | Erotica | Paranormal | Billionaires | Romantic Comedy | Romantic Suspense'),
(8, 'Science Fiction & Fantasy', 'Fantasy | Science Fiction | Gaming | Writing'),
(9, 'Academic Textbooks', 'Primary School | Secondary School | University/Higher Education');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `payment_reference` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `email`, `phone`, `payment_reference`, `date`) VALUES
(1, '', 'ibrahimnurudeenshehu@gmail.com', '08012345678', '865292035', '2024-06-27 01:46:33'),
(2, '72cfd33320', 'ibrahimnurudeenshehu@gmail.com', '08062585624', '330049480', '2024-06-27 09:28:31'),
(3, '72cfd33320', 'ibrahimnurudeenshehu@gmail.com', '08062585624', '878809265', '2024-06-27 10:08:11'),
(4, '72cfd33320', 'jb@gmail.com', '08062585624', 'T798705324619689', '2024-06-28 19:54:15');

-- --------------------------------------------------------

--
-- Table structure for table `pickup`
--

CREATE TABLE `pickup` (
  `pickup_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pickup`
--

INSERT INTO `pickup` (`pickup_id`, `user_id`, `first_name`, `last_name`, `email`, `phone`, `address`, `date`) VALUES
(1, '72cfd33320', 'Ibrahim', 'Nurudeen', 'ibrahimnurudeenshehu1447@gmail.com', '08062585624', 'Akwanga by-pass, Keffi', '2024-06-27 12:47:27'),
(2, '72cfd33320', 'Jibrin', 'Abdullahi', 'jb@gmail.com', '08012345678', 'Lowcost, Keffi', '2024-06-27 12:54:07'),
(3, '72cfd33320', 'Jibrin', 'Abdullahi', 'jb@gmail.com', '+2348012345678', 'Lowcost, Keffi', '2024-06-29 09:52:00'),
(4, '72cfd33320', 'Suleiman', 'Abdullateef', 'sule@gmail.com', '+2347012345678', 'Angwan Dadi, Keffi, Nasarawa state', '2024-06-29 09:56:57');

-- --------------------------------------------------------

--
-- Table structure for table `soft_copy`
--

CREATE TABLE `soft_copy` (
  `soft_copy_id` int(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `books_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `soft_copy`
--

INSERT INTO `soft_copy` (`soft_copy_id`, `location`, `books_id`) VALUES
(1, 'soft-copies/CV sample.pdf', 4),
(2, 'soft-copies/Composition in English by Ubaidullah[English Department].pdf', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`books_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `books_id` (`books_id`),
  ADD KEY `pickupAndCArtJoin` (`pickup_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `pickup`
--
ALTER TABLE `pickup`
  ADD PRIMARY KEY (`pickup_id`);

--
-- Indexes for table `soft_copy`
--
ALTER TABLE `soft_copy`
  ADD PRIMARY KEY (`soft_copy_id`),
  ADD KEY `books_id` (`books_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `books_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pickup`
--
ALTER TABLE `pickup`
  MODIFY `pickup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `soft_copy`
--
ALTER TABLE `soft_copy`
  MODIFY `soft_copy_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`books_id`) REFERENCES `books` (`books_id`),
  ADD CONSTRAINT `pickupAndCArtJoin` FOREIGN KEY (`pickup_id`) REFERENCES `pickup` (`pickup_id`);

--
-- Constraints for table `soft_copy`
--
ALTER TABLE `soft_copy`
  ADD CONSTRAINT `soft_copy_ibfk_1` FOREIGN KEY (`books_id`) REFERENCES `books` (`books_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
