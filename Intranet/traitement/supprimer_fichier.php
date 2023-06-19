<?php
if (isset($_GET['file'])) {
    $file = $_GET['file'];

    if (file_exists($file)) {
        if (unlink($file)) {
            echo 'Le fichier a été supprimé avec succès.';
        } else {
            echo 'Une erreur s\'est produite lors de la suppression du fichier.';
        }
    } else {
        echo 'Le fichier n\'existe pas.';
    }
} else {
    echo 'Paramètre de fichier manquant.';
}
?>