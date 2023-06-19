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

header_Intranet() ; navbar_Intranet() ?>



<?php
$donnees_json = file_get_contents("../données/actualites.json");
$actualites = json_decode($donnees_json, true);

if ($actualites === null) {
    echo "Erreur : impossible de décoder le fichier JSON.";
} else {
    echo '<div class="row text-white">';
    $tab = '';
    $i = 1;
    foreach ($actualites as $id => $actualite) {
        $tab .= "<div class='container mb-2 col p-3 border border-dark actualite" . $i . " '>
                    <h3 class='text-center'>{$actualite['titre']}</h3>
                    <p>{$actualite['contenu']}</p> 
                </div>";
        $i = $i + 1;
    }
    echo $tab;
    echo '</div>';
}
?>

<section class="bg-light py-5">
  <div class="container p-4">
    <form action="../traitement/modif_formulaire_traitement.php" method="post">
      <input type="hidden" name="action" value="modifier">
      <div class="row">
        <?php foreach ($actualites as $id => $actualite): ?>
          <input type="hidden" name="ids[]" value="<?= $id ?>">
          <div class="col-md-6">
            <div class="mb-3">
              <label for="titres[]" class="form-label">Titre :</label>
              <input type="text" name="titres[]" class="form-control" value="<?= $actualite['titre'] ?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="contenus[]" class="form-label">Contenu :</label>
              <textarea name="contenus[]" class="form-control"><?= $actualite['contenu'] ?></textarea>
            </div>
          </div>
          <hr>
        <?php endforeach ?>
      </div>
      <div class="container d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">Modifier</button>
      </div>
    </form>
  </div>
</section>



<?php pagefooter_Intranet() ;?>