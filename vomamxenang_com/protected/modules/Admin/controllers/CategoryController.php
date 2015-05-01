<?php



class CategoryController extends BackendController {
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
                'actions' => array(
                    'index',
                    'view'
                ),
                'users'   => array('*'),
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(
                    'create',
                    'update'
                ),
                'users'   => array('@'),
            ),
            array(
                'allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array(
                    'admin',
                    'delete',
                    'updateNested'
                ),
                'users'   => array('admin'),
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
        $model = $id ? $this->loadModel($id) : new Category;
        // Uncomment the following line if AJAX validation is needed
        if (Helper::post('Category')) {
            // validate
            Helper::performAjaxValidation($model, 'category-form');
            // assign value
            $model->attributes = Helper::post('Category');
            $size = array(
                'wOnIndex' => '250',
                'hOnIndex' => '159',
                'typeSize' => ''
            );
            $uploadImage       = Helper::uploadImage($model, 'image', 'Category', true, false, $size);
            $model->image      = $uploadImage;
            if ($model->save()) {
                Helper::setFlash('SUCCESS_MESSAGE', 'Successfully.');
                // rebuild Cache
                Cache::model()->getCacheDependency(array(
                    'name'        => 'cache-category-' . $model->alias,
                    'description' => 'cache for Category ' . $model->alias
                ));
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
        if (!Helper::get('ajax')) {
            $this->redirect(Helper::post('returnUrl') ? Helper::post('returnUrl') : array('admin'));
        }
    }

    /**
     * Lists all models.

     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Category');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.

     */
    public function actionAdmin() {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', 0);
        $criteria->order = 'id desc';
        $model           = Category::model()->findAll($criteria);

        if (Yii::app()->request->isPostRequest) {
            $this->sortPost();
        }
        if (Helper::get('status')) {
            Helper::updateStatus($_GET);
        }

        if (Helper::get('typeAction') == 'deleteCategory') {
            $cate = $this->loadModel(Helper::get('id'));
            if ($cate->countChildren) {
                echo "This category has children. Please delete its child first";
                exit();
            } else {
                $cate->delete();
                echo "Success";
                exit();
            }
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionUpdateNested() {
        if (Helper::post() && Helper::post('type')) {
            $decodeNested = CJSON::decode(Helper::post('dataNested'));
            $this->renderNested($decodeNested);
        }
    }

    protected function renderNested($nested, $parentId=0) {
        if (!empty($nested)) {
            foreach ($nested as $nest) {
                Category::model()->updateByPk($nest['id'], array(
                    'parent_id' => $parentId
                ));
                if (!empty($nest['children']) && !empty($nest['id'])) {
                    $this->renderNested($nest['children'], $nest['id']);
                }
            }
        }
    }

    public function renderNestedCategory($viewFile, $models) {
        foreach ($models as $index => $model) {
            echo '<li class="dd-item" data-id="' . $model->id . '">';
            Yii::app()->controller->renderFile($viewFile, array(
                'class' => 'odd',
                'model' => $model
            ));
            $children = $model->children;
            if (is_array($children) && count($children)) {
                echo '<ol class="dd-list">';
                $this->renderNestedCategory($viewFile, $children);
                echo '</ol>';
            }
            echo '</li>';
        }
    }

    protected function sortPost() {
        $i = 1;
        if (Helper::post('category')) {
            foreach (Helper::post('category') as $id) {
                Category::model()->updateByPk($id, array('ordering' => $i));
                $i++;
            }
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param integer $id the ID of the model to be loaded
     *
     * @return Category the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Category::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }
}

