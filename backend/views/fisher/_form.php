<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Fisher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fisher-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'catalog_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc_long Description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Std UOM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ProductClass')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CATALOG NUMBER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CDC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PkgChg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SUPkgWgt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Temperature Requirements')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StdUnitVol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CatlgPg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BOL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'original_price
 (USD)')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'c')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'local_myr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'e')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'asean_usd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'f')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'asiapac_usd')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
