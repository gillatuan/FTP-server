<?php Helper::renderFlash('SUCCESS_SEND_CODE_TO_CHANGE_PASSWORD'); ?>
<?php Helper::renderFlash('EXPIRED_SEND_CODE_TO_CHANGE_PASSWORD'); ?>

    <div class="row">
        <div class="form topbottom-20 leftright-20">
            <h2 class="align-justify">Trouble Accessing Your Account?</h2>
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id'=> 'forgot-form',
                'enableClientValidation'=> true,
                'enableAjaxValidation'=> true,
                'clientOptions'=> array('validateOnSubmit'=> true,)
            )); ?>

            <p class="note">Forgot your password? Enter your login email below and fill the security check. We will send you an email with a link to
                reset your password.<br /><?php echo CHtml::link('Have a confirmation code already?', array('/site/resetConfirm'));?></p>

            <div class="row">
                <?php echo $form->labelEx($model, 'email'); ?>
                <?php echo $form->textField($model, 'email'); ?>
                <?php echo $form->error($model, 'email'); ?>
            </div>
            <div class="row buttons not-margin">
                <?php echo CHtml::submitButton('Continue'); ?>
            </div>

            <?php $this->endWidget(); ?>
        </div>
        <!-- form -->
    </div>