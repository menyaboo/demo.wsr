<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ServiceRequest $model */

$this->title = 'Update Service Request: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Service Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="service-request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
