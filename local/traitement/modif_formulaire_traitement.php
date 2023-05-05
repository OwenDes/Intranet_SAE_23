<?php

$titres = $_POST['titres'];
$contenus = $_POST['contenus'];
$liens = $_POST['liens'];
$ids = $_POST['ids'];

$json = file_get_contents('../données/actualites.json');

$actualites = json_decode($json, true);

foreach ($ids as $index => $id) {
  $actualites[$id]['titre'] = $titres[$index];
  $actualites[$id]['contenu'] = $contenus[$index];
  $actualites[$id]['lien'] = $liens[$index];
}

$json = json_encode($actualites, JSON_PRETTY_PRINT);
file_put_contents("../données/actualites.json", $json);
echo '<br>';

header("Location: ../page/modif_formualire.php");
exit;
?>
