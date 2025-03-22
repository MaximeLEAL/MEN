-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 08:19 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `men2`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `verifadmin` (IN `p_email` VARCHAR(255), IN `p_password` VARCHAR(255))   BEGIN
    SELECT id
    FROM users
    WHERE email = p_email AND mdp = p_password AND lvl = 2;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admingestion`
--

CREATE TABLE `admingestion` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `realisateur` varchar(255) NOT NULL,
  `annee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admingestion`
--

INSERT INTO `admingestion` (`id`, `titre`, `realisateur`, `annee`) VALUES
(3, 'Batman', 'Maxime', 2024);

-- --------------------------------------------------------

--
-- Table structure for table `appartenir`
--

CREATE TABLE `appartenir` (
  `id_f` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_cat` int(11) NOT NULL,
  `libelle_cat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_cat`, `libelle_cat`) VALUES
(1, 'Action'),
(2, 'Humour'),
(3, 'Horreur'),
(4, 'Fantaisie'),
(5, 'Dramatique'),
(6, 'Jeunesse');

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

CREATE TABLE `commentaires` (
  `id_commentaire` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `commentaire` text DEFAULT NULL,
  `date_commentaire` timestamp NOT NULL DEFAULT current_timestamp(),
  `approuve` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

CREATE TABLE `films` (
  `id_f` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `nom_f` varchar(50) NOT NULL,
  `duree_f` int(11) NOT NULL,
  `description_f` text NOT NULL,
  `lien_f` varchar(255) NOT NULL,
  `imag_f` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `films`
--

INSERT INTO `films` (`id_f`, `id_cat`, `nom_f`, `duree_f`, `description_f`, `lien_f`, `imag_f`) VALUES
(3, 1, 'Daredevil', 100, '\"Daredevil\" est une série télévisée basée sur le personnage de Marvel Comics. Elle suit Matt Murdock, un avocat aveugle qui combat le crime la nuit en tant que Daredevil à Hell\'s Kitchen, NYC. La série est saluée pour son approche sombre, ses combats impressionnants et ses performances d\'acteurs, notamment Charlie Cox et Vincent D\'Onofrio. Bien que la série ait été annulée après trois saisons, elle reste appréciée pour son intrigue captivante et ses thèmes profonds.', 'https://www.youtube.com/watch?v=nHLouGzHO4s', ''),
(4, 1, 'The Punisher', 100, '\"The Punisher\" est une série télévisée d\'action et de vengeance basée sur le personnage de Marvel Comics. Elle suit Frank Castle, un ancien Marine devenu justicier armé qui cherche à venger le meurtre de sa famille. La série explore les traumatismes de Castle, ses méthodes violentes et sa quête de justice personnelle. Saluée pour sa performance intense de Jon Bernthal dans le rôle principal, la série offre également des scènes d\'action percutantes et une exploration complexe des dilemmes moraux. Bien qu\'elle ait été annulée après deux saisons, \"The Punisher\" reste une adaptation appréciée pour son portrait sombre et nuancé du personnage emblématique de Marvel.', 'https://www.youtube.com/watch?v=09Gz82tLmXA', ''),
(5, 1, 'Prison Break', 100, '\"Prison Break\" est une série télévisée captivante centrée sur deux frères, Michael Scofield et Lincoln Burrows. Scofield, un ingénieur brillant, se fait délibérément incarcérer dans la même prison que son frère, condamné à tort pour un crime qu\'il n\'a pas commis. Le plan de Scofield est de s\'évader avec son frère en utilisant un plan élaboré qu\'il a tatoué sur son propre corps. La série combine suspense, action et intrigue alors que les frères et leurs complices tentent de surmonter les obstacles pour atteindre leur objectif. \"Prison Break\" est acclamée pour son scénario palpitant, ses rebondissements inattendus et ses performances convaincantes, notamment celles de Wentworth Miller et Dominic Purcell dans les rôles principaux. Bien qu\'elle ait connu des hauts et des bas au cours de ses saisons, \"Prison Break\" reste une série emblématique du genre du thriller carcéral.', 'https://www.youtube.com/watch?v=nUM7Oc1FmuA', ''),
(6, 1, 'Flash', 100, '\"Flash\" est une série télévisée de super-héros basée sur le personnage de DC Comics, Barry Allen, alias Flash. Elle suit les aventures de Barry, un scientifique qui obtient des pouvoirs de vitesse après un accident. La série mêle action, humour et émotion, mettant en scène ses combats contre des méchants surhumains à Central City. Appréciée pour ses effets spéciaux et performances d\'acteurs, notamment Grant Gustin dans le rôle principal, elle explore les thèmes de la famille et de l\'amitié.', 'https://www.youtube.com/watch?v=8HB40lEa_j8', ''),
(7, 1, 'Snowfall', 100, '\"Snowfall\" est une série télévisée dramatique qui plonge dans l\'émergence de l\'épidémie de crack à Los Angeles au début des années 1980. La série suit plusieurs personnages, dont Franklin Saint, un jeune trafiquant de drogue, Gustavo \"El Oso\" Zapata, un catcheur mexicain devenu contrebandier de cocaïne, et Teddy McDonald, un agent de la CIA qui manipule le trafic de drogue pour financer des opérations secrètes en Amérique centrale.\r\n\r\n\"Snowfall\" explore les diverses facettes de la montée du trafic de drogue à Los Angeles, des quartiers défavorisés aux couloirs du pouvoir, en passant par les ramifications internationales. La série offre un regard brut et réaliste sur les conséquences sociales, économiques et politiques de la crise du crack, tout en présentant des personnages complexes et nuancés qui tentent de naviguer dans un monde de plus en plus dangereux et corrompu.\r\n\r\nAppréciée pour son scénario captivant, ses performances d\'acteurs et sa reconstitution fidèle de l\'époque, \"Snowfall\" offre une plongée immersive dans les sombres réalités du commerce de la drogue et de ses conséquences dévastatrices sur la société.', 'https://www.youtube.com/watch?v=2ga1eCIO5W4', ''),
(8, 1, 'breaking bad', 100, '\"Breaking Bad\" est une série télévisée emblématique qui suit l\'histoire de Walter White, un professeur de chimie désespéré qui se tourne vers la fabrication de méthamphétamine après avoir été diagnostiqué d\'un cancer. Accompagné de son ancien élève, Jesse Pinkman, ils entrent dans le monde dangereux du trafic de drogue à Albuquerque, au Nouveau-Mexique. La série explore la transformation de Walter en un baron de la drogue impitoyable, tout en mettant en lumière les conséquences dévastatrices de ses choix sur sa famille et ceux qui l\'entourent. Son intrigue tendue, ses personnages complexes et ses thèmes profonds en font une œuvre remarquablement captivante.', 'https://www.youtube.com/watch?v=CoWsuFdqeYE&t=1s', ''),
(9, 1, 'the mentalist', 100, '\"The Mentalist\" suit l\'histoire de Patrick Jane, un consultant indépendant au charme troublant, qui utilise ses compétences de mentaliste pour aider le California Bureau of Investigation (CBI) à résoudre des crimes. Jane possède un talent remarquable pour lire les gens et déduire la vérité, mais il est hanté par son passé sombre, notamment la perte tragique de sa famille aux mains d\'un tueur en série surnommé \"Red John\". La série combine des enquêtes policières captivantes avec le développement des personnages, en particulier celui de Jane, qui cherche la rédemption tout en poursuivant sa quête obsessionnelle pour attraper Red John. L\'humour, l\'intelligence et le mystère font de \"The Mentalist\" une série inoubliable pour les amateurs de suspense et de psychologie.', 'https://www.youtube.com/watch?v=HPIf11_LujU', ''),
(10, 1, 'Dr House', 100, '\"Dr House\" suit le Dr Gregory House, un médecin brillant mais misanthrope, qui dirige une équipe de diagnosticiens à l\'hôpital fictif de Princeton-Plainsboro, dans le New Jersey. Connu pour son intelligence acérée, son attitude cynique et son addiction aux analgésiques, House résout des cas médicaux mystérieux et complexes tout en naviguant à travers les défis de sa propre vie personnelle et professionnelle. La série explore les relations tendues entre House et son équipe, ainsi que les éthiques médicales, la nature de la douleur et de la souffrance, et les dilemmes moraux auxquels sont confrontés les professionnels de la santé. Avec un humour mordant et des intrigues médicales intrigantes, \"Dr House\" est devenu un classique de la télévision.', 'https://www.youtube.com/watch?v=QmyW2p2Zt7E', ''),
(11, 1, 'The walking dead', 100, '\"The Walking Dead\" se déroule dans un monde post-apocalyptique ravagé par une épidémie de morts-vivants. La série suit un groupe diversifié de survivants, dirigé initialement par le shérif adjoint Rick Grimes, alors qu\'ils luttent pour survivre dans un monde où les morts marchent et où les vivants sont souvent plus dangereux que les zombies. Au fil des saisons, les personnages doivent faire face à des dilemmes moraux, des conflits internes et externes, ainsi que des pertes déchirantes alors qu\'ils cherchent un refuge sûr et tentent de reconstruire une société dans un monde dévasté. \"The Walking Dead\" est acclamée pour son exploration des thèmes de la survie, de l\'humanité et de la résilience dans des circonstances extrêmes, ainsi que pour ses personnages complexes et ses moments poignants.', 'https://www.youtube.com/watch?v=AbtiqJGhWyY', ''),
(12, 1, 'Games of Thrones', 100, '\"Game of Thrones\" est une saga épique qui se déroule dans un monde fantastique où des familles nobles se disputent le contrôle du Royaume des Sept Couronnes de Westeros. Basée sur les romans de George R.R. Martin, la série suit un vaste ensemble de personnages, des rois aux roturiers, alors qu\'ils naviguent à travers des intrigues politiques, des alliances fragiles et des batailles épiques pour le pouvoir. Avec des éléments de magie, de mystère et de drame politique, \"Game of Thrones\" offre un mélange complexe de personnages nuancés, de décors somptueux et de rebondissements inattendus. La série est saluée pour ses performances d\'acteurs, ses scénarios intelligents et sa capacité à subvertir les attentes du public, tout en explorant des thèmes universels tels que le pouvoir, la loyauté, la vengeance et la destinée.', 'https://www.youtube.com/watch?v=aAF12LNAeNI', ''),
(13, 1, 'Vikings', 100, '\"Vikings\" est une série dramatique historique qui explore la vie légendaire du héros viking Ragnar Lothbrok et de sa famille, ainsi que les exploits de leurs descendants. Située à l\'âge des Vikings, la série commence avec les premières incursions de Ragnar dans les royaumes de l\'ouest et sa montée en puissance en tant que chef viking respecté. À travers des batailles épiques, des alliances politiques et des trahisons, \"Vikings\" offre un regard fascinant sur la culture viking, leur exploration de nouveaux territoires et leur héritage martial. En mettant l\'accent sur les personnages complexes, les dilemmes moraux et les relations familiales, la série offre une plongée immersive dans un monde brutal mais captivant où l\'honneur, la loyauté et le courage sont constamment mis à l\'épreuve.', 'https://www.youtube.com/watch?v=mAl60ykBm4A', ''),
(14, 1, 'The 100', 100, '\"The 100\" se déroule dans un avenir post-apocalyptique où la Terre a été dévastée par une guerre nucléaire, forçant les survivants à vivre dans une station spatiale appelée l\'Arche. Lorsque les ressources sur l\'Arche commencent à s\'épuiser, les dirigeants envoient un groupe de cent jeunes délinquants sur Terre pour déterminer si elle est habitable à nouveau. Ce groupe, composé d\'adolescents et de jeunes adultes, doit naviguer dans un monde sauvage et hostile rempli de dangers, y compris d\'autres humains survivants, des mutations génétiques et des menaces environnementales. Alors qu\'ils luttent pour survivre et établir une nouvelle société, des conflits internes et externes émergent, mettant en lumière des thèmes tels que la moralité, le leadership et la survie de l\'humanité. Avec son exploration des dilemmes éthiques et ses rebondissements palpitants, \"The 100\" offre une aventure captivante dans un monde post-apocalyptique où chaque décision a des conséquences mortelles.', 'https://www.youtube.com/watch?v=lpY9u8VT-1c', ''),
(15, 1, 'Peaky blinders', 100, '\"Peaky Blinders\" est une série dramatique qui se déroule à Birmingham, en Angleterre, après la Première Guerre mondiale. Elle suit la famille Shelby, dirigée par le charismatique et impitoyable Tommy Shelby, qui dirige un gang criminel connu sous le nom des \"Peaky Blinders\". La série explore les luttes de pouvoir, les alliances dangereuses et les intrigues politiques alors que les Shelby cherchent à étendre leur influence dans le monde du crime tout en affrontant des adversaires redoutables, notamment la police, les gangs rivaux et des politiciens corrompus. Avec son esthétique visuelle distinctive, sa bande-son envoûtante et ses performances d\'acteurs remarquables, \"Peaky Blinders\" offre une plongée fascinante dans l\'atmosphère tumultueuse des années 1920 en Angleterre, tout en explorant des thèmes de famille, de loyauté et de rédemption.', 'https://www.youtube.com/watch?v=j3tX27beCpY&t=33s', ''),
(16, 1, 'Arrow', 100, '\"Arrow\" est une série télévisée d\'action et de super-héros qui suit l\'histoire d\'Oliver Queen, un playboy milliardaire devenu justicier masqué après avoir été présumé mort pendant cinq ans sur une île isolée. De retour à Starling City, il utilise son alter ego, Green Arrow, pour combattre le crime et protéger sa ville des menaces, tout en affrontant ses propres démons et en formant une équipe de héros. La série est connue pour son mélange captivant d\'action, de suspense et de développement de personnages, ainsi que pour ses multiples rebondissements et alliances surprenantes.', 'https://www.youtube.com/watch?v=nPCxc8vXMso', ''),
(17, 1, 'Ma Famille D\'abord', 100, '\"Ma Famille d\'Abord\" est une série comique qui suit les tribulations de la famille Kyle, dirigée par Michael Kyle, un père de famille excentrique et autoritaire, et sa femme, Janet, une mère au foyer attentionnée. Ensemble, ils élèvent leurs trois enfants, Junior, Claire et Kady, chacun avec sa propre personnalité et ses défis uniques. La série explore les dynamiques familiales avec humour et chaleur, mettant en lumière les joies et les défis de la vie quotidienne, tout en offrant des leçons précieuses sur l\'amour, le respect et la compréhension mutuelle.', 'https://www.youtube.com/watch?v=oLlvI4PdNgo', ''),
(18, 1, 'Rick And Morty', 100, '\"Rick and Morty\" est une série d\'animation comique et de science-fiction qui suit les aventures chaotiques et souvent absurdes du scientifique génial mais socialement inadapté Rick Sanchez et de son petit-fils adolescent, Morty Smith. Ensemble, ils voyagent à travers l\'univers et les dimensions par le biais de portails interdimensionnels, rencontrant une multitude de créatures étranges, d\'aliens et de situations dangereuses ou loufoques. La série mélange humour noir, satire sociale et concepts scientifiques, offrant une exploration unique de thèmes tels que l\'existentialisme, la moralité et les relations familiales, le tout avec un style visuel distinctif et des dialogues ciselés.', 'https://www.youtube.com/watch?v=opRwgY7RDP0&t=3s', '');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id_img` int(11) NOT NULL,
  `chemin` varchar(255) NOT NULL,
  `id_f` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id_img`, `chemin`, `id_f`) VALUES
(1, 'https://www.ecranlarge.com/media/cache/1600x1200/uploads/image/001/038/daredevil-saison-3-photo-daredevil-1038349.jpg\r\n\r\n', 3),
(2, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTIXGqYhicATJU-iHWW22EiEsxXwUAacVvGAgFKXUOG9Q&s https://www.numerama.com/wp-content/uploads/2022/02/daredevil-netflix.jpg', 3),
(3, 'https://www.ecranlarge.com/media/cache/1600x1200/uploads/image/001/151/oxehjbdljs6ax2mmaxpx5sqnp7d-104.jpg\r\nhttps://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTIXGqYhicATJU-iHWW22EiEsxXwUAacVvGAgFKXUOG9Q&s https://www.numerama.com/wp-content/uploads/20', 3),
(4, 'https://prod-ripcut-delivery.disney-plus.net/v1/variant/disney/A00D62C3AE04498A6EFEA5260FAB9B6E01DC5D59991EF86C93AECA83502389CC/scale?width=1200&amp;aspectRatio=1.78&amp;format=webphttps://images.rtl.fr/~c/770v513/rtl/www/1271999-the-punisher-est-disponib', 4),
(5, 'https://media.gettyimages.com/id/1082971624/fr/photo/hollywood-ca-ben-barnes-arrives-at-marvels-the-punisher-los-angeles-premiere-at-arclight.jpg?s=612x612&w=gi&k=20&c=yBErTtinyH27l0bLNI2mU1rBR1lMB4PjH7JZJNkuWEU=', 4),
(6, 'https://prod-ripcut-delivery.disney-plus.net/v1/variant/disney/B661D1CF4B2D5C3EED3456C80726E412E5AF83F8C1C78A707F6D3AD27C56D67D/scale?width=1200&amp;aspectRatio=1.78&amp;format=webphttps://resize.elle.fr/article_1280/var/plain_site/storage/images/loisirs/', 5),
(7, 'https://pic.clubic.com/v1/images/2117025/raw?fit=max&width=1200&hash=b029595363891e7cc1ded2db6df3764f119ddf64https://photos.tf1.fr/1200/720/vignette-paysage-flash-091a90-0b8a46-0@1x.webp', 6),
(8, 'https://w.forfun.com/fetch/c3/c3ff3686096907eea22827e903b14b6c.jpeg', 5),
(9, 'https://warner-bros.epresspack.me/storage/clients/163/rev-1-FLSH-DCT-0001_High_Res_JPEG_1682326574.jpg', 6),
(10, 'https://m.media-amazon.com/images/S/pv-target-images/dbd10ed9faeb7b4d0247e9609ad76d767b6fe2815636329bcf39858b07e3ce3a.jpghttps://media.senscritique.com/media/000016987633/0/snowfall.jpg ', 7),
(11, 'https://fr.web.img4.acsta.net/r_1280_720/pictures/23/03/23/12/19/5608712.jpg', 7),
(12, 'https://c8.alamy.com/compfr/cpp3dp/breaking-bad-saison-2-cpp3dp.jpg', 8),
(13, 'https://media.gettyimages.com/id/1411716919/fr/photo/albuquerque-new-mexico-actor-aaron-paul-and-actor-bryan-cranston-examine-bronze-statues.jpg?s=612x612&w=gi&k=20&c=YmqO-GMpJH66Ih-uDELhV1il-0-lKxXySVuH8EwjLZU=', 8),
(14, 'https://c8.alamy.com/compfr/cm65wy/13-octobre-2012-hollywood-californie-etats-unis-the-mentalist-100e-episode-de-travail-a-l-edison-a-los-angeles-ca-10-13-2012-12-tim-kang-amangda-righetti-simon-baker-robin-tunney-owain-yeoman-image-credit-james-diddick-g', 9),
(15, 'https://media.gettyimages.com/id/84229071/fr/photo/los-angeles-simon-baker-stars-in-the-mentalist-as-patrick-jane-a-detective-and-independent.jpg?s=612x612&w=gi&k=20&c=2DRyqRBfXrAIBxnLPSpc_Hz0bizdAN3SBsFfY0Jl7aE=', 9),
(16, 'https://www.programme-tv.net/imgre/fit/http.3A.2F.2Fprd2-bone-image.2Es3-website-eu-west-1.2Eamazonaws.2Ecom.2FTEL.2Enews.2F2018.2F01.2F11.2Fef3c6490-46b8-497e-91a9-63afe1c3f0e1.2Ejpeg/900x506/quality/70/hugh-laurie-lisa-edelstein-jesse-spencer-que-sont-d', 10),
(17, 'https://fr.web.img6.acsta.net/pictures/19/06/05/14/49/2750210.jpg', 10),
(18, 'https://www.si.edu/sites/default/files/newsdesk/press_releases/the-walking-dead-season-8-key-art-rick-lincoln-daryl-reedus-800x600.jpg', 11),
(19, 'https://resize.elle.fr/original/var/plain_site/storage/images/loisirs/series/the-walking-dead-le-spin-off-offrira-un-univers-tres-different-3942875/95191281-1-fre-FR/The-Walking-Dead-le-spin-off-offrira-un-univers-tres-different.jpg', 11),
(20, 'https://www.hollywoodreporter.com/wp-content/uploads/2015/12/got-iconic-images-18_2.jpg?w=3000', 12),
(21, 'https://cdn.artphotolimited.com/images/64a3c718bd40b8ebb5668725/1000x1000/daenerys-arrives-at-winterfell-with-her-dragons.jpg', 12),
(22, 'https://www.slate.fr/uploads/store/drupal_slate/vikingscopie.jpg', 13),
(23, 'https://images.rtl.fr/~c/2000v2000/rtl/www/1555541-travis-fimmel-l-interprete-de-ragnar-lothbrok-dans-la-serie-vikings.jpg', 13),
(24, 'https://i.pinimg.com/236x/78/65/70/78657080fdf7938d3faf06de31f17df6.jpg', 14),
(25, 'https://fr.web.img2.acsta.net/pictures/18/11/06/15/15/5211161.jpg', 14),
(26, 'https://w.forfun.com/fetch/17/17674bc49afefa2e5503e230ae71bd59.jpeg', 15),
(27, 'https://media.gqmagazine.fr/photos/5bb75f0276251b00118d01e9/4:3/w_1352,h_1014,c_limit/peaky_blinder.png', 15),
(28, 'https://www.premiere.fr/sites/default/files/styles/scale_crop_1280x720/public/2023-01/aa.jpg', 16),
(29, 'https://upload.wikimedia.org/wikipedia/en/7/7f/Arrow_%28cast%29.jpg', 16),
(30, 'https://www.toutlecd.com/wp-content/uploads/2023/06/ma-famille-d-abord-disney-que-deviennent-les-acteurs-de-la-serie-photos.jpeg', 17),
(31, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSv-vYk4Mi6-Xz46GfrpNC7J9ubklg-SLFDl5u5bXBYg&s', 17),
(32, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcREZy7n5O78T9FUV4b2zXyS0C6x8vQM0gMgfoDqpuxpxQ&s', 18),
(33, 'https://resize.programme-television.ladmedia.fr/rcrop/690,388/img/var/imports/agtv/2/7/3/3282963372_169.jpg', 18);

-- --------------------------------------------------------

--
-- Table structure for table `ip_logs`
--

CREATE TABLE `ip_logs` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `access_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ip_logs`
--

INSERT INTO `ip_logs` (`id`, `ip_address`, `access_time`) VALUES
(8, '127.0.0.1', '2024-04-23 07:23:03'),
(9, '127.0.0.1', '2024-04-23 07:23:04'),
(10, '127.0.0.1', '2024-04-23 07:23:17'),
(11, '127.0.0.1', '2024-04-23 07:25:52'),
(12, '127.0.0.1', '2024-04-23 07:26:18'),
(13, '127.0.0.1', '2024-04-23 07:28:01'),
(14, '127.0.0.1', '2024-04-23 07:28:02'),
(15, '127.0.0.1', '2024-04-23 07:28:57'),
(16, '127.0.0.1', '2024-04-23 07:31:14'),
(17, '127.0.0.1', '2024-04-23 16:42:14'),
(18, '127.0.0.1', '2024-04-23 16:43:38'),
(19, '127.0.0.1', '2024-04-23 16:47:48'),
(20, '127.0.0.1', '2024-04-23 16:51:30'),
(21, '127.0.0.1', '2024-04-23 16:51:32'),
(22, '127.0.0.1', '2024-04-23 16:52:04'),
(23, '127.0.0.1', '2024-04-23 16:54:22'),
(24, '127.0.0.1', '2024-04-23 16:55:01'),
(25, '127.0.0.1', '2024-04-23 16:55:47'),
(26, '127.0.0.1', '2024-04-23 16:55:58'),
(27, '127.0.0.1', '2024-04-23 16:56:14'),
(28, '127.0.0.1', '2024-04-23 17:01:38'),
(29, '127.0.0.1', '2024-04-23 17:01:40'),
(30, '127.0.0.1', '2024-04-23 17:03:42'),
(31, '127.0.0.1', '2024-04-23 17:07:45'),
(32, '127.0.0.1', '2024-04-23 17:07:47'),
(33, '127.0.0.1', '2024-04-23 17:07:48'),
(34, '127.0.0.1', '2024-04-23 17:07:49'),
(35, '127.0.0.1', '2024-04-23 17:09:39'),
(36, '127.0.0.1', '2024-04-23 17:09:40'),
(37, '127.0.0.1', '2024-04-23 17:09:44'),
(38, '127.0.0.1', '2024-04-23 17:09:54'),
(39, '127.0.0.1', '2024-04-23 17:09:57'),
(40, '127.0.0.1', '2024-04-23 17:12:45'),
(41, '127.0.0.1', '2024-04-23 17:12:47'),
(42, '127.0.0.1', '2024-04-23 17:12:48'),
(43, '127.0.0.1', '2024-04-23 17:13:27'),
(44, '127.0.0.1', '2024-04-23 17:14:37'),
(45, '127.0.0.1', '2024-04-23 17:16:51'),
(46, '127.0.0.1', '2024-04-23 17:16:53'),
(47, '127.0.0.1', '2024-04-23 17:32:52'),
(48, '127.0.0.1', '2024-04-23 17:33:02'),
(49, '127.0.0.1', '2024-04-23 17:33:07'),
(50, '127.0.0.1', '2024-04-23 17:35:58'),
(51, '127.0.0.1', '2024-04-23 17:36:05'),
(52, '127.0.0.1', '2024-04-23 17:36:26'),
(53, '127.0.0.1', '2024-04-24 06:13:38'),
(54, '127.0.0.1', '2024-04-24 06:13:55'),
(55, '127.0.0.1', '2024-04-24 06:15:15');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) UNSIGNED NOT NULL,
  `video_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `video_id`, `rating`, `created_at`) VALUES
(1, 1, 2, '2024-04-23 09:11:58'),
(2, 1, 2, '2024-04-23 09:13:07'),
(3, 1, 2, '2024-04-23 09:14:52'),
(4, 1, 3, '2024-04-23 09:19:23');

-- --------------------------------------------------------

--
-- Table structure for table `regarder`
--

CREATE TABLE `regarder` (
  `id_f` int(11) NOT NULL,
  `id_m` int(11) NOT NULL,
  `note` float NOT NULL,
  `commentaire` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_m` int(11) NOT NULL,
  `login` varchar(35) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `lvl` int(11) NOT NULL,
  `date_deb_abo` datetime NOT NULL,
  `date_fin_abo` datetime NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `actif_abo` int(1) NOT NULL,
  `confirme` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_m`, `login`, `mdp`, `email`, `lvl`, `date_deb_abo`, `date_fin_abo`, `nom`, `prenom`, `actif_abo`, `confirme`) VALUES
(17, '', '1234', 'Maxime@gmail.com', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Leal', 'Maxime', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_confirm`
--

CREATE TABLE `users_confirm` (
  `supprime_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verif_admin`
--

CREATE TABLE `verif_admin` (
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `lvl` int(11) NOT NULL,
  `id_v` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verif_admin`
--

INSERT INTO `verif_admin` (`email`, `mdp`, `lvl`, `id_v`) VALUES
('Men@gmail.com', '1234', 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admingestion`
--
ALTER TABLE `admingestion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appartenir`
--
ALTER TABLE `appartenir`
  ADD PRIMARY KEY (`id_f`,`id_cat`),
  ADD KEY `id_cat` (`id_cat`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indexes for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id_commentaire`);

--
-- Indexes for table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id_f`),
  ADD KEY `fk_cat` (`id_cat`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id_img`);

--
-- Indexes for table `ip_logs`
--
ALTER TABLE `ip_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regarder`
--
ALTER TABLE `regarder`
  ADD PRIMARY KEY (`id_f`,`id_m`),
  ADD KEY `id_m` (`id_m`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_m`);

--
-- Indexes for table `verif_admin`
--
ALTER TABLE `verif_admin`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admingestion`
--
ALTER TABLE `admingestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id_commentaire` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `films`
--
ALTER TABLE `films`
  MODIFY `id_f` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id_img` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `ip_logs`
--
ALTER TABLE `ip_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_m` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appartenir`
--
ALTER TABLE `appartenir`
  ADD CONSTRAINT `appartenir_ibfk_1` FOREIGN KEY (`id_f`) REFERENCES `films` (`id_f`),
  ADD CONSTRAINT `appartenir_ibfk_2` FOREIGN KEY (`id_cat`) REFERENCES `categories` (`id_cat`);

--
-- Constraints for table `films`
--
ALTER TABLE `films`
  ADD CONSTRAINT `fk_cat` FOREIGN KEY (`id_cat`) REFERENCES `categories` (`id_cat`);

--
-- Constraints for table `regarder`
--
ALTER TABLE `regarder`
  ADD CONSTRAINT `regarder_ibfk_1` FOREIGN KEY (`id_f`) REFERENCES `films` (`id_f`),
  ADD CONSTRAINT `regarder_ibfk_2` FOREIGN KEY (`id_m`) REFERENCES `users` (`id_m`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
