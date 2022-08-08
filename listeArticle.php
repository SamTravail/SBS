<?php

require('inc/pdo.php');
require('inc/fonction.php');

// Réccupération de l'ID
if(!empty($_GET['article']) && ctype_digit($_GET['article'])) {
    $id = $_GET['article'];
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

include('inc/header.php'); ?>

<h1>Affichage Article</h1>
<table class="listeArticle" style="border: 1px solid red">
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