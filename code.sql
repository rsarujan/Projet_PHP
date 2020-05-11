-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 27, 2020 at 10:57 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `Projet_Php`
--

-- --------------------------------------------------------

--
-- Table structure for table `Documents`
--

CREATE TABLE `Documents` (
  `id_document` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `idFormation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Documents`
--

INSERT INTO `Documents` (`id_document`, `libelle`, `idFormation`) VALUES
(1, 'CV', 1),
(2, 'LM', 1),
(3, 'Relevés de notes de l’année précédente', 1),
(4, 'Imprime écran de l’ENT de l’année en cours', 1),
(5, 'Formulaire d’inscription rempli', 1),
(6, 'Pièce d’identité en cours de validité', 1);

-- --------------------------------------------------------

--
-- Table structure for table `DocumentsFourni`
--

CREATE TABLE `DocumentsFourni` (
  `id_file` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mime` varchar(255) NOT NULL,
  `data` blob NOT NULL,
  `id_documents` int(11) NOT NULL,
  `id_etu` int(11) NOT NULL,
  `id_formation` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Formation`
--

CREATE TABLE `Formation` (
  `id_formation` int(11) NOT NULL,
  `intitule_formation` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Formation`
--

INSERT INTO `Formation` (`id_formation`, `intitule_formation`) VALUES
(1, 'Licence MIAGE'),
(2, 'Master 1 MIAGE'),
(3, 'Master 2 MIAGE');

-- --------------------------------------------------------

--
-- Table structure for table `Statuts`
--

CREATE TABLE `Statuts` (
  `id_statuts` int(11) NOT NULL,
  `libelle` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Statuts`
--

INSERT INTO `Statuts` (`id_statuts`, `libelle`) VALUES
(1, 'Reçu'),
(2, 'Reçu incomplet en attente de complément'),
(3, 'Validé complet'),
(4, 'Entretien'),
(5, 'Accepté'),
(6, 'Refusé'),
(7, 'Liste d’attente');

-- --------------------------------------------------------

--
-- Table structure for table `USER`
--

CREATE TABLE `USER` (
  `id_user` int(11) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  `TYPE` varchar(45) NOT NULL,
  `statuts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `id_etudiant` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `carte_id` int(11) NOT NULL,
  `date_naiss` date NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `num_tel` int(11) NOT NULL,
  `mail` varchar(70) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `choixFormation` int(11) DEFAULT NULL,
  `TypeUser` varchar(11) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Utilisateur`
--

INSERT INTO `Utilisateur` (`id_etudiant`, `Nom`, `Prenom`, `carte_id`, `date_naiss`, `adresse`, `num_tel`, `mail`, `mdp`, `choixFormation`, `TypeUser`, `Status`) VALUES
(1, 'Rajaratnam', 'Sarujan', 123456789, '1998-08-17', '2 rue de la Gare, 93700 Drancy', 600990099, 'azerty@gmail.com', 'azerty', 2, 'Etudiant', 7),
(2, 'AZERTY', 'TITI', 398765, '2020-03-10', '2 rue de la Gare, Drancy', 3456789, 'toto@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', NULL, NULL, NULL),
(4, 'Rajaratnam', 'sarujan', 123456789, '2020-03-05', '2 rue de la Gare, Drancy', 876543456, 'test@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', NULL, NULL, NULL),
(8, 'test', 'vrefsd', 3456789, '2020-03-02', 'fguyersbsk', 987654, 'admin@test.fr', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', NULL, NULL, NULL),
(9, 'AZER', 'ad', 123456787, '2006-07-06', '333', 2, 'admin@admin.fr', '9cf95dacd226dcf43da376cdb6cbba7035218921', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Documents`
--
ALTER TABLE `Documents`
  ADD PRIMARY KEY (`id_document`),
  ADD KEY `fkIdF` (`idFormation`);

--
-- Indexes for table `DocumentsFourni`
--
ALTER TABLE `DocumentsFourni`
  ADD PRIMARY KEY (`id_file`),
  ADD KEY `fkIdDoc` (`id_documents`),
  ADD KEY `fkidEtu` (`id_etu`),
  ADD KEY `fkIdFormation` (`id_formation`),
  ADD KEY `fkStatut` (`status`);

--
-- Indexes for table `Formation`
--
ALTER TABLE `Formation`
  ADD PRIMARY KEY (`id_formation`);

--
-- Indexes for table `Statuts`
--
ALTER TABLE `Statuts`
  ADD PRIMARY KEY (`id_statuts`);

--
-- Indexes for table `USER`
--
ALTER TABLE `USER`
  ADD KEY `fkIdUser` (`id_user`),
  ADD KEY `fkStatus` (`statuts`);

--
-- Indexes for table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`id_etudiant`),
  ADD KEY `fkStat` (`Status`),
  ADD KEY `fkFormation` (`choixFormation`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Documents`
--
ALTER TABLE `Documents`
  MODIFY `id_document` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `DocumentsFourni`
--
ALTER TABLE `DocumentsFourni`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `Formation`
--
ALTER TABLE `Formation`
  MODIFY `id_formation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Statuts`
--
ALTER TABLE `Statuts`
  MODIFY `id_statuts` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `id_etudiant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Documents`
--
ALTER TABLE `Documents`
  ADD CONSTRAINT `fkIdF` FOREIGN KEY (`idFormation`) REFERENCES `Formation` (`id_formation`);

--
-- Constraints for table `DocumentsFourni`
--
ALTER TABLE `DocumentsFourni`
  ADD CONSTRAINT `fkIdDoc` FOREIGN KEY (`id_documents`) REFERENCES `Documents` (`id_document`),
  ADD CONSTRAINT `fkIdFormation` FOREIGN KEY (`id_formation`) REFERENCES `Formation` (`id_formation`),
  ADD CONSTRAINT `fkStatut` FOREIGN KEY (`status`) REFERENCES `Statuts` (`id_statuts`),
  ADD CONSTRAINT `fkidEtu` FOREIGN KEY (`id_etu`) REFERENCES `Utilisateur` (`id_etudiant`);

--
-- Constraints for table `USER`
--
ALTER TABLE `USER`
  ADD CONSTRAINT `fkIdUser` FOREIGN KEY (`id_user`) REFERENCES `Utilisateur` (`id_etudiant`),
  ADD CONSTRAINT `fkStatus` FOREIGN KEY (`statuts`) REFERENCES `Statuts` (`id_statuts`);

--
-- Constraints for table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD CONSTRAINT `fkFormation` FOREIGN KEY (`choixFormation`) REFERENCES `Formation` (`id_formation`),
  ADD CONSTRAINT `fkStat` FOREIGN KEY (`Status`) REFERENCES `Statuts` (`id_statuts`);
