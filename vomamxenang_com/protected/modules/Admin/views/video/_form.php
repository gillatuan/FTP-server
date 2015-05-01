<?php
/* @var $this VideoController */
/* @var $model Video */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'video-form',
    'enableClientValidation' => true,
    'enableAjaxValidation'   => true,
    'clientOptions'          => array(
        'validateOnSubmit' => true,
    ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'cate_id'); ?>
        <?php $this->widget('Admin.components.CategoryDropDownList', array(
            'model'       => $model,
            'attribute'   => 'cate_id',
            'htmlOptions' => array(
                'prompt' => 'Chọn chuyên mục',
                'class'  => 'text-input small-input'
            ),
            //            'exclude'=>array($model->id),
            //            'enableCache'=>true,
        )); ?>
        <?php echo $form->error($model, 'cate_id'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name', array('class' => 'text-input small-input')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'link_youtube'); ?>
		<?php echo $form->textField($model,'link_youtube', array('class' => 'text-input small-input')); ?>
		<?php echo $form->error($model,'link_youtube'); ?>
	</div>

	<div class="row">
		<label>Page Index</label>
		<?php echo $form->checkBox($model,'page',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'page'); ?>
	</div>

    <?php if (!$model->isNewRecord) { ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'alias'); ?>
            <?php echo $model->alias; ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'status'); ?>
            <?php echo $form->dropDownList($model, 'status', Lookup::items('Status')); ?>
            <?php echo $form->error($model, 'status'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'create_date'); ?>
            <?php echo date('m-d-Y', $model->create_date); ?>
        </div>
    <?php } ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->