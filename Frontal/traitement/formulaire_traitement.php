<?php
$nom = $_POST['nom'];
$email = $_POST['email'];
$message = $_POST['message'];


$json = file_get_contents('../../Intranet/données/formulaire.json');


$messages = json_decode($json, true);


$newMessage = array(
    "nom" => $nom,
    "email" => $email,
    "message" => $message
);
$messages[] = $newMessage;

$json = json_encode($messages, JSON_PRETTY_PRINT);


file_put_contents('../../Intranet/données/formulaire.json', $json);

header('Location: ../page/confirmation.php');
?>

