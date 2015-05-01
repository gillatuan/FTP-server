<?php
/* @var $this CacheController */
/* @var $model Cache */
/* @var $form CActiveForm */
?>
<div class="wide form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    <div class="row">
        <?php echo $form->label($model, 'id'); ?>
        <?php echo $form->textField($model, 'id'); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array(
            'size'      => 50,
            'maxlength' => 50
        )); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'description'); ?>
        <?php echo $form->textField($model, 'description', array(
            'size'      => 60,
            'maxlength' => 255
        )); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'expired'); ?>
        <?php echo $form->textField($model, 'expired'); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'duration'); ?>
        <?php echo $form->textField($model, 'duration'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- search-form -->