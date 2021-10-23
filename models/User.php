<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    static function tableName()
    {
        return 'users';
    }

    static public function getUser($userId)
    {
        return User::FindOne($userId);
    }

    public function fullName()
    {
        return $this->first_name . ' ' . ' ' . $this->last_name;
    }


    public function changeRole($role)
    {
        $this->role = $role;

        return $this->update();
    }

    public function changePhone($phone)
    {
        $this->phone = $phone;
        return $this->update();
    }

    public function changeName($firstName = false, $middleName = false, $lastName = false)
    {
        if ($firstName) $this->firstName = $firstName;
        if ($middleName) $this->middleName = $middleName;
        if ($lastName) $this->lastName = $lastName;
        return $this->update();
    }

    public function isForeman()
    {
        if ($this->role === 'Прораб')
        {
            return True;
        }
        return False;
    }

    static public function isYou($userId)
    {
        if ($userId === Yii::$app->user->id)
        {
            return True;
        }

        return False;
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserProjects(): array
    {
        return Project::find()->where(['client' => $this->id])->all();
    }

    public function getAuthKey()
    {

    }

    public function validateAuthKey($authKey)
    {

    }

    public function getNotifications(): array
    {
        return Notification::getNotifications($this->id);
    }

    public function readNotifications()
    {
        Notification::readNotifications($this->id);
    }
}