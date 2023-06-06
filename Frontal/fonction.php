<?php

function head() {
    echo '<!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <title>Service National d’Incendie et de Secours du Listenbourg</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
                <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
                <script src="https://kit.fontawesome.com/95567607c9.js" crossorigin="anonymous"></script>
                <link rel="icon" href="../images/logo.png">
                <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
                <link rel="stylesheet" type="text/css" href="../css.css">
            </head>';
}


function pageheader_1() {
  echo '
  <body>
      <header>
          <div class="row">
              <div class="col">
                  <div class="container mt-1">
                      <a href="../page/page0.php">
                          <img class="img-fluid rounded-circle" style="max-height: 100px;" src="../images/logo.png">
                      </a>
                  </div>
              </div>
              <div class="col-xl-9">
                  <div class="container-fluid my-3 text-white">
                      <h2>Service National d’Incendie et de Secours du Listenbourg</h2>
                  </div>
              </div>
              
          </div>
              <div class="row">
                  <div class="col">
                  <h2><a href="../page/page0.php" style="text-decoration: none; color: white;"><i class="fa-solid fa-house" style="color: #fcfcfc; margin-left: 10px;"></i></a></h2>
                  </div>
                  <div class="col">
                      <div class="container rounded text-end">';
                      session_start();
                      if(isset($_SESSION['nom'])){
                         echo '<button type="button" class="btn"><a href="../../Intranet/traitement/deconnexion_traitement.php" class="text-white text-decoration-none">Déconnexion <i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i></a></button>
                         <br>
                         <button type="button" class="btn"><a href="../../Intranet/page/gestion.php" class="text-white text-decoration-none">Gestion</a></button>';
                      }
                      else{ 
                         echo '<button type="button" class="btn"><a href="../../../Intranet/page/connexion.php" class="text-white text-decoration-none"><i class="fa-solid fa-user" style="color: #ffffff;"></i> Connexion</a></button>';
                      }
                      echo '
                      </div>
                  </div>
              </div>
      </header>';
}

function pageheader_2() {
  session_start();
  echo '
  <body>
  <header>
      <div class="row">
        <div class="col">
          <div class="container my-1">
            <a href="../page/page0.php">
              <img class="img-fluid rounded-circle" style="max-height: 100px;" src="../images/logo.png">
            </a>
          </div>
        </div>
        <div class="col-xl-9">
          <div class="container-fluid my-3 text-white">
              <h2>Service National d’Incendie et de Secours du Listenbourg</h2>
          </div>
        </div>          
        </div>
          <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand text-white" href="../page/page0.php"><i class="fa-solid fa-house" style="color: #fcfcfc;"></i></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Devenir sapeur pompier</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="sapeur_pompier_volontaire.php">Le sapeur pompier volontaire</a></li>
                            <li><a class="dropdown-item" href="la_formation.php">La formation</a></li>
                            <li><a class="dropdown-item" href="devenir_profesionnels.php">Devenir professionnels</a></li>
                        </ul>
                        </li>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Nos activités</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="Organisation_sur_le_territoire.php">Organisation sur le territoire</a></li>
                            <li><a class="dropdown-item" href="interventions.php">Nos interventions</a></li>
                            <li><a class="dropdown-item" href="Préventions_et_révisions.php">Préventions et révisions</a></li>
                            <li><a class="dropdown-item" href="partenaire.php">Partenaire</a></li>
                            <li><a class="dropdown-item" href="notre_histoire.php">Notre histoire</a></li>
                        </ul>
                        </li>
                    </ul>
                    </div>
                </div>
                    <div class="container nav-item dropdown">
                        <div class="container text-end">';
                                    
                  if(isset($_SESSION['nom'])){
                     echo '
                     <button type="button" class="btn"><a href="../../Intranet/page/Intranet.php" class="text-white text-decoration-none">Retour vers l\'intranet</a></button>';
                  }
                  else{ 
                     echo '<button type="button" class="btn"><a href="../../Intranet/page/connexion.php" class="text-white text-decoration-none"><i class="fa-solid fa-user" style="color: #ffffff;"></i> Connexion</a></button>';
                  }
                        echo' </div>
                    </div>
                </div>
            </div>
          </nav>
          
      <script src="../js/dropdowns.js"></script>


    </header>';
}

function pagefooter() {
      echo '<footer>
          <div class="container-fluid text-white p-3 ">
            <div class="row">
              <div class="col-6">
                <h4"><i class="fa-solid fa-phone" style="color: #ffffff;"></i> 02 01 03 04 05 09</h4>
                <br>
                <br>
                <p>© 2023 NDIS | Tous droits réservés | <a class="text-white" href="../Frontal/page/mention_legale.php">Mention légales</a> | <a class="text-white" href="mailto:contact.email@snis.fr">Nous contacter</a></p>
              </div>
              <div class="col-3 ">
                <div class="container text-center">
                  <p>Suivez-nous sur les réseaux sociaux</p>
                      <h3><i class="fa-brands fa-facebook" style="margin-right: 10px; margin-right: 10px";></i><a class="text-white"  href="https://www.instagram.com/pompiers.du.listenbourg/"><i class="fa-brands fa-instagram" style="margin-right: 10px; margin-right: 10px";></a></i><a class="text-white"  href="https://twitter.com/PompiersLB"><i class="fa-brands fa-twitter" style="margin-right: 10px; margin-right: 10px";></i></a><i class="fa-brands fa-linkedin" style="color: #ffffff; margin-right: 10px";></i></h3>
                </div>
              </div>
              <div class="col">
                <div class="container mt-1 me-4">
                  <a href="../page/page0.php">
                    <img class="img-fluid rounded-circle float-end" style="max-height: 100px;" src="../images/logo.png">
                  </a>
                </div>
              </div>
            </div>
          </div>
          </footer>
    </body>
</html>';
}
?>
<a href="../Intranet/page/connexion.php"></a>