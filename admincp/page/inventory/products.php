<?php
    $reg_result = NULL;
    try {
        $inventory = new Inventory();

        #registerAccount($strEmail, $strName, $strPass, $strCPass, $strAddress, $strContactNo, $bSex, $dateOfBirth)
        $prod_result = $inventory->getProductList();

        # prevent leaks uwu
        unset($inventory);

    } catch (Exception $ex) {
        die($ex);
    }

?>


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Search Product</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Registration Date</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Stocks</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Registration Date</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Stocks</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                           <?php
                                if(is_array($prod_result)){
                                    foreach($prod_result as $elem){
                                    echo
                                        "
                            <tr>
                                <td><img src=".$elem["GoodsImage"]." style=\"width:10rem;\"></img></td>
                                <td>".$elem["GoodsName"]."</td>
                                <td>".$elem["GoodsCategory"]."</td>
                                <td>".$elem["RegDate"]."</td>
                                <td>".$elem["GoodsDescription"]."</td>
                                <td>".$elem["GoodsPrice"]."</td>
                                <td>".$elem["Stocks"]."</td>
                                <td><a href=\"". __BASE_URL__ . "inventory/product/" . $elem["GoodsID"] ."\"class=\"btn btn-primary\">View</a></td>
                            </tr>
                                        ";
                                    }
                                }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->