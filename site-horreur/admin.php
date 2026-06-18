<?php
session_start();
if (!isset($_SESSION['is_connected'])) {
    header('Location: login.php?error=notallowed');
    exit;
}
require_once 'database.php';

$user_name = $_SESSION['user_name'] ?? 'Admin';
$user_initial = $_SESSION['user_initial'] ?? 'A';

$films = [];
$success_message = '';
$error_message = '';

// Traiter l'ajout d'un film
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    try {
        $stmt = $pdo->prepare('INSERT INTO item (titre, description, annee, genre, image) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([
            $_POST['titre'],
            $_POST['description'],
            $_POST['annee'],
            $_POST['genre'],
            $_POST['image']
        ]);
        $success_message = 'Film ajouté avec succès!';
    } catch (PDOException $e) {
        $error_message = 'Erreur lors de l\'ajout du film';
    }
}

// Récupérer les films
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
    <title>Admin - Gestion des Films</title>
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
                <li><a href="admin-dashboard.php"><span class="icon">🏠</span>Dashboard</a></li>
                <li><a class="active" href="admin.php"><span class="icon">🎬</span>Films</a></li>
                <li><a href="admin.php"><span class="icon">➕</span>Ajouter Film</a></li>
                <li><a href="parametres.php"><span class="icon">⚙️</span>Paramètres</a></li>
                <li><a href="accueil.php"><span class="icon">🏠</span>Retour au site</a></li>
            </ul>
        </aside>

        <main class="main">
            <div class="topbar">
                <div>
                    <h1>Gestion des Films</h1>
                </div>
                <div class="user-actions">
                    <button onclick="location.href='logout.php'">Déconnexion</button>
                </div>
            </div>

            <section class="panel">
                <div class="panel-header">
                    <h2>Liste des Films</h2>
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

            <section class="panel">
                <div class="panel-header">
                    <h2>Ajouter un Film</h2>
                </div>
                
                <?php if ($error_message): ?>
                    <div style="background: #ff4c4c; color: #fff; padding: 12px 16px; border-radius: 8px; margin: 16px;">
                        <?= htmlspecialchars($error_message) ?>
                    </div>
                <?php endif; ?>

                <?php if ($success_message): ?>
                    <div style="background: #28a745; color: #fff; padding: 12px 16px; border-radius: 8px; margin: 16px;">
                        <?= htmlspecialchars($success_message) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" style="padding: 16px;">
                    <input type="hidden" name="action" value="add">
                    
                    <div style="margin-bottom: 16px;">
                        <label for="titre" style="display: block; margin-bottom: 8px; font-weight: 600;">Titre du film</label>
                        <input type="text" id="titre" name="titre" required style="width: 100%; padding: 10px 12px; border: 1px solid #3a4557; border-radius: 8px; background: #1d232f; color: #e6ebf2; font-family: inherit;">
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label for="description" style="display: block; margin-bottom: 8px; font-weight: 600;">Description/Résumé</label>
                        <textarea id="description" name="description" required style="width: 100%; padding: 10px 12px; border: 1px solid #3a4557; border-radius: 8px; background: #1d232f; color: #e6ebf2; font-family: inherit; resize: vertical; min-height: 100px;"></textarea>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div>
                            <label for="annee" style="display: block; margin-bottom: 8px; font-weight: 600;">Année</label>
                            <input type="text" id="annee" name="annee" required style="width: 100%; padding: 10px 12px; border: 1px solid #3a4557; border-radius: 8px; background: #1d232f; color: #e6ebf2; font-family: inherit;">
                        </div>

                        <div>
                            <label for="genre" style="display: block; margin-bottom: 8px; font-weight: 600;">Genre</label>
                            <input type="text" id="genre" name="genre" required style="width: 100%; padding: 10px 12px; border: 1px solid #3a4557; border-radius: 8px; background: #1d232f; color: #e6ebf2; font-family: inherit;">
                        </div>
                    </div>

                    <div style="margin-top: 16px; margin-bottom: 16px;">
                        <label for="image" style="display: block; margin-bottom: 8px; font-weight: 600;">Nom du fichier image</label>
                        <input type="text" id="image" name="image" required placeholder="Ex: scream.jpeg" style="width: 100%; padding: 10px 12px; border: 1px solid #3a4557; border-radius: 8px; background: #1d232f; color: #e6ebf2; font-family: inherit;">
                    </div>

                    <button type="submit" style="background: #28a745; color: #fff; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer; font-weight: 600;">Ajouter le Film</button>
                </form>
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
