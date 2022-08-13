<?php

class Articles
{
    public array $articles;
    public array $articlesdate;
    public array $articlescategorie;
    public array $tab_articles_categorie;
    private string $sql_select = "SELECT * FROM articles ORDER BY title ASC";
    private string $sql_select_lastdate = "SELECT * FROM articles ORDER BY created_at DESC";

    private string $sql_select_article = "SELECT * FROM articles WHERE id = :id";


    private string $sql_delete = "DELETE FROM articles WHERE id = :id";
    private string $sql_insert = "INSERT INTO categories (nom, id_parent) VALUES (:nom, :id_parent)";

    private string $sql_categories_article = "SELECT * FROM articles_has_categories WHERE articles_id_articles=:id_article";
    private string $sql_articles_categorie = "SELECT articles_id_articles FROM articles_has_categories WHERE categories_id=:id_categorie";
    //private object $pdo;
    private object $query;
    private array $nomCategories;

    public function __construct()
    {
        global $pdo;
        //$this->pdo = $pdo;
        $this->query = $pdo->prepare($this->sql_select);
        $this->query->execute();
        $this->query->fetchAll();

        $this->articles = $this->query->fetchAll();
        $this->lireArticleDate();
    }

    public function lireArticlesCategorie($id_categorie)
    {
        global $pdo;
        $this->query = $pdo->prepare($this->sql_articles_categorie);
        $this->query->bindValue(':id_categorie',$id_categorie, PDO::PARAM_INT);
        $this->query->execute();
        $tab_articles_categorie = $this->query->fetchAll();
        //echo "**************** COUNT TAB ****".count($tab_articles_categorie);
        foreach ($tab_articles_categorie as $id_article)
        {
           $articles_categorie[] = $this->lireArticle($id_article['articles_id_articles']);
        }
        return $articles_categorie;
    }

    public function lireArticle($id_article)
    {
        global $pdo;

        $this->query = $pdo->prepare($this->sql_select_article);
        $this->query->bindValue(':id',$id_article, PDO::PARAM_INT);
        $this->query->execute();
        return $this->query->fetch();
    }
    public function lireArticleDate()
    {
        global $pdo;
        //$this->pdo = $pdo;
        $this->query = $pdo->prepare($this->sql_select_lastdate);
        $this->query->execute();
        $this->articlesdate = $this->query->fetchAll();
    }
    public function compteCategoriesArticle($id_article)
    {
        global $pdo;
        $this->query = $pdo->prepare($this->sql_categories_article);
        $this->query->bindValue(':id_article',$id_article, PDO::PARAM_INT);
        $this->query->execute();
        $this->tab_id_categories = $this->query->fetchAll();

        return count($this->tab_id_categories);

    }
    public function listeCategoriesArticle($id_article)
    {
        $nbcat = $this->compteCategoriesArticle($id_article);
        if($nbcat !=0) {
            foreach ($this->tab_id_categories as $idcatA) {
                $idcat = $idcatA['categories_id'];
                $txtcat = $this->lireNomCategorie($idcat);
                $txtcat = $txtcat . "<br>";
            }
        }
        else {  $txtcat="Aucune";
        }

        return $txtcat;
    }



        public function suppCategorie($id)
    {
        global $pdo;
        $this->query = $pdo->prepare($this->sql_delete);
        $this->query->bindValue(':id',$id, PDO::PARAM_INT);
        $this->query->execute();


    }

    public function ajouteCategorie($nom, $id_parent)
    {
        global $pdo;
        $this->query = $pdo->prepare($this->sql_insert);
        $this->query->bindValue(':nom',$nom, PDO::PARAM_STR);
        $this->query->bindValue(':id_parent',$id_parent, PDO::PARAM_STR);
        $this->query->execute();


    }
    public function updateCategorie($id,$nom,$id_parent)
    {
        global $pdo;
        //$this->query = "UPDATE categories SET nom= :nom WHERE id= :id";
        $this->query = $pdo->prepare($this->sql_update);
        // INJECTION SQL
        $this->query->bindValue(':id', $id, PDO::PARAM_INT);
        $this->query->bindValue(':nom', $nom, PDO::PARAM_STR);
        $this->query->bindValue(':id_parent', $id_parent, PDO::PARAM_INT);
        $this->query->execute();
    }

    public function lireNomArticle($id_article)
    {

        $done = false;
        foreach ($this->articles as $article) {
            if ($article['id'] == $id_article) {
                $done = true;
                return $article['title'];
            }
        }

        if ($done == false) return "";

    }
    public function lireNomCategorie($categorie_id)
    {
        $done = false;
        foreach ($this->categories as $categorie) {
            if ($categorie['id'] == $categorie_id) {
                $done = true;
                return $categorie['nom'];
            }
        }

        if ($done == false) return "";

    }

    public function blockSelectArticle($default,$element)
    {
        if ($element == "article"){
            echo '<select name="id_article" id="id_article">';
        }else{
            echo '<select name="id_parent" id="id_parent">';
        }

            foreach ($this->articles as $article) {
                $opt = '<option value="' . $article['id'] . '"';
                if ($article['id'] == $default) {
                    $opt = $opt . " selected";
                }
                $opt = $opt . ">" . $article['title'] . "</option>";
                echo $opt;
            }

            ?>
        </select>
        <?php
    }
}
