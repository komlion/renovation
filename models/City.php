<?php

namespace app\models;

use yii\db\ActiveRecord;

class City extends ActiveRecord
{
    static function tableName(): string
    {
        return 'cities';
    }

    static function getCities(): array
    {
        $cities = City::find('city')->orderBy(['city' => SORT_DESC])->all();
        $array = [];
        foreach ($cities as $city)
        {
            $array[$city->city] = $city->city;
        }

        return $array;
    }
}