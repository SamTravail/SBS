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
include('../includes/header-back.php');
include('note.php');
?>
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
        <th>Note</th>
        <th>Nombre de note</th>
        <th>Status</th>
        <th>Editer</th>
    </tr>
   </thead>
 
    <!-- affichage des éléments récuppérés dans le tableau -->
    <tbody>
        <?php foreach ($articles as $article) { ?>
        <tr>
            <td><?=$article['id']?></td>
            <td><a href="affichePost.php?id=<?=$article['id']?>"><?=$article['title']?></a></td>
            <td><?=$article['content']?></td>
            <td><?=$article['auteur']?></td>
            <td ><?php
                $infoNote =  recupereNoteMoyenne($article['id']);echo $infoNote[0];?> /5 </td>
            <td style="text-align: center"><a href="note.php?op=lire&id=<?=$article['id']?>"><?php echo $infoNote[1];?></a> </td>
            <td><?=$article['status']?></td>
            <td><a href="editPost.php?id=<?=$article['id']?>">Editer</a></td>
            <td><a href="deletePost.php?id=<?= $article['id'] ?>">Supprimer</a></td>

        </tr>
        <?php } ?>
        <a id="back2Top" title="Back to top" href="#">&#10148;</a>
    </tbody>
</table>
    <form method="post" action="newPost.php">
        <input type="submit" name="ajouter" value="Créer un article">
    </form>
<?php include('../includes/footer-back.php'); ?>