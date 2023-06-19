<?php
require_once '../dompdf/autoload.inc.php';
include '../Fonction_Intranet.php'; 

session_start();
if (!isset($_SESSION['user']) || !isset($_SESSION['role']) || ($_SESSION['role'] != 'user' && $_SESSION['role'] != 'admin')) {
    header('Location: ../page/connexion.php');
    exit();
}
if (!isset($_SESSION['user']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ../page/Intranet.php');
    exit();
}
header_Intranet(); navbar_Intranet();


$jsonString = file_get_contents('../données/formulaire.json');
$data = json_decode($jsonString, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $index = $_POST['delete'];
    if (array_key_exists($index, $data)) {
        unset($data[$index]);
        $data = array_values($data);
        file_put_contents('../données/formulaire.json', json_encode($data, JSON_PRETTY_PRINT));
    }
}

$htmlContent = '';
$htmlContent .= '
<div class="container-fluid bg-light p-5">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Email</th>
        <th>Message</th>
        <th>Supprimer</th>
      </tr>
    </thead>
    <tbody>';
foreach ($data as $index => $item) {
    $htmlContent .= '
      <tr>
        <td>' . htmlspecialchars($item['nom']) . '</td>
        <td>' . htmlspecialchars($item['email']) . '</td>
        <td>' . htmlspecialchars($item['message']) . '</td>
        <td>
          <form method="post">
            <input type="hidden" name="delete" value="' . $index . '">
            <button type="submit" class="btn btn-danger">Supprimer</button>
          </form>
        </td>
      </tr>';
}
$htmlContent .= '
    </tbody>
  </table>
  <div class="container d-flex justify-content-center">
    <a href="../traitement/pdf_traitement.php"><button id="bouton-spinner" class="btn btn-primary">Télécharger le PDF</button></a>
    <div id="spinner" class="spinner-border spinner-border-sm" style="display: none;"></div>
    <script src="../js/spinner.js"></script>
  </div>
</div>';

echo $htmlContent;


pagefooter_Intranet();
?>