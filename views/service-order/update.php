<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ServiceOrder $model */

$this->title = 'Update Service Order: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Service Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="service-order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
