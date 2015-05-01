<?php

/* @var $this Giá trị cài đặtController */
/* @var $model Giá trị cài đặt */
$this->breadcrumbs = array(
    'Giá trị cài đặt' => array('index'),
    $model->name,
);


$this->menu = array(
    array(
        'label' => 'Tạo Giá trị cài đặt',
        'url'   => array('create')
    ),
    array(
        'label' => 'Cập nhật Giá trị cài đặt',
        'url'   => array(
            'update',
            'id' => $model->id
        )
    ),
    array(
        'label'       => 'Xóa Giá trị cài đặt',
        'url'         => '#',
        'linkOptions' => array(
            'submit'  => array(
                'delete',
                'id' => $model->id
            ),
            'confirm' => Helper::t('confirmDelete')
        )
    ),
    array(
        'label' => 'Quản lý Giá trị cài đặt',
        'url'   => array('admin')
    ),
);

?>
<h1>Xem Giá trị cài đặt #<?php echo $model->id; ?></h1>
<?php $this->widget('zii.widgets.CDetailView', array(
    'data'       => $model,
    'attributes' => array(
        'id',
        'cate_id',
        'name',
        'alias',
        'info',
        'description',
        'image',
        'price',
        'quantity',
        'is_sale_off',
        'total_buy',
        'status',
        'create_date',
    ),
)); ?>

