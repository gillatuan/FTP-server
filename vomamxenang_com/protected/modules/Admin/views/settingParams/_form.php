<?php

/* @var $this ProductsController */
/* @var $model Products */
/* @var $form CActiveForm */
?>
    <div class="form">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id'                     => 'setting-params-form',
            'enableClientValidation' => true,
            'enableAjaxValidation'   => true,
            'clientOptions'          => array(
                'validateOnSubmit' => true,
            ),
            'htmlOptions'            => array(
                'enctype' => 'multipart/form-data'
            ),
        )); ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>
        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name', array('class' => 'text-input small-input')); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'label'); ?>
            <?php echo $form->textField($model, 'label', array('class' => 'text-input small-input')); ?>
            <?php echo $form->error($model, 'label'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'values'); ?>
            <?php echo $form->textArea($model, 'values', array(
                'rows'  => 12,
                'class' => 'medium-input textarea'
            )) ?>
            <?php echo $form->error($model, 'values'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'description'); ?>
            <?php echo $form->textArea($model, 'description', array(
                'rows'  => 12,
                'class' => 'medium-input textarea'
            )) ?>
            <?php echo $form->error($model, 'description'); ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div><!-- form -->