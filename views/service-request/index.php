<?php

use app\models\ServiceRequest;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ServiceRequestSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Service Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Service Request', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'start_date',
            'tech_type',
            'tech_model',
            'description:ntext',
            //'completion_date',
            //'status_id',
            //'client_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ServiceRequest $model, $key, $index, $column) {
                    // Проверяем, если пользователь имеет роль 'client', то не создаем ссылки для действий 'update' и 'delete'
                    if (!Yii::$app->user->identity->roleMiddleware('client') && in_array($action, ['update', 'delete'])) {
                        return null;
                    }
                    // Для всех остальных действий создаем ссылки
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
