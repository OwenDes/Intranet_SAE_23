<?php include '../Fonction_Intranet.php'; header_Intranet() ?>
    
    
<?php

$partnerData = json_decode(file_get_contents('../../Intranet/données/Partenaires.json'), true);

if (!empty($partnerData)) {
    echo '<div class="row">';
    foreach ($partnerData as $partner) {
        echo '<div class="col-md-6">';
        echo '<img src="' . $partner['image'] . '" alt="' . $partner['description'] . '" class="img-thumbnail" style="width: 220px;">';
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
}
?>
    </div>
    <div class="container-fluid offset-md-2 col-sm-7 lead">
        <p>
        <?php
// Lire le contenu du fichier JSON
$jsonData = file_get_contents('../../Intranet/données/partenaires.json');

// Décoder le contenu JSON en tableau associatif
$data = json_decode($jsonData, true);

// Parcourir les éléments du tableau
foreach ($data as $item) {
    // Récupérer la valeur de la variable "description"
    $description = $item['description'];

    echo $description;

}
?>
        </p>
    </div>
</section>
<div class="container mt-5 mb-5 text-center lead">
        <p><strong><em>Nous sommes ravis d'annoncer l'arrivée prochaine d'un nouveau partenaire au sein du SNIS (Service National d'Incendie et de Secours) du Listemburg. Restez à l'écoute pour découvrir notre collaboration prometteuse !</em></strong></p>
    </div>
<?php pagefooter_Intranet() ;?>