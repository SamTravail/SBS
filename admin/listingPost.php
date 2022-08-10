<?php 

// Importation des fonctions
require('../functions/pdo.php');
require('../includes/fonction.php');

// Selection dans la BDD articles, et affichage par date décroissante
$select_articles = "SELECT * FROM articles ORDER BY created_at DESC";

// préparation pour l'injection SQL
$query = $pdo->prepare($select_articles);

// INJECTION SQL
$query->execute();

// Affiche le résultat
$articles = $query->fetchAll();
?>

<?php

// ajout du header-back pour retour index-back !
include('../includes/header-back.php'); ?>

<!-- création tu tableau pour affichage des résultats -->
<h1>Liste des postes</h1>
    <a href="index.php">Retour</a>
<table>
   <thead>
    <tr>
        <th>id</th>
        <th>Title</th>
        <th>Content</th>
        <th>Auteur</th>
        <th>Status</th>
        <th>Editer</th>
    </tr>
   </thead>
 
    <!-- affichage des éléments récuppérés dans le tableau -->
    <tbody>
        <?php foreach ($articles as $article) { ?>
        <tr>
            <td><?=$article['id']?></td>
            <td><?=$article['title']?></td>
            <td><?=$article['content']?></td>
            <td><?=$article['auteur']?></td>
            <td><?=$article['status']?></td>
            <td><a href="editPost.php?id=<?=$article['id']?>">Editer</a></td>
            <td><a href="deletePost.php?id=<?= $article['id'] ?>">Supprimer</a></td>

        </tr>
        <?php } ?>
        <a id="back2Top" title="Back to top" href="#">&#10148;</a>
    </tbody>
</table>
    <input type="submit" name="submitted" value="Ajouter un nouveau post"><a href="newpost.php">New Post</a></a></input>

<?php include('../includes/footer-back.php'); ?>