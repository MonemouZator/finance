-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 28 avr. 2023 à 16:20
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tutorial`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `idadministrateur` int(11) NOT NULL,
  `libelleadministrateur` varchar(50) DEFAULT NULL,
  `PrenomAdm` varchar(50) DEFAULT NULL,
  `TelephoneAdm` varchar(50) DEFAULT NULL,
  `ProfessionAdm` date DEFAULT NULL,
  `EmailAdm` varchar(50) DEFAULT NULL,
  `Login` varchar(50) DEFAULT NULL,
  `Mp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`idadministrateur`, `libelleadministrateur`, `PrenomAdm`, `TelephoneAdm`, `ProfessionAdm`, `EmailAdm`, `Login`, `Mp`) VALUES
(1, 'jaouad', 'Daikal', '(066) 196-2063', '2020-03-10', 'transfertformationdepinf@gmail.com', 'ADMIN', '6666'),
(2, 'ALAMI', 'SARA', '(065) 666-6666', '2019-02-19', 'akhaddarhayat@gmail.com', 'invite', '123456'),
(8, 'BOUITA', 'YASSINE', '(078) 888-8888', '2021-04-08', 'YASINE@gmail.com', 'yassine', '4565'),
(9, 'BENANI', 'HIBA', '(777) 777-7777', '2023-04-13', 'hibabennani@gmail.com', 'hiba', '6666'),
(10, 'OUFIR', 'RACHID', '(067) 878-7878', '2023-04-20', 'rachid787@gmail.com', 'rachid', '4545');

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE `statut` (
  `Idstatut` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `statut`
--

INSERT INTO `statut` (`Idstatut`, `libelle`) VALUES
(1, 'Admin'),
(2, 'Invite');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `city` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `Idstatut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `city`, `email`, `Idstatut`) VALUES
(36, 'jaouad', 'Male', 'kenitra', 'jaouad', 1),
(37, 'nabil abdeddaim', 'female', 'CASA', 'nabilabdeddaim54@gmail.com', 2),
(38, 'ALAMI SARA', 'female', 'RABAT', 'sara@gmail.com', 1),
(39, 'daikal jaouad', 'male', 'CASABLANCA', 'jaouad84daikal@gmail.com', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`idadministrateur`);

--
-- Index pour la table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`Idstatut`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_ibfk_1` (`Idstatut`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `idadministrateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `statut`
--
ALTER TABLE `statut`
  MODIFY `Idstatut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`Idstatut`) REFERENCES `statut` (`Idstatut`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
