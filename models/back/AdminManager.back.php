<?php
require_once "./models/model.php";
class AdminManager extends Model{

    public function __construct()
    {
        
    }
    private function getPasswordUser($login){
        $req= "SELECT * FROM administrateur WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':login',$login,PDO::PARAM_STR);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $admin['password'];



    }
    public function isConnexionValid($login,$password){
        $passwordBDD = $this->getPasswordUser($login);
        return password_verify($password,$passwordBDD);

    }
    
}


?>