<?php include("db.php"); ?>

<?php
$result = mysqli_query($conn, "SELECT * FROM item");

while($film = mysqli_fetch_assoc($result)) {
    echo "<h3>" . $film['titre'] . "</h3>";
}
?>
<form method="POST">
  <input type="text" name="titre">
  <button type="submit">Ajouter</button>
</form>
<?php
if(isset($_POST['titre'])) {
    $titre = $_POST['titre'];

    mysqli_query($conn, "INSERT INTO item (titre) VALUES ('$titre')");
}
?>
