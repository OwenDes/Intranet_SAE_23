<?php
session_start();

include '../Fonction_Intranet.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (connexion($username, $password)) {
        header('Location: ../page/Intranet.php');
        exit;
    } else {
        $error = 'Identifiants incorrects, veuillez réessayer.';
        // header('Location: ../page/connexion2.php');
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>
    <?php require_once('../Fonction_Intranet.php'); header_Intranet(); ?>
</head>

<body>
    <?php navbar_Intranet(); ?>

    <div class="container">
        <h1>Connexion</h1>

        <?php if (isset($error)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
        <?php endif; ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
    </div>

    <?php pagefooter_Intranet(); ?>
</body>

</html>
