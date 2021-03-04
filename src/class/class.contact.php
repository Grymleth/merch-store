<?php 

class Contact{
    public function __construct($param = null){
        if($param == null){
            require_once "src/pages/contact.php";
        }
        else{
            new Error404();
        }
    }

    
}

?>