<?php

/* @var $this CategoryController */
/* @var $model Category */
$this->breadcrumbs = array(
    'Categories' => array('index'),
    'Manage',
);
$this->menu = array(
    array(
        'label' => 'List Category',
        'url'   => array('index')
    ),
    array(
        'label' => 'Create Category',
        'url'   => array('create')
    ),
);
?>
<style>
    .cf:after { visibility: hidden; display: block; font-size: 0; content: " "; clear: both; height: 0; }
    * html .cf { zoom: 1; }
    *:first-child+html .cf { zoom: 1; }

    html { margin: 0; padding: 0; }
    body { font-size: 100%; margin: 0; padding: 1.75em; font-family: 'Helvetica Neue', Arial, sans-serif; }

    h1 { font-size: 1.75em; margin: 0 0 0.6em 0; }

    a { color: #2996cc; }
    a:hover { text-decoration: none; }

    p { line-height: 1.5em; }
    .small { color: #666; font-size: 0.875em; }
    .large { font-size: 1.25em; }

    /**
    * Nestable
    */

    .dd { position: relative; display: block; margin: 0; padding: 0; /*max-width: 600px;*/ list-style: none; font-size: 13px; line-height: 20px; }

    .dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
    .dd-list .dd-list { padding-left: 30px; }
    .dd-collapsed .dd-list { display: none; }

    .dd-item,
    .dd-empty,
    .dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }

    .dd-handle { display: block; margin: 5px 0; padding: 5px 10px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
    background: #fafafa;
    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:         linear-gradient(top, #fafafa 0%, #eee 100%);
    -webkit-border-radius: 3px;
    border-radius: 3px;
    box-sizing: border-box; -moz-box-sizing: border-box;
    }
    .dd-handle:hover, .dd-handle tbody { color: #2ea8e5; background: #fff; }

    .dd-item > button { display: block; position: absolute; top: 12px; left: -20px; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
    .dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
    .dd-item > button[data-action="collapse"]:before { content: '-'; }

    .dd-placeholder,
    .dd-empty { margin: 5px 0; padding: 0; min-height: 30px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; -moz-box-sizing: border-box; }
    .dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5;
    background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
    -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
    linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-size: 60px 60px;
    background-position: 0 0, 30px 30px;
    }

    .dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
    .dd-dragel > .dd-item .dd-handle { margin-top: 0; }
    .dd-dragel .dd-handle {
    -webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
    box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
    }

    .dd-item tr { background: none !important; }

</style>


    <div class="content-box-header">
        <h3>Quản lý chuyên mục</h3>
        <?php Helper::renderFlash('SUCCESS_MESSAGE', 'notification SUCCESS_MESSAGE png_bg', false, 'SUCCESS_MESSAGE'); ?>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Table</a></li>
            <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2">Forms</a></li>
        </ul>
        <div class="clear"></div>
    </div>
    <!-- End .content-box-header -->
    <div class="content-box-content category">
        <div id="response"></div>
        <div class="tab-content default-tab" id="tab1">
            <?php if (count($model)): ?>
                <table class="items">
                    <thead>
                        <tr>
                            <th align="left" width="400px">Category Name</th>
                            <th align="left" width="200px">Hiển thị trên</th>
                            <th width="100px">Visible</th>
                            <th width="100px">Action </th>
                        </tr>
                    </thead>
                </table>
                <div class="dd sortable">
                    <ol class="dd-list">
                        <?php $this->renderNestedCategory(dirname(__FILE__) . DIRECTORY_SEPARATOR . '_item.php', $model); ?>
                    </ol>
                </div>
            <?php else: ?>
                <table class="items">
                    <tr class="odd">
                        <td colspan="4"><?php echo Yii::t('zii', 'Không có chuyên mục nào.'); ?></td>
                    </tr>
                </table>
            <?php endif; ?>
        </div>
    </div>

<?php
Helper::cs()->registerScriptFile(Helper::themeUrl() . '/js/jquery.nestable.js', CClientScript::POS_END);
$script = '
    $(".changeValue").bind("click change", function() {
        var orderId = $(this).attr("id").replace("changeValue_", "");
        var orderValue = $(this).val();
        var orderAttribute = $(this).attr("class").replace("changeValue ", "");
        var gridName = "' . Yii::app()->controller->id .'";
        var modelName = "' . ucfirst(Yii::app()->controller->id) .'";
        var $this = $(this);

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
                if (orderValue == 1) {
                    $this.attr("src", "' . Helper::themeUrl()."/images/delicon.gif" . '");
                    $this.attr("alt", "inactive");
                } else {
                    $this.attr("src", "' . Helper::themeUrl()."/images/log_severity1.gif" . '");
                    $this.attr("alt", "active");
                }
            }
        });

        return false;
    })

    $(".delete").click(function() {
        var cateId = $(this).attr("id");
        var url = "' . Helper::url('/Admin/category/admin') . '";
        var typeAction = "deleteCategory";
        var _this = jQuery(this);

        $.ajax({
            url: url,
            type: "get",
            data: {"status": status, "id": cateId, "model": "Category", "typeAction": typeAction},
            success: function(data){
                if (data == "Success") {
                    jQuery(_this.parent().parent()).remove();
                } else {
                    alert(data);
                }
            }
        });

        return false;
    })
';
Helper::cs()->registerScript('set-status', $script, CClientScript::POS_END);
$scriptSort = '
    $(".sortable").nestable({
        opacity: 0.5
    }).on("change", function(e) {
        var list   = e.length ? e : $(e.target),
        output = list.data("output");

        var valJson = window.JSON.stringify(list.nestable("serialize"));
        var url = "' . Helper::url('/Admin/category/updateNested') . '";

        $.ajax({
            url: url,
            type: "post",
            data: {"type": "updateNested", "dataNested": valJson},
            success: function(data){
                $("#response").html("<div class=\"label label-success span12\">Update Nested Category successfully.</div>");
                setTimeout(function() {
                    $("#response").fadeOut("slow");
                }, 1000);
            }
        })
    });
';
Helper::cs()->registerScript('set-sort', $scriptSort, CClientScript::POS_END);
