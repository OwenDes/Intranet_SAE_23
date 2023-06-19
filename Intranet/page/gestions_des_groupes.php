<?php

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php header_Intranet(); ?>
</head>

<body>
    <?php navbar_Intranet(); ?>

    <div class="container">
        <h1>Gestion des groupes</h1>

        <table class="table">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <tr>
                    <td><input type="text" class="form-control" name="group" placeholder="Groupe"></td>
                    <td><input type="text" class="form-control" name="phoneNumber" placeholder="Numéro de téléphone"></td>
                    <td>
                        <button type="submit" class="btn btn-success" name="action" value="add">Ajouter</button>
                    </td>
                </tr>
            </form>
            <thead>
                <tr>
                    <th scope="col">Groupe</th>
                    <th scope="col">Numéro de téléphone</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($groups as $group => $phoneNumber): ?>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <tr>
                            <td><?php echo $group; ?></td>
                            <td><?php echo $phoneNumber; ?></td>
                            <td>
                                <button type="submit" class="btn btn-primary" name="action" value="modify">Modifier</button>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-danger" name="action" value="delete" onclick="return confirmation();">Supprimer</button>
                            </td>
                            <input type="hidden" name="group" value="<?php echo $group; ?>">
                        </tr>
                    </form>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php pagefooter_Intranet(); ?>
    <script>
        var confirmation = function() {
            return confirm('Êtes-vous sûr de vouloir supprimer ce groupe ?');
        }
    </script>

    </body>
</html>
