-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 23 jun 2025 om 15:35
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `escape_room`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact_formulier`
--

CREATE TABLE `contact_formulier` (
  `id` int(11) NOT NULL,
  `naam` varchar(100) NOT NULL,
  `gmail` varchar(255) NOT NULL,
  `bericht` text NOT NULL,
  `datum_ingediend` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `hint` varchar(255) DEFAULT NULL,
  `roomId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `questions`
--

INSERT INTO `questions` (`id`, `question`, `answer`, `hint`, `roomId`) VALUES
(25, 'A maiden cursed with snakes for hair,\r\nOne deadly glance, so best beware.\r\nHeroes came, their fate was grim,\r\nUnless they used a mirrored rim.', 'Medusa', 'A mirror is the only way to see me and survive.', 1),
(26, 'Half-man, half-beast, trapped in a maze,\r\nWhere light gets lost in winding ways.\r\nA hero brave with thread in hand,\r\nCame to slay me where I stand.', 'Minotaur', 'Theseus came to find me in a labyrinth.', 1),
(27, 'With golden horn and coat so bright,\r\nI flew through air, a wondrous sight.\r\nMy fleece was sought, a prize to hold,\r\nIn tales of Argonauts so bold.', 'Golden Fleece', 'Jason and his crew set sail for me.', 1),
(28, 'With many heads I block the way,\r\nCut off one, two more will stay.\r\nI live in swamps and toxic air,\r\nA deadly beast beyond compare.', 'Hydra', 'Only fire could stop my heads from growing back.', 1),
(29, 'Though I’m blind, I speak the truth,\r\nTo kings and gods since ancient youth.\r\nMy words foretell what is to come,\r\nIn riddles old, my voice strikes some.', 'Oracle', 'People visited me in Delphi for answers.', 1),
(30, 'I fly too close, I fall from pride, Wax wings melt, I cannot glide. My father\'s warning I ignored, Who plunged into the sea and soared?', 'Icarus', 'The sun was my downfall.', 2),
(31, 'With thread in hand she weaves her fate, Arachne’s skill was truly great. But prideful boast brought on her doom, Now eight legs scuttle in her gloom.', 'Arachne', 'The gods turned her into something that weaves.', 2),
(32, 'I opened what I should have sealed, And chaos to the world revealed. Curiosity became my crime, Who loosed the plagues of endless time?', 'Pandora', 'Hope was the last thing left inside.', 2),
(33, 'I pull the sun across the sky, My steeds of flame go racing by. Each day I rise and light the land, With golden reins held in my hand.', 'Helios', 'Before Apollo, I was the sun god.', 2),
(34, 'Born from foam upon the sea, I bring love and jealousy. Beauty flows in every part, Who is the goddess of the heart?', 'Aphrodite', 'Even gods fall under my charm.', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `resultaten`
--

CREATE TABLE `resultaten` (
  `resultaat_id` int(11) NOT NULL,
  `tijd` time NOT NULL,
  `resultaat` enum('gewonnen','verloren') NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `resultaten`
--

INSERT INTO `resultaten` (`resultaat_id`, `tijd`, `resultaat`, `score`) VALUES
(6, '00:00:00', '', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `teams`
--

CREATE TABLE `teams` (
  `team_id` int(11) NOT NULL,
  `team_naam` varchar(15) NOT NULL,
  `teamcode` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `teams`
--

INSERT INTO `teams` (`team_id`, `team_naam`, `teamcode`) VALUES
(13, 'test', 'ffe5f1'),
(14, 'herp', '111111');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `team_rule`
--

CREATE TABLE `team_rule` (
  `team_rule_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `resultaat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `team_rule`
--

INSERT INTO `team_rule` (`team_rule_id`, `team_id`, `user_id`, `resultaat_id`) VALUES
(4, 13, 7, 6),
(5, 13, 10, 6);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`user_id`, `email`, `username`, `password`, `admin`) VALUES
(2, 'test2@klk.nl', 'test555', '$2y$10$U2ThseCOnqqZy7cotOnj8.ad529da/zZQxroQIBY1JZcbd/NUyMMW', 0),
(5, 'test2@klk.nlx', 'yo', '5076786', 0),
(7, 'admin@admin.nl', 'admin', '$2y$10$lk/cmpLNVC19ODydQfy9/Ok.LTJwXABnohuyEy30JHoUb8P7297IG', 1),
(9, 'test@test.com', 'test', '$2y$10$.kpZNCZSs4gSywNTX9BE4eiQWbpTwgBs3eEGxP9JrRxGgoVp.wCgW', 0),
(10, 'lol@lol.lol', 'lol', '$2y$10$zBPTURT4OSUjsLObofPdDexNeWb.8M.JB7BZNHNE5jzWQsQXpoi2e', 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `contact_formulier`
--
ALTER TABLE `contact_formulier`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `resultaten`
--
ALTER TABLE `resultaten`
  ADD PRIMARY KEY (`resultaat_id`),
  ADD KEY `resultaat` (`resultaat`);

--
-- Indexen voor tabel `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`);

--
-- Indexen voor tabel `team_rule`
--
ALTER TABLE `team_rule`
  ADD PRIMARY KEY (`team_rule_id`),
  ADD KEY `team_id` (`team_id`,`user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `resultaat_id` (`resultaat_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `contact_formulier`
--
ALTER TABLE `contact_formulier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT voor een tabel `resultaten`
--
ALTER TABLE `resultaten`
  MODIFY `resultaat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT voor een tabel `team_rule`
--
ALTER TABLE `team_rule`
  MODIFY `team_rule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `team_rule`
--
ALTER TABLE `team_rule`
  ADD CONSTRAINT `team_rule_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`team_id`),
  ADD CONSTRAINT `team_rule_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `team_rule_ibfk_3` FOREIGN KEY (`resultaat_id`) REFERENCES `resultaten` (`resultaat_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
