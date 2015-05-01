<?php

class FrontendController extends Controller {
    public $layout = DEFAULT_LAYOUT;

    protected $_canonicalUrl;

    public function __construct($id, $module = null){
        parent::__construct($id, $module);

        Yii::app()->theme = THEME;

        Yii::app()->counter->refresh();
    }

    /**
     * Default canonical url generator, will remove all get params beside 'id' and generates an absolute url.
     * If the canonical url was already set in a child controller, it will be taken instead.
     */
    public function getCanonicalUrl() {
        if ($this->_canonicalUrl === null) {
            $this->_canonicalUrl = Yii::app()->createAbsoluteUrl(Yii::app()->request->requestUri);
        }
        return $this->_canonicalUrl;
    }
}
