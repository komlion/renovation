<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


class User_project extends activeRecord
{
    static function tableName()
    {
        return 'users_projects';
    }
}