<?php

class UserController extends BackendController {
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
                'actions' => array(), 'users' => array('*'),
            ), array(
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions'  => array(
                    'update', 'changePassword'
                ),
                'users' => array('@'),
            ), array(
                'allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'  => array(
                    'delete', 'view', 'create', 'admin'
                ),
                'roles' => array('Administrators'),
            ), array(
                'allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('profile'),
                'roles' => array('Super'),
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
        if ($id) {
            if (!Helper::user()->checkAccess('Super')) {
                if (!Helper::user()->checkAccess('Administrators')) {
                    if ($id != Helper::user()->id) {
                        $this->redirect(array(
                            '/Admin/user/update', 'id' => Helper::user()->id
                        ));
                    }
                } else {
                    if ($id == 1) {
                        $this->redirect(array(
                            '/Admin/user/update', 'id' => Helper::user()->id
                        ));
                    }
                }
            }
            $model = $this->loadModel($id);
            $model->setScenario('profile');
        } else {
            $model = new User();
            $model->setScenario('register');
        }

        $dataPost = Helper::post('User');
		if($dataPost)
		{
            // Uncomment the following line if AJAX validation is needed
            Helper::performAjaxValidation($model, 'user-form');
			$model->attributes=$dataPost;
			if($model->save()) {
	        	Helper::setFlash('successUpdateProfile', Helper::t('successUpdateProfile'));
	        	$this->redirect(array('/Admin/default/deleteall'));
            }
		}
		$this->render('update',array(
			'model'=>$model,
		));
	}

    public function actionProfile($id = 1, $tab = '', $action = '') {
        if ($id != Helper::user()->id) {
            throw new CHttpException(400, 'You don\'t have any privileg in this action');
        }
        $this->layout = '//layouts/main_tab';
        $profile = $this->loadModel($id);
        if ($tab == 'account') {
            if ($action == 'personal-info') {
                $profile->setScenario('profile');
                $id = 'user-form';
                $message = 'You\'ve changed your info successfully.';
            } elseif ($action == 'changePassword') {
                $profile->setScenario('changePassword');
                $id = 'user-changePassword-form';
                $message = 'You\'ve changed your password successfully.';
            } elseif ($action == 'changeAvatar') {
                $profile->setScenario('changeAvatar');
                $id = 'user-upload-form';
                $message = 'You\'ve changed your avatar successfully.';
            }
            if (Yii::app()->request->isPostRequest) {
                $dataPost = Helper::post('User');
                Helper::performAjaxValidation($profile, $id);

                if($dataPost)
                {
                    $profile->attributes = $dataPost;
                    if (!isset($dataPost['password']) || $dataPost['password'] == '') {
                        unset($profile->password);
                    }
                    if (isset($dataPost['avatar'])) {
                        $uploadImage = Helper::uploadImage($profile, 'avatar', 'avatar');
                        $profile->avatar = $uploadImage;
                    }
                    // save
                    if($profile->save()) {
                        Helper::setFlash($id, $message);

                        $this->redirect(array('profile', 'id' => Helper::user()->id, 'tab' => 'account', 'action' => $action));
                    }
                }
            }
            $profile->password = '';
        } elseif ($tab == 'projects') {
            $profile->setScenario('projects');
        }
        $this->breadcrumbs=array(
            'Setting Params'=> array('index'),
            $profile->username =>array('view','id'=>$profile->id),
            'Update',
        );
        $this->render('profile', array(
            'model' => $profile,
            'SUCCESS_MESSAGE' => $id
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
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
        $dataGet = Helper::get('User');
		if($dataGet)
			$model->attributes=$dataGet;

        if (Helper::get('status'))
            Helper::updateStatus($_GET);

        if (!Helper::user()->checkAccess('Super')) {
            $this->render('admin', array(
                'model' => $model,
            ));
        } else {
            $this->render('manageUser', array(
                'model' => $model,
            ));
        }
    }

    public function actionChangePassword($id) {
        if ($id != Helper::user()->id) {
            $this->redirect(array(
                '/Admin/user/changePassword', 'id' => Helper::user()->id
            ));
        }
        $model= $this->loadModel($id);
        $model->setScenario('changePassword');
        if (Yii::app()->request->isPostRequest) {
            $dataPost = Helper::post('User');
            Helper::performAjaxValidation($model, 'user-changePassword-form');
            if ($dataPost) {
                $model->attributes=$dataPost;
                if($model->save()) {
                    Helper::setFlash('successChangePassword','You\'ve changed your password successfully.');

                    $this->redirect(array('changePassword', 'id' => Helper::user()->id));
                }
            }
        }
        $model->password = '';
        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }
}
