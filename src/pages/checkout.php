<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Checkout</title>

    <!-- Header -->
    <?php require "src/common/header.php"; ?>

</head>

<body>

    <!-- Navigation -->
    <?php require "src/common/navbar.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 order-md-2 mb-4">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Your item</span>
                        </h4>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0"><?= $product['goodsname'] . ' x ' . $data['quantity'] ?> </h6>
                                    <small class="text-muted"><?= $product['goodsdescription'] ?></small>
                                </div>
                                <span class="text-muted">₱<?= number_format($product['goodsprice']) ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total (PHP)</span>
                                <strong>₱<?= number_format($product['goodsprice'] * $data['quantity']) ?></strong>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-8 order-md-1">
                        <h4 class="mb-3">Shipping address</h4>
                        <form action="<?= __BASE_URL__ ?>products/order" method="POST">
                            <div class="mb-3">
                                <label for="name">Full Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="John Doe" 
                                value="<?= isset($_SESSION['login']) ? $shippingDetails['name'] : '' ?>" required>
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com"
                                value="<?= isset($_SESSION['login']) ? $shippingDetails['email'] : '' ?>">
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St" 
                                value="<?= isset($_SESSION['login']) ? $shippingDetails['address'] : '' ?>" required>
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>
                            <hr class="mb-4">

                            <h4 class="mb-3">Payment</h4>
                        
                            <div class="">
                                <label for="paypal"><img src="https://cdn.iconscout.com/icon/free/png-512/paypal-54-675727.png" width="75rem" alt=""></label>
                                <input type="email" class="form-control" id="paypal" placeholder="you@example.com">
                                <div class="invalid-feedback">
                                    Please enter a valid paypal address.
                                </div>
                            </div>

                            <!-- Hidden fields -->
                            <input type="hidden" name="goodsid" value="<?= $product['goodsid'] ?>">
                            <input type="hidden" name="quantity" value="<?= $data['quantity'] ?>">

                            <hr class="mb-4">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                        </form>
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
</body>

</html>


