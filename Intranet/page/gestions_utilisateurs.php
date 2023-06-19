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
        $user = $_POST['user'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];
        if ($user!=""){
            addUser($user, $password, $role);
        }    
    } else if ($action == 'modify') {
        $user = $_POST['user'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];
        $users = getUsers();
        $users[$user]['mdp'] = $password;
        $users[$user]['role'] = $role;
        file_put_contents('../données/users2.json', json_encode($users));
    } else if ($action == 'delete') {
        $user = $_POST['user'];
        deleteUser($user);
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
                    <td><input type="password" class="form-control" name="password" placeholder="Mot de passe"></td>
                    <td>
                        <select class="form-control" name="role">
                            <option value="user">Utilisateur</option>
                            <option value="admin">Administrateur</option>
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
                    <th scope="col">Mot de passe</th>
                    <th scope="col">Rôle</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $username => $user): ?>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <tr>
                            <td><?php echo $user['user']; ?></td>
                            <td><?php echo $user['lastName']; ?></td>
                            <td><input type="password" class="form-control" name="password" placeholder="Nouveau mot de passe"></td>
                            <td>
                                <select class="form-control" name="role">
                                    <option value="user" <?php if ($user['role'] == 'user') echo 'selected'; ?>>Utilisateur</option>
                                    <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Administrateur</option>
                                </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary" name="action" value="modify">Modifier</button>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-danger" name="action" value="delete" onclick="return confirmation();">Supprimer</button>
                            </td>
                            <input type="hidden" name="username" value="<?php echo $username; ?>">
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
