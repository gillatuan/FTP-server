<?php
/* @var $this CacheController */
/* @var $model Cache */
/* @var $form CActiveForm */
?>
<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'                   => 'cache-form',
        'enableAjaxValidation' => false,
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array(
            'size'      => 50,
            'maxlength' => 50
        )); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textField($model, 'description', array(
            'size'      => 60,
            'maxlength' => 255
        )); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'expired'); ?>
        <?php echo $form->textField($model, 'expired'); ?>
        <?php echo $form->error($model, 'expired'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'duration'); ?>
        <?php echo $form->textField($model, 'duration'); ?>
        <?php echo $form->error($model, 'duration'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->