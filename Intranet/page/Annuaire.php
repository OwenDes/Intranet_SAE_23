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
    <h1>Annuaire</h1>

    <form method="GET" action="#">
        <div class="form-group">
            <label for="search">Rechercher par numéro de téléphone, nom ou adresse e-mail :</label>
            <input type="text" class="form-control" id="search" name="search">
        </div>
        <button type="submit" class="btn btn-primary my-2">Rechercher</button>
    </form>

    <?php
    // Fonction de recherche dans l'annuaire
    function rechercherContact($contacts, $critere, $valeur)
    {
        $resultats = array();

        foreach ($contacts as $contact) {
            // Vérifier si le critère de recherche correspond à la valeur
            if (
                isset($contact[$critere]) && // Vérifier si le critère existe dans le contact
                stripos($contact[$critere], $valeur) !== false // Effectuer une recherche insensible à la casse
            ) {
                $resultats[] = $contact;
            }
        }

        return $resultats;
    }

    // Lire le contenu du fichier JSON
    $jsonContent = file_get_contents('../données/users2.json');
    $contacts = json_decode($jsonContent, true);

    // Vérifier si une recherche a été effectuée
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        // Exécuter la recherche par numéro de téléphone, nom ou adresse e-mail
        $resultats = rechercherContact($contacts, 'phoneNumber', $search);
        $resultats = array_merge($resultats, rechercherContact($contacts, 'lastName', $search));
        $resultats = array_merge($resultats, rechercherContact($contacts, 'email', $search));

        // Supprimer les doublons des résultats
        $resultats = array_unique($resultats, SORT_REGULAR);

        // Afficher les résultats de la recherche
        echo '<h2>Résultats de la recherche pour : ' . $search . '</h2>';

        if (count($resultats) > 0) {
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Photo</th>';
            echo '<th>Nom</th>';
            echo '<th>Prénom</th>';
            echo '<th>Numéro de Téléphone</th>';
            echo '<th>Adresse mail</th>';
            echo '<th>Service</th>';
            echo '<th>Fonction</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($resultats as $id => $contact) {
                echo '<tr>';
                echo '<td><a href="#" data-bs-toggle="modal" data-bs-target="#contactModal-' . $id . '"><img src="' . $contact['photo'] . '" width="50"></a></td>';
                echo '<td>' . $contact['lastName'] . '</td>';
                echo '<td>' . $contact['user'] . '</td>';
                echo '<td>' . $contact['phoneNumber'] . '</td>';
                echo '<td>' . $contact['email'] . '</td>';
                echo '<td>' . $contact['grp'] . '</td>';
                echo '<td>' . $contact['matricule'] . '</td>';
                echo '</tr>';

                // Afficher le modal pour chaque contact
                echo '<div class="modal fade" id="contactModal-' . $id . '" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel-' . $id . '" aria-hidden="true">';
                echo '<div class="modal-dialog" role="document">';
                echo '<div class="modal-content">';
                echo '<div class="modal-header">';
                echo '<h5 class="modal-title" id="contactModalLabel-' . $id . '">' . $contact['lastName'] . ' ' . $contact['user'] . '</h5>';
                echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                echo '</div>';
                echo '<div class="modal-body">';
                echo '<img src="' . $contact['photo'] . '" width="100">';
                echo '<p>Service: ' . $contact['grp'] . '</p>';
                echo '<p>Fonction: ' . $contact['matricule'] . '</p>';
                echo '<p>Numéro de téléphone: ' . $contact['phoneNumber'] . '</p>';
                echo '<p>Adresse mail: ' . $contact['email'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>Aucun résultat trouvé.</p>';
        }
    } else {
        // Afficher la liste complète des contacts
        echo '<h2>Liste complète des contacts</h2>';

        if (count($contacts) > 0) {
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Photo</th>';
            echo '<th>Nom</th>';
            echo '<th>Prénom</th>';
            echo '<th>Numéro de Téléphone</th>';
            echo '<th>Adresse mail</th>';
            echo '<th>Groupe de travail</th>';
            echo '<th>Matricule</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($contacts as $id => $contact) {
                echo '<tr>';
                echo '<td><a href="#" data-bs-toggle="modal" data-bs-target="#contactModal-' . $id . '"><img src="' . $contact['photo'] . '" width="50"></a></td>';
                echo '<td>' . $contact['lastName'] . '</td>';
                echo '<td>' . $contact['user'] . '</td>';
                echo '<td>' . $contact['phoneNumber'] . '</td>';
                echo '<td>' . $contact['email'] . '</td>';
                echo '<td>' . $contact["grp"] . '</td>';
                echo '<td>' . $contact['matricule'] . '</td>';
                echo '</tr>';

                // Afficher le modal pour chaque contact
                echo '<div class="modal fade" id="contactModal-' . $id . '" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel-' . $id . '" aria-hidden="true">';
                echo '<div class="modal-dialog" role="document">';
                echo '<div class="modal-content">';
                echo '<div class="modal-header">';
                echo '<h5 class="modal-title" id="contactModalLabel-' . $id . '">' . $contact['lastName'] . ' ' . $contact['user'] . '</h5>';
                echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                echo '</div>';
                echo '<div class="modal-body">';
                echo '<img src="' . $contact['photo'] . '" width="100">';
                echo '<p>Service: ' . $contact['grp'] . '</p>';
                echo '<p>Fonction: ' . $contact['matricule'] . '</p>';
                echo '<p>Numéro de téléphone: ' . $contact['phoneNumber'] . '</p>';
                echo '<p>Adresse mail: ' . $contact['email'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>Aucun contact trouvé.</p>';
        }
    }
    ?>
  </div>
</div>