<?php if (!empty($banners)) { ?>
    <?php if ($position == 1 && $page == 1) { ?>
        <div id="slider" class="nivoSlider">
            <?php foreach ($banners as $banner) { ?>
                <?php $imgBanner = $banner->image ? Helper::renderImage($banner->image, 'uploads/resizeOnIndex/' . $model, ',', false, true) : '/uploads/no_image.jpg'; ?>
                <?php $bannerInfo[] = array(
                    'alias' => $banner->alias,
                    'info' => $banner->info
                    ) ?>
                <a href="<?php echo $banner->page_link; ?>" title="<?php echo $banner->name; ?>">
                    <img src="<?php echo $imgBanner; ?>" alt="<?php echo $banner->name; ?>" title="#htmlcaption-<?php echo $banner->alias; ?>" />
                </a>
            <?php } ?>
        </div>

        <?php foreach ($bannerInfo as $info) { ?>
            <div id="htmlcaption-<?php echo $info['alias']; ?>" class="nivo-html-caption">
                <?php echo nl2br($info['info']); ?>
            </div>
        <?php } ?>
    <?php } elseif ($position != 1) { ?>
        <ul>
            <?php foreach ($banners as $banner) { ?>
                <?php $imgBanner = $banner->image ? Helper::renderImage($banner->image, 'uploads/resizeBanner/Banner', ',', false, true) : '/uploads/no_image.jpg'; ?>
                <li><a href="<?php echo $banner->page_link; ?>" title="<?php echo $banner->name; ?>"><img src="<?php echo $imgBanner; ?>" alt="<?php echo $banner->name; ?>" /></a></li>
            <?php } ?>
        </ul>
    <?php } ?>
<?php } ?>
