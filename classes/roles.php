<?php

class Roles
{
    private array $roles;
    private string $sql = "SELECT titre FROM roles ORDER BY id_roles ASC";
    private object $pdo;
    private object $query;

    public function __construct()
    {
        global $pdo;

        $this->pdo = $pdo;
        $this->query = $this->pdo->prepare($this->sql);
        $this->query->execute();
        $this->roles = $this->query->fetchAll();
    }

    public function lireNomRole_id($role_id)
    {
        return $this->roles[$role_id]['titre'];

    }

    public function lister()
    {

        return $this->roles;
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
            $this->roles = null;
    }
}
