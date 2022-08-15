<?php
global $pdo;
//require('includes/fonction.php');
require('includes/request.php');
?>

<h1>Dashboard</h1>
    <p>Interface accessible pour : Mod&eacute;rateurs, R&eacute;dacteur et Administrateurs.</p>
<ol>
    <li>- CRUD Utilisateur avec affectatiopn des droits</li>
    <p><a href="listingUtilisateurs.php">Listing Utilisateurs</a></p>
    <li>- CRUD des contenus en fonction des droits</li>
    <p><a href="index.php?mode=admin">Listing Post</a></p>
    <li>- Gestion des commentaires</li>
</ol>
<p><a href="index.php?page=newPost?mode=admin">Cr&eacute;er un article</a></p>
