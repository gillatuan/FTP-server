<?php

class SettingParamsController extends BackendController {
    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete',
            // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array(
                'allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array(
                    'index',
                    'view',
                    'create',
                    'update',
                    'admin',
                    'delete',
                    'configParams'
                ),
                'roles'   => array('SuperAdmin'),
            ),
            array(
                'deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionConfigParams($paramsSetting = '') {
        $criteria = new CDbCriteria();
        if ($paramsSetting) {
            $criteria->addCondition("setting_group = '{$paramsSetting}'");
        }
        $criteria->compare('visible', APPROVED);
        $criteria->order = 'name';
        $params = SettingParams::model()->findAll($criteria);
        $consts = '';
        foreach ($params as $param) {
            if (!is_numeric($param->values)) {
                $param->values = "'" . addslashes($param->values) . "'";
            }
            $consts .= "//{$param->description}\n\tdefine(" . str_pad("'" . $param->name . "'", 10, ' ') . ", {$param->values});\n";
        }
        $php = "<?php

            $consts

        ";
        $filename = 'params.php';
        $path = Yii::app()->getBasePath() . "/configSetting/";
        if (!is_dir($path)) {
            mkdir($path);
            mkdir($path . $filename);
        }
        $f = fopen($path . $filename, 'w+');
        if ($f == false) {
            throw new Exception('Cannot create file under utilities folder');
        }
        fwrite($f, $php);
        fclose($f);
        Helper::setFlash('configParams', 'Creating config params successfully.');
        $this->redirect(array('admin'));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->actionUpdate();
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id = '') {
        if ($id) {
            $model = $this->loadModel($id);
            $this->breadcrumbs = array(
                'Setting Params' => array('admin'),
                $model->name     => array(
                    'view',
                    'id' => $model->id
                ),
                'Update',
            );
        } else {
            $model = new SettingParams();
            $this->breadcrumbs = array(
                'Setting Params' => array('admin'),
                'Create',
            );
        }
        // Uncomment the following line if AJAX validation is needed
        Helper::performAjaxValidation($model, 'setting-params-form');
        if (isset($_POST['SettingParams'])) {
            $model->attributes = $_POST['SettingParams'];
            if ($model->save()) {
                $this->redirect(array('update'));
            }
        }
        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('SettingParams');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new SettingParams('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['SettingParams'])) {
            $model->attributes = $_GET['SettingParams'];
        }
        if (Helper::get('model') == 'SettingParams') {
            Helper::updateStatus($_GET);
        }
        // Seo
        $this->breadcrumbs = array(
            'Setting Params' => array('admin'),
            'Manage',
        );
        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return SettingParams the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = SettingParams::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }
}
