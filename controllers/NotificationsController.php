<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\web\Controller;

class NotificationsController extends Controller
{
    public function actionIndex(): string
    {
        $currentUser = User::getUser(Yii::$app->user->id);
        $notifications = $currentUser->getNotifications();
        $currentUser->readNotifications();
        return $this->render('index', compact('currentUser', 'notifications'));
    }
}