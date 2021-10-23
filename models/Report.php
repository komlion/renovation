<?php


namespace app\models;


use yii\db\ActiveRecord;

class Report extends ActiveRecord
{
    static function tableName(): string
    {
        return 'reports';
    }
}