<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'News'=>array('index'),
	'Manage',
);

/*$this->menu=array(
	array('label'=>'List News', 'url'=>array('index')),
	array('label'=>'Create News', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#news-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="content-box-header">
    <h3>Manage Your News</h3>
    <ul class="content-box-tabs">
        <li><a href="#tab1" class="default-tab">Table</a></li>
        <!-- href must be unique and match the id of target div -->
        <li><a href="#tab2">Forms</a></li>
    </ul>
    <div class="clear"></div>
</div>
<!-- End .content-box-header -->
<div class="content-box-content">
    <div class="tab-content default-tab" id="tab1">
<!--
<?php /*echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); */?>
<div class="search-form" style="display:none">
<?php /*$this->renderPartial('_search',array(
	'model'=>$model,
)); */?>
</div>--><!-- search-form -->

<?php $grid = $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'news-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'selectableRows'=>2,
    'selectionChanged'=>"updateSelectors",
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
	'columns'=>array(
        array(
            'class'=>'CCheckBoxColumn',
            'value'=>'$data->id',
            'htmlOptions'=>array('width'=>'3%'),
        ),
		'title',
		'info',
        array(
            'name'        => 'status',
            'value'       => '$data->status == 1 ? CHtml::image(Helper::themeUrl()."/images/log_severity1.gif","active", array("id" => "changeValue_$data->id", "class" => "changeValue status")) : CHtml::image(Helper::themeUrl()."/images/delicon.gif", "inactive", array("id" => "changeValue_$data->id", "class" => "changeValue status"))',
            'type'        => 'raw',
            'filter'      => Lookup::items('status'),
            'htmlOptions' => array('style' => 'text-align: center'),
        ),
        array(
            'name' => 'page',
            'value' => 'Helper::printArray("Display_On_Page", $data->page)',
            /* 'CHtml::checkBox("changeValue[$data->id]", $data->page, array("style" => "width: 70px; padding: 2px 5px;", "class" => "changeValue page"))',*/
            'type'  => 'raw',
            'htmlOptions' => array('style' => 'width: 70px; max-width: 70px; word-wrap: break-word; overflow: hidden')
        ),
		/*
		'id',
		'alias',
		'content',
		'image',
		'create_date',
		'update_date',
		'type_news',
		*/
        array(
            'class'=>'CButtonColumn',
            'template'=> '{view} {update} {delete}',
            'buttons'=>array
            (
                'update' => array
                (
                    /*'label'=>'Send an e-mail to this user',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',*/
                    'url'=> 'Helper::url("update", array("id" => $data->id, "type" => Helper::get("type")))',
                ),
            ),
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
/*
if ($grid->dataProvider->ItemCount) {
    $this->menu[] = array('label' => 'Delete selected items', 'url'=>$this->createUrl('delete'), 'linkOptions' => array('onclick'=>'return multipleDelete("news-grid",this.href)'));
}
Yii::app()->clientScript->registerScriptFile($this->module->basePath . '/assets/scripts/gridview.js', CClientScript::POS_BEGIN);*/
