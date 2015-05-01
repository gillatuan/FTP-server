<?php
/* @var $this PostsController */
/* @var $model Posts */

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Posts', 'url'=>array('index')),
	array('label'=>'Create Posts', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#posts-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="content-box-header">
    <h3>Manage Your Posts</h3>
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
        <!-- This is the target div. id must match the href of this div's tab -->
        <div class="notification attention png_bg">
            <a href="#" class="close"><img src="<?php echo Helper::themeUrl(); ?>/images/icons/cross_grey_small.png"
                title="Close this notification" alt="close" /></a>

            <div>You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>
                &gt;=</b>, <b>
                &lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the
                comparison
                should be done.
            </div>
        </div>

        <?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
        <div class="search-form" style="display:none">
        <?php $this->renderPartial('_search',array(
            'model'=>$model,
        )); ?>
        </div><!-- search-form -->

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'posts-grid',
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
                'title',
                'info',
                array(
                    'name' => 'image',
                    'value' => 'Helper::renderFiles($data->image)'
                ),
                array(
                    'name'        => 'status',
                    'value'       => '$data->status == 1 ? CHtml::image(Helper::themeUrl()."/images/log_severity1.gif","active", array("id" => "changeValue_$data->id", "class" => "changeValue status")) : CHtml::image(Helper::themeUrl()."/images/delicon.gif", "inactive", array("id" => "changeValue_$data->id", "class" => "changeValue status"))',
                    'type'        => 'raw',
                    'filter'      => Lookup::items('status'),
                    'htmlOptions' => array('style' => 'text-align: center'),
                ),
                'tags',
                array(
                    'name' => 'create_date',
                    'value' => 'Helper::getTimeAgo($data->create_date)'
                ),
                array(
                    'name' => 'update_date',
                    'value' => 'Helper::getTimeAgo($data->update_date)'
                ),
                'priority',
                /*
                'id',
                'alias',
                'description',
                'update_date',
                */
                array(
                    'class'=>'CButtonColumn',
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
