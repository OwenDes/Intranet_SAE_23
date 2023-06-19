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

$uploadDir = '../../Intranet/images/Upload/';
$counter = 1;

if (isset($_POST['submit'])) {
    $allowedExtensions = array('png','jpg','jpeg');

    $fileNames = array_filter($_FILES['images']['name']);

    if (!empty($fileNames) && !empty($_POST['description'])) {
        $partnerData = json_decode(file_get_contents('../données/Partenaires.json'), true);

        $description = $_POST['description'];
        if (isset($partnerData) && is_array($partnerData)) {
            $counter = count($partnerData) + 1;
        } 

        foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
            $fileName = $_FILES['images']['name'][$key];
            $fileTmp = $_FILES['images']['tmp_name'][$key];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if (in_array($fileExt, $allowedExtensions)) {
                $newFileName = sprintf('%02d', $counter) . '.png';
                $destination = $uploadDir . $newFileName;

                if (move_uploaded_file($fileTmp, $destination)) {
                    echo '<p class="bg-primary text-white text-center rounded my-2 p-2">Le fichier ' . $fileName . ' a été téléchargé avec succès !</p><br>';
                    $data = array(
                        'description' => nl2br($description),

                        'image' => '../../Intranet/images/Upload/' . $newFileName
                    );

                    $partnerData[] = $data;
                    echo '<p class="bg-primary text-white text-center rounded my-2 p-2">Description enregistrée avec succès !</p><br>';
                    $counter++;
                } else {
                    echo '<p class="bg-danger text-white text-center rounded my-2 p-2">Une erreur est survenue lors du téléchargement du fichier ' . $fileName . '.</p><br>';
                }
            } else {
                echo '<p class="bg-danger text-white text-center rounded my-2 p-2">Le fichier ' . $fileName . ' n\'est pas une image valide.</p><br>';
            }
        }

        $jsonData = json_encode($partnerData);

        file_put_contents('../données/Partenaires.json', $jsonData);
    } else {
        echo '<p class="bg-danger text-white text-center rounded my-2 p-2">Veuillez sélectionner au moins une image à télécharger et saisir une description avant de l\'enregistrer.</p><br>';
    }
}


if (isset($_GET['delete'])) {
    $imageToDelete = $_GET['delete'];
    $filePath = $uploadDir . $imageToDelete;

    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            echo '<p class="bg-secondary">\'image ' . $imageToDelete . ' a été supprimée avec succès.</p><br>';
        } else {
            echo '<p class="bg-primary text-white text-center rounded my-2 p-2">Une erreur est survenue lors de la suppression de l\'image ' . $imageToDelete . '.</p><br>';
        }
    } else {
        echo '<p class="bg-danger text-white text-center rounded my-2 p-2">L\'image ' . $imageToDelete . ' n\'existe pas !</p><br>';
    }
}

if (isset($_GET['delete_description'])) {
    $descriptionToDelete = $_GET['delete_description'];

    $partnerData = json_decode(file_get_contents('../données/Partenaires.json'), true);

    foreach ($partnerData as $key => $partner) {
        if (strcmp($partner['description'], $descriptionToDelete) === 0) {
            unset($partnerData[$key]);
            break;
        }
    }
    

    $jsonData = json_encode($partnerData);
    file_put_contents('../données/Partenaires.json', $jsonData);

    echo '<p class="bg-primary text-white text-center rounded my-2 p-2">La description a été supprimée avec succès du fichier JSON.</p><br>';
}

$uploadedImages = scandir($uploadDir);
$uploadedImages = array_diff($uploadedImages, array('.', '..'));

if (!empty($uploadedImages)) {
    echo '<div class="bg-white p-2 shadow rounded">';
    echo '<h1>Images stockées :</h1>';
    echo '<div class="container text-center">';
    echo '<div class="row">';
    foreach ($uploadedImages as $image) {
        echo '<div class="col">';
        echo '<img src="' . $uploadDir . $image . '" alt="' . $image . '" class="img-thumbnail">';
        echo '<a href="?delete=' . $image . '" class="btn btn-danger btn-sm mt-2 img-fluid">Supprimer</a>';
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

$partnerData = json_decode(file_get_contents('../données/Partenaires.json'), true);

if (!empty($partnerData)) {
    echo '<div class="bg-white p-2 my-3 shadow rounded">';
    echo '<h1>Descriptions des partenaires :</h1>';
    echo '<div class="container">';
    echo '<div class="row">';
    foreach ($partnerData as $partner) {
        echo '<div class="col">';
        echo '<p>' . $partner['description'] . '</p>';
        echo '<a href="?delete_description=' . $partner['description'] . '" class="btn btn-danger btn-sm mt-2">Supprimer</a>';
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