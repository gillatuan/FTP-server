<div class="addcart-success link active"></div>

<div class="twelvecol products-in-category">
    <h2> Các kết quả tìm được với từ khóa "<?php echo $kw; ?>" là: </h2>
    <?php $this->renderPartial('Shop.components.views.listProductWith4Col', array(
        'amountCol' => 'threecol',
        'tab' => '',
        'isOnIndex' => $isOnIndex,
        'productList' => 'product-list',
        'products' => $products,
        'model' => 'Products'
    )); ?>
</div>