<?php $this->beginContent ('//layouts/main'); ?>
    <?php echo $content; ?>

    <!--Some Review-->
    <div class="twelvecol products-in-category">
        <div class="comments twelvecol">
            <h2>Một vài ý kiến đánh giá về sản phẩm do chúng tôi phân phối</h2>
            <div class="comment-list clearfix">
                <?php $this->widget('Shop.components.Reviews', array(
                    'isOnIndex' => 1
                )); ?>
            </div>
        </div>
    </div>

    <?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/js/jquery.nivo.slider.js', CClientScript::POS_END); ?>

<?php
$scriptPage = "
    $(function() {
        // nivoSlider
        $('#slider').nivoSlider();
    })
";
Helper::cs()->registerScript('scriptPage', $scriptPage, CClientScript::POS_END);


$this->endContent ();