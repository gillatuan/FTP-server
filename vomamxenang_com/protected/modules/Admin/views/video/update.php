<?php

/* @var $this VideosController */
/* @var $model Videos */
$this->breadcrumbs = array(
    'Videos'   => array('index'),
    $model->name => array(
        'view',
        'id' => $model->id
    ),
    'Update',
);

?>

<?php if (!Helper::user()->checkAccess('Super')) { ?>
    <div class="content-box-header">
        <h3><?php echo !$model->isNewRecord ? 'Cập nhật Video Youtube -  ' . $model->name : "Tạo mới Video Youtube";
            ?></h3>
        <ul class="content-box-tabs">
            <!--        <li><a href="#tab1" class="default-tab">Table</a></li>-->
            <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2" class="default-tab">Forms</a></li>
        </ul>
        <div class="clear"></div>
    </div>
    <!-- End .content-box-header -->

    <div class="content-box-content default-tab">
        <div class="tab-content">
            <?php Helper::renderFlash('SUCCESS_MESSAGE', 'notification SUCCESS_MESSAGE png_bg', false, 'SUCCESS_MESSAGE'); ?>
            <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
        </div>
    </div>
<?php } else { ?>

    <div class="portlet-title">
        <h4>
            <i class="icon-reorder"></i>
            <?php echo !$model->isNewRecord ? 'Cập nhật Video Youtube -  ' . $model->name : "Tạo mới Video Youtube"; ?>
        </h4>

        <div class="tools">
            <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;"
                                                                                                                              class="reload"></a> <a
                href="javascript:;" class="remove"></a>
        </div>
    </div>
    <div class="portlet-body form">
        <?php Helper::renderFlash('SUCCESS_MESSAGE', 'label label-success span12', true, 'label-success'); ?>

        <h3 class="block">Fields with <span class="required">*</span> are required.</h3>
        <!-- BEGIN FORM-->
        <?php echo $this->renderPartial('_formSuper', array('model' => $model)); ?>
        <!-- END FORM-->
    </div>

<?php } ?>