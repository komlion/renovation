<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\City;

?>

<div class="body-content container">
    <div class="w-50">
        <h1>Создание проекта</h1>

        <?php $form = ActiveForm::begin(
            ['options' => ['class' => 'users-form', 'enctype' => 'multipart/form-data']]
        ) ?>

        <?= $form->field($projectForm, 'comment')->textArea(['placeholder' => 'Требования'])->label('') ?>
        <div class="form-inline">
            <?= $form->field($projectForm, 'city')->dropDownList(City::getCities())->label(false) ?>
            <?= $form->field($projectForm, 'street')->textInput(['placeholder' => 'Улица'])->label('Улица')->label('') ?>
            <?= $form->field($projectForm, 'house')->textInput(['placeholder' => 'Дом'])->label('Дом')->label('') ?>
        </div>
        <p><?= $form->field($fileForm, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->label('Загрузите фотографии:') ?></p>
        <?= Html::submitButton('Создать заявку', ['class' => 'btn btn-success']) ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>

