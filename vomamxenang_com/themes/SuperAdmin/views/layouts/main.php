<?php $this->beginContent ('//layouts/index'); ?>
    <div class="portlet box light-grey">
        <?php echo $content; ?>
        <?php
        $this->widget('zii.widgets.CMenu', array(
            'items' => $this->menu,
            'lastItemCssClass' => "last",
            'itemCssClass' => '',
            'htmlOptions' => array(
                'class' => 'menu-item'
            )
        ));
        ?>
    </div>
<?php $this->endContent (); ?>


    <!--CSS-->
<?php Helper::cs()->registerCssFile (Helper::themeUrl() . '/assets/bootstrap/css/bootstrap.min.css', 'screen'); ?>
<?php Helper::cs()->registerCssFile (Helper::themeUrl() . '/assets/css/metro.css', 'screen'); ?>
<?php Helper::cs()->registerCssFile (Helper::themeUrl() . '/assets/bootstrap/css/bootstrap-responsive.min.css', 'screen'); ?>
<?php Helper::cs()->registerCssFile (Helper::themeUrl() . '/assets/font-awesome/css/font-awesome.css', 'screen'); ?>
<?php Helper::cs()->registerCssFile (Helper::themeUrl() . '/assets/css/style.css', 'screen'); ?>
<?php Helper::cs()->registerCssFile (Helper::themeUrl() . '/assets/css/style_responsive.css', 'screen'); ?>
<?php Helper::cs()->registerCssFile (Helper::themeUrl() . '/assets/css/style_default.css', 'screen'); ?>
<?php Helper::cs()->registerCssFile (Helper::themeUrl() . '/assets/fancybox/source/jquery.fancybox.css', 'screen'); ?>
<?php Helper::cs()->registerCssFile (Helper::themeUrl() . '/assets/uniform/css/uniform.default.css', 'screen'); ?>
<?php Helper::cs()->registerCssFile (Helper::themeUrl() . '/assets/chosen-bootstrap/chosen/chosen.css', 'screen'); ?>
<?php Helper::cs()->registerCssFile (Helper::themeUrl() . '/assets/data-tables/DT_bootstrap.css', 'screen'); ?>
<?php Helper::cs()->registerCssFile (Helper::themeUrl() . '/assets/uniform/css/uniform.default.css', 'screen'); ?>
<?php Helper::cs()->registerCssFile (Helper::themeUrl() . '/assets/css/my-style.css'); ?>

    <!--JS-->
<?php Helper::cs()->registerCoreScript('jquery'); ?>
<?php Helper::cs()->registerCoreScript('jquery.ui'); ?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/assets/breakpoints/breakpoints.js'); ?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/assets/bootstrap/js/bootstrap.min.js'); ?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/assets/js/jquery.blockui.js'); ?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/assets/js/jquery.cookie.js'); ?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/assets/uniform/jquery.uniform.min.js'); ?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/assets/data-tables/jquery.dataTables.js'); ?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/assets/data-tables/DT_bootstrap.js'); ?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/assets/js/app.js'); ?>

<!-- ie8 fixes -->
<!--[if lt IE 9]>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/assets/js/excanvas.js'); ?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/assets/js/respond.js'); ?>
<![endif]-->