<?php
require "bdd.php";


session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=men2;charset=utf8', 'root', '');
    $stmt = $bdd->prepare('SELECT * FROM verif_admin WHERE email = ? AND mdp = ? AND lvl = 2');
    $stmt->execute([$email, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {

        $_SESSION['user_id'] = $user['id'];
        header("Location: admin.php");
        exit;
    } else {

        $error_message = "Email ou mot de passe incorrect.";
    }
}


if (isset($_SESSION['user_id'])) {
    header("Location: admin_dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8" />
   <link rel="stylesheet" href="stylesadmin.css">
   <title>Connexion Administrateur</title>
</head>
<body>
    

   <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
       <div>
           <label for="email">Email:</label>
           <input type="text" id="email" name="email" required>
       </div>
       <div>
           <label for="password">Mot de passe:</label>
           <input type="password" id="password" name="password" required>
       </div>
       <div>
           <button type="submit">Se connecter</button>
       </div>
   </form>
   <?php if(isset($error_message)) echo "<p>$error_message</p>"; ?>
</body>
</html>
