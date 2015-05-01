<?php

class AdminModule extends CWebModule {
    public function init() {
        // not rewrite for Admin
        Yii::app()->urlManager->urlFormat = 'get';
        Yii::app()->urlManager->rules = array();

        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'Admin.models.*',
            'Admin.components.*',
        ));
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            if (!Helper::user()->checkAccess('Super') && !Helper::user()->checkAccess('Administrators')) {
                throw new CHttpException(400, Yii::t('NoRole', 'You don\'t have any privileges for this action.'));
            }

            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        } else {
            return false;
        }
    }
}
