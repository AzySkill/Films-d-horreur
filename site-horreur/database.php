<?php

$pdo = new PDO(
    'mysql:host=sql107.infinityfree.com;dbname=if0_42259012_films_horreur;charset=utf8',
    'if0_42259012',
    'Your vPanel Password',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);