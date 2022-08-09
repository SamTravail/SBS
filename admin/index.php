<?php
require('../inc/pdo.php');
require('../inc/fonction.php');
require('../inc/request.php');


include('inc/header-back.php'); ?>

<h1>Dashboard</h1>
    <p>Interface accessible pour : Modérateurs, Rédacteur et Administrateurs.</p>
<ol>
    <li>- CRUD Utilisateur avec affectatiopn des droits</li>
    <p><a href="listingRole.php">Listing Roles</a></p>
    <li>- CRUD des contenus en fonction des droits</li>
    <p><a href="listingPost.php">Listing Post</a></p>
    <li>- Gestion des commentaires</li>
</ol>
<p><a href="newpost.php">New Post</a></p>




<?php include('inc/footer-back.php');