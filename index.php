<?php
session_start();
// créer un chemin absolu 
define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" :"http").
"://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

require_once "controllers/front/API.controller.php";
$apiController= new APIController();
require_once 'controllers/back/admin.controller.php';
$adminController = new AdminController();
require_once './controllers/back/famille.controller.php';
$familleController = new FamilleController();
require_once "controllers/back/animaux.controller.php";
$animauxController = new AnimauxController();

try{
    if(empty($_GET['page'])){
        throw new Exception("la page n'existe pas") ;
    } else {
        $url = explode("/",filter_var($_GET['page'],FILTER_SANITIZE_URL));
        

        if(empty($url[0]) || empty($url[1])){
            throw new Exception("la page n'existe pas"); 
            }
        switch($url[0]){
            case 'front' : 
                switch($url[1]){
                    case "animaux" :
                        if(!isset($url[2]) || !isset($url[3])){
                            $apiController->getAnimaux(-1,-1);
                        }else{
                            $apiController->getAnimaux((int)$url[2],(int)$url[3]);
                        }
                         
                    break;
                    case "animal" :
                        if(empty($url[2])){
                            throw new Exception("l'identifiant n'existe pas"); 
                        }else{
                            $apiController->getAnimal($url[2]);
                        }
                         
                    break;
                    case "continent" : $apiController->getContinents();
                    break;
                    case "familles" : $apiController->getFamilles();
                    break;
                    case "sendMessage" : $apiController->sendMessage();
                    break;
                    default : throw new Exception("la page n'existe pas");
                }

            break; 
            case 'back' :
                switch($url[1]){
                    case "login" : $adminController->getPageLogin();
                    break;
                    case "connexion" : $adminController->connexion();
                    break;
                    case "admin" : $adminController->getAccueilAdmin();
                    break;
                    case "deconnexion" : $adminController->deconnexion();
                    break;
                    case "familles" : 
                        switch($url[2]){
                            case "visualisation": $familleController->visualisation();
                            break;
                            case "validationSuppression": $familleController->supressionFamille();
                            break;
                            case "validationModification": $familleController->modificationFamille();
                            break;
                            case "creation" : $familleController->creationFamille();
                            break;
                            case "creationValidation" : $familleController->creationValidation();
                            break;
                            default : throw new Exception("la page n'existe pas");
                        }
                    break;
                    case "animaux" : 
                        switch($url[2]){
                            case "visualisation": $animauxController->visualisation();
                            break;
                            case "validationSuppression": $animauxController->suppressionAnimal();
                            break;
                            case "creation" : $animauxController->creationAnimal();
                            break;
                            case "creationValidation" : $animauxController->creationValidation();
                            break;
                            case "modification" : $animauxController->modificationAnimal();
                            break;
                            case "modificationValidation" : $animauxController->validationModificationAnimal();
                            break;
                            default : throw new Exception("la page n'existe pas");
                        }
                    break;
                    default : throw new Exception("la page n'existe pas");
                }; 
            break;
            default : throw new Exception("la page n'existe pas");
        }

    }
} catch (Exception $e){
    $msg = $e->getMessage();
    echo $msg;
    echo "<a href='".URL."back/login'>=>login</a>";
}
