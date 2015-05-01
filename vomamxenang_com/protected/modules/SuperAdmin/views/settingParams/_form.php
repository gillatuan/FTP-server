<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'setting-params-form',
    'enableClientValidation' => true,
    'clientOptions'          => array(
        'validateOnSubmit' => true,
        'afterValidateAttribute' => 'js:function(){
            $(".error").parent().addClass("error");
            $(".success").parent().addClass("success");
        }',
    ),
    'htmlOptions'=>array(
        'class'=>'form-horizontal',
    ),
)); ?>
       <div class="control-group">
            <?php echo $form->labelEx($model, 'name', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model,'name', array('class' => 'span4 m-wrap')); ?>
                <?php echo $form->error($model,'name', array('class' => 'help-inline')); ?>
            </div>
       </div>
       <div class="control-group">
            <?php echo $form->labelEx($model, 'label', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model,'label', array('class' => 'span4 m-wrap')); ?>
                <?php echo $form->error($model,'label', array('class' => 'help-inline')); ?>
            </div>
       </div>
       <div class="control-group">
            <?php echo $form->labelEx($model, 'values', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textArea($model,'values', array('class' => 'span6 m-wrap', 'rows' => 6)); ?>
                <?php echo $form->error($model,'values', array('class' => 'help-inline')); ?>
            </div>
       </div>
       <div class="control-group">
            <?php echo $form->labelEx($model, 'description', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textArea($model,'description', array('class' => 'span6 m-wrap', 'rows' => 6)); ?>
                <?php echo $form->error($model,'description', array('class' => 'help-inline')); ?>
            </div>
       </div>
       <div class="control-group">
            <?php echo $form->labelEx($model, 'setting_group', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model,'setting_group', array('class' => 'span6 m-wrap')); ?>
                <?php echo $form->error($model,'setting_group', array('class' => 'help-inline')); ?>
            </div>
       </div>
       <!--<div class="control-group">
            <?php /*echo $form->labelEx($model, 'visible', array('class' => 'control-label')); */?>
            <div class="controls">
                <?php /*echo $form->checkBox($model,'visible'); */?>
                <?php /*echo $form->error($model,'visible', array('class' => 'help-inline')); */?>
            </div>
       </div>-->
       <div class="control-group">
            <?php echo $form->labelEx($model, 'module', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model,'module', array('class' => 'span6 m-wrap')); ?>
                <?php echo $form->error($model,'module', array('class' => 'help-inline')); ?>
            </div>
       </div>
        <div class="form-actions">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn green')); ?>
            <?php echo CHtml::resetButton('Reset', array('class' => 'btn')); ?>
        </div>

       <!--<div class="control-group error">
          <label class="control-label" for="inputError">Input with error</label>
          <div class="controls">
             <input type="text" class="span6 m-wrap" id="inputError" />
             <span class="help-inline">Please correct the error</span>
          </div>
       </div>
       <div class="control-group success">
          <label class="control-label" for="inputSuccess">Input with success</label>
          <div class="controls">
             <input type="text" class="span6 m-wrap" id="inputSuccess" />
             <span class="help-inline ">Woohoo!</span>
          </div>
       </div>
       <div class="form-actions">
          <button type="submit" class="btn green">Save</button>
          <button type="button" class="btn">Cancel</button>
       </div>-->
<?php $this->endWidget(); ?>