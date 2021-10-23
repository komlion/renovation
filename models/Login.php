<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Login extends Model
{
    public $phone;
    public $password;

    public function rules()
    {
        return [
            [['phone', 'password'], 'required'],
            ['password', 'validatePassword']
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            $user = $this->getUser();

            if (!$user or !($user->validatePassword($this->password)))
            {
                $this->addError($attribute, 'Пароль или пользователь введены неверно');
            }
        }
    }

    public function getUser()
    {
        return User::findOne(['phone'=>$this->phone]);
    }

}