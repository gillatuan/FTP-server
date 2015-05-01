<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="content-box-header">
    <h3><?php if(Helper::user()->checkAccess('Super') || Helper::user()->checkAccess('Administrators')) { ?>Quản lý User<?php } else { ?>Cập nhật thông tin<?php } ?></h3>
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
<!--        --><?php //echo Helper::renderFlash($id, $message); ?>

<?php $grid = $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
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
		'username',
        array(
            'name'        => 'status',
            'value'       => '$data->status == 1 ? CHtml::image(Helper::themeUrl()."/images/log_severity1.gif","active", array("id" => "changeValue_$data->id", "class" => "changeValue status")) : CHtml::image(Helper::themeUrl()."/images/delicon.gif", "inactive", array("id" => "changeValue_$data->id", "class" => "changeValue status"))',
            'type'        => 'raw',
            'filter'      => Lookup::items('status'),
            'htmlOptions' => array('style' => 'text-align: center'),
        ),
		'email',
		'fullname',
		'phone',
		/*
		'id',
		'password',
		'address',
		'avatar',
		'created_date',
		'last_login',
		'validation_code',
		'validation_type',
		'validation_expired',
		'type',
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
                    'url'=> 'Helper::url("update", array("id" => $data->id))',
                ),
            ),
        ),
	),
)); ?>
    </div>
</div>

<?php
if (!Helper::user()->checkAccess('User')) {
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

    if ($grid->dataProvider->ItemCount) {
        $this->menu[] = array(
            'label' => 'Delete selected items', 'url' => Helper::url('/Admin/default/deleteSelected'),
            'linkOptions' => array('onclick' => 'return multipleDelete("comment-grid",this.href, "Comment")')
        );
    }

    Helper::cs()->registerScriptFile(Helper::themeUrl() . '/js/multi-delete.js', CClientScript::POS_END);
}
