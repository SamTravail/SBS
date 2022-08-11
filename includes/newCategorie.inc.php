<?php

global $pdo,$Categories,$Roles,$users;
//require('../functions/pdo.php');
//require('../includes/fonction.php');
//include('../includes/header-back.php');

// Traitement PHP

// init de la soumission a false
$success = false;

// creation du tableau des erreurs
$errors = array();

//Si il y a un submit,
if(!empty($_POST['submitted'])) {


    // Retrait des espaces,  Faille XSS

    $nom = trim(strip_tags($_POST['nom']));
    $id_parent = trim(strip_tags($_POST['id_parent']));

    // Vérification des champs pour validation
    $errors = validText($errors,$nom,'nom',1,100);
    // Si pas d'erreurs, alors :
    if(count($errors) === 0) {
        // die('ok');
        // Update dans la BDD
        $Categories->ajouteCategorie($nom,$id_parent);

        // retour apres injection
        header('Location: index.php?page=categories');

        // Formulaire soumis !
        $success = true;
    }
}else{

    $nom = 'nom';
    $categorie['id_parent'] = 0;


?>


<form action="index.php?page=newCategorie" method="post" novalidate class="wrap2">
    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom" placeholder="<?= $nom; ?>">
    <label for="id">id_parent</label>
    <?php $Categories->blockSelectCategorie($categorie['id_parent'],'parent') ?>
    <span class="error"><?php if (!empty($errors['id_parent'])) {
            echo $errors['id_parent'];
        } ?></span><br>


    <input type="submit" name="submitted" value="Créer une Catégorie">
</form><br>
<?php }
?>

