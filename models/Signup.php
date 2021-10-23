<?php


namespace app\models;


use yii\base\Model;

class Signup extends Model
{
    public $first_name;
    public $middle_name;
    public $last_name;
    public $phone;
    public $password;

    public function rules()
    {
        return [
            [['phone', 'password', 'first_name', 'middle_name', 'last_name'], 'required'],
            ['phone', 'unique', 'targetClass' => 'app\models\User'],
            [['first_name', 'middle_name', 'last_name'], 'string', 'min' => 3, 'max' => 30],
            ['password', 'string', 'min' => 5, 'max' => 30]
        ];
    }

    public function signup()
    {
        $user = new User();
        $user->first_name= $this->first_name;
        $user->middle_name= $this->middle_name;
        $user->last_name= $this->last_name;
        $user->phone = $this->phone;
        $user->setPassword($this->password);

        return $user->save();
    }
}