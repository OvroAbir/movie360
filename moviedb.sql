-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2016 at 04:12 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS moviedb;
CREATE DATABASE moviedb;
USE moviedb;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moviedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `actor`
--

CREATE TABLE `actor` (
  `ACTOR_ID` int(11) NOT NULL,
  `NAME` varchar(150) NOT NULL,
  `GENDER_ID` int(11) DEFAULT '1',
  `BIRTH_DATE` date DEFAULT NULL,
  `HEIGHT` int(11) DEFAULT NULL,
  `COUNTRY_ID` int(11) DEFAULT NULL,
  `ACTOR_DESCRIPTION` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `actor`
--

INSERT INTO `actor` (`ACTOR_ID`, `NAME`, `GENDER_ID`, `BIRTH_DATE`, `HEIGHT`, `COUNTRY_ID`, `ACTOR_DESCRIPTION`) VALUES
(1, 'Tim Robbins', 1, '1956-10-16', 196, 1, NULL),
(2, 'Morgan Freeman', 1, '1937-06-01', 189, 1, NULL),
(3, 'Daniel Radcliffe', 1, '1989-07-23', 166, 2, NULL),
(4, 'Emma Watson', 2, '1990-04-15', 165, 4, NULL),
(5, 'Leonardo DiCaprio', 1, '1974-11-11', 183, 1, NULL),
(6, 'Riaz Uddin Ahamed', 1, '1985-06-01', 171, 3, NULL),
(7, 'Christian Bale', 1, '1974-01-30', 183, 1, NULL),
(8, 'Tom Cruise', 1, '1962-07-03', 170, 1, NULL),
(9, 'Emily Blunt', 1, '1983-02-23', 170, 2, NULL),
(10, 'Rebecca Ferguson', 1, '1983-10-19', 170, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `actor_list`
--

CREATE TABLE `actor_list` (
  `MOVIE_ID` int(11) NOT NULL,
  `ACTOR_ID` int(11) NOT NULL,
  `CHARACTER_NAME` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `actor_list`
--

INSERT INTO `actor_list` (`MOVIE_ID`, `ACTOR_ID`, `CHARACTER_NAME`) VALUES
(1, 1, 'Andy Dufresne'),
(1, 2, 'Ellis Boyd Redding'),
(2, 3, 'Harry Potter'),
(2, 4, 'Hermione Granger'),
(3, 2, 'Lucius Fox'),
(4, 5, 'Cobb'),
(5, 6, 'Shuvro'),
(6, 2, 'Lucius Fox'),
(6, 7, 'Bruce Wayne'),
(7, 2, 'Lucius Fox'),
(7, 7, 'Bruce Wayne'),
(8, 3, 'Harry Potter'),
(8, 4, 'Hermione Granger'),
(9, 3, 'Harry Potter'),
(9, 4, 'Hermione Granger'),
(10, 8, 'Cage'),
(10, 9, 'Rita'),
(11, 8, 'Ethan Hunt'),
(11, 10, 'Ilsa Faust');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `COUNTRY_ID` int(11) NOT NULL,
  `COUNTRY_NAME` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`COUNTRY_ID`, `COUNTRY_NAME`) VALUES
(1, 'USA'),
(2, 'UK'),
(3, 'Bangladesh'),
(4, 'France');

-- --------------------------------------------------------

--
-- Table structure for table `director`
--

CREATE TABLE `director` (
  `DIRECTOR_ID` int(11) NOT NULL,
  `DIRECTOR_NAME` varchar(100) NOT NULL,
  `DIRECTOR_DESCRIPTION` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `director`
--

INSERT INTO `director` (`DIRECTOR_ID`, `DIRECTOR_NAME`, `DIRECTOR_DESCRIPTION`) VALUES
(1, 'Frank Darabont', NULL),
(2, 'Chris Columbus', NULL),
(3, 'Christopher Nolan', NULL),
(4, 'Toukir Ahmed', NULL),
(5, 'Mike Newell', NULL),
(6, 'Doug Liman', NULL),
(7, 'Christopher McQuarrie', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `GENRE_ID` int(10) NOT NULL,
  `GENRE_NAME` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`GENRE_ID`, `GENRE_NAME`) VALUES
(1, 'Crime'),
(2, 'Adventure'),
(3, 'Drama'),
(4, 'Family'),
(5, 'Fantasy'),
(6, 'Action'),
(7, 'Mystery'),
(8, 'Sci-fi'),
(9, 'Comedy'),
(10, 'Romance');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `LANGUAGE_ID` int(11) NOT NULL,
  `LANGUAGE_NAME` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`LANGUAGE_ID`, `LANGUAGE_NAME`) VALUES
(1, 'ENGLISH'),
(2, 'BENGALI'),
(3, 'HINDI');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `MOVIE_ID` int(11) NOT NULL,
  `MOVIE_NAME` varchar(120) NOT NULL,
  `RUNTIME` int(11) DEFAULT NULL,
  `RELEASE_DATE` date DEFAULT NULL,
  `BUDGET` float DEFAULT NULL,
  `COUNTRY_ID` int(11) DEFAULT NULL,
  `RATING` float(5,2) DEFAULT NULL,
  `PROD_HOUSE_ID` int(11) DEFAULT NULL,
  `DIRECTOR_ID` int(11) DEFAULT NULL,
  `PLOT` text,
  `IMDB_LINK` varchar(40) DEFAULT NULL,
  `TRAILER` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`MOVIE_ID`, `MOVIE_NAME`, `RUNTIME`, `RELEASE_DATE`, `BUDGET`, `COUNTRY_ID`, `RATING`, `PROD_HOUSE_ID`, `DIRECTOR_ID`, `PLOT`, `IMDB_LINK`, `TRAILER`) VALUES
(1, 'The Shawshank Redemption', 142, '1994-10-14', 25, 1, 9.30, 1, 1, 'Chronicles the experiences of a formerly successful banker as a prisoner in the gloomy jailhouse of Shawshank after being found guilty of a crime he did not commit. The film portrays the man''s unique way of dealing with his new, torturous life; along the way he befriends a number of fellow prisoners, most notably a wise long-term inmate named Red.', 'http://www.imdb.com/title/tt0111161/', '6hB3S9bIaco'),
(2, 'Harry Potter and the Sorcerers Stone', 152, '2001-11-16', 125, 2, 7.50, 2, 2, 'This is the tale of Harry Potter, an ordinary 11-year-old boy serving as a sort of slave for his aunt and uncle who learns that he is actually a wizard and has been invited to attend the Hogwarts School for Witchcraft and Wizardry. Harry is snatched away from his mundane existence by Hagrid, the grounds keeper for Hogwarts, and quickly thrown into a world completely foreign to both him and the viewer. Famous for an incident that happened at his birth, Harry makes friends easily at his new school. He soon finds, however, that the wizarding world is far more dangerous for him than he would have imagined, and he quickly learns that not all wizards are ones to be trusted.', 'http://www.imdb.com/title/tt0241527/', 'geNlXmmIp7w'),
(3, 'The Dark Knight', 152, '2008-07-18', 185, 1, 9.00, 2, 3, 'Set within a year after the events of Batman Begins, Batman, Lieutenant James Gordon, and new district attorney Harvey Dent successfully begin to round up the criminals that plague Gotham City until a mysterious and sadistic criminal mastermind known only as the Joker appears in Gotham, creating a new wave of chaos. Batman''s struggle against the Joker becomes deeply personal, forcing him to ''confront everything he believes'' and improve his technology to stop him. A love triangle develops between Bruce Wayne, Dent and Rachel Dawes.', 'http://www.imdb.com/title/tt0468569/', 'EXeTwQWrcwY'),
(4, 'Inception', 148, '2010-07-16', 160, 1, 8.80, 3, 3, 'Dom Cobb is a skilled thief, the absolute best in the dangerous art of extraction, stealing valuable secrets from deep within the subconscious during the dream state, when the mind is at its most vulnerable. Cobb''s rare ability has made him a coveted player in this treacherous new world of corporate espionage, but it has also made him an international fugitive and cost him everything he has ever loved. Now Cobb is being offered a chance at redemption. One last job could give him his life back but only if he can accomplish the impossible - inception. Instead of the perfect heist, Cobb and his team of specialists have to pull off the reverse: their task is not to steal an idea but to plant one. If they succeed, it could be the perfect crime. But no amount of careful planning or expertise can prepare the team for the dangerous enemy that seems to predict their every move. An enemy that only Cobb could have seen coming.', 'http://www.imdb.com/title/tt1375666/', '8hP9D6kZseM'),
(5, 'Daruchini Dip', 161, '2007-08-31', 0.7, 3, 7.40, 4, 4, 'A team of young boys and girls plan to have a big trip across Bangladesh. They all hail from the mega city of Dhaka. In Bangladesh, being a conservative country, it is not common to the sight of a group consisting of both young, single men and women traveling together. Yet in this story, the girls are seen to try to make it against the stream. Each had a different destination in mind: like Sundarban, Cox''s Bazar, Saint Martin and many more places. Finally they decide to go to Daruchini Dwip. ''Shuvro''(Riaz) has a big problem for his weak eyesight because he may be put out from the program. But finally the full team goes on a train with ''Shuvro''.', 'http://www.imdb.com/title/tt2048726/', 'AEWgP816rYs'),
(6, 'The Dark Knight Rises', 164, '2012-07-14', 25, 1, 8.50, 2, 3, 'Despite his tarnished reputation after the events of The Dark Knight, in which he took the rap for Dent''s crimes, Batman feels compelled to intervene to assist the city and its police force which is struggling to cope with Bane''s plans to destroy the city.', 'http://www.imdb.com/title/tt1345836/', 'g8evyE9TuYk'),
(7, 'Batman Begins', 140, '2005-06-15', 25, 1, 8.30, 2, 3, 'When his parents were killed, billionaire playboy Bruce Wayne relocates to Asia when he is mentored by Henri Ducard and Ras Al Ghul in how to fight evil. When learning about the plan to wipe out evil in Gotham City by Ducard, Bruce prevents this plan from getting any further and heads back to his home. Back in his original surroundings, Bruce adopts the image of a bat to strike fear into the criminals and the corrupt as the icon known as `Batman`. But it doesnt stay quiet for long.', 'http://www.imdb.com/title/tt0372784/', 'vak9ZLfhGnQ'),
(8, 'Harry Potter and the Goblet of Fire', 157, '2005-11-15', 15, 1, 7.50, 2, 5, 'Harry''s fourth year at Hogwarts is about to start and he is enjoying the summer vacation with his friends. They get the tickets to The Quidditch World Cup Final but after the match is over, people dressed like Lord Voldemort''s `Death Eaters` set a fire to all the visitors'' tents, coupled with the appearance of Voldemort''s symbol, the `Dark Mark` in the sky, which causes a frenzy across the magical community. That same year, Hogwarts is hosting `The Triwizard Tournament`, a magical tournament between three well-known schools of magic : Hogwarts, Beauxbatons and Durmstrang. The contestants have to be above the age of 17, and are chosen by a magical object called Goblet of Fire. On the night of selection, however, the Goblet spews out four names instead of the usual three, with Harry unwittingly being selected as the Fourth Champion. Since the magic cannot be reversed, Harry is forced to go with it and brave three exceedingly difficult tasks.', 'http://www.imdb.com/title/tt0330373/', 'aFhCLiGvb08'),
(9, 'Harry Potter and the Prisoner of Azkaban', 142, '2004-06-04', 13, 1, 7.80, 2, 5, 'Harry Potter is having a tough time with his relatives (yet again). He runs away after using magic to inflate Uncle Vernon''s sister Marge who was being offensive towards Harry''s parents. Initially scared for using magic outside the school, he is pleasantly surprised that he won''t be penalized after all. However, he soon learns that a dangerous criminal and Voldemort''s trusted aide Sirius Black has escaped from the Azkaban prison and wants to kill Harry to avenge the Dark Lord. To worsen the conditions for Harry, vile creatures called Dementors are appointed to guard the school gates and inexplicably happen to have the most horrible effect on him. Little does Harry know that by the end of this year, many holes in his past (whatever he knows of it) will be filled up and he will have a clearer vision of what the future has in store... ', 'http://www.imdb.com/title/tt0304141/', 'lAxgztbYDbs'),
(10, 'Edge of Tomorrow', 113, '2004-06-06', 17.8, 1, 7.90, 2, 6, 'An alien race has hit the Earth in an unrelenting assault, unbeatable by any military unit in the world. Major William Cage (Cruise) is an officer who has never seen a day of combat when he is unceremoniously dropped into what amounts to a suicide mission. Killed within minutes, Cage now finds himself inexplicably thrown into a time loop-forcing him to live out the same brutal combat over and over, fighting and dying again...and again. But with each battle, Cage becomes able to engage the adversaries with increasing skill, alongside Special Forces warrior Rita Vrataski (Blunt). And, as Cage and Vrataski take the fight to the aliens, each repeated encounter gets them one step closer to defeating the enemy! ', 'http://www.imdb.com/title/tt1631867/', 'yUmSVcttXnI'),
(11, 'Mission: Impossible - Rogue Nation', 131, '2015-07-31', 15, 1, 7.50, 5, 7, 'CIA chief Hunley (Baldwin) convinces a Senate committee to disband the IMF (Impossible Mission Force), of which Ethan Hunt (Cruise) is a key member. Hunley argues that the IMF is too reckless. Now on his own, Hunt goes after a shadowy and deadly rogue organization called the Syndicate. ', 'http://www.imdb.com/title/tt2381249/', 'gOW_azQbOjw');

-- --------------------------------------------------------

--
-- Table structure for table `movie_admin`
--

CREATE TABLE `movie_admin` (
  `MOVIE_ID` int(11) NOT NULL,
  `ADMIN_ID` int(11) NOT NULL,
  `RATING` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `movie_genre`
--

CREATE TABLE `movie_genre` (
  `MOVIE_ID` int(11) NOT NULL,
  `GENRE_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie_genre`
--

INSERT INTO `movie_genre` (`MOVIE_ID`, `GENRE_ID`) VALUES
(1, 1),
(1, 3),
(2, 2),
(2, 4),
(2, 5),
(3, 1),
(3, 3),
(3, 6),
(4, 6),
(4, 7),
(4, 8),
(5, 3),
(5, 9),
(5, 10),
(6, 5),
(7, 1),
(7, 5),
(8, 1),
(8, 3),
(8, 4),
(8, 6),
(9, 1),
(9, 3),
(9, 4),
(9, 6),
(10, 1),
(10, 5),
(10, 7),
(11, 1),
(11, 5);

-- --------------------------------------------------------

--
-- Table structure for table `movie_language`
--

CREATE TABLE `movie_language` (
  `MOVIE_ID` int(11) NOT NULL,
  `LANGUAGE_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie_language`
--

INSERT INTO `movie_language` (`MOVIE_ID`, `LANGUAGE_ID`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 2),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `production_house`
--

CREATE TABLE `production_house` (
  `PROD_HOUSE_ID` int(11) NOT NULL,
  `PROD_HOUSE_NAME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `production_house`
--

INSERT INTO `production_house` (`PROD_HOUSE_ID`, `PROD_HOUSE_NAME`) VALUES
(1, 'Castle Rock Entertainment'),
(2, 'Warner Bros'),
(3, 'Legendary Pictures'),
(4, 'Impress Telefilms'),
(5, 'Paramount Pictures');

-- --------------------------------------------------------

--
-- Table structure for table `search_table`
--

CREATE TABLE `search_table` (
  `SEARCH_ID` int(10) NOT NULL,
  `USER_ID` int(10) DEFAULT NULL,
  `MOVIE_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_movie_comment`
--

CREATE TABLE `user_movie_comment` (
  `COMMENT_ID` int(10) NOT NULL,
  `USER_ID` int(10) DEFAULT NULL,
  `MOVIE_ID` int(11) DEFAULT NULL,
  `COMMENT` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_movie_rating`
--

CREATE TABLE `user_movie_rating` (
  `RATING_ID` int(10) NOT NULL,
  `USER_ID` int(10) DEFAULT NULL,
  `MOVIE_ID` int(11) DEFAULT NULL,
  `RATING` float(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`ACTOR_ID`),
  ADD KEY `COUNTRY_ID` (`COUNTRY_ID`);

--
-- Indexes for table `actor_list`
--
ALTER TABLE `actor_list`
  ADD PRIMARY KEY (`MOVIE_ID`,`ACTOR_ID`),
  ADD KEY `ACTOR_ID` (`ACTOR_ID`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`COUNTRY_ID`);

--
-- Indexes for table `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`DIRECTOR_ID`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`GENRE_ID`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`LANGUAGE_ID`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`MOVIE_ID`),
  ADD KEY `COUNTRY_ID` (`COUNTRY_ID`),
  ADD KEY `PROD_HOUSE_ID` (`PROD_HOUSE_ID`),
  ADD KEY `DIRECTOR_ID` (`DIRECTOR_ID`);

--
-- Indexes for table `movie_admin`
--
ALTER TABLE `movie_admin`
  ADD PRIMARY KEY (`MOVIE_ID`,`ADMIN_ID`),
  ADD KEY `ADMIN_ID` (`ADMIN_ID`);

--
-- Indexes for table `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD PRIMARY KEY (`MOVIE_ID`,`GENRE_ID`),
  ADD KEY `GENRE_ID` (`GENRE_ID`);

--
-- Indexes for table `movie_language`
--
ALTER TABLE `movie_language`
  ADD PRIMARY KEY (`MOVIE_ID`,`LANGUAGE_ID`),
  ADD KEY `LANGUAGE_ID` (`LANGUAGE_ID`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `production_house`
--
ALTER TABLE `production_house`
  ADD PRIMARY KEY (`PROD_HOUSE_ID`);

--
-- Indexes for table `search_table`
--
ALTER TABLE `search_table`
  ADD PRIMARY KEY (`SEARCH_ID`),
  ADD KEY `MOVIE_ID` (`MOVIE_ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_movie_comment`
--
ALTER TABLE `user_movie_comment`
  ADD PRIMARY KEY (`COMMENT_ID`),
  ADD KEY `MOVIE_ID` (`MOVIE_ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `user_movie_rating`
--
ALTER TABLE `user_movie_rating`
  ADD PRIMARY KEY (`RATING_ID`),
  ADD KEY `MOVIE_ID` (`MOVIE_ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actor`
--
ALTER TABLE `actor`
  MODIFY `ACTOR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `COUNTRY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `director`
--
ALTER TABLE `director`
  MODIFY `DIRECTOR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `GENRE_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `LANGUAGE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `MOVIE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `production_house`
--
ALTER TABLE `production_house`
  MODIFY `PROD_HOUSE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `search_table`
--
ALTER TABLE `search_table`
  MODIFY `SEARCH_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_movie_comment`
--
ALTER TABLE `user_movie_comment`
  MODIFY `COMMENT_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_movie_rating`
--
ALTER TABLE `user_movie_rating`
  MODIFY `RATING_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `actor`
--
ALTER TABLE `actor`
  ADD CONSTRAINT `actor_ibfk_1` FOREIGN KEY (`COUNTRY_ID`) REFERENCES `country` (`COUNTRY_ID`) ON DELETE SET NULL;

--
-- Constraints for table `actor_list`
--
ALTER TABLE `actor_list`
  ADD CONSTRAINT `actor_list_ibfk_1` FOREIGN KEY (`MOVIE_ID`) REFERENCES `movie` (`MOVIE_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `actor_list_ibfk_2` FOREIGN KEY (`ACTOR_ID`) REFERENCES `actor` (`ACTOR_ID`) ON DELETE CASCADE;

--
-- Constraints for table `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `movie_ibfk_1` FOREIGN KEY (`COUNTRY_ID`) REFERENCES `country` (`COUNTRY_ID`) ON DELETE SET NULL,
  ADD CONSTRAINT `movie_ibfk_2` FOREIGN KEY (`PROD_HOUSE_ID`) REFERENCES `production_house` (`PROD_HOUSE_ID`) ON DELETE SET NULL,
  ADD CONSTRAINT `movie_ibfk_3` FOREIGN KEY (`DIRECTOR_ID`) REFERENCES `director` (`DIRECTOR_ID`) ON DELETE SET NULL;

--
-- Constraints for table `movie_admin`
--
ALTER TABLE `movie_admin`
  ADD CONSTRAINT `movie_admin_ibfk_1` FOREIGN KEY (`MOVIE_ID`) REFERENCES `movie` (`MOVIE_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `movie_admin_ibfk_2` FOREIGN KEY (`ADMIN_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD CONSTRAINT `movie_genre_ibfk_1` FOREIGN KEY (`MOVIE_ID`) REFERENCES `movie` (`MOVIE_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `movie_genre_ibfk_2` FOREIGN KEY (`GENRE_ID`) REFERENCES `genre` (`GENRE_ID`) ON DELETE CASCADE;

--
-- Constraints for table `movie_language`
--
ALTER TABLE `movie_language`
  ADD CONSTRAINT `movie_language_ibfk_1` FOREIGN KEY (`MOVIE_ID`) REFERENCES `movie` (`MOVIE_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `movie_language_ibfk_2` FOREIGN KEY (`LANGUAGE_ID`) REFERENCES `language` (`LANGUAGE_ID`) ON DELETE CASCADE;

--
-- Constraints for table `search_table`
--
ALTER TABLE `search_table`
  ADD CONSTRAINT `search_table_ibfk_1` FOREIGN KEY (`MOVIE_ID`) REFERENCES `movie` (`MOVIE_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `search_table_ibfk_2` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_movie_comment`
--
ALTER TABLE `user_movie_comment`
  ADD CONSTRAINT `user_movie_comment_ibfk_1` FOREIGN KEY (`MOVIE_ID`) REFERENCES `movie` (`MOVIE_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_movie_comment_ibfk_2` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_movie_rating`
--
ALTER TABLE `user_movie_rating`
  ADD CONSTRAINT `user_movie_rating_ibfk_1` FOREIGN KEY (`MOVIE_ID`) REFERENCES `movie` (`MOVIE_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_movie_rating_ibfk_2` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;




INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Joy', 'joy@gmail.com', '$2y$10$1GhBsPLIEIQgeylXoVz6i.9hTEq99T6n4qbpHbh6RjlmvAKKfnv0y', 'CihehKRuFysVmOqFwCAm0EHEdbMd9V6qlRXOcMW34vEFtduEUuLW8WUxWGTj', '2016-05-20 09:46:01', '2016-05-25 06:41:54', 7),
(4, 'Sakib', 'sakib@gmail.com', '$2y$10$.f1I/f02mkvbIZWtHb8uF.v1pUXv0H8aSu6hod5CYJds7O7MtpVZ6', 'WLVFlAFsJZsea5IY4aONBARvJOE6nYuk3F5fa3nXu4NV6vXvuN1o3bjiab4Y', '2016-05-25 06:42:56', '2016-05-25 06:49:02', 3),
(5, 'Shaikh', 'shaikh@gmail.com', '$2y$10$R/hQp/MHusL7wU20xPIchOCtXFDq6KDecQ0HNbC6FoEu3fYaT0c92', 'iBut3WUIRGqOeYvkdZjQqJ3nM0NRvWKChBpN8bsZdGDpyVX78AIzD7kX3c1t', '2016-05-25 07:04:24', '2016-05-25 22:12:23', 3),
(6, 'Wasif', 'wasif@gmail.com', '$2y$10$arL8tUqmZPM1dkz029TsAefz7/V9ui67aPfGfZLGrlGaAnJfCnKFG', 'nhYBP2ZP9cOvzm0CdZNwU2Q8heDWYvBH8iY3K7nIRJvAHLhGg0pJkzQGRrDO', '2016-05-25 07:05:19', '2016-05-25 22:12:04', 1);




INSERT INTO `search_table` (`SEARCH_ID`, `USER_ID`, `MOVIE_ID`) VALUES
(1, NULL, 1),
(2, 1, 10),
(3, 1, 10),
(4, 1, 7),
(5, NULL, 6),
(6, NULL, 1),
(7, NULL, 1),
(9, NULL, 4),
(14, NULL, 3),
(15, NULL, 1),
(16, NULL, 1),
(17, NULL, 1),
(18, NULL, 1),
(19, NULL, 1),
(20, NULL, 1),
(21, NULL, 1),
(27, 1, 5),
(28, NULL, 1),
(29, NULL, 1),
(30, 1, 3),
(31, 1, 3);



ALTER TABLE `movie` ADD INDEX(`MOVIE_ID`, `MOVIE_NAME`);
ALTER TABLE `actor` ADD INDEX(`ACTOR_ID`, `NAME`);
ALTER TABLE `actor_list` ADD INDEX(`MOVIE_ID`);
ALTER TABLE `country` ADD INDEX(`COUNTRY_ID`);
ALTER TABLE `director` ADD INDEX(`DIRECTOR_ID`);
ALTER TABLE `genre` ADD INDEX(`GENRE_ID`);
ALTER TABLE `language` ADD INDEX(`LANGUAGE_ID`);
ALTER TABLE `movie_genre` ADD INDEX(`MOVIE_ID`);
ALTER TABLE `movie_language` ADD INDEX(`MOVIE_ID`);
ALTER TABLE `production_house` ADD INDEX(`PROD_HOUSE_ID`);
ALTER TABLE `users` ADD INDEX(`id`, `name`);
ALTER TABLE `user_movie_comment` ADD INDEX(`MOVIE_ID`);
ALTER TABLE `user_movie_rating` ADD INDEX(`MOVIE_ID`);
