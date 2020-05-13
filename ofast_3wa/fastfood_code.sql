-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 13 mai 2020 à 15:15
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `fastfood_code`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'menus'),
(2, 'Burgers'),
(3, 'Frites et snack'),
(4, 'Salades du monde'),
(5, 'Boissons'),
(6, 'Desserts');

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `price` float NOT NULL,
  `image` varchar(250) NOT NULL,
  `category` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `price`, `image`, `category`) VALUES
(1, 'Menu Classic', 'Sandwich Bio: Burger,salade,tomate,cheddar + Frites au choix + Boisson', 9.9, 'menuClassic.jpg', 1),
(2, 'Menu ChickenBacon', 'Sandwich Bio: Burger,bacon,salade,tomates,sauce roquefort + Frites au choix + Boisson', 10.9, 'menuChickenBacon.jpg', 1),
(3, 'Menu BigBurger', 'Sandwich Bio: Double Burger, salade,tomate,cheddar + Frites au choix + Boisson', 10.9, 'menuBigBurger.jpg', 1),
(4, 'Menu Chicken', 'Sandwich Bio: Chicken pane, salade, tomates, sauce comte', 10.9, 'menuChickenBurger.jpg', 1),
(5, 'Classic', 'Sandwich bio: Burger,salade,tomates,cheddar', 6.9, 'burgerClassic.jpg', 2),
(6, 'ChickenBacon', 'Sandwich Bio:Burger, bacon, salade,tomates,sauce roquefort', 7.9, 'burgerChickenBacon.jpg', 2),
(7, 'Big Burger', 'Sandwich Bio: Double burger, salade,tomates,cheddar', 7.9, 'burgerBig.jpg', 2),
(8, 'Chicken', 'Sandwich Bio: Chicken pane, salade, tomates, sauce comte', 7.9, 'burgerChicken.jpg', 2),
(9, 'Frites', 'Frites Bio ', 4.9, 'fries.jpg', 3),
(10, 'Frites Patate Douce', 'Frites Patate Douce Bio', 4.9, 'sweetPotatoeFries.jpg', 3),
(11, 'Calamars fris', 'Calamars fris + sauce aioli', 4.9, 'calamars.jpg', 3),
(12, 'Nuggets', 'Nuggets + sauce bearnaise', 4.9, 'nuggets.jpg', 3),
(13, 'Salade Grecque', 'Salade,feta,tomates,olives', 11.9, 'greekSalad.jpg', 4),
(14, 'Salade Thai', 'Salade,legumes crus,arachide', 11.9, 'thaiSalad.jpg', 4),
(15, 'Salade Italienne', 'Salade,tomates,mozzarela', 11.9, 'italianSalad.jpg', 4),
(16, 'Salade Coleslaw', 'Chou blanc, carottes, sauce speciale', 11.9, 'coleslawSalad.jpg', 4),
(17, 'Coca Zero', 'Coca sans sucre', 3.5, 'coca.jpg', 5),
(18, 'Jus d\'orange', 'Jus d\'orange frais', 3.5, 'orangeJuice.jpg', 5),
(19, 'Eau', 'Eau plate', 3.5, 'water.jpg', 5),
(20, 'Biere', 'Biere mexicaine', 3.5, 'corona.jpg', 5),
(21, 'Mochi', 'Dessert glace japonais', 6.5, 'mochi.jpg', 6),
(22, 'Pastel de nata', 'Dessert portugais', 6.5, 'pastel.jpg', 6),
(23, 'Glace chocolat', 'Dessert glace au chocolat', 6.51, 'icecreamChocolat.jpg', 6),
(24, 'Panacotta', 'Dessert italien', 6.5, 'panacotta.jpg', 6);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
