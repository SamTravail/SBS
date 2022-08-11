<?php

class Commentaires
{
    private array $commentaires;
    private array $tab_id_commentaires;
    private string $sql_select = "SELECT id, titre, description, date_commentaires FROM commentaires ORDER BY date_commentaires ASC";
    private string $sql_update = "UPDATE commentaires SET titre= :titre, description= :description, date_commentaires= :date_commentaires WHERE id= :id";
    private string $sql_delete = "DELETE FROM commentaires WHERE id = :id";
    //private string $sql_insert_categorie_article = "INSERT INTO articles_has_categories (articles_id_articles, categories_id) VALUES (:id_article, :id_cat)";
    //private string $sql_categories_article = "SELECT * FROM articles_has_categories WHERE articles_id_articles=:id_article";

    //private object $pdo;
    private object $query;
    private array $nomCommentaires;


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
        $this->query = $pdo->prepare($this->sql_commentaires);
        $this->query->bindValue(':id',$id, PDO::PARAM_INT);
        $this->query->execute();
        $this->tab_id_commentaires = $this->query->fetchAll();

        return count($this->tab_id_commentaires);

    }
    public function addCommentaires($id_article,$id_utilisateur): void
    {
        global $pdo;
        $this->query = $pdo->prepare($this->sql_insert_commentaires_article);
        $this->query->bindValue(':id_article',$id_article, PDO::PARAM_INT);
        $this->query->bindValue(':id',$id_utilisateur, PDO::PARAM_INT);
        $this->query->execute();


    }


    public function listeCommentaires($id_article)
    {
        $nbcom = $this->compteCommentairesArticle($id_article);
        if($nbcom !=0) {
            $txtcom='';
            foreach ($this->tab_id_commentaires as $beresineA) {
                $idcom = $beresineA['commentaires_id'];
                $txt = $this->lireTitreCommentaire($idcom);
                $txtcom = $txtcom . $txt . "<br>";
            }
        }
        else {  $txtcom="pas de texte !";
        }

        return $txtcom;
    }



    public function suppCommentaires($id)
    {
        global $pdo;
        $this->query = $pdo->prepare($this->sql_delete);
        $this->query->bindValue(':id',$id, PDO::PARAM_INT);
        $this->query->execute();


    }

    public function ajouteCommentaire($id_article, $id_utilsateur)
    {
        global $pdo;
        $this->query = $pdo->prepare($this->sql_insert);
        $this->query->bindValue(':id_article',$id_article, PDO::PARAM_INT);
        $this->query->bindValue(':id_utilsateur',$id_utilsateur, PDO::PARAM_INT);
        $this->query->execute();


    }
    public function updateCommentaires($id,$id_article,$id_utilsateur)
    {
        global $pdo;
        $this->query = $pdo->prepare($this->sql_update);
        // INJECTION SQL
        $this->query->bindValue(':id', $id, PDO::PARAM_INT);
        $this->query->bindValue(':id_article', $id_article, PDO::PARAM_INT);
        $this->query->bindValue(':id_utilsateur', $id_utilsateur, PDO::PARAM_INT);
        $this->query->execute();
    }

    public function lireTitreCommentaires($id_article)
    {
        $done = false;
        foreach ($this->commentaires as $commentaire) {
            if ($commentaire['id'] == $id) {
                $done = true;
                return $commentaire['titre'];
            }
        }

        if ($done == false) return "";

    }

    public function blockSelectCommentaires($default,$element)
    {
        echo '<select name="commentaire" id="id">';

        foreach ($this->commentaire as $commentaire) {
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
