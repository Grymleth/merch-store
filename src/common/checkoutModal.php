<div class="container">
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your item</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0"><?= $product['goodsname'] ?></h6>
                        <small class="text-muted"><?= $product['goodsdescription'] ?></small>
                    </div>
                    <span class="text-muted"><?= sprintf('₱%.2f', $product['goodsprice']) ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong>$20</strong>
                </li>
            </ul>
        </div>

        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Shipping address</h4>
            <form action="<?= __BASE_URL__ ?>products/checkout" method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control" id="firstName" placeholder="First Name" value="" required>
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Last Name" value="" required>
                        <div class="invalid-feedback">
                            Valid last name is required.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="you@example.com">
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required>
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
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>

                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" name="productid" value="<?= $product['goodsid'] ?>" type="submit">Continue to checkout</button>

            </form>
        </div>
    </div>
</div>