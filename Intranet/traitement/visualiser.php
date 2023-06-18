<?php
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["fichier"])) {
    $fichier = $_GET["fichier"];
    $depotDir = "../données/fichier_partages/";
    $depotDirperso = "../données/fichier_partages/Personnel/";
    // Vérifier si le fichier existe dans le dossier personnel
    $fichierPersoPath = $depotDirperso . $fichier;
    if (file_exists($fichierPersoPath)) {
        // Afficher le contenu du fichier
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $typeMIME = finfo_file($finfo, $fichierPersoPath);
        finfo_close($finfo);
        echo '<div class="container-fluid external-content">';
        switch ($typeMIME) {
            case 'text/plain':
                // Affichage d'un fichier texte brut
                $contenu = file_get_contents($fichierPersoPath);
                echo '<pre>' . htmlspecialchars($contenu) . '</pre></div>';
                break;

            case 'text/html':
                // Affichage d'un fichier HTML
                echo '<iframe src="' . $fichierPersoPath . '" frameborder="0" class="w-100" height="100%"></iframe></div>';
                break;

            case 'image/jpeg':
            case 'image/jpg':
            case 'image/png':
            case 'image/gif':
                // Affichage d'une image
                echo '<img src="' . $fichierPersoPath . '" alt="Image"></div>';
                break;

            case 'application/pdf':
                // Affichage d'un fichier PDF
                echo '<div class="responsive-embed-container">';
                echo '<embed src="' . $fichierPersoPath . '" type="application/pdf" width="100%"></embed>';
                echo '</div></div>';
                break;

            case 'application/php':
                // Affichage d'un fichier PHP
                echo '<div class="container external-content">' .
                    '<pre><code>' . htmlspecialchars(file_get_contents($fichierPersoPath)) . '</code></pre></div>';
                break;

            case 'application/javascript':
                // Affichage d'un fichier JavaScript
                echo '<div class="container external-content">' .
                    '<pre><code>' . htmlspecialchars(file_get_contents($fichierPersoPath)) . '</code></pre></div>';
                break;

            case 'application/json':
                // Affichage d'un fichier JSON
                echo '<div class="container external-content">' .
                    '<pre><code>' . htmlspecialchars(file_get_contents($fichierPersoPath)) . '</code></pre></div>';
                break;

            // Ajoutez des cas supplémentaires pour d'autres types de fichiers

            default:
                echo '<div class="text-center">Type de fichier non pris en charge.</div></div>';
                break;
        }
    } else {
        // Afficher une erreur si le fichier n'existe pas
        echo '<div class="text-center">Le fichier n\'existe pas.</div></div>';
    }
}
?>
