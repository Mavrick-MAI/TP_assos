<?php session_start(); ?>

<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ">
          <li class="nav-item">
            <a class="nav-link" href="Accueil.php">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ListeLivres.php">Livres</a>
          </li>       
          <?php if (isset($_SESSION['user'])) : ?>
            <li class="nav-item">
              <a class="nav-link" href="ListeMembres.php">Membres</a>
            </li>
          <?php endif; ?>
        </ul>
        <ul class="navbar-nav ms-auto">
          <?php if (!isset($_SESSION['user'])) : ?>
            <li class="nav-item">
              <a class="nav-link" href="Membre.php?type=Ajouter">S'inscrire</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="SeConnecter.php">Se connecter</a>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <a class="nav-link" href="#">Bonjour, <?=$_SESSION['user'][2]?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="SeDeconnecter.php" onclick="return confirm('Êtes-vous certain de vouloir vous déconnecter ?')">Se déconnecter</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>
</nav>