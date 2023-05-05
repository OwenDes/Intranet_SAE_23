<?php
require_once '../dompdf/autoload.inc.php';
include '../fonction.php'; 
head(); pageheader_1();
$jsonString = file_get_contents('../données/formulaire.json');
$data = json_decode($jsonString, true);

$htmlContent = '';
$htmlContent .= 
'<div class="container-fluid bg-light p-5">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Email</th>
        <th>Message</th>
      </tr>
    </thead>
    <tbody>';
foreach ($data as $item) {
$htmlContent .= 
      '<tr>
        <td>' . htmlspecialchars($item['nom']) . '</td>
        <td>' . htmlspecialchars($item['email']) . '</td>
        <td>' . htmlspecialchars($item['message']) . '</td>
      </tr>';
}
$htmlContent .=     
    '</tbody>
  </table>
  <div class="container d-flex justify-content-center">
    <a href="../traitement/pdf_traitement.php">Télécharger le PDF</a>
  </div>
</div>';

echo $htmlContent;

pagefooter();
?>

