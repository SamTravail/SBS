<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SBS</title>

    <link rel="stylesheet" href="asset/css/style.css">
    <!--    INFOBULLE ---->
    <script type="text/javascript" src="asset/js/infobulle.js"></script>'
    <script type="text/javascript">InitBulle('lightgrey','white', 2);</script>

</head>
<body>
<header>
    <nav>
        <?php echo "<div id=\"container\" >\n"
            . "<div class=\"nav_left\"></div>\n"
            . "<div class=\"nav_holder\" >\n"
            . "<ul id=\"navigation\">\n"
            . "<li><a href=\"index.php\" > Articles</a></li>\n"
            . "<li><a href=\"index.php?page=admin&mode=admin\">Admin</a></li>\n"
            . "<li><a href=\"index.php?page=utilisateurs\">utilisateurs</a></li>\n"
            . "<li><a href=\"index.php?page=note&op=lireNotes\">Notes</a></li>\n"
            . "<li><a href=\"index.php?page=categories\">Categories</a></li>\n"
            . "<li><a href=\"index.php?page=commentaires\">Commentaires</a></li>\n"
            . "</ul>\n"
            . "</div>\n"
            . "</div>\n";

        ?>


    </nav>
</header>

<div id="content">
    <h1>Accueil</h1>

