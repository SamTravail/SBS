<?php

function autoLoad(string $pattern) {
    $fullPath = __DIR__ . "/" . $pattern;
    $fichiersFonctionsPHP = glob($fullPath);

    if ($fichiersFonctionsPHP !== false) {
        for ($i = 0 ; $i < count($fichiersFonctionsPHP) ; $i++) {
            if ($fichiersFonctionsPHP[$i] !== "./functions/autoLoad.php")
                require_once $fichiersFonctionsPHP[$i];
        }

    } else {
        return false;
    }
}
