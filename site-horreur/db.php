<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "cineclub_horreur"
);

if (!$conn) {
    die("Erreur connexion");
}