<?php

global $pdo,$Categories;
// Réccupération de l'ID
if(!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];

    $Categories->suppCategorie($id);

}

?>

<h2>Catégorie Supprimée</h2>
<form method="post" action="index.php?page=categories">
    <input type="submit" value="Retour aux Catégories">
</form>