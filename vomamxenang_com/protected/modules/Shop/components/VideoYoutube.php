<?php

Yii::import('zii.widgets.CPortlet');
Yii::import('Admin.models.Category');

class VideoYoutube extends CPortlet {
    public $cateAlias = '';
    public $isOnIndex = '';

    public function renderContent() {
        $video = $this->genCate($this->cateAlias);

        $this->render('renderVideo', array(
            'video' => $video,
            'isOnIndex' => $this->isOnIndex,
            'cateAlias' => $this->cateAlias
        ));
    }

    protected function genCate($cateAlias) {
        $arrData = array();
        if (!empty($cateAlias)) {
            $criteriaCate = new CDbCriteria();
            $criteriaCate->compare('alias', $cateAlias);
            $criteriaCate->compare('status', APPROVED);

            $arrayProducts = array();
            $modelCate = Cache::usingCache('Category', $criteriaCate, $cateAlias, false, Cache_Time, 1, 1, $cateAlias);
            if (!$modelCate->children) {
                $arrData = $this->processVideo($modelCate);
            }
            if (count($modelCate->children)) {
                foreach ($modelCate->children as $child) {
                    $data = $this->processProduct($child);
                    if (count($data)) {
                        $arrayProducts = array_merge($data, $arrayProducts);
                    }
                }
                $arrData = $arrayProducts;
            }
        } else {
            $arrData = $this->processVideo();
        }

        return $arrData;
    }

    public function processVideo($modelCate = array()) {
        $criteriaProducts = new CDbCriteria();
        $cateAlias = '';
        if (count($modelCate)) {
            $criteriaProducts->compare('cate_id', $modelCate->id);
        }
        $criteriaProducts->compare('status', APPROVED);

        $criteriaProducts->order = 'id DESC';
        if ($this->isOnIndex) {
            $criteriaProducts->compare('page', INDEX_PAGE);
        }
        $cacheVideo = Cache::usingCache('Video', $criteriaProducts, '', false, Cache_Time, '', PAGE_SIZE,     $cateAlias . $this->isOnIndex);

        return $cacheVideo;
    }
}