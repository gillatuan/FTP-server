<?php
/* @var $this SettingParamsController */
/* @var $model SettingParams */

$this->breadcrumbs=array(
	'Setting Params'=>array('admin'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List SettingParams', 'url'=>array('index')),
	array('label'=>'Create SettingParams', 'url'=>array('create')),
	array('label'=>'Update SettingParams', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SettingParams', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SettingParams', 'url'=>array('admin')),
);
?>

<h1>View SettingParams #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'label',
		'values',
		'description',
		'setting_group',
		'ordering',
		'visible',
		'module',
	),
)); ?>
