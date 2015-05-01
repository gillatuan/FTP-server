<?php

/* @var $this OrderController */

/* @var $model Order */

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

        <?php echo $form->label($model, 'bill_to'); ?>

        <?php echo $form->textField($model, 'bill_to', array('size' => 60, 'maxlength' => 1000)); ?>

    </div>

    <div class="row">

        <?php echo $form->label($model, 'ship_to'); ?>

        <?php echo $form->textField($model, 'ship_to', array('size' => 60, 'maxlength' => 1000)); ?>

    </div>

    <div class="row">

        <?php echo $form->label($model, 'cart'); ?>

        <?php echo $form->textField($model, 'cart', array('size' => 60, 'maxlength' => 1000)); ?>

    </div>

    <div class="row">

        <?php echo $form->label($model, 'info'); ?>

        <?php echo $form->textArea($model, 'info', array('rows' => 6, 'cols' => 50)); ?>

    </div>

    <div class="row">

        <?php echo $form->label($model, 'status'); ?>

        <?php echo $form->textField($model, 'status', array('size' => 1, 'maxlength' => 1)); ?>

    </div>

    <div class="row">

        <?php echo $form->label($model, 'order_status'); ?>

        <?php echo $form->textField($model, 'order_status', array('size' => 1, 'maxlength' => 1)); ?>

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