<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">БытСервис!</h1>
        <p class="lead">Создай заявку сейчас!</p>
        <p><a class="btn btn-lg btn-success" href="<?= Yii::$app->user->isGuest ? '/site/login' : '/service-request/create' ?>">Создать заявку</a></p>
    </div>
</div>
