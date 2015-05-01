<?php

class DefaultController extends BackendController {
    public function actionIndex() {
        $this->render('index');
    }

    public function actionDeleteImage()
    {
        if (Yii::app()->request->isPostRequest):
            $imageName = Yii::app()->request->getPost('imageName');
            $model     = Yii::app()->request->getPost('model');
            $image = Helper::post('colImage') ? Helper::post('colImage') : 'image';

            if ($imageName):
                $params = array(
                    'imageName'   => $imageName,
                    'id'          => Yii::app()->request->getPost('imageID'),
                    'model'       => $model,
                    'colFileName' => $image,
                    'folder'      => $image != 'avatar' ? Helper::basePath() . '/../uploads/' . strtolower($model) : Helper::basePath() . '/../uploads/avatar'
                );
                Helper::deleteImage($params);
                echo CJSON::encode("Image was deleted");
                Yii::app()->end();
            endif;
        endif;
    }

    public function actionDeleteCache()
    {
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
        $this->cleanDir(Helper::basePath() . '/runtime/cache');
        $this->cleanDir(Helper::basePath() . '/../assets');
        $messageSuccess = 'DELETE_ASSETS_CACHE';
        Helper::setFlash($messageSuccess, Helper::t('DELETE_ASSETS_CACHE'));

        $this->render('index', array('messageSuccess' => $messageSuccess));
    }

    private function cleanDir($dir)
    {
        if (!is_dir($dir)) {
            mkdir($dir);
        }
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