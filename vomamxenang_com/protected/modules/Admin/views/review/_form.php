<?php
/* @var $this ReviewController */
/* @var $model Review */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'                     => 'review-form',
        'enableClientValidation' => true,
        'enableAjaxValidation'   => true,
        'clientOptions'          => array(
            'validateOnSubmit' => true,
        ),
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'full_name'); ?>
        <?php echo $form->textField($model, 'full_name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'full_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'subject'); ?>
        <?php echo $form->textField($model, 'subject', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'subject'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>

    <div class="row ratingClass">
        <?php echo $form->labelEx($model, 'rating'); ?>
        <?php $this->widget('CStarRating', array(
            'name'       => 'Review[rating]',
            'value'      => 10,
            'allowEmpty' => false,
        )); ?>
        <?php echo $form->error($model, 'rating'); ?>
    </div>

    <?php if (!$model->isNewRecord) { ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'status'); ?>
            <?php echo $form->dropDownList($model, 'status', Lookup::items('Status')); ?>
            <?php echo $form->error($model, 'status'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'create_date'); ?>
            <?php echo date('m-d-Y', $model->create_date); ?>
        </div>

        <!--<div class="row">
            <?php /*echo $form->labelEx($model,'product_id'); */?>
            <?php /*echo $form->textField($model,'product_id',array('size'=>11,'maxlength'=>11)); */?>
            <?php /*echo $form->error($model,'product_id'); */?>
        </div>-->
    <?php } ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->