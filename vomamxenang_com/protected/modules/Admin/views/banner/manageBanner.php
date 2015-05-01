<?php
/* @var $this BannerController */
/* @var $model Banner */
$this->menu = array(
    array(
        'label' => 'Create Banner',
        'url'   => array('create')
    ),
);
?>

    <div class="portlet-title">
        <h4><i class="icon-reorder"></i>Manage Banner</h4>

        <div class="tools">
            <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;"
                                                                                                                              class="reload"></a> <a
                href="javascript:;" class="remove"></a>
        </div>
    </div>
    <div class="portlet-body">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'              => 'banner-grid',
            'htmlOptions'     => array('class' => 'dataTables_wrapper form-inline'),
            'rowCssClass'     => array(
                'gradeX odd',
                'gradeX even'
            ),
            'itemsCssClass'   => 'table table-striped table-bordered dataTable', //        'summaryText' => '',
            'summaryCssClass' => 'dataTables_info',
            'pager'           => array(
                'class'                => 'CLinkPager',
                'header'               => '',
                'internalPageCssClass' => '',
                'hiddenPageCssClass'   => 'disabled',
                'selectedPageCssClass' => 'active',
                'firstPageCssClass'    => 'first',
                'firstPageLabel'       => 'First',
                'prevPageLabel'        => '← Prev',
                'previousPageCssClass' => 'prev',
                'nextPageLabel'        => 'Next → ',
                'nextPageCssClass'     => 'next',
                'lastPageLabel'        => 'Last',
                'lastPageCssClass'     => 'last',
                'maxButtonCount'       => 10,
            ),
            'dataProvider'    => $model->search(),
            'filter'          => $model,
            'afterAjaxUpdate' => 'js:function(){
                $(".changeValue").bind("click change", function() {
                    var orderId = $(this).attr("id").replace("changeValue_", "");
                    var orderValue = $(this).val();
                    var orderAttribute = $(this).attr("class").replace("changeValue ", "");
                    var gridName = "' . Yii::app()->controller->id .'";
                    var modelName = "' . ucfirst(Yii::app()->controller->id) .'";

                    switch (orderAttribute) {
                        case "page":
                            orderValue = $(this).is(":checked") == true ? 1 : 0;
                            break;
                        case "status":
                            orderValue = $(this).attr("alt") == "active" ? 1 : 2;
                            break;
                    }

                    $.ajax({
                        url:"' . Helper::url('/Admin/default/ajaxUpdate') . '",
                        type: "post",
                        data: { "id": orderId, "value": orderValue, "attr": orderAttribute, "model": modelName },
                        success: function(){
                            $.fn.yiiGridView.update(gridName + "-grid");
                        }
                    });

                    return false;
                })

                $("#banner-grid tr").each(function(){
                    order = $(this).find("td:first input").val();
                    $(this).attr("id","banner_"+order);
                    $(this).css("cursor", "pointer")
                });

                $("tbody").sortable({ opacity: 0.8, cursor: "move", update: function() {
                        var order = $(this).sortable("serialize") + "&update=update";
                        $.post("' . Helper::url("/Admin/banner/admin") . '", order, function(theResponse){
                            $.fn.yiiGridView.update("banner-grid");
                        });

                        return false;
                    }
                });
            }',
            'columns'         => array(
                'name',
                array(
                    'name'        => 'status',
                    'value'       => '$data->status == 1 ? CHtml::image(Helper::themeUrl()."/images/log_severity1.gif","active", array("id" => "changeValue_$data->id", "class" => "changeValue status")) : CHtml::image(Helper::themeUrl()."/images/delicon.gif", "inactive", array("id" => "changeValue_$data->id", "class" => "changeValue status"))',
                    'type'        => 'raw',
                    'filter'      => Lookup::items('status'),
                    'htmlOptions' => array('style' => 'text-align: center', 'class' => 'hidden-phone'),
                ),
                array(
                    'name'  => 'image',
                    'value' => '$data->image ? CHtml::image(Helper::renderImage($data->image, "uploads/Banner", ",", true, true),"active") : "" ',
                    'type'  => 'raw',
                    'htmlOptions' => array(
                        'style' => 'text-align: center; max-width: 60px',
                        'class' => 'hidden-phone'
                    ),
                ),
                array(
                    'name'        => 'position',
                    'value'       => 'Lookup::item("Position_Banner", $data->position)',
                    'htmlOptions' => array(
                        'style' => 'text-align: center'
                    )
                ),
	        array(
	            'name' => 'page',
	            'value' => 'Helper::printArray("Display_On_Page", $data->page, ",")',
	            /*'CHtml::checkBoxList("page", Lookup::items("Display_On_Page"), $data->page)', */
	            /*'CHtml::checkBox("changeValue[$data->id]", $data->page, array("style" => "width: 70px; padding: 2px 5px;", "class" => "changeValue page"))',*/
	            'type'  => 'raw',
	        ),
                'expired_date',
                 /*
                'id',
                'info',
                'ordering',
                'create_date',
                */
                array(
                    'class' => 'CButtonColumn',
                ),
            ),
        )); ?>

        <div class="row-fluid">
            <div class="span6">
                <div class="dataTables_info" id="sample_2_info"></div>
            </div>
            <div class="span6">
                <div class="dataTables_paginate paging_bootstrap pagination"></div>
            </div>
        </div>
    </div>


<?php
$script = '
    $(".changeValue").bind("click change", function() {
        var orderId = $(this).attr("id").replace("changeValue_", "");
        var orderValue = $(this).val();
        var orderAttribute = $(this).attr("class").replace("changeValue ", "");
        var gridName = "' . Yii::app()->controller->id .'";
        var modelName = "' . ucfirst(Yii::app()->controller->id) .'";

        switch (orderAttribute) {
            case "page":
                orderValue = $(this).is(":checked") == true ? 1 : 0;
                break;
            case "status":
                orderValue = $(this).attr("alt") == "active" ? 1 : 2;
                break;
        }

        $.ajax({
            url:"' . Helper::url('/Admin/default/ajaxUpdate') . '",
            type: "post",
            data: { "id": orderId, "value": orderValue, "attr": orderAttribute, "model": modelName },
            success: function(){
                $.fn.yiiGridView.update(gridName + "-grid");
            }
        });

        return false;
    })
';
Helper::cs()->registerScript('set-status', $script, CClientScript::POS_END);
$scriptSort = '
        $("#banner-grid tr").each(function(){
            order = $(this).find("td:first input").val();
            $(this).attr("id","banner_"+order);
            $(this).css("cursor", "pointer")
        });

        $("tbody").sortable({ opacity: 0.8, cursor: "move", update: function() {
                var order = $(this).sortable("serialize") + "&update=update";
                $.post("' . Helper::url("/Admin/banner/admin") . '", order, function(theResponse){
                    $.fn.yiiGridView.update("banner-grid");
                });

                return false;
            }
        });
    ';
Helper::cs()->registerScript('set-sort', $scriptSort, CClientScript::POS_END);
