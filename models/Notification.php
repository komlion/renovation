<?php

namespace app\models;

use yii\db\ActiveRecord;

class Notification extends ActiveRecord
{
    static function tableName(): string
    {
        return 'notifications';
    }

    static function addNotification($userId, $title, $text): Notification
    {
        $notification = new Notification;
        $notification->user_id = $userId;
        $notification->title = $title;
        $notification->text = $text;
        $notification->save();

        return $notification;
    }

    static function getNotifications($userId): array
    {
        return Notification::find()->where(['user_id' => $userId])->orderBy(['date' => SORT_DESC])->all();
    }

    static function getNewNotifications($userId): array
    {
        return Notification::find()->where(['user_id' => $userId, 'is_new' => 1])->all();
    }

    static function getCountNewNotifications($userId)
    {
        return Notification::find()->where(['user_id' => $userId, 'is_new' => 1])->count();
    }

    static function readNotifications($userId)
    {
        $notifications = Notification::getNewNotifications($userId);
        foreach ($notifications as $notification)
        {
            $notification->is_new = 0;
            $notification->save();
        }
    }
}