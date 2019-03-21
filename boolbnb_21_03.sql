-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Mar 21, 2019 alle 08:40
-- Versione del server: 5.7.25-0ubuntu0.18.04.2
-- Versione PHP: 7.2.15-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boolbnb`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `apartments`
--

CREATE TABLE `apartments` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `rooms_number` tinyint(4) DEFAULT NULL,
  `beds_number` tinyint(4) DEFAULT NULL,
  `baths_number` tinyint(4) DEFAULT NULL,
  `surface` tinyint(4) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `apartments`
--

INSERT INTO `apartments` (`id`, `description`, `rooms_number`, `beds_number`, `baths_number`, `surface`, `address`, `image`, `created_at`, `updated_at`) VALUES
(1, 'appartamento test', 12, 23, 34, 2, 'Parma, PR, Italia', NULL, '2019-03-20 19:09:58', '2019-03-20 19:09:58'),
(2, 'ciao', 2, 2, 2, 2, 'Roma, RM, Italia', NULL, '2019-03-21 06:15:04', '2019-03-21 06:15:04');

-- --------------------------------------------------------

--
-- Struttura della tabella `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_03_20_162958_update_users_table', 1),
(4, '2019_03_20_173212_create_apartments_table', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `lastname`, `date_of_birth`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'Nicola', 'nicolasolzi91@gmail.com', NULL, '$2y$10$cHYOivqP4s9c.uesBV/cfu03Tqt0PKYHiza1YFYFgo4YEkBmgPWam', NULL, '2019-03-20 15:51:44', '2019-03-20 15:51:44'),
(2, NULL, NULL, 'Chiara', 'chiarapassaro@gmail.com', NULL, '$2y$10$yHkj3kfDq6gioQMgNo6lueOs.Pxndm4624/yJUB5y7lOwoZw1pJx6', NULL, '2019-03-20 15:56:20', '2019-03-20 15:56:20'),
(3, 'Papagni', NULL, 'Michele', 'michelepapagni@mail.com', NULL, '$2y$10$BqTOkhRRMtYB/ex9EUGTqeC2P8srNTpr7ci1dLtotku7yzmkX8jLy', NULL, '2019-03-20 16:01:45', '2019-03-20 16:01:45'),
(4, 'bianco', '1980-09-23', 'gianlu', 'gianlub@gmail.com', NULL, '$2y$10$q3cacmNe6w84jdujMoftauTkmsO.MemOSoXt7mzJpKXP6ZuNM1AZ.', NULL, '2019-03-20 16:10:21', '2019-03-20 16:10:21'),
(5, 'Bianco', '1990-04-04', '1', 'nicoli91g@mail.com', NULL, '$2y$10$51ux9fLxWIYe1oOzdY7cUOnjoARUGCsMtvw/.waawBqemK16oIilO', NULL, '2019-03-20 16:24:47', '2019-03-20 16:24:47'),
(6, 'Ricci', '1990-02-02', 'Pietro', 'pric@mail.com', NULL, '$2y$10$bm/nQOJhY5GwfaMSBN/wse.0OlRjKzW9o/Ckn3XgIjdqiliUvtvoq', NULL, '2019-03-21 06:36:28', '2019-03-21 06:36:28');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `apartments`
--
ALTER TABLE `apartments`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `apartments`
--
ALTER TABLE `apartments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
