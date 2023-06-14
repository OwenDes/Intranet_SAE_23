<!DOCTYPE html>
<head>
  <?php include '../Fonction_Intranet.php'; header_Intranet(); ?>
  <title>Annuaire</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<h1>Partage de fichier</h1>
<form method="post" action="" enctype="multipart/form-data">
  <input type="file" name="fichier">
  <input type="submit" name="submit" value="Envoyer">
</form>
<?php
$message="";
if(isset($_POST))
{
    $message="Nom du fichier".$_FILES['fichier']['name']."<br>";
}
echo $message;
?>
</body>
</html>
