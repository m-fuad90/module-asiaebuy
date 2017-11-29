<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Asiaebuy */

$this->title = 'Create Asiaebuy';
$this->params['breadcrumbs'][] = ['label' => 'Asiaebuys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asiaebuy-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
