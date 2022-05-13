<?php
require_once "./models/model.php";

class FamillesManager extends Model{
    
    public function __construct()
    {
        
    }
    public function getFamilles(){
        $req = "SELECT * from famille";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $familles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $familles;
    }
    public function deleteDBfamille($idFamille){
        $req= "DELETE from famille WHERE famille_id= :idFamille";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idFamille",$idFamille,PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        
    }
    public function compterAnimaux($idFamille){
        $req = "SELECT count(*) as 'nb' FROM famille f inner join animal a on a.famille_id = f.famille_id WHERE f.famille_id = :idFamille";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idFamille",$idFamille,PDO::PARAM_INT);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        // echo "========compteranimaux".$resultat['nb'];
        return $resultat['nb'];
    }
    public function updateFamille($idFamille,$familleDescription, $familleLibelle ){
        $req= "UPDATE famille SET famille_libelle = :libelle , famille_description = :description WHERE famille_id= :idFamille";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idFamille",$idFamille,PDO::PARAM_INT);
        $stmt->bindValue(":libelle",$familleLibelle,PDO::PARAM_STR);
        $stmt->bindValue(":description",$familleDescription,PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();

    }
    public function createFamille($familleLibelle,$familleDescription){
        $req= "INSERT into famille (famille_libelle,famille_description) values(:libelle,:description)";
        $stmt = $this->getBdd()->prepare($req);
       
        $stmt->bindValue(":libelle",$familleLibelle,PDO::PARAM_STR);
        $stmt->bindValue(":description",$familleDescription,PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
        return $this->getBdd()->lastInsertId();


    }

}