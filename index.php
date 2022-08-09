<?php
require('functions/pdo.php');
require('includes/fonction.php');
require('includes/request.php');


$title = "Homepage";

include('includes/header.php'); ?>

    <h1>Home page FRONT</h1>

    <div>

        <?php include('publishPost.php') ?>

    </div>



<?php include('includes/footer.php');