<?php
if (!$model->isNewRecord) {
    $script = "
    $(function() {
        $('#User_password').val('');
    })
    ";
    Yii::app()->clientScript->registerScript('emptyValue', $script, CClientScript::POS_READY);
}
?>
<div class="tab-content form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
    'enableClientValidation' => true,
    'enableAjaxValidation'   => true,
    'clientOptions'          => array('validateOnSubmit' => true,),
    )
);?>

        <p class="note"><?php echo Helper::t('Fields_required'); ?></p>

        <?php //echo $form->errorSummary($model); ?>

        <?php if ($model->getScenario() != 'asGuest') { ?>
            <div class="row">
                <?php echo $form->labelEx($model, 'username'); ?>
                <?php echo $form->textField($model, 'username', array('class' => 'text-input small-input')); ?>
                <?php echo $form->error($model, 'username'); ?>
            </div>
        <?php } ?>

        <?php if ($model->isNewRecord) { ?>
            <?php if ($model->getScenario() != 'asGuest') { ?>
                <div class="row">
                    <?php echo $form->labelEx($model, 'password'); ?>
                    <?php echo $form->passwordField($model, 'password', array('class' => 'text-input small-input')); ?>
                    <?php echo $form->error($model, 'password'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'confirmPassword'); ?>
                    <?php echo $form->passwordField($model, 'confirmPassword', array('class' => 'text-input small-input')); ?>
                    <?php echo $form->error($model, 'confirmPassword'); ?>
                </div>
            <?php } ?>

            <div class="row">
                <?php echo $form->labelEx($model, 'email'); ?>
                <?php echo $form->textField($model, 'email', array('class' => 'text-input small-input')); ?>
                <?php echo $form->error($model, 'email'); ?>
            </div>
        <?php } else { ?>
            <?php if (!Helper::user()->checkAccess('SuperAdmin') && !Helper::user()->checkAccess('Administrators')) { ?>
                <div class="row">
                    <?php echo $form->labelEx($model, 'email'); ?>
                    <div class="user-email"><?php echo $model->email; ?></div>
                </div>
            <?php } else { ?>
                <div class="row">
                    <?php echo $form->labelEx($model, 'email'); ?>
                    <?php echo $form->textField($model, 'email', array('class' => 'text-input small-input user-email')); ?>
                    <?php echo $form->error($model, 'email'); ?>
                </div>
            <?php } ?>
        <?php } ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'fullname'); ?>
            <?php echo $form->textField($model, 'fullname', array('class' => 'text-input medium-input')); ?>
            <?php echo $form->error($model, 'fullname'); ?>
        </div>
        <!--<div class="row">
            <?php /*echo $form->labelEx($model, 'birthday'); */?>
            <?php /*$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'       => $model,
                'attribute'   => 'birthday', // additional javascript options for the date picker plugin
                'options'     => array(
                    'showOtherMonths'   => true,
                    'selectOtherMonths' => true,
                    'changeMonth'       => true,
                    'changeYear'        => true,
                    //                'showButtonPanel' => true,
                    'showAnim'          => 'fold',
                    'dateFormat'        => 'mm-dd-yy', //                'minDate'     => '0',
                    'minYear'           => '1950',
                    'onSelect'          => "js:function() {

                }",
                ),
                'htmlOptions' => array(
                    'class' => 'text-input small-input'
                ),
            )); */?>
            <?php /*echo $form->error($model, 'birthday'); */?>
        </div>-->

        <div class="row">
            <?php echo $form->labelEx($model, 'phone'); ?>
            <?php echo $form->textField($model, 'phone', array('class' => 'text-input small-input')); ?>
            <?php echo $form->error($model, 'phone'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'address'); ?>
            <?php echo $form->textField($model, 'address', array('class' => 'text-input small-input')); ?>
            <?php echo $form->error($model, 'address'); ?>
        </div>
        <!--<div class="row">
            <?php /*echo $form->labelEx($model, 'country'); */?>
            <?php /*echo $form->textField($model, 'country', array('class' => 'text-input small-input')); */?>
            <?php /*echo $form->error($model, 'country'); */?>
        </div>-->
        <div class="row">
            <?php echo $form->labelEx($model, 'description'); ?>
            <?php echo $form->textArea($model, 'description', array(
                'rows'  => 12,
                'class' => 'medium-input textarea'
            )) ?>
            <?php echo $form->error($model, 'description'); ?>
        </div>

        <?php if (Helper::user()->checkAccess('Super')) { ?>
            <div class="row">
                <?php echo $form->labelEx($model, 'type'); ?>
                <?php echo $form->dropDownList($model, 'type', Lookup::items('Level_User')) ?>
                <?php echo $form->error($model, 'type'); ?>
            </div>
        <?php } ?>

        <?php if (!Helper::user()->isGuest) { ?>
            <div class="row buttons">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'link')); ?>
            </div>
        <?php } ?>

        <?php $this->endWidget(); ?>
    </div>
    <!-- form -->

<?php
$addClassScript = '
    $(function() {
        if ($("form label").hasClass("required") == true) {
            $(this).find("input").addClass("required");
        }
    })
';
Helper::cs()->registerScript($addClassScript, $addClassScript, CClientScript::POS_END);