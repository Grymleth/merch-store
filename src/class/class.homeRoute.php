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

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $errorMsg = [];
                if(!is_numeric($_POST['trackNumber']) || intval($_POST['trackNumber']) < 1){
                    array_push($errorMsg, 'Please enter a postive integer.');
                }

                $transactions = new Transaction();
                $result = $transactions->getTransactionInfo($_POST['trackNumber']);
                
                if(!$result || $result['AccountID'] != '0'){
                    array_push($errorMsg, 'This tracking number is invalid.');
                }

                if(empty($errorMsg)){
                    $address = $transactions->getAddressFromTransactionID($result['TransactionID'])['Address'];
                }
            }

            require_once "src/pages/home.php";
        }
        else{
            new Error404();
        }
    }
}

?>