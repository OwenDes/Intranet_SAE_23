<?php

function header_Intranet() {
    echo'<!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
        <script src="https://kit.fontawesome.com/95567607c9.js" crossorigin="anonymous"></script>
        <link rel="icon" href="../images/logo.png">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css.css">
        <title>SNIS du Listenbourg</title>
    </head>';

    echo '
    <body class="bg-light">
        <div class="col main-content text-center">
            <div class="horizontal p-2 mt-3 shadow-sm bg-white container-fluid">
                <a href="../page/Intranet.php"><img class="img-fluid rounded-circle" src="../images/logo.png" alt="Logo" width="100" height="100"></a>
            </div>
        </div>';
}    

function navbar_Intranet(){
        // Charger le contenu du fichier JSON
        $jsonData = file_get_contents('../données/users2.json');

        // Convertir le contenu JSON en tableau associatif
        $users = json_decode($jsonData, true);
        
        // Supposons que l'utilisateur actuellement connecté soit stocké dans une variable de session appelée 'user'
        $user = $_SESSION['user'];
        
        // Rechercher l'utilisateur connecté dans le tableau des utilisateurs
        if (isset($users[$user])) {
          $loggedInUser = $users[$user];
        
          // Extraire les informations de l'utilisateur connecté
          $email = $loggedInUser['email'];
          $matricule = $loggedInUser['matricule'];
          $role = $loggedInUser['role'];
          $phoneNumber = $loggedInUser['phoneNumber'];
          $lastName = $loggedInUser['lastName'];


          echo '<div class="container-fluid">
          <div class="row">
              <div class="offcanvas offcanvas-start" id="demo">
                  <div class="offcanvas-header">
                      <i class="fa-sharp fa-solid fa-user fa-2xl img-fluid"></i>
                      <div class="text-center">';
                      echo "<p>Nom: $lastName</p><br><p>Prénom: $user</p>";
                      echo '</div>
                          <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                      </div>
                      <div class="offcanvas-body">
                          <div>';
                              echo'<p><i class="fa-sharp fa-solid fa-users"></i>'; echo" Rôle: $role</p>";
                              echo'<p><i class="fa-solid fa-phone"></i>'; echo" Numéro: $phoneNumber</p>";
                              echo'<p><i class="fa-sharp fa-solid fa-address-card"></i>';echo" Matricule: $matricule</p>";
                              echo'<p><i class="fa-sharp fa-solid fa-envelope"></i>'; echo" Email: $email</p>";
                              echo'<ul class="nav flex-column text-center mt-4">
                                  <li class="nav-item border">
                                      <a class="nav-link text-dark" href="Intranet.php">Accueil</a>
                                  </li>
                                  <li class="nav-item border">
                                      <a class="nav-link text-dark" href="../traitement/deconnexion_traitement">Déconnexion</a>
                                  </li>
                                  <li class="nav-item border">
                                      <a class="nav-link text-dark" href="parametre.php">Paramètres</a>
                                  </li>
                              </ul>
                          </div>
                          <div>
                              <div class="container-fluid">
                                  <div class="container text-center">
                                      <a href="Intranet.php"><img class="img-fluid rounded-circle my-2" src="../images/logo.png" alt="Logo" width="100" height="100"></a>
                                      <p>Suivez-nous sur les réseaux sociaux :</p>
                                      <h3><i class="fa-brands fa-facebook" style="margin-right: 10px;"></i><a class="text-black" href="https://www.instagram.com/pompiers.du.listenbourg/"><i class="fa-brands fa-instagram" style="margin-right: 10px;"></a></i><a class="text-black" href="https://twitter.com/PompiersLB"><i class="fa-brands fa-twitter" style="margin-right: 10px;"></i></a><i class="fa-brands fa-linkedin" style="margin-right: 10px;"></i></h3>
                                  </div>
                              </div>
                          </div>
                      </div>
                      </div>
                      </div>
                      <button class="toggle-button btn btn-primary position-fixed top-0 start-0 mt-2 ms-2 border" data-bs-toggle="offcanvas" data-bs-target="#demo" style="background-color: transparent;">
                          <i class="fas fa-user fa-2x text-dark"></i>
                      </button>';
                      
}}
function pagefooter_Intranet() {
    echo '<footer>
        <div class="container-fluid bg-white p-3 ">
          <div class="row">
            <div class=" text-center">
              <h4"><i class="fa-solid fa-phone" style="color: #00000;"></i> 02 01 03 04 05 09</h4>
              <br>
              <br>
              <p>© 2023 NDIS | Tous droits réservés | <a href="mention_legale.php">Mention légales</a> | <a href="mailto:contact.email@snis.fr">Nous contacter</a></p>
            </div>
            <div class="col">
              <div class="container">
                <a href="Intranet.php">
                  <img class="images-fluid rounded-circle float-end" style="max-height: 100px;" src="../images/logo.png">
                </a>
              </div>
            </div>
          </div>
        </div>
        </footer>
  </body>
</html>';
}
function connexion($usr, $mdp) {
    $users = getUsers();

    foreach ($users as $user) {
        if ($user['user'] === $usr) {
            if (password_verify($mdp, $user['mdp'])) {
                $_SESSION['user'] = $user['user'];
                $_SESSION['role'] = $user['role'];
                return true;
            }
        }
    }

    return false;
}


function deconnexion(){
    session_unset();
    session_destroy();
}

function getUsers(){
    $users = file_get_contents('../données/users2.json');
    return json_decode($users, true);
}

function addUser($usr, $mdp, $role = "user"){
    $users = getUsers();

    $users[$usr] = array(
        'user' => $usr,
        'mdp' => password_hash($mdp, PASSWORD_DEFAULT),
        'role' => $role
    );

    file_put_contents('../données/users2.json', json_encode($users));
}

function deleteUser($usr){
    $users = getUsers();

    if (isset($users[$usr])) {
        unset($users[$usr]);
        file_put_contents('../données/users2.json', json_encode($users));
        return true;
    } else {
        return false;
    }
}
function findUsers($texte){
    $users = getUsers();
    $resultats = array();

    foreach ($users as $username => $user) {
        if (stripos($username, $texte) !== false) {
            $resultats[$username] = $user;
        }
    }

    return $resultats;
}






function updateUserPassword($username, $newPassword)
{
    $users = getUsers();
    if (isset($users[$username])) {
        $users[$username]['mdp'] = password_hash($newPassword, PASSWORD_DEFAULT);
        file_put_contents('../données/users2.json', json_encode($users));
        return true;
    }
    return false;
}

?>

