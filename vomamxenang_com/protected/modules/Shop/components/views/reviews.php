<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $reviews,
    'viewData' => array(
        'isListPage' => $isListPage,
        'isOnIndex' => $isOnIndex
    ),
    'itemView' => 'renderViews',
    'summaryText' => '',
    'pager' => array(
        'class' => 'CLinkPager',
        'cssFile' => false,
        'header' => '',
        'firstPageLabel' => '&lt;&lt;',
        'prevPageLabel' => '&lt;',
        'nextPageLabel' => '&gt;',
        'lastPageLabel' => '&gt;&gt;',
    ),
    'ajaxUpdate' => true,
    'afterAjaxUpdate' => 'js:function(id, data){
        $("span[id^=\'user-rating-\'] > input").rating();
        $(".rating-cancel").remove();
        $(".star-rating-control .star-rating").addClass("star-rating-readonly");
    }',
)); ?>