<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 10, 'checkExtensionByMimeType' => false],
        ];
    }

    public function upload($messageId = NULL, $projectId = NULL)
    {

        if ($this->validate())
        {
            foreach ($this->imageFiles as $file)
            {
                $photo = new Photo;
                $filename = Yii::$app->getSecurity()->generateRandomString(15);
                $path = 'web/uploads/' . $filename . '.' . $file->extension;
                $file->saveAs($path);
                $photo->path = $path;

                if ($messageId !== NULL)
                {
                    $photo->message_id = $messageId;
                }
                else if ($projectId !== NULL)
                {
                    $photo->project_id = $projectId;
                }
                $photo->save();
            }
            return True;
        }
        else
        {
            return False;
        }
    }
}