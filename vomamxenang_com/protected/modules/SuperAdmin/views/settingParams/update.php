<?php

$this->menu=array(
	array('label'=>'Create SettingParams', 'url'=>array('create')),
	array('label'=>'Manage SettingParams', 'url'=>array('admin')),
);
?>


<div class="portlet-title">
    <h4><i class="icon-reorder"></i><?php echo !$model->isNewRecord ? 'Update Setting Params -  ' . $model->name : 'Create Setting Params'; ?></h4>
    <div class="tools">
       <a href="javascript:;" class="collapse"></a>
       <a href="#portlet-config" data-toggle="modal" class="config"></a>
       <a href="javascript:;" class="reload"></a>
       <a href="javascript:;" class="remove"></a>
    </div>
</div>
<div class="portlet-body form">
    <h3 class="block">Fields with <span class="required">*</span> are required.</h3>

    <!-- BEGIN FORM-->
    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    <!-- END FORM-->
</div>