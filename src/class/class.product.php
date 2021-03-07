<?php 

class Product{
    public function __construct($param = null){
        if($param != null){
            $conn = new Database('localhost', 'root', '', 'inventory');

            // Get product from database
            $result = $conn->query_fetch("SELECT * FROM goodslistinfo WHERE goodsid = ? ", array($param));

            // check if product exist
            if(!is_array($result)){
                new Error404();
                return;
            }
            $product = $result[0];
            
            $result = $conn->query_fetch("SELECT goodscategory, goodscatname FROM goodscategoryinfo", array());

            $categories = $result;
            require_once "src/pages/product.php";

            // Get categories from db
        }
        else{
            new Error404();
        }
    }
}

?>