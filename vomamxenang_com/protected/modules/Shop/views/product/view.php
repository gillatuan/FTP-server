<?php
$explode = Helper::explodeCharData($data->image);
$noImage = Helper::baseUrl() . '/uploads/no_image.jpg';
$dataImage = $data->image ? Helper::renderImage($data->image, 'uploads/details/Products', ',', true) : '/uploads/no_image.jpg';

$explodeFolder = explode('/', $dataImage);
$imgZoom = '';
if ($explodeFolder[2] != 'no_image.gif') {
    $imgZoom = str_replace($explodeFolder[2], 'original', $dataImage);
}
?>
    <div class="wrapper-module module product-detail">
        <div class="product-neighbours">
            <?php if ($older) { ?>
                <a href="<?php echo Helper::url('/Shop/product/view', array('cateAlias' => $older->cate->alias, 'alias' => $older->alias)) ?>" class="previous-page" title="<?php echo count($older) ? $older->name : ''; ?>"><?php echo count($older) ? $older->name : ''; ?></a>
            <?php } ?>
            <?php if ($newer) { ?>
                <a href="<?php echo Helper::url('/Shop/product/view', array('cateAlias' => $newer->cate->alias, 'alias' => $newer->alias)) ?>" class="next-page" title="<?php echo count($newer) ? $newer->name : ''; ?>"><?php echo count($newer) ? $newer->name : ''; ?></a>
            <?php } ?>

            <div class="clear"></div>
        </div>
        <div class="sixcol product-images">
            <div class="main-image">
                <img class="zoomImg" src="<?php echo $dataImage; ?>" data-large="<?php echo $imgZoom; ?>" alt="<?php echo $data->name; ?>" />
            </div>
            <?php if (is_array($explode)) { ?>
            <ul class="thumb-image clearfix">
                <?php foreach ($explode as $image) { ?>
                    <li><img src="<?php echo '/uploads/thumb/Products/' . $image ?>" alt="<?php echo $image; ?>" /></li>
                <?php } ?>
            </ul>
            <?php } ?>
            <div class="clearfix"></div>
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style social"
                 addthis:url="<?php echo Yii::app()->createAbsoluteUrl(Yii::app()->request->url); ?>"
                 addthis:title="<?php echo $data->name; ?>"
                 addthis:description="<?php echo $data->info; ?>">
                <a href="http://www.addthis.com/bookmark.php?v=250&pubid=ra-51b74b7d615c70ad" _cke_saved_href="http://www.addthis.com/bookmark.php?v=250&pubid=ra-51b74b7d615c70ad" class="addthis_button_compact"></a>
                <a class="addthis_button_facebook_like fourcol" fb:like:layout="button_count"></a>
                <a class="addthis_button_tweet fourcol"></a>
                <a class="addthis_button_google_plusone twocol"></a>
                <a class="addthis_button_pinterest_pinit twocol last"></a>
<!--                <a class="addthis_counter addthis_pill_style"></a>-->
            </div>
            <!-- AddThis Button END -->
        </div>
        <div class="sixcol product-info last">
            <?php Helper::renderFlash('successMessage', 'link active', false, 'active', 20000); ?>
            <?php Helper::renderFlash('successUpdateProfile', 'link active', false, 'active'); ?>

            <div class="link active addcart-success"></div>
            <div class="clearfix"></div>
            <h2><?php echo $data->name; ?></h2>
        </div>
        <div class="sixcol buy-area last">
            <div class="vote">
                <span class="text-rating"><?php echo Helper::t('rating'); ?>: </span>
                <?php $this->widget('CStarRating', array(
                    'value'    => $data->averageRating(),
                    'name'     => 'rating-' . $data->id,
                    'readOnly' => true,
                )); ?><span>&nbsp; / <?php echo $data->countReview; ?> reviews</span>
            </div>
            <div class="price">
                <?php if (!empty($data->price)) { ?>
                    <?php if (!empty($data->price_curr)) { ?>
                        <p class="price-current"><?php echo Helper::t('price_curr'); ?>: <span class="destroy"><?php echo Helper::formatNumber($data->price_curr) ?></span></p>
                    <?php } ?>
                    <?php if ($data->is_sale_off != 0 && $data->discount != 0) {
                        $discountedPrice = $data->price * ((100 - $data->discount) / 100);
                        $discountPrice = $data->price * $data->discount / 100;
                        ?>
                        <p class="price-current"><?php echo Helper::t('price'); ?>: <span><?php echo Helper::formatNumber($data->price) ?></span></p>
                        <p>Sales price: <span class="sale-off"><?php echo Helper::formatNumber($discountedPrice); ?></span></p>
                        <p><?php echo Helper::t('discount'); ?>: <span class="discount">
                                <?php echo Helper::formatNumber($discountPrice) ?>
                                <input type="hidden" class="price-discount" value="<?php echo $data->price * $data->discount / 100; ?>" />
                            </span></p>
                    <?php } else { ?>
                        <p><?php echo Helper::t('price'); ?>: <span class="sale-off"><?php echo Helper::formatNumber($data->price) ?></span></p>
                    <?php } ?>
                <?php } else { ?>
                    <p class="no-price"><?php echo Helper::t('price'); ?>: <span><?php echo Helper::t('Contact_menu'); ?></span></p>
                <?php } ?>

                <?php if (!empty($data->barcode)) { ?>
                    <p><?php echo Helper::t('barcode'); ?>: <span><?php echo $data->barcode; ?></span></p>
                <?php } ?>

                <?php /*if (!empty($data->info)) { */?><!--
                    <p><?php /*echo Helper::t('info'); */?>: <span><?php /*echo nl2br($data->info); */?></span></p>
                --><?php //} ?>

                <p class="showFormReview"><a href="javascript:void:;" title="Review" class="link"><?php echo Helper::t('yourComments'); ?></a></p>
                    <div class="addtocart-area">
                        <input type="text" name="quantity-input" class="quantity-input" />
                        <div class="quantity-controls">
                            <input type="button" class="quantity-plus" />
                            <input type="button" class="quantity-minus" />
                        </div>

                        <?php if (!empty($data->price)) { ?>
                            <input type="submit" name="addtocart" class="addtocart-button" value="<?php echo Helper::t('BUY_THIS_ITEM'); ?>" title="<?php echo Helper::t('BUY_THIS_ITEM'); ?>" />
                        <?php } ?>
                    </div>
            </div>
        </div>
        <div class="clear top-10">&nbsp;</div>

    <!--<div class="manufacturer">
        <div style="font-weight: bold;">Manufacturer: <a href="#" title="Blanca">Blanca</a></div>
    </div>-->
        <div class="module-review">
            <?php $this->renderPartial('Admin.views.review._form', array('model' => $modelReview)) ?>
        </div>
        <div class="product-desc">
            <h3 class="title"><?php echo Helper::t('description'); ?></h3>
            <?php echo $data->description; ?>
        </div>
        <div class="mod-review clearfix">
            <h3 class="title"><?php echo Helper::t('reviews'); ?></h3>
            <?php $this->widget('Shop.components.Reviews', array('isListPage' => false, 'productId' => $data->id)); ?>
        </div>
    </div>

<?php
$scriptAddMore = '
$(function() {
    $(".showFormReview a.link").click(function () {
        $("div.module-review").toggle("slow");

        return false;
    });

    $(".thumb-image img").click(function () {
        var srcImage = $(this).attr("alt");
        $(".main-image img").attr("src", "' . Helper::themeUrl() . '/images/loading.gif");
        $(".main-image img").attr({
            "src": "/uploads/details/Products/" + srcImage,
            "data-large": "/uploads/original/Products/" + srcImage
        });

        /*setTimeout(function() {
            $(".main-image img").attr("src", "/uploads/details/Products/" + srcImage);
        }, 10);*/

        return false;
    });

    $("input.quantity-input").val(1);

    $(".quantity-plus").click(function() {
        var quantity = parseInt($("input.quantity-input").val());
        $("input.quantity-input").val(quantity + 1);

        return false;
    });

    $(".quantity-minus").click(function() {
        var quantity = parseInt($("input.quantity-input").val());
        $("input.quantity-input").val(quantity - 1);

        return false;
    });

    // Add Product to Cart
    $(".addcart-success").hide();
    $(".addtocart-button").click(function() {
        var productAlias = "' . $alias . '";
        var quantity = parseInt($("input.quantity-input").val());
        var url = "' . Helper::url('/Shop/product/updateOrDeleteCart') . '";
        var $this = $(this);

        if (quantity <= 0) {
            alert("Quantity must be larger than 0");

            return false;
        }

        param = {
            alias: productAlias,
            quantity: quantity,
            valueBefore: 0,
            totalValueBefore: 0,
            type: "addCart"
        };

        processAjax(url, param, $this, productAlias, "addCart");

        return false;
    })
})
';
Helper::cs()->registerScript('scriptAddMore', $scriptAddMore, CClientScript::POS_END);
