<?php 

class Inventory{
    function __construct(){
        // TODO: change database init
        $this->inventoryDB = new Database("127.0.0.1", "root", "", "inventory");
    }

    function getProductPrice($uid){
        $result = $this->inventoryDB->query_fetch_single("SELECT goodsprice FROM goodslistinfo WHERE goodsid = ?", array($uid));
        if(is_array($result)) return $result;
    }

    function changeStock($goodsId, $newStock){
        $result = $this->inventoryDB->query("UPDATE goodslistinfo SET stocks = ? WHERE goodsId = ?", array($newStock, $goodsId));
        if(is_array($result)) return $result;
    }

    public function getProductInfo($goodsid){
        $result = $this->inventoryDB->query_fetch_single("SELECT goodsid, goodsname, goodsprice, goodsimage, goodsdescription, goodscategory, stocks 
        FROM goodslistinfo WHERE goodsid = ? ", array($goodsid));
        if(is_array($result)) return $result;
    }

    public function getProductList(){
        $result = $this->inventoryDB->query_fetch("SELECT goodsid, goodsname, goodsimage, goodsdescription, goodsprice FROM goodslistinfo", array());
        if(is_array($result)) return $result;
    }

    public function getProductStock($goodsid){
        $result = $this->inventoryDB->query_fetch_single("SELECT stocks 
        FROM goodslistinfo WHERE goodsid = ? ", array($goodsid));
        if(is_array($result)) return $result;
    }

    public function getCategoryInfo($uid){
        $result = $this->inventoryDB->query_fetch_single("SELECT goodscatname 
        FROM goodscategoryinfo WHERE goodscatname = ?", array($uid));
        if(is_array($result)) return $result;
    }

    public function getProductListFromCategory($category){
        $result =  $this->inventoryDB->query_fetch("SELECT g.goodsid, g.goodsimage, g.goodsname, g.goodsprice, g.goodsdescription, c.goodscatname, c.goodscategory
                                          FROM goodslistinfo as g
                                          INNER JOIN goodscategoryinfo as c
                                          ON g.goodscategory = c.goodscategory AND c.goodscatname = ?", array($category));

        if(is_array($result)) return $result;
    }

    public function getCategoryList(){
        $result = $this->inventoryDB->query_fetch("SELECT goodscatname, goodscategory FROM goodscategoryinfo", array());
        if(is_array($result)) return $result;
    }
}
?>
