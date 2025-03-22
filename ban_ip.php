<?php
include "bdd.php";
function is_ip_banned($ip) {
    $banned_ips = file('banned_ips.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return in_array($ip, $banned_ips);
}

$user_ip = $_SERVER['REMOTE_ADDR'];

if (is_ip_banned($user_ip)) {
    echo "Votre adresse IP est bannie. Veuillez contacter l'administrateur du site pour plus d'informations.";
    exit;
}
?>
