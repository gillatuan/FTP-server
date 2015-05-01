<?php
/* @var $this CacheController */
/* @var $model Cache */
$this->breadcrumbs = array(
    'Caches'     => array('index'),
    $model->name => array(
        'view',
        'id' => $model->id
    ),
    'Update',
);
$this->menu = array(
    array(
        'label' => 'List Cache',
        'url'   => array('index')
    ),
    array(
        'label' => 'Create Cache',
        'url'   => array('create')
    ),
    array(
        'label' => 'View Cache',
        'url'   => array(
            'view',
            'id' => $model->id
        )
    ),
    array(
        'label' => 'Manage Cache',
        'url'   => array('admin')
    ),
);
?>

    <h1>Update Cache <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>