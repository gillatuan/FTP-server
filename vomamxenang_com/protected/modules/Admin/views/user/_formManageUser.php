<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
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
		<?php echo $form->labelEx($model,'username', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model,'username', array('class' => 'span4 m-wrap')); ?>
            <?php echo $form->error($model,'username', array('class' => 'help-inline')); ?>
        </div>
	</div>

    <?php if ($model->isNewRecord) { ?>
        <div class="control-group">
            <?php echo $form->labelEx($model,'password', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->passwordField($model,'password', array('class' => 'span4 m-wrap')); ?>
                <?php echo $form->error($model,'password', array('class' => 'help-inline')); ?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $form->labelEx($model,'confirmPassword', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->passwordField($model,'confirmPassword', array('class' => 'span4 m-wrap')); ?>
                <?php echo $form->error($model,'confirmPassword', array('class' => 'help-inline')); ?>
            </div>
        </div>

        <div class="control-group">
            <?php echo $form->labelEx($model,'email', array('class' => 'control-label')); ?>
            <div class="controls">
                <i class="icon-envelope"></i>
                <?php echo $form->textField($model,'email', array('class' => 'span4 m-wrap')); ?>
                <?php echo $form->error($model,'email', array('class' => 'help-inline')); ?>
            </div>
        </div>
    <?php } else { ?>
        <?php if (!Helper::user()->checkAccess('SuperAdmin')) { ?>
            <div class="control-group">
                <?php echo $form->labelEx($model,'email', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $model->email; ?>
                </div>
            </div>
        <?php } else { ?>
            <div class="control-group">
                <?php echo $form->labelEx($model,'email', array('class' => 'control-label')); ?>
                <div class="controls">
                    <div class="input-icon left">
                        <i class="icon-envelope"></i>
                        <?php echo $form->textField($model,'email', array('class' => 'span4 m-wrap')); ?>
                        <?php echo $form->error($model,'email', array('class' => 'help-inline')); ?>
                    </div>
                </div>
            </div>
         <?php }?>
    <?php } ?>

	<div class="control-group">
		<?php echo $form->labelEx($model,'fullname', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model,'fullname', array('class' => 'text-input medium-input')); ?>
            <?php echo $form->error($model,'fullname', array('class' => 'help-inline')); ?>
        </div>
	</div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'birthday', array('class' => 'control-label')); ?>
        <div class="controls">
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model'       => $model,
            'attribute'   => 'birthday',
            // additional javascript options for the date picker plugin
            'options'     => array(
                'showOtherMonths' => true,
                'selectOtherMonths' => true,
                'changeMonth' => true,
                'changeYear' => true,
//                'showButtonPanel' => true,
                'showAnim'    => 'fold',
                'dateFormat'  => 'mm-dd-yy',
//                'minDate'     => '0',
                'yearRange'=>'1955:1995',
                'onSelect'    => "js:function() {

                }",
            ),
            'htmlOptions' => array(
                'class' => 'span4 m-wrap'
            ),
        )); ?>
        <?php echo $form->error($model, 'birthday', array('class' => 'help-inline')); ?>
        </div>
    </div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'phone', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model,'phone', array('class' => 'span4 m-wrap')); ?>
            <?php echo $form->error($model,'phone', array('class' => 'help-inline')); ?>
        </div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'address', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model,'address', array('class' => 'span4 m-wrap')); ?>
            <?php echo $form->error($model,'address', array('class' => 'help-inline')); ?>
	    </div>
    </div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'country', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model,'country', array('class' => 'span4 m-wrap')); ?>
            <?php echo $form->error($model,'country', array('class' => 'help-inline')); ?>
        </div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'description', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textArea($model,'description', array('rows' => 6, 'class' => 'span6 m-wrap'))
            ?>
            <?php echo $form->error($model,'description', array('class' => 'help-inline')); ?>
        </div>
	</div>

    <?php if (Helper::user()->checkAccess('Super')) { ?>
        <div class="control-group">
            <?php echo $form->labelEx($model, 'type', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->dropDownList($model, 'type', Lookup::items('Level_User'), array('class' => 'span4 m-wrap')); ?>
                <?php echo $form->error($model, 'type', array('class' => 'help-inline')); ?>
            </div>
        </div>
    <?php } ?>

	<div class="form-actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn green')); ?>
	</div>

<?php $this->endWidget(); ?>
