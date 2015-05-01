<?php
/* @var $this ReviewController */
/* @var $model Review */

$this->breadcrumbs = array(
    'Reviews' => array('index'),
    'Manage',
);

/*$this->menu = array(
    array('label' => 'Create Review', 'url' => array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#review-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?><div class="content-box-header">
        <h3>Quản lý Nhận xét</h3>
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
    'id'           => 'review-grid',
    'dataProvider' => $model->search(),
    'filter'       => $model,
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
                data: { "id": orderId, "value": orderValue, "attr": orderAttribute, "model": modelName },
                success: function(){
                    $.fn.yiiGridView.update(gridName + "-grid");
                }
            });

            return false;
        })
    }',
    'columns'      => array(
        'full_name',
        array(
            'name' => 'description',
            'value' => '$data->description',
            'htmlOptions' => array('style' => 'max-width: 300px; overflow: hidden')
        ),
        'rating',
        array(
            'name' => 'page',
            'value' => 'Helper::printArray("Display_On_Page", $data->page)',
            /* 'CHtml::checkBox("changeValue[$data->id]", $data->page, array("style" => "width: 70px; padding: 2px 5px;", "class" => "changeValue page"))',*/
            'type'  => 'raw',
            'htmlOptions' => array('style' => 'width: 70px; max-width: 70px; word-wrap: break-word; overflow: hidden')
        ),
        array(
            'name'        => 'status',
            'value'       => '$data->status == 1 ? CHtml::image(Helper::themeUrl()."/images/log_severity1.gif","active", array("id" => "changeValue_$data->id", "class" => "changeValue status")) : CHtml::image(Helper::themeUrl()."/images/delicon.gif", "inactive", array("id" => "changeValue_$data->id", "class" => "changeValue status"))',
            'type'        => 'raw',
            'filter'      => Lookup::items('status'),
            'htmlOptions' => array('style' => 'text-align: center'),
        ),
        /*
        'id',
        'subject',
        'ip_address',
        'create_date',
        'product_id',
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

        switch (orderAttribute) {
            case "page":
                orderValue = $(this).is(":checked") == true ? 1 : 0;
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
    $("#review-grid tr").each(function(){
        order = $(this).find("td:first input").val();
        $(this).attr("id","review_"+order);
        $(this).css("cursor", "pointer")
    });

    $("tbody").sortable({ opacity: 0.8, cursor: "move", update: function() {
            var order = $(this).sortable("serialize") + "&update=update";
            $.post("' . Helper::url("/Admin/review/admin") . '", order, function(theResponse){
                $.fn.yiiGridView.update("review-grid");
            });

            return false;
        }
    });
';
Helper::cs()->registerScript('set-sort', $scriptSort, CClientScript::POS_END);
