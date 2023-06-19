<?php
session_start();

include '../Fonction_Intranet.php';

$email = '';
$password = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (connexion($email, $password)) {
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

<div class="container-fluid">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-4 col-sm-12 p-5 bg-white rounded shadow">
            <h3 class="display-6">Connexion</h3>
            <p>Entrez votre adresse email et votre mot de passe</p>
            <?php if (isset($error)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
            <?php endif; ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">            
                <div class="form-group">
                    <label for="email" class="form-label">Adresse email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required>
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
