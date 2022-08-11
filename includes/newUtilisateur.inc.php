<?php

global $pdo;
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
    $prenom = trim(strip_tags($_POST['prenom']));
    $nom = trim(strip_tags($_POST['nom']));
    $pseudo = trim(strip_tags($_POST['pseudo']));
    $email = trim(strip_tags($_POST['email']));
    $mdp = trim(strip_tags($_POST['mdp']));

    // Vérification des champs pour validation
    $errors = validText($errors,$prenom,'prenom',1,100);
    $errors = validText($errors,$nom,'nom',1,100);
    $errors = validText($errors, $pseudo, 'pseudo',2,50);
    $errors = validText($errors, $email, 'email',5,20);
    $errors = validText($errors, $mdp, 'mdp',0,20);
    // Si pas d'erreurs, alors :
    if(count($errors) === 0) {
        // die('ok');
        // Update dans la BDD
        $sql2 = "INSERT INTO utilisateurs (prenom, nom, pseudo, email, mdp) VALUES (:prenom, :nom, :pseudo, :email, :mdp)";
        $query = $pdo->prepare($sql2);

        // INJECTION SQL
        $query->bindValue(':prenom',$prenom, PDO::PARAM_STR);
        $query->bindValue(':nom',$nom, PDO::PARAM_STR);
        $query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
        $query->bindValue(':email',$email, PDO::PARAM_STR);
        $query->bindValue(':mdp',$mdp, PDO::PARAM_STR);
        $query->execute();

        // retour apres injection
        header('Location: index.php?page=utilisateurs');

        // Formulaire soumis !
        $success = true;
?>
        <h1>Création d'un Utilisateur</h1>
    <form action="" method="post" novalidate class="wrap2">
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" value="<?= $prenom; ?>">
        <span class="error"><?php if(!empty($errors['prenom'])) { echo $errors['prenom']; } ?></span>

        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" value="<?= $nom; ?>">
        <span class="error"><?php if(!empty($errors['nom'])) { echo $errors['nom']; } ?></span>

        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" value="<?= $pseudo; ?>">
        <span class="error"><?php if(!empty($errors['pseudo'])) { echo $errors['pseudo']; } ?></span>

        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?= $user['email']; ?>">
        <span class="error"><?php if(!empty($errors['email'])) { echo $errors['email']; } ?></span>

        <label for="mdp">Mot de passe</label>
        <input type="text" name="mdp" id="mdp" value="<?= $user['mdp']; ?>">
        <span class="error"><?php if(!empty($errors['mdp'])) { echo $errors['mdp']; } ?></span>

        <input type="submit" name="submitted" value="Créer un utilisateur' !">
    </form><br>
<?php
    }
}else{
    $prenom = 'prenom';
    $nom = 'nom';
    $pseudo = 'pseudo';
    $email = '';
    $mdp = '';
?>


<form action="index.php?page=newUtilisateur" method="post" novalidate class="wrap2">
    <label for="prenom">Prénom</label>
    <input type="text" name="prenom" id="prenom" placeholder="<?= $prenom; ?>">

    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom" placeholder="<?= $nom; ?>">

    <label for="pseudo">Pseudo</label>
    <input type="text" name="pseudo" id="pseudo" placeholder="<?= $pseudo; ?>">

    <label for="email">Email</label>
    <input type="text" name="email" id="email" placeholder="<?= $email; ?>">

    <label for="mdp">Mot de passe</label>
    <input type="text" name="mdp" id="mdp" placeholder="<?= $mdp; ?>">

    <input type="submit" name="submitted" value="Créer un utilisateur' !">
</form><br>
<?php }
?>

