<?php

class Utilisateurs
{
    public array $utilisateurs;
    public array $utilisateurNom;
    public array $utilisateurRole_id;

    private string $sql_select = "SELECT * FROM utilisateurs ORDER BY nom ASC";
    private string $sql_select_roles = "SELECT * FROM utilisateurs ORDER BY role_id DESC";
    private string $sql_select_utilisateur = "SELECT * FROM utilisateurs WHERE id_utilisateur = :id";

    private string $sql_insert = "INSERT INTO utilisateurs (nom, prenom, email, mdp) VALUES (:nom, :prenom, :email, :mdp)";

    private string $sql_update = "UPDATE utilisateurs SET prenom= :prenom, nom= :nom, pseudo= :pseudo, email= :email, mdp= :mdp, role_id= :role_id WHERE id_utilisateur= :id";

    private string $sql_delete = "DELETE FROM utilisateurs WHERE id = :id";


    public function __construct()
    {
        global $pdo;

        $this->query = $pdo->prepare($this->sql_select);
        $this->query->execute();
        
        $this->utilisateurs = $this->query->fetchAll();
    }

    public function LireNomUtilisateur($id_utilisateur)
    {
        global $pdo;

        $this->query = $pdo->prepare($this->sql_select_utilisateur);
        $this->query->bindValue(':id', $id_utilisateur, PDO::PARAM_INT);
        $this->query->execute();
        
        $utilisateur = $this->query->fetch();
        return $utilisateur['nom'];
    }


    //****************************** V�rification ****************************

    function verifierUtilisateur($email) {
        global $pdo;
        if (isset($pdo)) {
            $sql = "SELECT COUNT(*) FROM utilisateurs WHERE email='$email'";
            $reponse = $pdo->query($sql);
            $nbreLigne = $reponse->fetchColumn();
            if ($nbreLigne > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    function verifierLogin($email, $motdepasse) {
        global $pdo;
        if (isset($pdo)) {
            if ($this->verifierUtilisateur($email)) {
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

    // **************************** Inscription ***************************

    function inscrireUtilisateur(string $nom, string $prenom, string $email, string $mdp): bool {
        $mdp = password_hash($mdp, PASSWORD_DEFAULT);

        global $pdo;
        if (isset($pdo)) {

            $this->query = $pdo->prepare($this->sql_insert);
            $this->query->bindValue(':nom', $nom, PDO::PARAM_STR);
            $this->query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
            $this->query->bindValue(':email', $email, PDO::PARAM_STR);
            $this->query->bindValue(':mdp', $mdp, PDO::PARAM_STR);
            $this->query->execute();
            return true;
        } else {
            return false;
        }

    }
    function sendEmail($toEmail, $fromEmail, $sujetEmail, $messageEmail): void
    {
        $to      = $toEmail;
        $subject = $sujetEmail;
        $message = $messageEmail;
        $headers = 'From: ' . $fromEmail .'' . "\r\n" .
            'Reply-To: ' . $fromEmail .'' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message , $headers);
    }

}
