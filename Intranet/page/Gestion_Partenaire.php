<?php include '../Fonction_Intranet.php'; header_Intranet(); navbar_Intranet();

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
                    echo 'Le fichier ' . $fileName . ' a été téléchargé avec succès.<br>';
                    $data = array(
                        'description' => nl2br($description),
                        'image' => '../../Intranet/images/Upload/' . $newFileName
                    );

                    $partnerData[] = $data;
                    echo 'Description enregistrée avec succès !<br>';
                    $counter++;
                } else {
                    echo 'Une erreur est survenue lors du téléchargement du fichier ' . $fileName . '.<br>';
                }
            } else {
                echo 'Le fichier ' . $fileName . ' n\'est pas une image valide.<br>';
            }
        }

        $jsonData = json_encode($partnerData);

        file_put_contents('../données/Partenaires.json', $jsonData);
    } else {
        echo 'Veuillez sélectionner au moins une image à télécharger et saisir une description avant de l\'enregistrer.';
    }
}


if (isset($_GET['delete'])) {
    $imageToDelete = $_GET['delete'];
    $filePath = $uploadDir . $imageToDelete;

    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            echo 'L\'image ' . $imageToDelete . ' a été supprimée avec succès.<br>';
        } else {
            echo 'Une erreur est survenue lors de la suppression de l\'image ' . $imageToDelete . '.<br>';
        }
    } else {
        echo 'L\'image ' . $imageToDelete . ' n\'existe pas.<br>';
    }
}

if (isset($_GET['delete_description'])) {
    $descriptionToDelete = $_GET['delete_description'];

    $partnerData = json_decode(file_get_contents('../données/Partenaires.json'), true);

    foreach ($partnerData as $key => $partner) {
        if ($partner['description'] === $descriptionToDelete) {
            unset($partnerData[$key]);
            break;
        }
    }

    $jsonData = json_encode($partnerData);
    file_put_contents('../données/Partenaires.json', $jsonData);

    echo 'La description a été supprimée avec succès du fichier JSON.';
}

$uploadedImages = scandir($uploadDir);
$uploadedImages = array_diff($uploadedImages, array('.', '..'));

if (!empty($uploadedImages)) {
    echo '<h2>Images stockées :</h2>';
    echo '<div class="container">';
    echo '<div class="row">';
    foreach ($uploadedImages as $image) {
        echo '<div class="col-md-3">';
        echo '<img src="' . $uploadDir . $image . '" alt="' . $image . '" class="img-thumbnail">';
        echo '<a href="?delete=' . $image . '" class="btn btn-danger btn-sm mt-2">Supprimer</a>';
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
}

$partnerData = json_decode(file_get_contents('../données/Partenaires.json'), true);

if (!empty($partnerData)) {
    echo '<h2>Descriptions des partenaires :</h2>';
    echo '<div class="container">';
    echo '<div class="row">';
    foreach ($partnerData as $partner) {
        echo '<div class="col-md-6">';
        echo '<p>' . $partner['description'] . '</p>';
        echo '<a href="?delete_description=' . $partner['description'] . '" class="btn btn-danger btn-sm mt-2">Supprimer</a>';
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dépôt d'images</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 >Dépôt de votre image :</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="images" class="lead"><br>Sélectionnez l'image que vous souhaitez au format PNG :</label><br>
                <input type="file" name="images[]" id="images" multiple accept="image/jpeg, image/png" required>
            </div>
            <div class="form-group">
                <label for="description" class="lead">Saissisez la desciption :</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

<?php pagefooter_Intranet(); ?>