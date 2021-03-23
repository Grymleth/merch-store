<?php

class Transaction{

    function __construct() {
        $this->transactionDB = new Database("127.0.0.1", "root", "", "transactions");
	}

    public function changeDeliveryStatus($transactionID, $newDeliveryStatus){
        $result = $this->transactionDB->query("UPDATE deliverystatus SET DeliveryCode = ? WHERE TransactionID = ?", array($newDeliveryStatus, $transactionID));
        if(!$result) return "Delivery status request not successfully changed for unknown reasons. Contact Administrator";

        return ""; 
    }

    public function getTransactionList(){
        $result = $this->transactionDB->query_fetch("SELECT transactions.producttransaction.TransactionID, account.users.Name, account.users.Email, inventory.goodslistinfo.GoodsName, inventory.goodscategoryinfo.GoodsCatName,transactions.producttransaction.TransactionDate, transactions.producttransaction.Quantity, transactions.producttransaction.TotalPrice, deliverycat.DeliveryDesc FROM (((((transactions.producttransaction INNER JOIN account.users ON transactions.producttransaction.AccountID = account.users.AccountID)INNER JOIN inventory.goodslistinfo ON transactions.producttransaction.GoodsID = inventory.goodslistinfo.GoodsID)INNER JOIN inventory.goodscategoryinfo ON inventory.goodslistinfo.GoodsID = inventory.goodscategoryinfo.GoodsCategory)INNER JOIN deliverystatus ON producttransaction.TransactionID = deliverystatus.TransactionID)INNER JOIN deliverycat ON deliverystatus.DeliveryCode = deliverycat.DeliveryCode)UNION SELECT transactions.producttransaction.TransactionID, noregtransaction.Name, noregtransaction.Email, inventory.goodslistinfo.GoodsName, inventory.goodscategoryinfo.GoodsCatName,transactions.producttransaction.TransactionDate, transactions.producttransaction.Quantity, transactions.producttransaction.TotalPrice, deliverycat.DeliveryDesc FROM (((((transactions.producttransaction INNER JOIN noregtransaction ON producttransaction.TransactionID = noregtransaction.TransactionID)INNER JOIN inventory.goodslistinfo ON transactions.producttransaction.GoodsID = inventory.goodslistinfo.GoodsID)INNER JOIN inventory.goodscategoryinfo ON inventory.goodslistinfo.GoodsID = inventory.goodscategoryinfo.GoodsCategory)INNER JOIN deliverystatus ON producttransaction.TransactionID = deliverystatus.TransactionID)INNER JOIN deliverycat ON deliverystatus.DeliveryCode = deliverycat.DeliveryCode);");
        if(is_array($result)) return $result;
    }

    public function getTransactionInfo($uid){
        $result = $this->transactionDB->query_fetch_single("SELECT transactions.producttransaction.TransactionID, account.users.Name, account.users.Email, inventory.goodslistinfo.GoodsName, inventory.goodslistinfo.GoodsCategory,transactions.producttransaction.TransactionDate, transactions.producttransaction.Quantity, transactions.producttransaction.TotalPrice, deliverystatus.DeliveryCode FROM (((transactions.producttransaction INNER JOIN account.users ON transactions.producttransaction.AccountID = account.users.AccountID)INNER JOIN inventory.goodslistinfo ON transactions.producttransaction.GoodsID = inventory.goodslistinfo.GoodsID)INNER JOIN deliverystatus ON producttransaction.TransactionID = deliverystatus.TransactionID) WHERE producttransaction.TransactionID = ?;", $uid);
        if($result == false){
            $result = $this->transactionDB->query_fetch_single("SELECT transactions.producttransaction.TransactionID, noregtransaction.Name, noregtransaction.Email, inventory.goodslistinfo.GoodsName, inventory.goodslistinfo.GoodsCategory,transactions.producttransaction.TransactionDate, transactions.producttransaction.Quantity, transactions.producttransaction.TotalPrice, deliverystatus.DeliveryCode FROM (((transactions.producttransaction INNER JOIN noregtransaction ON producttransaction.TransactionID = noregtransaction.TransactionID)INNER JOIN inventory.goodslistinfo ON transactions.producttransaction.GoodsID = inventory.goodslistinfo.GoodsID)INNER JOIN deliverystatus ON producttransaction.TransactionID = deliverystatus.TransactionID) WHERE producttransaction.TransactionID = ?;", $uid);
        }
        if(is_array($result)) return $result;
    }
}



?>