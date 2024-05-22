<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ServiceRequest $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="service-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'start_date')->hiddenInput(['value' => date('Y-m-d')])->label(false) ?>

    <?= $form->field($model, 'tech_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tech_model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'client_id')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false) ?>

    <?php
        if (!Yii::$app->user->identity->roleMiddleware('client')) {
            echo $form->field($model, 'status_id')->dropDownList(
                \yii\helpers\ArrayHelper::map(app\models\ServiceRequestStatus::find()->all(), 'id', 'name'),
                ['prompt' => 'Выберите статус']
            );
        }
    ?>

    <?php
        if (!Yii::$app->user->identity->roleMiddleware('client') && $form->field($model, 'completion_date')->input('date')) {
            echo $form->field($model, 'completion_date')->input('date');
        }
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
