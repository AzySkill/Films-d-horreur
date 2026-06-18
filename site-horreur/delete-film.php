<?php
session_start();
if (!isset($_SESSION['is_connected'])) {
    header('Location: login.php?error=notallowed');
    exit;
}
require_once 'database.php';

$film_id = $_GET['id'] ?? 0;

if ($film_id) {
    try {
        // Récupérer le film avant de le supprimer
        $stmt = $pdo->prepare('SELECT * FROM item WHERE id_item = ?');
        $stmt->execute([$film_id]);
        $film = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($film) {
            // Supprimer le film
            $stmt = $pdo->prepare('DELETE FROM item WHERE id_item = ?');
            $stmt->execute([$film_id]);
        }
    } catch (PDOException $e) {
        // Erreur lors de la suppression
    }
}

// Rediriger vers le dashboard
header('Location: admin-dashboard.php');
exit;
?>
