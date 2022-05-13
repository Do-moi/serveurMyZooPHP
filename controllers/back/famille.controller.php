<?php
require_once "securite.class.php";
require_once "./models/back/familles.manager.php";

class FamilleController{
    private $famillesManager;
    public function __construct()
    {
        $this->famillesManager = new FamillesManager();
    }
    public function visualisation(){
        if(Securite::verifAccessSession()){
            $familles = $this->famillesManager->getFamilles();
            
            require_once "./views/familleVisualisation.view.php";

        } else {
            throw new Exception(" vous n'avez pas le droit d'ètre là !");
        }

    }
    public function supressionFamille(){
        if(Securite::verifAccessSession()){
           
            $idFamille = (int)Securite::secureHTML($_POST['famille_id']);

            if($this->famillesManager->compterAnimaux($idFamille) > 0 ){
            $_SESSION['alert'] = [
                "message" => "la famille ne peut pas être supprimée",
                "type" => "alert-danger"
            ];
            } else {
                $this->famillesManager->deleteDBfamille($idFamille);
                $_SESSION['alert'] = [
                    "message" => "la famille est supprimée",
                    "type" => "alert-success"
                ];
            }
        
        header('Location: '.URL."back/familles/visualisation");

        } else {
            throw new Exception(" vous n'avez pas le droit d'ètre là !");
        }
    }
    public function modificationFamille(){

        if(Securite::verifAccessSession()){
           $idFamille= (int)Securite::secureHTML($_POST["famille_id"]);
           $familleDescription = Securite::secureHTML($_POST["famille_description"]);
           $familleLibelle= Securite::secureHTML($_POST["famille_libelle"]) ;
           $this->famillesManager->updateFamille($idFamille, $familleDescription, $familleLibelle);
           $_SESSION['alert'] = [
            "message" => "la famille a bien été modifiée",
            "type" => "alert-success"
        ];
        header('Location: '.URL."back/familles/visualisation");

        } else {
            throw new Exception(" vous n'avez pas le droit d'ètre là !");
        }
    }
    public function creationFamille(){

        if(Securite::verifAccessSession()){
            require_once "./views/familleCreation.view.php";
        } else {
            throw new Exception(" vous n'avez pas le droit d'ètre là !");
        }
    }
    public function creationValidation(){

        if(Securite::verifAccessSession()){
         $familleDescription = Securite::secureHTML($_POST["famille_description"]);
         $familleLibelle= Securite::secureHTML($_POST["famille_libelle"]) ;
          $idFamille =  $this->famillesManager->createFamille($familleLibelle,$familleDescription);
          $_SESSION['alert'] = [
            "message" => "la famille a bien été créée avec l'identifiant : ".$idFamille,
            "type" => "alert-success"
        ];
        header('Location: '.URL."back/familles/visualisation");
        } else {
            throw new Exception(" vous n'avez pas le droit d'ètre là !");
        }
    }
}