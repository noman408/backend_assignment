<?php

namespace app\models;

use Yii;
use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $password;
    public $email;

    public function rules()
    {
        return [
            [['username', 'password', 'email'], 'required'],
            ['email', 'email'],
            [['username', 'email'], 'unique', 'targetClass' => 'app\models\User'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->setPassword($this->password);
            $user->email = $this->email;
            $user->generateEmailVerificationToken();
            $user->status = User::STATUS_INACTIVE;
            
            if ($user->save(false)) {
                return true; 
            }
        }
        return false; 
    }
}



