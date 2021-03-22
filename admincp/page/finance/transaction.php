<?php
    $transaction_result = NULL;
    try {
        $transaction = new Transaction();

        #registerAccount($strEmail, $strName, $strPass, $strCPass, $strAddress, $strContactNo, $bSex, $dateOfBirth)
        $transaction_result = $transaction->getTransactionList();

        # prevent leaks uwu
        unset($transaction);

    } catch (Exception $ex) {
        die($ex);
    }

?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Transaction Logs</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Transaction List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Product Name</th>
                            <th>Product Category</th>
                            <th>Transaction Date</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Delivery Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Product Name</th>
                            <th>Product Category</th>
                            <th>Transaction Date</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Delivery Status</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                         <?php
                                if(is_array($transaction_result)){
                                    foreach($transaction_result as $elem){
                                    var_dump($elem);
                                    echo
                                        "
                            <tr>
                            	<td>".$elem["TransactionID"]."</td>
                                <td>".$elem["Name"]."</td>
                                <td>".$elem["Email"]."</td>
                                <td>".$elem["GoodsName"]."</td>
                                <td>".$elem["GoodsCategory"]."</td>
                                <td>".$elem["TransactionDate"]."</td>
                                <td>".$elem["Quantity"]."</td>
                                <td>".$elem["TotalPrice"]."</td>
                                <td>".$elem["DeliveryDesc"]."</td>
                                <td><button class=\"btn btn-primary\">View</button></td>
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