<?php

Yii::import('zii.widgets.CPortlet');
Yii::import('Admin.models.Category');

class Notifications extends CPortlet {
    public $typeAlias = 'category';
    public $alias = '';

    public function renderContent() {
        switch ($this->typeAlias) {
            case 'news':
                $titleH2 = 'Thông Tin Khuyến Mãi - Tin Thông Báo - Tin Tức';
                $criteria = new CDbCriteria();
                $criteria->compare('status', APPROVED);
                $news = Cache::model()->usingCache('News', $criteria, '', false, Cache_Time, '', 1, 'NEWS' . $this->alias);

                break;

            default:
                $news = array();
                $titleH2 = 'Giỏ hàng';
        }

        $this->render('notifications', array(
            'titleH2' => $titleH2,
            'news' => $news
        ));
    }
}