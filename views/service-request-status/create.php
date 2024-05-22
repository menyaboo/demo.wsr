<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ServiceRequestStatus $model */

$this->title = 'Create Service Request Status';
$this->params['breadcrumbs'][] = ['label' => 'Service Request Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-request-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
