<?php
require_once 'bootstrap.php';
require_once 'database.php';

$title = 'Tous les films - The Horror Vault';

require_once 'header.php';

$films = [];
$search_query = isset($_GET['q']) ? trim($_GET['q']) : '';

try {
    if (!empty($search_query)) {
        // Recherche par titre ou genre
        $stmt = $pdo->prepare('SELECT * FROM item WHERE titre LIKE ? OR genre LIKE ? ORDER BY titre');
        $search_param = '%' . $search_query . '%';
        $stmt->execute([$search_param, $search_param]);
    } else {
        // Récupère tous les films
        $stmt = $pdo->query('SELECT * FROM item ORDER BY titre');
    }
    
    $films = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $films = [];
}

if (count($films) === 0) {
    $films = array_fill(0, 5, [
        'titre' => 'Scream (2022)',
        'image' => 'scream.jpeg',
        'description' => 'Ghostface revient terroriser Woodsboro.',
        'annee' => '2022',
        'genre' => 'Horreur'
    ]);
}
?>

<main>

    <section class="section-title">

        <h2>Tous les films</h2>

        <form class="search-form" action="films.php" method="get">

            <label>
                Rechercher un film par titre ou genre...
                <input
                    type="search"
                    name="q"
                    placeholder="Entrez un titre ou un genre..."
                    value="<?= htmlspecialchars($search_query, ENT_QUOTES, 'UTF-8') ?>"
                >
            </label>

        </form>

    </section>

    <section class="movie-grid">

        <?php if (count($films) > 0): ?>

            <?php foreach ($films as $film): ?>

                <article class="movie-card">

                    <a href="film.php?id=<?= $film['id_item'] ?>">

                        <img
                            src="images/<?= htmlspecialchars($film['image'] ?? 'scream.jpeg', ENT_QUOTES, 'UTF-8') ?>"
                            alt="Affiche <?= htmlspecialchars($film['titre'], ENT_QUOTES, 'UTF-8') ?>"
                        >

                        <div class="movie-card-content">

                            <h3>
                                <?= htmlspecialchars($film['titre'], ENT_QUOTES, 'UTF-8') ?>
                            </h3>

                            <?php if (!empty($film['annee'])): ?>
                                <p>
                                    <strong>Année :</strong>
                                    <?= htmlspecialchars($film['annee'], ENT_QUOTES, 'UTF-8') ?>
                                </p>
                            <?php endif; ?>

                            <p>
                                <strong>Genre :</strong>
                                <?= htmlspecialchars($film['genre'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                            </p>

                            <p class="movie-summary">
                                <?= htmlspecialchars($film['description'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                            </p>

                        </div>

                    </a>

                </article>

            <?php endforeach; ?>

        <?php else: ?>

            <article class="movie-card">

                <div class="movie-card-content">

                    <h3>Aucun film trouvé</h3>

                    <p>
                        La base de données ne contient pas encore de films.
                    </p>

                </div>

            </article>

        <?php endif; ?>

    </section>

</main>

<?php require_once 'footer.php'; ?>