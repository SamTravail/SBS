<?php

require('../functions/pdo.php');
require('../includes/fonction.php');

 // Réccupération de l'ID
 if(!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];

// function getId($id) {
    global $pdo;
    $sql = "SELECT * FROM utilisateurs WHERE id_utilisateur = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $user = $query->fetch();


    if(empty($user)) {
        die('404 2');
     }
} else {
 die('404 1');
}

// Traitement PHP
// Création du tableau des erreurs
$errors = array();

//Si il n'y a pas de submit,
if(!empty($_POST['submitted'])) {
    echo "conf.$id";
    // Retrait des espaces,  Faille XSS
    $prenom = trim(strip_tags($_POST['prenom']));
    $nom = trim(strip_tags($_POST['nom']));
    $pseudo = trim(strip_tags($_POST['pseudo']));
    $email = trim(strip_tags($_POST['email']));
    $id_utilisateur = trim(strip_tags($_POST['id_utilisateur']));
    $role_id = trim(strip_tags($_POST['role_id']));
    $mdp = trim(strip_tags($_POST['mdp']));

    // Vérification des champs pour validation
    $errors = validText($errors,$prenom,'prenom',1,100);
    $errors = validText($errors,$nom,'nom',1,100);
    $errors = validText($errors, $pseudo, 'pseudo',2,50);
    $errors = validText($errors, $email, 'email',5,20);
    $errors = validText($errors, $id_utilisateur, 'id_utilisateur',0,20);
    $errors = validText($errors, $mdp, 'mdp',0,20);
    $errors = validText($errors, $role_id, 'role_id',0,20);
    
    // Si pas d'erreurs, alors :
    if(count($errors) === 0) {
        // Update dans la BDD

        $sql2 = "UPDATE utilisateurs SET prenom= :prenom, nom= :nom, pseudo = :pseudo, email = :email, mdp= :mdp, role_id= :role_id WHERE id_utilisateur= :id_utilisateur";

        $query = $pdo->prepare($sql2);

        // INJECTION SQL
        $query->bindValue(':id_utilisateur',$id, PDO::PARAM_INT);
        $query->bindValue(':prenom',$prenom, PDO::PARAM_STR);
        $query->bindValue(':nom',$nom, PDO::PARAM_STR);
        $query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
        $query->bindValue(':email',$email, PDO::PARAM_STR);
        $query->bindValue(':id_utilisateur',$id, PDO::PARAM_INT);
        $query->bindValue(':mdp',$mdp, PDO::PARAM_STR);
        $query->bindValue(':role_id',$role_id, PDO::PARAM_INT);
        $query->execute();

        // retour apres injection
        header('Location: listingUtilisateurs.php');

        // Formulaire soumis !
       $success = true;
    }
}
include('../includes/header-back.php'); ?>

    <h1>&Eacute;dition d'un Utilisateur</h1>
    <a href="listingUtilisateurs.php">Retour</a>
    <form action="" method="post" novalidate class="wrap2">
        <label for="id_utilisateur">id_utilisateur</label>
        <input type="text" name="id_utilisateur" id="id_utilisateur" value="<?= $user['id_utilisateur']; ?>"><br>
        <span class="error"><?php if(!empty($errors['id_utilisateur'])) { echo $errors['id_utilisateur']; } ?></span><br>

        <label for="prenom">Pr&eacute;nom</label>
        <input type="text" name="prenom" id="prenom" value="<?= $user['prenom']; ?>">
        <span class="error"><?php if(!empty($errors['prenom'])) { echo $errors['prenom']; } ?></span>

        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" value="<?= $user['nom']; ?>">
        <span class="error"><?php if(!empty($errors['nom'])) { echo $errors['nom']; } ?></span>

        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" value="<?= $user['pseudo']; ?>">
        <span class="error"><?php if(!empty($errors['pseudo'])) { echo $errors['pseudo']; } ?></span>

        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?= $user['email']; ?>">
        <span class="error"><?php if(!empty($errors['email'])) { echo $errors['email']; } ?></span>

        <label for="mdp">Mot de passe</label>
        <input type="text" name="mdp" id="mdp" value="<?= $user['mdp']; ?>">
        <span class="error"><?php if(!empty($errors['mdp'])) { echo $errors['mdp']; } ?></span>

        <label for="mdp">Role SELECT</label>


        <input type="text" name="role_id" id="role_id" value="<?= $user['role_id']; ?>">
        <span class="error"><?php if(!empty($errors['role_id'])) { echo $errors['role_id']; } ?></span>

        <input type="hidden" name="id" value="<?= $id; ?>">
        <input type="submit" name="submitted" value="Modifier l'utilisateur">
    </form><br>


<?php include('../includes/footer.php');?>

