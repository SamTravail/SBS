<?php

function verifierLogin($email, $motdepasse) {
    if ($pdo = pdo()) {
        if (verifierUtilisateur($email)) {
            $recupMdp = "SELECT mdp FROM utilisateurs WHERE email='$email'";
            $resultRecupMdp = $pdo->query($recupMdp);
            $mdpBDD = $resultRecupMdp->fetchAll();
            $mdpBDD = $mdpBDD[0]['mdp'];

            if (password_verify($motdepasse, $mdpBDD)) 
                return true;
            else 
                return false;

        } else {
            return false;
        }
    } else {
        return false;
    }
}
