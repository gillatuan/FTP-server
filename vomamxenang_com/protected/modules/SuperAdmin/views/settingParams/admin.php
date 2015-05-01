<?php

$this->menu=array(
	array('label'=>'Create SettingParams', 'url'=>array('create')),
);
?>

<div class="portlet-title">
    <h4><i class="icon-reorder"></i>Manage Setting Params</h4>
    <div class="tools">
        <a href="javascript:;" class="collapse"></a>
        <a href="#portlet-config" data-toggle="modal" class="config"></a>
        <a href="javascript:;" class="reload"></a>
        <a href="javascript:;" class="remove"></a>
    </div>
</div>
<div class="portlet-body">
    <?php Helper::renderFlash('configParams', 'label-success', true); ?>

    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'setting-params-grid',
        'htmlOptions' => array('class' => 'dataTables_wrapper form-inline'),
        'rowCssClass' => array('gradeX odd', 'gradeX even'),
        'itemsCssClass' => 'table table-striped table-bordered dataTable',
//        'summaryText' => '',
        'summaryCssClass' => 'dataTables_info',
        'pager' => array(
            'class' => 'CLinkPager',
            'header' => '',
            'internalPageCssClass' => '',
            'hiddenPageCssClass' => 'disabled',
            'selectedPageCssClass' => 'active',
            'firstPageCssClass' => 'first',
            'firstPageLabel' => 'First',
            'prevPageLabel' => '← Prev',
            'previousPageCssClass' => 'prev',
            'nextPageLabel' => 'Next → ',
            'nextPageCssClass' => 'next',
            'lastPageLabel' => 'Last',
            'lastPageCssClass' => 'last',
            'maxButtonCount' => 10,
        ),
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'selectableRows'=>2,
        'afterAjaxUpdate'=>"js:function(){
            $('.pager').hide();
            $('.form-inline .summary').hide();
        }",
        'columns'=>array(
            'name',
            array(
                'name' => 'label',
//                'htmlOptions' => array('class' => 'hidden-phone'),
            ),
            'values',
            array(
                'name' => 'visible',
                'value' => '"<a href=\"#\" class=\"set-status\" id=\"".$data->id."\">".($data->visible == 1 ? CHtml::image(Yii::app()->theme->baseUrl."/images/log_severity1.gif","active") : CHtml::image(Yii::app()->theme->baseUrl."/images/delicon.gif","inactive"))."</a>"',
                'type' => 'raw',
                'filter' => Lookup::items('Status'),
                'htmlOptions' => array('style' => 'text-align: center', 'class' => 'hidden-phone'),
            ),
            array(
                'name' => 'setting_group',
//                'htmlOptions' => array('class' => 'hidden-phone'),
            ),
            /*
            'id',
            'description',
            'ordering',
            'module',
            */
            array(
                'class'=>'CButtonColumn',
            ),
        ),
    )); ?>

    <div class="row-fluid">
        <div class="span6">
            <div class="dataTables_info" id="sample_2_info"></div>
        </div>
        <div class="span6">
            <div class="dataTables_paginate paging_bootstrap pagination">

            </div>
        </div>
    </div>

</div>




<?php
$script = '
$(function() {
    $("a.set-status").live("click", function(){
        var status = $(this).find("img").attr("alt") == "active" ? "inactive" : "active";

        $.ajax({
            url:"' . Helper::url('/SuperAdmin/settingParams/admin') . '",
            type: "get",
            data: {"visible": status, "id": $(this).attr("id"), "model": "SettingParams"},
            success: function(){
//                alert("Update Status is successful");
                $.fn.yiiGridView.update("setting-params-grid");
            }
        });
        return false;
    })

    $(".summary").appendTo($(".dataTables_info"));
    $($(".yiiPager").attr("class", "")).appendTo(".dataTables_paginate");
    $(".pager").attr("class", "");
})
';
Helper::cs()->registerScript('set-status', $script, CClientScript::POS_END);