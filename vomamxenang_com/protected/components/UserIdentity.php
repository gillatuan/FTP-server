<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    public $_id;
    public $_email;
    public $_username;
    public $_roles;
    const ERROR_NONE_ACTIVE = 3;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
        $user = User::model()->find('username=:username', array(':username' => strtolower($this->username)));

		if(!isset($user['username'])) {
			$this->errorCode=self::ERROR_USERNAME_INVALID;
        } else if($user['password']!==md5($this->password)) {
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
        } elseif ($user['status'] != APPROVED) {
            $this->errorCode = self::ERROR_NONE_ACTIVE;
        } else {
            Yii::import('SuperAdmin.models.Lookup');
            $this->_email = $user->email;
            $this->_id = $user->id;
            $this->_username = $user->username;
            $this->_roles = Lookup::item('Level_User', $user->type);

            $this->setState('roles', Lookup::item('Level_User', $user->type));
            $infoUser = array(
                'avatar' => $user->avatar,
                'address' => $user->address,
                'phone' => $user->phone,
                'fullname' => $user->fullname,
                'email' => $user->email,
                'status' => $user->status
            );
            $this->setState('infoUser', $infoUser);

            $user->updateByPk($user->id, array(
                'last_login' => date('Y-m-d'),
                'is_online' => ONLINE
            ));

            $this->errorCode=self::ERROR_NONE;
        }

		return $this->errorCode;
	}

    public function getRoles()
    {
        return $this->_roles();
    }

    public function getId() {
        return $this->_id;
    }
}