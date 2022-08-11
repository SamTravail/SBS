<?php
global $pdo, $Roles, $Categories;

// Réccupération de l'ID
if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];

// function getId($id) {

    $sql = "SELECT * FROM categories WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $categorie = $query->fetch();

    if (empty($categorie)) {
        die('404 2');
    }
} else {
    die('404 1');
}

// Traitement PHP
// Création du tableau des erreurs
$errors = array();

//Si il n'y a pas de submit,
if (!empty($_POST['submitted'])) {

    // Retrait des espaces,  Faille XSS
    $nom = trim(strip_tags($_POST['nom']));

    // Vérification des champs pour validation
    $errors = validText($errors, $nom, 'nom', 1, 100);

    // Si pas d'erreurs, alors :
    if (count($errors) === 0) {

        // Update dans la BDD
        $sql2 = "UPDATE categories SET nom= :nom WHERE id= :id";
        $query = $pdo->prepare($sql2);
        // INJECTION SQL
        $query->bindValue(':id',$id, PDO::PARAM_INT);
        $query->bindValue(':nom', $nom, PDO::PARAM_STR);
        $query->execute();

        // retour apres injection
        header('Location: index.php?page=categories');

        // Formulaire soumis !
        $success = true;
    }
}
?>

<h1>Edition d'une Catégorie</h1>

<form action="index.php?page=editCategorie&id=<?= $categorie['id']; ?>" method="post" novalidate class="wrap2">
    <label for="id">nom</label>
    <input type="text" name="nom" id="nom" value="<?= $categorie['nom']; ?>"><br>
    <span class="error"><?php if (!empty($errors['nom'])) {
            echo $errors['nom'];
        } ?></span><br>

    <input type="hidden" name="id" value="<?= $id; ?>">
    <br><br><input type="submit" name="submitted" value="Modifier la catégorie' !">
</form><br>




