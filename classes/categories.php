<?php

class Categories
{
    private array $categories;
    private array $tab_id_categories;
    private string $sql_select = "SELECT * FROM categories ORDER BY nom ASC";
    private string $sql_select_categorie = "SELECT * FROM categories WHERE id= :id";
    private string $sql_insert = "INSERT INTO categories (nom, id_parent) VALUES (:nom, :id_parent)";

    private string $sql_update = "UPDATE categories SET nom= :nom, id_parent= :id_parent  WHERE id= :id";
    private string $sql_delete = "DELETE FROM categories WHERE id = :id";
    private string $sql_insert_categorie_article = "INSERT INTO articles_has_categories (articles_id_articles, categories_id) VALUES (:id_article, :id_cat)";
    private string $sql_categories_article = "SELECT * FROM articles_has_categories WHERE articles_id_articles=:id_article";

    //private object $pdo;
    private object $query;
    private array $nomCategories;


    public function __construct()
    {
        global $pdo;

        //$this->pdo = $pdo;
        $this->query = $pdo->prepare($this->sql_select);
        $this->query->execute();
        $this->categories = $this->query->fetchAll();

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
    public function addCategorieArticle($id_article,$categorie): void
    {
        global $pdo;
        $this->query = $pdo->prepare($this->sql_insert_categorie_article);
        $this->query->bindValue(':id_article',$id_article, PDO::PARAM_INT);
        $this->query->bindValue(':id_cat',$categorie, PDO::PARAM_INT);
        $this->query->execute();


    }


        public function listeCategoriesArticle($id_article)
    {
        $nbcat = $this->compteCategoriesArticle($id_article);
        if($nbcat !=0) {
            $txtcat='';
            foreach ($this->tab_id_categories as $idcatA) {
                $idcat = $idcatA['categories_id'];
                $cat = $this->lireCategorie($idcat);
                $id_parent = $cat['id_parent'];
                $txtcat = $this->lireNomCategorie($idcat);
                //$txtcat = $txtcat . $txt . "<br>";
                while($id_parent !=0)
                {
                    //echo "parent trouve";
                    $cat_parent = $this->lireCategorie($id_parent);
                    $nomparent = $cat_parent['nom'];
                    $txtcat =$nomparent.' - '.$txtcat;
                    $id_parent = $cat_parent['id_parent'];
                }
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
    public function lireCategorie($categorie_id)
    {
        global $pdo;
        $this->query = $pdo->prepare($this->sql_select_categorie);
        // INJECTION SQL
        $this->query->bindValue(':id', $categorie_id, PDO::PARAM_INT);
        $this->query->execute();
        $categorie = $this->query->fetch();
        return $categorie;
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

   
   
   
   
    public function blockSelectCategorie($default,$element)
    {
        if ($element == "categorie"){
            echo '<select name="categorie" id="categorie">';
        }else{
            echo '<select name="id_parent" id="id_parent">';
        }

            foreach ($this->categories as $categorie) {
                $id_parent=$categorie['id_parent'];
                $id_orig = $categorie['id'];
                $nomcat = $categorie['nom'];
                while($id_parent !=0)
                    {
                        echo "parent trouve";
                        $cat_parent = $this->lireCategorie($id_parent);
                        $nomparent = $cat_parent['nom'];
                        $nomcat =$nomparent.' - '.$nomcat;
                        $id_parent = $cat_parent['id_parent'];
                    }
                

                $opt = '<option value="' . $id_orig . '"';
                if ($id_orig == $default) {
                    $opt = $opt . " selected";
                }
                $opt = $opt . ">" . $nomcat . "</option>";
                echo $opt;
            }

            ?>
        </select>
        <?php
    }
}
