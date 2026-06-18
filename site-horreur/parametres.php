<?php
session_start();

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['is_connected'])) {
    header('Location: login.php');
    exit();
}

$email = $_SESSION['is_connected'];
$user_name = $_SESSION['user_name'] ?? 'Admin';
$user_initial = $_SESSION['user_initial'] ?? 'A';

// Récupérer les données d'authentification basées sur l'email
$credentials = [];
if ($email === 'test@mail.com') {
    $credentials = [
        'email' => 'test@mail.com',
        'password' => '$2y$10$8OwCd4CVJwhNsV84FATn3.TxrC8EKssQhIZHG7FJ.oo2/EaeqdFUG'
    ];
} elseif ($email === 'alekssaliaj03@gmail.com') {
    $credentials = [
        'email' => 'alekssaliaj03@gmail.com',
        'password' => '$2y$10$px8LEvVa.Ewe.0R.P/tW5O6mHS.03wHrsuAnBOLn4AwFKMt.y8QdK'
    ];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres - The Horror Vault</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dashboard.css">
    <style>
        .parametres-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .info-box {
            background: #1d232f;
            border: 1px solid #3a4557;
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .info-row {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .info-row:last-child {
            margin-bottom: 0;
        }

        .info-label {
            font-weight: 600;
            color: #f6e032;
            margin-bottom: 8px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            background: #161a22;
            border: 1px solid #3a4557;
            padding: 12px;
            border-radius: 6px;
            color: #e6ebf2;
            font-family: 'Courier New', monospace;
            word-break: break-all;
            user-select: all;
        }

        .info-value.password {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .toggle-password {
            background: #f6e032;
            color: #012A3C;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            font-size: 12px;
            transition: opacity 0.2s;
        }

        .toggle-password:hover {
            opacity: 0.9;
        }

        .password-input {
            flex: 1;
            background: transparent;
            border: none;
            color: #e6ebf2;
            font-family: 'Courier New', monospace;
            padding: 0;
            margin-right: 10px;
        }

        .password-input:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <?php include 'header.php'; ?>
        <main>
            <div class="parametres-container">
                <h1 style="margin-bottom: 32px;">Paramètres de Compte</h1>

                <div class="info-box">
                    <div class="info-row">
                        <div class="info-label">Nom d'utilisateur</div>
                        <div class="info-value"><?= htmlspecialchars($user_name) ?></div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">ID (Email)</div>
                        <div class="info-value"><?= htmlspecialchars($email) ?></div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Mot de passe</div>
                        <div class="info-value password">
                            <input type="password" id="passwordInput" class="password-input" value="<?= htmlspecialchars($credentials['password']) ?>" readonly>
                            <button class="toggle-password" onclick="togglePassword()">Afficher</button>
                        </div>
                    </div>
                </div>

                <button class="button-green" onclick="location.href='admin-dashboard.php'">
                    Retour au Dashboard
                </button>
            </div>
        </main>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('passwordInput');
            const button = event.target;
            
            if (input.type === 'password') {
                input.type = 'text';
                button.textContent = 'Masquer';
            } else {
                input.type = 'password';
                button.textContent = 'Afficher';
            }
        }
    </script>
</body>
</html>
