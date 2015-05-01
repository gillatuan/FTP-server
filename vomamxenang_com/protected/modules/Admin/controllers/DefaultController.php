<?php

class DefaultController extends BackendController {
    public function actionIndex() {
        if (!Helper::user()->checkAccess('Super')) {
            $this->render('index');
        } else {
            $this->render('welcome');
        }
    }

    public function actionDeleteSelected() {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            if ($id = Helper::get('id') !== null) {
                $modelName = Helper::post('modelName');
                $ids = is_numeric($id) ? array($id) : explode(',', $id);

                // delete one or multiple objects given the list of object IDs
                foreach ($ids as $id) {
                    $result =  $modelName::model()->findByPk($id)->delete();
                }

                if (!Yii::app()->request->isAjaxRequest) {
                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if (!Helper::post('ajax')) {
                        $this->redirect(Helper::post('returnUrl') ? Helper::post('returnUrl') : array('admin'));
                    }
                }
            } else {
                throw new CHttpException(400, Helper::t('ERROR_DELETE_ID'));
            }
        } else {
            throw new CHttpException(400, Helper::t('ERROR_DO_NOT_REPEAT_ACTION'));
        }
    }

    public function actionAjaxUpdate() {
        if (Helper::post('id') && Helper::post('model')) {
            $loadModel = $this->loadModel(Helper::post('id'), Helper::post('model'));
            $params = array(
                'id' => Helper::post('id'),
                'value' => Helper::post('value'),
                'attr' => Helper::post('attr'),
                'pageCode' => Helper::post('pageCode')
            );
            $model = Helper::updateFieldValue($loadModel, $params);
            if (is_array($model->page)) {
                $model->page = implode(',', $model->page);
            }
            $model->save();
        } else {
            throw new CHttpException(404, 'Page not found');
        }
    }

    public function loadModel($id, $model) {
        $model = $model::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }

    public function actionDeleteImage() {
        if (Helper::post()) {
            $imageName = Helper::post('imageName');
            $model = Helper::post('model');
            $image = Helper::post('colImage') ? Helper::post('colImage') : 'image';
            if ($imageName) {
                $params = array(
                    'imageName'   => $imageName,
                    'id'          => Helper::post('imageID'),
                    'model'       => $model,
                    'colFileName' => $image,
                    'folder'      => $image != 'avatar' ? Helper::basePath() . '/../uploads/' : Helper::basePath() . '/../uploads/avatar'
                );
                Helper::deleteImage($params);
                echo CJSON::encode("Image was deleted");
                Yii::app()->end();
            }
        }
    }

    public function actionDeleteCache() {
        $this->cleanDir(Helper::basePath() . '/runtime/cache');
        $messageSuccess = 'deleteCached';
        Yii::app()->user->setFlash($messageSuccess, 'Cache Files have been deleted successfully.');
        $this->render('index', array('messageSuccess' => $messageSuccess));
    }

    public function actionDeleteAssets() {
        $this->cleanDir(Helper::basePath() . '/../assets');
        $messageSuccess = 'deleteAssets';
        Yii::app()->user->setFlash($messageSuccess, 'Assets have been deleted successfully.');
        $this->render('index', array('messageSuccess' => $messageSuccess));
    }

    public function actionDeleteAll() {
        $this->cleanDir(Helper::basePath() . '/runtime');
        $this->cleanDir(Helper::basePath() . '/../assets');
        $messageSuccess = 'DELETE_ASSETS_CACHE';
        Yii::app()->user->setFlash($messageSuccess, 'Assets & Cache have been deleted successfully.');
        $this->render('index', array('messageSuccess' => $messageSuccess));
    }

    private function cleanDir($dir) {
        $di = new DirectoryIterator($dir);
        $dataFiles = array();
        foreach ($di as $d) {
            if (!$d->isDot()) {
                $dataFiles[] = $d->getPathname();
                $this->removeDirRecursive($d->getPathname());
            }
        }

        return $dataFiles;
    }

    private function removeDirRecursive($dir) {
        $files = glob($dir . '*', GLOB_MARK);
        if ($files) {
            foreach ($files as $file) {
                if (is_dir($file)) {
                    $this->removeDirRecursive($file);
                } else {
                    unlink($file);
                }
            }
        }
        if (is_dir($dir)) {
            rmdir($dir);
        }
    }
}
