<?php

namespace app\models;

use app\commands\HelloController;
use yii\db\ActiveRecord;

class Photo extends ActiveRecord
{
    static function tableName(): string
    {
        return 'photos';
    }

    static public function deleteProjectPhotos($projectId)
    {
        $photos = Photo::findAll(['project_id' => $projectId]);

        if ($photos)
        {
            foreach ($photos as $photo) {
                if (file_exists($photo['path']))
                {
                    unlink($photo['path']);
                    $photo->delete();
                }
            }
        }

    }

    static public function getProjectPhotos($projectId): array
    {
        return Photo::findAll(['project_id' => $projectId]);
    }

//    static public function getReportPhotos($reportId)
//    {
//        return Photo::findAll(['report_id' => $reportId]);
//    }
}