<?php
global $pdo, $Roles, $Categories;

// Réccupération de l'ID
if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];
    }
    else{
        $id=0;
        }

      $sql = "SELECT * FROM categories WHERE id =:id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $categorie = $query->fetch();

    if (empty($categorie)) {
        die('404 2');
    }

// Traitement PHP
// Création du tableau des erreurs
$errors = array();

//Si il n'y a pas de submit,
if (!empty($_POST['submitted'])) {

    // Retrait des espaces,  Faille XSS
    $nom = trim(strip_tags($_POST['nom']));
    $id_parent = trim(strip_tags($_POST['id_parent']));

    // Vérification des champs pour validation
    $errors = validText($errors, $nom, 'nom', 1, 100);
    echo "-------------------".$id.$nom.$id_parent;
    // Si pas d'erreurs, alors :
    if (count($errors) === 0) {
        $Categories->updateCategorie($id, $nom, $id_parent);

        // retour apres injection

        //header('Location: index.php?page=categories');

        // Formulaire soumis !
        $success = true;
    }
}
?>

<h1>&Eacute;dition d'une Cat&eacute;gorie</h1>

<form action="index.php?page=editCategorie&id=<?= $categorie['id']; ?>" method="post" novalidate class="wrap2">
    <label for="id">Lib&eacute;l&eacute;</label>
    <input type="text" name="nom" id="nom" value="<?= $categorie['nom']; ?>"><br>
    <span class="error"><?php if (!empty($errors['nom'])) {
            echo $errors['nom'];
        } ?></span><br>
    <label for="id">Cat&eacute;gorie parente</label>
    <?php $Categories->blockSelectCategorie($categorie['id_parent'], 'parent') ?>
    <span class="error"><?php if (!empty($errors['id_parent'])) {
            echo $errors['id_parent'];
        } ?></span><br>

    <input type="hidden" name="id" value="<?= $id; ?>">
    <br><br><input type="submit" name="submitted" value="Modifier la cat&eacute;gorie">
</form><br>




