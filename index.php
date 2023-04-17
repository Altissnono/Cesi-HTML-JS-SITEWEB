<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ma page d'accueil</title>
  <!-- Inclusion des fichiers CSS et JS de Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- Styles personnalisés pour la page -->
  <style>
    body {
      background-color: #22324c;
      color: #fff;
    }
    .shadow-text {
      text-shadow: 2px 2px #333;
    }
    .shadow-box {
      box-shadow: 2px 2px 10px #333;
    }
  </style>
</head>
<body>
  <!-- Ajout d'un en-tête avec une barre de navigation Bootstrap -->
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Ma page d'accueil</a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="contact.php">Contact</a></li>
        <li><a href="login.php">Connexion</a></li>
        <li><a href="inscription.php">Inscription</a></li>
        <li class="nav-item">
          <a class="nav-link" href="user.php">information</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <!-- Ajout d'un titre principal avec un effet d'ombre -->
        <h1 class="shadow-text">Bienvenue sur ma page d'accueil</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <!-- Ajout d'un paragraphe avec un effet d'ombre et une boîte d'ombre -->
        <p class="text-justify shadow-text shadow-box">Dans un avenir proche, la technologie a envahi notre monde. Les rues sont plongées dans l'obscurité, éclairées uniquement par les néons des publicités et les lueurs des implants cybernétiques. Vous êtes un(e) hacker, un(e) renégat(e) de la société, cherchant à se frayer un chemin dans cet environnement hostile. La guerre est partout, les ennemis sont nombreux. Êtes-vous prêt(e) à tout pour survivre ?</p>
      </div>
    </div>
  </div>

  <!-- Ajout d'un pied de page Bootstrap -->
  <footer class="navbar navbar-default navbar-fixed-bottom">
    <div class="container-fluid">
      <p class="navbar-text navbar-right">Tous droits réservés © Ma page d'accueil 2023</p>
    </div>
  </footer>
</body>
</html>
