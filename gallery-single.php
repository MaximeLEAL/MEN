<?php
    require 'bdd.php';
    session_start();
    $sql = $bdd->prepare("SELECT chemin FROM images WHERE id_f = ? ");
    $sql->execute(array($_SESSION['idf']['id_f']));
    $tableau = array();
    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $tableau[] = $row['chemin'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Votre Série</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cardo:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
</head>
<body>

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center  me-auto me-lg-0">
            <i class="bi bi-camera"></i>
            <h1>MEN</h1>
        </a>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">Favoris</a></li>
                <li class="dropdown"><a href="#"><span>Gallery</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a href="gallery.php" class="active">Actions</a></li>
                        <li><a href="gallery.php">Humour</a></li>
                        <li><a href="gallery.php">Horreur</a></li>
                        <li><a href="gallery.php">Fantaisie</a></li>
                        <li><a href="gallery.php">Dramatique</a></li>
                        <li><a href="gallery.php">Jeunesse</a></li>
                    </ul>
                </li>
                <li><a href="services.php">Services</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="inscription_connex.php">Login</a></li>
            </ul>
        </nav>
        <div class="header-social-links">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
    </div>
</header>

<main id="main" data-aos="fade" data-aos-delay="1500">
    <div class="page-header d-flex align-items-center">
        <div class="container position-relative">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 text-center">
                    <?php echo "<h2>{$_SESSION['nomf']['nom_f']}</h2>";?>
                </div>
            </div>
        </div>
    </div>

    <section id="gallery-single" class="gallery-single">
        <div class="container">
            <div class="position-relative h-100">
                <div class="slides-1 portfolio-details-slider swiper">
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide">
                            <img src="<?php echo $tableau[1]; ?>" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img src="<?php echo $tableau[0]; ?>" alt="">
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            <div class="row justify-content-between gy-4 mt-4">
                <div class="col-lg-8">
                    <div class="portfolio-description">
                        <h2>DESCRIPTION</h2>
                        <?php echo "<p>{$_SESSION['descrif']['description_f']}</p>";?>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="portfolio-info">
                        <h3>Project information</h3>
                        <ul>
                            <li><strong>Category</strong> <span>Nature Photography</span></li>
                            <li><strong>Client</strong> <span>ASU Company</span></li>
                            <li><strong>Project date</strong> <span>01 March, 2022</span></li>
                            <li><strong>Project URL</strong> <a href="#">Bande Annonce</a></li>
                            <li><?php echo "<a href='{$_SESSION['lienf']['lien_f']}' class='btn-visit align-self-start'>Voir</a>";?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST["nom"];
        $commentaire = $_POST["commentaire"];
        if (!empty($nom) && !empty($commentaire)) {
            $fichier_commentaires = "commentaires.txt";
            $nouveau_commentaire = "Nom: $nom\nCommentaire: $commentaire\n\n";
            if ($handle = fopen($fichier_commentaires, 'a')) {
                if (fwrite($handle, $nouveau_commentaire) === FALSE) {
                    echo "Impossible d'écrire dans le fichier ($fichier_commentaires)";
                } else {
                    echo "Commentaire ajouté avec succès.";
                }
                fclose($handle);
            } else {
                echo "Impossible d'ouvrir le fichier ($fichier_commentaires) en écriture.";
            }
        } else {
            echo "Veuillez remplir tous les champs.";
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="rating.css">
        <title>Système de Notation</title>
    </head>
    <body>
        <h2>Laissez un commentaire</h2>
        <form method="post">
            <label for="nom">Nom:</label><br>
            <input type="text" id="nom" name="nom"><br>
            <label for="commentaire">Commentaire:</label><br>
            <textarea id="commentaire" name="commentaire"></textarea><br>
            <input type="submit" value="Envoyer">
        </form>

        <?php
        $fichier_commentaires = "commentaires.txt";
        if (file_exists($fichier_commentaires)) {
            $commentaires = file_get_contents($fichier_commentaires);
            echo "<h2>Commentaires précédents</h2>";
            echo "<pre>$commentaires</pre>";
        } else {
            echo "Aucun commentaire pour le moment.";
        }
        ?>

        <h1>Donnez une note à cette série :</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="video_id" value="1">
            <div class="rating">
                <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 étoiles"></label>
                <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 étoiles"></label>
                <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 étoiles"></label>
                <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 étoiles"></label>
                <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 étoile"></label>
            </div>
            <button type="submit">Soumettre</button>
        </form>

        <?php
        if(isset($_POST['rating'])) {
            $rating = $_POST['rating'];
            echo "<p>Votre note : $rating étoiles</p>";
        }$fichier_notes = "notes.txt";
        if (file_exists($fichier_notes)) {
            $notes = file_get_contents($fichier_notes);
            echo "<h2>Anciennes notes</h2>";
            echo "<pre>$notes</pre>";
        } else {
            echo "Aucune note pour le moment.";
        }
        ?>
    </body>
    </html>
</main>

<footer id="footer" class="footer">
    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>MEN</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>
</footer>

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<div id="preloader">
    <div class="line"></div>
</div>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
