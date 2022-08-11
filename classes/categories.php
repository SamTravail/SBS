<?php

class Categories
{
    private array $categories;
    private string $sql = "SELECT nom, id FROM categories ORDER BY nom ASC";
    private object $pdo;
    private object $query;
    private array $nomCategories;

    public function __construct()
    {
        global $pdo;

        $this->pdo = $pdo;
        $this->query = $this->pdo->prepare($this->sql);
        $this->query->execute();
        $this->categories = $this->query->fetchAll();

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

    public function blockSelectCategorie($default)
    {
        ?>
        <select name="categorie" id="categorie">
            <?php

            foreach ($this->categories as $categorie) {
                $opt = '<option value="' . $categorie['id'] . '"';
                if ($categorie['id'] == $default) {
                    $opt = $opt . " selected";
                }
                $opt = $opt . ">" . $categorie['nom'] . "</option>";
                echo $opt;
            }

            ?>
        </select>
        <?php
    }
}
