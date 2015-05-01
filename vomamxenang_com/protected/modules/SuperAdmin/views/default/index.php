<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
    'Default',
);
?>


<div class="portlet-title">
    <h4><i class="icon-reorder"></i>Manage Setting Params</h4>
    <div class="tools">
        <a href="javascript:;" class="collapse"></a>
        <a href="#portlet-config" data-toggle="modal" class="config"></a>
        <a href="javascript:;" class="reload"></a>
        <a href="javascript:;" class="remove"></a>
    </div>
</div>
<div class="portlet-body" style="overflow: hidden;">
    <?php if ($messageSuccess) { ?>
        <?php Helper::renderFlash($messageSuccess, 'label-success', true); ?>
    <?php } else { ?>
        <div>Chào mừng bạn đến với trang quản lý của SuperAdmin Web3in1.com</div>
    <?php } ?>
</div>