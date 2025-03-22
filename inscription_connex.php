<?php
session_start();
require "bdd.php";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_SESSION['email']) && isset($_COOKIE['email'], $_COOKIE['mdp']) && !empty($_COOKIE['email']) && !empty($_COOKIE['mdp'])){
        $_SESSION['email']  = $_POST["login_email"];
        $_SESSION['mdp']  = $_POST["login_password"];

        $sql = $bdd->prepare('SELECT * FROM users WHERE email = ? AND mdp = ?');
        $sql->execute(array($_SESSION['email'], $_SESSION['mdp']));
        $user = $sql->fetch();
    
        if ($user) {
            header("Location: login.php");
            exit();
        } else {
            $error_message = "Email ou mot de passe incorrect.";
        }
    }

    if (isset($_POST["connexion"])) {
        $_SESSION['email']  = $_POST["login_email"];
        $_SESSION['mdp']  = $_POST["login_password"];

        $sql = $bdd->prepare('SELECT * FROM users WHERE email = ? AND mdp = ?');
        $sql->execute(array($_SESSION['email'], $_SESSION['mdp']));
        $user = $sql->fetch();

        if ($user) {
            if (isset($_POST['rememberme'])){
                setcookie('email',$_SESSION['email'],time()+365*24*3600,null,null,false,true);
                setcookie('mdp',$_SESSION['mdp '],time()+365*24*3600,null,null,false,true);
            }
            header("Location: login.php");
            exit();
        } else {
            $error_message = "Email ou mot de passe incorrect.";
        }
    } elseif (isset($_POST["inscription"])) {
        $prenom = $_POST["prenom"];
        $nom = $_POST["nom"];
        $_SESSION['email'] = $_POST["email"];
        $_SESSION['mdp'] = $_POST["password"];
        $admin_password = $_POST["admin_password"];

        $verifemail = $bdd->prepare('SELECT email FROM users WHERE email=?');
        $verifemail->execute(array($_SESSION['email'])); 
        if ($verifemail->rowCount() == 0){
            if (empty($prenom) || empty($nom) || empty($_SESSION['email']) || empty($_SESSION['mdp'])) {
                $error_message = "Veuillez remplir tous les champs du formulaire.";
            } elseif (!empty($admin_password)) {
                $sql_admin = $bdd->prepare('SELECT email FROM verifadmin WHERE email=? AND mdp=?');
                $sql_admin->execute(array($_SESSION['email'], $admin_password)); 
                if ($sql_admin->rowCount() > 0) {
                    $level = 2;
                } else {
                    $error_message = "Mot de passe administrateur ou email incorrect.";
                }
            } else {
                $level = 1; 
            }

            if (isset($error_message)) {
                $insertUser = $bdd->prepare('INSERT INTO users(nom, prenom, email, mdp, lvl) VALUES(?, ?, ?, ?, ?)');
                $insertUser->execute(array($nom, $prenom,$_SESSION['email'], $_SESSION['mdp'], $level));
                if ($insertUser) { 
                    $_SESSION['abo']=0;
                    $_SESSION['verif'] = true;
                    header("Location: login.php");
                    exit();
                } else {
                    $error_message = "Erreur lors de l'inscription : " . $bdd->errorInfo()[2]; 
                }
            }
        } else {
            $error_message = "Email déjà utilisé.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription et Connexion</title>
    <link rel="stylesheet" href="styless.css">
</head>
<body>
    <button onclick="window.location.href = 'index.php';">ACCUEIL</button>
    <div class="container">
        <div class="column">
            <div class="form-container">
                <h2>Inscription</h2>
                <?php
                if (!empty($error_message)) {
                    echo "<p class='error'>$error_message</p>";
                }
                ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-group">
                        <label for="prenom">Prénom :</label>
                        <input type="text" id="prenom" name="prenom" required>
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom :</label>
                        <input type="text" id="nom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe :</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="admin_password">Mot de passe administrateur (optionnel) :</label>
                        <input type="password" id="admin_password" name="admin_password">
                    </div>
                    <button type="submit" name="inscription">S'inscrire</button>
                </form>
            </div>
        </div>
        <div class="column">
            <div class="form-container">
                <h2>Connexion</h2>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-group">
                        <label for="login_email">Email :</label>
                        <input type="email" id="login_email" name="login_email" required>
                    </div>
                    <div class="form-group">
                        <label for="login_password">Mot de passe :</label>
                        <input type="password" id="login_password" name="login_password" required>
                    </div>
                    <div class="form-group">
                        
                        <input type="checkbox" id="rememberme" name="remembercheckbox">
                        <label for="remembercheckbox">Se souvenir de moi</label>
                    </div>
                    <button type="submit" name="connexion">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>