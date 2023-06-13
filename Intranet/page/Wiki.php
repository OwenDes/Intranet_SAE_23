<?php include '../Fonction_Intranet.php'; header_Intranet() ; navbar_Intranet();?>
<hr class="mt-5"><br>
<div class='text-center mb-5'>
<h1><strong>Wiki :</strong></h1><br>
<p>Cette page a pour but de vous expliquer et de vous présenter les différentes fonction et utilisation du site SNIS du Listenbourg.<br>
    Cette page Wiki regroupe toute les connaissance à savoir pour comprendre en datail toutes ces suptilité.
</p><hr>
</div>
<div class="container border text-center shadow-lg bg white">
<div class='row'>
    <h2 class='mb-6'>Fonction de la vitrine</h2>
<div class="col-sm-6 border">
<h3>Actualité</h3>
<p>La fonction actualité va permettre de mettre à jour les actualités, elle utilise un fichier Json qui regroupe toute les données.
    Cette fonction va dans un premier temps lire le fichier "Actualité.json", ensuite il va également permettre de modifier le contenu de ce fichier
    pour permettre la possibilité de mettre à jour ces information.
</p>
    </div>
    <div class="col-sm-6 border">
<h3>Traitement formulaire</h3>
<p>La page formulaire ce situe dans la partie sapeur pompier volontaire de la vitrine. Cette page est destiné au recrutement de future pompier.
    Elle regroupe 3 champs :<strong><br>Nom.<br>Adresse e-mail.<br>Décrivez-vous brièvement.<br></strong>
    Cette fonction de traitement formulaire va écrire les informations, saisi dans ces 3 champs pour les enregistrers dans le fichier "formulaire.Json", et pouvoir les affichers à l'administrateur, cette 
    fonction qui permet d'afficher les information à l'administrateur se situe dans la page intranet, puis gestion du site, lecture formulaire.
    <p>
    </div>
</div>
</div>

</body>