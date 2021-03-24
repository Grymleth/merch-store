<?php 

include "stdafx.php";


class Route{

    private $_uri = array();

    private $_method = array();
    /**
     * Builds a collection of internal URL's to llok for
     * @param type $uri
     */
    public function add($uri, $method=null){
        $this->_uri[] = '/' . trim($uri, '/');

        if($method != null){
            $this->_method[] = $method;
        }
    }
    /**
     * Parses the url into an array
     */
    public function parseUrl(){
        
        if(isset($_GET['uri'])){
            return $url = explode('/', filter_var(rtrim($_GET['uri'], '/'), FILTER_SANITIZE_URL));
        }
        else{
            return [''];
        }
    }

    /**
     * Makes the thing run
     */

    public function submit(){
        // check if account role has changed
        if(isset($_SESSION['login'])){
            $account = new Account();
            $roleID = intval($account->getUserRole($_SESSION['userId'])['RoleID']);
            if(intval($_SESSION['roleId']) != $roleID){
                $account->logoutAccount();
            }
        }
        
        $uriGet = isset($_GET['page']) ? $_GET['page'] : '';

        $methodGet = '/' . $uriGet;

        $paramGet = isset($_GET['subpage']) ? $_GET['subpage'] : null;
        foreach($this->_uri as $key => $value){
            if(preg_match("#^$value$#", $methodGet)){
                $useMethod = $this->_method[$key];
                new $useMethod($paramGet);
                return;
            }
        }

        new Error404();
    }
}

?>