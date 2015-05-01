<?php $this->beginContent ('//layouts/index'); ?>
    <!-- BEGIN PAGE CONTENT-->
    <div class="row-fluid profile">
        <div class="span12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="tabbable tabbable-custom">
                <ul class="nav nav-tabs">
<!--                    <li class="active"><a href="#tab_1_1" data-toggle="tab">Overview</a></li>-->
                    <li class="<?php if (!Helper::get('tab')) { ?>active<?php } ?>"><a href="<?php echo Helper::url('/Admin/user/profile') ?>" data-toggle="tab">Profile Info</a></li>
                    <li class="<?php if (Helper::get('tab') == 'account') { ?>active<?php } ?>"><a href="<?php echo Helper::url('/Admin/user/profile', array('tab' => 'account', 'action' => 'personal-info')); ?>" data-toggle="tab">Account</a></li>
                    <li class="<?php if (Helper::get('tab') == 'projects') { ?>active<?php } ?>"><a href="<?php echo Helper::url('/Admin/user/profile', array('tab' => 'projects')) ?>" data-toggle="tab">Projects</a></li>
<!--                    <li><a href="#tab_1_6" data-toggle="tab">Help</a></li>-->
                </ul>
                <div class="tab-content">
                    <?php echo $content; ?>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    <!-- END PAGE CONTENT-->
<?php $this->endContent (); ?>

<!--CSS-->
<?php Helper::cs()->registerCssFile(Helper::themeUrl() . '/assets/bootstrap/css/bootstrap.min.css'); ?>
<?php Helper::cs()->registerCssFile(Helper::themeUrl() . '/assets/css/metro.css'); ?>
<?php Helper::cs()->registerCssFile(Helper::themeUrl() . '/assets/bootstrap/css/bootstrap-responsive.min.css'); ?>
<?php Helper::cs()->registerCssFile(Helper::themeUrl() . '/assets/font-awesome/css/font-awesome.css'); ?>
<?php Helper::cs()->registerCssFile(Helper::themeUrl() . '/assets/bootstrap-fileupload/bootstrap-fileupload.css'); ?>
<?php Helper::cs()->registerCssFile(Helper::themeUrl() . '/assets/css/style.css'); ?>
<?php Helper::cs()->registerCssFile(Helper::themeUrl() . '/assets/css/style_responsive.css'); ?>
<?php Helper::cs()->registerCssFile(Helper::themeUrl() . '/assets/css/style_default.css'); ?>
<?php Helper::cs()->registerCssFile(Helper::themeUrl() . '/assets/chosen-bootstrap/chosen/chosen.css'); ?>
<?php Helper::cs()->registerCssFile(Helper::themeUrl() . '/assets/uniform/css/uniform.default.css'); ?>

<!--JS-->
<?php Helper::cs()->registerCoreScript('jquery'); ?>
<?php Helper::cs()->registerCoreScript('jquery.ui'); ?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/assets/ckeditor/ckeditor.js'); ?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/assets/breakpoints/breakpoints.js'); ?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/assets/bootstrap/js/bootstrap.min.js'); ?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/assets/js/jquery.blockui.js'); ?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/assets/js/jquery.cookie.js'); ?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/assets/bootstrap-fileupload/bootstrap-fileupload.js'); ?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/assets/uniform/jquery.uniform.min.js'); ?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/assets/jquery-slimscroll/jquery.slimscroll.min.js'); ?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/assets/chosen-bootstrap/chosen/chosen.jquery.min.js'); ?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/assets/js/app.js'); ?>

<!-- ie8 fixes -->
<!--[if lt IE 9]>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/assets/js/excanvas.js'); ?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . '/assets/js/respond.js'); ?>
<![endif]-->