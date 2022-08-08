<?php 

// Importation des fonctions
require('../inc/pdo.php');
require('../inc/fonction.php');

// Selection dans la BDD articles, et affichage par date décroissante
$select_articles = "SELECT * FROM rloes ORDER BY created_at DESC";

// préparation pour l'injection SQL
$query = $pdo->prepare($select_articles);

// INJECTION SQL
$query->execute();

// Affiche le résultat
$articles = $query->fetchAll();
?>

<?php

// ajout du header-back pour retour index-back !
include('inc/header-back.php'); ?>

<!-- création tu tableau pour affichage des résultats -->
<h1>Liste des articles</h1>
<table>
   <thead>
    <tr>
        <th>id</th>
        <th>titre</th>
        <th>description</th>
        <th>Status</th>
        <th>Editer</th>
    </tr>
   </thead>
 
    <!-- affichage des éléments récuppérés dans le tableau -->
    <tbody>
        <?php foreach ($roles as $role) { ?>
        <tr>
            <td><?=$role['id']?></td>
            <td><?=$role['titre']?></td>
            <td><?=$role['description']?></td>
            <td><?=$role['status']?></td>
            <td><a href="editPost.php?id=<?=$role['id']?>">Editer</a></td>
        </tr>
        <?php } ?>
        <a id="back2Top" title="Back to top" href="#">&#10148;</a>
    </tbody>
</table>
<?php include('inc/footer-back.php'); ?>