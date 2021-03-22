<?php

class Transaction{

    function __construct() {
        $this->transactionDB = new Database("127.0.0.1", "root", "", "transactions");
	}

    public function viewTransaction($strEmail, $strPass){
        if(!empty($ret = Common::validateEmail($strEmail))) return $ret;

        $hash_pass =  hash("sha512", $strEmail.$strPass);
        $result = $this->accountDB->query_fetch_single("SELECT AccountID FROM users WHERE Email = ? AND Pass = ?", array($strEmail, $hash_pass));
        if(!is_array($result)) return "Login Failed";

        $accountInfo = $this->getAccountInfo(intval($result["AccountID"]));
        if(!is_array($accountInfo)) return "System Error! Contact Administrator";
        if(Common::getRoleName(intval($accountInfo["RoleID"])) == "BANNED_USER" || Common::getRoleName(intval($accountInfo["RoleID"])) == "NORMAL_USER")
            return "Login Failed";

        $session = Session::getInstance();
        $session->accountID = $accountInfo["AccountID"];
        $session->roleID = $accountInfo["RoleID"];

        header("Location: dashboard/home");
        die();
    }

    public function changeDeliveryStatus($transactionID, $newDeliveryStatus){
        $result = $this->transactionDB->query("UPDATE deliverystatus SET DeliveryCode = ? WHERE TransactionID = ?", array($newDeliveryStatus, $transactionID));
        if(!$result) return "Delivery status request not successfully changed for unknown reasons. Contact Administrator";

        return ""; 
    }

    public function getTransactionList(){
        $result = $this->transactionDB->query_fetch("SELECT transactions.producttransaction.TransactionID, account.users.Name, account.users.Email, inventory.goodslistinfo.GoodsName, inventory.goodslistinfo.GoodsCategory,transactions.producttransaction.TransactionDate, transactions.producttransaction.Quantity, transactions.producttransaction.TotalPrice, deliverycat.DeliveryDesc FROM ((((transactions.producttransaction INNER JOIN account.users ON transactions.producttransaction.AccountID = account.users.AccountID)INNER JOIN inventory.goodslistinfo ON transactions.producttransaction.GoodsID = inventory.goodslistinfo.GoodsID)INNER JOIN deliverystatus ON producttransaction.TransactionID = deliverystatus.TransactionID)INNER JOIN deliverycat ON deliverystatus.DeliveryCode = deliverycat.DeliveryCode);");
        if(is_array($result)) return $result;
    }

    public function getTransactionInfo($uid){
        $result = $this->transactionDB->query_fetch_single("SELECT transactions.producttransaction.TransactionID, account.users.Name, account.users.Email, inventory.goodslistinfo.GoodsName, inventory.goodslistinfo.GoodsCategory,transactions.producttransaction.TransactionDate, transactions.producttransaction.Quantity, transactions.producttransaction.TotalPrice, deliverystatus.DeliveryCode FROM (((transactions.producttransaction INNER JOIN account.users ON transactions.producttransaction.AccountID = account.users.AccountID)INNER JOIN inventory.goodslistinfo ON transactions.producttransaction.GoodsID = inventory.goodslistinfo.GoodsID)INNER JOIN deliverystatus ON producttransaction.TransactionID = deliverystatus.TransactionID) WHERE producttransaction.TransactionID = ? ;", $uid);
        if(is_array($result)) return $result;
    }
}



?>