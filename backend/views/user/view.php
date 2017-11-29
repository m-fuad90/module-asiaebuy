<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

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
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email',
            'customer_id',
            'status',
            'created_at',
            'updated_at',
            'name',
            'address',
            'postcode',
            'city',
            'province',
            'contact_no',
            'company_name',
            'diff_add_info',
            'diff_name',
            'diff_address',
            'diff_postcode',
            'diff_city',
            'diff_province',
            'diff_contact_no',
            'diff_country',
        ],
    ]) ?>

</div>
