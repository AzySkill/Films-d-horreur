<?php

$conn = mysqli_connect(
    "sql107.infinityfree.com",
    "if0_42259012",
    "Your vPanel Password",
    "if0_42259012_films_horreur"
);

if (!$conn) {
    die("Erreur connexion : " . mysqli_connect_error());
}