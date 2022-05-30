-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 12 mai 2022 à 15:35
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cinema`
--

-- --------------------------------------------------------

--
-- Structure de la table `actor`
--

DROP TABLE IF EXISTS `actor`;
CREATE TABLE IF NOT EXISTS `actor` (
  `id_actor` int(11) NOT NULL AUTO_INCREMENT,
  `id_person` int(11) NOT NULL,
  PRIMARY KEY (`id_actor`),
  KEY `fk_person_actor` (`id_person`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `actor`
--

INSERT INTO `actor` (`id_actor`, `id_person`) VALUES
(1, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `casting`
--

DROP TABLE IF EXISTS `casting`;
CREATE TABLE IF NOT EXISTS `casting` (
  `id_actor` int(11) NOT NULL,
  `id_movie` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  KEY `fk_actor_casting` (`id_actor`),
  KEY `fk_movie_casting` (`id_movie`),
  KEY `fk_role_casting` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `casting`
--

INSERT INTO `casting` (`id_actor`, `id_movie`, `id_role`) VALUES
(1, 1, 2),
(1, 2, 2),
(2, 2, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `director`
--

DROP TABLE IF EXISTS `director`;
CREATE TABLE IF NOT EXISTS `director` (
  `id_director` int(11) NOT NULL AUTO_INCREMENT,
  `id_person` int(11) NOT NULL,
  PRIMARY KEY (`id_director`),
  KEY `fk_person_director` (`id_person`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `director`
--

INSERT INTO `director` (`id_director`, `id_person`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `movie`
--

DROP TABLE IF EXISTS `movie`;
CREATE TABLE IF NOT EXISTS `movie` (
  `id_movie` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `release_date` varchar(64) NOT NULL,
  `length` int(11) NOT NULL COMMENT 'En minutes',
  `synopsis` text NOT NULL,
  `rate` int(11) DEFAULT NULL,
  `poster` varchar(128) NOT NULL,
  `id_director` int(11) NOT NULL,
  PRIMARY KEY (`id_movie`),
  KEY `fk_director_movie` (`id_director`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `movie`
--

INSERT INTO `movie` (`id_movie`, `title`, `release_date`, `length`, `synopsis`, `rate`, `poster`, `id_director`) VALUES
(1, 'Star Wars : Episode I - La Menace Fantôme', '1999', 136, 'Avant de devenir un célèbre chevalier Jedi, et bien avant de se révéler l’âme la plus noire de la galaxie, Anakin Skywalker est un jeune esclave sur la planète Tatooine. La Force est déjà puissante en lui et il est un remarquable pilote de Podracer. Le maître Jedi Qui-Gon Jinn le découvre et entrevoit alors son immense potentiel.\r\n  Pendant ce temps, l’armée de droïdes de l’insatiable Fédération du Commerce a envahi Naboo, une planète pacifique, dans le cadre d’un plan secret des Sith visant à accroître leur pouvoir. Pour défendre la reine de Naboo, Amidala, les chevaliers Jedi vont devoir affronter le redoutable Seigneur Sith, Dark Maul.', 3, 'images/menace-fantome.jpg', 1),
(2, 'Star Wars : Episode II - L\'Attaque des Clones', '2002', 142, 'Depuis le blocus de la planète Naboo par la Fédération du commerce, la République, gouvernée par le Chancelier Palpatine, connaît une véritable crise. Un groupe de dissidents, mené par le sombre Jedi comte Dooku, manifeste son mécontentement envers le fonctionnement du régime. Le Sénat et la population intergalactique se montrent pour leur part inquiets face à l\'émergence d\'une telle menace.\r\n  Certains sénateurs demandent à ce que la République soit dotée d\'une solide armée pour empêcher que la situation ne se détériore davantage. Parallèlement, Padmé Amidala, devenue sénatrice, est menacée par les séparatistes et échappe de justesse à un attentat. Le Padawan Anakin Skywalker est chargé de sa protection. Son maître, Obi-Wan Kenobi, part enquêter sur cette tentative de meurtre et découvre la constitution d\'une mystérieuse armée de clones...', 4, 'images/attaque-clones.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `movie_type`
--

DROP TABLE IF EXISTS `movie_type`;
CREATE TABLE IF NOT EXISTS `movie_type` (
  `id_type` int(11) NOT NULL,
  `id_movie` int(11) NOT NULL,
  KEY `fk_movie_type` (`id_type`),
  KEY `fk_movie` (`id_movie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `movie_type`
--

INSERT INTO `movie_type` (`id_type`, `id_movie`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `person`
--

DROP TABLE IF EXISTS `person`;
CREATE TABLE IF NOT EXISTS `person` (
  `id_person` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(64) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `gender` varchar(64) NOT NULL,
  `nationality` varchar(128) NOT NULL,
  `picture` varchar(128) NOT NULL,
  `birthdate` datetime NOT NULL,
  `biography` text NOT NULL,
  PRIMARY KEY (`id_person`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `person`
--

INSERT INTO `person` (`id_person`, `lastname`, `firstname`, `gender`, `nationality`, `picture`, `birthdate`, `biography`) VALUES
(1, 'Lucas', 'George', 'Masculin', 'Américaine', 'images/george-lucas.jpg', '1994-05-14 14:18:43', 'Elevé dans un ranch de Modesto en Californie, George Lucas se destine initialement à une carrière de pilote automobile. Après un terrible accident, il change d\'orientation (mais conservera son goût pour les voitures, comme en témoigne son American Graffiti) et entre à l\'université de Californie du Sud (USC), où il étudie le cinéma, ainsi que les contes, légendes et mythologies. Passionné par le montage et le documentaire, le jeune cinéaste impressionne en réalisant THX-1138 : 4EB (Electronic Labyrinth), un court métrage de science-fiction qu\'il adapte en long métrage en 1970. Produit par Francis Ford Coppola -que Lucas avait rencontré en tournant le making-of de sa Vallée du bonheur (1968)- THX 1138 ne rencontre malheureusement pas le succès escompté.\r\n\r\nTrois ans plus tard, George Lucas délaisse la SF pour tourner American Graffiti, comédie dramatique et nostalgique portée par de jeunes Ron Howard, Richard Dreyfuss et Harrison Ford. Les droits de Flash Gordon lui échappant, il planche parallèlement sur une saga intergalactique mêlant quête initiatique, mondes merveilleux, mythologie et combats spatiaux, véritable hommage aux sérials de eon enfance composé à l\'origine de neuf épisodes : ce sera Star wars, ou le destin d\'Anakin Skywalker et de son fils Luke au sein d\'une galaxie déchirée par la guerre civile. Aucun studio ne semble toutefois prêt à s\'investir dans le projet, et seule la Twentieth Century Fox, encouragée par le succès d\'American Graffiti et ses cinq nominations aux Oscars, accepte de mettre à la disposition du metteur en scène un solide budget de 8 millions de dollars.\r\n\r\nLancé dans un véritable tournage marathon entre la Tunisie et l\'Angleterre, George Lucas doit alors faire face aux doutes d\'une équipe peu convaincue par ce qu\'elle considère comme un \'film pour enfants\', et à la pression d\'un studio inquiété par les dépassements de budget et les délais non tenus. Lucas et les techniciens d\'Industrial Light & Magic (ILM, sa société d\'effets visuels fondée en 1975 pour le film) travaillent alors jour et nuit pour terminer un film qui ne semble pas convaincre les producteurs de la Fox, persuadés que le film sera un échec. Le 25 mai 1977, La Guerre des étoiles sort sur quelques écrans américains. C\'est un raz-de-marée sans précédent, et le film, véritable révolution technologique, devient en moins d\'un an le plus gros succès de tous les temps et modifie profondément le monde du cinéma. Devançant le phénomène, George Lucas rachète les droits des suites à la Fox, ainsi que ceux des produits dérivés, créant un véritable empire via sa société Lucasfilm ltd.'),
(2, 'Portman', 'Natalie', 'Femme', 'Américaine, Israélienne', 'images/natalie-portman.jpg', '1981-06-09 14:29:47', 'Fille d\'un médecin, Natalie Portman, née Hershlag, quitte Jérusalem à l\'âge de trois ans pour aller vivre avec sa famille aux Etats-Unis, dans le Connecticut puis à Long Island. Repérée dans une pizzeria par un agent de mannequins, elle débute sur les planches avant d\'obtenir, à 12 ans, le rôle féminin principal du Léon de Luc Besson, dans lequel elle donne la réplique au \'nettoyeur\' Jean Reno.\r\n\r\nElève brillante (elle étudia la psychologie à Harvard), la précoce Natalie Portman trouve néanmoins le temps de tourner avec les plus grands : belle-fille d\'Al Pacino dans Heat de Michael Mann, fille du Président des Etats-Unis Jack Nicholson dans Mars Attacks! de Burton en 1996, elle chante la même année devant la caméra de Woody Allen (Tout le monde dit I love you). Cela n\'empêche pas cette comédienne exigeante de refuser nombre de projets, de Lolita à Romeo + Juliette. En 1998, sa prestation dans Le Journal d\'Anne Frank à Broadway ne passe pas inaperçue.\r\n\r\nEn 1999, Natalie Portman fait un retour fracassant sur les écrans dans Star wars - La Menace fantôme. Son personnage, Amidala, reine puis sénatrice dont s\'éprend Anakin Skywalker, apparaîtra également dans les épisodes 2 et 3 de la saga culte de George Lucas. Si on la retrouve en 2006 en héroïne du film de SF subversif V pour Vendetta, l\'actrice se révèle tout aussi à l\'aise dans des oeuvres contemporaines et intimistes, comme Garden state, le hit indé de Zach Braff, Closer de Mike Nichols (sa composition de strip-teaseuse lui vaut une nomination à l\'Oscar du Meilleur second rôle en 2005), ou même l\'âpre Free zone, tourné en Israël par l\'intransigeant Gitaï. Egérie glamour au même titre qu\'une Scarlett Johansson (sa partenaire dans le film d\'époque Deux soeurs pour un roi), muse de Goya pour Milos Forman, elle est une des icônes de l\'Amérique fantasmée par Wong Kar-Wai (My Blueberry Nights) avant d\'ouvrir la porte du Merveilleux magasin de Mr Magorium (2008), entre rêve et réalité.\r\n\r\nNatalie Portman fait ses premiers pas dans la réalisation avec Eve, un court métrage qu\'elle a elle-même écrit et dans lequel apparaissent Lauren Bacall et Olivia Thirlby. Son film fait l\'ouverture du festival de Venise pour les courts en 2008. Elle réitèrera l\'expérience en mettant en scène l\'un des courts métrages du film collectif New York, I Love You. Elle apparaît également dans la séquence de Mira Nair du même film. La même année, on la retrouve à l\'écran dans Brothers de Jim Sheridan où elle est partagée entre Tobey Maguire et Jake Gyllenhaal.'),
(3, 'McGregor', 'Ewan', 'Homme', 'Américaine', 'images/ewan-mcgregor.jpg', '1971-03-31 14:29:47', 'A seize ans, encouragé par ses parents, Ewan McGregor quitte un cursus scolaire traditionnel et sa ville natale de Crieff pour suivre des cours de théâtre à Perth puis à Fife. Il intègre ensuite l\'école de musique et de comédie de London Guildhall pour une formation de trois ans, durant laquelle il croisera Daniel Craig et cohabitera avec Jude Law. Il n\'obtiendra jamais son diplôme de fin d\'études, puisqu\'en 1993, Dennis Potter l\'engage pour jouer le rôle de Mick Hopper dans la série Du rouge à lèvres sur ton col.\r\n\r\n\r\nDevenu l\'acteur fétiche de Danny Boyle depuis le succès de Petits meurtres entre amis en 1995, Ewan McGregor acquiert le statut de star en incarnant l\'année suivante le héros toxico de Trainspotting. Leur collaboration se poursuivra en 1997 avec Une vie moins ordinaire, où Ewan McGregor donne la réplique à Cameron Diaz. Il travaille également avec Peter Greenaway sur The Pillow Book en 1996, puis à deux reprises avec le talentueux réalisateur Mark Herman pour qui il tourne Les Virtuoses (1997) et Little Voice (1999). Grand amateur de musique, Ewan McGregor dévoile parallèlement une nouvelle facette de son jeu d\'acteur en s\'illustrant dans le Velvet Goldmine (1998) de Todd Haynes, et en poussant quelques années plus tard la chansonnette aux côtés de Nicole Kidman dans Moulin Rouge (2001) et de Renée Zellweger dans la comédie romantique Bye Bye Love (2003) de Peyton Reed.\r\n\r\n\r\nEn 1999, honneur suprême : George Lucas lui confie le rôle d\'Obi-Wan Kenobi dans les trois premiers volets de la saga Star Wars : La Menace fantôme (1999), L\'Attaque des clones (2002) et La Revanche des Sith (2005). La nouvelle décennie qui s\'ouvre à lui s\'avère des plus fructueuses. Il s\'impose en tête d\'affiche de grosses productions hollywoodiennes comme La Chute du faucon noir (2002) de Ridley Scott, Big Fish (2004) de Tim Burton, le futuriste The Island (2005) de Michael Bay ou encore l\'adaptation du roman Anges et démons (2009) par Ron Howard. Prêtant sa voix aux films d\'animation Vaillant et Robots, le bellâtre exerce également ses talents de comédien chez Woody Allen, pour qui il tourne Le Rêve de Cassandre en 2007, et chez Chris Noonan qui l\'invite à retrouver Renée Zellweger pour les besoins de Miss Potter. Il tient ensuite la réplique à Jim Carrey dans I Love You Phillip Morris où il y interprète un taulard homosexuel. Il fait également une apparition dans la superproduction pour enfants, Nanny McPhee et le big bang, en 2010. C\'est aussi cette année-là qu\'il tient l\'affiche du thriller The Ghost-Writer, dans lequel il campe un écrivain pris malgré lui dans un complot politique d\'envergure. Il enchaîne ensuite avec la comédie dramatique Beginners où il tombe sous le charme de Mélanie Laurent.\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_role`, `name`) VALUES
(1, 'Obi-Wan Kenobi'),
(2, 'Padmé Amidala');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id_type`, `name`) VALUES
(1, 'Science-Fiction'),
(2, 'Fantasy');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `actor`
--
ALTER TABLE `actor`
  ADD CONSTRAINT `fk_person_actor` FOREIGN KEY (`id_person`) REFERENCES `person` (`id_person`);

--
-- Contraintes pour la table `casting`
--
ALTER TABLE `casting`
  ADD CONSTRAINT `fk_actor_casting` FOREIGN KEY (`id_actor`) REFERENCES `actor` (`id_actor`),
  ADD CONSTRAINT `fk_movie_casting` FOREIGN KEY (`id_movie`) REFERENCES `movie` (`id_movie`),
  ADD CONSTRAINT `fk_role_casting` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);

--
-- Contraintes pour la table `director`
--
ALTER TABLE `director`
  ADD CONSTRAINT `fk_person_director` FOREIGN KEY (`id_person`) REFERENCES `person` (`id_person`);

--
-- Contraintes pour la table `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `fk_director_movie` FOREIGN KEY (`id_director`) REFERENCES `director` (`id_director`);

--
-- Contraintes pour la table `movie_type`
--
ALTER TABLE `movie_type`
  ADD CONSTRAINT `fk_movie` FOREIGN KEY (`id_movie`) REFERENCES `movie` (`id_movie`),
  ADD CONSTRAINT `fk_movie_type` FOREIGN KEY (`id_type`) REFERENCES `type` (`id_type`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
