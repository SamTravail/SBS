<?php

// _________________________________________________________________________
// ************************  Importation des class *************************
// -------------------------------------------------------------------------
global $pdo, $Utilisateurs;
// _________________________________________________________________________

?>

<form action="index.php?page=inscription" method="post" class="wrap2">
    <div>
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?=$nom ?>"/>
    </div><br>
    <div>
        <label for="prenom">Pr&eacute;nom :</label>
        <input type="text" id="prenom" name="prenom" value="<?= $prenom ?>"/>
    </div><br>
    <div>
        <label for="email">E-mail :</label>
        <input type="text" id="email" name="email" value="<?= $email ?>"/>
    </div><br>
    <div>
        <label for="mdp1">Mot de passe :</label>
        <input type="password" id="mdp1" name="mdp1"/>
    </div><br>
    <div>
        <label for="mdp2">V&eacute;rification mot de passe :</label>
        <input type="password" id="mdp2" name="mdp2"/>
    </div><br>
    <div>
        <table><tr><td><input type="checkbox" name="cgu" id="cgu" value="1"<?= isset($_POST['cgu']) ? "checked" : ''; ?> /></td><td>
        <label for="cgu">J'acc&egrave;pte les <a href="index.php?page=cgu" target="_blank">Conditions G&eacute;n&eacute;rales
                d'Utilisation </a></label></td></tr></table>
    </div><br>
    <div>
        <input type="reset" value="Effacer"/><br><br>
        <input type="submit" value="Envoyer"/>
    </div>
    <input type="hidden" name="frmInscription"/>
</form><br>