<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Fisher */

$this->title = 'Create Fisher';
$this->params['breadcrumbs'][] = ['label' => 'Fishers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fisher-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
