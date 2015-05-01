<?php
/* @var $this QaController */
/* @var $model Qa */
/* @var $form CActiveForm */
?>

<div class="tab-content form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'qa-form',
        'enableClientValidation' => true,
        'enableAjaxValidation'   => true,
        'clientOptions'          => array('validateOnSubmit' => true,),
    )
);?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <?php if (Helper::user()->isGuest) { ?>
    <div class="row">
		<?php echo $form->labelEx($model,'full_name'); ?>
        <?php echo $form->textField($model,'full_name', array('class' => 'text-input medium-input')); ?>
        <?php echo $form->error($model,'full_name'); ?>
	</div>
    <?php } ?>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject', array('class' => 'text-input medium-input')); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content', array('rows' => 8, 'class' => 'medium-input')); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

    <?php if (!$model->isNewRecord) { ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', Lookup::items('Status')); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>
    <?php } ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton(isset($model->parent_id) ? 'Gửi câu hỏi' : 'Trả lời'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->