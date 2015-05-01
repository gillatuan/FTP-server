<?php
/* @var $this UserController */
/* @var $model User */
$this->breadcrumbs = array(
    'Users' => array('index'),
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

<div class="portlet-title">
        <h4><i class="icon-reorder"></i>Manage User</h4>

    <div class="tools">
        <a href="javascript:;" class="collapse"></a>
        <a href="#portlet-config" data-toggle="modal" class="config"></a>
        <a href="javascript:;" class="reload"></a>
        <a href="javascript:;" class="remove"></a>
    </div>
</div>
<div class="portlet-body">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
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
	'columns'=>array(
		'username',
        array(
            'name' => 'status',
            'value' => '"<a href=\"#\" class=\"set-status\" id=\"".$data->id."\">".($data->status == 1 ? CHtml::image(Yii::app()->theme->baseUrl."/images/log_severity1.gif","active") : CHtml::image(Yii::app()->theme->baseUrl."/images/delicon.gif","inactive"))."</a>"',
            'type' => 'raw',
            'filter' => Lookup::items('status'),
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
$(function() {
    $("a.set-status").live("click", function(){
        status = $(this).find("img").attr("alt") == "active" ? "inactive" : "active";

        $.ajax({
            url:"' . Helper::url('/Admin/user/admin') . '",
            type: "get",
            data: {"status": status, "id": $(this).attr("id"), "model": "user"},
            success: function(){
//                alert("Update Status is successful");
                $.fn.yiiGridView.update("user-grid");
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
?>