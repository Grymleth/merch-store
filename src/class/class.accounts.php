<?php 

class Accounts{
    public function __construct($param = null){
        switch($param){
            case 'login':
                $this->login();
                break;
            case 'register':
                $this->register();
                break;
            default:
                new Error404();
                break;
        }
    }

    public function login(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            header('location: '. __BASE_URL__ . '');
        }
        else{
            require_once "src/pages/login.php";
        }
    }

    public function register(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            header('location: '. __BASE_URL__ . 'accounts/login');
        }
        else{
            require_once "src/pages/register.php";
        }
        
    }
}

?>