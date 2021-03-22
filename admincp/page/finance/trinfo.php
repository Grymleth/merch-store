<?php
    $transactionInfo = NULL;
    $transactionID =  8;
    $transaction_result = "_";
    try {
        $transaction = new Transaction();
        $transactionInfo = $transaction->getTransactionInfo($transactionID);

        if(isset($_GET["request"])){
            $transactionID = $_GET["request"];
            $transactionInfo = $transaction->getTransactionInfo($transactionID);
            if(!is_array($transactionInfo)){
                include(__ROOT_DIR__."page/404.php");
                die();
            }
        } 
        else {
            $transactionInfo = $transaction->getTransactionInfo($transactionID);
        }
        
        if(isset($_POST["confirmDeliveryStatus"]) && isset($_POST["transactionDeliveryStatus"]))
            $transaction_result = $transaction->changeDeliveryStatus($transactionID, $_POST["transactionDeliveryStatus"]);

        $transactionInfo = $transaction->getTransactionInfo($transactionID);
        # prevent leaking uwu
        unset($transaction);
    } catch (Exception $ex) {
        die($ex);
    }
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Feedback alert -->
        <?php
            if($transaction_result == "")
                echo "<div class=\"alert alert-success\">Succesfully changed!</div>";
        ?>
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Transaction Info</h1>
		<form method="post">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Transaction ID</span>
                </div>
                <input type="text" class="form-control" placeholder="Transaction ID" name="strID" value=<?php echo $transactionInfo["TransactionID"]; ?> readonly></input>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Name</span>
                </div>
                <input type="text" class="form-control" placeholder="Name" name="infoName" value="<?php echo $transactionInfo["Name"]; ?>" readonly></input>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Email</span>
                </div>
                <input type="email" class="form-control" name="infoEmail" placeholder="name@example.com" value="<?php echo $transactionInfo["Email"]; ?>" readonly></input>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Product Name</span>
                </div>
                <input type="text" class="form-control" name="ProductName" placeholder="Product Name" value="<?php echo $transactionInfo["GoodsName"]; ?>" readonly></input>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Product Category</span>
                </div>
                <select class="form-control" name="ProductCategory" disabled="true">
                    <option value="1" <?php if($transactionInfo["GoodsCategory"] == 1){echo "selected";} ?> >Hats</option>
                    <option value="2" <?php if($transactionInfo["GoodsCategory"] == 2){echo "selected";} ?> >Hoodies</option>
                    <option value="3" <?php if($transactionInfo["GoodsCategory"] == 3){echo "selected";} ?> >Jackets</option>
                    <option value="4" <?php if($transactionInfo["GoodsCategory"] == 4){echo "selected";} ?> >Long Sleeves</option>
                    <option value="5" <?php if($transactionInfo["GoodsCategory"] == 5){echo "selected";} ?> >Shirts</option>
                    <option value="6" <?php if($transactionInfo["GoodsCategory"] == 6){echo "selected";} ?> >Miscellaneous</option>
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Transaction Date</span>
                </div>
                <input type="text" class="form-control" placeholder="Year"  name="iDate" value="<?php echo $transactionInfo["TransactionDate"]; ?>" readonly></input>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Quantity</span>
                </div>
                <input type="number" class="form-control" value="<?php echo $transactionInfo["Quantity"]; ?>" min="0" max="1000" step="1" readonly></input>
            </div>  
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Total Price</span>
                </div>
                <input type="text" class="form-control" placeholder="" name="strPrice" value="<?php echo $transactionInfo["TotalPrice"]; ?>" readonly>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Delivery Status</span>
                </div>
                <?php
                        echo "
                    <select class=\"form-control\" name=\"transactionDeliveryStatus\"";
                        if(isset($_POST["editDeliveryStatus"])){
                            echo " 
                    enabled>
                        <option value=\"1\"";if($transactionInfo["DeliveryCode"] == 1){echo "selected";} echo ">Processing</option>
                        <option value=\"2\"";if($transactionInfo["DeliveryCode"] == 2){echo "selected";} echo ">Packed</option>
                        <option value=\"3\"";if($transactionInfo["DeliveryCode"] == 3){echo "selected";} echo ">Shipped</option>
                        <option value=\"4\"";if($transactionInfo["DeliveryCode"] == 4){echo "selected";} echo ">Delivered</option>
                    </select>
                    <button class=\"btn btn-primary ml-4\" type=\"submit\" name=\"confirmDeliveryStatus\">Confirm</button>";
                        } 
                        else {
                            echo " 
                    disabled>
                        <option value=\"1\"";if($transactionInfo["DeliveryCode"] == 1){echo "selected";} echo ">Processing</option>
                        <option value=\"2\"";if($transactionInfo["DeliveryCode"] == 2){echo "selected";} echo ">Packed</option>
                        <option value=\"3\"";if($transactionInfo["DeliveryCode"] == 3){echo "selected";} echo ">Shipped</option>
                        <option value=\"4\"";if($transactionInfo["DeliveryCode"] == 4){echo "selected";} echo ">Delivered</option>
                    </select>
                    <button class=\"btn btn-primary ml-4\" type=\"submit\" name=\"editDeliveryStatus\">Edit</button>";
                        }
                ?>
            </div>
  
        </form>
    </div>
    <!-- /.container-fluid -->