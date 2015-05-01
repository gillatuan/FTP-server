<?php

/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>
<div class="wide form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>





    <div class="row">
        <?php echo $form->label($model, 'id'); ?>

        <?php echo $form->textField($model, 'id', array(
            'size'      => 11,
            'maxlength' => 11
        )); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'name'); ?>

        <?php echo $form->textField($model, 'name', array(
            'size'      => 60,
            'maxlength' => 255
        )); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'alias'); ?>

        <?php echo $form->textField($model, 'alias', array(
            'size'      => 60,
            'maxlength' => 255
        )); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'description'); ?>

        <?php echo $form->textArea($model, 'description', array(
            'rows' => 6,
            'cols' => 50
        )); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'image'); ?>

        <?php echo $form->textField($model, 'image', array(
            'size'      => 60,
            'maxlength' => 255
        )); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'parent_id'); ?>

        <?php echo $form->textField($model, 'parent_id'); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'status'); ?>

        <?php echo $form->textField($model, 'status', array(
            'size'      => 1,
            'maxlength' => 1
        )); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>



    <?php $this->endWidget(); ?>
</div><!-- search-form -->