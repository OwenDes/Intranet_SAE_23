<?php include '../Fonction_Intranet.php'; header_Intranet() ?>
    
    
<div class="container text-center lead">
        <h1 class="mb-4 pt-5">Partenariats</h1>
    </div> 
    <div class="container text-center lead">
        <p><em>Sur cette page, nous souhaitons mettre en lumière nos partenaires et mécènes, véritables acteurs du progrès et de l'efficacité de notre mission. Leur soutien généreux et leur contribution active jouent un rôle essentiel dans la poursuite de nos objectifs communs.</em></p>
        <section>
    
    <div class="container-fluid offset-md-2 pt-5 pb-4 col-md-8">
    <div class="row">
    
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
        echo '<div class="container-fluid mb-5">';
        echo '<p>' . $description . '</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo 'Erreur lors de la lecture du fichier JSON.';
}

?>

</div>
</div>

</section>
<?php pagefooter_Intranet() ;?>