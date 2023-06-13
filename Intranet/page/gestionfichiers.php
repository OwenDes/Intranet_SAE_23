<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h1>Gestionnaire de fichiers</h1>
        </div>
    </div>
    <!--<div class="row"> Formulaire de dépôt de fichier basique
        <div class="col-sm-12">
            <h2>Déposer un fichier</h2>
            <form action="../functions/traitement_function/upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="depot">Dépôt :</label>
                    <select class="form-control" id="depot" name="depot">
                        <option value="perso">Perso</option>
                        < ?php
                        foreach($_SESSION["roles"] as $role) {
                            echo "<option value=\"$role\">$role</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="file">Sélectionner un fichier :</label>
                    <input type="file" class="form-control-file" id="file" name="file">
                </div>
                <button type="submit" class="btn btn-primary">Télécharger</button>
            </form>
        </div>
    </div>-->

    <div class="row">
        <div class="col-sm-12">
            <?php
            $depotDir = "../data/uploads/";
            #$perso = $_SESSION["username"];
            #$depotDirperso = $depotDir . $perso . "/";
            #$roles = $_SESSION["roles"];

            function afficherActions($fichier) {
                echo '<td>';
                echo '<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#externalModal" data-url="../functions/traitement_function/visualiser.php?fichier=' . urlencode($fichier) . '">Visualiser</button>';
                echo '<a href="../functions/traitement_function/supprimer.php?fichier=' . urlencode($fichier) . '" class="btn btn-primary btn-danger btn-sm">Supprimer</a>';
                echo '</td>';
            }

            echo '<table class="table table-striped table-hover">';
            echo '<thead>';
            echo '<tr><th>Dossier</th><th>Nom du fichier</th><th>Actions</th></tr>';
            echo '</thead>';
            echo '<tbody>';

          # <!-- foreach ($roles as $role) {
              #  $depotDirRole = $depotDir . $role . "/";
              #  if (is_dir($depotDirRole)) {
              #      $fichiersRole = scandir($depotDirRole);
           #         foreach ($fichiersRole as $fichier) {
                 #       if ($fichier !== '.' && $fichier !== '..') {
              #              echo '<tr>';
             #               echo '<td>' . $role . '</td>';
             #               echo '<td>' . $fichier . '</td>';
            # #               afficherActions($fichier);
            #                echo '</tr>';
            #            }
             #       }
             #   }
            #} 

            #if (is_dir($depotDirperso)) {
            #    $fichiersPerso = scandir($depotDirperso);
            #    foreach ($fichiersPerso as $fichier) {
            #        if ($fichier !== '.' && $fichier !== '..') {
            #endregion            echo '<tr>';
             #           echo '<td>Personnel</td>';
             #           echo '<td>' . $fichier . '</td>';
             #           afficherActions($fichier);
              #          echo '</tr>';
             #       }
              #  }
          #  }

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
                <form action="../functions/traitement_function/upload.php" method="post" enctype="multipart/form-data">
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
        <?php #    <h5 class="modal-title" id="externalModalLabel">Visualisation du fichier : <?php echo "$fichier"; ?></h5>
         <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
            </div>
            <div class="modal-body">
                <div id="externalContent"></div>
            </div>
        </div>
    </div>
</div>

<style>
    .responsive-embed-container {
        position: relative;
        overflow-x: hidden;
        padding-bottom: 56.25%;
    }
    .responsive-embed-container embed {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 75%;
    }
</style>

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