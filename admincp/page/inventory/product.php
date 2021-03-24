<?php
    $productInfo = NULL;
    $productID = 1;
    $prod_result = "_";
    try {
        $inventory = new Inventory();
        $productInfo = $inventory->getProductInfo($productID);

        if(isset($_GET["request"])){
            $productID = $_GET["request"];
            $productInfo = $inventory->getProductInfo($productID);
            if(!is_array($productInfo)){
                include(__ROOT_DIR__."page/404.php");
                die();
            }
        } 
        else {
            $productInfo = $inventory->getProductInfo($productID);
        }

        if(!is_array($productInfo)){
            include(__ROOT_DIR__."page/404.php");
            die();
        }
        
        if(isset($_POST["confirmName"]) && isset($_POST["prodName"]))
            $prod_result = $inventory->changeName($productID, $_POST["prodName"]);
        else if(isset($_POST["confirmImg"]) && isset($_POST["prodImg"]))
            $prod_result = $inventory->changeImage($productID, $_POST["prodImg"]);
        else if(isset($_POST["confirmCategory"]) && isset($_POST["prodCategory"]))
            $prod_result = $inventory->changeCategory($productID, $_POST["prodCategory"]);
        else if(isset($_POST["confirmDesc"]) && isset($_POST["prodDesc"]))
            $prod_result = $inventory->changeDescription($productID, $_POST["prodDesc"]);
        else if(isset($_POST["confirmPrice"]) && isset($_POST["prodPrice"]))
            $prod_result = $inventory->changePrice($productID, $_POST["prodPrice"]);
        else if(isset($_POST["confirmStocks"]) && isset($_POST["prodStocks"]))
            $prod_result = $inventory->changeStocks($productID, $_POST["prodStocks"]);

        $productInfo = $inventory->getProductInfo($productID);

        # prevent leaking uwu
        unset($inventory);
    } catch (Exception $ex) {
        die($ex);
    }
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Product Info</h1>
        <!-- Feedback alert -->
        <?php
            if($prod_result == ""){
                echo "<div class=\"alert alert-success\">Succesfully changed!</div>";
            } else if ($prod_result != "_"){
                echo "<div class=\"alert alert-danger\">".$prod_result."</div>";
            }
        ?>
        <div class="text-center">
        <img class="mb-3 d-inline" src=<?php echo $productInfo["GoodsImage"]; ?> style="width:10rem;" alt=""><br>
        </div>
        <form method="post">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Product Name</span>
                </div>
                <?php
                    echo "
                <input type=\"text\" class=\"form-control\" placeholder=\"Product Name\" name=\"prodName\" value=\"".$productInfo["GoodsName"]."\"";
                    if(isset($_POST["editName"])){
                        echo " 
                required>
                <button class=\"btn btn-primary ml-4\" type=\"submit\" name=\"confirmName\">Confirm</button>";
                    } else {
                        echo " 
                readonly>
                <button class=\"btn btn-primary ml-4\" type=\"submit\" name=\"editName\">Edit</button>";
                    }
                ?>
            </div> 
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Product Image</span>
                </div>
                <?php
                    echo "
                <input type=\"text\" class=\"form-control\" placeholder=\"Image Link\" name=\"prodImg\" value=\"".$productInfo["GoodsImage"]."\"";
                    if(isset($_POST["editImg"])){
                        echo " 
                required>
                <button class=\"btn btn-primary ml-4\" type=\"submit\" name=\"confirmImg\">Confirm</button>";
                    } else {
                        echo " 
                readonly>
                <button class=\"btn btn-primary ml-4\" type=\"submit\" name=\"editImg\">Edit</button>";
                    }
                ?>
            </div>          
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Product Category</span>
                </div>
                <?php
                    echo "
                <select class=\"form-control\" name=\"prodCategory\" value=\"".$productInfo["GoodsCategory"]."\"";
                    if(isset($_POST["editCategory"])){
                        echo " 
                disabled=\"false\">
                    <option value=\"1\">Hats</option>
                    <option value=\"2\">Hoodies</option>
                    <option value=\"3\">Jackets</option>
                    <option value=\"4\">Long Sleeves</option>
                    <option value=\"5\">Shirts</option>
                    <option value=\"6\">Miscellaneous</option>
                </select>
                <button class=\"btn btn-primary ml-4\" type=\"confirmCategory\">Confirm</button>";
                    } else {
                        echo " 
                disabled=\"true\">
                    <option value=\"1\"";if($productInfo["GoodsCategory"] == 1){echo "selected";} echo ">Hats</option>
                    <option value=\"2\"";if($productInfo["GoodsCategory"] == 2){echo "selected";} echo ">Hoodies</option>
                    <option value=\"3\"";if($productInfo["GoodsCategory"] == 3){echo "selected";} echo ">Jackets</option>
                    <option value=\"4\"";if($productInfo["GoodsCategory"] == 4){echo "selected";} echo ">Long Sleeves</option>
                    <option value=\"5\"";if($productInfo["GoodsCategory"] == 5){echo "selected";} echo ">Shirts</option>
                    <option value=\"6\"";if($productInfo["GoodsCategory"] == 6){echo "selected";} echo ">Miscellaneous</option>
                </select>
                <button class=\"btn btn-primary ml-4\" type=\"editCategory\">Edit</button>";
                    }
                ?>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Product Description</span>
                </div>
                <?php
                    echo "
                <input type=\"text\" class=\"form-control\" placeholder=\"Product Description\" name=\"prodDesc\" value=\"".$productInfo["GoodsDescription"]."\"";
                    if(isset($_POST["editDesc"])){
                        echo " 
                required>
                <button class=\"btn btn-primary ml-4\" type=\"submit\" name=\"confirmDesc\">Confirm</button>";
                    } else {
                        echo " 
                readonly>
                <button class=\"btn btn-primary ml-4\" type=\"submit\" name=\"editDesc\">Edit</button>";
                    }
                ?>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Product Price</span>
                </div>
                <?php
                    echo "
                <input type=\"text\" class=\"form-control\" placeholder=\"Product Price\" name=\"prodPrice\" value=\"".$productInfo["GoodsPrice"]."\" min=\"0\" style=\"-webkit-appearance:none; -moz-appearance: textfield;\"";
                    if(isset($_POST["editPrice"])){
                        echo " 
                required>
                <button class=\"btn btn-primary ml-4\" type=\"submit\" name=\"confirmPrice\">Confirm</button>";
                    } else {
                        echo " 
                readonly>
                <button class=\"btn btn-primary ml-4\" type=\"submit\" name=\"editPrice\">Edit</button>";
                    }
                ?>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Number of Stocks</span>
                </div>
                <?php
                    echo "
                <input type=\"number\" class=\"form-control\" placeholder=\"Product Price\" name=\"prodStocks\" value=\"".$productInfo["Stocks"]."\" min=\"0\" max=\"1000\" step=\"1\"";
                    if(isset($_POST["editStocks"])){
                        echo " 
                required>
                <button class=\"btn btn-primary ml-4\" type=\"submit\" name=\"confirmStocks\">Confirm</button>";
                    } else {
                        echo " 
                readonly>
                <button class=\"btn btn-primary ml-4\" type=\"submit\" name=\"editStocks\">Edit</button>";
                    }
                ?>
            </div>        
        </form>
    </div>
    <!-- /.container-fluid -->