<?php
require_once 'bootstrap.php';
$title = 'The Horror Vault';
require_once 'header.php';
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
      <article class="feature-card">
        <a href="scream.php">
          <img src="scream.jpeg" alt="Affiche Scream">
          <div class="feature-card-content">
            <h3>Scream (2022)</h3>
            <p>Ghostface revient terroriser Woodsboro avec Amber Freeman et un nouveau mystère.</p>
          </div>
        </a>
      </article>

      <article class="feature-card">
        <a href="scream.php">
          <img src="scream.jpeg" alt="Affiche Scream">
          <div class="feature-card-content">
            <h3>Scream (2022)</h3>
            <p>Une nouvelle génération de survivants tente de démasquer un assassin masqué.</p>
          </div>
        </a>
      </article>

      <article class="feature-card">
        <a href="scream.php">
          <img src="scream.jpeg" alt="Affiche Scream">
          <div class="feature-card-content">
            <h3>Scream (2022)</h3>
            <p>Secrets, trahisons et peur se mêlent dans une enquête haletante.</p>
          </div>
        </a>
      </article>
    </div>
  </section>
</main>
<?php require_once 'footer.php'; ?>
