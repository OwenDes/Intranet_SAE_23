<?php
session_start();

require_once('functions.php');

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    header('Location: page09.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    if ($action == 'add') {
        $user = $_POST['user'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];
        addUser($user, $password, $role);
    } else if ($action == 'modify') {
        $user = $_POST['user'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];
        $users = getUsers();
        $users[$user]['mdp'] = $password;
        $users[$user]['role'] = $role;
        file_put_contents('data/users.json', json_encode($users));
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
                        <td><input type="text" class="form-control" name="user" placeholder="Pseudo"></td>
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
                        <td></td>
                    </tr>
                </form>
            <thead>
                <tr>
                    <th scope="col">Pseudo</th>
                    <th scope="col">Mot de passe</th>
                    <th scope="col">Rôle</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user => $infos): ?>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <tr>
                            <td><?php echo $infos['user']; ?></td>
                            <td><input type="password" class="form-control" name="password" placeholder="Nouveau mot de passe"></td>
                            <td>
                                <select class="form-control" name="role">
                                    <option value="user" <?php if ($infos['role'] == 'user')
                                        echo 'selected'; ?>>Utilisateur</option>
                                    <option value="admin" <?php if ($infos['role'] == 'admin')
                                        echo 'selected'; ?>>Administrateur</option>
                                </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary" name="action" value="modify">Modifier</button>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-danger" name="action" value="delete" onclick="return confirmation();">Supprimer</button>
                            </td>
                            <input type="hidden" name="user" value="<?php echo $user; ?>">
                        </tr>
                    </form>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php pagefooter(); ?>
    <script>
        var confirmation = function() {
            return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');
        }
    </script>

</body>
</html>
