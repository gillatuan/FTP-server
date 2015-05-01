<?php

/* @var $this SettingParamsController */
/* @var $dataProvider CActiveDataProvider */
$this->breadcrumbs = array(
    'SettingParams',
);


$this->menu = array(
    array(
        'label' => 'Create SettingParams',
        'url'   => array('create')
    ),
    array(
        'label' => 'Manage SettingParams',
        'url'   => array('admin')
    ),
);

?>
<h1>SettingParams</h1>
<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView'     => '_view',
)); ?>

