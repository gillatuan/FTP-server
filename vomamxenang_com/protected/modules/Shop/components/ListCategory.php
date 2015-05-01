<?php

Yii::import('zii.widgets.CPortlet');
Yii::import('Admin.models.Category');

class ListCategory extends CPortlet {
    public $cateAlias;

    public function renderContent() {
        $criteriaCate = new CDbCriteria();
        $criteriaCate->compare('alias', $this->cateAlias);
        $criteriaCate->compare('status', APPROVED);

        $modelCate = Cache::usingCache('Category', $criteriaCate, $this->cateAlias, false, Cache_Time, 1, 1, $this->cateAlias);
        $cateName = $modelCate->name;
        if (count($modelCate->children)) {
            $arrCate = $modelCate->children;
        } else {
            $arrCate = $modelCate;
        }

        $this->render('listCategory', array(
            'arrCate' => $arrCate,
            'cateName' => $cateName
        ));
    }
}