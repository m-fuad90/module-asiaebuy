<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$script = <<< JS
$(document).ready(function(){



    
}); 
JS;
$this->registerJs($script);

$this->title = 'PayPal Transaction';
$this->params['breadcrumbs'][] = $this->title;


?>

    <section class="content-header">
      <h1>
        <?= Html::encode($this->title) ?>

      </h1>

    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">PayPal</h3>


                    </div>

                    <div class="box-body">

                        <table class="table" border="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Details</th>
                                    <th>Information</th>
                                    <th>Date Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php $i=0; foreach ($project as $key_project => $value_project) { $i++;?>
                               <tr>
                                    <td><?= $i;?></td>
                                    <td>
                                        <dl>
                                            <dt>Name : </dt>
                                            <dd><?= $value_project['name'] ?></dd>
                                            <dt>Email : </dt>
                                            <dd><?= $value_project['email'] ?></dd>
                                            <dt>Contact No : </dt>
                                            <dd><?= $value_project['contact_no'] ?></dd>
                                            <dt>Address : </dt>
                                            <dd><?= $value_project['address'] ?> , <?= $value_project['postcode'] ?> , <?= $value_project['city'] ?> , <?= $value_project['province'] ?> , <?= $value_project['country'] ?></dd>

                                            <?php if (empty($value_project['company_name'])) { ?>
         
                                            <?php } else { ?>
                                            <dt>Company Name : </dt>
                                            <dd><?= $value_project['company_name'] ?></dd>
                                            <?php } ?>

                                        </dl>
                                        <hr>
                                        <dl>
                                            <dt>Project : </dt>
                                            <dd><?= $value_project['myRFQ'] ?></dd>
                                            <dt>Quotation No : </dt>
                                            <dd>QT<?= $value_project['quotation_no'] ?></dd>
                                            <dt>Invoice No : </dt>
                                            <dd>IN<?= $value_project['invoice_no'] ?>F</dd>
                                        </dl>
                                    </td>
                                    <td>
                                        <dl>
                                            <dt>Transaction ID : </dt>
                                            <dd><?= empty($value_project['transactionID']) ? '' : $value_project['transactionID'] ?></dd>
                                        </dl>
                                        <hr>
                                        <dl>
                                            <dt>Payment Type : </dt>
                                            <dd><?= $value_project['payment_type'] ?></dd>
                                            <dt>Payment ID : </dt>
                                            <dd><?= $value_project['paymentID'] ?></dd>
                                            <dt>Payer ID : </dt>
                                            <dd><?= $value_project['payerID'] ?></dd>
                                            <dt>Payment Token : </dt>
                                            <dd><?= $value_project['paymentToken'] ?></dd>

                                        </dl>
                                    </td>
                                    <td>
                                        <dl>
                                            <dt>Date : </dt>
                                            <dd><?= $value_project['date_payment'] ?></dd>
                                            <dt>Time : </dt>
                                            <dd><?= $value_project['date_time_payment'] ?></dd>
                                        </dl>
                                    </td>
                                    <td>
                                      
                                        <?= Html::a('EDIT', ['transaction','id'=>(string)$value_project['_id']], ['class' => 'btn btn-default']) ?>



                                    </td>

                               </tr>

                                <?php } ?>
                            </tbody>
                            
                        </table>




                    </div>

                </div>

            </div>





        </div>
    </section>




