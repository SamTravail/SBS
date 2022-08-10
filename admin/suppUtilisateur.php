<?php

require('../functions/pdo.php');
require('../includes/fonction.php');

// Réccupération de l'ID
if(!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];

// function getId($id) {
    global $pdo;
    $sql = "DELETE FROM utilisateurs WHERE id_utilisateur = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

}

include('../includes/header-back.php'); ?>

<h1>Utilisateur Supprimé</h1>
<form method="post" action="listingUtilisateurs.php">
    <input type="submit" value="Retour">
</form>
<?php include('../includes/footer-back.php');?>
