<div class="col-lg-3">

    <h1 class="my-4">Categories</h1>

    <div class="list-group">
        <?php foreach($categories as $category){ ?>
        <a href="<?= __BASE_URL__ ?>category/<?= strtolower($category['goodscatname']) ?>" class="list-group-item
        <?= $category['goodscatname'] == $activeCategory ? 'active' : '' ?>"><?= str_replace('_', ' ', $category['goodscatname']) ?></a>
        <?php } ?>
    </div>

</div>