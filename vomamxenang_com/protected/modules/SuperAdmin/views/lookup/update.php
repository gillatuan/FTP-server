<?php

$this->menu = array(
    array('label' => 'List Lookup', 'url' => array('index')),
    array('label' => 'Create Lookup', 'url' => array('create')),
    array('label' => 'View Lookup', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage Lookup', 'url' => array('admin')),
);

?>

<div class="portlet-title">
    <h4><i class="icon-reorder"></i><?php echo $model->id ? 'Update Lookup -  ' . $model->name : 'Create Lookup';?></h4>
    <div class="tools">
        <a href="javascript:;" class="collapse"></a>
        <a href="#portlet-config" data-toggle="modal" class="config"></a>
        <a href="javascript:;" class="reload"></a>
        <a href="javascript:;" class="remove"></a>
    </div>
</div>
<div class="portlet-body form">
    <?php Helper::renderFlash('SUCCESS_MESSAGE', 'label label-success span12', true, 'label-success'); ?>

    <h3 class="block">Fields with <span class="required">*</span> are required.</h3>
    <!-- BEGIN FORM-->
    <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
    <!-- END FORM-->
</div>