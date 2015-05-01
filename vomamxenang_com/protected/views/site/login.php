<div class="twelvecol login">
    <?php Helper::renderFlash('successChangePassword'); ?>
    <?php Helper::renderFlash('SUCCESS_REGISTER'); ?>
    <?php Helper::renderFlash('SUCCESS_REGISTER_WELCOME'); ?>

    <h2><?php echo Helper::t('Login_key') ?></h2>

    <p><?php echo Helper::t('Fill_form'); ?></p>

    <div class="sixcol form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation' => true,
        'enableAjaxValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true,),
    )); ?>

        <p class="note"><?php echo Helper::t('Fields_required'); ?></p>

        <div class="row">
            <?php echo $form->labelEx($model,'username', array('style' => 'float: left; width: 150px;')); ?>
            <?php echo $form->textField($model,'username'); ?>
            <?php echo $form->error($model,'username'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'password', array('style' => 'float: left; width: 150px;')); ?>
            <?php echo $form->passwordField($model,'password'); ?>
            <?php echo $form->error($model,'password'); ?>
            <p class="hint"> <?php echo Helper::t('hintLogin'); ?></p>
        </div>

        <div class="row rememberMe">
            <?php echo $form->checkBox($model,'rememberMe'); ?>
            <?php echo $form->label($model,'rememberMe'); ?>
            <?php echo $form->error($model,'rememberMe'); ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton(Helper::t('Login_key'), array('class' => 'link')); ?>
            <?php echo CHtml::link(Helper::t('Forgot_key'), Helper::url('/site/forgot')); ?>
        </div>
        <input type="hidden" name="returnUrl" value="<?php echo $returnUrl; ?>">

    <?php $this->endWidget(); ?>
    </div><!-- form -->



    <div class="sixcol login-social margin-top-30 last">
       <p class="note"><?php echo Helper::t('Login_FB_key'); ?></p>
       <p><?php echo Helper::t('Login_FB_sharing'); ?></p>
       <img src="<?php echo Helper::themeUrl() . '/images/btn-connect.png'; ?>" alt="<?php echo Helper::t('Login_FB_key'); ?>" />
   </div>
</div>
