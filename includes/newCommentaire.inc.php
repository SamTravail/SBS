<?php

global $pdo, $Commentaires, $users, $Articles;
// Traitement PHP

// init de la soumission a false
$success = false;

// creation du tableau des erreurs
$errors = array();

//Si il y a un submit,
if (!empty($_POST['addCom'])) {

    // Retrait des espaces,  Faille XSS
    if (!empty($_POST['id_article']) && ctype_digit($_POST['id_article'])) {
        $id_article = $_POST['id_article'];
    }
    if (!empty($_POST['id_utilisateur']) && ctype_digit($_POST['id_utilisateur'])) {
        $id_utilisateur = $_POST['id_utilisateur'];
    }

    $titre = trim(strip_tags($_POST['titre']));
    $description = trim(strip_tags($_POST['description']));

    // Vérification des champs pour validation
    $errors = validText($errors, $titre, 'titre', 1, 30);
    $errors = validText($errors, $description, 'description', 1, 250);

    // Si pas d'erreurs, alors :
    if (count($errors) === 0) {
        // die('ok');
        // Update dans la BDD
        $Commentaires->addCommentaire($id_article, $id_utilisateur, $titre, $description);

        // retour apres injection
        header('Location: index.php?page=commentaires');

        // Formulaire soumis !
        $success = true;
    }
}else{
    if (!empty($_GET['id_article']) && ctype_digit($_GET['id_article'])) {
        $id_article = $_GET['id_article'];
        }
    if (!empty($_POST['id_utilisateur']) && ctype_digit($_POST['id_utilisateur'])) {
        $id_utilisateur = $_POST['id_utilisateur'];
        }

    $titre = 'titre';
    $description = 'description';


    ?>


    <form action="index.php?page=newCommentaire" method="post" novalidate class="wrap2">
        <label for="nom">Titre</label>
        <input type="text" name="titre" id="titre" placeholder="<?= $titre; ?>">
        <label for="id">Description</label>
        <textarea name="description" id="description" cols="30" rows="10"><?= $description; ?></textarea><br>





        <label for="id">Article</label>

        <?php
        // nom article preselect ou menu deroulant des articles
        if (isset($id_article)) {
            $nomArticle = $Articles->lireNomArticle($id_article);
            echo "<label>" . $nomArticle . "</label>";
        } else {
            $Articles->blockSelectArticle(0, "article");
        }
        ?>
        <label for="id">Utilisateur</label>
        <?php

        if (isset($id_utilisateur)) {
            //$nomUtilisateur = $Utilisateurs->lireNomUtilisateur($id_utilisateur);
            //echo "<label>".$nomUtilisateur."</label>";
        } else {
            //$Utilisateurs->blockSelectUtilisateur(0,"nom");
        }




        ?>


        <input type="hidden" name="id_utilisateur" value="1">
        <input type="submit" name="addCom" value="Créer un Commentaire">
    </form><br>
<?php }
?>

