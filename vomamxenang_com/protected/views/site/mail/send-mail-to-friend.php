<style type="text/css">


.onecol, .twocol, .threecol, .fourcol, .fivecol, .sixcol, .sevencol, .eightcol, .ninecol, .tencol, .elevencol {
       margin-right: 15px;
       float: left;
       min-height: 1px;
        width: 250px;
   }
    /* product-list */
    .products-in-category .product-list { margin-bottom: 10px; padding: 0 18px 0 22px; }
    .products-in-category .product-list.topbottom-20 { padding: 20px 18px 20px 22px; }
    .product-list .product {
        max-height: 380px; margin-right: 3.5%; margin-top: 20px; padding: 10px 0; overflow: hidden;
        box-shadow: 0 0 1px #ccc;
        -moz-box-shadow: 0 0 1px #ccc;
        -webkit-box-shadow: 0 0 1px #ccc;
        border: 1px solid #fff;
        border-radius: 4px;
        background: #ffffff;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px
    }
    .product-list .product.last { margin-right: 0; }
    .product-list .product:hover { background-color: #ebebeb; }

        .product-list .product h3 { padding: 0 10px; color: #0088CC; font-weight: bold; text-align: left; }
        .product-list .product .product-image {
            max-width: 100px;
            margin: 5px auto; padding: 5px 10px 0;
            background: #fff; }
        .product-list .product .info { max-height: 67px; padding: 0 10px; margin: 0.7em 0; text-shadow: 0 1px #fff; overflow: hidden; }
        .product-list .product .info a { line-height: 22px; color: #999; text-shadow: 0 1px #fff; }
        .product-list .product .info a:hover { color: #333333; text-decoration: none; }
        .product-list .product .price-group { padding: 0 10px; }
        .product-list .product .price-group a  {
            float: right;  margin-top: 10px; padding: 5px 9px; color: #555; font-size: 11px; text-align: center;
            background: -moz-linear-gradient(top, #f9f9f9 0%, #eeeeee 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #f9f9f9), color-stop(100%, #eeeeee));
            background: -webkit-linear-gradient(top, #f9f9f9 0%, #eeeeee 100%);
            background: -o-linear-gradient(top, #f9f9f9 0%, #eeeeee 100%);
            background: -ms-linear-gradient(top, #f9f9f9 0%, #eeeeee 100%);
            background: linear-gradient(top, #f9f9f9 0%, #eeeeee 100%);
            border: 1px solid #fff;
            border-radius: 3px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            -moz-box-shadow: 0 0 1px #bbb;
            -webkit-box-shadow: 0 0 1px #bbb;
            box-shadow: 0 0 1px #bbb;
            text-shadow: 0 1px #fff;
            text-decoration: none;
        }
        .product-list .product .price-group a:hover {
            border: 1px solid #1fd0fc !important;
            background: #00b3e0 !important;
            color: #fff !important;
            text-shadow: 0 1px rgba(0, 0, 0, .2) !important;
        }
        .price-group .price { margin-top: 5px; }
        .price-group .price .price-text, .price-group .price .price-value { color: #02ABD6; font-weight: bold; text-shadow: 0 1px #FFFFFF; }
        .price-group .price.destroy { text-decoration: line-through; }
        .price-group .price.destroy .price-text, .price-group .price.destroy .price-value { color: #989898; text-shadow: 0 1px #FFFFFF; }

        .product-list .readmore { text-align: right; margin: 15px; }
</style>

<div class="product-list">
    <?php if (count($products)) { ?>
        <?php foreach ($products as $k=>$product) {
            $classLast = ($k+1) % 3 == 0 ? 'last' : '';
            $image = $product->image ? Helper::baseUrl() . '/uploads/Products/' . Helper::explodeCharData($product->image, ',', false, true) : Helper::baseUrl() . '/uploads/no_image.jpg';
            $notMarginTop = $k==0 || $k == 1 || $k == 2 ? 'not-margin-top' : '';
            ?>
            <div class="product <?php echo $notMarginTop; ?> threecol <?php echo $classLast; ?>">
                <h3 class="title"><a href="<?php echo Yii::app()->createAbsoluteUrl('/Shop/product/view', array('cateAlias' => $product->cate->alias, 'alias' => $product->alias)); ?>" title="<?php echo $product->name; ?>"><?php echo $product->name; ?></a></h3>
                <div class="product-image">
                    <a href="<?php echo Yii::app()->createAbsoluteUrl('/Shop/product/view', array('cateAlias' => $product->cate->alias, 'alias' => $product->alias)); ?>" title="<?php echo $product->name; ?>">
                        <img src="<?php echo $image; ?>" alt="<?php echo $product->name; ?>" />
                    </a>
                </div>
                <div class="info"><a href="<?php echo Yii::app()->createAbsoluteUrl('/Shop/product/view', array('cateAlias' => $product->cate->alias, 'alias' => $product->alias)); ?>" title="<?php echo $product->info; ?>"><?php echo $product->info; ?></a></div>
                <div class="price-group clearfix">
                    <?php if ($product->discount != 0 && $product->is_sale_off != 0) { ?>
                        <p class="price destroy"><span class="price-text">Giá: </span><span class="price-value"><?php echo Helper::formatNumber($product->price); ?></span></p>
                        <p class="price sale-off"><span class="price-text">Giá Sale: </span><span class="price-value"><?php echo Helper::formatNumber($product->price - $product->price * $product->discount / 100); ?></span></p>
                    <?php } else { ?>
                        <p class="price"><span class="price-text">Giá: </span><span class="price-value"><?php echo Helper::formatNumber($product->price); ?></span></p>
                    <?php } ?>
                </div>
            </div>
            <?php if (($k+1) % 3 == 0) { ?><div style="clear: both;"></div><?php } ?>
        <?php } ?>
    <?php } ?>
</div>
