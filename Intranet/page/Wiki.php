<?php include '../Fonction_Intranet.php'; 
session_start();
if (!isset($_SESSION['user']) || !isset($_SESSION['role']) || ($_SESSION['role'] != 'user' && $_SESSION['role'] != 'admin')) {
    header('Location: ../page/connexion.php');
    exit();
}



header_Intranet() ; navbar_Intranet();?>
<hr class="mt-5"><br>
<div class='text-center mb-5'>
<h1><strong>Wiki :</strong></h1><br>
<p>Cette page a pour but de vous expliquer et de vous présenter les différentes fonction et utilisation du site SNIS du Listenbourg.<br>
Cette page Wiki regroupe toutes les connaissances à savoir pour comprendre en data-t-il toutes ces subtilités.
</p><hr>
</div>
<div class="container border text-center shadow-lg bg white">
<div class='row'>
    <h2 class='mb-6'>Fonction de la vitrine</h2>
<div class="col-sm-6 border">
<h3>Actualité</h3>
<p>La page formulaire se situe dans la partie sapeur-pompier volontaire de la vitrine. Cette page est destinée au recrutement de futur pompier. Elle regroupe 3 champs : 
    nom.
    Adresse e-mail.
    Décrivez-vous brièvement.
Cette fonction de traitement formulaire va écrire les informations, 
saisi dans ces 3 champs pour les enregistrés dans le fichier "formulaire. Json", et pouvoir les affichers à l'administrateur, cette 
fonction qui permet d'afficher les information à l'administrateur se situe dans la page intranet, puis gestion du site, lecture
 formulaire.
</p>
    </div>
    <div class="col-sm-6 border">
<h3>Traitement formulaire</h3>
<p>La page formulaire se situe dans la partie sapeur-pompier volontaire de la vitrine. Cette page est destinée au recrutement de futur pompier.
    Elle regroupe 3 champs :<strong><br>Nom.<br>Adresse e-mail.<br>Décrivez-vous brièvement.<br></strong>
    Cette fonction de traitement formulaire va écrire les informations, saisi dans ces 3 champs pour les enregistrers dans le fichier "formulaire.Json", et pouvoir les affichers à l'administrateur, cette 
    fonction qui permet d'afficher les information à l'administrateur se situe dans la page intranet, puis gestion du site, lecture formulaire.
    <p>
    </div>
</div>
</div>
<div class="container border text-center shadow-lg bg white mt-5">
<div class='row'>
    <h2 class='mb-6'>Fonction Annuaire</h2>
<div class="col border">
<h3>Annuaire</h3>
<p>Vous pouvez retrouver la page annuaire dans l'intranet du SNIS du Listenbourg. Elle va permettre de retrouver des informations sur les employés. 
    Comme par exemple le nom, Prénom, numéro de téléphone, Adresse mail, le service et la fonction. En un click sur l'image une modale apparaît et 
    apporte des informations complémentaires. L'annuaire utilise une fonction php qui va permettre de lire le fichier contact.json et l'afficher sous la forme 
    d'un tableau.
</p>
    </div>
</div>
</div>

<div class="container border text-center shadow-lg bg white mt-5">
<div class='row'>
    <h2 class='mb-6'>Partage de fichier</h2>
<div class="col border">
<p>Concernant la gestion des fichiers, possibilité de choisir le groupe de partage lors du dépôt de fichier, uniquement ce groupe
     pourra lire et modifier le fichier, selon les droits cochés attention, il pourra être supprimé par l'admin mais il n’aura pas les 
     droits de lecture et de modification. Possibilité d'importer uniquement des fichiers PDF, word, exel, vidéo d'un poids de 5Mo.</p>
    </div>
</div>
</div>
</body>

<?php pagefooter_Intranet()?>