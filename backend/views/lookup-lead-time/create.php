<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LeadTime */

$this->title = 'Lead Time';
$this->params['breadcrumbs'][] = ['label' => 'Lead Times', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lead-time-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
