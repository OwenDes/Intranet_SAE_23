<!DOCTYPE html>
<head>
  <?php include '../Fonction_Intranet.php'; header_Intranet(); ?>

  <div class="container">
    <h1>Annuaire</h1>
    <form method="GET" action="">
      <div class="form-group">
        <input type="text" class="form-control my-2" name="search" placeholder="Recherche par numéro, nom ou adresse e-mail">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Rechercher</button>
      </div>
    </form>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Photo</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Numéro de Téléphone</th>
          <th>Adresse mail</th>
          <th>Service</th>
          <th>Fonction</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // Lire le contenu du fichier JSON
          $json_data = file_get_contents('../données/users.json');
          $contacts = json_decode($json_data, true);

          // Fonction de recherche
          if (isset($_GET['search']) && !empty($_GET['search'])) {
            $search = $_GET['search'];
            $filteredContacts = array_filter($contacts, function ($contact) use ($search) {
              return (strpos($contact['numero'], $search) !== false) ||
                     (strpos(strtolower($contact['nom']), strtolower($search)) !== false) ||
                     (strpos(strtolower($contact['mail']), strtolower($search)) !== false);
            });
            if (count($filteredContacts) > 0) {
              $contacts = $filteredContacts;
            } else {
              echo '<tr><td colspan="8">Aucun résultat trouvé.</td></tr>';
            }
          }

          // Afficher chaque contact dans une ligne du tableau
          foreach ($contacts as $id => $contact) {
            echo '<tr>';
            echo '<td><a href="#" data-toggle="modal" data-target="#contactModal-' . $id . '"><img src="' . $contact['photo'] . '" width="50"></a></td>';
            echo '<td>' . $contact['nom'] . '</td>';
            echo '<td>' . $contact['prenom'] . '</td>';
            echo '<td>' . $contact['numero_telephone'] . '</td>';
            echo '<td>' . $contact['mail'] . '</td>';
            echo '<td>' . $contact['service'] . '</td>';
            echo '<td>' . $contact['fonction'] . '</td>';
            echo '<td><a href="../traitement/modif_utilisateur_traitement.php?id=' . $id . '">Modifier</a></td>';
            echo '</tr>';

            // Afficher le modal pour chaque contact
            echo '<div class="modal fade" id="contactModal-' . $id . '" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel-' . $id . '" aria-hidden="true">';
            echo '<div class="modal-dialog" role="document">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="contactModalLabel-' . $id . '">' . $contact['nom'] . ' ' . $contact['prenom'] . '</h5>';
            echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            echo '<span aria-hidden="true">&times;</span>';
            echo '</button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<img src="' . $contact['photo'] . '" width="100">';
            echo '<p>Service: ' . $contact['service'] . '</p>';
            echo '<p>Fonction: ' . $contact['fonction'] . '</p>';
            echo '<p>Numéro de téléphone: ' . $contact['numero_telephone'] . '</p>';
            echo '<p>Adresse mail: ' . $contact['mail'] . '</p>';
          }
          if (count($contacts) == 0) {
            echo '<tr><td colspan="8">Aucun contact</td></tr>';
          }
        ?>
      </tbody>
    </table>
  </div>
</body>
<?php pagefooter_Intranet(); ?>
</html>
