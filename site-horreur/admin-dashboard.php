<?php
session_start();
if (!isset($_SESSION['is_connected'])) {
    header('Location: login.php?error=notallowed');
    exit;
}
require_once 'database.php';

$user_name = $_SESSION['user_name'] ?? 'Admin';
$user_initial = $_SESSION['user_initial'] ?? 'A';

// Récupérer les films
$films = [];
try {
    $stmt = $pdo->query('SELECT * FROM item ORDER BY titre');
    $films = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $films = [];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Tableau de bord</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="brand">
                <div class="logo"><?= htmlspecialchars($user_initial) ?></div>
                <div><?= htmlspecialchars($user_name) ?> Panel</div>
            </div>
            <ul class="nav-list">
                <li><a class="active" href="admin-dashboard.php"><span class="icon">🏠</span>Dashboard</a></li>
                <li><a href="admin.php"><span class="icon">🎬</span>Films</a></li>
                <li><a href="admin.php"><span class="icon">➕</span>Ajouter Film</a></li>
                <li><a href="parametres.php"><span class="icon">⚙️</span>Paramètres</a></li>
                <li><a href="accueil.php"><span class="icon">🏠</span>Retour au site</a></li>
            </ul>
        </aside>

        <main class="main">
            <div class="topbar">
                <div>
                    <h1>Bienvenue, <?= htmlspecialchars($user_name) ?></h1>
                    <p style="margin: 6px 0 0; color: #9aa4b8;">Voici un aperçu rapide de vos films.</p>
                </div>
                <div class="user-actions">
                    <button onclick="location.href='logout.php'">Déconnexion</button>
                </div>
            </div>

            <div class="cards">
                <div class="card">
                    <h2>Total des Films</h2>
                    <strong>5</strong>
                </div>
                <div class="card orange">
                    <h2>Films en Ligne</h2>
                    <strong>5</strong>
                </div>
                <div class="card red">
                    <h2>Films en Brouillon</h2>
                    <strong>0</strong>
                </div>
            </div>

            <section class="panel">
                <div class="panel-header">
                    <h2>Gestion des Films</h2>
                    <button onclick="location.href='admin.php'">Ajouter un Film</button>
                </div>
                <div class="table-wrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Année</th>
                                <th>Genre</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($films) > 0): ?>
                                <?php foreach ($films as $film): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($film['titre'], ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars($film['annee'] ?? 'N/A', ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars($film['genre'] ?? 'N/A', ENT_QUOTES, 'UTF-8') ?></td>
                                        <td class="actions">
                                            <button class="button-green" style="background: #28a745; color: #fff; border-radius: 10px;" onclick="location.href='film.php?id=<?= $film['id_item'] ?>'" >Voir</button>
                                            <button class="button-blue" onclick="location.href='edit-film.php?id=<?= $film['id_item'] ?>'">Modifier</button>
                                            <button class="button-red" onclick="confirmDelete(<?= $film['id_item'] ?>, '<?= htmlspecialchars($film['titre'], ENT_QUOTES, 'UTF-8') ?>')">Supprimer</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4">Aucun film trouvé</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
    <script>
        function confirmDelete(id, titre) {
            if (confirm('Êtes-vous sûr de vouloir supprimer le film "' + titre + '" ? Cette action est irréversible.')) {
                location.href = 'delete-film.php?id=' + id;
            }
        }
    </script>
</body>
</html>
