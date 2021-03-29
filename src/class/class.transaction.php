<?php 

class Transaction{

    public function __construct() {
        // TODO: change Database initialization
        $this->transactionDB = new Database("127.0.0.1", "root", "", "transactions");
	}

    public function createTransaction($userId, $goodsId, $quantity, $totalPrice){
        // insert into producttransaction table
        $result = $this->transactionDB->query("INSERT INTO producttransaction (AccountID, GoodsID, Quantity, TotalPrice) 
        VALUES (?, ?, ?, ?)", array($userId, $goodsId, $quantity, $totalPrice));

        // return error
        if(!$result) return "Account not succesfully registered for unknown reasons. Contact the Administrator";
    }

    public function createNoRegTransaction($name, $email, $address, $goodsId, $quantity, $totalPrice){
        $this->createTransaction(0, $goodsId, $quantity, $totalPrice);

        // get latest producttransaction record
        $transactionId = $this->getLatestTransaction()['transactionID'];

        // insert new record into noregtransaction table
        $result = $this->transactionDB->query("INSERT INTO noregtransaction (transactionID, name, email, address)
        VALUES (?, ?, ?, ?)", array($transactionId, $name, $email, $address));
        
        if(!$result) return "Account not succesfully registered for unknown reasons. Contact the Administrator";
    }

    public function getLatestTransaction(){
        $result = $this->transactionDB->query_fetch("SELECT transactionID, accountID, goodsID, transactionDate, quantity, totalPrice 
        FROM producttransaction ORDER BY transactionDate DESC");
        if(is_array($result)) return $result[0];
    }

    public function changeDeliveryStatus($transactionID, $newDeliveryStatus){
        $result = $this->transactionDB->query("UPDATE deliverystatus SET DeliveryCode = ? WHERE TransactionID = ?", array($newDeliveryStatus, $transactionID));
        if(!$result) return "Delivery status request not successfully changed for unknown reasons. Contact Administrator";

        return ""; 
    }

    public function getTransactionList(){
        $result = $this->transactionDB->query_fetch("SELECT transactions.producttransaction.TransactionID, account.users.Name, account.users.Email, inventory.goodslistinfo.GoodsName, inventory.goodscategoryinfo.GoodsCatName,transactions.producttransaction.TransactionDate, transactions.producttransaction.Quantity, transactions.producttransaction.TotalPrice, deliverycat.DeliveryDesc FROM (((((transactions.producttransaction INNER JOIN account.users ON transactions.producttransaction.AccountID = account.users.AccountID)INNER JOIN inventory.goodslistinfo ON transactions.producttransaction.GoodsID = inventory.goodslistinfo.GoodsID)INNER JOIN inventory.goodscategoryinfo ON inventory.goodslistinfo.GoodsCategory = inventory.goodscategoryinfo.GoodsCategory)INNER JOIN deliverystatus ON producttransaction.TransactionID = deliverystatus.TransactionID)INNER JOIN deliverycat ON deliverystatus.DeliveryCode = deliverycat.DeliveryCode)UNION SELECT transactions.producttransaction.TransactionID, noregtransaction.Name, noregtransaction.Email, inventory.goodslistinfo.GoodsName, inventory.goodscategoryinfo.GoodsCatName,transactions.producttransaction.TransactionDate, transactions.producttransaction.Quantity, transactions.producttransaction.TotalPrice, deliverycat.DeliveryDesc FROM (((((transactions.producttransaction INNER JOIN noregtransaction ON producttransaction.TransactionID = noregtransaction.TransactionID)INNER JOIN inventory.goodslistinfo ON transactions.producttransaction.GoodsID = inventory.goodslistinfo.GoodsID)INNER JOIN inventory.goodscategoryinfo ON inventory.goodslistinfo.GoodsCategory = inventory.goodscategoryinfo.GoodsCategory)INNER JOIN deliverystatus ON producttransaction.TransactionID = deliverystatus.TransactionID)INNER JOIN deliverycat ON deliverystatus.DeliveryCode = deliverycat.DeliveryCode);");
        if(is_array($result)) return $result;
    }

    public function getTransactionInfo($uid){
        $result = $this->transactionDB->query_fetch_single("SELECT transactions.producttransaction.TransactionID, transactions.producttransaction.AccountID, account.users.Name, account.users.Email, inventory.goodslistinfo.GoodsName, inventory.goodslistinfo.GoodsCategory,transactions.producttransaction.TransactionDate, transactions.producttransaction.Quantity, transactions.producttransaction.TotalPrice, deliverystatus.DeliveryCode FROM (((transactions.producttransaction INNER JOIN account.users ON transactions.producttransaction.AccountID = account.users.AccountID)INNER JOIN inventory.goodslistinfo ON transactions.producttransaction.GoodsID = inventory.goodslistinfo.GoodsID)INNER JOIN deliverystatus ON producttransaction.TransactionID = deliverystatus.TransactionID) WHERE producttransaction.TransactionID = ?;", $uid);
        if($result == false){
            $result = $this->transactionDB->query_fetch_single("SELECT transactions.producttransaction.TransactionID, transactions.producttransaction.AccountID, noregtransaction.Name, noregtransaction.Email, inventory.goodslistinfo.GoodsName, inventory.goodslistinfo.GoodsCategory,transactions.producttransaction.TransactionDate, transactions.producttransaction.Quantity, transactions.producttransaction.TotalPrice, deliverystatus.DeliveryCode FROM (((transactions.producttransaction INNER JOIN noregtransaction ON producttransaction.TransactionID = noregtransaction.TransactionID)INNER JOIN inventory.goodslistinfo ON transactions.producttransaction.GoodsID = inventory.goodslistinfo.GoodsID)INNER JOIN deliverystatus ON producttransaction.TransactionID = deliverystatus.TransactionID) WHERE producttransaction.TransactionID = ?;", $uid);
        }
        if(is_array($result)) return $result;
    }

    public function getTransactionListByUser($accountID){
        $result = $this->transactionDB->query_fetch("SELECT transactions.producttransaction.TransactionID, account.users.Name, account.users.Email, inventory.goodslistinfo.GoodsName, inventory.goodslistinfo.GoodsID, inventory.goodscategoryinfo.GoodsCatName,transactions.producttransaction.TransactionDate, transactions.producttransaction.Quantity, transactions.producttransaction.TotalPrice, deliverycat.DeliveryDesc FROM (((((transactions.producttransaction INNER JOIN account.users ON transactions.producttransaction.AccountID = account.users.AccountID AND account.users.AccountID = ?)INNER JOIN inventory.goodslistinfo ON transactions.producttransaction.GoodsID = inventory.goodslistinfo.GoodsID)INNER JOIN inventory.goodscategoryinfo ON inventory.goodslistinfo.GoodsCategory = inventory.goodscategoryinfo.GoodsCategory)INNER JOIN deliverystatus ON producttransaction.TransactionID = deliverystatus.TransactionID)INNER JOIN deliverycat ON deliverystatus.DeliveryCode = deliverycat.DeliveryCode);", array($accountID));
        if(is_array($result)) return $result;
    }

    // dont use this function for registered transaction
    public function getAddressFromTransactionID($transactionID){
        $result = $this->transactionDB->query_fetch_single("SELECT Address FROM noregtransaction INNER JOIN producttransaction ON noregtransaction.TransactionID = producttransaction.TransactionID WHERE producttransaction.TransactionID = ?;", array($transactionID));
        if(is_array($result)) return $result;
    }
}

?>