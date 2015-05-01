<?php



class LookupController extends BackendController {
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
                    'admin',
                    'delete',
                    'update'
                ),
                'roles'   => array('SuperAdmin'),
            ),
            array(
                'deny', // deny all users
                'users' => array('*'),
            ),
        );
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
                'Look up'    => array('admin'),
                $model->name => array(
                    'view',
                    'id' => $model->id
                ),
                'Update',
            );
        } else {
            $model = new Lookup();
            $this->breadcrumbs = array(
                'Look up' => array('admin'),
                'Create',
            );
        }
        // Uncomment the following line if AJAX validation is needed
        Helper::performAjaxValidation($model, 'lookup-form');
        if (isset($_POST['Lookup'])) {
            $model->attributes = $_POST['Lookup'];
            if ($model->save()) {
                $action = $model->isNewRecord ? 'Create ' : 'Update ';
                Helper::setFlash('SUCCESS_MESSAGE', 'Successfully.');
                $this->redirect(array(
                    'update',
                    'id' => $model->id
                ));
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
        $dataProvider = new CActiveDataProvider('Lookup');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.

     */
    public function actionAdmin() {
        $model = new Lookup('search');
        $model->unsetAttributes(); // clear any default values
        $getLookup = Helper::get('Lookup');
        if ($getLookup) {
            $model->attributes = $getLookup;
        } else {
            //            $getLookup['type'] = Lookup::firstType();
            $model->attributes = $getLookup;
        }
        $criteria = $model->search()->criteria;
        $criteria->order = 'position ASC';
        // seo
        $this->breadcrumbs = array(
            'Look up' => array('admin'),
            'Manage',
        );
        $this->render('admin', array(
            'model'    => $model,
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Lookup the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Lookup::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }
}

