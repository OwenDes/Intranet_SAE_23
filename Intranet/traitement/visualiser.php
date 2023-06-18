<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["fichier"])) {
    $fichier = $_GET["fichier"];
    $depotDir = "../../data/uploads/";
    $perso = $_SESSION["username"];
    $depotDirperso = $depotDir . $perso . "/";
    $roles = $_SESSION["roles"];

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
                echo '<iframe src="<?php echo $fichierPersoPath; ?>" frameborder="0" class="w-100" height="100%"></iframe></div>';
                break;
        
            case 'image/jpeg':
            case 'image/png':
            case 'image/gif':
                // Affichage d'une image
                echo '<img src="' . $fichierPersoPath . '" alt="Image">
                </div>';
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
        // Vérifier si le fichier existe dans les dossiers des rôles
        foreach ($roles as $role) {
            $depotDirRole = $depotDir . $role . "/";
            $fichierRolePath = $depotDirRole . $fichier;
            if (file_exists($fichierRolePath)) {
                // Afficher le contenu du fichier
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $typeMIME = finfo_file($finfo, $fichierRolePath);
                finfo_close($finfo);
                echo '<div class="container external-content">';
                switch ($typeMIME) {
                    case 'text/plain':
                        // Affichage d'un fichier texte brut
                        $contenu = file_get_contents($fichierRolePath);
                        echo '<pre>' . htmlspecialchars($contenu) . '</pre></div>';
                        break;
                
                    case 'text/html':
                        // Affichage d'un fichier HTML
                        echo '<iframe src="' . $fichierRolePath . '" frameborder="0" class="w-100" height="100%"></iframe></div>';
                        break;
                
                    case 'image/jpeg':
                    case 'image/png':
                    case 'image/gif':
                        // Affichage d'une image
                        echo '<img src="' . $fichierRolePath . '" alt="Image"></div>';
                        break;
                
                    case 'application/pdf':
                        // Affichage d'un fichier PDF
                        echo '<div class="responsive-embed-container">';
                        echo '<embed src="' . $fichierRolePath . '" type="application/pdf" width="100%"></embed>';
                        echo '</div></div>';
                        break;

                    case 'application/php':
                        // Affichage d'un fichier PHP
                        echo '<div class="container external-content">' .
                            '<pre><code>' . htmlspecialchars(file_get_contents($fichierRolePath)) . '</code></pre></div>';
                        break;
            
                    case 'application/javascript':
                        // Affichage d'un fichier JavaScript
                        echo '<div class="container external-content">' .
                             '<pre><code>' . htmlspecialchars(file_get_contents($fichierRolePath)) . '</code></pre></div>';
                        break;
            
                    case 'application/json':
                        // Affichage d'un fichier JSON
                        echo '<div class="container external-content">' .
                             '<pre><code>' . htmlspecialchars(file_get_contents($fichierRolePath)) . '</code></pre></div>';
                        break;
                
                    default:
                        echo '<div class="text-center">Type de fichier non pris en charge.</div></div>';
                        break;
                }
                break;
            }
        }
    }
}
?>