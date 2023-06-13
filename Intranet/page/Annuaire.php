<!DOCTYPE html>
<head>
  <?php include '../Fonction_Intranet.php'; header_Intranet(); ?>
  <title>Annuaire</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <h1>Annuaire</h1>
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
        </tr>
      </thead>
      <tbody>
        <?php
          // Lire le contenu du fichier JSON
          $json_data = file_get_contents('../données/contacts.json');
          $contacts = json_decode($json_data, true)['contacts'];

          // Afficher chaque contact dans une ligne du tableau
          foreach ($contacts as $id => $contact) {
            echo '<tr>';
            echo '<td><a href="#" data-toggle="modal" data-target="#contactModal-' . $id . '"><img src="' . $contact['photo'] . '" width="50"></a></td>';
            echo '<td>' . $contact['nom'] . '</td>';
            echo '<td>' . $contact['prenom'] . '</td>';
            echo '<td>' . $contact['numero'] . '</td>';
            echo '<td>' . $contact['mail'] . '</td>';
            echo '<td>' . $contact['service'] . '</td>';
            echo '<td>' . $contact['fonction'] . '</td>';
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
            echo '<p>Numéro de téléphone: ' . $contact['numero'] . '</p>';
            echo '<p>Adresse mail: ' . $contact['mail'] . '</p>';
          }
          if (count($contacts) == 0) {
            echo '<tr><td colspan="5">Aucun contact</td></tr>';
          }
        ?>
      </tbody>
    </table>
  </div>
</body>
<?php pagefooter_Intranet() ;?>
</html>
