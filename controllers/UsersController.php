<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Signup;
use app\models\Login;
use app\models\User;


class UsersController extends Controller
{
    public function actionIndex($userId = NULL)
    {
        if ($userId === NULL)
        {
            //Вывод всех пользователей на сайте
        }

        $user = User::getUser($userId);
        $projects = $user->getUserProjects();

        return $this->render('index', compact(['projects', 'user']));
    }

    public function actionSignup()
    {
        $model = new Signup();

        if (Yii::$app->request->isPost)
        {
            $model->attributes = Yii::$app->request->post('Signup');

            if ($model->validate() and $model->signup())
            {
                return $this->goHome();
            }
        }

        return $this->render('signup', compact('model'));
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $model = new Login();

        if(Yii::$app->request->isPost)
        {
            $model->attributes = Yii::$app->request->post('Login');

            if($model->validate())
            {
                Yii::$app->user->login($model->getUser());
                return $this->goHome();
            }
        }

        return $this->render('login', compact('model'));
    }

    public function actionLogout()
    {
        if (!Yii::$app->user->isGuest)
        {
            Yii::$app->user->logout();
            return $this->redirect(['login']);
        }
    }

    // public function actionChangeUserData($userId, $firstName = false, $middleName = false, $lastName = false, $phone = false)
    // {
    //     $user = User::getUser($userId);
    //     if ($firstName) $user->changeName(firstName: $firstName);
    //     if ($middleName) $user->changeName(middleName: $middleName;
    //     if ($lastName) $user->changeName(lastName: $lastName);
    // }
}
