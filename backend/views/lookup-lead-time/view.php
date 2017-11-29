<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\LeadTime */

$this->title = $model->_id;
$this->params['breadcrumbs'][] = ['label' => 'Lead Times', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lead-time-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => (string)$model->_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => (string)$model->_id], [
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
            '_id',
            'lead_time',
            'enter_by',
            'update_by',
            'date_create',
            'date_update',
        ],
    ]) ?>

</div>
