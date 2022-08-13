<form action="index.php?page=login" method="post">
    <div>
        <label for="email">E-mail :</label>
        <input type="text" id="email" name="email" value="<?=$email?>" />
    </div>
    <div>
        <label for="mdp">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp" />
    </div>
    <div>
        <input type="reset" value="Effacer" />
        <input type="submit" value="Se connecter" />
    </div>
    <input type="hidden" name="frmLogin" />
</form>