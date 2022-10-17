-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 26 juil. 2020 à 23:26
-- Version du serveur :  10.3.16-MariaDB
-- Version de PHP :  7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `successgate`
--

-- --------------------------------------------------------

--
-- Structure de la table `applications`
--

CREATE TABLE `applications` (
  `idApp` int(11) NOT NULL,
  `idPost` int(11) NOT NULL,
  `typePost` int(11) NOT NULL,
  `idApplier` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `applications`
--

INSERT INTO `applications` (`idApp`, `idPost`, `typePost`, `idApplier`, `idUser`) VALUES
(1, 1, 1, 2, 23),
(2, 3, 1, 2, 22),
(3, 2, 0, 1, 6),
(4, 4, 0, 2, 15),
(5, 2, 1, 2, 21),
(6, 2, 1, 5, 21),
(7, 1, 1, 1, 23),
(8, 5, 0, 1, 16),
(9, 5, 0, 2, 16),
(10, 2, 0, 8, 6),
(11, 3, 1, 8, 22);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `idC` int(11) NOT NULL,
  `cNom` varchar(50) NOT NULL,
  `cMail` varchar(50) NOT NULL,
  `cMsg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`idC`, `cNom`, `cMail`, `cMsg`) VALUES
(1, 'Nawfal Bouziane', 'nawfal@test.com', 'Hello World!');

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `idFav` int(11) NOT NULL,
  `idPost` int(11) NOT NULL,
  `typePost` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`idFav`, `idPost`, `typePost`, `idUser`) VALUES
(1, 2, 0, 1),
(2, 1, 0, 1),
(3, 1, 1, 1),
(4, 3, 1, 5),
(5, 7, 0, 5),
(6, 4, 0, 5),
(7, 3, 0, 5),
(8, 2, 1, 5),
(9, 2, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `idJob` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `descriptionJob` mediumtext NOT NULL,
  `typeJob` varchar(50) NOT NULL,
  `domaine` varchar(50) NOT NULL,
  `salaire` int(11) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `pays` varchar(50) NOT NULL,
  `dateDebut` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateFin` date NOT NULL,
  `pic` varchar(50) NOT NULL,
  `premium` int(11) NOT NULL DEFAULT 0,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `jobs`
--

INSERT INTO `jobs` (`idJob`, `titre`, `descriptionJob`, `typeJob`, `domaine`, `salaire`, `ville`, `pays`, `dateDebut`, `dateFin`, `pic`, `premium`, `idUser`) VALUES
(1, 'Server Administrator', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing. Variations of passages of lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing. Responsibility The applicants should have experience in the following areas. Have sound knowledge of commercial activities. Leadership, analytical, and problem-solving abilities. Should have vast knowledge in IAS/ IFRS, Company Act, Income Tax, VAT. Qualifications The applicants should have experience in the following areas. Have sound knowledge of commercial activities. Leadership, analytical, and problem-solving abilities. Should have vast knowledge in IAS/ IFRS, Company Act, Income Tax, VAT. Benefits There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing. ', 'Full-Time', 'Informatique', 8000, 'Rabat', 'Maroc', '2020-07-23 23:00:00', '2020-08-13', '1.png', 1, 3),
(2, 'Full Stack Developer', 'Poste Ã  occuper :\r\n\r\nâ€¢ DiplÃ´me supÃ©rieur en gestion et management\r\nâ€¢ Vous justifiez de 5 ans dâ€™expÃ©rience dans le pilotage et le management de projet sur plusieurs comptes client dans le secteur des centre dâ€™appels.\r\nâ€¢ Un excellent niveau linguistique en FranÃ§ais et en Anglais (Ã  l\'oral comme Ã  l\'Ã©crit)\r\nâ€¢ Sens du service client, des qualitÃ©s de leadership, de communication, dâ€™analyse et de rigueur.\r\nâ€¢ Force de proposition et capacitÃ© Ã  proposer des solutions qui feront la rÃ©ussite de sa mission.\r\nProfil recherchÃ© :\r\n\r\nNous recrutons un chef de projet qui aura pour mission de gÃ©rer une plateforme de production dÃ©finie, il aura la responsabilitÃ© du pilotage opÃ©rationnel dans le respect des objectifs quantitatifs et qualitatifs dÃ©finis.\r\nSous la responsabilitÃ© du Directeur GÃ©nÃ©ral, le chef de projet sera en charge des taches suivantes :\r\nâ€¢ Assurer la gestion de la relation client et la satisfaction client ;\r\nâ€¢ Piloter les projets ;\r\nâ€¢ Respecter les engagements contractuels ;\r\nâ€¢ Garantir le dÃ©ploiement et lâ€™application des process\r\nâ€¢ Garantir la qualitÃ© du service ;\r\nâ€¢ Assurer la coordination transversale avec les Ã©quipes ;\r\nâ€¢ PrÃ©parer et animer les comitÃ©s de pilotage ;\r\nâ€¢ Mettre en place le reporting interne et externe ;\r\nâ€¢ Analyser et exploiter les indicateurs par des plans dâ€™action ;\r\n\r\nLangue(s) exigÃ©e(s) :\r\nFranÃ§ais / Anglais', 'Remote-Work', 'Informatique', 5000, 'Casablanca', 'Maroc', '2020-07-24 23:00:00', '2020-10-08', '2.png', 1, 6),
(3, 'Cloud Server Manager', 'Poste Ã  occuper :\r\n\r\nâ€¢ DiplÃ´me supÃ©rieur en gestion et management\r\nâ€¢ Vous justifiez de 5 ans dâ€™expÃ©rience dans le pilotage et le management de projet sur plusieurs comptes client dans le secteur des centre dâ€™appels.\r\nâ€¢ Un excellent niveau linguistique en FranÃ§ais et en Anglais (Ã  l\'oral comme Ã  l\'Ã©crit)\r\nâ€¢ Sens du service client, des qualitÃ©s de leadership, de communication, dâ€™analyse et de rigueur.\r\nâ€¢ Force de proposition et capacitÃ© Ã  proposer des solutions qui feront la rÃ©ussite de sa mission.\r\nProfil recherchÃ© :\r\n\r\nNous recrutons un chef de projet qui aura pour mission de gÃ©rer une plateforme de production dÃ©finie, il aura la responsabilitÃ© du pilotage opÃ©rationnel dans le respect des objectifs quantitatifs et qualitatifs dÃ©finis.\r\nSous la responsabilitÃ© du Directeur GÃ©nÃ©ral, le chef de projet sera en charge des taches suivantes :\r\nâ€¢ Assurer la gestion de la relation client et la satisfaction client ;\r\nâ€¢ Piloter les projets ;\r\nâ€¢ Respecter les engagements contractuels ;\r\nâ€¢ Garantir le dÃ©ploiement et lâ€™application des process\r\nâ€¢ Garantir la qualitÃ© du service ;\r\nâ€¢ Assurer la coordination transversale avec les Ã©quipes ;\r\nâ€¢ PrÃ©parer et animer les comitÃ©s de pilotage ;\r\nâ€¢ Mettre en place le reporting interne et externe ;\r\nâ€¢ Analyser et exploiter les indicateurs par des plans dâ€™action ;\r\n\r\nLangue(s) exigÃ©e(s) :\r\nFranÃ§ais / Anglais', 'Part-Time', 'Informatique', 8000, 'Errachidia', 'Maroc', '2020-07-24 23:00:00', '2021-01-30', '7.png', 1, 14),
(4, 'Comptable Interimaire', 'Poste Ã  occuper :\r\n\r\nâ€¢ DiplÃ´me supÃ©rieur en gestion et management\r\nâ€¢ Vous justifiez de 5 ans dâ€™expÃ©rience dans le pilotage et le management de projet sur plusieurs comptes client dans le secteur des centre dâ€™appels.\r\nâ€¢ Un excellent niveau linguistique en FranÃ§ais et en Anglais (Ã  l\'oral comme Ã  l\'Ã©crit)\r\nâ€¢ Sens du service client, des qualitÃ©s de leadership, de communication, dâ€™analyse et de rigueur.\r\nâ€¢ Force de proposition et capacitÃ© Ã  proposer des solutions qui feront la rÃ©ussite de sa mission.\r\nProfil recherchÃ© :\r\n\r\nNous recrutons un chef de projet qui aura pour mission de gÃ©rer une plateforme de production dÃ©finie, il aura la responsabilitÃ© du pilotage opÃ©rationnel dans le respect des objectifs quantitatifs et qualitatifs dÃ©finis.\r\nSous la responsabilitÃ© du Directeur GÃ©nÃ©ral, le chef de projet sera en charge des taches suivantes :\r\nâ€¢ Assurer la gestion de la relation client et la satisfaction client ;\r\nâ€¢ Piloter les projets ;\r\nâ€¢ Respecter les engagements contractuels ;\r\nâ€¢ Garantir le dÃ©ploiement et lâ€™application des process\r\nâ€¢ Garantir la qualitÃ© du service ;\r\nâ€¢ Assurer la coordination transversale avec les Ã©quipes ;\r\nâ€¢ PrÃ©parer et animer les comitÃ©s de pilotage ;\r\nâ€¢ Mettre en place le reporting interne et externe ;\r\nâ€¢ Analyser et exploiter les indicateurs par des plans dâ€™action ;\r\n\r\nLangue(s) exigÃ©e(s) :\r\nFranÃ§ais / Anglais', 'Remote-Work', 'Economy', 5000, 'Meknes', 'Maroc', '2020-07-25 23:00:00', '2020-09-15', '8.png', 1, 15),
(5, 'Laravel and VueJS Developer', 'Poste Ã  occuper :\r\n\r\nâ€¢ DiplÃ´me supÃ©rieur en gestion et management\r\nâ€¢ Vous justifiez de 5 ans dâ€™expÃ©rience dans le pilotage et le management de projet sur plusieurs comptes client dans le secteur des centre dâ€™appels.\r\nâ€¢ Un excellent niveau linguistique en FranÃ§ais et en Anglais (Ã  l\'oral comme Ã  l\'Ã©crit)\r\nâ€¢ Sens du service client, des qualitÃ©s de leadership, de communication, dâ€™analyse et de rigueur.\r\nâ€¢ Force de proposition et capacitÃ© Ã  proposer des solutions qui feront la rÃ©ussite de sa mission.\r\nProfil recherchÃ© :\r\n\r\nNous recrutons un chef de projet qui aura pour mission de gÃ©rer une plateforme de production dÃ©finie, il aura la responsabilitÃ© du pilotage opÃ©rationnel dans le respect des objectifs quantitatifs et qualitatifs dÃ©finis.\r\nSous la responsabilitÃ© du Directeur GÃ©nÃ©ral, le chef de projet sera en charge des taches suivantes :\r\nâ€¢ Assurer la gestion de la relation client et la satisfaction client ;\r\nâ€¢ Piloter les projets ;\r\nâ€¢ Respecter les engagements contractuels ;\r\nâ€¢ Garantir le dÃ©ploiement et lâ€™application des process\r\nâ€¢ Garantir la qualitÃ© du service ;\r\nâ€¢ Assurer la coordination transversale avec les Ã©quipes ;\r\nâ€¢ PrÃ©parer et animer les comitÃ©s de pilotage ;\r\nâ€¢ Mettre en place le reporting interne et externe ;\r\nâ€¢ Analyser et exploiter les indicateurs par des plans dâ€™action ;\r\n\r\nLangue(s) exigÃ©e(s) :\r\nFranÃ§ais / Anglais', 'Full-Time', 'Computer Science', 10000, 'Tanger', 'Maroc', '2020-07-25 21:50:50', '2021-07-30', '9.png', 0, 16),
(6, 'Agent de Ventes', 'Poste Ã  occuper :\r\n\r\nâ€¢ DiplÃ´me supÃ©rieur en gestion et management\r\nâ€¢ Vous justifiez de 5 ans dâ€™expÃ©rience dans le pilotage et le management de projet sur plusieurs comptes client dans le secteur des centre dâ€™appels.\r\nâ€¢ Un excellent niveau linguistique en FranÃ§ais et en Anglais (Ã  l\'oral comme Ã  l\'Ã©crit)\r\nâ€¢ Sens du service client, des qualitÃ©s de leadership, de communication, dâ€™analyse et de rigueur.\r\nâ€¢ Force de proposition et capacitÃ© Ã  proposer des solutions qui feront la rÃ©ussite de sa mission.\r\nProfil recherchÃ© :\r\n\r\nNous recrutons un chef de projet qui aura pour mission de gÃ©rer une plateforme de production dÃ©finie, il aura la responsabilitÃ© du pilotage opÃ©rationnel dans le respect des objectifs quantitatifs et qualitatifs dÃ©finis.\r\nSous la responsabilitÃ© du Directeur GÃ©nÃ©ral, le chef de projet sera en charge des taches suivantes :\r\nâ€¢ Assurer la gestion de la relation client et la satisfaction client ;\r\nâ€¢ Piloter les projets ;\r\nâ€¢ Respecter les engagements contractuels ;\r\nâ€¢ Garantir le dÃ©ploiement et lâ€™application des process\r\nâ€¢ Garantir la qualitÃ© du service ;\r\nâ€¢ Assurer la coordination transversale avec les Ã©quipes ;\r\nâ€¢ PrÃ©parer et animer les comitÃ©s de pilotage ;\r\nâ€¢ Mettre en place le reporting interne et externe ;\r\nâ€¢ Analyser et exploiter les indicateurs par des plans dâ€™action ;\r\n\r\nLangue(s) exigÃ©e(s) :\r\nFranÃ§ais / Anglais', 'Part-Time', 'Economics', 5000, 'Taza', 'Maroc', '2020-07-25 21:55:46', '2020-07-30', '10.png', 1, 17),
(7, 'Data Analyst', 'Poste Ã  occuper :\r\n\r\nâ€¢ DiplÃ´me supÃ©rieur en gestion et management\r\nâ€¢ Vous justifiez de 5 ans dâ€™expÃ©rience dans le pilotage et le management de projet sur plusieurs comptes client dans le secteur des centre dâ€™appels.\r\nâ€¢ Un excellent niveau linguistique en FranÃ§ais et en Anglais (Ã  l\'oral comme Ã  l\'Ã©crit)\r\nâ€¢ Sens du service client, des qualitÃ©s de leadership, de communication, dâ€™analyse et de rigueur.\r\nâ€¢ Force de proposition et capacitÃ© Ã  proposer des solutions qui feront la rÃ©ussite de sa mission.\r\nProfil recherchÃ© :\r\n\r\nNous recrutons un chef de projet qui aura pour mission de gÃ©rer une plateforme de production dÃ©finie, il aura la responsabilitÃ© du pilotage opÃ©rationnel dans le respect des objectifs quantitatifs et qualitatifs dÃ©finis.\r\nSous la responsabilitÃ© du Directeur GÃ©nÃ©ral, le chef de projet sera en charge des taches suivantes :\r\nâ€¢ Assurer la gestion de la relation client et la satisfaction client ;\r\nâ€¢ Piloter les projets ;\r\nâ€¢ Respecter les engagements contractuels ;\r\nâ€¢ Garantir le dÃ©ploiement et lâ€™application des process\r\nâ€¢ Garantir la qualitÃ© du service ;\r\nâ€¢ Assurer la coordination transversale avec les Ã©quipes ;\r\nâ€¢ PrÃ©parer et animer les comitÃ©s de pilotage ;\r\nâ€¢ Mettre en place le reporting interne et externe ;\r\nâ€¢ Analyser et exploiter les indicateurs par des plans dâ€™action ;\r\n\r\nLangue(s) exigÃ©e(s) :\r\nFranÃ§ais / Anglais', 'Full-Time', 'Engineering and Technology', 10000, 'Paris', 'France', '2020-07-25 22:00:19', '2020-11-30', '11.png', 0, 18);

-- --------------------------------------------------------

--
-- Structure de la table `scholarships`
--

CREATE TABLE `scholarships` (
  `idBourse` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `descriptionBourse` mediumtext NOT NULL,
  `typeBourse` varchar(50) NOT NULL,
  `specialite` varchar(50) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `pays` varchar(50) NOT NULL,
  `dateDebut` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateFin` date NOT NULL,
  `nivEtudes` varchar(30) NOT NULL,
  `pic` varchar(50) NOT NULL,
  `premium` int(11) NOT NULL DEFAULT 0,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `scholarships`
--

INSERT INTO `scholarships` (`idBourse`, `titre`, `descriptionBourse`, `typeBourse`, `specialite`, `ville`, `pays`, `dateDebut`, `dateFin`, `nivEtudes`, `pic`, `premium`, `idUser`) VALUES
(1, 'Computer Science Scholarship', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing.\r\n\r\nVariations of passages of lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing.\r\nResponsibility\r\n\r\n    The applicants should have experience in the following areas.\r\n    Have sound knowledge of commercial activities.\r\n    Leadership, analytical, and problem-solving abilities.\r\n    Should have vast knowledge in IAS/ IFRS, Company Act, Income Tax, VAT.\r\n\r\nQualifications\r\n\r\n    The applicants should have experience in the following areas.\r\n    Have sound knowledge of commercial activities.\r\n    Leadership, analytical, and problem-solving abilities.\r\n    Should have vast knowledge in IAS/ IFRS, Company Act, Income Tax, VAT.\r\n\r\nBenefits\r\n\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing.\r\n', 'Full-Scholarship', 'Computer Science', 'Cambridge', 'England', '2020-07-25 22:22:38', '2020-09-30', 'Bac +3', '5.png', 1, 23),
(2, 'Medecine Scholarship', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing.\r\n\r\nVariations of passages of lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing.\r\nResponsibility\r\n\r\n    The applicants should have experience in the following areas.\r\n    Have sound knowledge of commercial activities.\r\n    Leadership, analytical, and problem-solving abilities.\r\n    Should have vast knowledge in IAS/ IFRS, Company Act, Income Tax, VAT.\r\n\r\nQualifications\r\n\r\n    The applicants should have experience in the following areas.\r\n    Have sound knowledge of commercial activities.\r\n    Leadership, analytical, and problem-solving abilities.\r\n    Should have vast knowledge in IAS/ IFRS, Company Act, Income Tax, VAT.\r\n\r\nBenefits\r\n\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing.\r\n', 'Full-Scholarship', 'Medecine', 'Nantes', 'France', '2020-07-25 22:22:38', '2020-12-31', 'Bac', '12.png', 1, 21),
(3, 'Agronomy Scholarship', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing.\r\n\r\nVariations of passages of lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing.\r\nResponsibility\r\n\r\n    The applicants should have experience in the following areas.\r\n    Have sound knowledge of commercial activities.\r\n    Leadership, analytical, and problem-solving abilities.\r\n    Should have vast knowledge in IAS/ IFRS, Company Act, Income Tax, VAT.\r\n\r\nQualifications\r\n\r\n    The applicants should have experience in the following areas.\r\n    Have sound knowledge of commercial activities.\r\n    Leadership, analytical, and problem-solving abilities.\r\n    Should have vast knowledge in IAS/ IFRS, Company Act, Income Tax, VAT.\r\n\r\nBenefits\r\n\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing.\r\n', 'Transfer-Scholarship', 'Natural Sciences', 'London', 'England', '2020-07-25 22:22:38', '2021-01-01', 'Bac +2', '13.png', 1, 22);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `libelle` varchar(100) DEFAULT NULL,
  `telephone` int(11) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `pays` varchar(50) NOT NULL,
  `codePost` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `avatar` varchar(50) NOT NULL DEFAULT '0.png',
  `description` mediumtext NOT NULL,
  `regComm` varchar(50) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `cv` varchar(50) DEFAULT NULL,
  `secteur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idUser`, `nom`, `prenom`, `libelle`, `telephone`, `adresse`, `ville`, `pays`, `codePost`, `email`, `password`, `avatar`, `description`, `regComm`, `type`, `cv`, `secteur`) VALUES
(1, 'Hachmi', 'Amine', NULL, 621330569, '22 Lot. El Waha Errachidia', 'Errachidia', 'Maroc', 52000, 'amine@test.com', 'test', '25.png', 'Full Stack Developer and UI/UX Designer', NULL, 0, NULL, NULL),
(2, 'Bouziane', 'Wadii', NULL, 612345678, '123 Lot. El Waha Errachidia', 'Errachidia', 'Maroc', 52000, 'wadii@test.com', 'test', '31.png', 'Back-end Developer and White-hat hacker', NULL, 0, NULL, NULL),
(3, NULL, NULL, 'Atica Corp', 535570001, '514 Lot. Riad Rabat', 'Rabat', 'Maroc', 10000, 'contact@atica.com', 'test', '1.png', 'UI/UX Design Company', NULL, 1, NULL, 1),
(4, 'Ajana', 'Hamza', NULL, 666006600, '976 Lotissement Jirari', 'Tanger', 'Maroc', 90060, 'hamza@test.com', 'test', '42.png', 'Expert comptable', NULL, 0, NULL, NULL),
(5, 'Hachmi', 'Houssine', NULL, 2147483647, '8964 Ruskivotsh Novgorod', 'Novgorod', 'Russia', 603000, 'houssine@test.com', 'test', '38.png', 'Expert Dentist', NULL, 0, NULL, NULL),
(6, NULL, NULL, 'Proflowers Company', 2147483647, '33 Quartier Sijilmassa', 'Errachidia', 'Maroc', 52000, 'contact@proflowers.com', 'test', '17.png', 'We are a flowers business that provides flower decorations for different occasions such as, meetings, weddings, conferences ...etc', NULL, 1, NULL, 1),
(7, NULL, NULL, 'Al Akhawayn University', 535862004, 'Box 104, Hassan II Avenue', 'Ifrane', 'Maroc', 53000, 'contact@alakhawayn.com', 'test', '6.png', 'Al Akhawayn University redefines the classic American liberal arts educational experience on an architecturally stunning modern campus', NULL, 2, NULL, 1),
(8, 'Abidi', 'Morad', NULL, 980164214, '53 Lotissement El Waha', 'Errachidia', 'Maroc', 52000, 'morad@test.com', 'test', '47.png', 'UI/UX Designer', NULL, 0, NULL, NULL),
(9, 'Bassalem', 'Younes', NULL, 2147483647, '891 Rue Agdoud, Al Mohit', 'Errachidia', 'Maroc', 52000, 'younes@test.com', 'test', '43.png', 'Web Developer & BeatMaker', NULL, 0, NULL, NULL),
(10, 'Belmoubarik', 'Merouane', NULL, 2147483647, '78 Quartier Ain El Ati 1', 'Errachidia', 'Maroc', 52000, 'merouane@test.com', 'test', '36.png', 'Electrical Engineering Student', NULL, 0, NULL, NULL),
(11, 'Belmoubarik', 'Mustapha', NULL, 612789416, '78 Quartier Ain El Ati 1', 'Errachidia', 'Maroc', 52000, 'must@test.com', 'test', '26.png', 'Sales Agent', NULL, 0, NULL, NULL),
(12, 'Naji', 'Taha', NULL, 678124912, '102 Lotissement maaref', 'Rissani', 'Maroc', 52000, 'taha@test.com', 'test', '49.png', 'CMS Web Developer', NULL, 0, NULL, NULL),
(13, 'Larhdid', 'Ilyas', NULL, 2147483647, '512 Lotissement ourssingh', 'Goulmima', 'Maroc', 52250, 'ilyas@test.com', 'test', '48.png', 'Games Development Student', NULL, 0, NULL, NULL),
(14, NULL, NULL, 'Aven Company', 2147483647, '4330 Varsity Drive, Ann Arbor', 'Michigan', 'United States Of America', 48108, 'contact@aven.com', 'test', '7.png', 'Aven manufactures and distributes optical instruments and precision tools for industrial, scientific, medical and education markets globally.', NULL, 1, NULL, 1),
(15, NULL, NULL, 'Asgardia LLC', 2147483647, '3945 FORBES AVE, SUITE 153', 'Pittsburgh', 'United States Of America', 15213, 'contact@asgardia.com', 'test', '3.png', 'Asgardia Global Holdings LLC is registered & based in the state of Pennsylvania, and currently is being identified as a privately held company in the US.  ', NULL, 1, NULL, 1),
(16, NULL, NULL, 'FoxHub Corp', 2147483647, '30 Richmond Place', 'Brighton', 'England ', 89610, 'contact@foxhub.com', 'test', '18.png', 'FoxHub is an award-winning brand content production company that tells stories with heart.', NULL, 1, NULL, 0),
(17, NULL, NULL, 'Musically', 2147483647, 'Santa Monica Blvd, Los Angeles', 'California', 'United States Of America', 90010, 'contact@musically.com', 'test', '20.png', 'Musically is the leading destination for short-form mobile video and our mission is to inspire creativity and bring joy.', NULL, 1, NULL, 1),
(18, NULL, NULL, 'GameTV', 698174250, '5 Rue Soumaya', 'Casablanca', 'Maroc', 10000, 'contact@gametv.com', 'test', '22.png', 'We are GameTV : a global community of millions who come together each day to create the future of live entertainment.', NULL, 1, NULL, 1),
(19, NULL, NULL, 'Fossa LLC', 2147483647, '114 Rue Med', 'Tanger', 'Maroc', 90060, 'contact@fossa.com', 'test', '19.png', 'FOSSA builds the infrastructure for modern teams to be successful with open source.', NULL, 1, NULL, 1),
(20, NULL, NULL, 'Manhatten Art University', 413513513, 'Box 201, Queen Street', 'New York', 'United States Of America ', 20080, 'contact@manhatten.com', 'test', '4.png', 'Manhattan College is a private, Roman Catholic, liberal arts college in the Bronx in New York City.', NULL, 2, NULL, 1),
(21, NULL, NULL, 'Centrale Nantes University', 413513513, 'Box 201, Louvre Street', 'Nantes', 'France', 10480, 'contact@nantes.com', 'test', '12.png', 'Ecole Centrale de Nantes is a Grande Ecole of Engineering - a French elite engineering school - established in 1919 under the name of Western Institut Polytechnique.', NULL, 2, NULL, 1),
(22, NULL, NULL, 'University Of Oxford', 89756467, 'Oxford OX1 2JD', 'London', 'England', 85670, 'contact@oxford.com', 'test', '16.png', 'The University of Oxford is a collegiate research university in Oxford, England.', NULL, 2, NULL, 1),
(23, NULL, NULL, 'Harvard University', 18976730, 'Cambridge, MA', 'Cambridge', 'United States Of America', 80000, 'contact@harvard.com', 'test', '14.png', 'Harvard University is a private Ivy League research university in Cambridge, Massachusetts.', NULL, 2, NULL, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`idApp`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`idC`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`idFav`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`idJob`);

--
-- Index pour la table `scholarships`
--
ALTER TABLE `scholarships`
  ADD PRIMARY KEY (`idBourse`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `applications`
--
ALTER TABLE `applications`
  MODIFY `idApp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `idC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `favoris`
--
ALTER TABLE `favoris`
  MODIFY `idFav` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `idJob` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `scholarships`
--
ALTER TABLE `scholarships`
  MODIFY `idBourse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
