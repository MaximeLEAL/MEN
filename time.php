<?php
require "bdd.php";
session_start();

if (!isset($_SESSION['startTime']) || !isset($_SESSION['duration'])) {
    header('Location: inscription_connex.php'); 
    exit();
};

$verifbdd = $bdd->prepare('SELECT date_deb_abo FROM users WHERE email = ? AND mdp = ?');
$verifbdd->execute(array($_SESSION['email'], $_SESSION['mdp']));
$_SESSION['user'] = $verifbdd->fetch();

if ($_SESSION['user']['date_deb_abo'] != '0000-00-00 00:00:00' ) {
    $startTime = $_SESSION['user'];
    $verifbdd = $bdd->prepare('SELECT date_fin_abo , date_deb_abo  FROM users WHERE email = ? AND mdp = ?');
    $verifbdd->execute(array($_SESSION['email'], $_SESSION['mdp']));
    $_SESSION['user'] = $verifbdd->fetch();
    $startTime = $_SESSION['user']['date_deb_abo'];
    $endTime = $_SESSION['user']['date_fin_abo'];
    $_SESSION['abo']=1;
} else{
    $startTime = date('Y-m-d H:i:s', $_SESSION['startTime']);
    $endTimeFormatted = $_SESSION['startTime'] + $_SESSION['duration'];
    $endTime = date('Y-m-d H:i:s', $endTimeFormatted);
    $insertUser = $bdd->prepare('UPDATE users SET date_fin_abo = ?, date_deb_abo = ? WHERE email = ?');
    $insertUser->execute(array($startTime, $endTime, $_SESSION['email']));
    $_SESSION['abo']=1;
}

$insertUser = $bdd->prepare('UPDATE users SET actif_abo = ? WHERE email = ?');
$insertUser->execute(array(1, $_SESSION['email']));

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timer</title>
    <link rel="stylesheet" href="time.css">
</head>
<body>
<button onclick="window.location.href = 'index.php';">ACCUEIL</button>
    <div class="container">
        <div class="column">
            <h2>Abonnement en cours</h2>
            <p>Date de début de l'abonnement : <?php echo $startTime; ?></p>
            <p>Date de fin de l'abonnement : <?php echo $endTime; ?></p>
            <div id="timerDisplay">
                <?php
                $currentTime = time();
                $timeLeft = intval(strtotime($startTime)) -  $currentTime ;
                $daysLeft = floor($timeLeft / (24 * 60 * 60));
                $hoursLeft = floor(($timeLeft % (24 * 60 * 60)) / (60 * 60));
                $minutesLeft = floor(($timeLeft % (60 * 60)) / 60);
                $secondsLeft = $timeLeft % 60;
                echo "$daysLeft jours $hoursLeft heures $minutesLeft minutes $secondsLeft secondes restantes";
                ?>
            </div>
            <form method="post">
                <button type="submit" name="stop">Stopper l'abonnement</button>
                <button type="submit" name="deconnexion">Se déconnecter</button>
            </form>
        </div>
    </div>
    <?php

    if (isset($_POST['deconnexion'])) {
        $insertUser = $bdd->prepare('SELECT actif_abo FROM users WHERE email = ? AND mdp = ?');
        $insertUser->execute(array($_SESSION['email'], $_SESSION['mdp']));
        $_SESSION['insertUser'] = $insertUser->fetch();
        setcookie('email','',time()-3600);
        setcookie('mdp','',time()-3600);
        header('Location: inscription_connex.php');
        exit();}
    ?>

    <?php
    if (isset($_POST['stop'])) {
        $insertUser = $bdd->prepare('UPDATE users SET date_fin_abo = ?, date_deb_abo = ? WHERE email = ?');
        $insertUser->execute(array('0000-00-00 00:00:00' , '0000-00-00 00:00:00' , $_SESSION['email']));
        $insertUser = $bdd->prepare('UPDATE users SET actif_abo = ? WHERE email = ?');
        $insertUser->execute(array(0, $_SESSION['email']));
        $insertUser = $bdd->prepare('SELECT actif_abo FROM users WHERE email = ? AND mdp = ?');
        $insertUser->execute(array($_SESSION['email'], $_SESSION['mdp']));
        $_SESSION['insertUser'] = $insertUser->fetch();
        header('Location: login.php');
        exit();
    }
    ?>
</body>
</html>