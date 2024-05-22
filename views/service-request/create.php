<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ServiceRequest $model */

$this->title = 'Create Service Request';
$this->params['breadcrumbs'][] = ['label' => 'Service Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
