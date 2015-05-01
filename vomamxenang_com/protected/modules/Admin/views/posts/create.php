<?php
/* @var $this PostsController */
/* @var $model Posts */

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Posts', 'url'=>array('index')),
	array('label'=>'Manage Posts', 'url'=>array('admin')),
);
?>

<div class="content-box-header">
    <h3><?php echo $model->id ? 'Update Post -  ' . $model->title : 'Create Post';?></h3>
    <ul class="content-box-tabs">
        <!--        <li><a href="#tab1" class="default-tab">Table</a></li>-->
        <!-- href must be unique and match the id of target div -->
        <li><a href="#tab2" class="default-tab">Forms</a></li>
    </ul>
    <div class="clear"></div>
</div>
<!-- End .content-box-header -->

<div class="content-box-content">
    <div class="tab-content">
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
</div>

