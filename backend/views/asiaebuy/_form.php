<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Asiaebuy */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asiaebuy-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company') ?>

    <?= $form->field($model, 'company_no') ?>

    <?= $form->field($model, 'address') ?>

    <?= $form->field($model, 'telephone_no') ?>

    <?= $form->field($model, 'fax_no') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'tax_no') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
