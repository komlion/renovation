<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\Notification;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\User;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!--<div class="wrap">-->
<!--<div class="navbar-wrapper">-->
<!--    --><?php
//    NavBar::begin([
//        'brandLabel' => Yii::$app->name,
//        'brandUrl' => Yii::$app->homeUrl,
//        'options' => [
////            'class' => 'navbar-inverse navbar-fixed-top',
//            'class' => 'navbar navbar-inverse navbar-static-top',
//        ],
//    ]);
//    echo Nav::widget([
////        'options' => ['class' => 'navbar-nav navbar-right'],
//        'options' => ['class' => 'nav navbar-nav'],
//        'items' => [
//            ['label' => 'Home', 'url' => ['/site/index']],
//            ['label' => 'About', 'url' => ['/site/about']],
//            ['label' => 'Contact', 'url' => ['/site/contact']],
//            Yii::$app->user->isGuest ? (
//                ['label' => 'Login', 'url' => ['/site/login']]
//            ) : (
//                '<li>'
//                . Html::beginForm(['/site/logout'], 'post')
//                . Html::submitButton(
//                    'Logout (' . Yii::$app->user->identity->username . ')',
//                    ['class' => 'btn btn-link logout']
//                )
//                . Html::endForm()
//                . '</li>'
//            )
//        ],
//    ]);
//    NavBar::end();
//    ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">Мой ремонт</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse container-fluid" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/projects/create">Заказать ремонт<span class="sr-only">(current)</span></a>
            </li>
<!--            <li class="nav-item active">-->
<!--                <a class="nav-link" href="#">Цены<span class="sr-only">(current)</span></a>-->
<!--            </li>-->
<!--            <li class="nav-item active">-->
<!--                <a class="nav-link" href="#">Отзывы<span class="sr-only">(current)</span></a>-->
<!--            </li>-->
<!--            <li class="nav-item active">-->
<!--                <a class="nav-link" href="#">О нас<span class="sr-only">(current)</span></a>-->
<!--            </li>-->
<!--            <li class="nav-item active">-->
<!--                <a class="nav-link" href="/site/about">Контакты<span class="sr-only">(current)</span></a>-->
<!--            </li>-->


            <? if (Yii::$app->user->isGuest): ?>
                <li class="nav-item active">
                    <a class="nav-link" href="/users/login">Войти</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/users/signup">Регистрация</a>
                </li>
            <? else: ?>
            <li class="nav-item active">
                <a class="nav-link" href="/notifications">Уведомления(<?= Notification::getCountNewNotifications(Yii::$app->user->id) ?>)<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="users?userId=<?= Yii::$app->user->id ?>"><?= User::getUser(Yii::$app->user->id)->fullName() ?></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/users/logout">Выйти</a>
            </li>
            <? endif; ?>

        </ul>
    </div>



</nav>
    <div class="container-fluid pr-0 pl-0">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>


<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Мой ремонт <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
