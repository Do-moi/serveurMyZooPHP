<?php
require_once "./models/model.php";

class ContinentsManager extends Model{
    
    
    public function getContinents(){
        $req = "SELECT * from continent";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $continents = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        // echo "<pre>";
        //    echo $continents[0]['continent_id'];
        //    echo "</pre>";
            
        return $continents;
    }
    
    public function addContinentAnimal($idAnimal, $idContinent){
        $req= "INSERT into animal_continent (animal_id,continent_id) values(:animalId,:continentId)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":animalId",$idAnimal,PDO::PARAM_INT);
        $stmt->bindValue(":continentId",$idContinent,PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        
    }
    public function deletedDBContinentAnimal($idAnimal, $idContinent){
        $req = "DELETE from animal_continent
        WHERE animal_id = :idAnimal and continent_id = :idContinent";
          $stmt = $this->getBdd()->prepare($req);
          $stmt->bindValue(":idAnimal",$idAnimal,PDO::PARAM_INT);
          $stmt->bindValue(":idContinent",$idContinent,PDO::PARAM_INT);
          $stmt->execute();
          $stmt->closeCursor();
    }
    public function verificationExistAnimalContinent($idAnimal,$idContinent){
        $req = "SELECT count(*) as 'nb'
        from animal_continent ac
        WHERE ac.animal_id = :idAnimal and ac.continent_id = :idContinent";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idAnimal",$idAnimal,PDO::PARAM_INT);
        $stmt->bindValue(":idContinent",$idContinent,PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        if($result['nb'] >= 1) return true;
        return false;
    }

}