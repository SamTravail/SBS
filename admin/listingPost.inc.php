<?php 

// Importation des fonctions
require_once('functions/pdo.php');
//require_once('includes/fonction.php');

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
//include('includes/header-back.php');
require_once('note.php');
$impaire = false;
?>
<!-- création tu tableau pour affichage des résultats -->
<h1>Liste des postes inc</h1>
    <a href="index.php">Retour</a>
<table class="wrap2">
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
        <tr
            <?php
            if(!$impaire)
            {
                echo 'style="background-color: #DDDD;"';
                $impaire = true;
            }
            else{echo 'style="background-color: #CDCC;"';
                $impaire = false; }
            ?>


        >
            <td><?=$article['id']?></td>
            <td><a href="index.php?page=article&article=<?=$article['id']?>"><?=$article['title']?></a></td>
            <td><?=$article['content']?></td>
            <td><?=$article['auteur']?></td>
            <td ><?php
                $infoNote =  recupereNoteMoyenne($article['id']);echo $infoNote[0];?> /5 </td>
            <td style="text-align: center"><a href="index.php?page=note&op=lire&id=<?=$article['id']?>"><?php echo $infoNote[1];?></a> </td>
            <td><?=$article['status']?></td>
            <td><a href="index.php?page=editPost&id=<?=$article['id']?>">Editer</a></td>
            <td><a href="index.php?page=suppPost&id=<?= $article['id'] ?>">Supprimer</a></td>

        </tr>
        <?php } ?>
        <a id="back2Top" title="Back to top" href="#">&#10148;</a>
    </tbody>
</table>
    <form method="post" action="index.php?page=newPost">
        <input type="submit" name="ajouter" value="Créer un article">
    </form>
