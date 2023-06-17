<?php include '../Fonction_Intranet.php'; header_Intranet(); navbar_Intranet();

$uploadDir = 'C:/Users/Alex/Desktop/SAE 23 SNIS/Intranet_SAE_23/Intranet/images/Upload/'; // Répertoire de destination des images

if (isset($_POST['submit'])) {
    $allowedExtensions = array('png'); // Extensions de fichiers autorisées

    $fileNames = array_filter($_FILES['images']['name']);

    if (!empty($fileNames)) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
            $fileName = $_FILES['images']['name'][$key];
            $fileTmp = $_FILES['images']['tmp_name'][$key];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if (in_array($fileExt, $allowedExtensions)) {
                $newFileName = uniqid('image_') . '.' . $fileExt;
                $destination = $uploadDir . $newFileName;

                if (move_uploaded_file($fileTmp, $destination)) {
                    // Le fichier a été téléchargé avec succès, vous pouvez effectuer d'autres opérations ici si nécessaire
                    echo 'Le fichier ' . $fileName . ' a été téléchargé avec succès.<br>';
                } else {
                    echo 'Une erreur est survenue lors du téléchargement du fichier ' . $fileName . '.<br>';
                }
            } else {
                echo 'Le fichier ' . $fileName . ' n\'est pas une image valide.<br>';
            }
        }
    } else {
        echo 'Veuillez sélectionner au moins une image à télécharger.<br>';
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
        <h1>Dépôt d'images</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="images">Sélectionnez les images :</label>
                <input type="file" name="images[]" id="images" multiple accept="image/jpeg, image/png">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
</body>
</html>
<?php
pagefooter_Intranet();
?>
