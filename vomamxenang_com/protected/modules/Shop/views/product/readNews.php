<?php
$dataImage = $data->image ? Helper::renderImage($data->image, 'uploads/original/News', ',', false, true) : Helper::baseUrl() . '/uploads/no_image.jpg';
$thumbImage = Helper::explodeCharData($data->image);
 ?>
<div class="wrapper-module module product-detail">
    <div class="sixcol product-images">
        <div class="main-image">
            <img src="<?php echo $dataImage; ?>" alt="<?php echo $data->title; ?>" />
        </div>
        <!--<ul class="thumb-image">
            <?php /*if (is_array($thumbImage)) { */?>
                <?php /*foreach ($thumbImage as $image) { */?>
                    <li><img src="<?php /*echo Helper::baseUrl() . '/uploads/thumb/News/' . $image; */?>" alt="<?php /*echo $image; */?>" /></li>
                <?php /*} */?>
            <?php /*} else { */?>
                <li><img src="<?php /*echo Helper::baseUrl() . '/uploads/News/' . $thumbImage */?>" alt="<?php /*echo $data->title; */?>" /></li>
            <?php /*}*/ ?>
        </ul>-->
    </div>
    <div class="sixcol product-info last">
        <h2><?php echo $data->title; ?></h2>
        <div class="product-short-description">
            <?php echo nl2br($data->info); ?>
        </div>
    </div>
    <div class="clear top-30">&nbsp;</div>

    <div class="product-desc">
        <h3 class="title"><?php echo Helper::t('description'); ?></h3>
        <?php echo $data->content; ?>
    </div>
</div>
