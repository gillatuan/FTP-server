<?php

/* @var $this ProductsController */
/* @var $model Products */
$this->breadcrumbs = array(
    'Products' => array('index'),
    'Manage',
);
$this->menu = array(
    array(
        'label' => 'List Products',
        'url'   => array('index')
    ),
    array(
        'label' => 'Create Products',
        'url'   => array('create')
    ),
);
Yii::app()->clientScript->registerScript('search', "

$('.search-button').click(function(){
	$('.search-form').toggle();

	return false;
});

$('.search-form form').submit(function(){
	$('#products-grid').yiiGridView('update', {
		data: $(this).serialize()
	});

	return false;
});
");
?>


    <div class="content-box-header">
        <h3>Quản lý Sản phẩm</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Table</a></li>
            <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2">Forms</a></li>
        </ul>
        <div class="clear"></div>
    </div>
    <!-- End .content-box-header -->
    <div class="content-box-content">
        <div id="response"></div>
        <div class="tab-content default-tab" id="tab1">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'              => 'products-grid',
                'dataProvider'    => $model->search(),
                'filter'          => $model,
                'afterAjaxUpdate' => 'js:function(){
                    $(".changeValue").bind("click change", function() {
                        var orderId = $(this).attr("id").replace("changeValue_", "");
                        var orderValue = $(this).val();
                        var orderAttribute = $(this).attr("class").replace("changeValue ", "");
                        var gridName = "' . Yii::app()->controller->id .'";
                        var modelName = "' . ucfirst(Yii::app()->controller->id) .'";
                        var pageCode = "";

                        switch (orderAttribute) {
                            case "page":
                                orderValue = $(this).is(":checked") == true ? 1 : 0;
                                pageCode = $(this).val();
                                break;
                            case "is_popular":
                                orderValue = $(this).is(":checked") == true ? 1 : 0;
                                break;
                            case "status":
                                orderValue = $(this).attr("alt") == "active" ? 1 : 2;
                                break;
                        }

                        $.ajax({
                            url:"' . Helper::url('/Admin/default/ajaxUpdate') . '",
                            type: "post",
                            data: { "id": orderId, "value": orderValue, "attr": orderAttribute, "model": modelName, "pageCode": pageCode },
                            success: function(){
                                $.fn.yiiGridView.update(gridName + "-grid");
                            }
                        });

                        return false;
                    })
                }',
                'columns'         => array(
                    array(
                        'name'  => 'cate_id',
                        'value' => '$data->cate->name'
                    ),
                    'name',
                    array(
                        'name'  => 'price_curr',
                        'value' => 'CHtml::textField("changeValue[$data->id]", $data->price_curr, array("style" => "width: 70px; padding: 2px 5px;", "class" => "changeValue price_curr"))',
                        'type'  => 'raw',
                    ),
                    array(
                        'name'  => 'price',
                        'value' => 'CHtml::textField("changeValue[$data->id]", $data->price, array("style" => "width: 70px; padding: 2px 5px;", "class" => "changeValue price"))',
                        'type'  => 'raw',
                    ),
                    array(
                        'name' => 'barcode',
                        'value' => 'CHtml::textField("changeValue[$data->id]", $data->barcode, array("style" => "width: 70px; padding: 2px 5px;", "class" => "changeValue barcode"))',
                        'type'  => 'raw',
                    ),
                    'total_buy',
                    array(
                        'name'  => 'discount',
                        'value' => 'CHtml::textField("changeValue[$data->id]", $data->discount, array("style" => "width: 20px; padding: 2px 5px;", "class" => "changeValue discount"))',
                        'type'  => 'raw',
                    ),
                    array(
                        'name'        => 'status',
                        'value'       => '$data->status == 1 ? CHtml::image(Helper::themeUrl()."/images/log_severity1.gif","active", array("id" => "changeValue_$data->id", "class" => "changeValue status")) : CHtml::image(Helper::themeUrl()."/images/delicon.gif", "inactive", array("id" => "changeValue_$data->id", "class" => "changeValue status"))',
                        'type'        => 'raw',
                        'filter'      => Lookup::items('status'),
                        'htmlOptions' => array('style' => 'text-align: center'),
                    ),
                    array(
                        'name' => 'page',
                        'value' => 'Helper::printArray("Display_On_Page", $data->page, ",", $data->id)',
                         /* 'CHtml::checkBox("changeValue[$data->id]", $data->page, array("style" => "width: 70px; padding: 2px 5px;", "class" => "changeValue page"))',*/
                        'type'  => 'raw',
                        'htmlOptions' => array('style' => 'width: 100px; max-width: 100px; word-wrap: break-word; overflow: hidden')
                    ),
                    array(
                        'name' => 'is_popular',
                        'value' => 'CHtml::checkBox("changeValue[$data->id]", $data->is_popular, array("style" => "width: 70px; padding: 2px 5px;", "class" => "changeValue is_popular"))',
                        'type'  => 'raw',
                    ),
                     /*
                    'id',
                    'alias',
                    'image',
                    'info',
                    array(
                        'name'  => 'quantity',
                        'value' => 'CHtml::textField("changeValue[$data->id]", $data->quantity, array("style" => "width: 20px; padding: 2px 5px;", "class" => "changeValue quantity"))',
                        'type'  => 'raw',
                    ),
                    'description',
                    'is_sale_off',
                    'create_date',
                    */
                    array(
                        'class' => 'CButtonColumn',
                    ),
                ),
            )); ?>
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
        var pageCode = "";

        switch (orderAttribute) {
            case "page":
                orderValue = $(this).is(":checked") == true ? 1 : 0;
                pageCode = $(this).val();
                break;
            case "is_popular":
                orderValue = $(this).is(":checked") == true ? 1 : 0;
                break;
            case "status":
                orderValue = $(this).attr("alt") == "active" ? 1 : 2;
                break;
        }

        $.ajax({
            url:"' . Helper::url('/Admin/default/ajaxUpdate') . '",
            type: "post",
            data: { "id": orderId, "value": orderValue, "attr": orderAttribute, "model": modelName, "pageCode": pageCode },
            success: function(){
                $.fn.yiiGridView.update(gridName + "-grid");
            }
        });

        return false;
    })
';
Helper::cs()->registerScript('set-status', $script, CClientScript::POS_END);
$scriptSort = '
    $("#products-grid tr").each(function(){
        order = $(this).find("td:first input").val();
        $(this).attr("id","products_"+order);
        $(this).css("cursor", "pointer")
    });

    $("tbody").sortable({
        opacity: 0.8,
        cursor: "move",
        update: function() {
            var order = $(this).sortable("serialize") + "&update=update";
            $.post("' . Helper::url("/Admin/products/admin") . '", order, function(theResponse){
                $.fn.yiiGridView.update("products-grid");
            });

            return false;
        }
    });
';
Helper::cs()->registerScript('set-sort', $scriptSort, CClientScript::POS_END);
