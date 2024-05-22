<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ServiceOrder $model */

$this->title = 'Create Service Order';
$this->params['breadcrumbs'][] = ['label' => 'Service Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
