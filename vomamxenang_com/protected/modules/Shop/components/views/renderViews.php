<?php
if (!$isListPage) {
    if (in_array(intval($isOnIndex), $data->page)) { ?>
        <?php $last = ($index + 1) % 2 == 0 ? 'last' : ''; ?>
        <?php $notMargin = $index == 0 || $index == 1 ? 'not-margin-top' : ''; ?>
        <div class="comment <?php echo $notMargin; ?> sixcol <?php echo $last; ?>">
            <h3><?php echo $data->subject; ?></h3>
            <div class="rated">
                <div class="full-name sixcol"><?php echo $data->full_name; ?></div>
                <div class="rated-info threecol">
                    <span class="star-rating rated">
                        <?php $this->widget('CStarRating', array(
                                'value'    => $data->rating,
                                'name'     => 'user-rating-' . $data->id,
                                'readOnly' => true
                            )); ?>
                    </span>
                </div>
                <span class="created-date threecol last"><?php echo Helper::getTimeAgo($data->create_date); ?></span>
                <div class="clearfix"></div>
                <div class="content"><?php echo nl2br($data->description); ?></div>
            </div>
        </div>
<?php }

} else { ?>
<div class="review-info clearfix">
    <img src="<?php echo Helper::baseUrl() ?>/uploads/avatar.jpg" alt="<?php echo $data->full_name; ?>" />
    <div class="review-content">
        <div class="user-review">
            <span class="fullname fourcol"><?php echo $data->full_name; ?></span>
            <span class="star-rating rated fourcol"><?php $this->widget('CStarRating', array(
                    'value'    => $data->rating,
                    'name'     => 'user-rating-' . $data->id,
                    'readOnly' => true,
                )); ?></span>
            <span class="created-date fourcol last"><?php echo Helper::getTimeAgo($data->create_date); ?></span>
        </div>
        <h4><?php echo $data->subject; ?></h4>
        <div class="review-desc"><?php echo nl2br($data->description); ?></div>
    </div>
</div>
<?php } ?>