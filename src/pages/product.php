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

                        <!-- Reviews -->
                        <!-- <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
                        4.0 stars -->
                    </div>
                </div>

                <div class="container-fluid p-0 mt-4">
                    <div class="btn-group mr-4">
                        <button type="button" class="btn btn-success">Buy Now</button>
                    </div>
                    <div class="btn-group mr-4">
                        <button type="button" class="btn btn-danger">Add to Wishlist</button>
                    </div>
                    
                </div>


                <!-- Product Reviews -->
                <!-- <div class="card card-outline-secondary my-4">
                    <div class="card-header">
                        Product Reviews
                    </div>
                    <div class="card-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique
                            necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia,
                            necessitatibus quae sint natus.</p>
                        <small class="text-muted">Posted by Anonymous on 3/1/17</small>
                        <hr>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique
                            necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia,
                            necessitatibus quae sint natus.</p>
                        <small class="text-muted">Posted by Anonymous on 3/1/17</small>
                        <hr>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique
                            necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia,
                            necessitatibus quae sint natus.</p>
                        <small class="text-muted">Posted by Anonymous on 3/1/17</small>
                        <hr>
                        <a href="#" class="btn btn-success">Leave a Review</a>
                    </div>
                </div> -->
                <!-- /.card -->

            </div>
            <!-- /.col-lg-9 -->

        </div>

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php require "src/common/footer.php"; ?>
    <?php require "src/common/scripts.php"; ?>

</body>

</html>