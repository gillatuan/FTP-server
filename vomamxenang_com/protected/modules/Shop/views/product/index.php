<?php Helper::renderFlash('SUCCESS_ORDER', 'addcart-success link active block', false, 'addcart-success', 5000, Helper::url('/Shop/product/index')) ?>

<div class="addcart-success link active"></div>
<div class="clearfix"></div>
<!--Products in Category-->
<?php if (count($categories)) { ?>
    <?php foreach ($categories as $cate) { ?>
        <div class="twelvecol products-in-category">
            <h2><?php echo $cate->name; ?></h2>
            <?php $this->widget('application.modules.Shop.components.ListProductsOnPage', array(
                'isOnIndex' => true,
                'cateAlias' => $cate->alias
            )); ?>
        </div>

    <?php }
} else { ?>
    <div class="twelvecol products-in-category">
        <h2><?php echo Helper::t('NO_RESULTS_KEY'); ?></h2>
    </div>
<?php }