<?php

// Importation des fonctions
require('../functions/pdo.php');
require('../includes/fonction.php');

// Selection dans la BDD articles, et affichage par date décroissante
$select_users = "SELECT * FROM utilisateurs ORDER BY id_utilisateur ASC";

// Préparation pour l'injection SQL
$query = $pdo->prepare($select_users);

// INJECTION SQL
$query->execute();

// Affiche le résultat
$users = $query->fetchAll();
?>

<?php

// Ajout du header-back pour retour index-back
include('../includes/header-back.php'); ?>

<!-- Création tu tableau pour affichage des utilisateurs -->
<h1>Liste des Utilisateurs</h1>
    <a href="index.php">Retour</a>
<table>
    <thead>
    <tr>
        <th>id</th>
        <th>Pr&eacute;nom</th>
        <th>Nom</th>
        <th>Pseudo</th>
        <th>Email</th>
        <th>Mot de passe</th>
        <th>R&ocirc;le</th>
    </tr>
    </thead>

    <!-- Affichage des éléments récuppérés dans le tableau -->
    <tbody>
    <?php foreach ($users as $user) { ?>
        <tr>
            <td><?= $user['id_utilisateur'] ?></td>
            <td><?= $user['prenom'] ?></td>
            <td><?= $user['nom'] ?></td>
            <td><?= $user['pseudo'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['mdp'] ?></td>
            <td><?= $user['role_id'] ?></td>
            <td><a href="editUtilisateur.php?id=<?= $user['id_utilisateur'] ?>">&Eacute;diter</a></td>
            <td><a href="suppUtilisateur.php?id=<?= $user['id_utilisateur'] ?>">Supprimer</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<form method="post" action="newUtilisateur.php">
<input type="submit" name="ajouter" value="Ajouter un utilisateur">
</form>
<?php include('../includes/footer.php');
