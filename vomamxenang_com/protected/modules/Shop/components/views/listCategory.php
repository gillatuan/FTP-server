<h3>Danh mục <?php echo $cateName; ?></h3>
<ul>
    <?php if (is_array($arrCate)) { ?>
        <?php foreach ($arrCate as $cate) { ?>
            <li><a href="<?php echo Helper::url('/Shop/product/listProductsByCategory', array('cateAlias' => $cate->alias)); ?>" class="<?php if ($cate->alias == Helper::get('cateAlias')) { ?>active<?php } ?>" title="<?php echo $cate->name; ?>"><?php echo $cate->name; ?></a></li>
        <?php } ?>
    <?php } else { ?>
        <li><a href="<?php echo Helper::url('/Shop/product/listProductsByCategory', array('cateAlias' => $arrCate->alias)); ?>" class="<?php if ($arrCate->alias == Helper::get('cateAlias')) { ?>active<?php } ?>" title="<?php echo $arrCate->name; ?>"><?php echo $arrCate->name; ?></a></li>
    <?php } ?>
</ul>