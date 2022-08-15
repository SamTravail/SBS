<form action="index.php?page=login" method="post" class="wrap2">
    <div>
        <label for="email">E-mail :</label>
        <input type="text" id="email" name="email" value="<?=$email?>" />
    </div>
    <div>
        <label for="mdp">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp" />
    </div>
    <div>
        <label for="mdp">Recuperation mot de passe:</label>
        <a href="index.php?page=frmMailMdp"> CLIQUEZ ICI</a>
    </div>
    
    <div>
        <input type="reset" value="Effacer" />
        <input type="submit" value="Se connecter" />
    </div>
    <input type="hidden" name="frmLogin" />
</form>