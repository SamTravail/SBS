<?php
global $pdo,$Roles;
//require('../functions/pdo.php');
//require('../includes/fonction.php');

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
    //echo "conf.$id";
    // Retrait des espaces,  Faille XSS
    $prenom = trim(strip_tags($_POST['prenom']));
    $nom = trim(strip_tags($_POST['nom']));
    $pseudo = trim(strip_tags($_POST['pseudo']));
    $email = trim(strip_tags($_POST['email']));
    $id_utilisateur = trim(strip_tags($_POST['id_utilisateur']));
    $role_id = trim(strip_tags($_POST['role_id']));
    //$mdp = trim(strip_tags($_POST['mdp']));

    // Vérification des champs pour validation
    $errors = validText($errors,$prenom,'prenom',1,100);
    $errors = validText($errors,$nom,'nom',1,100);
    $errors = validText($errors, $pseudo, 'pseudo',2,50);
    $errors = validText($errors, $email, 'email',5,20);
    $errors = validText($errors, $id_utilisateur, 'id_utilisateur',0,20);
    //$errors = validText($errors, $mdp, 'mdp',0,20);
    $errors = validText($errors, $role_id, 'role_id',0,20);
    
    // Si pas d'erreurs, alors :
    if(count($errors) === 0) {
        // Update dans la BDD
        //$mdp = password_hash($mdp, PASSWORD_DEFAULT);
        $sql2 = "UPDATE utilisateurs SET prenom= :prenom, nom= :nom, pseudo = :pseudo, email = :email, role_id= :role_id WHERE id_utilisateur= :id_utilisateur";

        $query = $pdo->prepare($sql2);

        // INJECTION SQL
        $query->bindValue(':id_utilisateur',$id, PDO::PARAM_INT);
        $query->bindValue(':prenom',$prenom, PDO::PARAM_STR);
        $query->bindValue(':nom',$nom, PDO::PARAM_STR);
        $query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
        $query->bindValue(':email',$email, PDO::PARAM_STR);
        $query->bindValue(':id_utilisateur',$id, PDO::PARAM_INT);

        $query->bindValue(':role_id',$role_id, PDO::PARAM_INT);
        $query->execute();

        // retour apres injection
        header('Location: index.php?page=utilisateurs');

        // Formulaire soumis !
       $success = true;
    }
}
 ?>

    <h1>&Eacute;dition d'un Utilisateur</h1>

    <form action="index.php?page=editUtilisateur&id=<?= $user['id_utilisateur']; ?>" method="post" novalidate class="wrap2">
        <label for="id_utilisateur">id_utilisateur</label>
        <input type="text" name="id_utilisateur" id="id_utilisateur" value="<?= $user['id_utilisateur']; ?>"><br>
        <span class="error"><?php if(!empty($errors['id_utilisateur'])) { echo $errors['id_utilisateur']; } ?></span><br>

        <label for="prenom">Pr&eacute;nom</label>
        <input type="text" name="prenom" id="prenom" value="<?= $user['prenom']; ?>">
        <span class="error"><?php if(!empty($errors['prenom'])) { echo $errors['prenom']; } ?></span><br><br>

        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" value="<?= $user['nom']; ?>">
        <span class="error"><?php if(!empty($errors['nom'])) { echo $errors['nom']; } ?></span><br><br>

        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" value="<?= $user['pseudo']; ?>">
        <span class="error"><?php if(!empty($errors['pseudo'])) { echo $errors['pseudo']; } ?></span><br><br>

        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?= $user['email']; ?>">
        <span class="error"><?php if(!empty($errors['email'])) { echo $errors['email']; } ?></span><br><br>

        
        <label for="mdp">R&ocirc;le SELECT</label>

        <select name="role_id" id="role_id">
            <?php
            $roles=$Roles->lister();
            $i=0;
            $note=$user['role_id'];
            foreach ($roles as $role){
                $opt='<option value="'.$i.'"';
                if ($i== $note)
                {
                    $opt=$opt." selected";
                }
                $opt=$opt.">".$role['titre']."</option>";
                echo $opt;
                $i++;
            }
            ?>
        </select>
        <span class="error"><?php if(!empty($errors['role_id'])) { echo $errors['role_id']; } ?></span>

        <input type="hidden" name="id" value="<?= $id; ?>">
        <br><br><input type="submit" name="submitted" value="Modifier l'utilisateur">
    </form><br>




