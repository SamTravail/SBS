<?php
require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');


$title = "Homepage";

include('inc/header.php'); ?>

    <h1>Home page FRONT</h1>

    <div>

        <?php include('publishPost.php') ?>

    </div>



<?php include('inc/footer.php');