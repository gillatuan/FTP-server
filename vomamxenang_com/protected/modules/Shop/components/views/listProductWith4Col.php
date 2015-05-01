<div class="<?php echo $productList; ?>">
    <?php $modelProducts = isset($products['products']) ? $products['products'] : $products; ?>
    <?php $modelPaging = isset($products['paging']) ? $products['paging'] : ''; ?>
    <?php if (count($modelProducts)) { ?>
        <?php foreach ($modelProducts as $k=>$product) {
                $classLast = ($k+1)%3 == 0 ? 'last' : '';
                $image = $product->image ? '/uploads/resizeOnIndex/' . $model . '/' . Helper::explodeCharData($product->image, ',', false, true) : '/uploads/no_image.jpg';
                $notMarginTop = $k==0 || $k == 1 || $k == 2 ? 'not-margin-top' : '';

                $explodeFolder = explode('/', $image);
                $imgZoom = '';
                if ($explodeFolder[2] != 'no_image.gif') {
                    $imgZoom = str_replace($explodeFolder[2], 'original', $image);
                }
                ?>
                <div class="product <?php echo $notMarginTop; ?> <?php echo $amountCol; ?> <?php echo $classLast; ?>">
                    <h3 class="title"><a href="<?php echo Helper::url('/Shop/product/view', array('cateAlias' => $product->cate->alias, 'alias' => $product->alias)); ?>" title="<?php echo $product->name; ?>"><?php echo $product->name; ?></a></h3>
                    <div class="product-image">
                        <a href="<?php echo Helper::url('/Shop/product/view', array('cateAlias' => $product->cate->alias, 'alias' => $product->alias)); ?>" title="<?php echo $product->name; ?>" class="imgLiquid">
                            <img class="zoomImg" src="<?php echo $image; ?>" data-large="<?php echo $imgZoom; ?>" alt="<?php echo $product->name; ?>" />
                        </a>
                    </div>
                    <div class="info"><a href="<?php echo Helper::url('/Shop/product/view', array('cateAlias' => $product->cate->alias, 'alias' => $product->alias)); ?>" title="<?php echo $product->info; ?>"><?php echo $product->info; ?></a></div>
                    <div class="price-group clearfix">
                        <?php if (!empty($product->price_curr)) { ?>
                            <p class="price destroy"><span class="price-text">Giá thị trường: </span><span class="price-value"><?php echo Helper::formatNumber($product->price_curr); ?></span></p>
                        <?php } ?>
                        <?php if ($product->price > 0) { ?>
                            <?php if ($product->discount != 0 && $product->is_sale_off != 0) { ?>
                                <p class="price destroy"><span class="price-text">Giá: </span><span class="price-value"><?php echo Helper::formatNumber($product->price); ?></span></p>
                                <p class="price sale-off"><span class="price-text">Giá Sale: </span><span class="price-value"><?php echo Helper::formatNumber($product->price - $product->price * $product->discount / 100); ?></span></p>
                            <?php } else { ?>
                                <p class="price"><span class="price-text">Giá: </span><span class="price-value"><?php echo Helper::formatNumber($product->price); ?></span></p>
                            <?php } ?>
                            <?php if (!empty($product->barcode)) { ?><p class="price"><span class="price-text">Mã SP: </span><span class="price-value"><?php echo $product->barcode; ?></span></p><?php } ?>
                            <a href="javascript:;" title="Mua Hàng" class="add-cart link" id="id-<?php echo $product->alias; ?>">Mua Hàng</a>
                        <?php } else { ?>
                            <p class="price"><span class="price-text">Giá: </span><span class="price-value">Liên hệ</span></p>
                            <?php if (!empty($product->barcode)) { ?><p class="price"><span class="price-text">Mã SP: </span><span class="price-value"><?php echo $product->barcode; ?></span></p><?php } ?>
                        <?php } ?>
                        <div class="vote">
                            <?php $this->widget('CStarRating', array(
                                'value'    => $product->averageRating(),
                                'name'     => 'rating-' . $product->id,
                                'readOnly' => true,
                            )); ?>
                            <span> / <?php echo $product->countReview; ?> reviews</span>
                        </div>
                    </div>
                </div>
                <?php if (($k+1) % 3 == 0) { ?><div class="clearfix"></div><?php } ?>
            <?php } ?>
        <div class="clearfix"></div>
        <?php if ($isOnIndex && isset($cateAlias)) { ?>
            <p class="readmore"><a href="<?php echo Helper::url('/Shop/product/listProductsByCategory', array('cateAlias' => $cateAlias)) ?>" title="Xem tất cả">Xem tất cả</a></p>
        <?php } elseif (!empty($modelPaging)) { ?>
            <?php echo $modelPaging->firstLink("&lt;&lt; "); ?>
            <?php echo $modelPaging->preLink(" &lt; "); ?><?php echo $modelPaging->pageLinks(); ?>
            <?php echo $modelPaging->nextLink(" &gt; "); ?><?php echo $modelPaging->lastLink(" &gt;&gt;"); ?>
        <?php } ?>
    <?php } else { ?>
        <p class="readmore"><?php echo Yii::t('translate', 'NO_RESULTS_KEY') ?></p>
    <?php } ?>
</div>