
<div class="addcart-success link active"></div>
<div class="clearfix"></div>
<?php
$this->widget('Shop.components.ListProductsOnPage', array(
    'isOnIndex' => false,
    'cateAlias' => $cateAlias,
    'tab' => $tab,
    'url' => Helper::url('/Shop/product/listProductsByCategory', array('cateAlias' => $cateAlias))
));