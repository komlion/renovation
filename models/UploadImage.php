<?php

namespace app\models;
use yii\base\Model;

class UploadImage extends Model
{
    public $images;

    public function rules()
    {
        return [
            [['images'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 20],
        ];
    }

    public function upload()
    {
        if ($this->validate())
        {
            foreach ($this->images as $image):

                $image->saveAs('uploads/{$this->image->baseName}.{$this->image->extension}');

            endforeach;

        }
            return False;
    }
}