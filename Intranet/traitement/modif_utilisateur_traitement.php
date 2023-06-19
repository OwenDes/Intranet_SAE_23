<!DOCTYPE html>
<head>
  <?php include '../Fonction_Intranet.php'; header_Intranet(); ?>
  <title>Modifier Utilisateur</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1>Modifier Utilisateur</h1>

    <?php
      // Lire le contenu du fichier JSON
      $json_data = file_get_contents('../données/users2.json');
      $contacts = json_decode($json_data, true);

      // Vérifier si l'ID de l'utilisateur est présent dans les paramètres de requête
      if (isset($_GET['id'])) {
        $id = $_GET['id'];

          // Vérifier si le formulaire a été soumis
          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Mettre à jour les informations de l'utilisateur
            $contact['lastName'] = $_POST['lastName'];
            $contact['user'] = $_POST['user'];
            $contact['phoneNumber'] = $_POST['phoneNumber'];
            $contact['email'] = $_POST['email'];
            $contact['grp'] = $_POST['grp'];
            $contact['matricule'] = $_POST['matricule'];

            // Vérifier si un fichier a été téléchargé
            if ($_FILES['photo']['error'] === UPLOAD_ERR_OK) {
              $uploadDir = '../images/PhotosAnnuaire/'; // Répertoire de stockage des photos
              $matricule = $user['matricule'];
              $extension = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
              $allowedExtensions = ['jpg', 'jpeg'];

              // Vérifier l'extension du fichier
              if (in_array($extension, $allowedExtensions)) {
                $fileName = $matricule . '.' . $extension;
                $targetPath = $uploadDir . $fileName;

                // Supprimer l'ancienne photo si elle existe
                if (file_exists($targetPath)) {
                  unlink($targetPath);
                }

                // Déplacer le fichier téléchargé vers le répertoire de stockage
                move_uploaded_file($_FILES['photo']['tmp_name'], $targetPath);

                // Mettre à jour le nom de la photo dans les informations de l'utilisateur
                $contact['photo'] = $targetPath;
              } else {
                echo '<p>Erreur : seuls les fichiers .jpg sont autorisés.</p>';
              }
            }

            // Mettre à jour le contact dans la liste des contacts
            $contacts[$id] = $user;

            // Enregistrer les modifications dans le fichier JSON
            $json_data = json_encode(['contacts' => $contacts], JSON_PRETTY_PRINT);
            file_put_contents('../données/users2.json', $json_data);

            // Rediriger vers la page d'annuaire
            header('Location: ../page/GestionAnnuaire.php');
            exit();
          }

          // Afficher le formulaire de modification pré-rempli avec les informations de l'utilisateur
          echo '
          <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="nom">Nom:</label>
              <input type="text" class="form-control" id="nom" name="nom" value="' . $user['lastName'] . '" required>
            </div>
            <div class="form-group">
              <label for="prenom">Prénom:</label>
              <input type="text" class="form-control" id="prenom" name="prenom" value="' . $user['user'] . '" required>
            </div>
            <div class="form-group">
              <label for="numero">Numéro de Téléphone:</label>
              <input type="text" class="form-control" id="numero" name="numero" value="' . $user['phoneNumber'] . '" required>
            </div>
            <div class="form-group">
              <label for="mail">Adresse mail:</label>
              <input type="email" class="form-control" id="mail" name="mail" value="' . $user['email'] . '" required>
            </div>
            <div class="form-group">
              <label for="service">Service:</label>
              <input type="text" class="form-control" id="service" name="service" value="' . $user['grp'] . '" required>
            </div>
            <div class="form-group">
              <label for="fonction">Fonction:</label>
              <input type="text" class="form-control" id="fonction" name="fonction" value="' . $user['matricule'] . '" required>
            </div>
            <div class="form-group">
              <label for="photo">Photo de profil (fichier .jpg):</label>
              <input type="file" class="form-control-file" id="photo" name="photo" accept=".jpg">
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
          </form>
          ';
        } else {
          echo '<p>L\'utilisateur spécifié n\'existe pas.</p>';
        }
      } else {
        echo '<p>Aucun utilisateur spécifié.</p>';
      }
    ?>
  </div>
</body>
<?php pagefooter_Intranet(); ?>
</html>
