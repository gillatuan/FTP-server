<?php

Yii::import('zii.widgets.CPortlet');
Yii::import('Admin.models.Category');

class NavCategory extends CPortlet {
    public $parent = 0;

    public function renderContent() {
        $criteria = new CDbCriteria();
        $criteria->compare('parent_id', $this->parent);
        $criteria->compare('status', APPROVED);
        $criteria->order = 'id ASC';
        $modelCate = Cache::usingCache('Category', $criteria, '', false);

        $this->renderNestedCategory($modelCate);
    }

    protected function renderNestedCategory($models) {
        if (!empty($models)) {
            foreach ($models as $model) {
                if ($model->status == APPROVED) {
                    echo '<li><a href="' . Helper::url('/Shop/product/listProductsByCategory', array('cateAlias' => $model->alias)) . '" title="' . $model->name . '"><span>' . $model->name .'</span></a>';
                    $children = $model->children;
                    if (is_array($children) && count($children)) {
                        echo '<ul class="child">';
                        $this->renderNestedCategory($children);
                        echo '</ul>';
                    }
                    echo '</li>';
                }
            }
        }
    }
}