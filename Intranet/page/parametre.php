<?php
include '../Fonction_Intranet.php';
session_start();
if (!isset($_SESSION['user']) || !isset($_SESSION['role']) || ($_SESSION['role'] != 'user' && $_SESSION['role'] != 'admin')) {
    header('Location: ../page/connexion.php');
    exit();
}


// Récupérer la liste des utilisateurs
$users = getUsers();

// Vérifier si une requête POST a été soumise pour modifier le mot de passe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == 'modify') {
        $user = $_SESSION['user'];
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];

        // Vérifier que les mots de passe correspondent
        if ($newPassword === $confirmPassword) {
            // Modifier le mot de passe de l'utilisateur
            if (updateUserPassword($user, $newPassword)) {
                echo "Mot de passe modifié avec succès.";
                header('Location: Intranet.php');
            } else {
                $error = "Une erreur s'est produite lors de la modification du mot de passe.";
            }
        } else {
            $error = "Les mots de passe ne correspondent pas.";
        }
    }
}
header_Intranet();
navbar_Intranet();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changer le mot de passe</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Changer le mot de passe</h1>
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
            <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="new_password" class="form-label">Nouveau mot de passe :</label>
                <input type="password" name="new_password" id="new_password" class="form-control">
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirmez le mot de passe :</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control">
            </div>
            <button type="submit" name="action" value="modify" class="btn btn-primary">Valider</button>
        </form>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>


