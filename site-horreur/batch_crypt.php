<?php

include 'database.php';

$sql = "SELECT id, password FROM user";
$select = $pdo->query($sql);

$stmt = $pdo->prepare("UPDATE user SET password = ? WHERE id = ?");

while ($user = $select->fetch(PDO::FETCH_ASSOC)) {

    $password = $user["password"];
    $info = password_get_info($password);

    if ($info["algoName"] === 'unknown') {

        $hash = password_hash($password, PASSWORD_DEFAULT);

        if (!password_verify($password, $hash)) {
            continue;
        }

        $stmt->execute([$hash, $user['id']]);

    }
}
