<form action="index.php?page=login" method="post" class="wrap2">
    <div>
        <label for="email">E-mail :</label>
        <input type="text" id="email" name="email" value="<?=$email?>" />
    </div><br>
    <div>
        <label for="mdp">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp" />
    </div>
    <div>
        <a href="index.php?page=frmMailMdp"> Mote de passe oubli&eacute;</a>
    </div><br>
    <div>
        <input type="reset" value="Effacer" /><br><br>
        <input type="submit" value="Se connecter" />
    </div>
    <input type="hidden" name="frmLogin" />
</form><br>