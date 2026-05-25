<?php
session_start();
if (!isset($_SESSION['is_connected'])) {
    header('Location: login.php?error=notallowed');
    exit;
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
                <div class="logo">A</div>
                <div>Admin Panel</div>
            </div>
            <ul class="nav-list">
                <li><a href="admin-dashboard.php"><span class="icon">🏠</span>Dashboard</a></li>
                <li><a class="active" href="admin.php"><span class="icon">🎬</span>Films</a></li>
                <li><a href="admin.php"><span class="icon">➕</span>Ajouter Film</a></li>
                <li><a href="#"><span class="icon">⚙️</span>Paramètres</a></li>
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
                    <button onclick="location.href='admin.php'">Ajouter un Film</button>
                </div>
                <div class="table-wrap">
                    <?php include("database.php"); ?>
                    <?php
                    $stmt = $pdo->query("SELECT * FROM item");
                    $films = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    echo '<table class="table">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>';

                    foreach($films as $film) {
                        echo "<tr><td>" . htmlspecialchars($film['titre']) . "</td><td class='actions'><button class='button-blue'>Modifier</button><button class='button-red'>Supprimer</button></td></tr>";
                    }

                    echo '</tbody></table>';
                    ?>
                </div>
            </section>

            <section class="panel">
                <div class="panel-header">
                    <h2>Ajouter un Film</h2>
                </div>
                <form method="POST">
                    <label for="titre">Titre du film</label>
                    <input type="text" id="titre" name="titre" required>
                    <button type="submit">Ajouter</button>
                </form>
                <?php
                if(isset($_POST['titre'])) {
                    $titre = $_POST['titre'];
                    $stmt = $pdo->prepare("INSERT INTO item (titre) VALUES (?)");
                    $stmt->execute([$titre]);
                    echo "<p>Film ajouté avec succès.</p>";
                }
                ?>
            </section>
        </main>
    </div>
</body>
</html>
