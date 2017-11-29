<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LeadTime */

$this->title = 'Update Lead Time';
$this->params['breadcrumbs'][] = ['label' => 'Lead Times', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->_id, 'url' => ['view', 'id' => (string)$model->_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lead-time-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
