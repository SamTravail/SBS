<?php

global $pdo;

require('includes/fonction.php');

// Réccupération de l'ID
if(!empty($_GET['article']) && ctype_digit($_GET['article'])) {
    $id = $_GET['article'];
// function getId($id) {
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

//include('../includes/header.php');
include('note.php');
?>
<h1>Affichage Article</h1>

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


<table class="wrap2">
    <thead>
    <tr>
        <td><h1><?php echo $article['title'];?></h1><br></td>
    </tr>
    <tr>
        <td><p><?php echo $article['content'];?></p><br></td>
    </tr>
    <tr>
        <td><h4><?php echo $article['auteur'];?></h4><br></td>
    </tr>
    <tr>
        <td><h5><?php echo $article['status'];?></h5></td>
    </tr>
    </thead>
</table>
