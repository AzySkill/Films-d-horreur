<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Connexion</h1>
    <?php
    if(isset($_GET['error'])){
        if($_GET['error'] === 'notallowed'){
            echo '<p>ahahahaa you didnt say magic word.</p>';
        }
        else{
            echo '<p>Failed. Retry.</p>';
        }
    }
    ?>

    <form method="POST" action="connect.php">
        <label for="username">Nom d'utilisateur</label>
        <input id="username" name="username" value="" required>

        <label for="password">Mot de passe</label>
        <input id="password" name="password" value="" type="password" required>

        <button type="submit">Se connecter</button>
    </form>
</body>
</html>