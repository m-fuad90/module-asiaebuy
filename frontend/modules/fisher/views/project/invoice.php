<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
$this->title = 'IN'.$model->invoice_no.'F';
$this->params['breadcrumbs'][] = ['label' => 'Quotation', 'url' => ['quotation']];
$this->params['breadcrumbs'][] = $this->title;
$currency = [
  'USD'=>'USD',
  'MYR'=>'MYR',
];
$title = 'INVOICE';
?>


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
                        <h2 style="font-size: 22px;font-weight: bold;text-align: center;"><?php echo $title; ?></h2>
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
                              <td style="width: 130px;vertical-align: top;" >
                                  
                                <span style="font-size: 15px;font-weight: bold;">
                                  IN<?= $model->invoice_no ?>F

                                </span>
                                
                              </td>
                          </tr>
                          <?php if ($model->diff_add_info == 'Yes') { ?>
                          <tr>
                              <td style="width: 70px;vertical-align: top;"><span style="font-size: 15px;"></span></td>
                              <td style="width: 5px;vertical-align: top;"><span style="font-size: 15px;"></span></td>
                              <td colspan="4">
                                <span style="font-size: 15px;">
                                  <b>Contact No</b> : <?= $model->contact_no ?>
                                </span>
                              </td>
                          </tr>
                          <tr>
                              <td style="width: 70px;vertical-align: top;"><span style="font-size: 15px;"></span></td>
                              <td style="width: 5px;vertical-align: top;"><span style="font-size: 15px;"></span></td>
                              <td colspan="4">
                                <span style="font-size: 15px;">
                                <b>Email</b> : <?= $model->email ?>
                                </span>
                              </td>
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
                              <td style="vertical-align: top;width: 130px;"><span style="font-size: 15px;"><?= $model->date_invoice; ?></span></td>

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
                          <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Payment Type</td>
                            <td>:</td>
                            <td><?php echo $model->payment_type; ?></td>

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
                            <td style="text-align: right"; ><span style="font-size: 15px;"><?= $subTotal = number_format((float)$sumTot,2,'.',','); ?></span></td>
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

                              <td style="text-align: right";>
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
                            <td style="text-align: right";>
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
                            <td style="text-align: right";>
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


                    </div>
                    <div class="print">
                        
                        
                      <a class="btn-print" id="printPageButton" onclick="javascript:window.print();" title="Print">PRINT</a>



                    </div>

