<?php

/* @var $this ProductsController */
/* @var $model Products */
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
        <?php echo $form->label($model, 'cate_id'); ?>

        <?php echo $form->textField($model, 'cate_id', array(
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
        <?php echo $form->label($model, 'info'); ?>

        <?php echo $form->textArea($model, 'info', array(
            'rows' => 6,
            'cols' => 50
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
            'maxlength' => 500
        )); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'price_curr'); ?>

        <?php echo $form->textField($model, 'price_curr'); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'price'); ?>

        <?php echo $form->textField($model, 'price'); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'barcode'); ?>

        <?php echo $form->textField($model, 'barcode'); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'quantity'); ?>

        <?php echo $form->textField($model, 'quantity'); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'is_sale_off'); ?>

        <?php echo $form->textField($model, 'is_sale_off', array(
            'size'      => 1,
            'maxlength' => 1
        )); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'total_buy'); ?>

        <?php echo $form->textField($model, 'total_buy'); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'status'); ?>

        <?php echo $form->textField($model, 'status', array(
            'size'      => 1,
            'maxlength' => 1
        )); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'create_date'); ?>

        <?php echo $form->textField($model, 'create_date'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>



    <?php $this->endWidget(); ?>
</div><!-- search-form -->