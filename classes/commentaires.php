<?php

class Commentaires
{
    private array $commentaires;
    private array $tab_id_commentaires;
    private string $sql_select = "SELECT id, titre, description, articles_id_articles, utilisateurs_id_utilisateur, date_commentaires FROM commentaires ORDER BY date_commentaires DESC ";
    private string $sql_update = "UPDATE commentaires SET titre= :titre, description= :description WHERE id= :id";
    private string $sql_delete = "DELETE FROM commentaires WHERE id = :id";
    private string $sql_insert_commentaires_article = "INSERT INTO commentaires (articles_id_articles, utilisateurs_id_utilisateur, titre, description) VALUES (:id_article, :id_utilisateur, :titre, :description)";
    private string $sql_commentaires_article = "SELECT * FROM commentaires WHERE articles_id_articles=:id_article";

    //private object $pdo;
    private object $query;
    private array $nomCommentaires;
    private array $commentairesArticle;

    public function __construct()
    {
        global $pdo;

        $this->query = $pdo->prepare($this->sql_select);
        $this->query->execute();
        $this->commentaires = $this->query->fetchAll();

    }
    public function compteCommentaires($id_article)
    {
        global $pdo;
        $this->query = $pdo->prepare($this->sql_commentaires_article);
        $this->query->bindValue(':id_article',$id_article, PDO::PARAM_INT);
        $this->query->execute();
        $this->commentairesArticle = $this->query->fetchAll();

        return count($this->commentairesArticle);

    }
    public function addCommentaire($id_article,$id_utilisateur,$titre,$description): void
    {
        global $pdo;
        $this->query = $pdo->prepare($this->sql_insert_commentaires_article);
        $this->query->bindValue(':id_article',$id_article, PDO::PARAM_INT);
        $this->query->bindValue(':id_utilisateur',$id_utilisateur, PDO::PARAM_INT);
        $this->query->bindValue(':titre',$titre, PDO::PARAM_STR);
        $this->query->bindValue(':description',$description, PDO::PARAM_STR);
        $this->query->execute();


    }

    //============================================= obtient une chaine de texte des titres commentaires
    public function listeCommentaires($id_article)
    {
        $nbcom = $this->compteCommentaires($id_article);
        if($nbcom !=0) {
            $txtcom='';
            foreach ($this->commentairesArticle as $commentaire) {
                $idcom = $commentaire['id'];
                $txt = $this->lireTitreCommentaire($idcom);
                $txtcom = $txtcom . $txt . "<br>";
            }
        }
        else {  $txtcom="pas de texte !";
        }

        return $txtcom;
    }

    public function lireCommentaire($id_commentaire)
    {
        foreach ($this->commentaires as $commentaire) {
            $idcom = $commentaire['id'];
            if($idcom == $id_commentaire)
            {
                return $commentaire;
            }
        }
        return NULL;
    }

    public function lireCommentaires()
    {
        return $this->commentaires;
    }

    public function lireCommentairesArticle($id_article)
    {
        $nbcom = $this->compteCommentaires($id_article);

        return $this->commentairesArticle;
    }


    public function suppCommentaire($id)
    {
        global $pdo;
        $this->query = $pdo->prepare($this->sql_delete);
        $this->query->bindValue(':id',$id, PDO::PARAM_INT);
        $this->query->execute();


    }


    public function updateCommentaire($id,$titre,$description)
    {
        global $pdo;
        $this->query = $pdo->prepare($this->sql_update);
        // INJECTION SQL
        $this->query->bindValue(':id', $id, PDO::PARAM_INT);
        $this->query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $this->query->bindValue(':description', $description, PDO::PARAM_STR);
        $this->query->execute();
    }

    public function lireTitreCommentaire($id_commentaire)
    {
        $done = false;
        foreach ($this->commentaires as $commentaire) {
            if ($commentaire['id'] == $id_commentaire) {
                $done = true;
                return $commentaire['titre'];
            }
        }

        if ($done == false) return "";

    }

    public function blockSelectCommentaires($default,$element)
    {
        echo '<select name="commentaire" id="id">';

        foreach ($this->commentaires as $commentaire) {
            $opt = '<option value="' . $commentaire['id'] . '"';
            if ($commentaire['id'] == $default) {
                $opt = $opt . " selected";
            }
            $opt = $opt . ">" . $commentaire['titre'] . "</option>";
            echo $opt;
        }

        ?>
        </select>
        <?php
    }
}
