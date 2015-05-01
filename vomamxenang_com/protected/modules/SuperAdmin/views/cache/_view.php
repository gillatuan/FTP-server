<?php
/* @var $this CacheController */
/* @var $data Cache */
?>
<div class="view">
    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array(
        'view',
        'id' => $data->id
    )); ?>
    <br /> <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
    <?php echo CHtml::encode($data->name); ?>
    <br /> <b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
    <?php echo CHtml::encode($data->description); ?>
    <br /> <b><?php echo CHtml::encode($data->getAttributeLabel('expired')); ?>:</b>
    <?php echo CHtml::encode($data->expired); ?>
    <br /> <b><?php echo CHtml::encode($data->getAttributeLabel('duration')); ?>:</b>
    <?php echo CHtml::encode($data->duration); ?>
    <br />
</div>