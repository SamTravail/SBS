<?php

class Sql
{
    // ---------------- Définition des paramètres pour accès à la BDD --------------
    private string $serverName = "localhost";
    private string $userName = "root";
    private string $userPassword = "";
    private string $database = "alibobo";
    private object $connexion;


    // ----------- fonction construct permet d'instancier un nouvel objet PDO -------
    public function __construct()
    {
        try {
            $this->connexion = new PDO("mysql:host=$this->serverName;dbname=$this->database", $this->userName, $this->userPassword);
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch(PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    // ---------------- 
    public function inserer(string $sql, bool $bind = false, array $bindArray): bool
    {
        if ($bind) {
            $query = $this->connexion->prepare($sql);

            foreach($bindArray as $key => $value) {
                $query->bindParam(":$key", $value[0], $value[1]);
            }

            if ($query->execute())
                return true;
            else
                return false;
        } else {
            if ($this->connexion->exec($sql))
                return true;
            else
                return false;
        }
    }

    // créer une fonction select de type public, qui prend 2 paramètres (une variable $sql en chaine de caractère,
    // et une variable $count qui est boolean et qui a la valeur false par defaut): les deux points retourne soit un tableau | soit un entier
    public function select(string $sql, bool $count = false): array|int
    {
        if (!$count)
        {
            $resultat = $this->connexion->query($sql)->fetchAll();
            return $resultat;
        }
        else {
            $nbrResultat = $this->connexion->query($sql)->fetchColumn();
            return $nbrResultat;
        }
    }

    public function update (string $sql, $bind): bool
    {
 
    }

    public function delete(string $sql): bool
    {
        $resultatDelete = $this->connexion->prepare($sql)->execute();
        if ($resultatDelete->rowCount() > 0)
            return true;
        else
            return false;
    }
    
    public function __destruct()
    {   
        if (isset($this->connexion))
            $this->connexion = null;
    }
}