
<h2 class="product-name-by-cate"><?php echo $titleH2; ?></h2>
<div class="module-left threecol">
    <?php foreach (Lookup::items('Type_News') as $code=>$type) { ?>
    <div class="banner category-list <?php if ($code == 1) { ?>not-margin-top not-padding<?php } ?>">
        <h3><?php echo $type; ?></h3>
        <?php if (count($news)) { ?>
        <ul>
            <?php foreach ($news as $k=>$tin) { ?>
                <?php if ($tin->type_news == $code) { ?>
                <li><a href="<?php echo Helper::url('/Shop/product/readNews', array('newsAlias' => $tin->alias)); ?>" title="<?php echo $tin->title; ?>"><?php echo $tin->title; ?></a> </li>
                <?php } else { ?>
                <li ><span><?php if ($k == 0) echo Helper::t('NO_RESULTS_KEY'); ?></span></li>
                <?php } ?>
            <?php } ?>
        </ul>
        <?php } ?>
    </div>
    <?php } ?>
</div>