<?php
include '../Fonction_Intranet.php';
session_start();
if (!isset($_SESSION['user']) || !isset($_SESSION['role']) || ($_SESSION['role'] != 'user' && $_SESSION['role'] != 'admin')) {
    header('Location: ../page/connexion.php');
    exit();
}

header_Intranet();
navbar_Intranet();
?>

<div class="container">
    <h1>Upload de fichiers</h1>

    <form name='upload' method='post' action='' enctype='multipart/form-data'>
        <div class="mb-3">
            <label for="fichier" class="form-label">Choisir un fichier :</label>
            <input type="file" class="form-control" id="fichier" name="fichier">
        </div>
        <button type="submit" name="valider" class="btn btn-primary">Envoyer</button>
    </form>

    <?php
    if (isset($_POST['valider'])) {
        $file = $_FILES['fichier'];

        // Vérifier le type de fichier
        $allowed_extensions = array('pdf', 'txt', 'jpg', 'jpeg', 'png');
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);

        if (!in_array($file_extension, $allowed_extensions)) {
            $message = "Seul les fichiers jpeg, jpg, png, pdf et txt sont autorisés.";
            echo '<div class="alert alert-danger" role="alert">' . $message . '</div>';
        } else {
            if ($file['size'] > 10000000) {
                $message = "Le fichier est trop gros.";
                echo '<div class="alert alert-danger" role="alert">' . $message . '</div>';
            } else {
                $upload_dir = "../données/fichiers_partages/";
                $upload_file = $upload_dir . basename($file['name']);

                if (move_uploaded_file($file['tmp_name'], $upload_file)) {
                    $message = "Le fichier a été téléchargé avec succès.";
                    echo '<div class="alert alert-success" role="alert">' . $message . '</div>';
                } else {
                    $message = "Une erreur s'est produite lors du téléchargement du fichier.";
                    echo '<div class="alert alert-danger" role="alert">' . $message . '</div>';
                }
            }
        }
    }
    ?>

    <h2>Contenu du dossier :</h2>
    <?php
    $folder_path = "../données/fichiers_partages/";
    $files = scandir($folder_path);
    if ($files !== false) {
        echo '<table class="table table-striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Nom du fichier</th>';
        echo '<th>Action</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                echo '<tr>';
                echo '<td>' . $file . '</td>';
                echo '<td>';
                $file_path = $folder_path . '/' . $file;
                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);

                if (in_array($file_extension, array('pdf', 'txt', 'jpg', 'jpeg', 'png'))) {
                    echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#fileModal" data-file="' . $file_path . '">Voir</button>';
                }

                echo '     <a href="' . $file_path . '" download class="btn btn-secondary">Télécharger</a>';
                echo '     <button type="button" class="btn btn-danger" onclick="deleteFile(\'' . $file_path . '\')">Supprimer</button>';
                echo '</td>';
                echo '</tr>';
            }
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<div class="alert alert-warning" role="alert">Le dossier est vide ou n\'existe pas.</div>';
    }
    ?>

    <!-- Modal -->
    <div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fileModalLabel">Contenu du fichier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="fileViewer"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function deleteFile(file) {
        if (confirm("Êtes-vous sûr de vouloir supprimer ce fichier ?")) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        location.reload();
                    } else {
                        alert('Erreur lors de la suppression du fichier.');
                    }
                }
            };
            xhr.open('GET', '../traitement/supprimer_fichier.php?file=' + encodeURIComponent(file), true);
            xhr.send();
        }
    }

    var fileModal = document.getElementById('fileModal');
    fileModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var file = button.getAttribute('data-file');

        var fileViewer = document.getElementById('fileViewer');
        fileViewer.innerHTML = ''; // Réinitialiser le contenu du fichier précédent

        var fileExtension = file.split('.').pop().toLowerCase();
        if (fileExtension === 'pdf') {
            // Afficher un fichier PDF
            fileViewer.innerHTML = '<iframe src="' + file + '" frameborder="0" width="100%" height="500px"></iframe>';
        } else if (['jpg', 'jpeg', 'png'].includes(fileExtension)) {
            // Afficher une image
            fileViewer.innerHTML = '<img src="' + file + '" class="img-fluid" alt="Image">';
        } else {
            // Afficher le contenu du fichier texte
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        fileViewer.innerHTML = '<pre>' + xhr.responseText + '</pre>';
                    } else {
                        fileViewer.innerHTML = 'Erreur lors du chargement du fichier.';
                    }
                }
            };
            xhr.open('GET', file, true);
            xhr.send();
        }
    });

    fileModal.addEventListener('hidden.bs.modal', function () {
        // Supprimer le contenu affiché lorsque le modal est fermé
        var fileViewer = document.getElementById('fileViewer');
        fileViewer.innerHTML = '';
    });
</script>
