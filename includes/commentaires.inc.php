<?php

// APPEL DES VARIABLES GLOBAL
global $pdo, $Commentaires, $Articles, $Categories;

// R�ccup�ration de l'ID
//************************* Recupere id article pour edition
if(!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];

    $commentaire = $Commentaires->lireCommentaire($id);

    ?>
    <h1>Affichage du commentaire</h1>
    <form class="wrap2">
        <label for="title">Titre</label>
        <h1><?php echo $commentaire['titre']; ?></h1>

        <label for="content">Contenu</label>
        <p style="background-color: lightgrey"><?php echo $commentaire['description']; ?></p>


    </form>




<?php
    }
else
{
    $commentaires = $Commentaires->lireCommentaires();
?>
    <h1>Liste des commentaires</h1>

<table class="wrap2">
   <thead>
    <tr>
        <th>id</th>
        <th>Titre</th>
        <th>Description</th>
        <th>Date</th>
        <th>Article</th>
        <th>Utilisateur</th>
    </tr>
   </thead>

    <!-- affichage des �l�ments r�cupp�r�s dans le tableau -->
    <tbody>

        <?php
        $impaire=false;
        foreach ($commentaires as $commentaire) { ?>
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
            <td><?=$commentaire['id']?></td>
            <td><a href="index.php?page=commentaires&id=<?=$commentaire['id']?>"><?=$commentaire['titre']?></a></td>
            <td><?=$commentaire['description']?></td>
            <td><?=$commentaire['date_commentaires']?></td>

            <td>
            <?php
            $titleArticle = $Articles->lireNomArticle($commentaire['articles_id_articles']);

            //$nomUtilisateur = $utilisateurs->lireNomUtilisateur($commentaire['utilisateurs_id_utilisateur']);

                echo "<a href=\"\" onmouseOver=\"AffBulle('Article associé', '".$titleArticle."', 250)\" onmouseOut=\"HideBulle()\">".$commentaire['articles_id_articles']."</a>";
            // echo "<a href=\"\" onmouseOver=\"AffBulle('Utilisateur associ�', '".$nomUtilisateur."', 250)\" onmouseOut=\"HideBulle()\">".$commentaire['utilisateurs_id_utilisateur']."</a>";

            ?>

            </td>
            <td><?=$commentaire['utilisateurs_id_utilisateur']?></td>
            <td><a href="index.php?page=editCommentaires&id=<?=$commentaire['id']?>">&Eacute;diter</a></td>
            <td><a href="index.php?page=suppCommentaire&id=<?= $commentaire['id'] ?>">Supprimer</a></td>

        </tr>
        <?php } ?>

    </tbody>
</table>
    <form method="post" action="index.php?page=newCommentaire" class="wrap2">
        <input type="submit" name="ajouter" value="Créer un commentaire">
    </form>


<?php
}
?>

