<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ServiceOrderSpare $model */

$this->title = 'Update Service Order Spare: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Service Order Spares', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="service-order-spare-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
