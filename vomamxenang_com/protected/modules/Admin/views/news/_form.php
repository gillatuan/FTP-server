<style>
    .checkboxList #News_page input { width: 2% !important; display: inline; }
    .checkboxList #News_page label { display: inline; }
</style>

<div class="tab-content form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form',
    'enableClientValidation' => true,
    'enableAjaxValidation'   => true,
    'clientOptions'          => array('validateOnSubmit' => true,),
    'htmlOptions'            => array('enctype' => 'multipart/form-data')
        )
    );?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title', array('class' => 'text-input small-input')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'info'); ?>
		<?php echo $form->textArea($model,'info', array('rows' => 8, 'class' => 'medium-input')); ?>
		<?php echo $form->error($model,'info'); ?>
	</div>

    <div class="row tinymce">
        <?php echo $form->labelEx($model, 'content'); ?>
        <?php
        $this->widget('ext.tinymce.TinyMce', array(
            'model' => $model,
            'attribute' => 'content',
            // Optional config
            'compressorRoute' => 'tinyMce/compressor',
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
        <?php echo $form->error($model, 'content'); ?>
    </div>

	<!--<div class="row">
		<?php /*echo $form->labelEx($model,'content'); */?>
		<?php /*echo $form->textArea($model,'content', array('rows' => 12, 'class' => 'medium-input textarea wysiwyg')) */?>
		<?php /*echo $form->error($model,'content'); */?>
	</div>-->

    <?php echo $form->hiddenField($model, "image"); ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'image'); ?>
        <?php $this->widget('CMultiFileUpload', array(
            'name'      => 'image',
            'accept'    => 'jpeg|jpg|gif|png', // useful for verifying files
            'duplicate' => 'Duplicate file!', // useful, i think
            'denied'    => 'Invalid file type', // useful, i think
        ));
        echo $form->error($model, 'image');

        if ($model->image):
            $image = explode(',', $model->image);
            foreach ($image as $k => $file):
                ?>
                <div class="clearfix"></div>
                <span><?php echo $file; ?> &nbsp;<a href="javascript:;"
                        onclick="javascript:removeFile('<?php echo $file; ?>', <?php echo $k; ?>)" title="Remove"
                        class="remove_<?php echo $k; ?>">Remove File</a></span>
                <div class="clearfix"></div>
            <?php
            endforeach;
        endif;?>
    </div>

    <div class="row checkboxList">
        <?php echo $form->labelEx($model, 'page'); ?>
        <div class="clearfix"></div>
        <?php echo $form->checkBoxList($model, 'page', Lookup::items('Display_On_Page'), array('class' => 'text-input small-input')); ?>
        <?php echo $form->error($model, 'page'); ?>
    </div>

    <!--<div class="row">
        <?php /*echo $form->labelEx($model,'type_news'); */?>
        <?php /*echo $form->dropDownList($model, 'type_news', Lookup::items('Type_News')); */?>
        <?php /*echo $form->error($model, 'type_news'); */?>
    </div>-->

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
        <?php echo Helper::getTimeAgo($model->create_date); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'update_date'); ?>
        <?php echo Helper::getTimeAgo($model->update_date); ?>
    </div>

    <div class="row">
		<?php echo $form->labelEx($model,'type_news'); ?>
        <?php echo Lookup::item('Type_News', $model->type_news); ?>
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

            $.post(
                url, { imageID: imageID, imageName: fileName, model: "News" },
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