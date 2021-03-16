<?php 

class CategoryRoute{
    public function __construct($param = null){
        if($param != null){
            $conn = new Database('localhost', 'root', '', 'inventory');


            $result = $conn->query_fetch("SELECT goodscatname FROM goodscategoryinfo WHERE goodscatname = ?", array($param));

            // check if category exists
            if(!is_array($result)){
                new Error404();
                return;
            }

            // Get product from database
            $result = $conn->query_fetch("SELECT g.goodsid, g.goodsimage, g.goodsname, g.goodsprice, g.goodsdescription, c.goodscatname, c.goodscategory
                                          FROM goodslistinfo as g
                                          INNER JOIN goodscategoryinfo as c
                                          ON g.goodscategory = c.goodscategory AND c.goodscatname = ?", array($param));

            // check if products exists in category
            // if(!is_array($result)){
            //     return;
            // }

            $products = $result != null ? $result : array();
            $result = $conn->query_fetch("SELECT goodscatname FROM goodscategoryinfo", array());
            $categories = $result;

            $activeCategory = strtoupper($param);

            require_once "src/pages/category.php";

            // Get categories from db
        }
        else{
            new Error404();
        }
    }
}

?>