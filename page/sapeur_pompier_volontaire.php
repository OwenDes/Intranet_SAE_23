<?php include '../fonction.php'; head() ; pageheader_2() ?>
<section class="bg-light py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mt-5">
          <h1>Les Pompiers Volontaires</h1>
          <p class="lead">Le Service National d’Incendie et de Secours du Listenbourg compte sur une vaste équipe de pompiers volontaires professionnels qui mettent leur vie en danger pour protéger les citoyens et leurs biens.</p>
        </div>
        <div class="col-md-6">
          <img src="../images/sapeur_pompier_volontaire.jpg" alt="Pompiers Volontaires" class="img-fluid shadow rounded" style="max-height: 300px;">
        </div>
      </div>
    </div>
  </section>
  <!-- Section des pompiers -->
  <section class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="../images/pompier_en_action.jpg" alt="Pompiers en action" class="img-fluid shadow rounded mt-2">
        </div>
        <div class="col-md-6">
          <h2>Qui sont les pompiers volontaires du SNIS Listenbourg ?</h2>
          <p class="lead">Les pompiers volontaires sont des citoyens engagés qui ont choisi de donner de leur temps et de leur énergie pour servir leur communauté. Ils sont formés pour intervenir sur les incendies, les accidents de la route, les inondations et autres situations d'urgence.</p>
      <p class="lead">Au SNIS du Listenbourg, nos pompiers volontaires sont sélectionnés pour leur courage, leur dévouement et leur sens des responsabilités. Ils sont équipés de matériels de pointe pour leur permettre d'effectuer leur travail de manière efficace et en toute sécurité.</p>
    </div>
  </div>
</div>
</section>
  <!-- Section de contact -->
  <section class="bg-light py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2>Contactez-nous</h2>
        <p class="lead">Si vous avez des questions sur le Service National d’Incendie et de Secours du Listenbourg ou si vous souhaitez devenir pompier volontaire, n'hésitez pas à nous contacter en utilisant ce formulaire.</p>
      </div>
      <div class="col-md-6">
        <form action="../traitement/formulaire_traitement.php" method="POST">
          <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="message" class="form-label">Décrivez-vous brièvement (800 caractères)</label>
            <textarea maxlength="800" class="form-control" id="message" name="message" rows="5" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
      </div>
    </div>
  </div>
</section>
</div>
<?php pagefooter() ;?>