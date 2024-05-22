<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Spare $model */

$this->title = 'Create Spare';
$this->params['breadcrumbs'][] = ['label' => 'Spares', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spare-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
