<?php
    $transaction_result = NULL;
    try {
        $transaction = new Transaction();
        $inventory = new Inventory();

        // get transaction list
        $transaction_result = $transaction->getTransactionList();

        // pie chart labels
        $categories = $inventory->getCategoryList();

        // list of colors for category
        $colors = ['primary', 'success', 'info', 'warning', 'danger', 'secondary'];

        // pie chart data
        $countByCategory = [];

        foreach($categories as $category){
            $count = $transaction->getTransactionCountByCategory($category['GoodsCatName'])['Quantity'];
            array_push($countByCategory, isset($count) ? $count : 0);
        }

        // area chart data
        $totalPriceByMonth = [];
        for($i = 1; $i <= 12; $i++){
            // get Transaction Total Price by each month for the current year
            $totalPrice = $transaction->getTransactionTotalPriceByMonthYear($i, date("Y"))['TotalPrice'];
            array_push($totalPriceByMonth, isset($totalPrice) ? $totalPrice: 0);
        }

        // monthly earnings
        $monthlyEarnings = $transaction->getTransactionTotalPriceByMonthYear(date("n"), date("Y"))['TotalPrice'];

        // yearly earnings
        $yearlyEarnings = $transaction->getTransactionTotalPriceByYear(date("Y"))['TotalPrice'];
        # prevent leaks uwu
        unset($transaction);
        unset($inventory);

    } catch (Exception $ex) {
        die($ex);
    }

javascript($categories, $countByCategory, $totalPriceByMonth);

// send data to js script
function javascript($categories, $countByCategory, $totalPriceByMonth) {
    echo "<script type='text/javascript'>var pie_label = [];";
    foreach($categories as $category){
        echo "pie_label.push(\"" . $category['GoodsCatName'] . "\");";
    }

    echo 'var pie_data = [];';

    foreach($countByCategory as $count){
        echo "pie_data.push(\"" . $count . "\");";
    }

    echo 'var area_data = [];';
    
    foreach($totalPriceByMonth as $totalPrice){
        echo "area_data.push(\"" . $totalPrice . "\");";
    }

    echo "</script>";
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Overview</h1>

    <div class="row">
        <!-- Earnings Monethly -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Earnings (Monthly)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₱<?= number_format($monthlyEarnings,2) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings Annaul -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Earnings (Annual)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₱<?= number_format($yearlyEarnings,2) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <?php for($i = 0; $i < count($categories); $i++){ ?>
                        <span class="mr-2">
                            <i class="fas fa-circle text-<?= $colors[$i] ?>"></i> <?= $categories[$i]['GoodsCatName'] ?>
                        </span>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->