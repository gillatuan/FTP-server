<style>
    .checkboxList #Banner_page input { width: 1% !important; display: inline; }
    .checkboxList #Banner_page label { display: inline; }
</style>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id'                     => 'banner-form',
    'enableClientValidation' => true,
    'enableAjaxValidation'   => true,
    'clientOptions'          => array(
        'validateOnSubmit'       => true,
        'afterValidateAttribute' => 'js:function(){

        }',
    ),
    'htmlOptions'            => array(
        'class'   => 'form-horizontal',
        'enctype' => 'multipart/form-data'
    ),
)); ?>

<?php //echo $form->errorSummary($model); ?>
    <div class="control-group">
        <?php echo $form->labelEx($model, 'name', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'name', array('class' => 'span6 m-wrap')); ?>
            <?php echo $form->error($model, 'name', array('class' => 'help-inline')); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'info', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textArea($model, 'info', array(
                'rows'  => 8,
                'class' => 'span8 m-wrap'
            )) ?>
            <?php echo $form->error($model, 'info', array('class' => 'help-inline')); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'page_link', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'page_link', array('class' => 'span8 m-wrap')); ?>
            <?php echo $form->error($model, 'page_link', array('class' => 'help-inline')); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'image', array('class' => 'control-label')); ?>
        <div class="controls">
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
            <?php echo $form->error($model, 'image', array('class' => 'span4 m-wrap')); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'position', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'position', Lookup::items('Position_Banner'), array('class' => 'span2 m-wrap')); ?>
            <?php echo $form->error($model, 'position', array('class' => 'help-inline')); ?>
        </div>
    </div>

    <div class="control-group checkboxList">
        <?php echo $form->labelEx($model, 'page', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->checkBoxList($model, 'page', Lookup::items('Display_On_Page'), array('class' => 'span2 m-wrap')); ?>
            <?php echo $form->error($model, 'page', array('class' => 'help-inline')); ?>
        </div>
    </div>

    <?php if (!$model->isNewRecord) { ?>
        <div class="control-group">
            <?php echo $form->labelEx($model, 'alias', array('class' => 'control-label')); ?>
            <div class="controls">
                <label><?php echo $model->alias; ?></label>
                <?php echo $form->error($model, 'alias', array('class' => 'help-inline')); ?>
            </div>
        </div>

        <div class="control-group">
            <?php echo $form->labelEx($model, 'status', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->dropDownList($model, 'status', Lookup::items('Status'), array('class' => 'span2 m-wrap')); ?>
                <?php echo $form->error($model, 'status', array('class' => 'help-inline')); ?>
            </div>
        </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'ordering', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $model->ordering; ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'create_date', array('class' => 'control-label')); ?>
        <div class="controls">
                <label><?php echo date('m-d-Y', $model->create_date); ?></label>
            <?php echo $form->error($model, 'create_date', array('class' => 'help-inline')); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'expired_date', array('class' => 'control-label')); ?>
        <div class="controls">
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
                    'class' => 'span4 m-wrap'
                ),
            )); ?>
            <?php echo $form->error($model, 'expired_date', array('class' => 'help-inline')); ?>
        </div>
    </div>
<?php } ?>



    <div class="form-actions">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn green')); ?>
    </div>

<?php $this->endWidget(); ?>
<?php
$scriptDelete = '
if("' . $model->image . '" != ""){
    function removeFile(fileName, pos) {
        var url = "' . Helper::url('/Admin/default/deleteimage') . '";
        var imageID = "' . $model->id . '";

        $.post(
            url, { imageID: imageID, imageName: fileName, model: "Banner" },
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
