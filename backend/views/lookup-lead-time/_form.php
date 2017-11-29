<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LeadTime */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lead-time-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lead_time') ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Save', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
