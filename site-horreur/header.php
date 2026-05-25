<?php
if (!isset($title)) {
    $title = 'The Horror Vault';
}
if (!isset($isAdmin)) {
    $isAdmin = false;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>
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
      <a href="logout.php">Déconnexion</a>
    <?php endif; ?>
  </nav>
</header>
