<?php
/**
 * Created by PhpStorm.
 * User: tuan.bui
 * Date: 11/26/2014
 * Time: 1:04 AM
 */
class HttpRequest extends CHttpRequest {
    private $_csrfToken;

    public function getCsrfToken()
    {
        if($this->_csrfToken===null)
        {
            $session = Yii::app()->session;
            $csrfToken=$session->itemAt($this->csrfTokenName);
            if($csrfToken===null)
            {
                $csrfToken = sha1(uniqid(mt_rand(),true));
                $session->add($this->csrfTokenName, $csrfToken);
            }
            $this->_csrfToken = $csrfToken;
        }

        return $this->_csrfToken;
    }

    public function validateCsrfToken($event)
    {
        if($this->getIsPostRequest())
        {
            // only validate POST requests
            $session=Yii::app()->session;
            if($session->contains($this->csrfTokenName) && isset($_POST[$this->csrfTokenName]))
            {
                $tokenFromSession=$session->itemAt($this->csrfTokenName);
                $tokenFromPost=$_POST[$this->csrfTokenName];
                $valid=$tokenFromSession===$tokenFromPost;
            }
            else
                $valid=false;
            if(!$valid)
                throw new CHttpException(400,Yii::t('yii','The CSRF token could not be verified.'));
        }
    }
}