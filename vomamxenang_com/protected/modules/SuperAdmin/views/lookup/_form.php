    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'                   => 'lookup-form',
        'enableClientValidation' => true,
        'enableAjaxValidation'   => true,
        'clientOptions'          => array(
            'validateOnSubmit' => true,
            'afterValidateAttribute' => 'js:function(){
        }',
        ),
        'htmlOptions'=>array(
            'class'=>'form-horizontal',
        ),
    )); ?>

    <?php //echo $form->errorSummary($model); ?>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'name', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'name', array('class' => 'span4 m-wrap')); ?>
            <?php echo $form->error($model, 'name', array('class' => 'help-inline')); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'code', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'code', array('class' => 'span4 m-wrap')); ?>
            <?php echo $form->error($model, 'code', array('class' => 'help-inline')); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'type', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'type', array('class' => 'span4 m-wrap')); ?>
            <?php echo $form->error($model, 'type', array('class' => 'help-inline')); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'position', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'position', array('class' => 'span4 m-wrap')); ?>
            <?php echo $form->error($model, 'position', array('class' => 'help-inline')); ?>
        </div>
    </div>

    <div class="form-actions">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn green')); ?>
    </div>

    <?php $this->endWidget(); ?>