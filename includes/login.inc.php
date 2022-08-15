<h1>Login</h1>

<?php
global $Utilisateurs, $pdo;
if (isset($_POST['frmLogin'])) {
    $email = isset($_POST['email']) ? htmlentities(trim($_POST['email'])) : "";
    $mdp = isset($_POST['mdp']) ? htmlentities(trim($_POST['mdp'])) :  "";

    $erreurs = array();

    if (mb_strlen($email) === 0)
        array_push($erreurs, "Veuillez saisir une adresse mail");
    
    elseif (!(filter_var($email, FILTER_VALIDATE_EMAIL)))
        array_push($erreurs, "Veuillez saisir une adresse conforme");

    if (mb_strlen($mdp) === 0)
        array_push($erreurs, "Veuillez saisir un mot de passe");
    
    if (count($erreurs) > 0) {
        $messageErreurs = "<ul>";

        for ($i = 0 ; $i < count($erreurs) ; $i++) {
            $messageErreurs .= "<li>";
            $messageErreurs .= $erreurs[$i];
            $messageErreurs .= "</li>";
        }

        $messageErreurs .= "</ul>";

        echo $messageErreurs;

        require 'includes/frmLogin.php';

        //$insertionSql = new Sql();

    } else {
        if ($Utilisateurs->verifierLogin($email,$mdp)) {
            $recupDatasUser = "SELECT * FROM utilisateurs WHERE email='$email'";
            if (isset($pdo)) {
                $datasUser = $pdo->query($recupDatasUser);
                $datasUser = $datasUser->fetchAll();
                $_SESSION['prenom'] = $datasUser[0]['prenom'];
                $_SESSION['nom'] = $datasUser[0]['nom'];
                $_SESSION['role_id'] = $datasUser[0]['role_id'];
                $_SESSION['user_id'] = $datasUser[0]['id_utilisateur'];
            }

            $_SESSION['login'] = true;
            echo "<script>window.location.replace('https://localhost/sbs/index.php')</script>";
        } else {
            echo "Erreur dans votre login/password";
        }
    }

} else {
    $email = "";
    require 'includes/frmLogin.php';
}
