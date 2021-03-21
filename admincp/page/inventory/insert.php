<?php
    $addProd_result = "_";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["add_button_submit"])){
            try {
                $inventory = new Inventory();

                #registerAccount($strEmail, $strName, $strPass, $strCPass, $strAddress, $strContactNo, $bSex, $dateOfBirth)
                $addProd_result = $inventory->addProduct(
                    $_POST["prodName"],
                    $_POST["prodImg"],
                    $_POST["prodCategory"],
                    $_POST["prodDescription"],
                    $_POST["prodPrice"],
                    $_POST["prodStocks"]);

                # prevent leaks uwu
                unset($inventory);

            } catch (Exception $ex) {
                die($ex);
            }
        }

    }

?>


    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Add Product</h1>
        <form method="post">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Product Image</span>
                </div>
                <input type="text" class="form-control" placeholder="Image Link" name="prodImg" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Product Name</span>
                </div>
                <input type="text" class="form-control" placeholder="Name" name="prodName" required>
            </div>           
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Product Category</span>
                </div>
                <select class="form-control" name="prodCategory">
                    <option value="1">Hats</option>
                    <option value="2">Hoodies</option>
                    <option value="3">Jackets</option>
                    <option value="4">Long Sleeves</option>
                    <option value="5">Shirts</option>
                    <option value="6">Miscellaneous</option>
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Product Description</span>
                </div>
                <input type="text" class="form-control" placeholder="Description of Product" name="prodDescription" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Product Price</span>
                </div> 
                <input type="number" class="form-control" placeholder="Price in Peso" name="prodPrice" style="-webkit-appearance:none; -moz-appearance: textfield;">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Number of Stocks</span>
                </div>
                <input type="number" class="form-control" placeholder="&infin;" name="prodStocks" min="0" max="1000" step="1"/>
            </div>  
            <div class="input-group mb-3">
            <div class="container text-center">
                <button type="submit" name="add_button_submit" class="btn btn-primary btn-md">Add Product</button>
            </div>    
            </div>                 
        </form>
    </div>
    <!-- /.container-fluid -->