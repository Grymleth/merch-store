<?php 

class Product{
    private $db;
    public function __construct($param = null){
        if($param != null){
            $this->db = new Database('localhost', 'root', '', 'inventory');
            var_dump($param);

            // handle POST request
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // handle checkout POST request
                if($param == 'checkout'){
                    $goodsid = $_POST['goodsid'];
                    $quantity = $_POST['quantity'];
                    $this->checkout($goodsid, $quantity);
                    return;
                }
                else if($param == 'order'){
                    $goodsid = $_POST['goodsid'];

                    // enter order logic here
                    
                    $this->renderProduct($goodsid);
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
        $result = $this->getProduct($param);
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

    public function checkout($goodsid, $quantity){
        // get product
        $product = $this->getProduct($goodsid);
        
        // clamp max value to 10 or number of stocks left if less
        $max = $product['stocks'] < 10 ? $product['stocks'] : 10;
        $quantity = (int)Common::clampInt($quantity, 1, $max);

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

    }

    public function getProduct($goodsid){
        $result = $this->db->query_fetch_single("SELECT goodsid, goodsname, goodsprice, goodsimage, goodsdescription, goodscategory, stocks 
        FROM goodslistinfo WHERE goodsid = ? ", array($goodsid));
        if(is_array($result)) return $result;
    }
}

?>