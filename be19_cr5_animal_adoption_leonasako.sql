-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 29. Jul 2023 um 17:17
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `be19_cr5_animal_adoption_leonasako`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `animal`
--

CREATE TABLE `animal` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `location` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `size` enum('small','large') NOT NULL,
  `age` int(11) DEFAULT NULL,
  `vaccinated` tinyint(1) NOT NULL,
  `breed` varchar(50) NOT NULL,
  `status` enum('Adopted','Available') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `animal`
--

INSERT INTO `animal` (`id`, `name`, `photo`, `location`, `description`, `size`, `age`, `vaccinated`, `breed`, `status`) VALUES
(1, 'Fluffyyyyyyy', 'cat.jpg', 'Praterstraße 23, Vienna', 'A cheerful and playful small cat.', 'small', 3, 1, 'Domestic Shorthair', 'Adopted'),
(5, 'Lucy', 'jack.jpg', 'Stephansplatz 1, Vienna', 'A cheerful and intelligent small breed.', 'small', 9, 0, 'Jack Russell Terrier', 'Available'),
(6, 'Charlie', 'cavalier.jpg', 'Nußdorf 21, Vienna', 'Sweet and loyal small dog.', 'small', 4, 1, 'Cavalier King Charles Spaniel', 'Available'),
(7, 'Daisy', 'daisy.jpg', 'Brigitaplatz 15, Vienna', 'Elegant and graceful large cat.', 'large', 2, 1, 'Maine Coon', 'Available'),
(8, 'Molly', 'moly.jpg', 'Westbahnhof 3, Vienna', 'Small and lively breed that loves to play.', 'small', 12, 1, 'Shih Tzu', 'Adopted'),
(9, 'Buddy', 'buddy.jpg', 'Belvedere 7, Vienna', 'Faithful and loyal dog, a perfect pet.', 'large', 8, 1, 'Golden Retriever', 'Available'),
(10, 'Sadieeeeeeeee', 'sadie.jpg', 'Kärntner Straße 10, Vienna', 'Sweet and cuddly small cat.', 'small', 11, 1, 'Siamese', 'Available'),
(24, 'Luna', 'wolf.jpg', 'Pacific Northwest, USA', 'An independent and mysterious gray wolf with a keen sense of smell.', 'large', 4, 0, 'Gray Wolf', 'Available'),
(26, 'Simba', 'husky.jpg', 'Alaska, USA', 'A strong and energetic Siberian Husky with a thick fur coat.', '', 3, 0, 'Siberian Husky', 'Available'),
(27, 'Nala', 'daisy.jpg', 'Bangkok, Thailand', 'A vocal and affectionate Siamese cat with striking blue almond eyes.', 'small', 2, 0, 'Siamese', 'Available'),
(29, 'Sahara', 'horse.jpg', 'Dubai, UAE', 'A majestic and elegant Arabian horse with a glossy coat.', 'large', 5, 0, 'Arabian Horse', 'Available'),
(32, 'Kala', 'cavalier.jpg', 'Sunderbans, India', 'A majestic and fearsome Bengal Tiger with beautiful orange and black stripes.', 'large', 6, 0, 'Bengal Tiger', 'Available'),
(36, 'Cotton', 'rabbit.jpg', 'Amsterdam, Netherlands', 'An adorable and fluffy Angora Rabbit with long white fur.', 'small', 1, 0, 'Angora Rabbit', 'Available'),
(40, 'Buddy', 'cavalier.jpg', 'Texas, USA', 'A loyal and playful Golden Retriever with a love for water.', 'large', 2, 0, 'Golden Retriever', 'Available');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pet_adoption`
--

CREATE TABLE `pet_adoption` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `animalID` int(11) NOT NULL,
  `adoption_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `standard` enum('user','adm') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `picture`, `password`, `date_of_birth`, `standard`) VALUES
(3, 'Leona', 'Sako', 'leona.sako@gmail.com', '', '', 'avatar.png', 'd37065b2dd6631d255e72224df7e43c8773daa104987969e23f91ecefef096a9', '1996-12-09', 'user'),
(5, 'Leona', 'Sako', 'test@test.at', '', '', 'avatar.png', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', '1996-12-09', 'adm'),
(6, 'Leona', 'Sako', 'test1@gmail.com', '', '', 'avatar.png', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1996-12-09', 'user'),
(7, 'Leona', 'Sako', 'user@user.ar', '', '', 'avatar.png', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1996-01-21', 'user'),
(8, 'vrewerwb', 'gesgtrsgrst', 'aaa@gmail.com', '', '', 'avatar.png', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '0000-00-00', 'user'),
(9, 'salkdjkald', 'laksjlakjdl', 'adada@yahoo.com', '', '', 'avatar.png', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1996-01-21', 'user');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD PRIMARY KEY (`id`),
  ADD KEY `animalID` (`animalID`),
  ADD KEY `userID` (`userID`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `animal`
--
ALTER TABLE `animal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT für Tabelle `pet_adoption`
--
ALTER TABLE `pet_adoption`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD CONSTRAINT `pet_adoption_ibfk_1` FOREIGN KEY (`animalID`) REFERENCES `animal` (`id`),
  ADD CONSTRAINT `pet_adoption_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
