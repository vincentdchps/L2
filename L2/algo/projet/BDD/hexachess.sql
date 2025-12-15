-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 15 déc. 2025 à 16:36
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hexachess`
--

-- --------------------------------------------------------

--
-- Structure de la table `achievements`
--

CREATE TABLE `achievements` (
  `achievement_id` char(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `games`
--

CREATE TABLE `games` (
  `game_id` char(11) NOT NULL,
  `white_player_id` char(11) NOT NULL,
  `black_player_id` char(11) NOT NULL,
  `winner_id` char(11) DEFAULT NULL,
  `tournament_id` char(11) DEFAULT NULL,
  `moves` text DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `victory_type` char(9) DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Structure de la table `players`
--

CREATE TABLE `players` (
  `player_id` char(11) NOT NULL,
  `handle` varchar(32) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password_hash` varchar(64) NOT NULL,
  `display_name` varchar(1024) DEFAULT NULL,
  `avatar` varchar(260) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `sex` varchar(32) DEFAULT NULL,
  `rating` int(11) DEFAULT 1200,
  `location` varchar(128) DEFAULT NULL,
  `joined_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `is_banned` tinyint(1) DEFAULT 0
) ;

-- --------------------------------------------------------

--
-- Structure de la table `puzzles`
--

CREATE TABLE `puzzles` (
  `puzzle_id` char(11) NOT NULL,
  `moves` text NOT NULL,
  `solutions` text NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `theme` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ;

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `player_id` char(11) NOT NULL,
  `theme` varchar(255) DEFAULT 'default',
  `show_legal_moves` tinyint(1) DEFAULT 1,
  `auto_promote_queen` tinyint(1) DEFAULT 0,
  `ai_difficulty_level` int(11) DEFAULT 1
) ;

-- --------------------------------------------------------

--
-- Structure de la table `tournaments`
--

CREATE TABLE `tournaments` (
  `tournament_id` char(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `winner_id` char(11) DEFAULT NULL
) ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`achievement_id`);

--
-- Index pour la table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_id`),
  ADD KEY `fk_games_white` (`white_player_id`),
  ADD KEY `fk_games_black` (`black_player_id`),
  ADD KEY `fk_games_winner` (`winner_id`),
  ADD KEY `fk_games_tournament` (`tournament_id`);

--
-- Index pour la table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`player_id`),
  ADD UNIQUE KEY `uq_players_handle` (`handle`),
  ADD UNIQUE KEY `uq_players_email` (`email`);

--
-- Index pour la table `puzzles`
--
ALTER TABLE `puzzles`
  ADD PRIMARY KEY (`puzzle_id`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`player_id`);

--
-- Index pour la table `tournaments`
--
ALTER TABLE `tournaments`
  ADD PRIMARY KEY (`tournament_id`),
  ADD KEY `fk_tournaments_winner` (`winner_id`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `fk_games_black` FOREIGN KEY (`black_player_id`) REFERENCES `players` (`player_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_games_tournament` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`tournament_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_games_white` FOREIGN KEY (`white_player_id`) REFERENCES `players` (`player_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_games_winner` FOREIGN KEY (`winner_id`) REFERENCES `players` (`player_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `fk_settings_player` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tournaments`
--
ALTER TABLE `tournaments`
  ADD CONSTRAINT `fk_tournaments_winner` FOREIGN KEY (`winner_id`) REFERENCES `players` (`player_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
