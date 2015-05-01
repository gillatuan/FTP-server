<h2 class="topbottom-10 leftright-20"><?php echo Helper::t('FAQ_key'); ?></h2>
<div id="comment_section">
    <ol class="faq first_level parent">
        <?php $this->widget('ShowQA', array()) ?>
    </ol>
    <div class="cleaner h20"></div>
</div>
<?php if(Yii::app()->user->hasFlash('commentSubmitted')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('commentSubmitted'); ?>
    </div>
<?php endif; ?>

<div id="comment_form" class="sendFAQ topbottom-20">
    <?php $this->renderPartial('Admin.views.qa._form', array('model' => $model)); ?>
</div>




<?php
$scriptShowFormComment = '
$(function() {
    $(".replyComment").click(function() {
        var commentId = $(this).attr("id").replace("comment_","");
        $("#qa-form").append("<input type=\"hidden\" name=\"current\" value="+commentId+" />");
        $("#comment_form").appendTo($(this).parent());

        return false;
    });
})
';
Helper::cs()->registerScript('scriptShowFormComment', $scriptShowFormComment, CClientScript::POS_END);