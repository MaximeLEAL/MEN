<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=men2;charset=utf8', 'root', '');
if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
   $supprime = (int) $_GET['supprime'];
   $req = $bdd->prepare('DELETE FROM commentaires WHERE id_commentaire = ?');
   $req->execute(array($supprime));
}

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
      $req = $bdd->prepare('DELETE FROM commentaires WHERE id_m = ?');
      $req->execute(array($supprime));
   }
}
$users = $bdd->query('SELECT * FROM users ORDER BY id_m DESC LIMIT 0,5');
$commentaires = $bdd->query('SELECT * FROM commentaires ORDER BY id_m DESC LIMIT 0,5');
?>
<?php
if(isset($_GET['supprime']) && !empty($_GET['supprime'])) {

    $supprime = (int) $_GET['supprime'];
    
    $req = $bdd->prepare('DELETE FROM commentaires WHERE id_commentaire = ?');
    $req->execute(array($supprime));
    header('Location: gallery-single.php');
    exit(); 
} else {
    header('Location: gallery-single.php');
    exit();
}
?>

