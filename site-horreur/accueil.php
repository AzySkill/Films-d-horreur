<?php
require_once 'bootstrap.php';
require_once 'database.php';
$title = 'The Horror Vault';
require_once 'header.php';

$films = [];

try {
    $stmt = $pdo->query('SELECT * FROM item LIMIT 3');
    $films = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $films = [];
}
?>
<main>
  <section class="hero">
    <div class="hero-copy">     
      <h1>Bienvenue dans The Horror Vault</h1>
      <p>Explore une collection de films d’horreur sombres, immersifs et incontournables. Plonge au cœur d’une atmosphère mystérieuse avec des affiches, des résumés et des sélections en vedette.</p>
      <a class="btn" href="films.php">Voir tous les films</a>
    </div> 
  </section>

  <section class="section-featured">
    <h2 class="section-title">Films en vedette</h2>
    <div class="card-grid">
      <?php if (count($films) > 0): ?>
        <?php foreach ($films as $film): ?>
          <article class="feature-card">
            <a href="film.php?id=<?= $film['id_item'] ?>">
              <img src="images/<?= htmlspecialchars($film['image'] ?? 'scream.jpeg', ENT_QUOTES, 'UTF-8') ?>" alt="Affiche <?= htmlspecialchars($film['titre'], ENT_QUOTES, 'UTF-8') ?>">
              <div class="feature-card-content">
                <h3><?= htmlspecialchars($film['titre'], ENT_QUOTES, 'UTF-8') ?></h3>
                <p><?= htmlspecialchars($film['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
              </div>
            </a>
          </article>
        <?php endforeach; ?>
      <?php else: ?>
        <article class="feature-card">
          <img src="images/scream.jpeg" alt="Affiche Scream">
          <div class="feature-card-content">
            <h3>Scream (2022)</h3>
            <p>Ghostface revient terroriser Woodsboro avec Amber Freeman et un nouveau mystère.</p>
          </div>
        </article>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php require_once 'footer.php'; ?>
