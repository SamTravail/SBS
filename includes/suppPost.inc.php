<?php


// Réccupération de l'ID
if(!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];

// function getId($id) {
    global $pdo;
    $sql = "DELETE FROM articles WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

}

?>
<h1>Article Supprim&eacute;</h1>
<form method="post" action="index.php">
    <input type="submit" value="Retour">
</form>
