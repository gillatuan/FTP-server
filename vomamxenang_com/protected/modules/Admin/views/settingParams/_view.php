<?php

/* @var $this ProductsController */
/* @var $data Products */
?>
<div class="view">
    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array(
        'view',
        'id' => $data->id
    )); ?>
    <br /> <b><?php echo CHtml::encode($data->getAttributeLabel('cate_id')); ?>:</b>
    <?php echo CHtml::encode($data->cate_id); ?>
    <br /> <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
    <?php echo CHtml::encode($data->name); ?>
    <br /> <b><?php echo CHtml::encode($data->getAttributeLabel('alias')); ?>:</b>
    <?php echo CHtml::encode($data->alias); ?>
    <br /> <b><?php echo CHtml::encode($data->getAttributeLabel('info')); ?>:</b>
    <?php echo CHtml::encode($data->info); ?>
    <br /> <b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
    <?php echo CHtml::encode($data->description); ?>
    <br /> <b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
    <?php echo CHtml::encode($data->image); ?>
    <br />

    <?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_sale_off')); ?>:</b>
	<?php echo CHtml::encode($data->is_sale_off); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_buy')); ?>:</b>
	<?php echo CHtml::encode($data->total_buy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_date')); ?>:</b>
	<?php echo CHtml::encode($data->create_date); ?>
	<br />

	*/
    ?>
</div>