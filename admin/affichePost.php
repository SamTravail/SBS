<?php

require('../functions/pdo.php');
require('../includes/fonction.php');
require ('note.php');

 // Réccupération de l'ID
 if(!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];
// function getId($id) {
//     global $pdo;
    $sql = "SELECT * FROM articles WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $article = $query->fetch();

    if(empty($article)) {
        die('404');
     }
} else {
 die('404');
}

// Traitement PHP
// Création du tableau des erreurs
$errors = array();


include('../includes/header-back.php'); ?>

    <h1>Affichage d'un Article</h1>
    <form action="" method="post" novalidate class="wrap2">
        <label for="title">Titre</label>
        <h1><?php echo $article['title']; ?></h1>

        <label for="content">Contenu</label>
        <p style="background-color: lightgrey"><?php echo $article['content']; ?></p>

        <label for="auteur">Auteur</label>
        <p style="background-color: lightgrey"><?php echo $article['auteur']; ?></p>

        <?php
        $status = array(
            'draft' => 'Brouillon',
            'publish' => 'Publié'
        );

        ?>
        <label for="status">Status</label>
        <p style="background-color: lightgrey"><?php echo $status[$article['status']]?></p>
        <p><?php echo blockInfoNote($article['id']) ?></p>
        <?php
            $id_user=1; // SAM
            if(isset($id_user))
            {
             echo "<p>";
             echo blockNoter($article['id'],$id_user);
             echo "</p>";

            }

        ?>


        <input type="submit" name="submitted" value="Noter le Post !">
    </form>
<?php include('../includes/footer-back.php');?>