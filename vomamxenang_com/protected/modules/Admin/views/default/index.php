<?php

/* @var $this DefaultController */
$this->breadcrumbs = array(
    'Default',
);

?>

<div class="content-box-header">
    <h3>Chào mừng bạn đến với trang quản lý</h3>
    <ul class="content-box-tabs">
        <li><a href="#tab1" class="default-tab">Table</a></li>
        <!-- href must be unique and match the id of target div -->
        <li><a href="#tab2">Forms</a></li>
    </ul>
    <div class="clear"></div>
</div>

<div class="content-box-content">
    <div class="tab-content default-tab" id="tab1">
        <?php if (Yii::app()->user->hasFlash('deleteCached') || Yii::app()->user->hasFlash('deleteAssets') || Yii::app()->user->hasFlash('DELETE_ASSETS_CACHE')) { ?>
            <div class="notification SUCCESS_MESSAGE png_bg">
                <?php
                /*if (Yii::app()->user->hasFlash('deleteCached'))
                    $file = 'deleteCached';

                if (Yii::app()->user->hasFlash('deleteAssets'))
                    $file = 'deleteAssets';

                if (Yii::app()->user->hasFlash('DELETE_ASSETS_CACHE'))
                    $file = 'DELETE_ASSETS_CACHE';*/
                ?>

                <a href="#" class="close">
                    <img src="<?php echo Helper::themeUrl(); ?>/images/icons/cross_grey_small.png" title="Close this notification" alt="close"/></a>

                <div><?php echo Helper::renderFlash('DELETE_ASSETS_CACHE', 'label label-success span12', false, 'SUCCESS_MESSAGE'); ?></div>
            </div>

        <?php } else { ?>
        <div class="notification information png_bg">
            <p>Welcome back, <?php echo Helper::user()->name; ?></p>
        </div>
        <?php } ?>
    </div>
</div>