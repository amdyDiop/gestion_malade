-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 19 fév. 2021 à 17:21
-- Version du serveur :  8.0.23-0ubuntu0.20.04.1
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_des_malades`
--

-- --------------------------------------------------------

--
-- Structure de la table `caissier`
--

CREATE TABLE `caissier` (
  `id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `caissier`
--

INSERT INTO `caissier` (`id`, `user_id`) VALUES
(1, 8);

-- --------------------------------------------------------

--
-- Structure de la table `constante`
--

CREATE TABLE `constante` (
  `id` int NOT NULL,
  `infirmier_id` int NOT NULL,
  `patient_id` int NOT NULL,
  `tenssion` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pression` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pouls` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temperature` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `constante`
--

INSERT INTO `constante` (`id`, `infirmier_id`, `patient_id`, `tenssion`, `pression`, `pouls`, `temperature`, `created_at`) VALUES
(1, 1, 1, '23.4', '54', '34', '37.4', '2021-01-29 18:09:52');

-- --------------------------------------------------------

--
-- Structure de la table `docteur`
--

CREATE TABLE `docteur` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `specialite_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `docteur`
--

INSERT INTO `docteur` (`id`, `user_id`, `specialite_id`) VALUES
(1, 10, 2);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20201122165033', '2020-11-22 16:50:44', 494),
('DoctrineMigrations\\Version20201122165444', '2020-11-22 16:54:48', 84);

-- --------------------------------------------------------

--
-- Structure de la table `infirmier`
--

CREATE TABLE `infirmier` (
  `id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `infirmier`
--

INSERT INTO `infirmier` (`id`, `user_id`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `maladie`
--

CREATE TABLE `maladie` (
  `id` int NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `medicament`
--

CREATE TABLE `medicament` (
  `id` int NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `medicament`
--

INSERT INTO `medicament` (`id`, `libelle`) VALUES
(1, 'doliprane'),
(2, 'CA500'),
(3, 'nivacrine'),
(4, 'nioquete'),
(5, 'oki'),
(9, 'new medoc'),
(10, 'docxi 200');

-- --------------------------------------------------------

--
-- Structure de la table `ordenance`
--

CREATE TABLE `ordenance` (
  `id` int NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ordenance`
--

INSERT INTO `ordenance` (`id`, `created_at`) VALUES
(3, '2021-02-04 11:10:16'),
(4, '2021-02-04 11:15:01'),
(5, '2021-02-04 13:21:18'),
(6, '2021-02-04 13:29:19'),
(7, '2021-02-04 13:31:01'),
(8, '2021-02-04 13:31:19'),
(9, '2021-02-04 13:36:26'),
(10, '2021-02-04 13:37:00');

-- --------------------------------------------------------

--
-- Structure de la table `ordenance_medicament`
--

CREATE TABLE `ordenance_medicament` (
  `ordenance_id` int NOT NULL,
  `medicament_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ordenance_medicament`
--

INSERT INTO `ordenance_medicament` (`ordenance_id`, `medicament_id`) VALUES
(3, 1),
(3, 2),
(3, 9),
(4, 5),
(4, 9),
(4, 10),
(5, 1),
(5, 2),
(6, 10),
(7, 9),
(8, 1),
(8, 2),
(9, 9),
(10, 1);

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id`, `user_id`) VALUES
(1, 4),
(2, 5),
(3, 6),
(4, 7),
(5, 9),
(7, 15),
(9, 18),
(10, 20);

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE `profil` (
  `id` int NOT NULL,
  `libelle` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `profil`
--

INSERT INTO `profil` (`id`, `libelle`, `code`) VALUES
(1, 'ROLE_CAISSIER', 'CAISSE'),
(2, 'ROLE_ADMIN', 'ADM'),
(3, 'ROLE_INFIRMIER', 'INF'),
(4, 'ROLE_DOCTEUR', 'DOC'),
(5, 'ROLE_PATIENT', 'PA');

-- --------------------------------------------------------

--
-- Structure de la table `specialite`
--

CREATE TABLE `specialite` (
  `id` int NOT NULL,
  `libelle` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `specialite`
--

INSERT INTO `specialite` (`id`, `libelle`) VALUES
(1, 'ophtalmologue'),
(2, 'general'),
(3, 'cardiologue');

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

CREATE TABLE `ticket` (
  `id` int NOT NULL,
  `caissier_id` int NOT NULL,
  `patient_id` int DEFAULT NULL,
  `type_visite_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `montant` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ticket`
--

INSERT INTO `ticket` (`id`, `caissier_id`, `patient_id`, `type_visite_id`, `created_at`, `montant`) VALUES
(1, 1, 1, 1, '2021-01-29 08:19:20', 3000),
(2, 1, 4, 2, '2021-01-30 10:19:30', 4000),
(3, 1, 2, 3, '2021-01-30 10:29:36', 2500),
(4, 1, 3, 2, '2021-01-31 09:05:50', 2900),
(5, 1, 5, 4, '2021-02-01 08:55:04', 129483),
(6, 1, 3, 5, '2021-02-01 12:11:20', 3000),
(7, 1, 7, 5, '2021-02-01 12:42:19', 3000),
(8, 1, 9, 6, '2021-02-01 12:47:51', 43242),
(9, 1, 10, 3, '2021-02-01 12:50:10', 4000);

-- --------------------------------------------------------

--
-- Structure de la table `type_visite`
--

CREATE TABLE `type_visite` (
  `id` int NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_visite`
--

INSERT INTO `type_visite` (`id`, `libelle`) VALUES
(1, 'visite médical'),
(2, 'annalyse sanguine'),
(3, 'visite contre visite'),
(4, 'Dakar'),
(5, 'bilan'),
(6, 'kfsjgousgw');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cni` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naiss` datetime NOT NULL,
  `telephone` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profil_id` int NOT NULL,
  `pseudo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `prenom`, `nom`, `adresse`, `cni`, `date_naiss`, `telephone`, `profil_id`, `pseudo`) VALUES
(2, 'admin@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$AjNHdHPLv2cxFmKh0ZHTeQ$M9LYfVnysLTm7VKHP1uRHMitrz6XwYSpBJDG+dyk/Ss', 'admin', 'admin', 'yoof', '1874334345', '1993-12-15 23:30:00', '774382948', 4, 'admin'),
(3, 'infirmier@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$AjNHdHPLv2cxFmKh0ZHTeQ$M9LYfVnysLTm7VKHP1uRHMitrz6XwYSpBJDG+dyk/Ss', 'Amamadou', 'MBENGUE', 'PA unité 12', '1874334345', '1993-12-15 23:30:00', '774382948', 3, 'infirmier'),
(4, 'mbodj10@gmail.com', '[]', NULL, 'moustapha', 'mbodj', 'KEURY SOUF RUFISQUE', '1728309499940', '1983-01-01 00:00:00', '767794204', 5, NULL),
(5, 'nafi48@gmail.com', '[]', NULL, 'Nafi', 'NDIAYE', 'Thiès Nord', '93875374359453', '1981-10-01 00:00:00', '768349842', 5, NULL),
(6, 'alime09@gmail.com', '[]', NULL, 'alima', 'fall', 'tamba', '12294837405974', '1995-10-16 00:00:00', '708237843', 5, NULL),
(7, 'atcheikh@gmail.com', '[]', NULL, 'cheikkh At', 'Seck', 'parcelles U12', '73482947897395', '1996-10-14 00:00:00', '778347344', 5, NULL),
(8, 'caissier@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$AjNHdHPLv2cxFmKh0ZHTeQ$M9LYfVnysLTm7VKHP1uRHMitrz6XwYSpBJDG+dyk/Ss', 'ilimane', 'faye', 'thies, darou salam', '1728199309543', '1991-12-15 23:30:00', '774382948', 1, 'caissier'),
(9, 'amdymila@gmail.com', '[]', NULL, 'Amdy', 'DIOP', 'KEURY SOUF RUFISQUE', '', '2021-02-01 08:55:04', '0781260199', 5, NULL),
(10, 'medecin@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$AjNHdHPLv2cxFmKh0ZHTeQ$M9LYfVnysLTm7VKHP1uRHMitrz6XwYSpBJDG+dyk/Ss', 'amdy', 'Diop', 'Nord Foir', '1728199300945', '1993-08-27 23:30:00', '777794204', 4, 'medecin'),
(15, 'magui12@gmail.com', '[]', NULL, 'maguichette', 'gueye', 'hlm grand louga', '2373642764', '1994-02-01 00:00:00', '708798304', 5, NULL),
(18, 'nogs98@gmail.com', '[]', NULL, 'nogaye', 'ndiaye', 'police parselle', '498375', '1998-02-01 00:00:00', '769583928', 5, NULL),
(20, 'gueyeprince@gmail.com', '[]', NULL, 'mamadou', 'gueye', 'dakar plateau', '1290843498753', '1991-02-01 00:00:00', '787636488', 5, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `visite`
--

CREATE TABLE `visite` (
  `id` int NOT NULL,
  `patient_id` int DEFAULT NULL,
  `docteur_id` int NOT NULL,
  `ordenance_id` int DEFAULT NULL,
  `date_visite` datetime NOT NULL,
  `rv` datetime DEFAULT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `visite`
--

INSERT INTO `visite` (`id`, `patient_id`, `docteur_id`, `ordenance_id`, `date_visite`, `rv`, `note`) VALUES
(1, 1, 1, 3, '2021-02-04 11:10:16', '2016-01-01 00:00:00', 'bvcyfx ygutd'),
(2, 1, 1, 4, '2021-02-04 11:15:01', '2021-02-15 08:00:00', 'kii leegui mou dee laaye'),
(3, 5, 1, 5, '2021-02-04 13:21:18', '2020-06-14 00:00:00', 'wer ga yaw'),
(4, 4, 1, 6, '2021-02-04 13:29:19', '2020-11-01 00:00:00', 'yaw baaal leek lou niine'),
(5, 4, 1, 7, '2021-02-04 13:31:01', '2020-09-14 10:00:00', 'yaw keen khamoul loula dale'),
(6, 4, 1, 8, '2021-02-04 13:31:19', '2020-09-14 10:00:00', 'yaw keen khamoul loula dale'),
(7, 9, 1, 9, '2021-02-04 13:36:26', '2024-01-01 00:00:00', 'da ga corona'),
(8, 4, 1, 10, '2021-02-04 13:37:00', '2016-01-01 00:00:00', 'sdfkjshdug skdlghuisd');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `caissier`
--
ALTER TABLE `caissier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1F038BC2A76ED395` (`user_id`);

--
-- Index pour la table `constante`
--
ALTER TABLE `constante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_67194A69C2BE0752` (`infirmier_id`),
  ADD KEY `IDX_67194A696B899279` (`patient_id`);

--
-- Index pour la table `docteur`
--
ALTER TABLE `docteur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_83A7A439A76ED395` (`user_id`),
  ADD KEY `IDX_83A7A4392195E0F0` (`specialite_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `infirmier`
--
ALTER TABLE `infirmier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_BFEC55B9A76ED395` (`user_id`);

--
-- Index pour la table `maladie`
--
ALTER TABLE `maladie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `medicament`
--
ALTER TABLE `medicament`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ordenance`
--
ALTER TABLE `ordenance`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ordenance_medicament`
--
ALTER TABLE `ordenance_medicament`
  ADD PRIMARY KEY (`ordenance_id`,`medicament_id`),
  ADD KEY `IDX_FC4B90AD89133B9` (`ordenance_id`),
  ADD KEY `IDX_FC4B90AAB0D61F7` (`medicament_id`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1ADAD7EBA76ED395` (`user_id`);

--
-- Index pour la table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `specialite`
--
ALTER TABLE `specialite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_97A0ADA3B514973B` (`caissier_id`),
  ADD KEY `IDX_97A0ADA36B899279` (`patient_id`),
  ADD KEY `IDX_97A0ADA375039D49` (`type_visite_id`);

--
-- Index pour la table `type_visite`
--
ALTER TABLE `type_visite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD KEY `IDX_8D93D649275ED078` (`profil_id`);

--
-- Index pour la table `visite`
--
ALTER TABLE `visite`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_B09C8CBBD89133B9` (`ordenance_id`),
  ADD KEY `IDX_B09C8CBB6B899279` (`patient_id`),
  ADD KEY `IDX_B09C8CBBCF22540A` (`docteur_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `caissier`
--
ALTER TABLE `caissier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `constante`
--
ALTER TABLE `constante`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `docteur`
--
ALTER TABLE `docteur`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `infirmier`
--
ALTER TABLE `infirmier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `maladie`
--
ALTER TABLE `maladie`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `medicament`
--
ALTER TABLE `medicament`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `ordenance`
--
ALTER TABLE `ordenance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `profil`
--
ALTER TABLE `profil`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `specialite`
--
ALTER TABLE `specialite`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `type_visite`
--
ALTER TABLE `type_visite`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `visite`
--
ALTER TABLE `visite`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `caissier`
--
ALTER TABLE `caissier`
  ADD CONSTRAINT `FK_1F038BC2A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `constante`
--
ALTER TABLE `constante`
  ADD CONSTRAINT `FK_67194A696B899279` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`),
  ADD CONSTRAINT `FK_67194A69C2BE0752` FOREIGN KEY (`infirmier_id`) REFERENCES `infirmier` (`id`);

--
-- Contraintes pour la table `docteur`
--
ALTER TABLE `docteur`
  ADD CONSTRAINT `FK_83A7A4392195E0F0` FOREIGN KEY (`specialite_id`) REFERENCES `specialite` (`id`),
  ADD CONSTRAINT `FK_83A7A439A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `infirmier`
--
ALTER TABLE `infirmier`
  ADD CONSTRAINT `FK_BFEC55B9A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `ordenance_medicament`
--
ALTER TABLE `ordenance_medicament`
  ADD CONSTRAINT `FK_FC4B90AAB0D61F7` FOREIGN KEY (`medicament_id`) REFERENCES `medicament` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_FC4B90AD89133B9` FOREIGN KEY (`ordenance_id`) REFERENCES `ordenance` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `FK_1ADAD7EBA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `FK_97A0ADA36B899279` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`),
  ADD CONSTRAINT `FK_97A0ADA375039D49` FOREIGN KEY (`type_visite_id`) REFERENCES `type_visite` (`id`),
  ADD CONSTRAINT `FK_97A0ADA3B514973B` FOREIGN KEY (`caissier_id`) REFERENCES `caissier` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649275ED078` FOREIGN KEY (`profil_id`) REFERENCES `profil` (`id`);

--
-- Contraintes pour la table `visite`
--
ALTER TABLE `visite`
  ADD CONSTRAINT `FK_B09C8CBB6B899279` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`),
  ADD CONSTRAINT `FK_B09C8CBBCF22540A` FOREIGN KEY (`docteur_id`) REFERENCES `docteur` (`id`),
  ADD CONSTRAINT `FK_B09C8CBBD89133B9` FOREIGN KEY (`ordenance_id`) REFERENCES `ordenance` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
