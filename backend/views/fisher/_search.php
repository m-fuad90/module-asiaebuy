<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FisherSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fisher-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'catalog_no') ?>

    <?= $form->field($model, 'desc') ?>

    <?= $form->field($model, 'desc_long Description') ?>

    <?= $form->field($model, 'Std UOM') ?>

    <?php // echo $form->field($model, 'ProductClass') ?>

    <?php // echo $form->field($model, 'CATALOG NUMBER') ?>

    <?php // echo $form->field($model, 'CDC') ?>

    <?php // echo $form->field($model, 'PkgChg') ?>

    <?php // echo $form->field($model, 'SUPkgWgt') ?>

    <?php // echo $form->field($model, 'Temperature Requirements') ?>

    <?php // echo $form->field($model, 'StdUnitVol') ?>

    <?php // echo $form->field($model, 'CatlgPg') ?>

    <?php // echo $form->field($model, 'BOL') ?>

    <?php // echo $form->field($model, 'original_price
 (USD)') ?>

    <?php // echo $form->field($model, 'c') ?>

    <?php // echo $form->field($model, 'd') ?>

    <?php // echo $form->field($model, 'local_myr') ?>

    <?php // echo $form->field($model, 'e') ?>

    <?php // echo $form->field($model, 'asean_usd') ?>

    <?php // echo $form->field($model, 'f') ?>

    <?php // echo $form->field($model, 'asiapac_usd') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
