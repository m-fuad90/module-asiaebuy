    <?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

$this->title = 'myOrder';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row service-box margin-bottom-40">

    <div class="col-md-12 col-sm-12">

        <h2><?= Html::encode($this->title) ?></h2>

        <?php if (empty($models)) { ?>

                #No Data

        <?php } else { ?>

            <?php $i=0; foreach ($models as $key => $model) { $i++;?>

                <div class="panel panel-default">

                    <div class="panel-heading">#<?= $model['myRFQ'] ?><span class="pull-right">Place On : <?= $model['date_create'] ?></span></div>

                    <div class="panel-body">

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



                                        <?php if ($model['diff_add_info'] == 'No') { ?>
                                                
                                        <?php } else { ?>

                                        <b>Different Address</b>
                                        <dl class="dl-horizontal">
                                            <dt>PIC : </dt>
                                            <dd><?= $model['diff_name'] ?></dd>
                                            <?php if (empty($model['diff_company'])) { ?>
                                                
                                            <?php } else { ?>
                                            <dt>Company : </dt>
                                            <dd><?= $model['diff_company']; ?></dd>
                                            <?php } ?>

                                            <dt>Address : </dt>
                                            <dd><?= $model['diff_address'] ?>,<?= $model['diff_postcode'] ?>,<?= $model['diff_city'] ?></dd>
                                            <dt>Province</dt>
                                            <dd><?= $model['diff_province'] ?></dd>
                                            <dt>Country</dt>
                                            <dd><?= $model['diff_country'] ?></dd>

                                        <?php } ?>
                                        
                                        <?php if (empty($model['reason_revise'])) { ?>
                                          
                                        <?php } else { ?>

                                            <span> ( This Quotation Has Been Revise ! <b>Reason : <?= $model['reason_revise'] ?></b> )</span>

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
                                        <?php if (empty($model['revise'])) { ?>

                                            <?= Html::a('QT '.$model['quotation_no'], ['view', 'id' => (string)$model['_id']], ['class' => 'btn btn-default','target'=>'_BLANK']) ?>


                                        <?php } else { ?>


                                            <?= Html::a('QT '.$model['quotation_no'].'-R'.$model['reviseCount'], ['view', 'id' => (string)$model['_id']], ['class' => 'btn btn-default','target'=>'_BLANK']) ?>

                                        <?php } ?>

                                        <?= Html::a('TRACK ORDER', [
                                                'track', 
                                                'id' => (string)$model['_id']
                                                ], ['class' => 'btn btn-default']) ?>

                                        <?= Html::a('ORDER DETAIL', [
                                                'order-detail', 
                                                'project' => (string)$model['_id']
                                                ], ['class' => 'btn btn-default']) ?>

                                        <?= Html::a('IN'.$model['invoice_no'].'F', ['invoice', 'id' => (string)$model['_id']], ['class' => 'btn btn-default','target'=>'_BLANK']) ?>

                                        <?= Html::a('MESSAGE', ['message', 'project' => (string)$model['_id']], ['class' => 'btn btn-primary']) ?>




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