<?php
session_start();
if (!isset($_SESSION['is_connected'])) {
    header('Location: login.php');
    exit;
}
$isAdmin = true;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Scream - The Horror Vault</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
  <div class="header-brand">
    <a href="accueil.php" class="logo-link">
      <img src="images/The horror vault.svg" alt="Logo The Horror Vault">
    </a>
  </div>
  <nav>
    <a href="accueil.php">Accueil</a>
    <a href="films.php">Films</a>
    <a href="apropos.php">À propos</a>
    <?php if ($isAdmin): ?>
      <a href="admin.php">Modifier</a>
      <a href="admin-dashboard.php">Compte admin</a>
    <?php endif; ?>
  </nav>
</header>

<main>
  <section class="section-title">
    <h2>Scream</h2>
  </section>

  <section class="movie-detail">
    <div>
      <img src="scream.jpeg" alt="Affiche Scream 2022">
    </div>
    <div class="movie-meta">
      <p><strong>Genre :</strong> Horreur / Slasher</p>
      <p><strong>Année :</strong> 2022</p>
      <p><strong>Durée :</strong> 2h01</p>
      <p><strong>Réalisateur :</strong> Matt Bettinelli-Olpin & Tyler Gillett</p>
      <p><strong>Résumé :</strong> Ghostface revient terroriser Woodsboro. Amber Freeman et d’autres personnages doivent faire face à un nouveau tueur masqué, tandis que les secrets du passé refont surface.</p>
      <p><strong>Note générale :</strong> 7.5 / 10</p>
    </div>
  </section>
</main>

<footer>
</footer>

</body>
</html>