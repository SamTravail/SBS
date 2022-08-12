<?php


// Réccupération de l'ID
if(!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];
}
    if(!empty($_GET['op'])){
        $op = $_GET['op'];
        if ($op=='edit'){
            //include('includes/header-back.php');
            editNote ($id);
            //include('includes/footer-back.php');
        }
        if ($op=='supp'){
            suppNote ($id);
        }
        if ($op=='lire') {
            //include('includes/header-back.php');
            $notes = lireNotes($id);
            afficheNotes($notes);
        }
        if ($op == 'lireNotes'){
            $notes = toutesLesNotes();
            afficheNotes($notes);
            }
    }

if(!empty($_POST['addNote'])) {
    $note = $_POST['note'];
    $id_article = $_POST['id_article'];
    $id_user = $_POST['id_user'];

    insertNote ($note, $id_article, $id_user);

    }



if(!empty($_POST['modifNote']))
    {
    $note = $_POST['note'];
    $id_note = $_POST['id_note'];
    updatetNote($note, $id_note);
        header('Location: index.php');
    }

// ------------------- lire-------------
function toutesLesNotes()
{
    global $pdo;
    // Selection dans la BDD Notes, et affichage par ordre décroissant
    $select_notes = "SELECT * FROM notes";
    $query = $pdo->prepare($select_notes);
    $query->execute();
    // Affiche le résultat
    $notes = $query->fetchAll();
    return $notes;
}

function lireNotes ($id_article){
    global $pdo;
    // Selection dans la BDD Notes, et affichage par ordre décroissant
    $select_notes = "SELECT * FROM notes  WHERE articles_id_articles=:id_article";
    $query = $pdo->prepare($select_notes);
    $query->bindValue(':id_article',$id_article, PDO::PARAM_INT);
    $query->execute();
    // Affiche le résultat
    $notes = $query->fetchAll();
    return $notes;
}
function lireNote ($id_note){
    global $pdo;
// Selection dans la BDD Notes, et affichage par ordre décroissant
    $select_note = "SELECT note FROM notes  WHERE id_note= :id_note";
    $query = $pdo->prepare($select_note);
    $query->bindValue(':id_note',$id_note, PDO::PARAM_INT);
    $query->execute();
// Affiche le résultat
    $note = $query->fetch();
    return $note['note'];
}

function blockInfoNote ($id_article){

    $infoNote=recupereNoteMoyenne($id_article);
?>
        <label>Informations note</label>
        <p style="background-color: lightgrey">Note : <?php echo $infoNote[0]; ?> / 5</p>
    <p style="background-color: lightgrey">Nombre de notes :<a href="index.php?page=note&op=lire&id=<?= $id_article ?>" ><?php echo $infoNote[1]; ?> </a></p>

<?php
}
function blockNoter ($id_article,$id_user){

    //$infoNote=recupereNoteMoyenne($id_article);
    ?>
    <label>Noter Article</label>
    <form action="index.php?page=note&op=noter" method="post" novalidate class="wrap2">

        <label for="note">Nouvelle note : </label>
        <select name="note" id="note">
            <?php
            $i=0;
            $note=3;
            for ($i;$i<=5;$i++){
                $opt='<option value="'.$i.'"';
                if ($i== $note)
                {
                    $opt=$opt." selected";
                }
                $opt=$opt.">".$i."</option>";
                echo $opt;
            }
            ?>
        </select>
        <input type="hidden" name="id_article" value="<?= $id_article; ?>">
        <input type="hidden" name="id_user" value="<?= $id_user; ?>">
        <input type="submit" name="addNote" value="Noter">
    </form><br>
    <?php
}



function afficheNotes ($notes){?>
    <h1>Liste des notes</h1>
    <table class="wrap2">
    <thead>
    <tr>
        <th>id_note</th>
        <th>note</th>
        <th>id_articles</th>
        <th>id_utilisateurs</th>
    </tr>
    </thead>

    <!-- Affichage des éléments récuppérés dans le tableau -->
    <tbody>
    <?php foreach ($notes as $note) { ?>
        <tr>
            <td><?= $note['id_note'] ?></td>
            <td><?= $note['note'] ?></td>
            <td><?= $note['articles_id_articles'] ?></td>
            <td><?= $note['utilisateurs_id_utilisateurs'] ?></td>

            <td><a href="index.php?page=note&id=<?= $note['id_note'] ?>&op=edit">Editer</a></td>
            <td><a href="index.php?page=note&id=<?= $note['id_note'] ?>&op=supp">Supprimer</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php
}


// ----------------- inserer une note
//$sql_insert= "INSERT INTO notes (id_note, note, articles_id_articles, utilisateurs_id_utilisateurs) VALUES (NULL, 2, 3, 3)";

function insertNote ($note, $id_article, $id_utilisateur): void
{
    global $pdo;
    $sql_insert="INSERT INTO notes (id_note, note, articles_id_articles, utilisateurs_id_utilisateurs) VALUES (NULL, :note, :id_article, :id_utilisateur)";
    // Préparation pour l'injection SQL
    $query = $pdo->prepare($sql_insert);
    $query->bindValue(':note',floatval($note), PDO::PARAM_INT);
    $query->bindValue(':id_article',$id_article, PDO::PARAM_INT);
    $query->bindValue(':id_utilisateur',$id_utilisateur, PDO::PARAM_INT);
    $query->execute();

}

// -------------------modifier la note
//$sql_update = "UPDATE notes SET note = 1 WHERE id_note = 2";
function updatetNote ($note, $id_note){
    global $pdo;
    $sql_update = "UPDATE notes SET note = :note WHERE id_note = :id_note";
    $query = $pdo->prepare($sql_update);
    $query->bindValue(':note',$note, PDO::PARAM_INT);
    $query->bindValue(':id_note',$id_note, PDO::PARAM_INT);
    $query->execute();
}


// ---------------- supprimer la note
//$sql_supp = "DELETE FROM notes WHERE id_note = 2";
function suppNote ($id_note){
    global $pdo;
    $sql_supp = "DELETE FROM notes WHERE id_note = :id_note";
    $query = $pdo->prepare($sql_supp);
    $query->bindValue(':id_note',$id_note, PDO::PARAM_INT);
    $query->execute();
}
//-------------------------------------------------------------------------------------------


// ---------compter les note d'un article
function compterLesNotes ($id_articles){

}

// ---------voir mes notes
function voirMesNotes ($id_utilisateurs){

}

// ---------moyenne d'un article
function moyenneArticle ($id_articles){
$moyenne = 0;
return $moyenne;
}
function recupereNoteMoyenne($id_article){
    $notes = lireNotes($id_article);
    $nbnotes = count($notes);
    $moyenne=0;
    if($nbnotes)
        {
        $total =0;
        foreach($notes as $note)
        {
            $total = $total + $note['note'];
        }
        $moyenne = $total / $nbnotes;
        }

    return array($moyenne, $nbnotes);



}




function editNote ($id_note){
    $note = lireNote($id_note);
    ?>
    <h1>Edition d'une note</h1>
    <form action="" method="post" novalidate class="wrap2">
        <label for="note">note actuelle : <?php echo $note; ?></label><br>
        <label for="note">Nouvelle note : </label>
        <select name="note" id="note">
            <?php
            $i=0;
            for ($i;$i<=5;$i++){
                $opt='<option value="'.$i.'"';
                if ($i== $note)
                    {
                        $opt=$opt." selected";
                    }
                $opt=$opt.">".$i."</option>";
                echo $opt;
            }
            ?>
        </select>


            <span class="error"><?php if(!empty($errors['id_utilisateur'])) { echo $errors['id_utilisateur']; } ?></span><br>


        <input type="hidden" name="id_note" value="<?= $id_note; ?>">
        <input type="submit" name="modifNote" value="Modifier la note">
    </form><br>
    <?php
}








