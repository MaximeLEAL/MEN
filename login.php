<?php
require "bdd.php";
session_start();

$insertUser = $bdd->prepare('SELECT actif_abo FROM users WHERE email = ? AND mdp = ?');
$insertUser->execute(array($_SESSION['email'], $_SESSION['mdp']));
$_SESSION['insertUser'] = $insertUser->fetch();

if ($_SESSION['insertUser']['actif_abo'] == 1 ) {
        header('Location: time.php');
        exit();
    } 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abonnement</title>
    <link rel="stylesheet" href="styles3.css">
</head>
<body>
<button onclick="window.location.href = 'index.php';">ACCUEIL</button>
    <div class="container">
        <div class="column">
            <h2>Choisissez la durée de l'abonnement</h2>
            <div class="abonnement">
                <form method="post">
                    <button type="submit" name="start" value="2">2 jours</button>
                    <button type="submit" name="start" value="3">3 jours</button>
                    <button type="submit" name="start" value="5">5 jours</button>
                    <button type="submit" name="deconnexion">Se déconnecter</button>
                </form>
            </div>
        </div>
    </div>

<?php

    if (isset($_POST['deconnexion'])) {
        setcookie('email','',time()-3600);
        setcookie('mdp','',time()-3600);
        header('Location: inscription_connex.php');
        exit();
    }
    elseif (isset($_POST['start'])) {
        $_SESSION['startTime'] = time();
        $_SESSION['duration'] = $_POST['start'] * 24 * 60 * 60;
        header('Location: time.php');
        exit();
    }
    ?>
</body>
</html>