<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\FisherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fisher';
$this->params['breadcrumbs'][] = $this->title;
?>

    <section class="content-header">
      <h1>
        <?= Html::encode($this->title) ?>
        <small>List Of Fishers</small>
      </h1>

    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Searching</h3>
                      <div class="pull-right"></div>

                    </div>
                    <div class="box-body">

                        <?php echo $this->render('_search', ['model' => $searchModel]); ?>

                    </div>

                </div>

            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">List Of Fishers</h3>
                      <div class="pull-right"></div>

                    </div>

                    <div class="box-body">

                        <?php Pjax::begin(); ?>    
                        <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],

                                    //'id',
                                    'catalog_no',
                                    'desc',



                                    //['class' => 'yii\grid\ActionColumn'],
                                ],
                                'tableOptions' =>[
                                    'class' => 'table class',
                                ],

                            ]); ?>
                        <?php Pjax::end(); ?>



                    </div>

                </div>
            </div>
        </div>
    </section>
