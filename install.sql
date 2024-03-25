-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 16 mars 2023 Ã  09:45
-- Version du serveur : 10.6.12-MariaDB
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sc4fkfd9042_cms`
--

-- --------------------------------------------------------

--
-- Structure de la table `gd_admin`
--

CREATE TABLE `gd_admin` (
                            `id` int(11) NOT NULL,
                            `username` varchar(255) NOT NULL,
                            `type` varchar(255) NOT NULL,
                            `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `gd_admin`
--

INSERT INTO `gd_admin` (`id`, `username`, `type`, `password`) VALUES
                                                                  (2, 'root', 'root', '%root_password%'),
                                                                  (3, 'admin', 'admin', '%admin_password%');

-- --------------------------------------------------------

--
-- Structure de la table `gd_agenda`
--

CREATE TABLE `gd_agenda` (
                             `id` int(11) NOT NULL,
                             `active` int(1) NOT NULL,
                             `image` text NOT NULL,
                             `short_description` text NOT NULL,
                             `description` text NOT NULL,
                             `title` text NOT NULL,
                             `date_event` text NOT NULL,
                             `date_event_end` date NOT NULL,
                             `schedule` text NOT NULL,
                             `location` text NOT NULL,
                             `cost` text NOT NULL,
                             `manager` text NOT NULL,
                             `phone` text NOT NULL,
                             `email` text NOT NULL,
                             `website` text NOT NULL,
                             `id_lang` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `gd_agenda`
--

INSERT INTO `gd_agenda` (`id`, `active`, `image`, `short_description`, `description`, `title`, `date_event`, `date_event_end`, `schedule`, `location`, `cost`, `manager`, `phone`, `email`, `website`) VALUES
                                                                                                                                                                                                           (1, 1, '/themes/assets/upload/5900736100309105215_image1.png', 'Reprehenderit, qui p.', 'Cillum qui eos, aliq. Reprehenderit, qui p.Cillum qui eos, aliq. Reprehenderit, qui p.Cillum qui eos, aliq. Reprehenderit, qui p.Cillum qui eos, aliq. Reprehenderit, qui p.Cillum qui eos, aliq. Reprehenderit, qui p.Cillum qui eos, aliq. Reprehenderit, qui p.Cillum qui eos, aliq. Reprehenderit, qui p.Cillum qui eos, aliq. Reprehenderit, qui p.Cillum qui eos, aliq. Reprehenderit, qui p.Cillum qui eos, aliq. Reprehenderit, qui p.', 'Dolore non dolorum u', '2023-10-01', '0000-00-00', '00:00:00', '', '0', '', '', '', ''),
                                                                                                                                                                                                           (2, 1, '/themes/assets/upload/5900736100309105215_image1.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ac pharetra turpis. Nullam vel purus et justo imperdiet suscipit sit amet id nisl. Suspendisse potenti. Curabitur tincidunt at orci nec aliquet. Morbi feugiat pharetra scelerisque. Quisque ullamcorper augue massa. Etiam pharetra pharetra risus sed malesuada.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ac pharetra turpis. Nullam vel purus et justo imperdiet suscipit sit amet id nisl. Suspendisse potenti. Curabitur tincidunt at orci nec aliquet. Morbi feugiat pharetra scelerisque. Quisque ullamcorper augue massa. Etiam pharetra pharetra risus sed malesuada.<br /><br />Morbi sed vehicula enim, venenatis lacinia magna. Suspendisse purus enim, pulvinar non neque ac, volutpat varius libero. Maecenas iaculis feugiat risus non vulputate. Cras ullamcorper metus sit amet dui congue laoreet. Nam consequat mi tellus, sagittis efficitur erat maximus eget. Donec vitae condimentum lectus. Aliquam quis facilisis turpis. Maecenas pellentesque pharetra arcu non rhoncus.<br /><br />Sed blandit nisi orci, at placerat justo pellentesque eu. Mauris iaculis sit amet turpis eget aliquet. Proin ex quam, tincidunt non ullamcorper quis, cursus in erat. Sed pulvinar consectetur bibendum. Ut tellus purus, tristique vitae fringilla vitae, fringilla quis lorem. Fusce volutpat nunc orci, in accumsan sapien imperdiet egestas. Nunc in enim sit amet nulla tempus finibus sed non dui. Nullam porta quam a ullamcorper gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam id magna aliquet tortor aliquam efficitur eget et nulla. Maecenas dictum tempus lectus, id egestas leo venenatis nec. Nullam dignissim sed magna in sollicitudin. Suspendisse vehicula urna nec tellus maximus, ut euismod orci accumsan. Sed eleifend turpis erat, sed elementum eros accumsan at. Phasellus eget nisl sed tortor porta sodales.', 'Reprehenderit in di', '2010-03-03', '2029-08-14', '12:30:00', 'Ut unde tenetur est ', '33', 'Mr leDirecteur ', '+1 (283) 251-8338', '', 'https://www.bis.info');

-- --------------------------------------------------------

--
-- Structure de la table `gd_articles`
--

CREATE TABLE `gd_articles` (
                               `id` int(11) NOT NULL,
                               `title` varchar(255) NOT NULL,
                               `text` text NOT NULL,
                               `category` varchar(255) NOT NULL,
                               `image` varchar(255) NOT NULL,
                               `active` int(11) NOT NULL,
                               `id_lang` int(2) NOT NULL DEFAULT 1,
                               `date_add` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `gd_articles`
--

INSERT INTO `gd_articles` (`id`, `title`, `text`, `category`, `image`, `active`, `date_add`) VALUES
                                                                                                 (1, 'Laboriosam perferen', 'Iusto pariatur Even', 'Consequat Non tempo', 'https://picsum.photos/500/800', 1, '2023-03-02 09:10:31'),
                                                                                                 (2, 'Repellendus Incidun', 'Deserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam i', 'Dolore assumenda pro', 'https://picsum.photos/500/800', 1, '2023-03-02 09:15:07'),
                                                                                                 (3, 'Earum corporis excep', 'Distinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio Voluptat', 'Perspiciatis soluta', 'https://picsum.photos/500/800', 1, '2023-03-02 09:15:40'),
                                                                                                 (4, 'Laboriosam perferen', 'Iusto pariatur Even', 'Consequat Non tempo', 'https://picsum.photos/500/800', 1, '2023-03-02 09:10:31'),
                                                                                                 (5, 'Repellendus Incidun', 'Deserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam i', 'Dolore assumenda pro', 'https://picsum.photos/500/800', 1, '2023-03-02 09:15:07'),
                                                                                                 (6, 'Earum corporis excep', 'Distinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio Voluptat', 'Perspiciatis soluta', 'https://picsum.photos/500/800', 1, '2023-03-02 09:15:40'),
                                                                                                 (7, 'Laboriosam perferen', 'Iusto pariatur Even', 'Consequat Non tempo', 'https://picsum.photos/500/800', 1, '2023-03-02 09:10:31'),
                                                                                                 (8, 'Repellendus Incidun', 'Deserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam i', 'Dolore assumenda pro', 'https://picsum.photos/500/800', 1, '2023-03-02 09:15:07'),
                                                                                                 (9, 'Earum corporis excep', 'Distinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio Voluptat', 'Perspiciatis soluta', 'https://picsum.photos/500/800', 1, '2023-03-02 09:15:40'),
                                                                                                 (10, 'Laboriosam perferen', 'Iusto pariatur Even', 'Consequat Non tempo', 'https://picsum.photos/500/800', 1, '2023-03-02 09:10:31'),
                                                                                                 (11, 'Repellendus Incidun', 'Deserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam i', 'Dolore assumenda pro', 'https://picsum.photos/500/800', 1, '2023-03-02 09:15:07'),
                                                                                                 (12, 'Earum corporis excep', 'Distinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio Voluptat', 'Perspiciatis soluta', 'https://picsum.photos/500/800', 1, '2023-03-02 09:15:40'),
                                                                                                 (13, 'Laboriosam perferen', 'Iusto pariatur Even', 'Consequat Non tempo', 'https://picsum.photos/500/800', 1, '2023-03-02 09:10:31'),
                                                                                                 (14, 'Repellendus Incidun', 'Deserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam i', 'Dolore assumenda pro', 'https://picsum.photos/500/800', 1, '2023-03-02 09:15:07'),
                                                                                                 (15, 'Earum corporis excep', 'Distinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio Voluptat', 'Perspiciatis soluta', 'https://picsum.photos/500/800', 1, '2023-03-02 09:15:40'),
                                                                                                 (16, 'Laboriosam perferen', 'Iusto pariatur Even', 'Consequat Non tempo', 'https://picsum.photos/500/800', 1, '2023-03-02 09:10:31'),
                                                                                                 (17, 'Repellendus Incidun', 'Deserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam i', 'Dolore assumenda pro', 'https://picsum.photos/500/800', 1, '2023-03-02 09:15:07'),
                                                                                                 (18, 'Earum corporis excep', 'Distinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio Voluptat', 'Perspiciatis soluta', 'https://picsum.photos/500/800', 1, '2023-03-02 09:15:40'),
                                                                                                 (19, 'Laboriosam perferen', 'Iusto pariatur Even', 'Consequat Non tempo', 'https://picsum.photos/500/800', 1, '2023-03-02 09:10:31'),
                                                                                                 (20, 'Repellendus Incidun', 'Deserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam i', 'Dolore assumenda pro', 'https://picsum.photos/500/800', 1, '2023-03-02 09:15:07'),
                                                                                                 (21, 'Earum corporis excep', 'Distinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio Voluptat', 'Perspiciatis soluta', 'https://picsum.photos/500/800', 1, '2023-03-02 09:15:40'),
                                                                                                 (22, 'Laboriosam perferen', 'Iusto pariatur Even', 'Consequat Non tempo', 'https://picsum.photos/500/800', 1, '2023-03-02 09:10:31'),
                                                                                                 (23, 'Repellendus Incidun', 'Deserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam iDeserunt quibusdam i', 'Dolore assumenda pro', 'https://picsum.photos/500/800', 1, '2023-03-02 09:15:07'),
                                                                                                 (24, 'Earum corporis excep', 'Distinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio VoluptatDistinctio Voluptat', 'Perspiciatis soluta', 'https://picsum.photos/500/800', 1, '2023-03-30 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `gd_association`
--

CREATE TABLE `gd_association` (
                                  `id` int(11) NOT NULL,
                                  `name` text NOT NULL,
                                  `image` text NOT NULL,
                                  `description` text NOT NULL,
                                  `id_lang` int(2) NOT NULL DEFAULT 1,
                                  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `gd_association`
--

INSERT INTO `gd_association` (`id`, `name`, `image`, `description`, `active`) VALUES
                                                                                  (1, 'Mon association', '/themes/assets/upload/3419660610309111131_img1.png', '<p><strong>Pr&eacute;sident :</strong> M. Nom pr&eacute;nom <br /><strong>Activit&eacute;s :</strong> -<br /><strong>Email : </strong> mon@email.com<br /><strong>T&eacute;l&eacute;phone : </strong> 0707070707<br /><strong>Site internet :</strong> 0707070707</p>', 1),
                                                                                  (2, 'Mon association', '/themes/assets/upload/3419660610309111131_img1.png', '<p><strong>Pr&eacute;sident :</strong> M. Nom pr&eacute;nom <br /><strong>Activit&eacute;s :</strong> -<br /><strong>Email : </strong> mon@email.com<br /><strong>T&eacute;l&eacute;phone : </strong> 0707070707<br /><strong>Site internet :</strong> 0707070707</p>', 1),
                                                                                  (3, 'Mon association', '/themes/assets/upload/3419660610309111131_img1.png', '<p><strong>Pr&eacute;sident :</strong> M. Nom pr&eacute;nom <br /><strong>Activit&eacute;s :</strong> -<br /><strong>Email : </strong> mon@email.com<br /><strong>T&eacute;l&eacute;phone : </strong> 0707070707<br /><strong>Site internet :</strong> 0707070707</p>', 1),
                                                                                  (4, 'Mon association', '/themes/assets/upload/3419660610309111131_img1.png', '<p><strong>Pr&eacute;sident :</strong> M. Nom pr&eacute;nom <br /><strong>Activit&eacute;s :</strong> -<br /><strong>Email : </strong> mon@email.com<br /><strong>T&eacute;l&eacute;phone : </strong> 0707070707<br /><strong>Site internet :</strong> 0707070707</p>', 1);

-- --------------------------------------------------------

--
-- Structure de la table `gd_banniere`
--

CREATE TABLE `gd_banniere` (
                               `id` int(11) NOT NULL,
                               `date_end` date NOT NULL,
                               `date_start` date NOT NULL,
                               `description` text NOT NULL,
                               `url_btn` text NOT NULL,
                               `label_btn` text NOT NULL,
                               `image` text NOT NULL,
                               `title` text NOT NULL,
                               `id_lang` int(2) NOT NULL DEFAULT 1,
                               `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `gd_banniere`
--

INSERT INTO `gd_banniere` (`id`, `date_end`, `date_start`, `description`, `url_btn`, `label_btn`, `image`, `title`, `active`) VALUES
    (1, '2023-04-09', '2023-03-10', 'Facilis aliquam Nam ', 'Excepturi et qui dol', 'Officia minim rerum ', '', '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `gd_block`
--

CREATE TABLE `gd_block` (
                            `id` int(11) NOT NULL,
                            `name` varchar(255) NOT NULL,
                            `description` text NOT NULL,
                            `datas` text NOT NULL,
                            `structure` text NOT NULL,
                            `crud_url` text NOT NULL,
                            `crud_block` text NOT NULL,
                            `duplicable` int(11) NOT NULL DEFAULT 0,
                            `crud` int(11) NOT NULL DEFAULT 0,
                            `active` tinyint(1) NOT NULL,
                            `clone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `gd_block`
--

INSERT INTO `gd_block` (`id`, `name`, `description`, `datas`, `structure`, `crud_url`, `crud_block`, `duplicable`, `crud`, `active`) VALUES
                                                                                                                                         (23, 'Contact', '', '', 'include:contact.php', '', '0', 0, 0, 1),
                                                                                                                                         (26, 'Dernières actus', '', '', 'include:latest-news.php', '', '0', 0, 0, 1),
                                                                                                                                         (27, 'Avis clients', '', '', 'include:reviews.php', '', '0', 0, 0, 1),
                                                                                                                                         (28, 'Détail d\'un article', '', '', 'include:article.php', '', '0', 0, 0, 1),
(29, 'texte simple', '', '', '<section data-type=\"textarea\" data-name=\"text\">\r\nLorem ipsum\r\n</section>', '', '0', 0, 0, 1),
(30, 'Listing actualités', '', '', 'include:news.php', '', '0', 0, 0, 1),
                                                                                                                                          (31, 'Introduction', '', '', '<section class=\"intro\">\r\n    <div>\r\n        <h1>Lorem Ipsum</h1>\r\n        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pretium ac tellus non vehicula. In quis volutpat neque, ultrices iaculis felis. Aenean sollicitudin vehicula velit, ut lacinia lorem porta ac. Maecenas eleifend, erat nec finibus faucibus, nisi odio malesuada sem, a tincidunt lacus quam id tortor. Integer hendrerit orci sagittis nibh tristique, ut malesuada nunc scelerisque.</p>\r\n    </div>\r\n</section>', '', '0', 0, 0, 1),
                                                                                                                                          (33, 'Listing de l\'équipe', '', '', 'include:teams.php', '', '0', 0, 0, 1),
(34, 'Agenda ', '', '', 'include:agenda.php', '', '0', 0, 0, 1),
(35, 'Associations', '', '', 'include:associations.php', '', '0', 0, 0, 1),
(36, 'Documents', '', '', 'include:documents.php', '', '0', 0, 0, 1),
(37, 'Document | Détails', '', '', 'include:document.php', '', '0', 0, 0, 1),
(38, 'Listind de produits', '', '', 'include:produits.php', '', '0', 0, 0, 1),
(39, 'Détails d\'un produit', '', '', 'include:produit.php', '', '0', 0, 0, 1),
                                                                                                                                          (46, 'Bannière', '', '', 'include:banniere.php', '', '', 0, 0, 0),
                                                                                                                                          (58, 'Fil d\'Ariane', '', '', '<div id="breadcrumb"><div class="container"> <h1 data-name="title" data-type="text"> Titre </h1> include:breadcrumb.php </div></div>', '', '0' , 0, 0, 1),
                                                                                                                                        (59, 'File d\'Ariane auto', '', '', 'include:breadcrumb_auto.php', '', '0', 0, 0, 1),
                                                                                                                                          (48, 'Détail d\'un événement', '', '', 'include:event.php', '', '0', 0, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `gd_configuration`
--

CREATE TABLE `gd_configuration` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `gd_configuration`
--

INSERT INTO `gd_configuration` (`id`, `label`, `value`) VALUES
(1, 'E-mail', 'demo@societe.fr'),
(2, 'Instagram', ''),
(3, 'Facebook', ''),
(4, 'Adresse ligne 1', '11 rue de la Démo'),
(5, 'Adresse ligne 2', '95000 Paris'),
(6, 'Téléphone', '04 51 42 33 24');

-- --------------------------------------------------------

--
-- Structure de la table `gd_contact`
--

CREATE TABLE `gd_contact` (
  `id` int(11) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `gd_documents`
--

CREATE TABLE `gd_documents` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `pdf` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `gd_documents`
--

INSERT INTO `gd_documents` (`id`, `title`, `pdf`, `date`, `active`) VALUES
(1, 'Compte rendu', '/themes/assets/upload/10393353890309130256_exemple-fichier-pdf-1.pdf', '2022-03-21 23:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `gd_gallery`
--

CREATE TABLE `gd_gallery` (
  `id` int(11) NOT NULL,
  `active` int(1) NOT NULL,
  `illustration` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `gd_gallery`
--

INSERT INTO `gd_gallery` (`id`, `active`, `illustration`) VALUES
(1, 1, 'https://picsum.photos/seed/picsum/200/300');

-- --------------------------------------------------------

--
-- Structure de la table `gd_modules`
--

CREATE TABLE `gd_modules` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `icone` varchar(255) NOT NULL,
  `active` int(1) NOT NULL,
  `access` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `gd_modules`
--

INSERT INTO `gd_modules` (`id`, `nom`, `url`, `icone`, `active`, `access`) VALUES
(1, 'Avis Clients', 'reviews', 'fa fa-star', 1, 'admin'),
(2, 'Actualités', 'articles', 'fa fa-newspaper', 1, 'admin'),
(20, 'gallery', 'gallery', 'fa-solid fa-panorama', 0, 'admin'),
(23, 'équipe', 'team', 'fa fa-users', 0, 'admin'),
(24, 'Agenda', 'agenda', 'fa fa-calendar', 0, 'admin'),
(25, 'Associations', 'association', 'fa fa-handshake-angle', 0, 'admin'),
(26, 'Gestion des documents', 'documents', 'fa fa-folder-open', 0, 'admin'),
(27, 'Produits', 'products', 'fa fa-box-open', 0, 'admin'),
(33, 'Bannière', 'banniere', 'fa fa-image', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `gd_page`
--

CREATE TABLE `gd_page` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `parent` int(11) NOT NULL,
  `menu` varchar(3) NOT NULL,
  `footer` varchar(3) NOT NULL,
  `datas` text NOT NULL,
  `LANG` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `gd_page`
--

INSERT INTO `gd_page` (`id`, `nom`, `url`, `parent`, `menu`, `footer`, `datas`, `LANG`, `title`, `description`) VALUES
(1, 'Accueil', '', 0, '1', '1', '[]', '', '', ''),
(2, 'Contact', 'contact', 0, '3', '4', '[]', '', '', ''),
(17, 'Actualité', 'article', 0, '', '', '', '', '', ''),
(18, 'Les actualités', 'les-actualites', 0, '2', '2', '', '', '', ''),
(20, 'Mon équipe', 'mon-equipe', 0, '', '', '', '', '', ''),
(21, 'Les évènements', 'les-evenements', 0, '', '', '', '', '', ''),
(22, 'Les associations', 'les-associations', 0, '', '', '', '', '', ''),
(23, 'Documents', 'documents', 0, '', '', '', '', '', ''),
(24, 'Détails compte rendu', 'document', 0, '', '', '', '', '', ''),
(25, 'Produits', 'produits', 0, '', '', '', '', '', ''),
(26, 'Produit', 'produit', 0, '', '', '', '', '', ''),
(27, 'Mentions légales', 'mentions-legales', 0, '', '3', '', '', '', ''),
(28, 'Evénement ', 'evenement', 0, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `gd_products`
--

CREATE TABLE `gd_products` (
  `id` int(11) NOT NULL,
  `active` int(1) NOT NULL,
  `image` text NOT NULL,
  `image_2` text NOT NULL,
  `image_3` text NOT NULL,
  `image_4` text NOT NULL,
  `price` text NOT NULL,
  `description` text NOT NULL,
  `title` text NOT NULL,
  `id_lang` int(2) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `gd_products`
--

INSERT INTO `gd_products` (`id`, `active`, `image`, `image_2`, `image_3`, `image_4`, `price`, `description`, `title`, `date`) VALUES
(1, 1, '/themes/assets/upload/5023646990309133105_1433108740421122640-btl-coup-de-gueule-blanc.png', '/themes/assets/upload/4903289590309133105_1433108740421122640-btl-coup-de-gueule-blanc.png', '/themes/assets/upload/16280659560309133131_1433108740421122640-btl-coup-de-gueule-blanc.png', '/themes/assets/upload/20932809930309133131_1433108740421122640-btl-coup-de-gueule-blanc.png', '83', 'Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.', 'Exercitation mollit ', '2023-03-09 12:44:03'),
(2, 1, '/themes/assets/upload/5023646990309133105_1433108740421122640-btl-coup-de-gueule-blanc.png', '/themes/assets/upload/4903289590309133105_1433108740421122640-btl-coup-de-gueule-blanc.png', '/themes/assets/upload/16280659560309133131_1433108740421122640-btl-coup-de-gueule-blanc.png', '/themes/assets/upload/20932809930309133131_1433108740421122640-btl-coup-de-gueule-blanc.png', '83', 'Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.', 'Exercitation mollit ', '2023-03-09 12:44:06'),
(3, 1, '/themes/assets/upload/5023646990309133105_1433108740421122640-btl-coup-de-gueule-blanc.png', '/themes/assets/upload/4903289590309133105_1433108740421122640-btl-coup-de-gueule-blanc.png', '/themes/assets/upload/16280659560309133131_1433108740421122640-btl-coup-de-gueule-blanc.png', '/themes/assets/upload/20932809930309133131_1433108740421122640-btl-coup-de-gueule-blanc.png', '83', 'Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.', 'Exercitation mollit ', '2023-03-09 12:44:08'),
(4, 1, '/themes/assets/upload/5023646990309133105_1433108740421122640-btl-coup-de-gueule-blanc.png', '/themes/assets/upload/4903289590309133105_1433108740421122640-btl-coup-de-gueule-blanc.png', '/themes/assets/upload/16280659560309133131_1433108740421122640-btl-coup-de-gueule-blanc.png', '/themes/assets/upload/20932809930309133131_1433108740421122640-btl-coup-de-gueule-blanc.png', '83', 'Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.', 'Exercitation mollit ', '2023-03-09 12:44:10'),
(5, 1, '/themes/assets/upload/5023646990309133105_1433108740421122640-btl-coup-de-gueule-blanc.png', '/themes/assets/upload/4903289590309133105_1433108740421122640-btl-coup-de-gueule-blanc.png', '/themes/assets/upload/16280659560309133131_1433108740421122640-btl-coup-de-gueule-blanc.png', '/themes/assets/upload/20932809930309133131_1433108740421122640-btl-coup-de-gueule-blanc.png', '83', 'Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.', 'Exercitation mollit ', '2023-03-09 12:44:12'),
(6, 1, '/themes/assets/upload/5023646990309133105_1433108740421122640-btl-coup-de-gueule-blanc.png', '/themes/assets/upload/4903289590309133105_1433108740421122640-btl-coup-de-gueule-blanc.png', '/themes/assets/upload/16280659560309133131_1433108740421122640-btl-coup-de-gueule-blanc.png', '/themes/assets/upload/20932809930309133131_1433108740421122640-btl-coup-de-gueule-blanc.png', '83', 'Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.', 'Exercitation mollit ', '2023-03-09 12:44:15'),
(7, 1, '/themes/assets/upload/5023646990309133105_1433108740421122640-btl-coup-de-gueule-blanc.png', '/themes/assets/upload/4903289590309133105_1433108740421122640-btl-coup-de-gueule-blanc.png', '/themes/assets/upload/16280659560309133131_1433108740421122640-btl-coup-de-gueule-blanc.png', '/themes/assets/upload/20932809930309133131_1433108740421122640-btl-coup-de-gueule-blanc.png', '83', 'Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.', 'Exercitation mollit ', '2023-03-09 12:44:17'),
(8, 1, '/themes/assets/upload/5023646990309133105_1433108740421122640-btl-coup-de-gueule-blanc.png', '/themes/assets/upload/4903289590309133105_1433108740421122640-btl-coup-de-gueule-blanc.png', '/themes/assets/upload/16280659560309133131_1433108740421122640-btl-coup-de-gueule-blanc.png', '/themes/assets/upload/20932809930309133131_1433108740421122640-btl-coup-de-gueule-blanc.png', '83', 'Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.Culpa, eius nemo rer.', 'Exercitation mollit ', '2023-03-09 12:44:20');

-- --------------------------------------------------------

--
-- Structure de la table `gd_reviews`
--

CREATE TABLE `gd_reviews` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `note` text NOT NULL,
  `description` text NOT NULL,
  `hashtag` text NOT NULL,
  `active` int(11) NOT NULL,
  `google` int(11) NOT NULL DEFAULT 0,
  `profil` text NOT NULL,
  `dateAdd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `gd_reviews`
--

INSERT INTO `gd_reviews` (`id`, `name`, `note`, `description`, `hashtag`, `active`, `google`, `profil`, `dateAdd`) VALUES
(6, 'JPS JPS', '1', 'Barbecue acheté chez Brico Marché produit Daca... 1 mois après son utilisation déjà  fissuré. à éviter...', '16 octobre 2021', 0, 1, 'https://lh3.googleusercontent.com/a-/ACB-R5TOzy5tnsI0pq_WF0uhsuw7wvOm8beIB_qUXf_iXww=s128-c0x00000000-cc-rp-mo', '2021-10-16 04:40:52'),
(7, 'Nadia Lopez', '5', 'Bon accueil\nVente aux particuliers, prix attractifs .\nJe recommande cet établissement...', '05 f?vrier 2020', 1, 1, 'https://lh3.googleusercontent.com/a-/ACB-R5SZ-HibD4E1ovAUJtT7JNRUIVDjRQvNNEtpYN3-OA=s128-c0x00000000-cc-rp-mo-ba2', '2020-02-05 02:01:22'),
(9, 'remy pascal', '5', 'Accueil sympathique', '15 novembre 2022', 1, 1, 'https://lh3.googleusercontent.com/a/AGNmyxYPxX7mwNbCSSkRh6sJhiCqRKwVbwLZ6vfq6Ebr=s128-c0x00000000-cc-rp-mo-ba4', '2022-11-15 08:50:28'),
(10, 'Alexa Frank', '32', 'Pariatur Beatae et ', '05 juillet 2020', 1, 1, 'https://lh3.googleusercontent.com/a/AGNmyxZyMbELau3J5slIIAeCbQ49mNKgU-YoYvy1-N3d=s128-c0x00000000-cc-rp-mo', '2023-03-02 07:24:08'),
(11, 'frederique lopez', '5', 'Entreprise de produits en b&eacute;ton pour l\'am&eacute;nagement ext&eacute;rieur avec des prix bas Personnels tr&egrave;s sympas et de bon conseil je recommande', '21 septembre 2017', 1, 1, 'https://lh3.googleusercontent.com/a/AGNmyxbIN66OyiIKmcdJshwUBMxVsyTnjX72TJAv2K80=s128-c0x00000000-cc-rp-mo', '2023-03-02 13:32:22');

-- --------------------------------------------------------

--
-- Structure de la table `gd_structure`
--

CREATE TABLE `gd_structure` (
                                `id` int(11) NOT NULL,
                                `id_page` int(11) NOT NULL,
                                `value` text NOT NULL,
                                `id_block` int(11) NOT NULL,
                                `field` text NOT NULL,
                                `position` int(11) NOT NULL,
                                `json` text NOT NULL,
                                `revision` int(11) NOT NULL,
                                `id_structure` int(1) NOT NULL,
                                `id_lang` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `gd_structure`
--

INSERT INTO `gd_structure` (`id`, `id_page`, `value`, `id_block`, `field`, `position`, `json`) VALUES
                                                                                                   (8, 2, 'include:contact.php', 23, '', 0, ''),
                                                                                                   (9, 15, 'include:contact.php', 23, '', 1, ''),
                                                                                                   (12, 1, 'include:latest-news.php', 26, '', 3, ''),
                                                                                                   (13, 1, 'include:reviews.php', 27, '', 4, ''),
                                                                                                   (14, 17, 'include:article.php', 28, '', 0, ''),
                                                                                                   (17, 1, '<section data-type=\"textarea\" data-name=\"text\"><div>\n<h1><strong>&nbsp;Lorem ipsum dolor sit amet, </strong></h1>\n<div style=\"padding-left: 40px;\">consectetur adipiscing elit. Aenean nisi nibh, dapibus eu fringilla vitae, pulvinar in nibh. Vivamus dapibus dolor a tempor efficitur. Aenean tempus vel libero in ultricies. Donec porta posuere nulla, vitae vulputate ex ullamcorper a. Morbi gravida eros et consectetur lobortis. Cras mattis a ipsum eu ultrices. Suspendisse a lorem non ipsum elementum facilisis. Donec quis ultrices ipsum. Ut at ante augue. Praesent egestas est nec leo fringilla, a malesuada mauris facilisis. Donec dapibus egestas egestas. Mauris rhoncus varius facilisis. Cras quis purus sed massa posuere sollicitudin.</div>\n<div>Duis justo nulla, euismod in metus id, maximus varius massa. Ut aliquam felis vel laoreet lacinia. Phasellus massa augue, ullamcorper ac laoreet quis, bibendum ac enim. Pellentesque vel consectetur elit. Fusce id nisl rhoncus tellus elementum sagittis. Suspendisse elit lorem, accumsan in libero quis, rutrum sodales eros. Maecenas sit amet consequat tellus. Aenean commodo a orci vitae pulvinar. Duis fringilla ultricies rutrum. Ut sodales felis orci, eget tincidunt sapien ultricies ut. Integer nec metus rutrum, pellentesque ante non, aliquet mi. In ante justo, tempor malesuada porttitor lacinia, tincidunt condimentum tellus. Donec aliquam neque a sagittis malesuada. Sed ac tellus libero. Phasellus malesuada ullamcorper mauris, nec condimentum est semper ut. Cras eget arcu nunc.&nbsp;</div>\n</div></section>', 29, '', 2, ''),
                                                                                                   (18, 18, 'include:news.php', 30, '', 2, ''),
                                                                                                   (20, 1, '<section class=\"intro\">\r\n    <div>\r\n        <h1>Lorem Ipsum</h1>\r\n        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pretium ac tellus non vehicula. In quis volutpat neque, ultrices iaculis felis. Aenean sollicitudin vehicula velit, ut lacinia lorem porta ac. Maecenas eleifend, erat nec finibus faucibus, nisi odio malesuada sem, a tincidunt lacus quam id tortor. Integer hendrerit orci sagittis nibh tristique, ut malesuada nunc scelerisque.</p>\r\n    </div>\r\n</section>', 31, '', 1, ''),
                                                                                                   (21, 19, 'include:mentions.php', 32, '', 0, ''),
                                                                                                   (22, 20, 'include:teams.php', 33, '', 0, ''),
                                                                                                   (23, 21, 'include:agenda.php', 34, '', 0, ''),
                                                                                                   (24, 22, 'include:associations.php', 35, '', 0, ''),
                                                                                                   (25, 23, 'include:documents.php', 36, '', 0, ''),
                                                                                                   (26, 24, 'include:document.php', 37, '', 0, ''),
                                                                                                   (27, 25, 'include:produits.php', 38, '', 0, ''),
                                                                                                   (28, 26, 'include:produit.php', 39, '', 0, ''),
                                                                                                   (29, 27, 'include:event.php', 48, '', 0, ''),
                                                                                                    (30, 2, '<div id="breadcrumb"><div class="container"><h1 data-name="title" data-type="text"> Titre </h1>include:breadcrumb.php</div></div>', 58, '', 0, ''),
                                                                                                    (31,18, '<div id="breadcrumb"><div class="container"><h1 data-name="title" data-type="text"> Titre </h1>include:breadcrumb.php</div></div>', 58, '', 0, ''),
                                                                                                    (32, 1 ,'<div id="breadcrumb"><div class="container"><h1 data-name="title" data-type="text"> Titre </h1>include:breadcrumb.php</div></div>', 58, '', 0, ''),
                                                                                                    (33, 21, '<div id="breadcrumb"><div class="container"><h1 data-name="title" data-type="text"> Titre </h1>include:breadcrumb.php</div></div>', 58, '', 0, ''),
                                                                                                    (34, 20, '<div id="breadcrumb"><div class="container"><h1 data-name="title" data-type="text"> Titre </h1>include:breadcrumb.php</div></div>', 58, '', 0, ''),
                                                                                                    (35, 25, '<div id="breadcrumb"><div class="container"><h1 data-name="title" data-type="text"> Titre </h1>include:breadcrumb.php</div></div>', 58, '', 0, ''),
                                                                                                    (36, 23, '<div id="breadcrumb"><div class="container"><h1 data-name="title" data-type="text"> Titre </h1>include:breadcrumb.php</div></div>', 58, '', 0, ''),
                                                                                                    (37, 22, '<div id="breadcrumb"><div class="container"><h1 data-name="title" data-type="text"> Titre </h1>include:breadcrumb.php</div></div>', 58, '', 0, ''),
                                                                                                   (38, 17, 'include:breadcrumb_auto.php', 59, '', 0, ''),
                                                                                                                                          (39, 28, 'include:breadcrumb_auto.php', 59, '', 0, ''),
                                                                                                                                          (40, 26, 'include:breadcrumb_auto.php', 59, '', 0, ''),
                                                                                                                                          (41, 24, 'include:breadcrumb_auto.php', 59, '', 0, '');





-- --------------------------------------------------------

--
-- Structure de la table `gd_team`
--

CREATE TABLE `gd_team` (
                           `id` int(11) NOT NULL,
                           `image` text NOT NULL,
                           `firstname` text NOT NULL,
                           `lastname` text NOT NULL,
                           `job` text NOT NULL,
                           `position` int(11) NOT NULL,
                           `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `gd_team`
--

INSERT INTO `gd_team` (`id`, `image`, `firstname`, `lastname`, `job`, `position`, `active`) VALUES
                                                                                                (1, '/themes/assets/upload/18588067290309103850_img1.png', 'Prénom', 'Nom', 'Intitulé métier', 7, 1),
                                                                                                (2, '/themes/assets/upload/18588067290309103850_img1.png', 'Prénom', 'Nom', 'Intitulé métier', 6, 1),
                                                                                                (3, '/themes/assets/upload/18588067290309103850_img1.png', 'Prénom', 'Nom', 'Intitulé métier', 5, 1),
                                                                                                (4, '/themes/assets/upload/18588067290309103850_img1.png', 'Prénom', 'Nom', 'Intitulé métier', 4, 1),
                                                                                                (5, '/themes/assets/upload/18588067290309103850_img1.png', 'Prénom', 'Nom', 'Intitulé métier', 2, 1),
                                                                                                (6, '/themes/assets/upload/18588067290309103850_img1.png', 'Prénom', 'Nom', 'Intitulé métier', 3, 1),
                                                                                                (7, '/themes/assets/upload/18588067290309103850_img1.png', 'Prénom', 'Nom', 'Intitulé métier', 0, 1),
                                                                                                (8, '/themes/assets/upload/18588067290309103850_img1.png', 'Prénom', 'Nom', 'Intitulé métier', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `gd_test`
--

CREATE TABLE `gd_test` (
                           `id` int(11) NOT NULL,
                           `image` text NOT NULL,
                           `title` text NOT NULL,
                           `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `gd_trad`
--

CREATE TABLE `gd_trad` (
                           `id` int(11) NOT NULL,
                           `word` text NOT NULL,
                           `id_lang` int(2) NOT NULL,
                           `translation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `gd_admin`
--
ALTER TABLE `gd_admin`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gd_agenda`
--
ALTER TABLE `gd_agenda`
    ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `gd_articles`
--
ALTER TABLE `gd_articles`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gd_association`
--
ALTER TABLE `gd_association`
    ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `gd_banniere`
--
ALTER TABLE `gd_banniere`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gd_block`
--
ALTER TABLE `gd_block`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gd_configuration`
--
ALTER TABLE `gd_configuration`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gd_documents`
--
ALTER TABLE `gd_documents`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gd_gallery`
--
ALTER TABLE `gd_gallery`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `gd_modules`
--
ALTER TABLE `gd_modules`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gd_page`
--
ALTER TABLE `gd_page`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gd_products`
--
ALTER TABLE `gd_products`
    ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Index pour la table `gd_reviews`
--
ALTER TABLE `gd_reviews`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_3` (`id`);

--
-- Index pour la table `gd_structure`
--
ALTER TABLE `gd_structure`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gd_team`
--
ALTER TABLE `gd_team`
    ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `gd_test`
--
ALTER TABLE `gd_test`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gd_trad`
--
ALTER TABLE `gd_trad`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `gd_admin`
--
ALTER TABLE `gd_admin`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `gd_agenda`
--
ALTER TABLE `gd_agenda`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `gd_articles`
--
ALTER TABLE `gd_articles`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `gd_association`
--
ALTER TABLE `gd_association`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `gd_banniere`
--
ALTER TABLE `gd_banniere`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `gd_block`
--
ALTER TABLE `gd_block`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `gd_configuration`
--
ALTER TABLE `gd_configuration`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `gd_documents`
--
ALTER TABLE `gd_documents`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `gd_gallery`
--
ALTER TABLE `gd_gallery`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `gd_modules`
--
ALTER TABLE `gd_modules`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `gd_page`
--
ALTER TABLE `gd_page`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `gd_products`
--
ALTER TABLE `gd_products`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `gd_reviews`
--
ALTER TABLE `gd_reviews`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `gd_structure`
--
ALTER TABLE `gd_structure`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `gd_team`
--
ALTER TABLE `gd_team`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `gd_test`
--
ALTER TABLE `gd_test`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `gd_trad`
--
ALTER TABLE `gd_trad`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;