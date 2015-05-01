<?php
/* @var $this ReviewController */
/* @var $data Review */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('full_name')); ?>:</b>
    <?php echo CHtml::encode($data->full_name); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('subject')); ?>:</b>
    <?php echo CHtml::encode($data->subject); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
    <?php echo CHtml::encode($data->description); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
    <?php echo CHtml::encode($data->status); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('create_date')); ?>:</b>
    <?php echo CHtml::encode($data->create_date); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('product_id')); ?>:</b>
    <?php echo CHtml::encode($data->product_id); ?>
    <br />

    <?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('rating')); ?>:</b>
	<?php echo CHtml::encode($data->rating); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ip_address')); ?>:</b>
	<?php echo CHtml::encode($data->ip_address); ?>
	<br />

	*/
    ?>

</div>