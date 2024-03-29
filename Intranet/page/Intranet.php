    <?php
    include '../Fonction_Intranet.php';
    session_start();
    if (!isset($_SESSION['user']) || !isset($_SESSION['role']) || ($_SESSION['role'] != 'user' && $_SESSION['role'] != 'admin')) {
        header('Location: ../page/connexion.php');
        exit();
    }
    if ( $_SESSION['role'] === 'admin'){
        $estAdmin = true;
    } else {
        $estAdmin = false;
    }
    header_Intranet();
    navbar_Intranet();
    ?>
    <div>
        <hr>
        <h3 class="text-center">Actualités</h3><br>
        <div class="container">
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
                    $tab .= "
                    <div class='container d-flex align-items-center flex-column mb-2 col p-3 border border-dark actualite" . $i . "'>
                        <h3>{$actualite['titre']}</h3>
                        <p>{$actualite['contenu']}</p>
                    </div>";
                    $i = $i + 1;
                }
                echo $tab;
                echo '</div>';
            }
            ?>
            <hr>
        </div>
        <div class="container mb-3 mt-5">
            <h1 class="mb-3 text-center">Les différents outils :</h1>
            <div class="row">
                <div class="col">
                    <a href="Annuaire.php">
                        <img class="img-fluid rounded-circle" src="../images/Annuaire.png" alt="Logo">
                    </a>
                </div>
                <div class="col">
                    <a href="partenaires.php">
                        <img class="img-fluid rounded-circle" src="../images/Partenaire.png" alt="Logo">
                    </a>
                </div>
                <div class="col">
                    <a href="depot_fichier.php">
                        <img class="img-fluid rounded-circle" src="../images/test.png" alt="Logo">
                    </a>
                </div>
                <div class="col">
                    <a href="Wiki.php">
                        <img class="img-fluid rounded-circle" src="../images/Wiki.png" alt="Logo">
                    </a>
                </div>
            </div>
        </div>
        <hr>
        <?php if ($estAdmin) { ?>
            <div class="container">
                <h1 class="mt-3 text-center">Les outils de gestion :</h1>
                <div class="row">
                    <div class="col-sm-3">
                        <a href="GestionAnnuaire.php">
                            <img class="img-fluid rounded-circle" src="../images/Gestionnaire_de_l'annuaire.png" alt="Logo">
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <a href="gestions_utilisateurs.php">
                            <img class="img-fluid rounded-circle" src="../images/Gestionnaire_d'utilisateur.png" alt="Logo">
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <a href="gestion_vitrine">
                            <img class="img-fluid rounded-circle" src="../images/Gestion_du_site.png" alt="Logo">
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <a href="gestion_fichiers.php">
                            <img class="img-fluid rounded-circle" src="../images/Gestion_des_fichier.png" alt="Logo">
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <br>
    <br>
    <?php pagefooter_Intranet() ?>
