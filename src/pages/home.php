<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Homepage</title>

    <!-- Header -->
    <?php require "src/common/header.php"; ?>

</head>

<body>

    <!-- Navigation -->
    <?php require "src/common/navbar.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <?php require "src/common/sidebar.php" ?>

            <div class="col-lg-9">

                <?php if($products == []){ ?>
                <div class="container my-4" id="loop">
                    <h3>No products available</h3>
                </div>
                <?php } else{?>
                <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                    <ol class="carousel-indicators">
                        
                        <?php $n = count($products) < 3 ? count($products) : 3;
                        for($i = 0; $i < $n; $i++){ ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>" <?= $i == 0 ? "class=\"active\"" : '' ?>></li>
                        <?php } ?>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <?php 
                            $n = count($products) < 3 ? count($products) : 3;
                            for($i = 0; $i < $n; $i++){ ?>
                        <div class="carousel-item <?= $i == 0 ? 'active' : '' ?>">
                            <img class="d-block img-fluid" src="<?= $products[$i]['goodsimage'] ?>" alt="<?= $products[$i]['goodsname'] ?>" style="width:900px;height:350px;">
                        </div>
                        <?php } ?>
                        
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

 
                <div class="row">

                    <?php foreach($products as $product){ ?>
                    <div class="product col-lg-4 col-md-6 mb-4">
                        <div class="card h-100" >
                            <a href="<?= __BASE_URL__ ?>products/<?= $product['goodsid'] ?>"><img class="card-img-top" style="width:15.8rem;" src="<?= $product['goodsimage'] ?>" alt=""></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="<?= __BASE_URL__ ?>products/<?= $product['goodsid'] ?>"><?= $product['goodsname'] ?></a>
                                </h4>
                                <h5>₱<?= number_format($product['goodsprice'], 2) ?></h5>
                                <p class="card-text text-truncate"><?= $product['goodsdescription'] ?></p>
                            </div>

                            <!-- Reviews -->
                            <!-- <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div> -->
                        </div>
                    </div>
                    
                    <?php }} ?>
                </div>

                <!-- /.row -->

                <!-- Pagination with Jquery-->
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        
                    </ul>
                </nav>
            </div>
            <!-- Checkout Success Modal -->
            <div class="modal fade show" id="trackInfoModal" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Track Order</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?php if(empty($errorMsg)){ ?>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Transaction ID</span>
                                </div>
                                <input type="text" class="form-control" value="<?= $result['TransactionID'] ?>" readonly>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Name</span>
                                </div>
                                <input type="text" class="form-control" value="<?= $result['Name'] ?>" readonly>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Email</span>
                                </div>
                                <input type="text" class="form-control" value="<?= $result['Email'] ?>" readonly>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Address</span>
                                </div>
                                <input type="text" class="form-control" value="<?= $address?>" readonly>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Product Name</span>
                                </div>
                                <input type="text" class="form-control" value="<?= $result['GoodsName'] ?>" readonly>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Product Category</span>
                                </div>
                                <input type="text" class="form-control" value="<?= Common::getProductCategoryName($result['GoodsCategory']) ?>" readonly>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Quantity</span>
                                </div>
                                <input type="text" class="form-control" value="<?= $result['Quantity'] ?>" readonly>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Total Price</span>
                                </div>
                                <input type="text" class="form-control" value="<?= $result['TotalPrice'] ?>" readonly>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Delivery Status</span>
                                </div>
                                <input type="text" class="form-control" value="<?= Common::getDeliveryStatus($result['DeliveryCode']) ?>" readonly>
                            </div>
                            <?php } else{ ?>
                            <div class="alert alert-danger"><?= $errorMsg[0] ?></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <?php require "src/common/footer.php"; ?>
    <?php require "src/common/scripts.php"; ?>
    <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['trackNumber'])){ ?>
    <script>
        $(document).ready(() => {
            console.log('hello world');
            $("#trackInfoModal").modal('show');
        });
    </script>
    <?php } ?>
</body>

</html>