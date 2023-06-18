<!DOCTYPE html>
<html>
<head>
    <?php include '../Fonction_Intranet.php'; header_Intranet(); navbar_Intranet(); ?>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h1>Gestionnaire de fichiers</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php
            $depotDir = "../données/fichier_partages/";
            $depotDirperso = "../données/fichier_partages/Personnel/";

            function afficherActions($fichier)
            {
                echo '<td>';
                echo '<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#externalModal" data-url="../traitement/visualiser.php?fichier=' . urlencode($fichier) . '">Visualiser</button>';
                echo '<a href="../traitement/supprimer.php?fichier=' . urlencode($fichier) . '" class="btn btn-primary btn-danger btn-sm">Supprimer</a>';
                echo '</td>';
            }

            echo '<table class="table table-striped table-hover">';
            echo '<thead>';
            echo '<tr><th>Dossier</th><th>Nom du fichier</th><th>Actions</th></tr>';
            echo '</thead>';
            echo '<tbody>';

            // Fonction de lecture de la base de données des fichiers
            function lireBaseDeDonneesFichiers($dossier)
            {
                // Ici, vous pouvez mettre votre code pour lire la base de données des fichiers pour le dossier spécifié
                // Assurez-vous de récupérer les informations nécessaires, telles que le nom du fichier et le chemin d'accès
                // Vous pouvez utiliser la variable $dossier pour filtrer les fichiers en fonction du dossier sélectionné

                // Exemple de données fictives pour le dossier "Personnel"
                $fichiers = array(
                    array('dossier' => 'Personnel', 'nom' => 'fichier1.txt', 'chemin' => '..\data\uploads\admin\648f540029371_photo-1503023345310-bd7c1de61c7d.jpg'),
                    array('dossier' => 'Personnel', 'nom' => 'fichier2.txt', 'chemin' => 'chemin/vers/fichier2.txt'),
                    // Ajoutez d'autres fichiers si nécessaire
                );

                return $fichiers;
            }

            function afficherContenuDossier($dossier)
            {
                $fichiers = lireBaseDeDonneesFichiers($dossier);

                foreach ($fichiers as $fichier) {
                    echo '<tr>';
                    echo '<td>' . $fichier['dossier'] . '</td>';
                    echo '<td>' . $fichier['nom'] . '</td>';
                    afficherActions($fichier['chemin']);
                    echo '</tr>';
                }
            }

            // Vérifier si un dossier est sélectionné
            if (isset($_GET['dossier'])) {
                $dossierSelectionne = $_GET['dossier'];

                // Vérifier si le dossier sélectionné est "Personnel"
                if ($dossierSelectionne === 'Personnel') {
                    afficherContenuDossier($depotDirperso);
                } else {
                    // Afficher une erreur ou une autre action en cas de dossier invalide
                    echo '<tr><td colspan="3">Dossier invalide</td></tr>';
                }
            } else {
                // Afficher le contenu du dossier "Personnel" par défaut
                afficherContenuDossier($depotDirperso);
            }

            echo '<tr><td colspan="3"><button type="button" class="btn btn-primary" id="ajouterBtn">Ajouter un fichier</button></td></tr>';

            echo '</tbody>';
            echo '</table>';
            ?>
        </div>
    </div>
</div>

<div class="modal fade" id="ajouterModal" tabindex="-1" aria-labelledby="ajouterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ajouterModalLabel">Ajouter un fichier</h5>
            </div>
            <div class="modal-body">
                <form action="../traitement/upload.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="depot">Dépôt :</label>
                        <select class="form-control" id="depot" name="depot">
                            <option value="perso">Perso</option>
                            <?php
                            foreach ($_SESSION["roles"] as $role) {
                                echo "<option value=\"$role\">$role</option>";
                            }
                            ?>
                        </select>
                    </div> <br>
                    <div class="form-group">
                        <label for="file">Sélectionner un fichier :</label><br>
                        <input type="file" class="form-control-file" id="file" name="file">
                    </div><br>
                    <button type="button" class="btn btn-primary btn-danger" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const ajouterBtn = document.querySelector('#ajouterBtn');
    const ajouterModal = new bootstrap.Modal(document.getElementById('ajouterModal'));

    ajouterBtn.addEventListener('click', () => {
        ajouterModal.show();
    });
</script>

<div class="modal fade" id="externalModal" tabindex="-1" aria-labelledby="externalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="externalModalLabel">Visualisation du fichier :</h5>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
            </div>
            <div class="modal-body">
                <div id="externalContent"></div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Fonction pour charger le contenu de la page externe de visualisation en AJAX
        function loadExternalContent(url) {
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html',
                success: function(response) {
                    $('#externalContent').html(response);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }

        // Événement d'ouverture du modal
        $(document).on('click', '[data-bs-toggle="modal"][data-url]', function() {
            var url = $(this).data('url'); // URL de la page externe à charger

            // Charger le contenu de la page externe dans le modal
            loadExternalContent(url);
        });
    });
</script>

</body>
</html>
