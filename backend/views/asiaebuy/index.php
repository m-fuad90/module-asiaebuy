<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asiaebuys';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asiaebuy-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Asiaebuy', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            '_id',
            'company',
            'company_no',
            'address',
            'telephone_no',
            // 'fax_no',
            // 'email',
            // 'tax_no',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
