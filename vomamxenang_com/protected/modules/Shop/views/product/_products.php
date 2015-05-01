<?php
$image = $data->image ? Helper::baseUrl() . '/uploads/Products/' . Helper::explodeCharData($data->image, ',', false, true) : Helper::baseUrl() . '/uploads/no_image.jpg';
$image = $data->image ? Helper::renderImage($data->image, 'uploads/Products', ',', false, true) : Helper::baseUrl() . '/uploads/no_image.jpg';
$last = ($index + 1) % 4 == 0 ? 'last' : '';
?>
<div class="style-product <?php echo $last; ?>">
    <div class="product">
        <div class="style-image">
            <a class="image-title" href="<?php echo Helper::url('/Shop/product/view', array('alias' => $data->alias)); ?>" title="<?php echo $data->name; ?>">
                <img src="<?php echo $image; ?>" alt="<?php echo $data->name; ?>" />
            </a>
        </div>
        <h4><a href="<?php echo Helper::url('/Shop/product/view', array('alias' => $data->alias)); ?>"
               title="<?php echo $data->name; ?>"><?php echo Helper::getDisplayedWords($data->name, 4); ?></a></h4>

        <p class="info"><?php echo Helper::getDisplayedWords($data->info, 10); ?> <a
                href="<?php echo Helper::url('/Shop/product/view', array('alias' => $data->alias)); ?>" title="<?php echo $data->name; ?>"
                style="display: inline;">more</a></p>

        <div class="cart">
            <?php if ($data->discount != 0 && $data->is_sale_off != 0) { ?>
                <p class="price destroy">Price: <?php echo Helper::formatNumber($data->price); ?></p>
                <p class="price sp-color">Sale Price: <?php echo Helper::formatNumber($data->price - $data->price * $data->discount / 100); ?></p>
            <?php } else { ?>
                <p class="price sp-color">Price: <?php echo Helper::formatNumber($data->price); ?></p>
            <?php } ?>
            <p class="price sp-color">Mã SP: <?php echo $data->barcode; ?></p>

            <a href="javascript:void;" title="Mua sản phẩm" class="add-cart link" id="id-<?php echo $data->alias; ?>">Mua sản phẩm</a>
        </div>
    </div>
</div>
