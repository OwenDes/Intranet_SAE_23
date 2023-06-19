<?php
session_start();
if (!isset($_SESSION['user']) || !isset($_SESSION['role']) || ($_SESSION['role'] != 'user' && $_SESSION['role'] != 'admin')) {
    header('Location: ../page/connexion.php');
    exit();
}
if (!isset($_SESSION['user']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ../page/Intranet.php');
    exit();
}

require_once('../Fonction_Intranet.php');

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
     header('Location: ../page/connexion.php');
     exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    if ($action == 'add') {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $phoneNumber = $_POST['phoneNumber'];
        $group = $_POST['group'];
        if ($firstName!="" && $lastName!=""){
            addUser($firstName, $lastName, $phoneNumber, $group);
        }    
    } else if ($action == 'modify') {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $phoneNumber = $_POST['phoneNumber'];
        $group = $_POST['group'];
        modifyUser($firstName, $lastName, $phoneNumber, $group);
    } else if ($action == 'delete') {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        deleteUser($firstName, $lastName);
    }
}

$users = getUsers();

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $users = findUsers($search);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php header_Intranet(); ?>
</head>

<body>
    <?php navbar_Intranet(); ?>

    <div class="container">
        <h1>Gestion des utilisateurs</h1>

        <form method="get" action="">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Rechercher un utilisateur" name="search">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Rechercher</button>
            </div>
        </form>

        <table class="table">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <tr>
                    <td><input type="text" class="form-control" name="firstName" placeholder="Prénom"></td>
                    <td><input type="text" class="form-control" name="lastName" placeholder="Nom"></td>
                    <td><input type="text" class="form-control" name="phoneNumber" placeholder="Numéro de téléphone"></td>
                    <td>
                        <select class="form-control" name="group">
                            <option value="ssi">SSI</option>
                            <option value="officier">Officier</option>
                            <option value="sous-officier">Sous-officier</option>
                            <option value="homme-du-rang">Homme du rang</option>
                        </select>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-success" name="action" value="add">Ajouter</button>
                    </td>
                </tr>
            </form>
            <thead>
                <tr>
                    <th scope="col">Prénom</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Numéro de téléphone</th>
                    <th scope="col">Groupe</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <tr>
                            <td><?php echo $user['firstName']; ?></td>
                            <td><?php echo $user['lastName']; ?></td>
                            <td><?php echo $user['phoneNumber']; ?></td>
                            <td>
                                <select class="form-control" name="group">
                                    <option value="ssi" <?php if ($user['group'] == 'ssi') echo 'selected'; ?>>SSI</option>
                                    <option value="officier" <?php if ($user['group'] == 'officier') echo 'selected'; ?>>Officier</option>
                                    <option value="sous-officier" <?php if ($user['group'] == 'sous-officier') echo 'selected'; ?>>Sous-officier</option>
                                    <option value="homme-du-rang" <?php if ($user['group'] == 'homme-du-rang') echo 'selected'; ?>>Homme du rang</option>
                                </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary" name="action" value="modify">Modifier</button>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-danger" name="action" value="delete" onclick="return confirmation();">Supprimer</button>
                            </td>
                        </tr>
                    </form>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php pagefooter_Intranet(); ?>
    <script>
        var confirmation = function() {
            return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');
        }
    </script>




</body>
</html>
