<?php
$jsonString = file_get_contents('../données/formulaire.json');
require_once '../dompdf/autoload.inc.php';
$data = json_decode($jsonString, true);

$htmlContent = '<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
</head>
<body>
<div class="container-fluid bg-light p-5">
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
</div>
</body>
</html>';

use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml($htmlContent);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('Messages.pdf');
header('Location: ../page/lecture_formulaire');
?>