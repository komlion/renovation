<?php

namespace app\controllers;

use app\models\Message;
use app\models\Pagination;
use Yii;
use yii\web\Controller;
use app\models\Project;
use app\models\UploadForm;
use yii\web\UploadedFile;


class ProjectsController extends Controller
{
    public function actionIndex($projectId = NULL, $page = 1)
    {
        if ($projectId === NULL)
        {
            $pagination = Pagination::createPagination(Project::getRecordsCount(), 10, $page);
            $projects = array_slice(Project::getProjects(), 0 + ($page - 1) * 10, 10 + ($page - 1) * 10);

            return $this->render('projects', compact(['projects', 'pagination']));
        }
        $fileForm = new UploadForm;
        $messageForm = new Message;

        $project = Project::getProject($projectId);

        $projectClient = $project->getClient();
        $projectUsers = $project->getUsers();
        $projectMessages = $project->getMessages();
        $projectPhotos = $project->getPhotos();

        return $this->render('index', compact(['project', 'projectClient', 'projectUsers', 'projectMessages', 'projectPhotos', 'fileForm', 'messageForm']));

    }

    public function actionAddmessage($projectId)
    {
        if (Yii::$app->request->isPost)
        {
            $fileForm = new UploadForm;

            $project = Project::getProject($projectId);
            $text = Yii::$app->request->post('Message')['text'];
            $message = $project->addMessage($text);
            $fileForm->imageFiles = UploadedFile::getInstances($fileForm, 'imageFiles');
            $fileForm->upload($message->id);
        }

        return $this->redirect('/projects?projectId='.$projectId);
    }

    public function actionCreate()
    {
        $fileForm = new UploadForm;
        $projectForm = new Project;

        if (Yii::$app->request->isPost)
        {
            $fileForm = new UploadForm;

            $comment = Yii::$app->request->post('Project')['comment'];
            $city = Yii::$app->request->post('Project')['city'];
            $street = Yii::$app->request->post('Project')['street'];
            $house = Yii::$app->request->post('Project')['house'];
            $fileForm->imageFiles = UploadedFile::getInstances($fileForm, 'imageFiles');
            $project = Project::createProject($comment, $city, $street, $house, $fileForm);
            return $this->redirect('/projects?projectId=' . $project->id);
        }

        return $this->render('create', compact(['fileForm', 'projectForm']));
    }

    public function actionUpdate($projectId)
    {
        $project = Project::getProject($projectId);
        $project->comment = Yii::$app->request->post('Project')['comment'];

        $project->updateProject();
    }

    public function actionDelete($projectId)
    {
        $project = Project::getProject($projectId);

        $project->deleteProject();

        return $this->redirect('/projects');
    }

    public function actionAddUser($projectId, $userId)
    {
        $project = Project::getProject($projectId);
        $project->addUser($userId);

        return $this->redirect('/projects?projectId=' . $projectId);
    }

    public function actionAcceptproject($projectId)
    {
        $project = Project::getProject($projectId);
        $project->acceptProject();

        return $this->redirect('/projects?projectId=' . $project->id);
    }
}