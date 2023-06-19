<?php include '../fonction.php'; head() ; pageheader_2() ?>
    
        <!--Contenus-->    
          <div id="demo" class="carousel slide" data-bs-ride="carousel">
            <!--Indicators/dots-->
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
              <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
            </div>
            <!--carousel-->
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="images-fluid" src="../images/diapo/1.jpeg">
              </div>
            </div>
          </div>
          <div class="container-fluid bg-dark p-2 text-center text-white">
            <p>Le Service National d'Incendie et de Secours du Listenbourg est une organisation dédiée à la protection des citoyens et à la prévention des incendies et des situations d'urgence. 
              Nous sommes fiers de fournir une réponse rapide et efficace aux situations d'urgence, ainsi que des programmes de prévention pour aider les résidents du Listenbourg à rester en sécurité. 
              Notre personnel est hautement qualifié et formé pour faire face à une variété de situations, des incendies de bâtiments aux accidents de la route et aux inondations. 
              Nous sommes dévoués à notre mission de protéger les personnes et les biens dans notre communauté et nous travaillons en étroite collaboration avec d'autres agences de secours pour fournir une réponse coordonnée en cas d'urgence.</p>
          </div>
            <div class="container-body">
              <div class="container-fluid p-2 text-center bg-info text-white rounded-bottom">
                <div class="row">
                  <div class="col container">
                    <span class="num" data-val="10000">000</span>
                    <br>
                    <span class="text">interventions en 2022</span>
                  </div>
                  <div class="col container">
	                <span class="num" data-val="2000">000</span>
                    <br>
                    <span class="text">sapeurs-pompiers professionnels</span>
                  </div>
                  <div class="col container">
                    <span class="num" data-val="420">000</span>
                    <br>
                    <span class="text">jeunes sapeurs-pompiers formés</span>
                  </div>
                  <div class="col container">
                    <span class="num" data-val="320">000</span>
                    <br>
                    <span class="text">chats récupérés dans des arbres</span>
                  </div>
                  <script src="../js/num1.js"></script>
                </div>
              </div>
              <div style="padding-top: 400px;">
                <div class="container-fluid text-center text-white bg-info rounded-top">
                  <h2>Actualités</h2>
                </div>
              </div>
            </div>
          </div>
          <?php
$donnees_json = file_get_contents("../../Intranet/données/actualites.json");
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

<?php pagefooter() ;?>