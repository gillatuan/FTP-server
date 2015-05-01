<?php

Yii::import('zii.widgets.CPortlet');
Yii::import('Admin.models.Category');

class CateName extends CPortlet {
    public $cateAlias = '';

    public function renderContent() {
        $criteria = new CDbCriteria();
        $criteria->compare('alias', $this->cateAlias);
        $criteria->compare('status', APPROVED);
        $modelCate = Cache::usingCache('Category', $criteria, $this->cateAlias, false, 600, 1, 1, $this->cateAlias . 'viewCategory');

        if ($this->cateAlias) {
            echo $modelCate->name;
        }
    }
}