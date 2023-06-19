<?php
include '../Fonction_Intranet.php';

session_start();
if (!isset($_SESSION['user']) || !isset($_SESSION['role']) || ($_SESSION['role'] != 'user' && $_SESSION['role'] != 'admin')) {
    header('Location: ../page/connexion.php');
    exit();
}
if (!isset($_SESSION['user']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ../page/Intranet.php');
    exit();
}

header_Intranet();
echo '</div>';
navbar_Intranet();
echo '<br>';

$dossier_upload = '../../Intranet/images/Upload/';
$compteur = 1;

if (isset($_POST['submit'])) {
    $Extension_autorisées = array('png','jpg','jpeg');

    $nom_fichier = array_filter($_FILES['images']['name']);

    if (!empty($nom_fichier) && !empty($_POST['description'])) {
        $partenaires = json_decode(file_get_contents('../données/Partenaires.json'), true);

        $description = $_POST['description'];
        if (isset($partenaires) && is_array($partenaires)) {
            $compteur = count($partenaires) + 1;
        } 

        foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
            $nomfichier = $_FILES['images']['name'][$key];
            $Emplacement_temporaire = $_FILES['images']['tmp_name'][$key];
            $Extension_fichier = strtolower(pathinfo($nomfichier, PATHINFO_EXTENSION));

            if (in_array($Extension_fichier, $Extension_autorisées)) {
                $newnomfichier = sprintf('%02d', $compteur) . '.png';
                $destination = $dossier_upload . $newnomfichier;

                if (move_uploaded_file($Emplacement_temporaire, $destination)) {
                    echo '<p class="bg-primary text-white text-center rounded my-2 p-2">Le fichier ' . $nomfichier . ' a été téléchargé avec succès !</p><br>';
                    $data = array(
                        'description' => nl2br($description),

                        'image' => '../../Intranet/images/Upload/' . $newnomfichier
                    );

                    $partenaires[] = $data;
                    echo '<p class="bg-primary text-white text-center rounded my-2 p-2">Description enregistrée avec succès !</p><br>';
                    $compteur++;
                } else {
                    echo '<p class="bg-danger text-white text-center rounded my-2 p-2">Une erreur est survenue lors du téléchargement du fichier ' . $nomfichier . '.</p><br>';
                }
            } else {
                echo '<p class="bg-danger text-white text-center rounded my-2 p-2">Le fichier ' . $nomfichier . ' n\'est pas une image valide.</p><br>';
            }
        }

        $jsonData = json_encode($partenaires);

        file_put_contents('../données/Partenaires.json', $jsonData);
    } else {
        echo '<p class="bg-danger text-white text-center rounded my-2 p-2">Veuillez sélectionner au moins une image à télécharger et saisir une description avant de l\'enregistrer.</p><br>';
    }
}


if (isset($_GET['delete'])) {
    $image_suppr = $_GET['delete'];
    $chemin_fichier_suppr = $dossier_upload . $image_suppr;

    if (file_exists($chemin_fichier_suppr)) {
        if (unlink($chemin_fichier_suppr)) {
            echo '<p class="bg-secondary">\'image ' . $image_suppr . ' a été supprimée avec succès.</p><br>';
        } else {
            echo '<p class="bg-primary text-white text-center rounded my-2 p-2">Une erreur est survenue lors de la suppression de l\'image ' . $image_suppr . '.</p><br>';
        }
    } else {
        echo '<p class="bg-danger text-white text-center rounded my-2 p-2">L\'image ' . $image_suppr . ' n\'existe pas !</p><br>';
    }
}

if (isset($_GET['delete_description'])) {
    $description_suppr = $_GET['delete_description'];

    $partenaires = json_decode(file_get_contents('../données/Partenaires.json'), true);

    foreach ($partenaires as $key => $partenaire) {
        if (strcmp($partenaire['description'], $description_suppr) === 0) {
            unset($partenaires[$key]);
            break;
        }
    }
    

    $jsonData = json_encode($partenaires);
    file_put_contents('../données/Partenaires.json', $jsonData);

    echo '<p class="bg-primary text-white text-center rounded my-2 p-2">La description a été supprimée avec succès du fichier JSON.</p><br>';
}

$Image_upload = scandir($dossier_upload);
$Image_upload = array_diff($Image_upload, array('.', '..'));

if (!empty($Image_upload)) {
    echo '<div class="bg-white p-2 shadow rounded">';
    echo '<h1>Images stockées :</h1>';
    echo '<div class="container text-center">';
    echo '<div class="row">';
    foreach ($Image_upload as $image) {
        echo '<div class="col">';
        echo '<img src="' . $dossier_upload . $image . '" alt="' . $image . '" class="img-thumbnail">';
        echo '<a href="?delete=' . $image . '" class="btn btn-danger btn-sm mt-2 img-fluid">Supprimer</a>';
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

$partenaires = json_decode(file_get_contents('../données/Partenaires.json'), true);

if (!empty($partenaires)) {
    echo '<div class="bg-white p-2 my-3 shadow rounded">';
    echo '<h1>Descriptions des partenaires :</h1>';
    echo '<div class="container">';
    echo '<div class="row">';
    foreach ($partenaires as $partenaire) {
        echo '<div class="col">';
        echo '<p>' . $partenaire['description'] . '</p>';
        echo '<a href="?delete_description=' . $partenaire['description'] . '" class="btn btn-danger btn-sm mt-2">Supprimer</a>';
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

?>

    <div class="bg-white p-2 mt-3 mb-5 shadow rounded">
        <h1 >Dépôt de votre image :</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="images" class="lead"><br>Sélectionnez l'image que vous souhaitez au format PNG :</label><br>
                <input type="file" name="images[]" id="images" multiple accept="image/jpeg, image/png" required>
            </div>
            <hr>
            <div class="form-group">
                <label for="description" class="lead">Saissisez la desciption :</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            <hr>
            <button type="submit" name="submit" class="btn btn-primary my-2">Envoyer</button>
        </form>
    </div>
    </div>


<?php pagefooter_Intranet(); ?>