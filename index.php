<?php

session_start();

// Fonction permettant le chargement automatique des classes
spl_autoload_register(function ($className) {
    require_once './classes/' . $className . '.php';
});

require_once './functions/autoInclude.php';

require('functions/pdo.php');
require('includes/fonction.php');
require('includes/request.php');

$Utilisateurs = new Utilisateurs();
$Commentaires = new Commentaires();
$Articles = new Articles();
$Categories = new Categories();
$Roles = new Roles();
$roles = $Roles->lister();
$role_id = 2;

$title = "Homepage";
if (isset($_GET['mode'])) {
    $mode = $_GET['mode'];
    if ($mode == 'admin') {
        include('includes/header-back.php');
    } else {
        include('includes/header.php');
    }
} else {
    include('includes/header.php');
}

?>

    <div>
        <?php
        require_once './includes/main.php';

        ?>
    </div>

<?php include('includes/footer.php');
