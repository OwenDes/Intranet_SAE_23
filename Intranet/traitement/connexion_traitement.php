<?php

$user = $_POST['role'];
$mdp = $_POST['motdepasse'];

$json = file_get_contents('../données/users.json');
$data = json_decode($json, true);

foreach ($data as $key => $value) {
    if ($value['role'] == $user && $value['mdp'] == $mdp) {
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
