<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Details';
$this->params['breadcrumbs'][] = ['label' => 'Order', 'url' => ['order']];
$this->params['breadcrumbs'][] = $this->title;
$script = <<< JS
$(document).ready(function(){


    $('.statusItem').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });



}); 
JS;
$this->registerJs($script);

?>

    <section class="content-header">
      <h1>
          View Project : <?= Html::encode($this->title) ?>
      </h1>

    </section>  

    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <?php $i=0; foreach ($models as $key => $model) { $i++;?>

                            <div class="box">
                                <div class="box-header with-border">
                                  <h3 class="box-title">#<?= $model['myRFQ'] ?></h3>
                                  <div class="pull-right">Place On : <?= $model['date_create'] ?></div>

                                </div>
     
                                <div class="box-body">


                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Details</th>
                                                <th>Information</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>

                                                    <dl>
                                                        <dt>Name : </dt>
                                                        <dd><?= $model['name']; ?></dd>
                                                        <dt>Company : </dt>
                                                        <dd><?= $model['company_name']; ?></dd>
                                                        <dt>Address : </dt>
                                                        <dd>
                                                            <?= $model['address']; ?>,<?= $model['postcode']; ?>,<?= $model['city']; ?>,
                                                            <?= $model['province']; ?>
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
                                                        <dt>Address : </dt>
                                                        <dd><?= $model['diff_address'] ?>,<?= $model['diff_postcode'] ?>,<?= $model['diff_city'] ?>,<?= $model['diff_province'] ?>,<?= $model['diff_country'] ?></dd>


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
                                            </tr>
                                            <?php if (empty($model['reason_revise'])) { ?>
              

                                              
                                            <?php } else { ?>

                                                <tr>
                                                    <td colspan="2">
                                                        ( This Quotation Has Been Revise ! <b>Reason : <?= $model['reason_revise'] ?></b> )
                                                    </td>
                                                    
                                                </tr>


                                            <?php } ?>



                                        </tbody>
                                    </table>





                                </div>
                            </div>



                            <div class="box">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Order Tracking</h3>
                                  <div class="pull-right">
                                      <?= Html::a('Status',FALSE, ['value'=>Url::to([
                                        'project/status',
                                        'project'=> (string)$newProject_id,
                                        ]),
                                        'class' => 'btn btn-primary statusItem',
                                        'style'=>'cursor:pointer;',
                                        'data-target'=>'#m_modal_1',
                                        'data-toggle'=>'modal'

                                        ]) ?>
                                  </div>

                                </div>
     
                                <div class="box-body">


                                        <?php foreach ($status as $key_status => $value_status) { ?>


                                            <table class="table">
                                                <thead>
                                                    <tr>
                                            
                                            
                                            <?php if ($value_status['in_time_status'] == $value_status['item'][0]['status']) { ?>

                                                        <th><?= $value_status['item'][0]['status']; ?></th>
                                           

                                            <?php } else { ?>

                                                        <th>Processing</th>
                                             
                                            <?php } ?>

                                                    <?php if ($value_status['in_time_status'] == 'Cancel') { ?>

                                                          
                                                        <th><?= $value_status['item'][1]['status']; ?></th>
                                                       


                                                    <?php } else { ?>


                                                                <?php if ($value_status['in_time_status'] == $value_status['item'][1]['status']) { ?>

                                                                 
                                                                            <th><?= $value_status['item'][1]['status']; ?></th>
                                                                   

                                                                <?php } else { ?>

                                                                      
                                                                            <th>Shipped</th>
                                                                      

                                                                <?php } ?>
                                                                <?php if ($value_status['in_time_status'] == $value_status['item'][2]['status']) { ?>

                                                                        
                                                                            <th><?= $value_status['item'][2]['status']; ?></th>
                                                                    

                                                                <?php } else { ?>
                                                                       
                                                                            <th>Delivered</th>
                                                              
                                                                <?php } ?>



                                                    <?php } ?>


                                        <?php } ?>
                                                </tr>
                                            </thead>
                                        </table>



                                        <?php foreach ($status as $key_status => $value_status) { ?>

                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Status</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                <?php foreach ($value_status['detail'] as $key_details => $value_details) { ?>
                                                    
                                                    <tr>
                                                        <td>
                                                            <?= $value_details['status'] ?>
                                               
                                                        
                                             
                                                            <?php if ($value_status['in_time_status'] == 'Cancel') { ?>
                                              
                                                                <?= $value_details['refund'] ?>

                                                            <?php } elseif ($value_status['in_time_status'] == 'Shipped') { ?>

                                                                <?= $value_details['extra'] ?>
                                                                
                                                            <?php } ?>

                                                        <td>
                                                            <?= $value_details['date'] ?>
                                                            
                                                        </td>

                                                    </tr>
                                

                                                <?php } ?>
                                                </tbody>
                                            </table>




                                        <?php } ?>






                                </div>

                            </div>

                          <h3>
                              Item Details
                          </h3>
                            <?php  foreach ($model['data']  as $key => $value) { ?>
                            <div class="box">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Catalog No : <?= $value['catalog_no']; ?></h3>
                                  <div class="pull-right">
                                    Price : <?= $model[0]['currency']; ?> <?=  number_format((float)$value['price'],2,'.',','); ?> / Unit
                                  </div>

                                </div>
     
                                <div class="box-body">


                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Item Detail</th>
                                                <th>Shipping & Discount</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <dl>
                                                        <dt>Item Name : </dt>
                                                        <dd><?= $value['item']; ?></dd>
                                                        <dt>Specification : </dt>
                                                        <dd><?= $value['specification']; ?></dd>
                                                        <dt>Description : </dt>
                                                        <dd><?= $value['description']; ?></dd>
                                                        <dt>Remark : </dt>
                                                        <dd><?= $value['remark']; ?></dd>
                                                    </dl>
                                              

                                                       
                                                </td>
                                                <td>
                                                    
                                                        <?php if ($value['freight_per_item'] == 'Yes') { ?>

                                                            <dl>
                                                                <dt>Shipping Charge :</dt>
                                                                <dd><?= $model[0]['currency']; ?>
                                                              ?=  number_format((float)$value['freight'],2,'.',','); ?> x  <?= $value['quantity']; ?>
                                                              <?php $totFreight = $value['freight'] * $value['quantity']; ?></dd>
                                                            </dl>
                                                          

                                                        


                                                        <?php } else { ?>

                                                            <dl>
                                                                <dt>Shipping Charge :</dt>
                                                                <dd><?= $model[0]['currency']; ?>
                                                              <?= number_format((float)$value['freight'],2,'.',','); ?></dd>
                                                            </dl>
                                                   

                                                        <?php } ?>

                                                            <dl>
                                                                 <?php if ($value['discount_per_item'] == 'Yes') { ?>

                                            
                                                                    <dt>Discount :</dt>
                                                     

                                                                  <?php if ($value['in_percentage'] == 'Yes') { ?>

                                                                      <dd><?= $value['discount_per_item_value']; ?>%
                                                                      <?php $tempVal = $value['price'] *  $value['quantity'];

                                                                      $totDisPerItem = $tempVal * ($value['discount_per_item_value'] / 100); ?></dd>



                                                                  <?php } else { ?>


                                                                      <?php if ($value['per_item'] == 'Yes') { ?>


                                                                        <dd><?= $model[0]['currency']; ?><?= number_format((float)$value['discount_per_item_value'],2,'.',','); ?> x <?= $value['quantity']; ?>
                                                                          <?php $totDisPerItem = $value['discount_per_item_value'] *  $value['quantity']; ?>
                                                                              
                                                                          </dd>


                                                                      <?php } else { ?>


                                                                         <dd><?= $model[0]['currency']; ?> <?= number_format((float)$value['discount_per_item_value'],2,'.',','); ?>

                                                                            <?php $totDisPerItem = $value['discount_per_item_value']; ?>
                                                                        </dd>


                                                                      <?php } ?>

                                                                  <?php } ?>


                                                            <?php } else { ?>

                                                            <?php } ?>
                                                            </dl>



                                                </td>
                                                <td>

                                                    <dl>
                                                        <dt>Quantity : </dt>
                                                        <dd><?= $quantity = $value['quantity']; ?></dd>
                                                        <dt>Price : </dt>
                                                        <dd>
                                                            <?php $tot = $value['price'] * $quantity;?>
                                                            <?php echo number_format((float)$tot,2,'.',','); ?>
                                                        </dd>
                                                    
                                                        <dt>Discount : </dt>
                                                       <?php if ($value['discount_per_item'] == 'Yes') { ?>

                                                            <?php if ($value['in_percentage'] == 'Yes') { ?>

                                                                  
                                                                <dd>(<?= number_format((float)$totDisPerItem,2,'.',','); ?>)</dd>
                                                                   
                            
                                                           <?php } else { ?>

                                                                <?php if ($value['per_item'] == 'Yes') { ?>

                                                                        <dd>(<?= number_format((float)$totDisPerItem,2,'.',','); ?>)</dd>
                                                                        
                                                                <?php } else { ?>


                                                                        <dd>(<?= number_format((float)$totDisPerItem,2,'.',','); ?>)</dd>
                                                                    

                                                                <?php } ?>




                                                           <?php } ?>

                                                            
                                                       <?php } else { ?>

                                                       <?php } ?>

                                                        
                                                        <?php if ($value['freight_per_item'] == 'Yes') { ?>

                                                        
                                                            <dt>Freight : </dt>
                                                            <dd><?= number_format((float)$totFreight,2,'.',','); ?></dd>

                                                            <br>
                                                            <dt>Total : </dt>
                                                            <dd><ins><?= number_format((float)$tot - $totDisPerItem + $totFreight,2,'.',','); ?></ins></dd>
                                                        
                                                            
                                                            <?php $sumTot += $tot - $totDisPerItem + $totFreight; ?>



                                                        <?php } else { ?>

                                                   
                                                            <dd><?= number_format((float)$value['freight'],2,'.',','); ?></dd>

                                                            <br>
                                                            <dt>Total : </dt>
                                                            <dd><ins><?= number_format((float)$tot - $totDisPerItem + $value['freight'],2,'.',','); ?></ins></dd>
                                                       
                                                            
                                                            <?php $sumTot += $tot - $totDisPerItem + $value['freight']; ?>


                                                        <?php } ?>


                                                        </dl>



                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                            <?php } ?>


                            <div class="box">
                                <div class="box-header with-border">
                                  <h3 class="box-title"></h3>
                                  <div class="pull-right"></div>

                                </div>
     
                                <div class="box-body">

                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>Sub-Total : </th>
                                                <td><?= $subTotal = number_format((float)$sumTot,2,'.',','); ?></td>
                                            </tr>
                                            <tr>

                                              <?php if (empty($model['discount'])) { ?>


                                              <?php } else { ?>

                                                  <?php if ($model['in_percentage_dis'] == 'No') { ?>

                                                        <th>Discount : </th>
                       
                                                        <td><?php $dis = $model['discount'];

                                                        $subDis = $dis;

                                                        echo number_format((float)$subDis,2,'.',','); ?></td>
                     
                                                  <?php } else { ?>

                                                        <th>Discount % : </th>
                                
                                                        <td><?php $dis = $model['discount'] / 100;

                                                        $subDis = $sumTot * $dis;

                                                        echo number_format((float)$subDis,2,'.',','); ?></td>
                               

                                                  <?php } ?>


                                              <?php } ?>
                                            </tr>
                                            <tr>
                                                <th><?php echo empty($model['type_tax']) ? '': $model['type_tax']; ?> <?php echo empty($model['tax']) ? '': $model['tax'].'%' ?></th>
                                                <td>
                                                    <?php if (empty($model['discount'])) { ?>

                                                        <?php $tax = $model['tax'] / 100;

                                                            $subTax = $sumTot * $tax;

                                                        echo number_format((float)$subTax,2,'.',','); ?>
                                               
                                                    <?php } else { ?>

                                       
                                                        <?php $tax = $model['tax'] / 100;

                                                            $val = $sumTot - $subDis;


                                                            $subTax = $val * $tax;

                                                            echo number_format((float)$subTax,2,'.',','); ?>

                                                    <?php } ?>

                                                </td>
                                            </tr>
                                            <tr>
                                                <th>TOTAL</th>
                                                <td>
                                                        <?php if (empty($model['discount'])) { ?>
                                
                                                              <ins><?= $sumTax = number_format((float)$subTax + $sumTot,2,'.',','); ?></ins>

                                                              <?php 


                                                              $totalPay = round($subTax+$sumTot,2); ?>


                                                        <?php } else { ?>

                                                              <?php $val = $sumTot - $subDis; ?>


                                                              <ins><?= $sumTax = number_format((float)$subTax + $val,2,'.',','); ?></ins>

                                                              <?php $totalPay = round($subTax+$val,2); ?>

                                                        <?php } ?>
                                                </td>
                                            </tr>
          



                                        </tbody>
                                    </table>



                                                        









                                </div>
                            </div>










                <?php } ?>


            </div>
        </div>
    </section>





