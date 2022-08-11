<?php

// Importation des fonctions
global $pdo,$Roles,$Categories;
//require('../functions/pdo.php');
//require('../includes/fonction.php');

// Selection dans la BDD articles, et affichage par date décroissante
$select_users = "SELECT * FROM categories ORDER BY id ASC";

// Préparation pour l'injection SQL
$query = $pdo->prepare($select_users);

// INJECTION SQL
$query->execute();

// Affiche le résultat
$categories = $query->fetchAll();
?>

<?php

// Ajout du header-back pour retour index-back
//include('../includes/header-back.php'); ?>

<!-- Création tu tableau pour affichage des utilisateurs -->
<h1>Liste des catégories</h1>

<table>
    <thead>
    <tr>
        <th>id</th>
        <th>nom</th>
        <th>id_parent</th>

    </tr>
    </thead>

    <!-- Affichage des éléments récuppérés dans le tableau -->
    <tbody>
    <?php foreach ($categories as $categorie) { ?>
        <tr>
            <td><?= $categorie['id'] ?></td>
            <td><?= $categorie['nom'] ?></td>
            <td><?= $categorie['id_parent'] ?></td>
            <td><a href="index.php?page=editCategorie&id=<?= $categorie['id'] ?>">Editer</a></td>
            <td><a href="index.php?page=suppCategorie&id=<?= $categorie['id'] ?>">Supprimer</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<form method="post" action="index.php?page=newCategorie">
<input type="submit" name="ajouter" value="Ajouter une Catégorie">
</form>
