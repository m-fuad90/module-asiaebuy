<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Fisher */

$this->title = 'Update Fisher: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fishers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fisher-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
