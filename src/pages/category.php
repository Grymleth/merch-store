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

            <div class="col-lg-3">

                <h1 class="my-4"><?= SITENAME ?></h1>
                <div class="list-group">
                    <?php foreach($categories as $category){ ?>
                    <a href="/merch-store/category/<?= strtolower($category['goodscatname']) ?>" class="list-group-item <?= strtolower($category['goodscatname']) == $param ? 'active' : '' ?>"><?= $category['goodscatname'] ?></a>
                    <?php } ?>
                </div>

            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9">

                <div class="row my-4">
                    <?php if($products == []){ ?>

                    <div class="container my-4">
                        <h3>No products available</h3>
                    </div>
                    <?php } ?>
                    
                    <?php foreach($products as $product){ ?>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <a href="#"><img class="card-img-top" src="<?= $product['goodsimage'] ?>" alt=""></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="/merch-store/products/<?= $product['goodsid'] ?>"><?= $product['goodsname'] ?></a>
                                </h4>
                                <h5>₱<?= sprintf('%.2f', $product['goodsprice']) ?></h5>
                                <p class="card-text"><?= $product['goodsdescription'] ?></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>

                    <?php } ?>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <?php require "src/common/footer.php"; ?>
</body>

</html>