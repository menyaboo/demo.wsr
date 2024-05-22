<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ServiceOrderSpare $model */

$this->title = 'Create Service Order Spare';
$this->params['breadcrumbs'][] = ['label' => 'Service Order Spares', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-order-spare-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
