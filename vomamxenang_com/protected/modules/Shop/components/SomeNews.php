<?php

Yii::import('zii.widgets.CPortlet');
Yii::import('Admin.models.News');

class SomeNews extends CPortlet {
    public $isOnIndexPage = 1;

    public function renderContent() {
        $criteria = new CDbCriteria();
        $criteria->compare('status', APPROVED);
        $criteria->order = 'id DESC';

        $modelNews = Cache::usingCache('News', $criteria, '', false);
        $dataNews = array();
        if (count($modelNews)) {
            foreach ($modelNews as $news) {
                if (!empty($this->isOnIndexPage) && in_array(intval($this->isOnIndexPage), $news->page)) {
                    $dataNews[] = $news;
                }
            }
        }

        $this->render('news', array(
            'news' => $dataNews
        ));
    }
}