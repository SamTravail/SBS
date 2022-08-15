<?php

// APPEL DES VARIABLES GLOBAL
global $pdo, $Commentaires, $Articles, $Categories;


//************************* Recupere id pour edition
if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];

    $commentaire = $Commentaires->lireCommentaire($id);

    // Création du tableau des erreurs
    $errors = array();

    //Si il y a submit,
    if (!empty($_POST['modifCom'])) {

        // Retrait des espaces,  Faille XSS
        $titre = trim(strip_tags($_POST['titre']));
        $description = trim(strip_tags($_POST['description']));

        // Vérification des champs pour validation
        $errors = validText($errors, $titre, 'titre', 3, 100);
        $errors = validText($errors, $description, 'description', 10, 1000);

        // Si pas d'erreurs, alors :
        if (count($errors) === 0) {
            // die('ok');
            // Update dans la BDD
            $Commentaires->updateCommentaire($id, $titre, $description);
            header('Location: index.php?page=commentaires');

        }
    } ?>
    <h1>&Eacute;dition du commentaire</h1>
    <form method="post" novalidate class="wrap2" action="index.php?page=editCommentaires&id=<?= $id; ?>">
        <label for="title">Titre</label>
        <input type="text" name="titre" id="titre" value="<?= $commentaire['titre']; ?>"><br>
        <span class="error"><?php if (!empty($errors['titre'])) {
                echo $errors['titre'];
            } ?></span>

        <label for="description">Description</label>
        <textarea name="description" id="description" cols="30"
                  rows="10"><?= $commentaire['description']; ?></textarea><br>
        <span class="error"><?php if (!empty($errors['description'])) {
                echo $errors['description'];
            } ?></span>

        <label>Date du commentaire : <?= $commentaire['date_commentaires'] ?></label>

        <?php $titleArticle = $Articles->lireNomArticle($commentaire['articles_id_articles']); ?>
        <label>Article
            associ&eacute; <?php echo "<a href=\"\" onmouseOver=\"AffBulle('Article', '" . $titleArticle . "', 250)\" onmouseOut=\"HideBulle()\">" . $commentaire['articles_id_articles'] . "</a>"; ?></label>
        <label>Utilisateur
            associ&eacute; <?php echo "<a href=\"\" onmouseOver=\"AffBulle('Utilisateur', '" . $titleArticle . "', 250)\" onmouseOut=\"HideBulle()\">" . $commentaire['articles_id_articles'] . "</a>"; ?></label>

        <input type="submit" name="modifCom" value="Modifier le commentaire">
    </form>


    <?php
} else {
    die('404');
} ?>