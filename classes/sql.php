<?php

class Sql
{
    private string $serverName = "localhost";
    private string $userName = "root";
    private string $userPassword = "";
    private string $database = "sbs";
    private object $connexion;

    public function __construct()
    {
        try {
            $this->connexion = new PDO("mysql:host=$this->serverName;dbname=$this->database", $this->userName, $this->userPassword);
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC);
        }

        catch(PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function inserer($query)
    {
        $this->connexion->exec($query);
    }

    public function lister($query)
    {
        $resultat = $this->connexion->prepare($query);
        $resultat->execute();
        return $resultat->fetchAll();
    }

    public function supprimer($query,$idUser)
    {
        $resultat = $this->connexion->prepare($query);
        $resultat->bindValue(':id',$idUser,PDO::PARAM_INT);
        $resultat->execute();
    }

    public function __destruct()
    {
        if(isset($this->connexion))
            $this->connexion = null;
    }
}