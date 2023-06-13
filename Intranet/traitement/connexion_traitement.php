<?php

$user = $_POST['login'];
$mdp = $_POST['motdepasse'];

$json = file_get_contents('../données/contacts.json');
$data = json_decode($json, true);

foreach ($data as $key => $value) {
    if ($value['user'] == $user && $value['mdp'] == $mdp) {
        session_start();
        $_SESSION['nom'] = $value['nom'];
        header('Location: ../page/Intranet');
        exit;
    }
}
echo "pas ok";
// header('Location: ../page/connexion.php');
exit;

?>
