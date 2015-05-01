<style>
    .checkboxList #Banner_page input { width: 2% !important; display: inline; }
    .checkboxList #Banner_page label { display: inline; }
</style>
    <div class="form">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id'                     => 'banner-form',
            'enableClientValidation' => true,
            'enableAjaxValidation'   => true,
            'clientOptions'          => array(
                'validateOnSubmit' => true,
            ),
            'htmlOptions'            => array(
                'enctype' => 'multipart/form-data'
            ),
        )); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('class' => 'text-input small-input')); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

        <div class="row tinymce">
            <?php echo $form->labelEx($model, 'info'); ?>
            <?php
            $this->widget('ext.tinymce.TinyMce', array(
                'model' => $model,
                'attribute' => 'info',
                // Optional config
//                'compressorRoute' => 'tinyMce/compressor',
                'spellcheckerUrl' => array('tinyMce/spellchecker'),
                // or use yandex spell: http://api.yandex.ru/speller/doc/dg/tasks/how-to-spellcheck-tinymce.xml
//                'spellcheckerUrl' => 'http://speller.yandex.net/services/tinyspell',
                'fileManager' => array(
                    'class' => 'ext.elFinder.TinyMceElFinder',
                    'connectorRoute'=> 'elfinder/connector', // elfinder controller, connector action
                ),
                'htmlOptions' => array(
                    'rows' => 6,
                    'cols' => 60,
                ),
            ));
            ?>
            <?php echo $form->error($model, 'info'); ?>
        </div>

	<div class="row">
		<?php echo $form->labelEx($model,'page_link'); ?>
		<?php echo $form->textField($model,'page_link', array('class' => 'text-input small-input')); ?>
		<?php echo $form->error($model,'page_link'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model, 'image'); ?>
        <?php echo $form->hiddenField($model, "image"); ?>
        <?php $this->widget('CMultiFileUpload', array(
            'name'      => 'image',
            'accept'    => 'jpeg|jpg|gif|png', // useful for verifying files
            'duplicate' => 'Duplicate file!', // useful, i think
            'denied'    => 'Invalid file type',
            // useful, i think
        ));
        echo $form->error($model, 'image');

        if ($model->image):
            $image = explode(',', $model->image);
            foreach ($image as $k => $file):
                ?>
                <div class="clearfix"></div>
                <span><?php echo $file; ?> &nbsp;
                <a href="javascript:;" onclick="javascript:removeFile('<?php echo $file; ?>', <?php echo $k; ?>)" title="Remove"
                   class="remove_<?php echo $k; ?>">Remove File</a></span>
                <div class="clearfix"></div>
            <?php
            endforeach;
        endif;?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'position'); ?>
        <?php echo $form->dropDownList($model, 'position', Lookup::items('Position_Banner')); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>

    <div class="row checkboxList">
        <?php echo $form->labelEx($model, 'page'); ?>
        <?php echo $form->checkBoxList($model, 'page', Lookup::items('Display_On_Page'), array('class' => 'text-input small-input')); ?>
        <?php echo $form->error($model, 'page'); ?>
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

        <div class="row">
            <?php echo $form->labelEx($model, 'expired_date'); ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'       => $model,
                'attribute'   => 'expired_date', // additional javascript options for the date picker plugin
                'options'     => array(
                    'showOtherMonths'   => true,
                    'selectOtherMonths' => true,
                    'changeMonth'       => true,
                    'changeYear'        => true,
                    //                'showButtonPanel' => true,
                    'showAnim'          => 'fold',
                    'dateFormat'        => 'mm-dd-yy', //                'minDate'     => '0',
                    'minYear'           => '2013',
                    'onSelect'          => "js:function() {

                    }",
                ),
                'htmlOptions' => array(
                    'class' => 'text-input small-input'
                ),
            )); ?>
            <?php echo $form->error($model, 'expired_date'); ?>
        </div>
    <?php } ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<?php
$scriptDelete = '
if("' . $model->image . '" != ""){
    function removeFile(fileName, pos) {
        var url = "' . Helper::url('/Admin/default/deleteimage') . '";
        var imageID = "' . $model->id . '";
        var modelName = "' . ucfirst(Yii::app()->controller->id) .'";

        $.post(
            url, { imageID: imageID, imageName: fileName, model: modelName },
            function(data){
                $("a.remove_"+pos).parent().html(data + ". Please refresh page after deleting no more.");
//                parent.window.location = parent.window.location
            }, "json"
        );

        return false;
    }
}
';
Helper::cs()->registerScript('scriptDelete', $scriptDelete, CClientScript::POS_END);
