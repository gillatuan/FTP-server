<style>
    .checkboxList #Category_page input { width: 2% !important; display: inline; }
    .checkboxList #Category_page label { display: inline; }
</style>
    <div class="tab-content form">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id'                     => 'category-form',
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
            <?php echo $form->labelEx($model, 'parent_id'); ?>

            <?php $this->widget('Admin.components.CategoryDropDownList', array(
                'model'       => $model,
                'attribute'   => 'parent_id',
                'htmlOptions' => array(
                    'prompt' => 'Root',
                    'class'  => 'text-input small-input'
                ),
                //            'exclude'=>array($model->id),
                //            'enableCache'=>true,
            )); ?>

            <?php echo $form->error($model, 'parent_id'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name', array('class' => 'text-input small-input')); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>

        <div class="row tinymce">
            <?php echo $form->labelEx($model, 'description'); ?>
            <?php
            $this->widget('ext.tinymce.TinyMce', array(
                'model' => $model,
                'attribute' => 'description',
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
            <?php echo $form->error($model, 'description'); ?>
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
                       class="remove_<?php echo $k; ?>">Remove
                        File</a></span>
                    <div class="clearfix"></div>
                <?php
                endforeach;
            endif;?>
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
        <?php } ?>

        <div class="row checkboxList">
            <?php echo $form->labelEx($model, 'page'); ?>
            <?php echo $form->checkBoxList($model, 'page', Lookup::items('Display_On_Page'), array('class' => 'text-input small-input')); ?>
            <?php echo $form->error($model, 'page'); ?>
        </div>

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