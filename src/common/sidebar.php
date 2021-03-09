<div class="col-lg-3">

    <h1 class="my-4">Categories</h1>

    <div class="list-group">
        <?php foreach($categories as $category){ ?>
        <a href="/merch-store/category/<?= strtolower($category['goodscatname']) ?>" class="list-group-item
        <?= $category['goodscatname'] == $activeCategory ? 'active' : '' ?>"><?= $category['goodscatname'] ?></a>
        <?php } ?>
    </div>

</div>