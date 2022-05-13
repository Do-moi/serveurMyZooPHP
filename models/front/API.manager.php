<?php
require_once "models/model.php";

class APIManager extends Model{
    
    public function getDBAnimals($idFamille,$idContinent){
        $whereClause="";
        if($idFamille !== -1 || $idContinent !== -1) $whereClause .= "WHERE ";
        if($idFamille !== -1 ) $whereClause .= "f.famille_id = :idFamille";
        if($idFamille !== -1 && $idContinent !== -1) $whereClause .= " AND ";
        if($idContinent !== -1 ) $whereClause .= "a.animal_id IN ( select animal_id from animal_continent where continent_id = :idContinent )";


        $req = "SELECT a.animal_id, animal_nom,animal_description, animal_image,famille_libelle, f.famille_id, f.famille_description,c.continent_id, continent_libelle 
        FROM animal a inner join famille f on f.famille_id = a.famille_id
        left join animal_continent ac on ac.animal_id = a.animal_id
        left join continent c on c.continent_id = ac.continent_id ".$whereClause;
        $stmt = $this->getBdd()->prepare($req);
        if($idFamille !== -1 ) $stmt->bindValue(":idFamille",$idFamille,PDO::PARAM_INT);
        if($idContinent !== -1 ) $stmt->bindValue(":idContinent",$idContinent,PDO::PARAM_INT);
        $stmt->execute();
        $animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $animaux;

        
    }
    public function getDBUnAnimal($idAnimal){
        $req = "SELECT * FROM animal a 
        inner join famille f on f.famille_id = a.famille_id
        inner join animal_continent ac on ac.animal_id = a.animal_id
        inner join continent c on c.continent_id = ac.continent_id
        Where a.animal_id = :idAnimal
        ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idAnimal",$idAnimal,PDO::PARAM_INT);

        $stmt->execute();
        $infoUnAnimal = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $infoUnAnimal;

        
    }
    public function getDBContinent(){
        $req = "SELECT * FROM continent ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $continents = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $continents;

        
    }
    public function getDBFamilles(){
        $req = "SELECT * FROM famille ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $familles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $familles;

        
    }
}