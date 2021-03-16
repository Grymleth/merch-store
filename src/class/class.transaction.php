<?php 

class Transaction{

    function __construct() {
        // TODO: change Database initialization
        $this->transactionDB = new Database("127.0.0.1", "root", "", "transactions");
	}

    function createTransaction($userId, $goodsId, $quantity, $totalPrice){
        // insert into producttransaction table
        $result = $this->transactionDB->query("INSERT INTO producttransaction (AccountID, GoodsID, Quantity, TotalPrice) 
        VALUES (?, ?, ?, ?)", array($userId, $goodsId, $quantity, $totalPrice));

        // return error
        if(!$result) return "Account not succesfully registered for unknown reasons. Contact the Administrator";
    }

    function createNoRegTransaction($name, $email, $address, $goodsId, $quantity, $totalPrice){
        $this->createTransaction(0, $goodsId, $quantity, $totalPrice);

        // get latest producttransaction record
        $transactionId = $this->getLatestTransaction()['transactionID'];

        // insert new record into noregtransaction table
        $result = $this->transactionDB->query("INSERT INTO noregtransaction (transactionID, name, email, address)
        VALUES (?, ?, ?, ?)", array($transactionId, $name, $email, $address));
        
        if(!$result) return "Account not succesfully registered for unknown reasons. Contact the Administrator";
    }

    function getLatestTransaction(){
        $result = $this->transactionDB->query_fetch("SELECT transactionID, accountID, goodsID, transactionDate, quantity, totalPrice 
        FROM producttransaction ORDER BY transactionDate DESC");
        if(is_array($result)) return $result[0];
    }
}

?>