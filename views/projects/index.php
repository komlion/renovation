<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;

$currentUser = Yii::$app->user->id;
?>
<link href="../../web/css/bootstrapV3.2.0.css" rel="stylesheet">

<div class="body-content container">
    <h1>Проект</h1>
    <div class="d-flex flex-row justify-content-between" >
        <div>

    <h3>Создатель: <?= $projectClient->first_name . ' ' . $projectClient->last_name?></h3>
    <h3>Задача:</h3>
    <p><?= $project->comment ?></p>
        </div>
    <div>
        <h3>Участники:</h3>
        <?php foreach ($projectUsers as $user): ?>
            <?php if ($user->isForeman()): ?>
                <div><a href="/users?userId=<?= $user->id ?>" class="foremanName"><?= $user->first_name ?> (Прораб)</a></div>
            <?php endif ?>
        <?php endforeach; ?>

        <?php foreach ($projectUsers as $user): ?>
            <?php if (!$user->isForeman()): ?>
                <div><a href="/users?userId=<?= $user->id ?>"><?= $user->first_name ?></a></div>
            <?php endif ?>
        <?php endforeach; ?>
    </div>
    </div>
        <div class="fullChat">
            <div class="panel panel-primary mb-0">
                <div class="panel-heading" id="accordion">
                    Чат
                    <div class="btn-group pull-right">
                        <a type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <span class="">Открыть</span>
                        </a>
                    </div>
                </div>
                <div class="panel-collapse collapse show" id="collapseOne">
                    <div class="panel-body">
                        <ul class="chat">
                            <?php foreach ($projectMessages as $message):?>
                                <?php if (User::isYou($message->author)): ?>
                                    <li class="right clearfix">
                                        <div class="chat-body clearfix">
                                            <div class="header">
                                                <strong>Вы</strong>
                                                <small class="text-muted">13 mins ago</small>
                                            </div>
                                            <p class="chat-message">
                                                <?= $message->text ?>
                                                <?php
                                                $photos = $message->getPhotos();
                                                if (!empty($photos)):
                                                    foreach ($message->getPhotos() as $photo): ?>
                                            <img alt="Фотография" src="<?= $photo->path ?>" class="img-fluid mt-4">
                                                    <?php
                                                    endforeach;
                                                endif; ?>
                                            </p>
                                        </div>
                                    </li>
                                <?php else: ?>
                                    <li class="left clearfix">
                                    <div class="chat-body clearfix pull-right text-right">
                                        <div class="header">
                                            <small class="text-muted"><?= $message->create_date ?></small>
                                            <strong class="primary-font"><?= User::getUser($message->author)->first_name ?></strong>
                                        </div>
                                        <p class="text-right chat-message">
                                            <?= $message->text ?>
                                            <?php
                                            $photos = $message->getPhotos();
                                            if (!empty($photos)):
                                                foreach ($message->getPhotos() as $photo): ?>
                                                    <img src="<?= $photo->path ?>" class="img-fluid mt-4">
                                                <?php
                                                endforeach;
                                            endif; ?>
                                        </p>
                                    </div>
                                </li>

                            <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class='panel-footer'>
                        <div>
                        <?php $form = ActiveForm::begin([
                                'options' => ['class' => 'input-group'],
                                'action' => '/projects/addmessage?projectId=' . $project->id]
                        ); ?>
                        <?= $form->field($fileForm, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->label('Загрузите фото') ?>
                            <div class="d-flex d-inline test">
                        <?= $form->field($messageForm, 'text')->textInput(['class' => 'form-control input-sm', 'id' => 'btn-input'])->label('') ?>
                        <span class="input-group-btn">
                            <?= Html::submitButton('Отправить', ['class' => 'btn btn-warning btn-sm h-100', 'id' => 'btn-chat']) ?>
                        </span>
                            </div>
                        <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle"
                    type="button" id="dropdownMenu1" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                Действия
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <?php if ($currentUser === $projectClient->id): ?>
                    <?php if ($project['statement_date'] === NULL): ?>
                    <a class="dropdown-item" href="projects/delete?projectId=<?=$project->id?>">Удалить проект</a>
                    <?php endif; ?>
                <?php elseif (User::isForeman($currentUser)): ?>
                <?php if ($project['statement_date'] === NULL): ?>
                        <a class="dropdown-item" href="projects/acceptproject?projectId=<?=$project->id?>">Принять проект</a>
                <?php endif; ?>
                    <a class="dropdown-item" href="projects/delete?projectId=<?=$project->id?>">Удалить проект</a>
                <?php endif; ?>
            </div>
        </div>

    <a class="dropdown-item" href="projects/acceptproject?projectId=<?=$project->id?>">Принять проект</a>
</div>


