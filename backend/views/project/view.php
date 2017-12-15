<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Project */

$this->title = $model->quotation_no;
$this->params['breadcrumbs'][] = ['label' => 'Quotation', 'url' => ['quotation']];
$this->params['breadcrumbs'][] = $this->title;
$currency = [
  'USD'=>'USD',
  'MYR'=>'MYR',
];
$qt_title = 'QUOTATION';
?>
    <section class="content-header">
      <h1>
          View Quotation : QT<?= Html::encode($this->title) ?>
      </h1>

    </section>  

                <style type="text/css">
                  

                body {
                  background: rgb(255, 255, 255); 
                }
                page {
                  background: white;
                  display: block;
                  margin: 0 auto;
                  margin-bottom: 0.5cm;
                  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
                }
                page[size="A4"] {  
                  width: 21cm;
                  height: auto; 
                  padding: 5mm;
                }
                page[size="A4"][layout="portrait"] {
                  width: 29.7cm;
                  height: 21cm;  
                }
                page[size="A3"] {
                  width: 29.7cm;
                  height: 42cm;
                }
                page[size="A3"][layout="portrait"] {
                  width: 42cm;
                  height: 29.7cm;  
                }
                page[size="A5"] {
                  width: 14.8cm;
                  height: 21cm;
                }
                page[size="A5"][layout="portrait"] {
                  width: 21cm;
                  height: 14.8cm;  
                }
                @media print {
                  body, page {
                    margin: 0;
                    box-shadow: 0;
                  }
                }
                 @page {
                  size: auto;
                  margin: 0;
                       }

                tr.border_bottom td {
                  border-bottom: 1px solid rgba(0, 0, 0, 0.1);


                }

                @media print {
                  #printPageButton {
                    display: none;
                  }
                }

                .print {
                  margin-top: 20px;
                  text-align: right;
                  

                }

                .btn-print {
                    padding: 10;
                    color: #ffffff;
                    font-size: 14px;
                    cursor: pointer;
                    background-color: #1e88e5;
                }
                </style>


    <section class="content">
        <div class="row">
            <div class="col-md-12">



            <body >
                <page size="A4">


                    <div>
                        <span style="font-size: 30px;font-weight: bold;"><?= $asiaebuy->company; ?></span>
                        <span style="font-size: 11px;">Co.No. : <?= $asiaebuy->company_no; ?></span>


                        <br>
                        <span style="font-size: 15px;">
                          <?= $asiaebuy->address; ?>
         
                        </span>
                        <br>
                        <span style="font-size: 15px;">
                          <span style="font-size: 15px;font-weight: bold;">TEL : </span> <?= $asiaebuy->telephone_no; ?>
                          &nbsp;
                          <span style="font-size: 15px;font-weight: bold;">EMAIL : </span> <?= $asiaebuy->email; ?>

                        </span>


                    </div>

                    <p></p>
                    <br>
                    <div>
                        <h2 style="font-size: 22px;font-weight: bold;text-align: center;"><?php echo $qt_title; ?></h2>
                    </div>
                    <hr style="   border: 0;
                        height: 0;
                        border-top: 1px solid rgba(0, 0, 0, 0.1);
                        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
                        ">
                    <p></p>
                    <br>

                    <div>
                      <table border="0" width="100%">
                          <tr>
                              <td style="width: 130px;vertical-align: top;"><span style="font-size: 15px;">To</span></td>
                              <td style="width: 5px;vertical-align: top;"><span style="font-size: 15px;">:</span></td>
                              <td style="width: 430px;">
                             
                                <span style="font-size: 15px;">
                                <?php if (empty($model->company_name)) { ?>

                                    <?= $model->name ?>

                                <?php } else { ?>

                                    <?=  $model->company_name ?>

                                <?php } ?>
                                </span>

                                                    
                              </td>
                              <td style="width: 80px;vertical-align: top;"><span style="font-size: 15px;">No.</span></td>
                              <td style="width: 5px;vertical-align: top;"><span style="font-size: 15px;">:</span></td>
                              <td style="width: 130px;vertical-align: top;">
                                  
                                <span style="font-size: 15px;font-weight: bold;">
                                  QT <?= $model->quotation_no ?><?php if (empty($model->revise)) { ?><?php } else { ?>-R<?= $model->reviseCount ?><?php } ?>

                                    
                                  </span>
                                
                              </td>
                          </tr>
                          <?php if ($model->diff_add_info == 'Yes') { ?>
                          <tr>
                              <td style="width: 70px;vertical-align: top;"><span style="font-size: 15px;"></span></td>
                              <td style="width: 5px;vertical-align: top;"><span style="font-size: 15px;"></span></td>
                              <td colspan="4"><b>Contact No</b> : <?= $model->contact_no ?></td>
                          </tr>
                          <tr>
                              <td style="width: 70px;vertical-align: top;"><span style="font-size: 15px;"></span></td>
                              <td style="width: 5px;vertical-align: top;"><span style="font-size: 15px;"></span></td>
                              <td colspan="4"><b>Email</b> : <?= $model->email ?></td>
                          </tr>
                          <?php } else { ?>

                          <?php } ?>



                          <tr >
                              <td style="width: 130px;vertical-align: top;" rowspan="3"><span style="font-size: 15px;" >Delivery Address</span></td>
                              <td style="width: 5px;vertical-align: top;" rowspan="3">:</td>
                              <td style="width: 430px;" rowspan="3" valign="top">

                                <span style="font-size: 15px;">
                                <?php if ($model->diff_add_info == 'No') { ?>

                                    <?= $model->address ?>, <?= $model->postcode ?>, <?= $model->city ?>, <?= $model->province ?> , <?= $model->country ?>

                                    <br>
                                    <b>P.I.C</b> : <?= $model->name ?>
                                    <br>
                                    <b>Contact No</b> : <?= $model->contact_no ?>
                                    <br>
                                    <b>Email</b> : <?= $model->email ?>

                                <?php } else { ?>

                                    <?php if (empty($model->diff_company)) { ?>
                                      
                                    <?php } else { ?>
                                      <?= $model->diff_company ?>
                                      <br>
                                    <?php } ?>

                                    <?= $model->diff_address ?>, <?= $model->diff_postcode ?>, <?= $model->diff_city ?>, <?= $model->diff_province ?> , <?= $model->diff_country ?>

                                    <br>
                                    <b>P.I.C</b> : <?= $model->diff_name ?>


                                <?php } ?>
                                </span>


                              </td>
                              <td style="vertical-align: top;width: 80px;"><span style="font-size: 15px;">Date</span></td>
                              <td style="width: 5px;vertical-align: top;"><span style="font-size: 15px;">:</span></td>
                              <td style="vertical-align: top;width: 130px;"><span style="font-size: 15px;"><?= $model->date_quotation; ?></span></td>

                          </tr>

                          <tr>

                              <td style="vertical-align: top;width: 80px;"><span style="font-size: 15px;">Validity</span></td>
                              <td style="width: 5px;vertical-align: top;"><span style="font-size: 15px;">:</span></td>
                              <td style="vertical-align: top;width: 130px;"><span style="font-size: 15px;">
                                
                                  <?php if (empty($model->validity)) { ?>


                                        <?php echo 'Empty'; ?>

                                    
                                  <?php } else { ?>


                                        <?php echo $model->validity; ?>


                                  <?php } ?>



                                </span></td>
                          </tr>
                          <tr>

                              <td style="vertical-align: top;width: 80px;"><span style="font-size: 15px;">Lead Time</span></td>
                              <td style="width: 5px;vertical-align: top;"><span style="font-size: 15px;">:</span></td>
                              <td style="vertical-align: top;width: 130px;">

                              <span style="font-size: 15px;">

                                  <?php if (empty($model->lead_time)) { ?>


                                        <?php echo 'Empty'; ?>
                                    
                                  <?php } else { ?>

                                        <?php echo $model->lead_time; ?>


                                
                                  <?php } ?>


                                    
                              </span>
           
                              </td>
                          </tr>


                      </table>
                    </div>
                    <p></p>
                    <br>

                    <div>

                        
                      <table width="100%" border="0" >
                          <tr>
                              <td style="padding: 10px;background-color: #dedede;"><span style="font-size: 15px;font-weight: bold;">NO</span></td>
                              <td style="padding: 10px;background-color: #dedede;""><span style="font-size: 15px;font-weight: bold;">ITEM</span></td>
                              <td style="padding: 10px;text-align: right;background-color: #dedede;""><span style="font-size: 15px;font-weight: bold;">CAT#</span></td>
                              <td style="padding: 10px;text-align: right;background-color: #dedede;""><span style="font-size: 15px;font-weight: bold;">QTY</span></td>
                              <td style="padding: 10px;text-align: right;background-color: #dedede;""><span style="font-size: 15px;font-weight: bold;">U / PRICE (<?= $model->currency?>)</span></td>
                              <td style="padding: 10px;text-align: right;background-color: #dedede;""><span style="font-size: 15px;font-weight: bold;">TOTAL (<?= $model->currency?>)</span></td>

                            
                          </tr>


                          <?php if (empty($model['data'])) { ?>
                              <tr class="border_bottom">
                                  <td colspan="6">
                                    No Data
                                  </td>
                                
                              </tr>
                          <?php } else { ?>

                            <?php $arrayItem = -1; $i=0; foreach ($model['data'] as $key_qt => $value_qt) { $i++; $arrayItem++; ?>
                              <tr >
                                  <td style="padding: 10px;width: 5px;" valign="top">
                                    <?= $i; ?>
                                  </td>
                                  <td style="padding: 10px;width: 150px;">

                                    <dl>
                                        <dt>Catalog No : </dt>
                                        <dd>

                                            <?= empty($value_qt['item']) ? $value_qt['catalog_no'] : $value_qt['item']; ?>
                                        </dd>
                                        <dt>Description : </dt>
                                        <dd>
                                            <?php if (empty($value_qt['description'])) { ?>
                              
                                            <?php } else { ?>

                                                <?= $value_qt['description']; ?>

                                            <?php } ?>
                                        </dd>
                                        <dt>Specification : </dt>
                                        <dd>
                                            <?php if (empty($value_qt['specification'])) { ?>
                              
                                            <?php } else { ?>

                                                <?= $value_qt['specification']; ?>

                                            <?php } ?>
                                        </dd>
                                        <dt>Shipping Charge : </dt>
                                        <dd>
                                            <?php if ($value_qt['freight_per_item'] == 'Yes') { ?>

                                                <?= $models->currency?> 
                                                <?=  number_format((float)$value_qt['freight'],2,'.',','); ?> x  <?= $value_qt['quantity']; ?>

                                                <?php $totFreight = $value_qt['freight'] * $value_qt['quantity']; ?>
                                      
                                            <?php } else { ?>

                                                <?= $models->currency?>
                                                <?= number_format((float)$value_qt['freight'],2,'.',','); ?>

                                                <?php $totFreight = $value_qt['freight']; ?>

                                            <?php } ?>
                                        </dd>
                                        <?php if ($value_qt['discount_per_item'] == 'Yes') { ?>

                                        <dt>Discount : </dt>
                                        <dd>
                                            <?php if ($value_qt['discount_per_item'] == 'Yes') { ?>

                                                <?php if ($value_qt['in_percentage'] == 'Yes') { ?>


                                                        <?= $value_qt['discount_per_item_value']; ?>%
                                                        <?php $tempVal = $value_qt['price'] *  $value_qt['quantity'];

                                                        $totDisPerItem = $tempVal * ($value_qt['discount_per_item_value'] / 100); ?>

                                                <?php } else { ?>

                                                      <?php if ($value_qt['per_item'] == 'Yes') { ?>

                                                          <?= $models->currency?>
                                                          <?= number_format((float)$value_qt['discount_per_item_value'],2,'.',','); ?> x <?= $value_qt['quantity']; ?>
                                                          <?php $totDisPerItem = $value_qt['discount_per_item_value'] *  $value_qt['quantity']; ?>

                                                      <?php } else { ?>

                                                          <?= $models->currency?>
                                                          <?= number_format((float)$value_qt['discount_per_item_value'],2,'.',','); ?>

                                                          <?php $totDisPerItem = $value_qt['discount_per_item_value']; ?>

                                                      <?php } ?>

                                                <?php } ?>

                                            <?php } else { ?>

                                              <?php $totDisPerItem = 0; ?>

                                            <?php } ?>
                                        </dd>
                                        <?php } else { ?>

                                        <?php } ?>



                                    </dl>


                                  </td>
                                  <td style="padding: 10px;width: 50px;text-align: right;">
                                    <?= $value_qt['catalog_no']; ?>
                                  </td>
                                  <td style="padding: 10px;width: 5px;text-align: right;">
                                    <?= $quantity = $value_qt['quantity']; ?>
                                  </td>
                                  <td style="padding: 10px;width: 90px;text-align: right;">
                                     <?= $price = number_format((float)$value_qt['price'],2,'.',','); ?>

                                  </td>
                                  <td style="padding: 10px;width: 80px;text-align: right;">

                                      <dl>
                                          <dd>
                                            <?php $tot = $value_qt['price'] * $quantity;?>
                                            <?php echo number_format((float)$tot,2,'.',','); ?>
                                          </dd>
                                          <dd class="text-green">
                                              <?php if ($value_qt['discount_per_item'] == 'Yes') { ?>

                                              <?php if ($value_qt['in_percentage'] == 'Yes') { ?>

                                                          ( <?= number_format((float)$totDisPerItem,2,'.',','); ?> )

                                             <?php } else { ?>

                                                  <?php if ($value_qt['per_item'] == 'Yes') { ?>

                                                          ( <?= number_format((float)$totDisPerItem,2,'.',','); ?> )

                                                  <?php } else { ?>

                                                          ( <?= number_format((float)$totDisPerItem,2,'.',','); ?> )

                                                  <?php } ?>

                                             <?php } ?>

                                            
                                             <?php } else { ?>

                                                 <?php $totDisPerItem = 0; ?>

                                             <?php } ?>
                                          </dd>
                                          <dd>
                                              <?php if ($value_qt['freight_per_item'] == 'Yes') { ?>

                                              
                                                <p class="text-red"><?= number_format((float)$totFreight,2,'.',','); ?></p>
             
                                                <ins><b><?= number_format((float)$tot - $totDisPerItem + $totFreight,2,'.',','); ?></b></ins>
                                              

                                              <?php $sumTot += $tot - $totDisPerItem + $totFreight; ?>
                                      
                                            <?php } else { ?>

                                              <p class="text-red"><?= number_format((float)$totFreight,2,'.',','); ?></p>
                                              
                                              <ins><b><?= number_format((float)$tot - $totDisPerItem + $totFreight,2,'.',','); ?></b></ins>
                                          
                                              <?php $sumTot += $tot - $totDisPerItem + $totFreight; ?>

                                            <?php } ?>
                                          </dd>
                                      </dl>



                                  </td>


                              </tr>
                              <tr class="border_bottom">
                                <td></td>
                                <td style="padding: 10px;" colspan="5">
                                    <?php if (empty($value_qt['remark'])) { ?>
                                      
                                    <?php } else { ?>

                                      <dl>
                                          <dt>Remark :</dt>
                                          <dd><?= $value_qt['remark']; ?></dd>
                                      </dl>
                                      
                                    <?php } ?>
                                    
                                </td>
                   
                              </tr>

                            <?php } ?>





                          <?php } ?>



                          
                      </table>
                    </div>
                    <br>

                    <div>
                        <table width="100%" border="0">


                        <?php if (empty($model->remark_all)) { ?>

                        <?php } else { ?>


                          <tr>
                            <td colspan="5" class="text-left">
                              <span style="font-size: 15px;" >

                                Remark : 

                                    <?php echo $model->remark_all; ?>

                              </span>
                            </td>
             
                          </tr>


                        
                        <?php } ?>



                          <tr>
                            <td colspan="4" class="text-left"><span style="font-size: 15px;font-weight: bold;">Sub-Total</span></td>
                            <td class="text-right"><span style="font-size: 15px;"><?= $subTotal = number_format((float)$sumTot,2,'.',','); ?></span></td>
                          </tr>

                          <?php if (empty($model->discount)) { ?>
                              
                          <?php } else { ?>


                          <tr>
                              <td colspan="4" class="text-left">
                                <span style="font-size: 15px;">


                                <?php if ($model->in_percentage_dis == 'No') { ?>


                                  <?= empty($model->discount) ? '<span class="">Discount</span>': '<span class="">Discount ( '.$model->currency.' '.$model->discount.' )</span>'; ?>

                                  
                                <?php } else { ?>


                                    <?= empty($model->discount) ? '<span class="">Discount</span>': '<span class="">Discount ( '.$model->discount.' % )</span>'; ?>


                                <?php } ?>


                                
     
                                          
                                </span>

                              </td>

                              <td  class="text-right">
                                <span style="font-size: 15px;" class="text-green">

                                <?php if (empty($model->discount)) { ?>

                                    <?= '0.00'; ?>
                                    
                                <?php } else { ?>


                                        <?php if ($model->in_percentage_dis == 'No') { ?>

                                            <span style="font-size: 15px;" class="">

                                              - <?php $dis = $model->discount;

                                                $subDis = $dis;

                                                echo number_format((float)$subDis,2,'.',',');
                                                

                                               ?>
                                            </span>


                                        <?php } else { ?>


                                            <span style="font-size: 15px;" class="">
                                              - <?php $dis = $model->discount / 100;

                                                $subDis = $sumTot * $dis;

                                                echo number_format((float)$subDis,2,'.',',');
                                                

                                               ?>
                                            </span>



                                        <?php } ?>


                                <?php } ?>
                    
                                </span>
                              </td>
                          </tr>

                          <?php  } ?>



                          <?php if (empty($model->type_tax)) { ?>

                          <?php } else { ?>

                          <tr>
                            <td colspan="4" class="text-left">
                              <span style="font-size: 15px;" > 

                              <?php echo empty($model->type_tax) ? 'Tax' : $model->type_tax; ?>

                              <?php echo empty($model->tax) ? '%': $model->tax.'%' ?>




                            </span></td>
                            <td class="text-right">
                              <span style="font-size: 15px;" class="text-red">

                                <?php if (empty($model->discount)) { ?>

                                  <?php $tax = $model->tax / 100;

                                  $subTax = $sumTot * $tax;

                                  echo number_format((float)$subTax,2,'.',','); ?>
                               
                                <?php } else { ?>

                                  <?php $tax = $model->tax / 100;

                                  $val = $sumTot - $subDis;


                                  $subTax = $val * $tax;

                                  echo number_format((float)$subTax,2,'.',','); ?>

                                <?php } ?>

                              </span></td>
                          </tr>


                          

                          <?php } ?>






                          <tr>
                            <td colspan="4" class="text-left"><span style="font-size: 20px;font-weight: bold;">Total</span></td>
                            <td class="text-right">
                              <span style="font-size: 20px;" class="">
                                <b>

                              <?php if (empty($model->discount)) { ?>
                                
                                <?= $sumTax = number_format((float)$subTax + $sumTot,2,'.',','); ?>


                              <?php } else { ?>

                                <?php $val = $sumTot - $subDis; ?>


                                <?= $sumTax = number_format((float)$subTax + $val,2,'.',','); ?>

                              <?php } ?>

                            </b>
                              
                            </span></td>
                          </tr>

                        </table>
                        <br>


                        <?php if (empty($model->unable)) { ?>

                        <?php if ($country_user == 129) { ?>

                          <?php if ($sumTax < 200) { ?>

                          <span class="text-red" >* Order Is Less Than RM200.00, Extra Processing Fee Of RM50.00 Will Be Charged Upon Checkout.</span>

                          <?php } else { ?>

                          <?php } ?>


                        <?php } elseif ($country_user == 209 || $country_user == 100 || $country_user == 168 || $country_user == 230 || $country_user == 188 || $country_user == 36 || $country_user == 116 || $country_user == 32) { ?>

                          <?php if ($sumTax < 100) { ?>

                          <span class="text-red">* Order Is Less Than 100.00 USD, Extra Processing Fee Of 20.00 USD Will Be Charged. Upon Checkout.</span>


                          <?php } else { ?>

                          <?php } ?>



                        <?php } else { ?>

                          <?php if ($sumTax < 100) { ?>

                          <span class="text-red" >* Order Is Less Than 100.00 USD, Extra Processing Fee Of 20.00 USD Will Be Charged. Upon Checkout.</span>


                          <?php } else { ?>

                          <?php } ?>


                        
                        <?php } ?>



                        

                        <?php } else { ?>

                            <span class="text-red">* <?php echo $model->unable; ?></span>

                        <?php } ?>




                    </div>
                    <div class="print">
                        
                        




                    </div>




                </page>


          
            </body>



        </div>

    </div>

  </section>