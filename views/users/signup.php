<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="body-content container">
    <h1>Регистрация</h1>


    <?php $form = ActiveForm::begin(
            ['options' => ['class' => 'users-form']]
    ); ?>

    <?= $form->field($model, 'first_name')->textInput()->label('Имя') ?>
    <?= $form->field($model, 'middle_name')->textInput()->label('Фамилия') ?>
    <?= $form->field($model, 'last_name')->textInput()->label('Отчество') ?>
    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, [
        'mask' => '**********'])->label('Телефон') ?>
    <?= $form->field($model, 'password')->passwordInput()->hint('Должен содержать:')->label('Пароль') ?>

    <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end(); ?>
</div>