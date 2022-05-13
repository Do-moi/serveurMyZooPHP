<?php
require_once "securite.class.php";
require_once "./models/back/animaux.manager.php";
require_once "./models/back/familles.manager.php";
require_once "./models/back/continents.manager.php";
require_once "./controllers/back/utile.php";
class AnimauxController{
    private $animauxManager;
    public function __construct()
    {
        $this->animauxManager = new AnimauxManager();
    }
    public function visualisation(){
        if(Securite::verifAccessSession()){
            $animaux = $this->animauxManager->getAnimaux();
            
            require_once "./views/animauxVisualisation.view.php";
            

        } else {
            throw new Exception(" vous n'avez pas le droit d'ètre là !");
        }

    }
    public function suppressionAnimal(){
        if(Securite::verifAccessSession()){
           
            $idAnimal = (int)Securite::secureHTML($_POST['animal_id']);
            $image = $this->animauxManager->getImageAnimal($idAnimal);
            echo $image;

            unlink("public/images/".$image);

                $this->animauxManager->deleteDBAnimalContinent($idAnimal);
                $this->animauxManager->deleteDBAnimal($idAnimal);
                $_SESSION['alert'] = [
                    "message" => "l'animal est supprimée",
                    "type" => "alert-success"
                ];
            
        
        header('Location: '.URL."back/animaux/visualisation");

        } else {
            throw new Exception(" vous n'avez pas le droit d'ètre là !");
        }
    }
    public function creationAnimal(){

        if(Securite::verifAccessSession()){
            $familleManager = new FamillesManager();
            $familles = $familleManager->getFamilles();
            $continentsManager = new ContinentsManager();
            $continents = $continentsManager->getContinents();
            require_once "./views/animalCreation.view.php";
        } else {
            throw new Exception(" vous n'avez pas le droit d'ètre là !");
        }
    }
    public function creationValidation(){

        if(Securite::verifAccessSession()){
         $nomAnimal = Securite::secureHTML($_POST["animal_nom"]);
         $descriptionAnimal= Securite::secureHTML($_POST["animal_description"]) ;
         $imgAnimal = "";
         if($_FILES['image']['size']> 0){
             $repertoire = "public/images/";
             $imgAnimal = ajoutImage($_FILES['image'], $repertoire);


         }
        
         $familleAnimal =(int) Securite::secureHTML($_POST["famille_id"]);
       
         
         $idAnimal=  $this->animauxManager->createAnimal($nomAnimal,$descriptionAnimal, $imgAnimal,$familleAnimal);
         $continentsManager = new ContinentsManager();
         
        if(!empty($_POST['continent-1']))
             $continentsManager->addContinentAnimal($idAnimal,1);
        if(!empty($_POST['continent-2']))
            $continentsManager->addContinentAnimal($idAnimal,2);
        if(!empty($_POST['continent-3']))
            $continentsManager->addContinentAnimal($idAnimal,3);
        if(!empty($_POST['continent-4']))
            $continentsManager->addContinentAnimal($idAnimal,4);
        if(!empty($_POST['continent-5']))
             $continentsManager->addContinentAnimal($idAnimal,5);

          $_SESSION['alert'] = [
            "message" => "l'animal a bien été créée avec l'identifiant : ".$idAnimal,
            "type" => "alert-success"
        ];
        header('Location: '.URL."back/animaux/visualisation");
        } else {
            throw new Exception(" vous n'avez pas le droit d'ètre là !");
        }
    }
    public function modificationAnimal(){
        if(Securite::verifAccessSession()){
           $famillesManager = new FamillesManager();
           $familles = $famillesManager->getFamilles();
           $continentsManager = new ContinentsManager();
           $continents = $continentsManager->getContinents();
           

           $animal = $this->animauxManager->getAnimal((int)Securite::secureHTML($_POST['animal_id']));
           $tabContinents = [];
           foreach ($animal as $continent){
               $tabContinents[] = $continent['continent_id'];
           }
           require_once "views/animalModification.view.php";
           
           } else {
               throw new Exception(" vous n'avez pas le droit d'ètre là !");
           }
    }
    public function validationModificationAnimal(){
        if(Securite::verifAccessSession()){
            $idAnimal = (int)Securite::secureHTML($_POST['animal_id']);
            $nomAnimal = Securite::secureHTML($_POST["animal_nom"]);
            $descriptionAnimal= Securite::secureHTML($_POST["animal_description"]) ;
            $imgAnimal = $this->animauxManager->getImageAnimal($idAnimal);
            if($_FILES["image"]['size'] > 0){
                $repertoire = "public/images/";

                unlink($repertoire.$imgAnimal);
                
                $imgAnimal = ajoutImage($_FILES['image'],$repertoire);


            }
           
            $familleAnimal = (int) Securite::secureHTML($_POST["famille_id"]);
            
            $this->animauxManager->updateAnimal($idAnimal, $nomAnimal, $descriptionAnimal, $imgAnimal, $familleAnimal);
            $continents=[
                1 => !empty($_POST["continent-1"]),
                2 => !empty($_POST["continent-2"]),
                3 => !empty($_POST["continent-3"]),
                4 => !empty($_POST["continent-4"]),
                5 => !empty($_POST["continent-5"]),

            ];
            
            $continentsManager = new ContinentsManager();
            foreach ($continents as $key => $continent){
                // les continents cochés et non présent en bdd
                if($continent && !$continentsManager->verificationExistAnimalContinent($idAnimal, $key)){
                    $continentsManager->addContinentAnimal($idAnimal, $key);
                }
                // les continents cochés et présent en bdd
                if (!$continent && $continentsManager->verificationExistAnimalContinent($idAnimal, $key)){
                    $continentsManager->deletedDBContinentAnimal($idAnimal,$key);
                }
            }
            $_SESSION['alert'] = [
                "message" => "l'animal a bien été modifié",
                "type" => "alert-success"
            ];
            header('Location: '.URL."back/animaux/visualisation");

            } else {
                throw new Exception(" vous n'avez pas le droit d'ètre là !");
            }
    }
    
    
    
    
}