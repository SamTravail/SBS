<?php

function verifierUtilisateur($email) {
    if ($pdo = pdo()) {
        $sql = "SELECT COUNT(*) FROM utilisateurs WHERE email='$email'";
        $reponse = $pdo->query($sql);
        $nbreLigne = $reponse->fetchColumn();
        if ($nbreLigne > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
