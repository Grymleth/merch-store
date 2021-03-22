<?php 

class CategoryRoute{
    public function __construct($param = null){
        if($param != null){
            $conn = new Database('localhost', 'root', '', 'inventory');

            $inventory = new Inventory();

            $result = $inventory->getCategoryInfo($param);

            // check if category exists
            if(!is_array($result)){
                new Error404();
                return;
            }

            // Get product from database
            $result = $inventory->getProductListFromCategory($param);

            // check if products exists in category
            // if(!is_array($result)){
            //     return;
            // }

            $products = $result != null ? $result : array();
            $result = $inventory->getCategoryList();
            $categories = $result;

            $activeCategory = strtoupper($param);

            unset($inventory);

            require_once "src/pages/category.php";

            // Get categories from db
        }
        else{
            new Error404();
        }
    }
}

?>