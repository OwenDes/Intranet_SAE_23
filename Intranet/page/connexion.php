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

<div class="container-fluid">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-4 col-sm-12 p-5 bg-white rounded shadow">
            <h3 class="display-6">Connexion</h3>
            <p>Entrez votre nom d'utilisateur et votre mot de passe</p>
            <?php if (isset($error)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
            <?php endif; ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">            
                <div class="form-group">
                    <label for="username" class="form-label">Utilisateur</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Utilisateur" required>
                </div>
                    <div class="form-group">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
                </div>
                <button type="submit" class="btn mt-3 btn-primary">Se connecter</button>
            </form>
        </div>
    </div>
</div>

    <?php pagefooter_Intranet(); ?>
</body>
</html>
