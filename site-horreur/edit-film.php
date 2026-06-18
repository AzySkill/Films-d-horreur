<?php
session_start();
if (!isset($_SESSION['is_connected'])) {
    header('Location: login.php?error=notallowed');
    exit;
}
require_once 'database.php';

$user_name = $_SESSION['user_name'] ?? 'Admin';
$user_initial = $_SESSION['user_initial'] ?? 'A';

$film_id = $_GET['id'] ?? 0;
$film = null;
$error_message = '';
$success_message = '';

// Récupérer le film
try {
    $stmt = $pdo->prepare('SELECT * FROM item WHERE id_item = ?');
    $stmt->execute([$film_id]);
    $film = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$film) {
        $error_message = 'Film non trouvé';
    }
} catch (PDOException $e) {
    $error_message = 'Erreur lors de la récupération du film';
}

// Traiter la mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titre'])) {
    try {
        $stmt = $pdo->prepare('UPDATE item SET titre = ?, description = ?, annee = ?, genre = ?, image = ? WHERE id_item = ?');
        $stmt->execute([
            $_POST['titre'],
            $_POST['description'],
            $_POST['annee'],
            $_POST['genre'],
            $_POST['image'],
            $film_id
        ]);
        $success_message = 'Film modifié avec succès!';
        
        // Rafraîchir les données
        $stmt = $pdo->prepare('SELECT * FROM item WHERE id_item = ?');
        $stmt->execute([$film_id]);
        $film = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $error_message = 'Erreur lors de la modification';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un film - Admin</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        .edit-form {
            background: #252d3a;
            padding: 24px;
            border-radius: 12px;
            max-width: 600px;
            margin: 20px auto;
        }
        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            margin-bottom: 8px;
            font-weight: 600;
            color: #e6ebf2;
        }
        .form-group input,
        .form-group textarea {
            padding: 10px 12px;
            border: 1px solid #3a4557;
            border-radius: 8px;
            background: #1d232f;
            color: #e6ebf2;
            font-family: inherit;
            font-size: 1rem;
        }
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 24px;
        }
        .form-actions button {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            color: #fff;
        }
        .btn-save {
            background: #28a745;
        }
        .btn-cancel {
            background: #6c757d;
        }
        .btn-save:hover {
            opacity: 0.92;
        }
        .btn-cancel:hover {
            opacity: 0.92;
        }
        .message {
            padding: 12px 16px;
            border-radius: 8px;
            margin: 20px auto;
            max-width: 600px;
        }
        .message.success {
            background: #28a745;
            color: #fff;
        }
        .message.error {
            background: #ff4c4c;
            color: #fff;
        }
    </style>
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
                <li><a href="admin.php"><span class="icon">🎬</span>Films</a></li>
                <li><a href="admin.php"><span class="icon">➕</span>Ajouter Film</a></li>
                <li><a href="parametres.php"><span class="icon">⚙️</span>Paramètres</a></li>
                <li><a href="accueil.php"><span class="icon">🏠</span>Retour au site</a></li>
            </ul>
        </aside>

        <main class="main">
            <div class="topbar">
                <div>
                    <h1>Modifier un Film</h1>
                </div>
                <div class="user-actions">
                    <button onclick="location.href='logout.php'">Déconnexion</button>
                </div>
            </div>

            <?php if ($error_message): ?>
                <div class="message error"><?= htmlspecialchars($error_message) ?></div>
            <?php endif; ?>

            <?php if ($success_message): ?>
                <div class="message success"><?= htmlspecialchars($success_message) ?></div>
            <?php endif; ?>

            <?php if ($film): ?>
                <div class="edit-form">
                    <form method="POST">
                        <div class="form-group">
                            <label for="titre">Titre du film</label>
                            <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($film['titre'], ENT_QUOTES) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description/Résumé</label>
                            <textarea id="description" name="description" required><?= htmlspecialchars($film['description'], ENT_QUOTES) ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="annee">Année</label>
                            <input type="text" id="annee" name="annee" value="<?= htmlspecialchars($film['annee'], ENT_QUOTES) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="genre">Genre</label>
                            <input type="text" id="genre" name="genre" value="<?= htmlspecialchars($film['genre'], ENT_QUOTES) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="image">Nom du fichier image</label>
                            <input type="text" id="image" name="image" value="<?= htmlspecialchars($film['image'], ENT_QUOTES) ?>" required placeholder="Ex: scream.jpeg">
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-save">Enregistrer les modifications</button>
                            <button type="button" class="btn-cancel" onclick="location.href='admin-dashboard.php'">Annuler</button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
