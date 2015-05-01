<?php

/* @var $this OrderController */

/* @var $data Order */

?>



<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('bill_to')); ?>:</b>
    <?php echo CHtml::encode($data->bill_to); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('ship_to')); ?>:</b>
    <?php echo CHtml::encode($data->ship_to); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('cart')); ?>:</b>
    <?php echo CHtml::encode($data->cart); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('info')); ?>:</b>
    <?php echo CHtml::encode($data->info); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
    <?php echo CHtml::encode($data->status); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('order_status')); ?>:</b>
    <?php echo CHtml::encode($data->order_status); ?>
    <br />

    <?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('create_date')); ?>:</b>
	<?php echo CHtml::encode($data->create_date); ?>
	<br />

	*/
    ?>

</div>