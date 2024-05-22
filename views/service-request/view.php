<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\ServiceRequest $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Service Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$anotherModel = new \app\models\Comment();

$additionalProps = [
    'service_request_id' => $model->id,
];

$data = array_merge(['model' => $anotherModel], $additionalProps);

?>
<div class="service-request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'start_date',
            'tech_type',
            'tech_model',
            'description:ntext',
            'completion_date',
            'status_id',
            'client_id',
        ],
    ]) ?>

<!--    <h3>Комментарии:</h3>-->
<!---->
<!--    <div class="comment-create">-->
<!--        --><?php //= $this->render('_form_comment', $data) ?>
<!--    </div>-->
</div>
