<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ServiceOrderSpare $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="service-order-spare-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'service_order_id')->textInput() ?>

    <?= $form->field($model, 'spare_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
