<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="body-content container">
    <div class="w-50">
        <h1>Авторизация</h1>

        <?php $form = ActiveForm::begin(
            ['options' => ['class' => 'users-form']]
        ); ?>

        <?= $form->field($model, 'phone')->textInput(['placeholder' => 'Телефон'])->label('') ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль'])->label('') ?>

        <?= Html::submitButton('Зайти', ['class' => 'btn btn-success']) ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>
