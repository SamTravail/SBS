<?php 
global $pdo, $Categories,$Articles;

if(!empty($_POST['filtrecat']))
{
    $filtreCat = $_POST['categorie'];
    echo "Filtre : ".$filtreCat;
    $articles = $Articles->lireArticlesCategorie($filtreCat);
    echo "Nbarticle : ".count($articles);
    $catflt = $filtreCat;

}else{
    $articles = $Articles->articlesdate;
    $catflt = 0;
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

       <td colspan="2"><form action="index.php?page=listingPost" method="post"><br>Catégorie</td><td colspan="4"><?=$Categories->blockSelectCategorie($catflt,'categorie');?></td><td colspan="3"><input type="submit" name="filtrecat" value="FILTRER"><br></form></td>

   </tr>
   <tr>
   
   
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
            <td colspan="9"><a href="index.php?page=article&article=<?=$article['id']?>"><b> Titre : <?=$article['title']?></b></a></td>
            </tr>
            <tr>
            <td colspan="9"><?=$article['content']?></td>  
            </tr>
            <tr>
            <td colspan="3">ID : <?=$article['id']?></td>
            <td colspan="3">Auteur : <?=$article['auteur']?></td>
            <td colspan="3">Moyenne : <?php
                $infoNote =  recupereNoteMoyenne($article['id']);echo $infoNote[0];?> /5 </td>
                </tr><tr>
            <td colspan="3" style="text-align: left">Nb notes : <a href="index.php?page=note&op=lire&id=<?=$article['id']?>" "><?php echo $infoNote[1];?></a> </td>
            <td colspan="3" style="text-align: left">
            <?php
                $nbCat = $Categories->compteCategoriesArticle($article['id']);
            $txtcat = $Categories->listeCategoriesArticle($article['id']);

                echo "Catégories associées : <a href=\"\" onmouseOver=\"AffBulle('Categories associ&eacute;es', '".$txtcat."', 250)\" onmouseOut=\"HideBulle()\">".$nbCat."</a>";
            ?>

            </td>
            <td colspan="3">Etat : <?=$article['status']?></td>
            </tr><tr style="background-color: #DDDD;">
            <td colspan="3">&nbsp; </td>
            <td colspan="3"></td>
            <td colspan="3">
                <?php
                //******************************** Verif du role pour les boutons Editer Supprime */
                if(isset($_SESSION['role_id']))
                    {
                    if ($_SESSION['role_id'] > 2)
                        { ?>
                            <a href="index.php?page=editPost&id=<?=$article['id']?>">&nbsp;   &Eacute;diter   </a>
                     &nbsp; &nbsp; &nbsp; 
                <a href="index.php?page=suppPost&id=<?= $article['id'] ?>">Supprimer</a>
                        <?php
                        }
                    }
                    ?>
            

            </td>

        </tr>
        <tr>
   </tr>
   <tr>
   </tr>
        <?php } ?>
        <a id="back2Top" title="Back to top" href="#">&#10148;</a>
    </tbody>
</table>
    <form method="post" action="index.php?page=newPost" class="wrap2">
        <input type="submit" name="Ajouter" value="Cr&eacute;er un article">
    </form>
