<?php 
global $pdo, $Categories,$Articles;

if(!empty($_POST['filtrecat'])&& ctype_digit($_POST['filtrecat']))
{
    $filtreCat = $_POST['categorie'];
    echo "*******************************************".$filtreCat;
    $articles = $Articles->lireArticlesCategorie($filtreCat);

}else{
    $articles = $Articles->articlesdate;
}

?>

<?php

// ajout du header-back pour retour index-back !
//include('includes/header-back.php');
require_once('includes/note.inc.php');
$impaire = false;
?>
<!-- création tu tableau pour affichage des résultats -->
<h1>Liste des articles</h1>
<table class="wrap2">
   <thead>
   <tr>
   </tr>

   <tr>

       <td colspan="2"><form action="index.php?page=listingPost" method="post"><br>Catégorie</td><td colspan="4"><?=$Categories->blockSelectCategorie(0,'categorie');?></td><td colspan="3"><input type="submit" name="filtrecat" value="FILTRER"><br></form></td>

   </tr>
   <tr>
   </tr>
   <tr>
   </tr>
   <tr>
   </tr>
    <tr>
        <th>id</th>
        <th>Title</th>
        <th>Content</th>
        <th>Auteur</th>
        <th>Note</th>
        <th>Nombre de note</th>
        <th>Nombre catégories</th>
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
            <td style="text-align: center"><a href="index.php?page=note&op=lire&id=<?=$article['id']?>" "><?php echo $infoNote[1];?></a> </td>
            <td style="text-align: center">
            <?php
                $nbCat = $Categories->compteCategoriesArticle($article['id']);
            $txtcat = $Categories->listeCategoriesArticle($article['id']);

                echo "<a href=\"\" onmouseOver=\"AffBulle('Categories associées', '".$txtcat."', 250)\" onmouseOut=\"HideBulle()\">".$nbCat."</a>";
            ?>

            </td>
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
