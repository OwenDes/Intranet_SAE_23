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
    echo'<div class="container-fluid">
    <div class="row">
        <div class="offcanvas offcanvas-start" id="demo">
            <div class="offcanvas-header">
                <i class="fa-sharp fa-solid fa-user fa-2xl img-fluid"></i>
                <div class="text-center">
                    <p>Nom:</p><br><p>Prenom:</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <div>
                    <p><i class="fa-sharp fa-solid fa-users"></i> Rôle:</p>
                    <p><i class="fa-solid fa-phone" style="color: #000000;"></i> Numéro</p>
                    <p><i class="fa-sharp fa-solid fa-address-card"></i> Matricule</p>
                    <p><i class="fa-sharp fa-solid fa-envelope"></i> Email:</p>
                    <ul class="nav flex-column text-center mt-4">
                        <li class="nav-item border">
                            <a class="nav-link text-dark" href="Intranet.php">Accueil</a>
                        </li>
                        <li class="nav-item border">
                            <a class="nav-link text-dark" href="../traitement/deconnexion_traitement">Déconnexion</a>
                        </li>
                        <li class="nav-item border">
                            <a class="nav-link text-dark" href="#">Paramètres</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <div class="container-fluid">
                        <div class="container text-center">
                            <a href="Intranet.php"><img class="img-fluid rounded-circle my-2"src="../images/logo.png" alt="Logo" width="100" height="100"></a>
                            <p>Suivez-nous sur les réseaux sociaux :</p>
                            <h3><i class="fa-brands fa-facebook" style="margin-right: 10px; margin-right: 10px";></i><a class="text-black" href="https://www.instagram.com/pompiers.du.listenbourg/"><i class="fa-brands fa-instagram" style="margin-right: 10px; margin-right: 10px";></a></i><a class="text-black"  href="https://twitter.com/PompiersLB"><i class="fa-brands fa-twitter" style="margin-right: 10px; margin-right: 10px";></i></a><i class="fa-brands fa-linkedin" margin-right: 10px";></i></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="toggle-button btn btn-primary position-fixed top-0 start-0 mt-2 ms-2 border" data-bs-toggle="offcanvas" data-bs-target="#demo" style="background-color: transparent;">
    <i class="fas fa-user fa-2x text-dark"></i>
    </button>';
}
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

    foreach ($users as $user) {
        if (stripos($user['user'], $texte) !== false) {
            $resultats[] = $user;
        }
    }

    return $resultats;
}

?>