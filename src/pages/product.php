<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $product['goodsname'] ?></title>

    <?php require "src/common/header.php"; ?>

</head>

<body>

    <!-- Navigation -->
    <?php require "src/common/navbar.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Sidebar - Category menu -->
            <?php include "src/common/sidebar.php"; ?>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9">

                <div class="card mt-4">
                    <img class="card-img-top img-fluid" src="<?= $product['goodsimage'] ?>" alt="">
                    <div class="card-body">
                        <h3 class="card-title"><?= $product['goodsname'] ?></h3>
                        <h4>₱<?= sprintf('%.2f', $product['goodsprice']) ?></h4>
                        <?php if($product['stocks'] > 0){ ?>
                        <div class="text-success">In Stock</div>
                        <?php }else{ ?>
                        <div class="text-danger">Out of Stock</div>
                        <?php } ?>
                        <p class="card-text"><?= $product['goodsdescription'] ?></p>
                    </div>
                </div>

                <div class="container-fluid p-0 mt-4">
                    <div class="btn-group mr-4">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#checkoutModal">Buy Now</button>
                    </div>
                    <div class="btn-group mr-4">
                        <button type="button" class="btn btn-danger">Add to Wishlist</button>
                    </div>
                    
                </div>

                <!-- Checkout Modal -->

                <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Complete Purchase</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php require "src/common/checkoutModal.php"; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Checkout Success Modal -->
                <div class="modal fade show" id="successModal" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Success</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-success">Purchase Complete</div>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
            <!-- /.col-lg-9 -->

        </div>

    </div>
    <!-- /.container -->

    <!-- Footer -->
    
    <?php require "src/common/footer.php"; ?>
    <?php require "src/common/scripts.php"; ?>

    <?php if($_SERVER['REQUEST_METHOD'] == 'POST'){ ?>
    <script>
        $(document).ready(() => {
            console.log('hello world');
            $("#successModal").modal('show');
        });
    </script>
    <?php } ?>
</body>

</html>