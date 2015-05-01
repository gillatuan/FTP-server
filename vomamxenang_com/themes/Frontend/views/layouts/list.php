<?php $this->beginContent ('//layouts/main'); ?>
    <!--Breadcrumbs-->
<div class="row content">
    <h2 class="product-name-by-cate">
    <?php $this->widget('Shop.components.CateName', array(
        'cateAlias' => Helper::get('cateAlias') ? Helper::get('cateAlias') : ''
    )); ?>
    </h2>
    <div class="module-left threecol">
        <div class="category-list">
            <?php $this->widget('Shop.components.ListCategory', array(
                'cateAlias' => Helper::get('cateAlias') ? Helper::get('cateAlias') : ''
            )); ?>
        </div>
        <div class="banner">
            <h3>Banner</h3>
            <ul>
                <?php $this->widget('Shop.components.BannersModule', array(
                    'position' => 3,
                    'page' => 2
                )) ?>
            </ul>
        </div>
    </div>
    <div class="products-in-category not-border-bottom not-margin-top ninecol last">
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'homeLink'    => CHtml::link('Vỏ mâm xe nâng Ngọc Thanh', Helper::url('/Shop/product/index'), array('title' => 'Vỏ mâm xe nâng Ngọc Thanh')),
            'links'       => $this->breadcrumbs,
            'htmlOptions' => array(
                'id'    => 'PageBreadcrumb',
                'class' => 'breadcrumb'
            ),
            'separator'   => ""
        )); ?>

        <?php if (Yii::app()->controller->id == 'product' && Yii::app()->controller->action->id != 'view') { ?>
        <div class="tab-buttons">
            <ul class="tabs">
                <?php $tab = Helper::get('tab'); ?>
                <li id="latest-items" class="tab <?php if (empty($tab) || $tab == 'latest-items') { ?>active<?php } ?>">
                    <a title="Sản phẩm mới nhất" href="<?php echo Helper::url('/Shop/product/listProductsByCategory', array(
                        'cateAlias' => Helper::get('cateAlias'),
                        'tab' => 'latest-items'
                    )) ?>"><span>Sản phẩm mới nhất</span></a>
                </li>
                <li id="popular-items" class="tab <?php if ($tab == 'popular-items') { ?>active<?php } ?>"><a title="Sản phẩm bán chạy" href="<?php echo Helper::url('/Shop/product/listProductsByCategory', array(
                        'cateAlias' => Helper::get('cateAlias'),
                        'tab' => 'popular-items'
                    )) ?>"><span>Sản phẩm bán chạy</span></a>
                </li>
                <li id="sale-off-items" class="tab <?php if ($tab == 'sale-off') { ?>active<?php } ?> last"><a title="Sản phẩm giảm giá" href="<?php echo Helper::url('/Shop/product/listProductsByCategory', array(
                        'cateAlias' => Helper::get('cateAlias'),
                        'tab' => 'sale-off'
                    )) ?>"><span>Sản phẩm giảm giá</span></a>
                </li>
            </ul>
        </div>
        <?php } ?>

        <?php echo $content; ?>
    </div>
</div>

<!--JS-->
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/js/imgLiquid-min.js', CClientScript::POS_END); ?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/js/css3-mediaqueries.js', CClientScript::POS_END); ?>

<script type="text/javascript">var addthis_config = {"data_track_addressbar":false};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51b74b7d615c70ad"></script>

<?php $this->endContent (); ?>
