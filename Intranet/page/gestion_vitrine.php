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
            <h1><a href="lecture_formulaire.php"><i class="fa-sharp fa-solid fa-rectangle-list fa-2xl" style="color: #000000;"></i></a></h1>
            <p>Lecture du formulaire de  la page Pompier volontaire</p>
        </div>
        <div class="col text-center">
            <h1><a href="modif_formulaire.php"><i class="fa-solid fa-newspaper fa-2xl" style="color: #000000;"></i></a></h1>
            <p>Modification des actulaitées</p>
        </div>
        <div class="col text-center">
            <h1><a href="Gestion_Partenaire.php"><i class="fa-solid fa-handshake" style="color: #000000;"></i></a></h1>
            <p>Modification des partenaires</p>
        </div>
    </div>
</div>




<?php pagefooter_Intranet() ;?>