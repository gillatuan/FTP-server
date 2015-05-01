<?php

/* @var $this OrderController */

/* @var $model Order */

/* @var $form CActiveForm */

?>



<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'                   => 'order-form',
        'enableAjaxValidation' => false,
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">

        <?php echo $form->labelEx($model, 'bill_to'); ?>
        <?php echo $form->textField($model, 'bill_to', array('size' => 60, 'maxlength' => 1000)); ?>
        <?php echo $form->error($model, 'bill_to'); ?>

    </div>

    <div class="row">

        <?php echo $form->labelEx($model, 'ship_to'); ?>
        <?php echo $form->textField($model, 'ship_to', array('size' => 60, 'maxlength' => 1000)); ?>
        <?php echo $form->error($model, 'ship_to'); ?>

    </div>

    <div class="row">

        <?php echo $form->labelEx($model, 'cart'); ?>
        <?php echo $form->textField($model, 'cart', array('size' => 60, 'maxlength' => 1000)); ?>
        <?php echo $form->error($model, 'cart'); ?>

    </div>

    <div class="row">

        <?php echo $form->labelEx($model, 'info'); ?>
        <?php echo $form->textArea($model, 'info', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'info'); ?>

    </div>

    <div class="row">

        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->textField($model, 'status', array('size' => 1, 'maxlength' => 1)); ?>
        <?php echo $form->error($model, 'status'); ?>

    </div>

    <div class="row">

        <?php echo $form->labelEx($model, 'order_status'); ?>
        <?php echo $form->textField($model, 'order_status', array('size' => 1, 'maxlength' => 1)); ?>
        <?php echo $form->error($model, 'order_status'); ?>

    </div>

    <div class="row">

        <?php echo $form->labelEx($model, 'create_date'); ?>
        <?php echo $form->textField($model, 'create_date'); ?>
        <?php echo $form->error($model, 'create_date'); ?>

    </div>

    <div class="row buttons">

        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>

    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->