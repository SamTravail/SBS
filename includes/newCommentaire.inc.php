<?php

global $pdo, $Commentaires, $Utilisateurs, $Articles;
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
    if (!empty($_POST['id_parent']) && ctype_digit($_POST['id_parent'])) {
        $id_parent = $_POST['id_parent'];
    }
    $titre = trim(strip_tags($_POST['titre']));
    $description = trim(strip_tags($_POST['description']));

    // V�rification des champs pour validation
    $errors = validText($errors, $titre, 'titre', 1, 30);
    $errors = validText($errors, $description, 'description', 1, 250);

    // Si pas d'erreurs, alors :
    if (count($errors) === 0) {
        // die('ok');
        // Update dans la BDD
        if(isset($id_parent))
        {
            echo "-------reponse----------------idparent ---".$id_parent;
            $Commentaires->repCommentaire($id_article, $id_utilisateur, $titre, $description, $id_parent);
        }
        else{
            $Commentaires->addCommentaire($id_article, $id_utilisateur, $titre, $description);
        }

        // retour apres injection
        //header('Location: index.php?page=commentaires');

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
    else{
        if (!empty($_SESSION['user_id'])) $id_utilisateur = $_SESSION['user_id'];
    }
    if (!empty($_GET['id_com']) && ctype_digit($_GET['id_com'])) {
            $id_com = $_GET['id_com'];
            
            $com = $Commentaires->lireCommentaire($id_com);
            $titre = $com['titre'];
            }
            else{
                $titre = 'titre';
            }
        
    $description = 'description';


    ?>


    <form action="index.php?page=newCommentaire" method="post" novalidate class="wrap2">
        <label for="nom">Titre</label>
        <?php
        if(isset($id_com)){
            echo $titre;
            echo '<input type="hidden" name="id_parent" value="'.$id_com.'">';
            echo '<input type="hidden" name="titre" value="'.$titre.'">';
        }
        else{
            echo '<input type="text" name="titre" id="titre" placeholder="'.$titre.'">';
        }
        ?>
        <label for="id">Description</label>
        <textarea name="description" id="description" cols="30" rows="10"><?= $description; ?></textarea><br>

        <label for="id">Article</label>

        <?php
        // nom article preselect ou menu deroulant des articles
        if (isset($id_article)) {
            $nomArticle = $Articles->lireNomArticle($id_article);
            echo "<label>" . $nomArticle . "</label>";
            echo '<input type="hidden" name="id_article" value="'.$id_article.'">';
        } else {
            $Articles->blockSelectArticle(0, "article");
        }
        ?>
        <label for="id">Utilisateur</label>
        <?php

        if (isset($id_utilisateur)) {
            $nomUtilisateur = $Utilisateurs->lireNomUtilisateur($id_utilisateur);
            echo "<label>".$nomUtilisateur."</label>";
        } else {
            //$Utilisateurs->blockSelectUtilisateur(0,"nom");
        }




        ?>


        <input type="hidden" name="id_utilisateur" value="1">
        <?php
        if(isset($id_com)){

            echo '<input type="submit" name="addCom" value="Répondre au Commentaire">';
        }
        else{
            echo '<input type="submit" name="addCom" value="Créer un Commentaire">';
        }
        ?>
    </form><br>
<?php }
?>

