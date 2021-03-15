<?php 

class Product{
    private $db;
    public function __construct($param = null){
        if($param != null){
            $this->db = new Database('localhost', 'root', '', 'inventory');

            // handle if REQUEST is post
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $param = $_POST['productid'];
            }

            $this->renderProduct($param);

        }
        else{
            new Error404();
        }
    }

    public function renderProduct($param){
        // Get product from database
        try{
            $result = $this->db->query_fetch("SELECT goodsid, goodsname, goodsprice, goodsimage, goodsdescription, goodscategory, stocks FROM goodslistinfo WHERE goodsid = ? ", array($param));
        }
        catch(Exception $ex){
            var_dump($ex);
        }
        

        // check if product exist
        if(!is_array($result)){
            new Error404();
            return;
        }
        $product = $result[0];

        $result = $this->db->query_fetch("SELECT goodscategory, goodscatname FROM goodscategoryinfo", array());

        $categories = $result;
        // determine which category the product is in
        $activeCategory = $categories[$product['goodscategory'] - 1]['goodscatname'];
        require_once "src/pages/product.php";
    }

    public function checkout(){

    }
}

?>