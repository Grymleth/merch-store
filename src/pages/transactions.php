<?php
    $transaction_result = NULL;
    try {
        $transaction = new Transaction();

        #registerAccount($strEmail, $strName, $strPass, $strCPass, $strAddress, $strContactNo, $bSex, $dateOfBirth)
        $transaction_result = $transaction->getTransactionListByUser($_SESSION['userId']);

        # prevent leaks uwu
        unset($transaction);

    } catch (Exception $ex) {
        die($ex);
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Transaction Logs</title>

    <!-- Header -->
    <?php require "src/common/header.php"; ?>

</head>

<body class="bg-light">

    <?php require "src/common/navbar.php"; ?>   

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                    <div class="col-lg-12">
                        <div class="p-5">
                            <!-- Begin Page Content -->
                            <div class="container-fluid">
                                
                                <!-- DataTales Example -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Transaction Logs</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Transaction ID</th>
                                                        <th>Product Name</th>
                                                        <th>Product Category</th>
                                                        <th>Transaction Date</th>
                                                        <th>Quantity</th>
                                                        <th>Total Price</th>
                                                        <th>Delivery Status</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Transaction ID</th>
                                                        <th>Product Name</th>
                                                        <th>Product Category</th>
                                                        <th>Transaction Date</th>
                                                        <th>Quantity</th>
                                                        <th>Total Price</th>
                                                        <th>Delivery Status</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php
                                                            if(is_array($transaction_result)){
                                                                foreach($transaction_result as $elem){
                                                                echo
                                                                    "
                                                        <tr>
                                                            <td>".$elem["TransactionID"]."</td>
                                                            <td><a href=\"". __BASE_URL__ . "products/" . $elem['GoodsID'] . "\">" . $elem['GoodsName'] . "</a></td>
                                                            <td><a href=\"" . __BASE_URL__ . "category/" . $elem['GoodsCatName'] . "\">" . $elem['GoodsCatName'] . "</a></td>
                                                            <td>".$elem["TransactionDate"]."</td>
                                                            <td>".$elem["Quantity"]."</td>
                                                            <td>".$elem["TotalPrice"]."</td>
                                                            <td>".$elem["DeliveryDesc"]."</td>
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
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <td><a href="<?= __BASE_URL__ ?>category/MISCELLANEOUS"></a></td>

    <?php require "src/common/scripts.php"; ?>

    <script></script>

</body>

</html>