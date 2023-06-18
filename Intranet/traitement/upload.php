<?php
include "../Fonction_Intranet.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["file"])) {
        $targetDir = "../../data/uploads/";
        if ($_POST["depot"] == "perso") {
            $targetDepot = $_SESSION['user'];
        } else {
            $targetDepot = $_POST["depot"];
        }

        $depotDir = $targetDir . $targetDepot;
        if (!is_dir($depotDir)) {
            mkdir($depotDir, 0777, true);
        }

        $fileName = uniqid() . '_' . $_FILES["file"]["name"];
        $targetFilePath = $depotDir . "/" . $fileName;

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            echo "Le fichier a été téléchargé avec succès.";
            header("Location: ../../Intranet/page/gestion_fichiers.php");
        } else {
            echo "Une erreur s'est produite lors du téléchargement du fichier.";
        }
    }
}
?>