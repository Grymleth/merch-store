<?php 

class Inventory{
    function __construct(){
        // TODO: change database init
        $this->productDB = new Database("127.0.0.1", "root", "", "inventory");
    }

    function getProductPrice($uid){
        $result = $this->productDB->query_fetch_single("SELECT goodsprice FROM goodslistinfo WHERE goodsid = ?", array($uid));
        if(is_array($result)) return $result;
    }

    function changeStock($goodsId, $newStock){
        $result = $this->productDB->query("UPDATE goodslistinfo SET stocks = ? WHERE goodsId = ?", array($newStock, $goodsId));
        if(is_array($result)) return $result;
    }

    public function getProductInfo($goodsid){
        $result = $this->productDB->query_fetch_single("SELECT goodsid, goodsname, goodsprice, goodsimage, goodsdescription, goodscategory, stocks 
        FROM goodslistinfo WHERE goodsid = ? ", array($goodsid));
        if(is_array($result)) return $result;
    }

    public function getProductStock($goodsid){
        $result = $this->productDB->query_fetch_single("SELECT stocks 
        FROM goodslistinfo WHERE goodsid = ? ", array($goodsid));
        if(is_array($result)) return $result;
    }
}
?>
