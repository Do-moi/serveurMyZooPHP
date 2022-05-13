<?php
require_once "models/front/API.manager.php";
require_once "models/model.php";

class APIController {

    private $apiManager;

    public function __construct()
    {
        $this->apiManager = new APIManager();
    }
    //function qui permet de mettre dans un tableau tous les continents où les animaux sont présent
    private function formatDataLignesAnimaux($lignes){
        $array = [];
        foreach($lignes as $ligne){
            if(!array_key_exists($ligne['animal_id'],$array)){
                $array[$ligne['animal_id']] = [
                    "id"=> $ligne['animal_id'],
                    "nom"=> $ligne['animal_nom'],
                    "desc"=> $ligne['animal_description'],
                    "img"=> URL.'public/images/'.$ligne['animal_image'],
                    "famille" => [
                    "idFamille" => $ligne['famille_id'],
                    "libelleFamille" => $ligne['famille_libelle'],
                    "descriptionFamille" => $ligne['famille_description']
                    ]
                ];
               
             }
             $array[$ligne['animal_id']]['continents'][] = [
                "idContinent" => $ligne['continent_id'],
                "libelleContinent" => $ligne['continent_libelle']
            ];
        }
        return $array;

    }
    //===============================================================================================
    public function getAnimaux($idFamille,$idContinent){
        $animaux = $this->apiManager->getDBAnimals($idFamille,$idContinent);
        $result = $this->formatDataLignesAnimaux($animaux);
        
        Model::transformToJSON($result);
        
        
    }
    public function getAnimal($idAnimal){
        $infoUnAnimal = $this->apiManager->getDBUnAnimal($idAnimal);
        $result = $this->formatDataLignesAnimaux($infoUnAnimal);
        
        Model::transformToJSON($result);

    }
    public function getContinents(){
        $continents = $this->apiManager->getDBContinent();
        Model::transformToJSON($continents);
        
        
    }
    public function getFamilles(){
        $familles = $this->apiManager->getDBFamilles();
        Model::transformToJSON($familles);
    }
    public function sendMessage(){
        header("Access-Control-Allow-Origin: *");//pour autoriser tous le monde à acceder aux informations du serveur, pour eviter la CROSS ERROR.
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");

        $obj = json_decode(file_get_contents('php://input'));

//traitement à faire en backend

        $messageBack = [
            'from' => $obj->email,
            'to' => " a envoyer contact@moi",
            "leMessageAEnvoyer" =>$obj->textMessage
        ];
         
        echo json_encode($messageBack);// envoi d'un retour en front
        
    }

}