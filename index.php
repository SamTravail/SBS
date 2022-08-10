<?php

session_start();

// Fonction permettant le chargement automatique des classes
//spl_autoload_register(function ($className) {
//    require_once './classes/' . $className . '.php';
//});

//require_once './functions/autoLoad.php';
require_once './functions/autoInclude.php';
//autoLoad("*.php");


require('functions/pdo.php');
require('includes/fonction.php');
require('includes/request.php');


$title = "Homepage";

include('includes/header.php');
require_once './includes/main.php';
?>

    <h1>Home page FRONT</h1>

    <div>

        <?php
        if(isset($_GET['page']))
            {
            $page = $_GET['page'];
            }
        else{
            $page = 'article';
            }
        if($page == 'article') {
            $action="";
            if(isset($_GET['action'])) $action = $_GET['action'];
            if($action == 'lireArticle')
                {
                    if(isset($_GET['id']))
                    {
                        $id = $_GET['id'];
                        echo "Chemin : ".$_SERVER["PHP_SELF"];
                        //$lien = './admin/affichePost.php?id=13';
                        $lien ='./admin/listingPost.php';
                        include $lien;
                    }

                }




            //include('./admin/listingPost.php');




            }



            //        include('publishPost.php')
 ?>

    </div>



<?php include('includes/footer.php');