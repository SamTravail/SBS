<?php

global $pdo,$Categories;
// R�ccup�ration de l'ID
if(!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];

    $Categories->suppCategorie($id);

}

?>

<h2>Cat�gorie Supprim�e</h2>
<form method="post" action="index.php?page=categories">
    <input type="submit" value="Retour aux Cat�gories">
</form>