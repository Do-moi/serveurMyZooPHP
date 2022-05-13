<?php
require_once "./models/model.php";

class AnimauxManager extends Model{
    
    public function __construct()
    {
        
    }
    public function getAnimaux(){
        $req = "SELECT * from animal";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $animaux;
    }
    public function deleteDBAnimalContinent($idAnimal){
        $req= "DELETE from animal_continent WHERE animal_id= :idAnimal";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idAnimal",$idAnimal,PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        
    }
    public function deleteDBAnimal($idAnimal){
        $req= "DELETE from animal WHERE animal_id= :idAnimal";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idAnimal",$idAnimal,PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        
    }
    
    public function createAnimal($nomAnimal,$descriptionAnimal, $imgAnimal,$familleAnimal){
        $req= "INSERT into animal (animal_nom, animal_description, animal_image, famille_id) values(:nom,:description,:img,:familleId)";
        $stmt = $this->getBdd()->prepare($req);
       
        $stmt->bindValue(":nom",$nomAnimal,PDO::PARAM_STR);
        $stmt->bindValue(":description",$descriptionAnimal,PDO::PARAM_STR);
        $stmt->bindValue(":img",$imgAnimal,PDO::PARAM_STR);
        $stmt->bindValue(":familleId",$familleAnimal,PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        return $this->getBdd()->lastInsertId();


    }
    public function getAnimal($idAnimal){
        $req= "SELECT a.animal_id, animal_nom, animal_description, animal_image, a.famille_id, continent_id from animal a 
        inner join famille f on a.famille_id= f.famille_id 
        left join animal_continent ac on ac.animal_id = a.animal_id
        WHERE a.animal_id = :idAnimal";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue("idAnimal",$idAnimal,PDO::PARAM_INT);
        $stmt->execute();
        $animal = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $animal;
    }
    public function updateAnimal($idAnimal, $nomAnimal, $descriptionAnimal, $imgAnimal, $familleAnimal){
        $req = "UPDATE animal 
        set animal_nom = :nom , animal_description = :description, animal_image = :img, famille_id = :familleId
        WHERE animal_id = :idAnimal";
         $stmt = $this->getBdd()->prepare($req);
         $stmt->bindValue("nom",$nomAnimal,PDO::PARAM_STR);
         $stmt->bindValue("description",$descriptionAnimal,PDO::PARAM_STR);
         $stmt->bindValue("img",$imgAnimal,PDO::PARAM_STR);
         $stmt->bindValue("familleId",$familleAnimal,PDO::PARAM_INT);
         $stmt->bindValue("idAnimal",$idAnimal,PDO::PARAM_INT);
         $stmt->execute();
         $stmt->closeCursor();
         
    }
    public function getImageAnimal($idAnimal){
        

        $req = "SELECT animal_image from animal where animal_id = :idAnimal";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue("idAnimal",$idAnimal,PDO::PARAM_INT);
        $stmt->execute();
        $image = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        return $image['animal_image'];
    }

}