<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $fullname
 * @property string $phone
 * @property string $address
 * @property string $country
 * @property string $description
 * @property string $avatar
 * @property string $website
 * @property string $created_date
 * @property string $last_login
 * @property string $validation_code
 * @property integer $validation_type
 * @property integer $validation_expired
 * @property string $status
 * @property string $type
 */
class User extends CActiveRecord
{
    private $_identity;
    public $rememberMe, $passwordNew, $confirmPassword, $verifyCode;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(
                'username, password', 'required', 'on' => 'login, update'
            ), array(
                'password', 'authenticate', 'on' => 'login'
            ), // change Password
            array(
                'username, email', 'required', 'on' => 'change_password'
            ), array(
                'passwordNew', 'required', 'on' => 'change_password, changePassword_frontend'
            ), array(
                'confirmPassword', 'compare', 'compareAttribute' => 'password', 'on' => 'change_password, register'
            ), array(
                'password, passwordNew, confirmPassword', 'required', 'on' => 'changePassword'
            ), array(
                'passwordNew, confirmPassword', 'required', 'on' => 'changePassword_frontend'
            ), array(
                'confirmPassword', 'compare', 'compareAttribute' => 'passwordNew', 'on' => 'changePassword, changePassword_frontend'
            ), array(
                'password', 'isUserPassword', 'on' => 'changePassword'
            ), array(
                'password, passwordNew', 'length', 'min' => 5
            ), array(
                'rememberMe', 'boolean'
            ), array(
                'verifyCode', 'required', 'on' => 'forgot_confirm'
            ), array(
                'verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements(), 'on' => 'forgot_confirm'
            ), array(
                'username', 'isUsernameExisted', 'on' => 'login'
            ), array(
                'username', 'checkForRegister', 'on' => 'register'
            ), array(
                'email', 'email'
            ), array(
                'email', 'checkExistEmail', 'on' => 'register, profile'
            ), array(
                'email', 'checkEmailForgot', 'on' => 'forgot'
            ), array(
                'email', 'required', 'on' => 'forgot'
            ), array(
                'website', 'url'
            ), array(
                'phone', 'numerical', 'integerOnly' => true
            ), array(
                'phone', 'length', 'min' => 10, 'max' => 11
            ), array(
                'username, password, email, fullname, phone, address', 'required', 'on' => 'register'
            ), array(
                'email, fullname, phone, address', 'required', 'on' => 'asGuest'
            ), array(
                'username, fullname, phone, address, description', 'required', 'on' => 'profile'
            ), array(
                'validation_type, validation_expired', 'numerical', 'integerOnly' => true
            ), array(
                'username, email, validation_code, country', 'length', 'max' => 64
            ), array(
                'password, confirmPassword, passwordNew', 'length', 'max' => 32
            ), array(
                'fullname, address, avatar', 'length', 'max' => 255
            ), array(
                'status, type', 'length', 'max' => 1
            ), array(
                'id, created_date, last_login, birthday, description', 'safe'
            ), // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'id, username, password, email, fullname, birthday, phone, address, country, description, avatar, website, created_date, last_login, validation_code, validation_type, validation_expired, status, type, confirmPassword, passwordNew, description',
                'safe', 'on' => 'search'
            ),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id'              => 'ID',
            'username' => Helper::t('username'),
            'password' => Helper::t('password'),
            'rememberMe' => Helper::t('rememberMe'),
            'email'           => 'Email',
            'fullname' => Helper::t('fullname'),
            'birthday' => Helper::t('birthday'),
            'phone' => Helper::t('phone'),
            'address'         => Helper::t('address'),
            'country' => Helper::t('country'),
            'description' => Helper::t('description'),
			'avatar' => Helper::t('avatar'),
            'website' => Helper::t('website'),
            'created_date' => Helper::t('created_date'),
            'last_login' => 'Last Login',
            'validation_code' => 'Validation Code',
            'validation_type' => 'Validation Type',
            'validation_expired' => 'Validation Expired',
            'status' => Helper::t('status'),
            'type'            => 'Type',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('fullname', $this->fullname, true);
        $criteria->compare('birthday', $this->birthday, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('country', $this->country, true);
        $criteria->compare('description', $this->description);
        $criteria->compare('avatar', $this->avatar, true);
        $criteria->compare('website', $this->website, true);
        $criteria->compare('created_date', $this->created_date, true);
        $criteria->compare('last_login', $this->last_login, true);
        $criteria->compare('validation_code', $this->validation_code, true);
        $criteria->compare('validation_type', $this->validation_type);
        $criteria->compare('validation_expired', $this->validation_expired);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('type', $this->type, true);

        if (!Helper::user()->checkAccess('Super')) {
            if (Helper::user()->checkAccess('Administrators')) {
                $criteria->compare('id', ' <> 1');
            } else {
                $criteria->compare('id', Helper::user()->id);
            }
        }
        $criteria->order = 'id DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function assignValue($model, $params = array(), $validateCode = '', $type = 3) {
        $model->attributes = $params;

        $model->type = $type;
        $model->status = PENDING;
        $model->validation_code = $validateCode;
        $model->validation_expired = time() + 24 * 60 * 60;

        if (isset($params['avatar'])) {
            $uploadImage = Helper::uploadImage($model, 'avatar', 'avatar');
            $model->avatar = $uploadImage;
        }

        return $model;
    }

    public function updateAttrByAttr($attributeToGetModel, $attr = array()) {
        $model = $this->findModelByAttr($attributeToGetModel);
        if (!$model) {
            Yii::log(CVarDumper::dumpAsString($model->getErrors()), CLogger::LEVEL_ERROR);
            throw new CHttpException(400, Helper::t('INVALID_CODE'));
        } else {
            $this->updateByPk($model->id, $attr);

            return $model;
        }
    }

    public function findModelByAttr($attr = array()) {
        return $this->findByAttributes($attr);
    }

    /**
     * @param $attribute
     * @param $params
     */
    public function isUsernameExisted($attribute, $params){
        if ($this->count('username = :username', array(':username' => $this->username)) == 0) {
            $this->addError($attribute, Helper::t('ERROR_USER_NOT_ACTIVE_OR_NOT_REGISTERED'));
        } else {
            if ($this->count('username = :username AND status=:status', array(':username' => $this->username, 'status' => APPROVED)) != 1)
                $this->addError($attribute, 'This username is not active.');
            else
                return;
        }
    }

    public function checkForRegister() {
        if ($this->count('username = :username', array(':username' => $this->username)) == 1) {
            $this->addError('username', 'This username has been registered.');
        } else {
            return;
        }
    }

    public function checkExistEmail($attribute) {
        if ($this->id <= 0 && $this->count('email = :email', array(':email' => $this->email)) == 0) {
            // new profile, email must not be taken
            return;
        } elseif ($this->count('email = :email', array(':email' => $this->email)) == 1) {
            // old profile use and existing email, that should belong to the same user
            if ($this->count('email = :email AND id = :id', array(':email' => $this->email, ':id' => $this->id)) == 1) {
                return;
            }
            $this->addError('email', 'This email ' . $this->email . ' is registered. Please change another.');
        }
        return;
    }

    public function checkEmailForgot() {
        if ($this->count('email = :email', array(':email' => $this->email)) == 0) {
            // new profile, email must not be taken
            $this->addError('email', 'This email ' . $this->email . ' is not exist. Please try again.');
        } else
            return;
    }


    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute,$params)
    {
        if(!$this->hasErrors())
        {
            $this->_identity=new UserIdentity($this->username,$this->password);
            if($this->_identity->authenticate())
                $this->addError('password','Incorrect username or password.');
        }
    }

    public function isUserPassword() {
        if ($this->count('username = :username and password = :password', array(':password' => md5($this->password), ':username' => Helper::user()->name)) != 1) {
            return $this->addError('password', 'This password is not correct. Please try again.');
        } else
            return;
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {
        if($this->_identity===null)
        {
            $this->_identity=new UserIdentity($this->username,$this->password);
            $this->_identity->authenticate();
        }
        if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
        {
            $duration=$this->rememberMe ? 30 * 24 * 3600 : 0; // 30 days
            Yii::app()->user->login($this->_identity,$duration);

            return true;
        }
        else
            return false;
    }

    protected function beforeSave() {
        $dataPostUser = Helper::post('User');

        $this->type = $this->getScenario() == 'change_password' || $this->getScenario() == 'changePassword' ? $this->type : (Helper::get('type') ? Helper::get('type') : $this->type);

        if (isset($dataPostUser['birthday'])) {
            $this->birthday = date('Y-m-d', Helper::changeDateToFormat($dataPostUser['birthday'], 'm-d-Y'));
        }

        if ($this->isNewRecord) {
            $this->status = PENDING;
            $this->created_date = date('Y-m-d');
            $this->password = md5($dataPostUser['password']);
        } elseif ($this->getScenario() == 'change_password' || $this->getScenario() == 'changePassword') {
                $this->password = md5($dataPostUser['passwordNew']);
        } else {
            if (isset($dataPostUser['passwordNew']) && !empty($dataPostUser['passwordNew'])) {
                $this->password = md5($dataPostUser['passwordNew']);
            }
        }

        return parent::beforeSave();
    }

    protected function beforeValidate() {
        if (Helper::user()->id) {
            $infoUser = $this->findByPk(Helper::user()->id);
            if ($this->email == $infoUser->email) {
                unset($this->email);
            }
        }

        return parent::beforeValidate();
    }

    protected function afterFind() {
        $this->birthday = date('m-d-Y', Helper::changeDateToFormat($this->birthday));

        return parent::afterFind();
    }

    public static function criteriaModel($lang, $alias, $tag, $date, $limit, $kw, $username) {
        $criteriaUser = new CDbCriteria();

        if ($username) {
            $criteriaUser->compare('username', $username);
        }

        return $criteriaUser;
    }
}