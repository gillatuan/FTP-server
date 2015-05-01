<?php
/* @var $this SettingParamsController */
/* @var $model SettingParams */

$this->breadcrumbs=array(
	'Setting Params'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SettingParams', 'url'=>array('index')),
	array('label'=>'Manage SettingParams', 'url'=>array('admin')),
);
?>

<h1>Create SettingParams</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>