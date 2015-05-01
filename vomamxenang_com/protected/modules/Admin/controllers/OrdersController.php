<?php



class OrdersController extends BackendController {
    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
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
                'actions' => array('index', 'view'),
                'users'   => array('*'),
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users'   => array('@'),
            ),
            array(
                'allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'ajaxUpdate'),
                'roles'   => array('Administrators', 'Super'),
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
        $model = new Orders;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Orders'])) {
            $model->attributes = $_POST['Orders'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Orders'])) {
            $model->attributes = $_POST['Orders'];
            if ($model->save()) {
                $this->redirect(array('/Admin/default/deleteall'));
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
        $dataProvider = new CActiveDataProvider('Orders');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.

     */
    public function actionAdmin() {
        $model = new Orders('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Orders'])) {
            $model->attributes = $_GET['Orders'];
        }
        if (Yii::app()->request->isPostRequest) {
            $this->sortPost();
        }
        if (Helper::get('model') == 'Orders') {
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
     * @return Orders the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Orders::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Orders $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'orders-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function decodeParam($param, $type = '', $id = '') {
        $arrayData = Helper::objectToArray(json_decode($param));
        switch ($type) {
            case 'bill_to':
                echo isset($arrayData['username']) ? $arrayData['username'] . '<br />' : '';
                echo $arrayData['full_name'];
                echo "<br />";
                echo $arrayData['email'];
                echo "<br />";
                echo $arrayData['phone'];
                echo "<br />";
                echo $arrayData['address'];
                break;
            case 'ship_to':
                echo $arrayData['full_name'];
                echo "<br />";
                echo $arrayData['phone'];
                echo "<br />";
                echo $arrayData['address'];
                echo "<br />";
                break;
            case 'cart':
                echo "CPVC: " . Transport_Charge . " d";
                echo "<br />";
                $total = 0;
                foreach ($arrayData as $array) {
                    $total += $array['valueAfterDiscount'];
                }
                $formatTotal = Helper::formatNumber($total + Transport_Charge);
                echo "Tổng tiền thanh toán: " . CHtml::link($formatTotal, Helper::url('/Admin/orders/view', array('id' => $id)), array('title' => 'Xem giỏ hàng'));
                break;
            default:
                return $arrayData;
                break;
        }
    }
}

