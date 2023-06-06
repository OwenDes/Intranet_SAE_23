<?php include '../Fonction_Intranet.php'; header_Intranet(); ?>

<div class="container-fluid">
  <div class="row justify-content-center align-items-center vh-100">
    <div class="col-md-4 col-sm-12 p-5 bg-white rounded shadow">
      <h3 class="display-6">Connexion</h3>
      <p>Entrez votre nom d'utilisateur et votre mot de passe</p>
      <form action="../traitement/connexion_traitement.php" method="post">
        <div class="form-group">
          <label for="utilisateur" class="form-label">Utilisateur</label>
          <input type="text" class="form-control" id="login" name="login" placeholder="Utilisateur">
        </div>
        <div class="form-group">
          <label for="motdepasse" class="form-label">Mot de passe</label>
          <input type="password" class="form-control" id="motdepasse" name="motdepasse" placeholder="Mot de passe">
        </div>
        <button type="submit" class="btn mt-3 btn-primary">Se connecter</button>
      </form>
    </div>
  </div>
</div>
<?php pagefooter_Intranet() ;?>