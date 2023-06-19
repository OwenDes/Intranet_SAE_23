<?php include '../Fonction_Intranet.php'; 
session_start();
if (!isset($_SESSION['user']) || !isset($_SESSION['role']) || ($_SESSION['role'] != 'user' && $_SESSION['role'] != 'admin')) {
    header('Location: ../page/connexion.php');
    exit();
}
if (!isset($_SESSION['user']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ../page/Intranet.php');
    exit();
}




header_Intranet(); navbar_Intranet() ?>
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
      $allowed_extensions = array('pdf','txt', 'jpg', 'jpeg', 'png');
      $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);

      if (!in_array($file_extension, $allowed_extensions)) {
          $message = "Les fichiers exécutables et les scripts ne sont pas autorisés.";
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
  <hr>
  <h1>Contenu du dossier :</h1>
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
              
              if (in_array($file_extension, array('pdf','txt', 'jpg', 'jpeg', 'png'))) {
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
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="fileModalLabel">Contenu du fichier</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p id="fileContent"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  var fileModal = document.getElementById('fileModal');
  fileModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var file = button.getAttribute('data-file');

    // Charger le contenu du fichier via une requête AJAX
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          document.getElementById('fileContent').textContent = xhr.responseText;
        } else {
          document.getElementById('fileContent').textContent = 'Erreur lors du chargement du fichier.';
        }
      }
    };
    xhr.open('GET', file, true);
    xhr.send();
  });

  function deleteFile(file) {
    var confirmation = confirm("Êtes-vous sûr de vouloir supprimer ce fichier ?");
    if (confirmation) {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            location.reload(); // Actualiser la page après la suppression du fichier
          } else {
            alert('Une erreur s\'est produite lors de la suppression du fichier.');
          }
        }
      };
      xhr.open('GET', '../traitement/supprimer_fichier.php?file=' + encodeURIComponent(file), true);
      xhr.send();
    }
  }
</script>
