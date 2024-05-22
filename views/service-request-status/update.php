<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ServiceRequestStatus $model */

$this->title = 'Update Service Request Status: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Service Request Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="service-request-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
