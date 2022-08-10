<?php
if(!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];
    echo 'article id=' . $id;
}
include "./admin/listeArticle.php?id='$id'";
?>
<h2>Page 1 article INC</h2>
