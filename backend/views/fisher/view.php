<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Fisher */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fishers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fisher-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'catalog_no',
            'desc',
            'desc_long Description',
            'Std UOM',
            'ProductClass',
            'CATALOG NUMBER',
            'CDC',
            'PkgChg',
            'SUPkgWgt',
            'Temperature Requirements',
            'StdUnitVol',
            'CatlgPg',
            'BOL',
            'original_price
 (USD)',
            'c',
            'd',
            'local_myr',
            'e',
            'asean_usd',
            'f',
            'asiapac_usd',
        ],
    ]) ?>

</div>
