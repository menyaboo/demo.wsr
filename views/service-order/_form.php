<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ServiceOrder $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="service-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'is_executor')->checkbox() ?>

    <?= $form->field($model, 'service_requests_id')
        ->dropDownList(\yii\helpers\ArrayHelper::map(app\models\ServiceRequest::find()->all(), 'id', 'tech_model'), ['prompt' => 'Выберите заявку'])
        ->label('Заявка'); ?>


    <?= $form->field($model, 'employee_id')
        ->dropDownList(\yii\helpers\ArrayHelper::map(app\models\User::find()->where(['role_id' => 3])->all(), 'id', 'surname'), ['prompt' => 'Выберите заявку'])
        ->label('Сотрудник'); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
