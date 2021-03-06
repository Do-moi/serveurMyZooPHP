<?php
require "securite.class.php";
require "./models/back/AdminManager.back.php";

class AdminController{
    private $adminManager;
    public function __construct()
    {
        $this-> adminManager = new AdminManager();
    }
    public function getPageLogin(){
        
        require_once "views/login.view.php";
    }
    public function connexion(){
        // echo password_hash("admin09",PASSWORD_DEFAULT);
        if(!empty($_POST['login']) && !empty($_POST['password'])){
           $login = Securite::secureHTML($_POST['login']);
           $password = Securite::secureHTML($_POST['password']);
           if($this->adminManager->isConnexionValid($login,$password)){
               $_SESSION["access"] = "admin";
               header('Location: '.URL."back/admin");
           }else{

               header('Location: '.URL."back/login");
           }

        }
    }
    public function getAccueilAdmin(){
        if(Securite::verifAccessSession()){
            require_once "views/accueilAdmin.view.php";
        } else {
            header('Location: '.URL."back/login");
        }
        
    }
    public function deconnexion(){
        session_destroy();
        header('Location: '.URL."back/login");
    }
}


?>