<?php 

class Home{
    public function __construct($param = null){
        if($param == null){

            $conn = new Database(DB_HOST, DB_INVENTORY_USER, DB_INVENTORY_PASS, DB_INVENTORY_NAME);

            $result = $conn->query_fetch("SELECT goodsid, goodsname, goodsimage, goodsdescription, goodsprice FROM goodslistinfo", array());

            $products = $result;

            $result = $conn->query_fetch("SELECT goodscategory, goodscatname FROM goodscategoryinfo", array());

            $categories = $result;

            // activeCategory variable needed for ssidebar
            $activeCategory = '';

            require_once "src/pages/home.php";
        }
        else{
            new Error404();
        }
    }
}

?>