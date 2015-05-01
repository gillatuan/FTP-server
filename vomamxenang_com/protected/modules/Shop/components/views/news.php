<?php foreach (Lookup::items('Type_News') as $code=>$type) { ?>
    <div class="quickBox help threecol <?php if ($code == 4) { ?>last<?php } ?>">
        <h3><?php echo $type; ?></h3>
        <ul>
        <?php if (count($news)) { ?>
            <?php foreach ($news as $tin) { ?>
                <?php if ($tin->type_news == $code) { ?>
                    <li><a href="<?php echo Helper::url('/Shop/product/readNews', array('newsAlias' => $tin->alias)); ?>"><?php echo $tin->title; ?></a></li>
                <?php } ?>
            <?php } ?>
        <?php } else { ?>
            <li><span><?php echo Helper::t('NO_RESULTS_KEY'); ?></span></li>
        <?php } ?>
        </ul>
    </div>
<?php } ?>