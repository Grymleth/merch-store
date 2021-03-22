<?php 

class HomeRoute{
    public function __construct($param = null){
        if($param == null){

            $inventory = new Inventory();

            $result = $inventory->getProductList();

            $products = $result;

            $result = $inventory->getCategoryList();

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