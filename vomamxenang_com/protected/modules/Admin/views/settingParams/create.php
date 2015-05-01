<?php

/* @var $this Giá trị cài đặtController */
/* @var $model Giá trị cài đặt */
$this->breadcrumbs = array(
    'Giá trị cài đặt' => array('index'),
    'Tạo',
);


$this->menu = array(
    array(
        'label' => 'List Giá trị cài đặt',
        'url'   => array('index')
    ),
    array(
        'label' => 'Manage Giá trị cài đặt',
        'url'   => array('admin')
    ),
);

?>
<h1>Tạo Giá trị cài đặt</h1>
<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
