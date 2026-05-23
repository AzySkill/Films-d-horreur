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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Tableau de bord</title>
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
                <li><a class="active" href="admin-dashboard.php"><span class="icon">🏠</span>Dashboard</a></li>
                <li><a href="admin.php"><span class="icon">🎬</span>Films</a></li>
                <li><a href="admin.php"><span class="icon">➕</span>Ajouter Film</a></li>
                <li><a href="#"><span class="icon">⚙️</span>Paramètres</a></li>
                <li><a href="accueil.php"><span class="icon">🏠</span>Retour au site</a></li>
            </ul>
        </aside>

        <main class="main">
            <div class="topbar">
                <div>
                    <h1>Bienvenue, Admin</h1>
                    <p style="margin: 6px 0 0; color: #9aa4b8;">Voici un aperçu rapide de vos films.</p>
                </div>
                <div class="user-actions">
                    <button onclick="location.href='login.php'">Déconnexion</button>
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
                    <button onclick="location.href='#'">Ajouter un Film</button>
                </div>
                <div class="table-wrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Année</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Scream (2022)</td>
                                <td>2023</td>
                                <td class="actions"><button class="button-blue">Modifier</button><button class="button-red">Supprimer</button></td>
                            </tr>
                            <tr>
                                <td>World War Z (2013)</td>
                                <td>2013</td>
                                <td class="actions"><button class="button-blue">Modifier</button><button class="button-red">Supprimer</button></td>
                            </tr>
                            <tr>
                                <td>Slender Man (2018)</td>
                                <td>2013</td>
                                <td class="actions"><button class="button-blue">Modifier</button><button class="button-red">Supprimer</button></td>
                            </tr>
                            <tr>
                                <td>Conjuring (2013)</td>
                                <td>2019</td>
                                <td class="actions"><button class="button-blue">Modifier</button><button class="button-red">Supprimer</button></td>
                            </tr>
                            <tr>
                                <td>Insidious (2010)</td>
                                <td>2010</td>
                                <td class="actions"><button class="button-blue">Modifier</button><button class="button-red">Supprimer</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
