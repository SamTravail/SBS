<?php
global $pdo,$Commentaires;
// Réccupération de l'ID
if(!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];

    $Commentaires->suppCommentaire($id);

}

?>

<h2>Commentaire Supprimé</h2>
<form method="post" action="index.php?page=commentaires">
    <input type="submit" value="Retour aux Commentaires">
</form>

