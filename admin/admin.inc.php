<h1>Admin</h1>
<?php
$requete = 'SELECT * FROM utilisateurs order by id_utilisateur DESC';

$querySelect = new Sql();
$users = $querySelect->lister($requete);

if (count($users) == 0)
{
    echo "<h2>Aucun utilisateurs  dans votre base de donnée !</h2>";
    die();
}
?>
<table class="list-users">
    <thead>
    <th>Id</th>
    <th>Nom</th>
    <th>Prenom</th>
    <th>Email</th>
    <th></th>
    <th></th>
    </thead>
    <tbody>
    <?php
    foreach ($users as $user) {
        ?>
        <tr>
            <td><?= $user['id_utilisateur'] ?></td>
            <td><?= $user['nom'] ?></td>
            <td><?= $user['prenom'] ?></td>
            <td><?= $user['mail'] ?></td>
            <td><a href="index.php?page=edit&id=<?= $user['id_utilisateur'] ?>" class="btn">Editer</a></td>
            <td><a href="index.php?page=supp&id=<?= $user['id_utilisateur'] ?>" class="btn btn-supp" onclick="return confirm('Etes vous certain de supprimer cet utilisateur ?')">Supprimer</a></td>
        </tr>
        <?php
    }
    ?>

    </tbody>
</table>
