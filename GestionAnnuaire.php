<!DOCTYPE html>
<html>
<head>
  <title>Modifier les informations</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1>Modifier les informations</h1>
    <?php
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les informations du formulaire
        $contact_id = $_POST['id'];
        $new_nom = $_POST['nom'];
        $new_prenom = $_POST['prenom'];
        $new_service = $_POST['service'];
        $new_fonction = $_POST['fonction'];

        // Mettre à jour les informations dans la base de données
        foreach ($contacts as &$contact) {
          if ($contact['id'] == $contact_id) {
            $contact['nom'] = $new_nom;
            $contact['prenom'] = $new_prenom;
            $contact['service'] = $new_service;
            $contact['fonction'] = $new_fonction;
            break;
          }
        }

        // Enregistrer les modifications dans le fichier JSON
        $json_data = json_encode(['contacts' => $contacts], JSON_PRETTY_PRINT);
        file_put_contents('contacts.json', $json_data);

        echo '<p>Les informations ont été mises à jour.</p>';
      } else {
        if (isset($_GET['id'])) {
          $contact_id = $_GET['id'];

          // Rechercher le contact correspondant dans la base de données
          $contact = null;
          foreach ($contacts as $c) {
            if ($c['id'] == $contact_id) {
              $contact = $c;
              break;
            }
          }

          // Afficher le formulaire de modification
          if ($contact) {
            echo '<form method="POST" action="edit.php">';
            echo '<input type="hidden" name="id" value="' . htmlspecialchars($contact['id']) . '">';
            echo '<p><label>Nom:</label> <input type="text" name="nom" value="' . htmlspecialchars($contact['nom']) . '"></p>';
            echo '<p><label>Prénom:</label> <input type="text" name="prenom" value="' . htmlspecialchars($contact['prenom']) . '"></p>';
            echo '<p><label>Service:</label> <input type="text" name="service" value="' . htmlspecialchars($contact['service']) . '"></p>';
            echo '<p><label>Fonction:</label> <input type="text" name="fonction" value="' . htmlspecialchars($contact['fonction']) . '"></p>';
            echo '<p><input type="submit" value="Enregistrer"></p>';
            echo '</form>';
            
          } else {
            echo '<p>Contact non trouvé.</p>';
          }
        } else {
          echo '<p>Aucun contact sélectionné.</p>';
        }
      }
    ?>
    <a href="annuaire.php">Retour à l'annuaire</a>
  </div>
</body>
</html>
