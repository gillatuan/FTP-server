<?php

$this->menu = array(
    array('label' => 'Create Lookup', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});

$('.search-form form').submit(function(){
	$('#lookup-grid').yiiGridView('update', {
		data: $(this).serialize()
	});

	return false;
});
");
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
                'id'           => 'lookup-grid',
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
                'dataProvider'     => $model->search(),// new CActiveDataProvider('Lookup', array('criteria' => $criteria)),
                'filter'           => $model,
                'columns'      => array(
                    array(
                        'class'       => 'CCheckBoxColumn',
                        'value'       => '$data->id',
                        'htmlOptions' => array('width' => '3%'),
                    ),
                    /*'id',*/
                    'name',
                    'code',
                    'type',
                    'position',
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
                <div class="dataTables_paginate paging_bootstrap pagination">

                </div>
            </div>
        </div>

    </div>




<?php
$script = '
$(function() {
    $(".summary").appendTo($(".dataTables_info"));
    $($(".yiiPager").attr("class", "")).appendTo(".dataTables_paginate");
    $(".pager").attr("class", "");
})
';
Helper::cs()->registerScript('set-status', $script, CClientScript::POS_END);