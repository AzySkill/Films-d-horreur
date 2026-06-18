<?php
require_once 'bootstrap.php';
require_once 'database.php';

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare('SELECT * FROM item WHERE id_item = ?');
$stmt->execute([$id]);

$film = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$film) {
    die('Film introuvable');
}

// Mapping des films vers leurs IDs YouTube pour les bandes annonces
$youtube_mapping = [
    'scream' => 'beToTslH17s',
    'it' => 'xKJmEC5ieOk',
    'world war z' => 'Md6Dvxdr0AQ',
    'midsommar' => 'YMKeRDlcpJQ',
    'slender man' => 'eRV-c3hs3vw'
];

// Récupérer l'ID YouTube basé sur le titre du film
$youtube_id = 'beToTslH17s'; // Lien par défaut (Scream)
$film_title_lower = strtolower($film['titre']);
foreach ($youtube_mapping as $titre => $id_yt) {
    if (stripos($film_title_lower, $titre) !== false) {
        $youtube_id = $id_yt;
        break;
    }
}

$title = htmlspecialchars($film['titre']) . ' - The Horror Vault';
require_once 'header.php';
?>

<main>
  <section class="movie-detail">
    <div class="video-container">
      <iframe width="100%" height="500" src="https://www.youtube.com/embed/<?= htmlspecialchars($youtube_id) ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <div class="movie-right-column">
      <img src="images/<?= htmlspecialchars($film['image'] ?? 'scream.jpeg', ENT_QUOTES, 'UTF-8') ?>" alt="Affiche <?= htmlspecialchars($film['titre']) ?>">
      <div class="movie-info-section">
        <h1><?= htmlspecialchars($film['titre']) ?></h1>
        <div class="movie-info-grid">
          <div>
            <p><strong>Genre :</strong> <?= htmlspecialchars($film['genre'] ?? 'N/A') ?></p>
          </div>
          <?php if (!empty($film['annee'])): ?>
            <div>
              <p><strong>Année :</strong> <?= htmlspecialchars($film['annee']) ?></p>
            </div>
          <?php endif; ?>
        </div>
        <div class="movie-resume">
          <p><strong>Résumé :</strong></p>
          <p><?= htmlspecialchars($film['description']) ?></p>
        </div>
      </div>
    </div>
  </section>
</main>

<?php require_once 'footer.php'; ?>