<?php
global $pdo, $Categories, $Commentaires;
//require('includes/fonction.php');

// R�ccup�ration de l'ID
if(!empty($_GET['article']) && ctype_digit($_GET['article'])) {
    $id = $_GET['article'];
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

include('includes/note.inc.php');
?>
<h1>Affichage Article</h1>
<form class="wrap2">
    <label for="title">Titre</label>
    <h1><?php echo $article['title']; ?></h1>

    <label for="content">Contenu</label>
    <p style="background-color: lightgrey"><?php echo $article['content']; ?></p>

    <label for="auteur">Auteur</label>
    <p style="background-color: lightgrey"><?php echo $article['auteur']; ?></p>
    <?php
    $status = array(
        'draft' => 'Brouillon',
        'publish' => 'Publi�'
    );

    ?>
    <label for="status">Status</label>
    <p style="background-color: lightgrey"><?php echo $status[$article['status']]?></p>

    <label for="auteur">Categories associees</label>
    <p style="background-color: lightgrey"><?php echo $Categories->listeCategoriesArticle($article['id']); ?></p>

    <label for="auteur">Commentaires associees</label>
    <p style="background-color: lightgrey"><?php echo $Commentaires->listeCommentaires($article['id']); ?></p>

    <p><?php echo blockInfoNote($article['id']) ?></p>
    <?php
    $id_user=1; // SAM   $nivo = $Utilisateur->Role_id($id_utilisateur)  if(nivo > 3)
    if(isset($id_user))
    {
        echo "<p>";
        echo blockNoter($article['id'],$id_user);
        echo "</p>";

    }

    ?>
</form>



