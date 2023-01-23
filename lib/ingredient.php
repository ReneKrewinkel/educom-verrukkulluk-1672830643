<?php

class ingredient {

    private $connection;

    public function __construct($connection, $article) {
        $this->connection = $connection;
        $this->article = $article; //functies van article class aanhalen 
    }
  
    public function selectIngredient($recipe_id) {
        $sql = "select * from ingredient where recipe_id = $recipe_id";
        $return = []; //lege array
        $result = mysqli_query($this->connection, $sql); 
        
        while ($ingredient = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $article_id = $ingredient["article_id"];
            $article = $this -> fetchArticle($article_id);
            $return [] = [              //lege array waar we ingredienten aan toevoegen obv article_id
                "id" => $ingredient ["id"],
                "number" => $ingredient ["number"],
                "name" => $article ["name"],
                "description" => $article ["description"],
                "price" => $article ["price"],
                "units" => $article ["units"],
                "package" => $article ["package"]
            ]; 
            
        }

        return($return);
    
    }

    private function fetchArticle($article_id){
        return ($this->article->selectArticle($article_id)); //ophalen artikel 
    
    }

}