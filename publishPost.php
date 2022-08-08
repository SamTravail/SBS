<?php

// Importation des fonctions
// require('../inc/pdo.php');
// require('../inc/fonction.php');

// Selection dans la BDD articles, et affichage par date décroissante
$select_articles = "SELECT * FROM articles ORDER BY created_at DESC";

// préparation pour l'injection SQL
$query = $pdo->prepare($select_articles);

// INJECTION SQL
$query->execute();

// Affiche le résultat
$articles = $query->fetchAll();
?>

<!-- création tu tableau pour affichage des résultats -->
<h1>Articles publiés</h1>
<table>
    <thead>
    <tr>
        <th>Title</th>
        <th>Auteur</th>
        <th>Description</th>
        <th>Publié le :</th>
        <th>Modifié le :</th>

    </tr>
    </thead>

    <!-- affichage des éléments récuppérés dans le tableau -->
    <tbody>
    <?php foreach ($articles as $article) { ?>
        <tr>
            <td><a href="listeArticle.php?article=<?php echo $article['id'];?>"><?= $article['title'] ?></a></td>
            <td><?= $article['auteur'] ?></td>
            <td><?=$article['content']?></td>
            <td><?= $article['created_at'] ?></td>
            <td><?= $article['modified_at'] ?></td>
        </tr>
    <?php } ?>
    <a id="back2Top" title="Back to top" href="#">&#10148;</a>
    </tbody>
</table>





