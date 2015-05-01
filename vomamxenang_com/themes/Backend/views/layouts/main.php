<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//VI" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="VI">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Trình quản lý - Web3in1.com</title>
    <!--                       CSS                       -->
    <!-- Reset Stylesheet -->
    <link rel="stylesheet" href="<?php echo  Helper::themeUrl(); ?>/css/reset.css" type="text/css" media="screen" />
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="<?php echo  Helper::themeUrl(); ?>/css/style.css" type="text/css" media="screen" />

    <!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
    <link rel="stylesheet" href="<?php echo  Helper::themeUrl(); ?>/css/invalid.css" type="text/css" media="screen" />

    <!-- Colour Schemes		Default colour scheme is green. Uncomment prefered stylesheet to use it.
    <link rel="stylesheet" href="<?php echo  Helper::themeUrl(); ?>/css/blue.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo  Helper::themeUrl(); ?>/css/red.css" type="text/css" media="screen" />
    -->
    <!-- Internet Explorer Fixes Stylesheet -->
    <!--[if lte IE 7]>
    <link rel="stylesheet" href="<?php echo  Helper::themeUrl(); ?>/css/ie.css" type="text/css" media="screen" />
    <![endif]-->
</head>
<body>
<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
    <div id="sidebar">
        <div id="sidebar-wrapper">
            <!-- Logo (221px wide) -->
            <a href="<?php echo Helper::url('/site'); ?>" title="Trang chủ">
                <img id="logo" src="<?php echo  Helper::baseUrl(); ?>/uploads/logo.png" alt="Web3in1 logo" width="215" />
            </a>

            <!-- Sidebar Profile links  -->
            <div id="profile-links"> Hello, <a href="#" title="Edit your profile"><?php echo Helper::user()->name; ?></a> <br /><br />
                <a target="_blank" href="<?php echo Helper::url('/site/index') ?>" title="View the Site">Xem web</a> |
                <a href="<?php echo Helper::url('/site/logout'); ?>" title="Thoát">Thoát</a>
            </div>

            <ul id="main-nav">
                <!-- Accordion Menu -->
                <li>
                    <a href="#" class="nav-top-item <?php if (Yii::app()->controller->id == 'user' || Yii::app()->controller->id == 'settingParams' || Yii::app()->getController()->action->id == 'deleteall') { ?>current<?php } ?>" title="Cài đặt">Cài đặt </a>
                    <ul>
                        <li>
                            <a href="<?php echo Helper::url('/Admin/user/changePassword', array('id' => Helper::user()->id)); ?>" class="<?php if (Yii::app()->getController()->action->id == 'changePassword') { ?>current<?php } ?>" title="Thay đổi mật khẩu">Thay đổi mật khẩu</a>
                        </li>
                        <?php if (Helper::user()->checkAccess('Administrators')) { ?>
                            <li>
                                <a href="<?php echo Helper::url('/Admin/user/admin'); ?>" class="<?php if (Yii::app()->controller->id == 'user' && Yii::app()->controller->action->id == 'admin') { ?>current<?php } ?>" title="Thay đổi mật khẩu">Quản lý User</a>
                            </li>
                            <!--<li>
                                <a href="<?php /*echo Helper::url('/Admin/settingParams/configParams'); */?>" class="<?php /*if (Yii::app()->controller->id == 'settingParams' && Yii::app()->controller->action->id == 'configParams') { */?>current<?php /*} */?>" title=" Cập nhật giá trị cài đặt">Cập nhật giá trị cài đặt</a>
                            </li>
                            <li>
                                <a href="<?php /*echo Helper::url('/Admin/settingParams/admin'); */?>" class="<?php /*if (Yii::app()->controller->id == 'settingParams' && Yii::app()->controller->action->id == 'admin') { */?>current<?php /*} */?>" title=" Cài đặt Giá trị ban đầu">Cài đặt Giá trị ban đầu</a>
                            </li>-->
                        <?php } ?>
                        <li>
                            <a href="<?php echo Helper::url('/Admin/default/deleteall'); ?>" class="<?php if (Yii::app()->controller->id == 'default' && Yii::app()->controller->action->id == 'deleteall') { ?>current<?php } ?>" title="Xóa Cache và Assets">Xóa Cache và Assets</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="nav-top-item <?php if (Yii::app()->controller->id == 'category' || Yii::app()->controller->id == 'products' || Yii::app()->controller->id == 'review' || Yii::app()->controller->id == 'orders') { ?>current<?php } ?>" title="Quản lý Shop">Quản lý Shop </a>
                    <ul>
                        <li>
                            <a href="<?php echo Helper::url('/Admin/category/create'); ?>" class="<?php if (Yii::app()->controller->id == 'category' && Yii::app()->getController()->action->id == 'create') { ?>current<?php } ?>" title="Tạo mới Chuyên mục">Tạo mới Chuyên mục</a></li>
                        <li>
                            <a href="<?php echo Helper::url('/Admin/category/admin'); ?>" class="<?php if (Yii::app()->controller->id == 'category' && Yii::app()->getController()->action->id == 'admin') { ?>current<?php } ?>" title="Quản lý Chuyên mục">Quản lý Chuyên mục</a></li>
                        <li>
                            <a href="<?php echo Helper::url('/Admin/products/create'); ?>" class="<?php if (Yii::app()->controller->id == 'products' && Yii::app()->getController()->action->id == 'create') { ?>current<?php } ?>" title="Tạo mới Sản phẩm">Tạo mới Sản phẩm</a></li>
                        <li>
                            <a href="<?php echo Helper::url('/Admin/products/admin'); ?>" class="<?php if (Yii::app()->controller->id == 'products' && Yii::app()->getController()->action->id == 'admin') { ?>current<?php } ?>" title="Quản lý Sản phẩm">Quản lý Sản phẩm</a></li>
                        <li>
                            <a href="<?php echo Helper::url('/Admin/review/admin'); ?>" class="<?php if (Yii::app()->controller->id == 'review' && Yii::app()->getController()->action->id == 'admin') { ?>current<?php } ?>" title="Quản lý Nhận xét sản phẩm">Quản lý Nhận xét sản phẩm</a></li>
                        <li>
                            <a href="<?php echo Helper::url('/Admin/orders/admin'); ?>" class="<?php if (Yii::app()->controller->id == 'orders' && Yii::app()->getController()->action->id == 'admin') { ?>current<?php } ?>" title="Quản lý bán hàng">Quản lý bán hàng</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="nav-top-item <?php if (Yii::app()->controller->id == 'banner' || Yii::app()->controller->id == 'video') { ?>current<?php } ?>" title="Quản lý Banner và Video">Quản lý Banner và Video </a>
                    <ul>
                        <li>
                            <a href="<?php echo Helper::url('/Admin/banner/create'); ?>" class="<?php if (Yii::app()->controller->id == 'banner' && Yii::app()->getController()->action->id == 'create') { ?>current<?php } ?>" title="Tạo mới Banner">Tạo mới Banner</a></li>
                        <li>
                            <a href="<?php echo Helper::url('/Admin/banner/admin'); ?>" class="<?php if (Yii::app()->controller->id == 'banner' && Yii::app()->getController()->action->id == 'admin') { ?>current<?php } ?>" title="Quản lý Banner">Quản lý Banner</a></li>
                        <li>
                        <li>
                            <a href="<?php echo Helper::url('/Admin/video/create'); ?>" class="<?php if (Yii::app()->controller->id == 'video' && Yii::app()->getController()->action->id == 'create') { ?>current<?php } ?>" title="Tạo mới Video Youtube">Tạo mới Video Youtube</a></li>
                        <li>
                            <a href="<?php echo Helper::url('/Admin/video/admin'); ?>" class="<?php if (Yii::app()->controller->id == 'video' && Yii::app()->getController()->action->id == 'admin') { ?>current<?php } ?>" title="Quản lý Video Youtube">Quản lý  Video Youtube</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="nav-top-item <?php if (Helper::get('type') == 1 && Yii::app()->controller->id == 'news') { ?>current<?php } ?>" title="Giới Thiệu">Giới Thiệu</a>
                    <ul>
                        <li>
                            <a class="<?php if (Yii::app()->getController()->action->id == 'create' && Helper::get('type') == 1) { ?>current<?php } ?>" href="<?php echo Helper::url('/Admin/news/create', array('type' => 1)) ?>" title="Tạo Tin Giới Thiệu Mới">Tạo Tin Giới Thiệu Mới</a>
                        </li>
                        <li>
                            <a class="<?php if (Yii::app()->getController()->action->id == 'admin' && Helper::get('type') == 1) { ?>current<?php } ?>" href="<?php echo Helper::url('/Admin/news/admin', array('type' => 1)) ?>" title="Quản lý Tin Giới Thiệu">Quản lý Tin Giới Thiệu </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="nav-top-item <?php if (Helper::get('type') == 2 && Yii::app()->controller->id == 'news') { ?>current<?php } ?>" title="Tin tức">Tin tức </a>
                    <ul>
                        <li>
                            <a class="<?php if (Yii::app()->getController()->action->id == 'create' && Helper::get('type') == 2) { ?>current<?php } ?>" href="<?php echo Helper::url('/Admin/news/create', array('type' => 2)) ?>" title="Tạo tin tức mới">Tạo tin tức mới </a>
                        </li>
                        <li>
                            <a class="<?php if (Helper::get('type') == 2 && Yii::app()->getController()->action->id == 'admin') { ?>current<?php } ?>" href="<?php echo Helper::url('/Admin/news/admin', array('type' => 2)) ?>" title="Quản lý tin tức">Quản lý tin tức </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="nav-top-item <?php if (Helper::get('type') == 3 && Yii::app()->controller->id == 'news') { ?>current<?php } ?>" title="Tin Thông báo">Tin Thông báo </a>
                    <ul>
                        <li>
                            <a class="<?php if (Yii::app()->getController()->action->id == 'create' && Helper::get('type') == 3) { ?>current<?php } ?>" href="<?php echo Helper::url('/Admin/news/create', array('type' => 3)) ?>" title="Tạo tin Thông báo mới">Tạo tin Thông báo mới </a>
                        </li>
                        <li>
                            <a class="<?php if (Helper::get('type') == 3 && Yii::app()->getController()->action->id == 'admin') { ?>current<?php } ?>" href="<?php echo Helper::url('/Admin/news/admin', array('type' => 3)) ?>" title="Quản lý tin Thông báo">Quản lý tin Thông báo </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="nav-top-item <?php if (Helper::get('type') == 4 && Yii::app()->controller->id == 'news') { ?>current<?php } ?>" title="Tin khuyến mãi">Tin khuyến mãi </a>
                    <ul>
                        <li>
                            <a class="<?php if (Yii::app()->getController()->action->id == 'create' && Helper::get('type') == 4) { ?>current<?php } ?>" href="<?php echo Helper::url('/Admin/news/create', array('type' => 4)) ?>" title="Tạo tin khuyến mãi mới">Tạo tin khuyến mãi mới </a>
                        </li>
                        <li>
                            <a class="<?php if (Helper::get('type') == 4 && Yii::app()->getController()->action->id == 'admin') { ?>current<?php } ?>" href="<?php echo Helper::url('/Admin/news/admin', array('type' => 4)) ?>" title="Quản lý tin khuyến mãi">Quản lý tin khuyến mãi </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="nav-top-item <?php if (Yii::app()->controller->id == 'qa') { ?>current<?php } ?>" title="Hỏi đáp">Hỏi đáp</a>
                    <ul>
                        <li>
                            <a class="<?php if (Yii::app()->controller->action->id == 'create' && Yii::app()->controller->id == 'qa') { ?>current<?php } ?>" href="<?php echo Helper::url('/Admin/qa/create') ?>" title="Tạo Tin Hỏi đáp">Tạo Tin Hỏi đáp Mới</a>
                        </li>
                        <li>
                            <a class="<?php if (Yii::app()->controller->action->id == 'admin' && Yii::app()->controller->id == 'qa') { ?>current<?php } ?>" href="<?php echo Helper::url('/Admin/qa/admin') ?>" title="Quản lý Tin Hỏi đáp">Quản lý Tin Hỏi đáp </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- End #sidebar -->

    <div id="main-content">
        <!-- Main Content Section with everything -->
        <noscript>
            <!-- Show a notification if the user has disabled javascript -->
            <div class="notification error png_bg">
                <div> Javascript is disabled or is not supported by your browser. Please
                    <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade </a> your browser or
                    <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable </a> Javascript to navigate the interface properly.
                </div>
            </div>
        </noscript>

        <!-- Page Head -->
        <h2>Welcome <?php echo Helper::user()->name; ?></h2>

        <p id="page-intro">What would you like to do?</p>

        <div class="clear"></div>
                            <!-- End .clear -->
        <div class="content-box">
            <!-- Start Content Box -->
            <?php echo $content; ?>
            <div class="crud-menu">
                <?php
                $this->widget('zii.widgets.CMenu', array('items' => $this->menu, 'lastItemCssClass' => "last"));
                ?>
            </div>
        </div>
    </div>
    <!-- End #main-content -->

</div>

<?php Helper::cs()->registerCoreScript('jquery'); ?>
<?php Helper::cs()->registerCoreScript('jquery.ui'); ?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . "/js/simpla.jquery.configuration.js", CClientScript::POS_END) ;?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . "/js/menudrop.js", CClientScript::POS_END) ;?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . "/js/common.js", CClientScript::POS_END) ;?>
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . "/js/multi-delete.js", CClientScript::POS_END) ;?>
<!-- Facebox jQuery Plugin -->
<?php Helper::cs()->registerScriptFile(Helper::themeUrl() . "/js/facebox.js", CClientScript::POS_END) ;?>
<script type="text/javascript">
    $(function () {
        $('.yiiPager .page').addClass('number');
//        ajaxComplete
        $('body').ajaxComplete(function (e, xhr, settings) {
            $.countAjaxRequest--;
            if ($(this).find('#ajax-loading').length > 0) {
                if ($.countAjaxRequest == 0) {
                    $(this).find('#ajax-loading').hide();
                }
            }
        });
//        ajax Send
        $('body').ajaxSend(function () {
            $.countAjaxRequest = $.countAjaxRequest == undefined ? 0 : $.countAjaxRequest;
            $.countAjaxRequest++;
            var loading = $(this).find('#ajax-loading');
            loading.show();
        });
    })
</script>
<!-- Internet Explorer .png-fix --><!--[if IE 6]>
<script type="text/javascript" src="<?php echo Helper::themeUrl(); ?>/js/DD_belatedPNG_0.0.7a.js"></script>
<script type="text/javascript">
    DD_belatedPNG.fix('.png_bg, img, li');
</script>
<![endif]-->
</body>
</html>
