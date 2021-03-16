<?php 

class ProductRoute{
    private $db;
    public function __construct($param = null){
        if($param != null){
            $this->db = new Database('localhost', 'root', '', 'inventory');

            // handle POST request
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // handle checkout POST request
                if($param == 'checkout'){
                    $this->checkout();
                    return;
                }
                // handle order POST request
                else if($param == 'order'){  
                    $this->order();
                    return;
                }
            }

            $this->renderProduct($param);

        }
        else{
            new Error404();
        }
    }

    public function renderProduct($param){
        // Get product from database
        $result = $this->getProductInfo($param);
        // check if product exist
        if(!is_array($result)){
            new Error404();
            return;
        }
        $product = $result;

        $result = $this->db->query_fetch("SELECT goodscategory, goodscatname FROM goodscategoryinfo", array());

        $categories = $result;
        // determine which category the product is in
        $activeCategory = $categories[$product['goodscategory'] - 1]['goodscatname'];

        require_once "src/pages/product.php";
    }

    public function checkout(){
        // Data from POST
        $data = [
            'goodsid' => $_POST['goodsid'],
            'quantity' => $_POST['quantity']
        ];
        // get product
        $product = $this->getProductInfo($data['goodsid']);
        
        // clamp max value to 10 or number of stocks left if less
        $max = $product['stocks'] < 10 ? $product['stocks'] : 10;
        $data['quantity'] = (int)Common::clampInt($data['quantity'], 1, $max);

        // checkout data, auto complete shipping details
        if(isset($_SESSION['login'])){
            if($_SESSION['login']){
                $accountDb = new Account();
                $result = $accountDb->getAccountInfo($_SESSION['userId']);

                $shippingDetails = [
                    'name' => $result['Name'],
                    'email' => $result['Email'],
                    'address' => $result['Address']
                ];
            }
        }

        require_once "src/pages/checkout.php";
    }

    public function order(){
        $data = [
            'goodsId' => $_POST['goodsid'],
            'quantity' => $_POST['quantity'],
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'address' => $_POST['address']
        ];
        var_dump($_POST);

        // set userId to 0 if not registered
        $userId = isset($_SESSION['login']) ? $_SESSION['userId'] : 0;

        // order login
        // get total price of transaction
        $products = new Inventory();
        $totalPrice = $products->getProductPrice($data['goodsId'])['goodsprice'] * (int) $data['quantity'];

        // get remaining stock avaialable
        $stock = $products->getProductStock($data['goodsId'])['stocks'];
        // transaction DB
        $transactions = new Transaction();
        // if user is registered
        if($userId != 0){
            $transactions->createTransaction($userId, $data['goodsId'], $data['quantity'], $totalPrice);
        }
        // if user is not registered
        else{
            $transactions->createNoRegTransaction($data['name'], $data['email'], $data['address'], $data['goodsId'], $data['quantity'], $totalPrice);
        }

        $products->changeStock($data['goodsId'], $stock - $data['quantity']);

        $this->renderProduct($data['goodsId']);
    }

    public function getProductInfo($goodsid){
        $result = $this->db->query_fetch_single("SELECT goodsid, goodsname, goodsprice, goodsimage, goodsdescription, goodscategory, stocks 
        FROM goodslistinfo WHERE goodsid = ? ", array($goodsid));
        if(is_array($result)) return $result;
    }
}

?>