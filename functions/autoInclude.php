<?php

function autoInclude(string $file): void {
    // Récupération de tous les fichiers du répertoire 'includes' qui ont la double extension .includes.php
    $includedFiles = glob("./includes/*.includes.php");
    // Concaténation du nom de fichier avec le chemin et l'extension
    $file = "./includes/" . $file . ".includes.php";

    // Si le nombre de fichiers dans le tableau est > 0 et que la chaîne de caractères $files est dans le tableau
    if (count($includedFiles) !== 0 && in_array($file, $includedFiles)) {
        require_once $file;
    } else {
        require_once './includes/accueil.includes.php';
    }
}
