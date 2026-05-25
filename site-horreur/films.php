<?php
require_once 'bootstrap.php';
require_once 'database.php';
$title = 'Tous les films - The Horror Vault';
require_once 'header.php';

$stmt = $pdo->query('SELECT * FROM item');
$films = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<main>
  <section class="section-title">
    <h2>Tout les films</h2>
    <form class="search-form" action="#" method="get">
      <label>
        Rechercher un film...
        <input type="search" name="q" placeholder="Entrez un titre...">
      </label>
    </form>   
  </section>

  <section class="movie-grid">
    <?php if (count($films) > 0): ?>
      <?php foreach ($films as $film): ?>
        <article class="movie-card">
          <a href="scream.php">
            <img src="scream.jpeg" alt="Affiche <?= htmlspecialchars($film['titre'], ENT_QUOTES, 'UTF-8') ?>">
            <div class="movie-card-content">
              <h3><?= htmlspecialchars($film['titre'], ENT_QUOTES, 'UTF-8') ?></h3>
              <p class="movie-summary">Découvrez ce film dans notre collection d’horreur.</p>
            </div>
          </a>
        </article>
      <?php endforeach; ?>
    <?php else: ?>
      <article class="movie-card">
        <div class="movie-card-content">
          <h3>Aucun film trouvé</h3>
          <p>La base de données ne contient pas encore de films.</p>
        </div>
      </article>
    <?php endif; ?>
  </section>
</main>
<?php require_once 'footer.php'; ?>