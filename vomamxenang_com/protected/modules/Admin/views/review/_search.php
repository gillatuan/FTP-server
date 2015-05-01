<?php
/* @var $this ReviewController */
/* @var $model Review */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    <div class="row">
        <?php echo $form->label($model, 'id'); ?>
        <?php echo $form->textField($model, 'id', array('size' => 11, 'maxlength' => 11)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'full_name'); ?>
        <?php echo $form->textField($model, 'full_name', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'subject'); ?>
        <?php echo $form->textField($model, 'subject', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'status'); ?>
        <?php echo $form->textField($model, 'status', array('size' => 1, 'maxlength' => 1)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'create_date'); ?>
        <?php echo $form->textField($model, 'create_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'product_id'); ?>
        <?php echo $form->textField($model, 'product_id', array('size' => 11, 'maxlength' => 11)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'rating'); ?>
        <?php echo $form->textField($model, 'rating'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'ip_address'); ?>
        <?php echo $form->textField($model, 'ip_address', array('size' => 15, 'maxlength' => 15)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->