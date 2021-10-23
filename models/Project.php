<?php

namespace app\models;

use app\commands\HelloController;
use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;


class Project extends ActiveRecord
{
    public function rules(): array
    {
        {
            return [
                [['comment', 'client', 'city', 'street', 'house'], 'required'],
                [['comment', 'street', 'house'], 'string'],
            ];
        }
    }

    static function tableName(): string
    {
        return 'projects';
    }

    static public function getProjects(): array
    {
        return Project::find()->all();
    }

    static public function getProject($projectId)
    {
        return Project::findOne($projectId);
    }

    static public function getRecordsCount()
    {
        return Project::find()->count();
    }

    public function getClient(): User
    {
        return User::getUser($this->client);
    }

    public function getMessages(): array
    {
        return Message::getMessages($this->id);
    }

    public function getUsers(): array
    {
        $usersId = User_Project::find()->where(['project' => $this->id])->select('user')->asArray()->column();
        $users = User::findAll(['id' => $usersId]);

        return $users;
    }

    public function getPhotos(): array
    {
        return Photo::getProjectPhotos($this->id);
    }

    public function getAddress(): string
    {
        return $this->city . ', ' . $this->street . ' ' . $this->house;
    }

    public function getProjectReports()
    {
        return Report::findAll(['project_id' => $this->id]);
    }

    public function getThreeOrLessPhotos(): array
    {
        $photos = Photo::find()->where(['project_id' => $this->id])->limit(3)->all();

        return $photos;
    }

    public function addMessage($text): Message
    {
        return Message::addMessage($this->id, $text, Yii::$app->user->id);
    }

    static public function createProject($comment, $city, $street, $house, $fileForm = NULL)
    {
        $project = new Project;
        $project->client = Yii::$app->user->id;
        $project->comment = $comment;
        $project->city = $city;
        $project->street = $street;
        $project->house = $house;
        $project->save();

        if ($fileForm != NULL)
        {
            $fileForm->upload(NULL, $project->id);
        }
        return $project;
    }

    public function updateProject()
    {
        return $this->update();
    }

    public function deleteProject()
    {
        Photo::deleteProjectPhotos($this->id);

        return $this->delete();
    }

    public function addUser($userId): bool
    {
        $model = new User_project;
        $model->project = $this->id;
        $model->user = $userId;

        return $model->save();
    }

    public function removeUser($userId)
    {
        $model = User_project::findOne(['project' => $this->id, 'user' => $userId]);
        return $model->delete();
    }

    public function acceptProject()
    {
        $this->statement_date = (new \DateTime('now', new \DateTimeZone('Europe/Moscow')))->format('Y-m-d H:i:s');
        $this->addUser(Yii::$app->user->id);
        $address = $this->getAddress();
        $this->update();
        Notification::addNotification($this->client, 'Ваш проект приняли!', "Поздравляем! <a href='projects?projectId=$this->id'>Ваш проект</a> по адресу $address  был принят.");
    }
}