<?php

function genererUrl(string $entete, string $lienChamp, string $recupChamp, string $recupOrderby): string {
    if ($lienChamp === $recupChamp) {  
        if ($recupOrderby === 'asc')
            $orderby = 'desc';
        else 
            $orderby = 'asc';

    } else {
        $orderby = "asc";
    }
    
    $lien = "<a href=\"index.php?page=articlesAdmin&amp;";
    $lien .= "champ=$lienChamp&amp;";
    $lien .= "designation=$recupChamp&amp;";
    $lien .= "orderby=$orderby\">";
    $lien .= $entete;
    $lien .= "</a>";
    return $lien;
}
