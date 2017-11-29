<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Notification;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'RFQ';
$this->params['breadcrumbs'][] = $this->title;
?>
    <section class="content-header">
      <h1>
        <?= Html::encode($this->title) ?>
        <small>List Of RFQ</small>
      </h1>

    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">


                    <?php if (empty($models)) { ?>

                            <div class="box">
                                <div class="box-header with-border">
                                  <h3 class="box-title">#</h3>
                                  <div class="pull-right"></div>

                                </div>
     
                                <div class="box-body">

                                    No Data


                                </div>

                            </div>


                        


                    <?php } else { ?>


                        <?php $i=0; foreach ($models as $key => $model) { $i++;?>

                            <div class="box">
                                <div class="box-header with-border">
                                  <h3 class="box-title">#<?= $model->myRFQ ?></h3>
                                  <div class="pull-right">Place On : <?= $model->date_create ?></div>

                                </div>
     
                                <div class="box-body">

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Details</th>
                                                <th>Information</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>

                                                    <dl>
                                                        <dt>Name : </dt>
                                                        <dd><?= $model['name']; ?></dd>
                                                        <?php if (empty($model['company_name'])) { ?>
                                                            
                                                        <?php } else { ?>
                                                        <dt>Company : </dt>
                                                        <dd><?= $model['company_name']; ?></dd>
                                                        <?php } ?>

                                                        <dt>Address : </dt>
                                                        <dd>
                                                            <?= $model['address']; ?>,<?= $model['postcode']; ?>,<?= $model['city']; ?>
                                                        <dt>Province</dt>
                                                        <dd><?= $model['province']; ?><dd>
                                                        <dt>Country</dt>
                                                        <dd>
                                                            <?= $model['country']; ?>
                                                        </dd>
                                                        <dt>Contact : </dt>
                                                        <dd><?= $model['contact_no']; ?></dd>
                                                        <dt>Email : </dt>
                                                        <dd><?= $model['email']; ?></dd>
                                                    </dl>



                                                    <?php if ($model->diff_add_info == 'No') { ?>
                                                            
                                                    <?php } else { ?>

                                                    <b>Different Address</b>
                                                    <dl class="dl-horizontal">
                                                        <dt>PIC : </dt>
                                                        <dd><?= $model->diff_name ?></dd>
                                                        <?php if (empty($model->diff_company)) { ?>
                                                            
                                                        <?php } else { ?>
                                                        <dt>Company : </dt>
                                                        <dd><?= $model->diff_company; ?></dd>
                                                        <?php } ?>

                                                        <dt>Address : </dt>
                                                        <dd><?= $model->diff_address ?>,<?= $model->diff_postcode ?>,<?= $model->diff_city ?></dd>
                                                        <dt>Province</dt>
                                                        <dd><?= $model->diff_province ?></dd>
                                                        <dt>Country</dt>
                                                        <dd><?= $model->diff_country ?></dd>

                                                    <?php } ?>

                                                </td>
                                                <td>
                                                    <?php foreach ($model['data'] as $key => $data) { ?>

                                                    <dl>
                                                        <dt>Catalog No : </dt>
                                                        <dd><?= $data['catalog_no']; ?></dd>
                                                        <dt>Quantity</dt>
                                                        <dd><?= $data['quantity']; ?></dd>
                                                    </dl>
                                                        

                                                    <?php }?>
                                                </td>
                                                <td>


                                                    <?php 

                                                    $newProject_id = new \MongoDB\BSON\ObjectID($model->_id);

                                                    $data = Notification::find()
                                                    ->where(['to_who'=>'admin','read_unread'=>1,'project'=>$newProject_id])
                                                    ->orderBy([
                                                       '_id'=>SORT_DESC,
                                                    ])
                                                    ->one(); 

                                                    ?>

                                                    <?php if ($data->read_unread == 1) { ?>

                                                        <?= Html::a('Quote',[$data->path,'id' => (string)$data->_id,'module' => $data->module], ['class' => 'btn btn-default']) ?>

                          
                                                    <?php } else { ?>

                                                        <?= Html::a('Quote', ['quote', 'id' => (string)$model->_id], ['class' => 'btn btn-default']) ?>

                                                    <?php } ?>





                                                     
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>


              
                                </div>
          


                            </div>

                        <?php } ?>



                    <?php } ?>
                         


            </div>
        </div>
    </section>




   