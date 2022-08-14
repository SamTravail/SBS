<?php

//******************************* Formulaire associer a un article une categorie
global $pdo, $Roles, $Categories,$Articles;

// Réccupération de l'ID de l'article pour associer une categorie
if (!empty($_GET['id_article']) && ctype_digit($_GET['id_article'])) {
    $id_article = $_GET['id_article'];
}
if (!empty($_GET['categorie']) && ctype_digit($_GET['categorie'])) {
    $categorie = $_GET['categorie'];
}
if (!empty($_POST['associe'])) {
    // Retrait des espaces,  Faille XSS
    $id_article = trim(strip_tags($_POST['id_article']));
    $categorie = trim(strip_tags($_POST['categorie']));
    $Categories->addCategorieArticle($id_article, $categorie);
// retour apres injection
    header("Location: index.php?page=editPost&id=$id_article");
    }
?>
<h1>Associer un article a une categorie</h1>
<form action="index.php?page=articleCategories" method="post" novalidate class="wrap2">
    <label for="id">Articles</label>
    <?php
    if (isset($id_article))
    {
        $nom = $Articles->lireNomArticle($id_article);
        echo $nom;
        echo '<input type="hidden" name="id_article" value="'.$id_article.'">';
    }
    else
    {
    $Articles->blockSelectArticle(0,'article');
    }?>
    <label for="id">Categories existantes</label>
    <?php
    $Categories->blockSelectCategorie(0,'categorie');
    ?>
    <br><br><input type="submit" name="associe" value="Associer Cat&eacute;gorie">
</form><br>