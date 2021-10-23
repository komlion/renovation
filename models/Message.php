<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;


class Message extends ActiveRecord
{
    public function rules(): array
    {
        return [
            [['text'], 'required'],
            ['text', 'string', 'max' => 250],
        ];
    }

    static function tableName(): string
    {
        return 'messages';
    }

    static function getMessages($projectId): array
    {
        return Message::find()->where(['project' => $projectId])->orderBy(['create_date' => SORT_DESC])->all();
    }

    static function addMessage($projectId, $text, $author): Message
    {
        $message = New message;

        $message->project = $projectId;
        $message->author = $author;
        $message->text = $text;
        $message->save();

        return $message;
    }

    public function getPhotos(): array
    {
        return Photo::find()->where(['message_id' => $this->id])->all();
    }
}