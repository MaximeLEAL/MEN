<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=men2;charset=utf8', 'root', '');
if(isset($_GET['type']) AND $_GET['type'] == 'users') {
   if(isset($_GET['confirme']) AND !empty($_GET['confirme'])) {
      $confirme = (int) $_GET['confirme'];
      $req = $bdd->prepare('UPDATE users SET confirme = 1 WHERE id_m = ?');
      $req->execute(array($confirme));
   }
   if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      $req = $bdd->prepare('DELETE FROM users WHERE id_m = ?');
      $req->execute(array($supprime));
   }
} elseif(isset($_GET['type']) AND $_GET['type'] == 'commentaires') {
   if(isset($_GET['approuve']) AND !empty($_GET['approuve'])) {
      $approuve = (int) $_GET['approuve'];
      $req = $bdd->prepare('UPDATE commentaires SET approuve = 1 WHERE id_m = ?');
      $req->execute(array($approuve));
      
   }
   if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      $req = $bdd->prepare('DELETE FROM commentaires WHERE id_commentaire = ?');
      $req->execute(array($supprime));
   }
}
$users = $bdd->query('SELECT * FROM users ORDER BY id_m DESC LIMIT 0,5');
$commentaires = $bdd->query('SELECT * FROM commentaires ORDER BY id_commentaire DESC LIMIT 0,5');

?>
<?php

session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';



function log_ip($ip, $user_id) {
    $log_file = 'ip_logs.txt';
    $timestamp = date('Y-m-d H:i:s');
    $log_entry = "$timestamp - $ip - $user_id\n";
    file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);
}


function log_ip_db($ip) {
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=men2;charset=utf8', 'root', '');
    $stmt = $bdd->prepare('INSERT INTO ip_logs (ip_address, access_time) VALUES (?, NOW())');
    $stmt->execute([$ip]);
}


function delete_user_by_id($id) {
   $bdd = new PDO('mysql:host=127.0.0.1;dbname=men2;charset=utf8', 'root', '');
   $stmt = $bdd->prepare('DELETE FROM users WHERE id_m = ?');
   $stmt->execute([$id]);
}


function display_ip_logs() {
    $log_file = 'ip_logs.txt';
    if(file_exists($log_file)) {
        $ip_logs = file($log_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if($ip_logs) {
            echo "<h2>Adresses IP connectées récemment :</h2>";
            echo "<ul>";
            foreach($ip_logs as $ip_log) {
                $log_parts = explode(" - ", $ip_log);
                $timestamp = isset($log_parts[0]) ? $log_parts[0] : '';
                $ip = isset($log_parts[1]) ? $log_parts[1] : '';
                $user_id = isset($log_parts[2]) ? $log_parts[2] : '';
                echo "<li>$ip - Utilisateur ID: $user_id <a href='admin.php?delete_user_by_id={$user_id}'>Supprimer l'utilisateur associé</a></li>";
            }
            echo "</ul>";
        } else {
            echo "Aucune adresse IP n'a été journalisée.";
        }
    } else {
        echo "Le fichier de journalisation des adresses IP n'existe pas.";
    }
}


if(isset($_GET['delete_user_by_id'])) {
    $id_to_delete = $_GET['delete_user_by_id'];
    delete_user_by_id($id_to_delete);
    header("Location: admin.php");
    exit();
}

$user_ip = $_SERVER['REMOTE_ADDR'];
log_ip($user_ip, $user_id);
log_ip_db($user_ip);
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8" />
   <link rel="stylesheet" href="admin.css">
   <title>Administration</title>
</head>
<body>
   
<button onclick="window.location.href = 'index.php';">ACCUEIL</button>
   <ul>
      <?php while($u = $users->fetch()) { ?>
      <li><?= $u['id_m'] ?> : <?= $u['email'] ?><?php if($u['confirme'] == 0) { ?> - <a href="admin.php?type=membre&confirme=<?= $u['id_m'] ?>">Confirmer</a><?php } ?> - <a href="admin.php?type=users&supprime=<?= $u['id_m'] ?>">Supprimer</a></li>
      <?php } ?>
   </ul>
   <br /><br />
   <ul>
      <?php while($c = $commentaires->fetch()) { ?>
      <li><?= $c['id_m'] ?> : <?= $c['email'] ?> : <?= $c['contenu'] ?><?php if($c['approuve'] == 0) { ?> - <a href="admin.php?type=commentaire&approuve=<?= $c['id_m'] ?>">Approuver</a><?php } ?> - <a href="admin.php?type=commentaire&supprime=<?= $c['id_m'] ?>">Supprimer</a></li>
      <?php } ?>
   </ul>

   <?php display_ip_logs(); ?>

</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin2.css">
</head>
<body>
    <h1>Gestion des Films</h1>
    

    <h2>Ajouter un Film</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" required><br><br>
        
        <label for="realisateur">Réalisateur :</label>
        <input type="text" id="realisateur" name="realisateur" required><br><br>
        
        <label for="annee">Année :</label>
        <input type="number" id="annee" name="annee" min="1900" max="2099" required><br><br>
        
        <input type="submit" name="ajouter_film" value="Ajouter">
    </form>

    <h2>Supprimer un Film</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="id_supprimer">ID du Film :</label>
        <input type="number" id="id_supprimer" name="id_supprimer" required><br><br>
        
        <input type="submit" name="supprimer_film" value="Supprimer">
    </form>
    <h2>Modifier un Film</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="id_modifier">ID du Film :</label>
        <input type="number" id="id_modifier" name="id_modifier" required><br><br>
        
        <label for="nouveau_titre">Nouveau Titre :</label>
        <input type="text" id="nouveau_titre" name="nouveau_titre"><br><br>
        
        <label for="nouveau_realisateur">Nouveau Réalisateur :</label>
        <input type="text" id="nouveau_realisateur" name="nouveau_realisateur"><br><br>
        
        <label for="nouvelle_annee">Nouvelle Année :</label>
        <input type="number" id="nouvelle_annee" name="nouvelle_annee" min="1900" max="2099"><br><br>
        
        <input type="submit" name="modifier_film" value="Modifier">
    </form>
</body>
</html>
<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "men2"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["ajouter_film"])) {
        $titre = $_POST["titre"];
        $realisateur = $_POST["realisateur"];
        $annee = $_POST["annee"];

        $sql = "INSERT INTO admingestion (titre, realisateur, annee) VALUES ('$titre', '$realisateur', '$annee')";
        if ($conn->query($sql) === TRUE) {
            exit();
        } else {
            echo "Erreur lors de l'ajout du film : " . $conn->error;
        }
    } elseif (isset($_POST["supprimer_film"])) {

        $id_supprimer = $_POST["id_supprimer"];

        $sql = "DELETE FROM admingestion WHERE id = $id_supprimer";
        if ($conn->query($sql) === TRUE) {
            echo "Film supprimé avec succès.";
        } else {
            echo "Erreur lors de la suppression du film : " . $conn->error;
        }
    } elseif (isset($_POST["modifier_film"])) {
        $id_modifier = $_POST["id_modifier"];
        $nouveau_titre = $_POST["nouveau_titre"];
        $nouveau_realisateur = $_POST["nouveau_realisateur"];
        $nouvelle_annee = $_POST["nouvelle_annee"];

        $sql = "UPDATE admingestion SET titre='$nouveau_titre', realisateur='$nouveau_realisateur', annee='$nouvelle_annee' WHERE id=$id_modifier";
        if ($conn->query($sql) === TRUE) {
            echo "Film modifié avec succès.";
        } else {
            echo "Erreur lors de la modification du film : " . $conn->error;
        }
    }
}

$conn->close();
?>
