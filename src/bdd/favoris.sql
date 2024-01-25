-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 25 jan. 2024 à 10:09
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `favoris`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_cat` int(11) NOT NULL,
  `nom_cat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_cat`, `nom_cat`) VALUES
(1, 'E-learning'),
(2, 'HTML'),
(3, 'CSS'),
(4, 'Maquette'),
(5, 'Site/Blog'),
(6, 'E-projet'),
(7, 'Cheatsheet'),
(8, 'Bootstrap'),
(9, 'Support-PDF'),
(10, 'Ressources/Aides'),
(11, 'Javascript'),
(12, 'Wordpress'),
(13, 'Outil'),
(14, 'Video'),
(15, 'API');

-- --------------------------------------------------------

--
-- Structure de la table `cat_fav`
--

CREATE TABLE `cat_fav` (
  `id_fav` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cat_fav`
--

INSERT INTO `cat_fav` (`id_fav`, `id_cat`) VALUES
(1, 1),
(1, 4),
(2, 2),
(2, 3),
(2, 5),
(3, 2),
(3, 3),
(3, 5),
(7, 2),
(7, 3),
(7, 5),
(7, 6),
(8, 5),
(9, 1),
(9, 2),
(9, 3),
(10, 2),
(10, 7),
(11, 3),
(11, 7),
(12, 5),
(12, 8),
(13, 1),
(13, 8),
(14, 7),
(14, 8),
(15, 9),
(15, 11),
(16, 1),
(16, 11),
(17, 5),
(17, 11),
(18, 5),
(18, 11),
(19, 5),
(19, 11),
(20, 7),
(20, 11),
(21, 1),
(21, 11),
(22, 1),
(22, 11),
(23, 10),
(23, 12),
(24, 2),
(24, 6),
(24, 10),
(24, 12),
(25, 10),
(25, 12),
(26, 10),
(26, 12),
(27, 14),
(27, 15),
(28, 1),
(28, 15),
(29, 5),
(29, 11),
(29, 15),
(30, 5),
(30, 11),
(30, 15),
(31, 11),
(31, 14),
(31, 15),
(32, 11),
(32, 14),
(32, 15),
(33, 13),
(33, 15);

-- --------------------------------------------------------

--
-- Structure de la table `domaine`
--

CREATE TABLE `domaine` (
  `id_dom` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `domaine`
--

INSERT INTO `domaine` (`id_dom`, `nom`) VALUES
(1, 'Maquettage/Figma'),
(2, 'HTML-CSS'),
(3, 'Javascript'),
(4, 'Wordpress'),
(5, 'API'),
(6, 'Bootstrap');

-- --------------------------------------------------------

--
-- Structure de la table `favori`
--

CREATE TABLE `favori` (
  `id_fav` int(11) NOT NULL,
  `libelle` varchar(250) NOT NULL,
  `date_creation` date NOT NULL,
  `url` varchar(2500) NOT NULL,
  `id_dom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favori`
--

INSERT INTO `favori` (`id_fav`, `libelle`, `date_creation`, `url`, `id_dom`) VALUES
(1, 'OpenClassRoom Maquette figma', '2024-01-16', 'https://openclassrooms.com/fr/courses/8242681-integrez-une-maquette-figma-en-html-css', 1),
(2, 'MSDN Début', '2024-01-17', 'https://developer.mozilla.org/fr/docs/Learn/Getting_started_with_the_web/HTML_basics', 2),
(3, 'MSDN Première étape CSS', '2024-01-18', 'https://developer.mozilla.org/fr/docs/Learn/CSS/First_steps', 2),
(7, 'Introduction HTML eprojet', '2024-01-19', 'https://www.eprojet.fr/cours/html_css/01-html_css-introduction-html-css', 2),
(8, 'W3School intro', '2024-01-20', 'https://www.w3schools.com/html/html_intro.asp', 2),
(9, 'OpenClassRoom Créer son site WEB', '2024-01-21', 'https://openclassrooms.com/fr/courses/1603881-creez-votre-site-web-avec-html5-et-css3', 2),
(10, 'htmlcheatsheet HTML', '2024-01-22', 'https://htmlcheatsheet.com/', 2),
(11, 'htmlcheatsheet CSS', '2024-01-23', 'https://htmlcheatsheet.com/css/', 2),
(12, 'Bootstrap introduction', '2024-01-24', 'https://getbootstrap.com/docs/5.3/getting-started/introduction/', 6),
(13, 'OpenClassRoom Bootstrap', '2024-01-25', 'https://openclassrooms.com/fr/courses/7542506-creez-des-sites-web-responsives-avec-bootstrap-5', 6),
(14, 'Bootstrap Cheatsheet', '2024-01-26', 'https://getbootstrap.com/docs/5.0/examples/cheatsheet/', 6),
(15, 'Support Javascript Initiation', '2024-01-27', 'https://drive.google.com/file/d/1zzIx9aD4pfkR1nn2UATRo8qRs6MZbxW4/view?usp=drive_link', 3),
(16, 'OpenClassRoom Javascript', '2024-01-28', 'https://openclassrooms.com/fr/courses/7696886-apprenez-a-programmer-avec-javascript?archived-source=6175841', 3),
(17, 'MSDN Introduction Javascript', '2024-01-29', 'https://developer.mozilla.org/fr/docs/Web/JavaScript', 3),
(18, 'MSDN Première étape Javascript', '2024-01-30', 'https://developer.mozilla.org/fr/docs/Learn/JavaScript/First_steps', 3),
(19, 'MSDN Les bases en Javascript', '2024-01-31', 'https://developer.mozilla.org/fr/docs/Learn/Getting_started_with_the_web/JavaScript_basics', 3),
(20, 'htmlcheatsheet Javascript', '2024-02-01', 'https://htmlcheatsheet.com/js/', 3),
(21, 'OpenClassRoom Apprenez à développer avec JS', '2024-02-02', 'https://openclassrooms.com/fr/courses/7696886-apprenez-a-programmer-avec-javascript', 3),
(22, 'Cours complet JS Pierre-Giraud', '2024-02-03', 'https://www.pierre-giraud.com/javascript-apprendre-coder-cours/', 3),
(23, 'CODEX Démarrer avec WordPress', '2024-02-04', 'https://codex.wordpress.org/fr:Demarrer_avec_WordPress', 4),
(24, 'Eprojet Installer WordPress', '2024-02-05', 'https://www.eprojet.fr/cours/wordpress/01-wordpress-installation-et-configuration-de-wordpress', 4),
(25, 'Thème Enfant WordPress Developer', '2024-02-06', 'https://developer.wordpress.org/themes/advanced-topics/child-themes/', 4),
(26, 'Thème Enfant WPFormation', '2024-02-07', 'https://wpformation.com/theme-enfant-wordpress/', 4),
(27, 'API : comprendre l\'essentiel en 4 minutes', '2024-02-08', 'https://www.youtube.com/watch?v=T0DmHRdtqY0&t=5s', 5),
(28, 'OpenClassRooms API-REST', '2024-02-09', 'https://openclassrooms.com/fr/courses/6031886-debutez-avec-les-api-rest', 5),
(29, 'XMLHttpRequest – Doc officielle ', '2024-02-11', 'https://developer.mozilla.org/fr/docs/Web/API/XMLHttpRequest#constructeur', 5),
(30, 'Fetch API  Pierre Giraud', '2024-02-12', 'https://www.pierre-giraud.com/javascript-apprendre-coder-cours/api-fetch/', 5),
(31, 'Vidéo XMLHttpRequest', '2024-02-13', 'https://www.youtube.com/watch?v=Bct585a0Hj8', 5),
(32, 'La méthode Fetch (6 min) ', '2024-02-14', 'https://www.youtube.com/watch?v=sGvEqHkDyFc', 5),
(33, 'PostMan', '2024-02-10', 'https://www.postman.com/', 5);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_cat`);

--
-- Index pour la table `cat_fav`
--
ALTER TABLE `cat_fav`
  ADD PRIMARY KEY (`id_fav`,`id_cat`),
  ADD KEY `fk_id_cat` (`id_cat`);

--
-- Index pour la table `domaine`
--
ALTER TABLE `domaine`
  ADD PRIMARY KEY (`id_dom`);

--
-- Index pour la table `favori`
--
ALTER TABLE `favori`
  ADD PRIMARY KEY (`id_fav`),
  ADD KEY `fk_id_dom` (`id_dom`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `domaine`
--
ALTER TABLE `domaine`
  MODIFY `id_dom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `favori`
--
ALTER TABLE `favori`
  MODIFY `id_fav` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cat_fav`
--
ALTER TABLE `cat_fav`
  ADD CONSTRAINT `fk_id_cat` FOREIGN KEY (`id_cat`) REFERENCES `categorie` (`id_cat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_fav` FOREIGN KEY (`id_fav`) REFERENCES `favori` (`id_fav`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `favori`
--
ALTER TABLE `favori`
  ADD CONSTRAINT `fk_id_dom` FOREIGN KEY (`id_dom`) REFERENCES `domaine` (`id_dom`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
