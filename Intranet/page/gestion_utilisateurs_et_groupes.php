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

header_Intranet() ; navbar_Intranet();



?>

<div class="container m-5">
    <div class="row justify-content-center align-items-center bg-light">
        <div class="col text-center">
            <h1><a href="gestions_utilisateurs.php"><i class="fa-solid fa-user" style="color: #000000;"></i></a></h1>
            <p>Gestion des utilisateurs</p>
        </div>
        <div class="col text-center">
            <h1><a href="gestions_des_groupes.php"><i class="fa-sharp fa-solid fa-users" style="color: #000000;"></i></a></h1>
            <p>Gestion des groupes</p>
        </div>
    </div>
</div>




<?php pagefooter_Intranet() ;?>