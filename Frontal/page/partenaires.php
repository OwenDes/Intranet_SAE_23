<?php include '../fonction.php'; head() ; pageheader_2() ?>
    <div class="container text-center lead">
        <h1 class="mb-4 pt-5">Partenariats</h1>
    </div> 
    <div class="container text-center lead">
        <p><em>Sur cette page, nous souhaitons mettre en lumière nos partenaires et mécènes, véritables acteurs du progrès et de l'efficacité de notre mission. Leur soutien généreux et leur contribution active jouent un rôle essentiel dans la poursuite de nos objectifs communs.</em></p>
    </div>
<section>
    
    <div class="container offset-md-2 pt-5 pb-4">
    
    <?php

$jsonFilePath = '../../Intranet/données/partenaires.json';
$jsonData = file_get_contents($jsonFilePath);
$data = json_decode($jsonData);

if ($data !== null) {
    foreach ($data as $item) {
        $description = $item->description;
        $image = $item->image;
        $timestamp = time(); // Obtient le timestamp actuel

        echo '<div class="container mb-5 lead">';
        echo '<div class="container mb-5">';
        echo '<img src="' . $image . '?t=' . $timestamp . '" alt="Image" class="img-fluid shadow rounded" width="170px">';
        echo '</div>';
        echo '<p>' . $description . '</p>';
        echo '</div>';
    }
} else {
    echo 'Erreur lors de la lecture du fichier JSON.';
}

?>

</section>
<div class="container mt-5 mb-5 text-center lead">
        <p><strong><em>Nous sommes ravis d'annoncer l'arrivée prochaine d'un nouveau partenaire au sein du SNIS (Service National d'Incendie et de Secours) du Listemburg. Restez à l'écoute pour découvrir notre collaboration prometteuse !</em></strong></p>
    </div>
<?php pagefooter() ;?>