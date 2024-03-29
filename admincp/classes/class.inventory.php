<?php

    class Inventory{

        function __construct() {
            $this->inventoryDB = new Database("127.0.0.1", "root", "", "inventory");
    	}

        public function addProduct($strGoodsName, $strGoodsImage, $strGoodsCategory, $strGoodsDesc, $intStocks, $intGoodsPrice){   
            if(!is_numeric($intGoodsPrice) || floatVal($intGoodsPrice) < 1) return "Price is not valid";
            else if($this->productNameExists($strGoodsName)) return "Product already exists";
            else if(!is_numeric($intStocks) || intVal($intStocks) < 0) return "Stock cannot be negative";

            $result = $this->inventoryDB->query("INSERT INTO goodslistinfo(GoodsName, GoodsImage, GoodsCategory, GoodsDescription, Stocks, GoodsPrice) VALUES(?, ?, ?, ?, ?, ?)", array($strGoodsName, $strGoodsImage, $strGoodsCategory, $strGoodsDesc, $intStocks, floatVal($intGoodsPrice)));
                if(!$result) return "Product not succesfully added for unknown reasons. Contact the Administrator";
        }

        public function changeName($productID, $newName){
            if($this->productNameExists($newName)) return "Product already exists";

            $result = $this->inventoryDB->query("UPDATE goodslistinfo SET GoodsName = ? WHERE GoodsID = ?", array($newName, $productID));
            return ""; 
        }
        public function changeImage($productID, $newImage){
            $result = $this->inventoryDB->query("UPDATE goodslistinfo SET GoodsImage = ? WHERE GoodsID = ?", array($newImage, $productID));
            return ""; 
        }
        public function changeCategory($productID, $newCategory){
            $result = $this->inventoryDB->query("UPDATE goodslistinfo SET GoodsCategory = ? WHERE GoodsID = ?", array($newCategory, $productID));
            return ""; 
        }
        public function changeDescription($productID, $newDesc){
            $result = $this->inventoryDB->query("UPDATE goodslistinfo SET GoodsDescription = ? WHERE GoodsID = ?", array($newDesc, $productID));
            return ""; 
        }
        public function changePrice($productID, $newPrice){
            if(!is_numeric($newPrice) || floatVal($newPrice) < 1) return "Price is not valid";
            $result = $this->inventoryDB->query("UPDATE goodslistinfo SET GoodsPrice = ? WHERE GoodsID = ?", array($newPrice, $productID));
            return ""; 
        }
        public function changeStocks($productID, $newStocks){
            if(!is_numeric($newStocks) || intVal($newStocks) < 0) return "Stock cannot be negative";
            $result = $this->inventoryDB->query("UPDATE goodslistinfo SET Stocks = ? WHERE GoodsID = ?", array($newStocks, $productID));
            return ""; 
        }

        public function getProductList(){
            $result = $this->inventoryDB->query_fetch("SELECT goodslistinfo.GoodsImage, goodslistinfo.GoodsID, goodslistinfo.GoodsName, goodscategoryinfo.GoodsCatName, goodslistinfo.RegDate, goodslistinfo.GoodsDescription, goodslistinfo.GoodsPrice, goodslistinfo.Stocks FROM goodslistinfo INNER JOIN goodscategoryinfo ON goodslistinfo.GoodsCategory = goodscategoryinfo.GoodsCategory");
            if(is_array($result)) return $result;
        }

        public function getProductInfo($productid){
            $result = $this->inventoryDB->query_fetch_single("SELECT * FROM goodslistinfo WHERE goodslistinfo.GoodsID = ?", $productid);
            if(is_array($result)) return $result;
        }

        public function getCategoryList(){
            $result = $this->inventoryDB->query_fetch("SELECT GoodsCatName, GoodsCategory FROM goodscategoryinfo", array());
            if(is_array($result)) return $result;
        }

        public function productNameExists($productName) {
            $result = $this->inventoryDB->query_fetch_single("SELECT * FROM goodslistinfo WHERE GoodsName = ?", array($productName));
            if(is_array($result)) return true;
            return false;
        }
    }
?>