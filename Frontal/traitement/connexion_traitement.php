<?php

$user = $_POST['login'];
$mdp = $_POST['motdepasse'];

$json = file_get_contents('../données/users.json');
$data = json_decode($json, true);

foreach ($data as $key => $value) {
    if ($value['user'] == $user && $value['mdp'] == $mdp) {
        session_start();
        $_SESSION['nom'] = $value['nom'];
        header('Location: ../page/page0.php');
        exit;
    }
}
header('Location: ../page/connexion.php');
exit;

?>
