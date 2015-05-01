<?php

/* @var $this ProductsController */
/* @var $model Products */
/* @var $form CActiveForm */
?>
<style>
    .checkboxList input { width: 2% !important; display: inline; }
    .checkboxList label { display: inline; }
</style>
    <div class="form">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id'                     => 'products-form',
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
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name', array('class' => 'text-input small-input')); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'info'); ?>
            <?php echo $form->textArea($model, 'info', array(
                'rows'  => 12,
                'class' => 'medium-input textarea'
            )) ?>
            <?php echo $form->error($model, 'info'); ?>
        </div>

        <!--<div class="row tinymce">
            <?php /*echo $form->labelEx($model, 'description'); */?>
            <?php /*$this->widget('application.extensions.etinymce.ETinyMce',
                array(
                    'model'=>$model,
                    'attribute'=>'description',
                    'editorTemplate'=>'full',
                    'htmlOptions'=>array('rows'=>6, 'cols'=>70, 'class'=>'medium-input textarea'),
                )); */?>
            <?php /*echo $form->error($model, 'description'); */?>
        </div>-->

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
                    <a href="javascript:;" onclick="javascript:removeFile('<?php echo $file; ?>', <?php echo $k; ?>)" title="Remove" class="remove_<?php echo $k; ?>">Remove File</a></span>
                    <div class="clearfix"></div>
                <?php
                endforeach;
            endif;?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'price_curr'); ?>
            <?php echo $form->textField($model, 'price_curr', array('class' => 'text-input small-input')); ?>
            <?php echo $form->error($model, 'price_curr'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'price'); ?>
            <?php echo $form->textField($model, 'price', array('class' => 'text-input small-input')); ?>
            <?php echo $form->error($model, 'price'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'barcode'); ?>
            <?php echo $form->textField($model, 'barcode', array('class' => 'text-input small-input')); ?>
            <?php echo $form->error($model, 'barcode'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'quantity'); ?>
            <?php echo $form->textField($model, 'quantity', array('class' => 'text-input small-input')); ?>
            <?php echo $form->error($model, 'quantity'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'is_sale_off'); ?>
            <?php echo $form->checkBox($model, 'is_sale_off', array(
                'size'      => 1,
                'maxlength' => 1,
                'class'     => 'is-sale-off'
            )); ?>
            <?php echo $form->error($model, 'is_sale_off'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'discount'); ?>
            <?php echo $form->textField($model, 'discount', array('class' => 'text-input small-input')); ?>
            <?php echo $form->error($model, 'discount'); ?>
        </div>

        <div class="row checkboxList">
            <?php echo $form->labelEx($model, 'page'); ?>
            <div class="clearfix"></div>
            <?php echo $form->checkBoxList($model, 'page', Lookup::items('Display_On_Page'), array('class' => 'text-input small-input')); ?>
            <?php echo $form->error($model, 'page'); ?>
        </div>

        <div class="row checkboxList">
            <?php echo $form->labelEx($model, 'is_popular'); ?>
            <?php echo $form->checkBox($model, 'is_popular', array('class' => 'text-input small-input')); ?>
            <?php echo $form->error($model, 'is_popular'); ?>
        </div>

        <?php if (!$model->isNewRecord) { ?>
            <div class="row">
                <?php echo $form->labelEx($model, 'alias'); ?>
                <?php echo $model->alias; ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'total_buy'); ?>
                <?php echo $form->textField($model, 'total_buy', array('class' => 'text-input small-input')); ?>
                <?php echo $form->error($model, 'total_buy'); ?>
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


<?php
$scriptDelete = '
if("' . $model->image . '" != ""){
    function removeFile(fileName, pos) {
        var url = "' . Helper::url('/Admin/default/deleteimage') . '";
        var imageID = "' . $model->id . '";

        $.post(
            url, { imageID: imageID, imageName: fileName, model: "Products" },
            function(data){
                $("a.remove_"+pos).parent().html(data + ". Please refresh page after deleting no more.");
//                parent.window.location = parent.window.location
            }, "json"
        );

        return false;
    }
}

$(function() {
    if ($("#Products_is_sale_off").attr("checked")) {
        $("#Products_discount").parents(".row").show();
    } else {
        $("#Products_discount").parents(".row").hide().find("input#Products_discount").attr("value", 0)
    }

    $(".is-sale-off").change(function(){
        if ($(this).attr("checked")) {
            $("#Products_discount").parents(".row").show();
        } else {
            $("#Products_discount").val("").parents(".row").hide();
        }
    });
})
';
Helper::cs()->registerScript('scriptDelete', $scriptDelete, CClientScript::POS_END);
