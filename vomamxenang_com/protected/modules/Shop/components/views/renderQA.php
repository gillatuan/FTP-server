<?php $imageavatar = Helper::baseUrl() . '/uploads/avatar.jpg'; ?>
<li>
    <div class="comment_box commentbox1" id="comm-<?php echo $data->id; ?>">
        <div class="gravatar">
            <img src="<?php echo $imageavatar; ?>" alt="<?php echo $imageavatar; ?>" />
        </div>
        <div class="comment_text">
            <div class="comment_author"><?php echo $data->full_name; ?>
                <span class="date"><?php echo Helper::getTimeAgo($data->create_date); ?></span>
            </div>
            <p style="margin-bottom: 10px; text-align: left;"><?php echo $data->subject; ?></p>

            <p style="margin-bottom: 10px; text-align: left;"><?php echo nl2br($data->content); ?></p>

            <?php if (Helper::user()->checkAccess('Administrators') || Helper::user()->checkAccess('Super')) { ?>

                <p class="reply">
                    <a href="javascript:void(0);" id="comment_<?php echo $data->id; ?>" class="replyComment" title="Reply">Reply</a>
                </p>

            <?php } ?>
        </div>
        <div class="cleaner"></div>
    </div>
    <ol class="faq child">
        <?php $this->show_comments($data->id); ?>
    </ol>
</li>