<?php



class ProductsController extends BackendController {
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
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions'  => array('index', 'view'),
                'users' => array('*'),
            ), array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'  => array('create', 'update'),
                'users' => array('@'),
            ), array(
                'allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'  => array('admin', 'delete', 'ajaxUpdate'),
                'roles' => array('Administrators', 'Super'),
            ), array(
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
        $model = $id ? $this->loadModel($id) : new Products();
        $postProduct = Helper::post('Products');
        if ($postProduct) {
            // validate
            Helper::performAjaxValidation($model, 'products-form');
            // assign value
            $model->attributes = $postProduct;
            $size = array(
                'wOnIndex' => '224',
                'hOnIndex' => '253',
                'thumbW' => '75',
                'thumbH' => '85',
                'detailW' => '391',
                'detailH' => '300',
                'typeSize' => ''
            );
            $uploadImage = Helper::uploadImage($model, 'image', 'Products', true, true , $size);
            $model->info = $postProduct['info'];
            $model->image = $uploadImage;
            if ($model->save()) {
                Helper::setFlash('SUCCESS_MESSAGE', 'Successfully.');
                // rebuild Cache
                Cache::model()->getCacheDependency(array(
                    'name'        => 'cache-product-' . $model->alias,
                    'description' => 'cache for Product ' . $model->alias
                ));

                $this->redirect(array('update', 'id' => $id));
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
        if (!Helper::get('ajax')) {
            $this->redirect(Helper::post('returnUrl') ? Helper::post('returnUrl') : array('admin'));
        }
    }

    /**
     * Lists all models.

     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Products');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.

     */
    public function actionAdmin() {
        $model = new Products('search');
        $model->unsetAttributes(); // clear any default values
        if (Helper::get('Products')) {
            $model->attributes = Helper::get('Products');
        }
        if (Yii::app()->request->isPostRequest) {
            $this->sortPost();
        }
        if (Helper::get('status')) {
            Helper::updateStatus($_GET);
        }
        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Products the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Products::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }
}

