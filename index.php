<?php
include "includes/functions.php";
session_start();
require('bdd.php');
  

if ($_SERVER["REQUEST_METHOD"] == "POST"){ 

  if (isset($_POST['nom_films'])) {

    $sql = $bdd->prepare('SELECT id_f FROM films WHERE nom_f=?');
    $sql->execute(array($_POST['nom_films']));
    

    $_SESSION['idf'] = $sql->fetch();

    $sql = $bdd->prepare('SELECT description_f FROM films WHERE nom_f=?');
    $sql->execute(array($_POST['nom_films']));

    $_SESSION['descrif'] = $sql->fetch();

    $sql = $bdd->prepare('SELECT lien_f FROM films WHERE nom_f=?');
    $sql->execute(array($_POST['nom_films']));

    $_SESSION['lienf'] = $sql->fetch();

    $sql = $bdd->prepare('SELECT nom_f FROM films WHERE nom_f=?');
    $sql->execute(array($_POST['nom_films']));

    $_SESSION['nomf'] = $sql->fetch();
    
   
    header("Location: gallery-single.php");
    exit();
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MEN</title>
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
        
         <img src="assets/img/logo.png" alt=""> 
        <i class="bi bi-camera"></i>
        <h1>MEN</h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php" class="active">Home</a></li>
          <li><a href="about.php">Favoris</a></li>
          <li class="dropdown"><a href="#"><span>Explorer</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="gallery.php">Actions</a></li>
              <li><a href="gallery.php">Humour</a></li>
              <li><a href="gallery.php">Horreur</a></li>
              <li><a href="gallery.php">Fantaisie</a></li>
              <li><a href="gallery.php">Dramatique</a></li>
              <li><a href="gallery.php">Jeunesse</a></li>

              </li>
            </ul>
          </li>
          <li><a href="services.php">Services</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="inscription_connex.php">Login</a></li>
          <li><a href="verifadmin.php">Admin</a></li>
        </ul>
      </nav> 

      <div class="header-social-links">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header> 


  <section id="hero" class="hero d-flex flex-column justify-content-center align-items-center" data-aos="fade" data-aos-delay="1500">
    <div class="container"> 
      <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
          <h2>Bienvenue sur <span>MEN</span></h2>
          <p>Réalisé par Maxime Leal.</p>
          <a href="services.php" class="btn-get-started">Souscrire un abonnement</a>
        </div>
      </div>
    </div>
  </section> 

  <main id="main" data-aos="fade" data-aos-delay="1500">


    <section id="gallery" class="gallery">
      <div class="container-fluid">
      <form  method="post">
        <div class="row gy-4 justify-content-center">
          <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="gallery-item h-100">
              <img src="assets/img/gallery/gallery-1.jpg" class="img-fluid" alt="">
              <div class="gallery-links d-flex align-items-center justify-content-center">
                <a href="assets/img/gallery/gallery-1.jpg" title="Rick and Morty" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                <button type="submit" name="nom_films" value="Rick And Morty" class="details-link"><i class="bi bi-link-45deg"></i></button>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="gallery-item h-100">
              <img src="assets/img/gallery/gallery-2.jpg" class="img-fluid" alt="">
              <div class="gallery-links d-flex align-items-center justify-content-center">
                <a href="assets/img/gallery/gallery-2.jpg" title="Breaking Bad" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                <button type="submit" name="nom_films" value="breaking bad"  class="details-link"><i class="bi bi-link-45deg"></i></button>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="gallery-item h-100">
              <img src="assets/img/gallery/gallery-3.jpg" class="img-fluid" alt="">
              <div class="gallery-links d-flex align-items-center justify-content-center">
                <a href="assets/img/gallery/gallery-3.jpg" title="Prison Break" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                <button type="submit" name="nom_films"  value="Prison Break"  class="details-link"><i class="bi bi-link-45deg"></i></button>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="gallery-item h-100">
              <img src="assets/img/gallery/gallery-4.jpg" class="img-fluid" alt="">
              <div class="gallery-links d-flex align-items-center justify-content-center">
                <a href="assets/img/gallery/gallery-4.jpg" title="The Punisher" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                <button type="submit" name="nom_films"  value="The Punisher"  class="details-link"><i class="bi bi-link-45deg"></i></button>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="gallery-item h-100">
              <img src="assets/img/gallery/gallery-5.jpg" class="img-fluid" alt="">
              <div class="gallery-links d-flex align-items-center justify-content-center">
                <a href="assets/img/gallery/gallery-5.jpg" title="Flash" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                <button type="submit" name="nom_films"  value="Flash"  class="details-link"><i class="bi bi-link-45deg"></i></button>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="gallery-item h-100">
              <img src="assets/img/gallery/gallery-6.jpg" class="img-fluid" alt="">
              <div class="gallery-links d-flex align-items-center justify-content-center">
                <a href="assets/img/gallery/gallery-6.jpg" title="Ma Famille D'abord" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                <button type="submit" name="nom_films"  value="Ma Famille D'abord"  class="details-link"><i class="bi bi-link-45deg"></i></button>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="gallery-item h-100">
              <img src="assets/img/gallery/gallery-7.jpg" class="img-fluid" alt="">
              <div class="gallery-links d-flex align-items-center justify-content-center">
                <a href="assets/img/gallery/gallery-7.jpg" title="The walking dead" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                <button type="submit" name="nom_films"  value="The walking dead"  class="details-link"><i class="bi bi-link-45deg"></i></button>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="gallery-item h-100">
              <img src="assets/img/gallery/gallery-8.jpg" class="img-fluid" alt="">
              <div class="gallery-links d-flex align-items-center justify-content-center">
                <a href="assets/img/gallery/gallery-8.jpg" title="The Mentalist" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                <button type="submit" name="nom_films"  value="the mentalist"  class="details-link"><i class="bi bi-link-45deg"></i></button>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="gallery-item h-100">
              <img src="assets/img/gallery/gallery-9.jpg" class="img-fluid" alt="">
              <div class="gallery-links d-flex align-items-center justify-content-center">
                <a href="assets/img/gallery/gallery-9.jpg" title="Dr House" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                <button type="submit" name="nom_films"  value="Dr House"  class="details-link"><i class="bi bi-link-45deg"></i></button>
              </div>
            </div>
</div>
          <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="gallery-item h-100">
              <img src="assets/img/gallery/gallery-10.jpg" class="img-fluid" alt="">
              <div class="gallery-links d-flex align-items-center justify-content-center">
                <a href="assets/img/gallery/gallery-10.jpg" title="Games of Thrones" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                <button type="submit" name="nom_films"  value="Games of Thrones"  class="details-link"><i class="bi bi-link-45deg"></i></button>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="gallery-item h-100">
              <img src="assets/img/gallery/gallery-11.jpg" class="img-fluid" alt="">
              <div class="gallery-links d-flex align-items-center justify-content-center">
                <a href="assets/img/gallery/gallery-11.jpg" title="Vikings" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                <button type="submit" name="nom_films"  value="Vikings"  class="details-link"><i class="bi bi-link-45deg"></i></button>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="gallery-item h-100">
              <img src="assets/img/gallery/gallery-12.jpg" class="img-fluid" alt="">
              <div class="gallery-links d-flex align-items-center justify-content-center">
                <a href="assets/img/gallery/gallery-12.jpg" title="Snowfall" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                <button type="submit" name="nom_films"  value="Snowfall"  class="details-link"><i class="bi bi-link-45deg"></i></button>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="gallery-item h-100">
              <img src="assets/img/gallery/gallery-13.jpg" class="img-fluid" alt="">
              <div class="gallery-links d-flex align-items-center justify-content-center">
                <a href="assets/img/gallery/gallery-13.jpg" title="Daredevil" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                <button type="submit" name="nom_films"  value="Daredevil"  class="details-link"><i class="bi bi-link-45deg"></i></button>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="gallery-item h-100">
              <img src="assets/img/gallery/gallery-14.jpg" class="img-fluid" alt="">
              <div class="gallery-links d-flex align-items-center justify-content-center">
                <a href="assets/img/gallery/gallery-14.jpg" title="The 100" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                <button type="submit" name="nom_films"  value="Daredevil"  class="details-link"><i class="bi bi-link-45deg"></i></button>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="gallery-item h-100">
              <img src="assets/img/gallery/gallery-15.jpg" class="img-fluid" alt="">
              <div class="gallery-links d-flex align-items-center justify-content-center">
                <a href="assets/img/gallery/gallery-15.jpg" title="¨Peaky Blinders" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                <button type="submit" name="nom_films"  value="Peaky blinders"  class="details-link"><i class="bi bi-link-45deg"></i></button>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="gallery-item h-100">
              <img src="assets/img/gallery/gallery-16.jpg" class="img-fluid" alt="">
              <div class="gallery-links d-flex align-items-center justify-content-center">
                <a href="assets/img/gallery/gallery-16.jpg" title="Arrow" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                <button type="submit" name="nom_films"  value="Arrow"  class="details-link"><i class="bi bi-link-45deg"></i></button>
              </div>
            </div>
          </div>

        </div>
        </form>
      </div>
    </section>

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
