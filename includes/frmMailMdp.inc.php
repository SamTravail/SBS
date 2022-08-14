<?php

global $Utilisateurs, $pdo;

if (isset($_POST['frmMailMdp'])) {
    $email = isset($_POST['email']) ? htmlentities(trim($_POST['email'])) : "";
    $recupDatasUser = "SELECT * FROM utilisateurs WHERE email='$email'";
    if (isset($pdo)) {
        $datasUser = $pdo->query($recupDatasUser);
        $datasUser = $datasUser->fetchColumn();
        if($datasUser !=0)
        {
            $fromEmail= "test@test.fr";
            $sujetEmail="RENVOI DE MOT DEPASSE";
            $messageEmail = "Cliquez sur ce lien pour definir nouveau mot de passe";
            $Utilisateurs->sendEmail($email, $fromEmail, $sujetEmail, $messageEmail);
        }
        else{
            echo "Mail non reconnu, utilisateur non inscrit";
        }

}
}
    ?>
<form action="index.php?page=frmMailMdp" method="post" class="wrap2">
    <div>
        <label for="email">E-mail :</label>
        <input type="text" id="email" name="email" value=""/>
    </div>
    <div>
        <input type="submit" value="Envoyer le mail"/>
    </div>
    <input type="hidden" name="frmMailMdp"/>
</form>