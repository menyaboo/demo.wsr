<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use yii\bootstrap5\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php

    NavBar::begin([
        'brandLabel' => 'БытСервис',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Пользователи', 'url' => ['/user/index'], 'visible' =>
                !Yii::$app->user->isGuest && Yii::$app->user->identity->roleMiddleware('admin')],

            ['label' => 'Роли', 'url' => ['/role/index'], 'visible' =>
                !Yii::$app->user->isGuest && Yii::$app->user->identity->roleMiddleware('admin')],

            ['label' => 'Статусы заявок', 'url' => ['/service-request-status/index'], 'visible' =>
                !Yii::$app->user->isGuest && Yii::$app->user->identity->roleMiddleware('admin')],

            ['label' => 'Заявки', 'url' => ['/service-request/index'], 'visible' => !Yii::$app->user->isGuest],

            ['label' => 'Комментарии', 'url' => ['/comment/index'], 'visible' =>
                !Yii::$app->user->isGuest && !Yii::$app->user->identity->roleMiddleware('client')],

            ['label' => 'Заказы', 'url' => ['/service-order/index'], 'visible' =>
                !Yii::$app->user->isGuest && !Yii::$app->user->identity->roleMiddleware('client|manager')],

            ['label' => 'Запчасти к заказам', 'url' => ['/service-order-spare/index'], 'visible' =>
                !Yii::$app->user->isGuest && Yii::$app->user->identity->roleMiddleware('master|admin')],

            ['label' => 'Запчасти', 'url' => ['/spare/index'], 'visible' =>
                !Yii::$app->user->isGuest && Yii::$app->user->identity->roleMiddleware('master|admin')],

            Yii::$app->user->isGuest
                ? ['label' => 'Авторизироваться', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Выход (' . Yii::$app->user->identity->surname . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; IT-Соm <?= date('Y') ?></div>
        </div>
    </div>
</footer>

<div class="position-absolute bottom-0 p-4">
    <?php
    if (Yii::$app->session->hasFlash('changeStatus')) {
        echo Alert::widget([
            'options' => [
                'class' => 'alert-success',
            ],
            'body' => Yii::$app->session->getFlash('changeStatus'),
        ]);
    } ?>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
