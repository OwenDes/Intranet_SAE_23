<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["fichier"])) {
    $fichier = $_GET["fichier"];
    $depotDir = "../../data/uploads/";
    $perso = $_SESSION["username"];
    $depotDirperso = $depotDir . $perso . "/";
    $roles = $_SESSION["roles"];

    // Vérifier si le fichier existe dans le dossier personnel
    $fichierPersoPath = $depotDirperso . $fichier;
    if (file_exists($fichierPersoPath)) {
        // Supprimer le fichier
        unlink($fichierPersoPath);
        header("Location: ../../Intranet/gestion_fichier.php");
    } else {
        // Vérifier si le fichier existe dans les dossiers des rôles
        foreach ($roles as $role) {
            $depotDirRole = $depotDir . $role . "/";
            $fichierRolePath = $depotDirRole . $fichier;
            if (file_exists($fichierRolePath)) {
                // Supprimer le fichier
                unlink($fichierRolePath);
                header("Location: ../../Intranet/gestion_fichier.php");
                break;
            }
        }
    }
}
?>