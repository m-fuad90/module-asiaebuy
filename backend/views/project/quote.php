<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;



/* @var $this yii\web\View */
/* @var $model backend\models\Project */

$this->title = 'Quote';

$this->params['breadcrumbs'][] = ['label' => 'RFQ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$script = <<< JS
$(document).ready(function(){


    $('.addItem').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });
    $('.editItem').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });
    $('.editTax').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });
    $('.editDiscount').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });
    $('.editLead').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });
    $('.editValidity').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });
    $('.editRemark').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });


    $('#currency').on('change', function() {
        var val = this.value;
        var project = $(this).find(':selected').data('id');

        $.ajax({
            type: 'POST',
            url: 'currency',
            data: 'val='+val+'&project='+project,
            success: function(data) {
                location.reload();
   

            }

        })

    });



}); 
JS;
$this->registerJs($script);

$currency = [
  'USD'=>'USD',
  'MYR'=>'MYR',

];

$qt_title = 'QUOTATION';

?>

    <section class="content-header">
      <h1>
        <?= Html::encode($this->title) ?>
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

                  <?php if(Yii::$app->session->hasFlash('save')) { ?>
                      <div class="alert alert-success alert-dismissible">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                           <?php echo  Yii::$app->session->getFlash('save'); ?>
                      </div>


                  <?php } ?>
                  <?php if(Yii::$app->session->hasFlash('tax')) { ?>
                      <div class="alert alert-success alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                           <?php echo  Yii::$app->session->getFlash('tax'); ?>
                      </div>
                  <?php } ?>
                  <?php if(Yii::$app->session->hasFlash('edit')) { ?>
                      <div class="alert alert-info alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                           <?php echo  Yii::$app->session->getFlash('edit'); ?>
                      </div>
                  <?php } ?>
                  <?php if(Yii::$app->session->hasFlash('remark')) { ?>
                      <div class="alert alert-info alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                           <?php echo  Yii::$app->session->getFlash('remark'); ?>
                      </div>
                  <?php } ?>
                  <?php if(Yii::$app->session->hasFlash('lead')) { ?>
                      <div class="alert alert-info alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                           <?php echo  Yii::$app->session->getFlash('lead'); ?>
                      </div>
                  <?php } ?>
                  <?php if(Yii::$app->session->hasFlash('validity')) { ?>
                      <div class="alert alert-info alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                           <?php echo  Yii::$app->session->getFlash('validity'); ?>
                      </div>
                  <?php } ?>
                  <?php if(Yii::$app->session->hasFlash('delete')) { ?>
                      <div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                           <?php echo  Yii::$app->session->getFlash('delete'); ?>
                      </div>
                  <?php } ?>





                    <div>
                        <span style="font-size: 30px;font-weight: bold;"><?= $asiaebuy->company; ?></span>
                        <span style="font-size: 11px;">Co.No. : <?= $asiaebuy->company_no; ?></span>

                        <span class="pull-right">

                            <select class="form-control currency" id="currency">
                                <?php foreach ($currency as $key_currency => $value_currency) { ?>

                                  <option data-id="<?= $models->_id ?>" value="<?= $value_currency ?>" <?php echo ($value_currency == $models->currency) ? ' selected="selected"' : '';?> ><?= $value_currency ?></option>



                                <?php } ?>

      
                            </select>
     


                        </span>


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
       
   

                    <div>
                      <table border="0" width="100%">
                          <tr>
                              <td style="width: 70px;vertical-align: top;"><span style="font-size: 15px;">To</span></td>
                              <td style="width: 5px;vertical-align: top;"><span style="font-size: 15px;">:</span></td>
                              <td style="width: 430px;">
                             
                                <span style="font-size: 15px;">
                                <?php if (empty($models->company_name)) { ?>

                                    <?= $models->name ?>

                                <?php } else { ?>

                                    <?=  $models->company_name ?>

                                <?php } ?>
                                </span>

                                                    
                              </td>
                              <td style="width: 80px;vertical-align: top;"><span style="font-size: 15px;">No.</span></td>
                              <td style="width: 5px;vertical-align: top;"><span style="font-size: 15px;">:</span></td>
                              <td style="width: 130px;vertical-align: top;">
                                  
                                <span style="font-size: 15px;font-weight: bold;">QT <?= $models->quotation_no ?></span>
                                
                              </td>
                          </tr>
                          <?php if ($models->diff_add_info == 'Yes') { ?>
                          <tr>
                              <td style="width: 70px;vertical-align: top;"><span style="font-size: 15px;"></span></td>
                              <td style="width: 5px;vertical-align: top;"><span style="font-size: 15px;"></span></td>
                              <td colspan="4">
                                <span style="font-size: 15px;">
                                  <b>Contact No</b> : <?= $models->contact_no ?>
                                </span>
                              </td>
                          </tr>
                          <tr>
                              <td style="width: 70px;vertical-align: top;"><span style="font-size: 15px;"></span></td>
                              <td style="width: 5px;vertical-align: top;"><span style="font-size: 15px;"></span></td>
                              <td colspan="4">
                                <span style="font-size: 15px;">
                                <b>Email</b> : <?= $models->email ?>
                                </span>
                              </td>
                          </tr>
                          <?php } else { ?>

                          <?php } ?>



                          <tr >
                              <td style="width: 70px;vertical-align: top;" rowspan="3"><span style="font-size: 15px;" >Address</span></td>
                              <td style="width: 5px;vertical-align: top;" rowspan="3">:</td>
                              <td style="width: 430px;" rowspan="3" valign="top">

                                <span style="font-size: 15px;">
                                <?php if ($models->diff_add_info == 'No') { ?>

                                    <?= $models->address ?>, <?= $models->postcode ?>, <?= $models->city ?>, <?= $models->province ?> , <?= $models->country ?>

                                    <br>
                                    <b>P.I.C</b> : <?= $models->name ?>
                                    <br>
                                    <b>Contact No</b> : <?= $models->contact_no ?>
                                    <br>
                                    <b>Email</b> : <?= $models->email ?>

                                <?php } else { ?>

                                    <?php if (empty($models->diff_company)) { ?>
                                      
                                    <?php } else { ?>
                                      <?= $models->diff_company ?>
                                      <br>
                                    <?php } ?>

                                    <?= $models->diff_address ?>, <?= $models->diff_postcode ?>, <?= $models->diff_city ?>, <?= $models->diff_province ?> , <?= $models->diff_country ?>

                                    <br>
                                    <b>P.I.C</b> : <?= $models->diff_name ?>


                                <?php } ?>
                                </span>


                              </td>
                              <td style="vertical-align: top;width: 80px;"><span style="font-size: 15px;">Date</span></td>
                              <td style="width: 5px;vertical-align: top;"><span style="font-size: 15px;">:</span></td>
                              <td style="vertical-align: top;width: 130px;"><span style="font-size: 15px;"><?= $models->date_quotation; ?></span></td>

                          </tr>

                          <tr>

                              <td style="vertical-align: top;width: 80px;"><span style="font-size: 15px;">Validity</span></td>
                              <td style="width: 5px;vertical-align: top;"><span style="font-size: 15px;">:</span></td>
                              <td style="vertical-align: top;width: 130px;"><span style="font-size: 15px;">
                                
                                  <?php if (empty($models->validity)) { ?>


                                        <?= Html::a('{Validity}',FALSE, ['value'=>Url::to([
                                        'project/validity',
                                        'project'=> (string)$models->_id,
                                        'location' => 'quote'
            
                                        ]),
                                        'class' => 'editValidity',
                                        'id'=>'editValidity',
                                        'style'=>'cursor:pointer;',
                                        'data-target'=>'#m_modal_5',
                                        'data-toggle'=>'modal'

                                        ]) ?>
                                    
                                  <?php } else { ?>


                                        <?= Html::a($models->validity,FALSE, ['value'=>Url::to([
                                        'project/validity',
                                        'project'=> (string)$models->_id,
                                        'location' => 'quote'
            
                                        ]),
                                        'class' => 'editValidity',
                                        'id'=>'editValidity',
                                        'style'=>'cursor:pointer;',
                                        'data-target'=>'#m_modal_5',
                                        'data-toggle'=>'modal'

                                        ]) ?>




                                  <?php } ?>



                                </span></td>
                          </tr>
                          <tr>

                              <td style="vertical-align: top;width: 80px;"><span style="font-size: 15px;">Lead Time</span></td>
                              <td style="width: 5px;vertical-align: top;"><span style="font-size: 15px;">:</span></td>
                              <td style="vertical-align: top;width: 130px;">

                              <span style="font-size: 15px;">

                                  <?php if (empty($models->lead_time)) { ?>


                                        <?= Html::a('{Lead Time}',FALSE, ['value'=>Url::to([
                                        'project/lead',
                                        'project'=> (string)$models->_id,
                                        'location' => 'quote'
            
                                        ]),
                                        'class' => 'editLead',
                                        'id'=>'editLead',
                                        'style'=>'cursor:pointer;',
                                        'data-target'=>'#m_modal_5',
                                        'data-toggle'=>'modal'



                                        ]) ?>
                                    
                                  <?php } else { ?>

                                        <?= Html::a($models->lead_time,FALSE, ['value'=>Url::to([
                                        'project/lead',
                                        'project'=> (string)$models->_id,
                                        'location' => 'quote'
            
                                        ]),
                                        'class' => 'editLead',
                                        'id'=>'editLead',
                                        'style'=>'cursor:pointer;',
                                        'data-target'=>'#m_modal_5',
                                        'data-toggle'=>'modal'

                                        ]) ?>

                                 

                                  <?php } ?>
                                    
                              </span>
           
                              </td>
                          </tr>

                      </table>
                    </div>
                    <p></p>
                    <br>

                    <div>



                        <span class="">

                          <?= Html::a('Add Item',FALSE, ['value'=>Url::to([
                                    'project/add',
                                    'project'=> (string)$models->_id,
                                    'location' => 'quote'
        
                                    ]),
                                    'class' => 'addItem',
                                    'id'=>'addItem',
                                    'style'=>'cursor:pointer;',
                                    'data-target'=>'#m_modal_4',
                                    'data-toggle'=>'modal'

                                    ]) ?>

                         

                        </span>
                        
                      <table width="100%" border="0" >
                          <tr>
                              <td style="padding: 10px;background-color: #dedede;"><span style="font-size: 15px;font-weight: bold;">NO</span></td>
                              <td style="padding: 10px;background-color: #dedede;""><span style="font-size: 15px;font-weight: bold;">ITEM</span></td>
                              <td style="padding: 10px;text-align: right;background-color: #dedede;""><span style="font-size: 15px;font-weight: bold;">CAT#</span></td>
                              <td style="padding: 10px;text-align: right;background-color: #dedede;""><span style="font-size: 15px;font-weight: bold;">QTY</span></td>
                              <td style="padding: 10px;text-align: right;background-color: #dedede;""><span style="font-size: 15px;font-weight: bold;">U / PRICE (<?= $models->currency?>)</span></td>
                              <td style="padding: 10px;text-align: right;background-color: #dedede;""><span style="font-size: 15px;font-weight: bold;">TOTAL (<?= $models->currency?>)</span></td>
                              <td style="padding: 10px;text-align: right;background-color: #dedede;""><span style="font-size: 15px;font-weight: bold;">ACTION</span></td>
                              

                          </tr>


                          <?php if (empty($models['data'])) { ?>
                              <tr class="border_bottom">
                                  <td colspan="6">
                                    No Data
                                  </td>
                                
                              </tr>
                          <?php } else { ?>

                            <?php $arrayItem = -1; $i=0; foreach ($models['data'] as $key_qt => $value_qt) { $i++; $arrayItem++; ?>
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
                                  <td style="padding: 10px;width: 10px;text-align: right;">

                                    <?= Html::a('<i class="fa fa-edit"></i>',FALSE, ['value'=>Url::to([
                                    'project/edit',
                                    'arrayItem' => $arrayItem,
                                    'project' => (string)$models->_id,
                                    'catalog_no'=> $value_qt['catalog_no'],
                                    'location' => 'quote'
        
                                    ]),
                                    'class' => 'btn btn-warning editItem',
                                    'id'=>'editItem',
                                    'style'=>'cursor:pointer;',
                                    'data-target'=>'#m_modal_4',
                                    'data-toggle'=>'modal'

                                    ]) ?>


                                    <?= Html::a('<i class="fa fa-trash-o"></i>', 
                                      [
                                      'project/delete', 
                                      'project' => (string)$models->_id,
                                      'catalog_no'=> $value_qt['catalog_no'],
                                      'location' => 'quote'
                                      ], 
                                      [
                                          'class' => 'btn btn-danger',
                                          'data' => [
                                              'confirm' => 'Are you sure you want to delete this item?',
                                              'method' => 'post',
                                          ],
                                      ]) ?>


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
                                <td></td>
                              </tr>

                            <?php } ?>





                          <?php } ?>



                          
                      </table>
                    </div>
                    <br>

                    <div>
                        <table width="100%" border="0">


                          <tr>
                            <td colspan="5" class="text-left">
                              <span style="font-size: 15px;">

                                <?php if (empty($models->remark_all)) { ?>


                                        <?= Html::a('Remark',FALSE, ['value'=>Url::to([
                                        'project/remark',
                                        'project'=> (string)$models->_id,
                                        'location' => 'quote'
            
                                        ]),
                                        'class' => 'editRemark',
                                        'id'=>'editRemark',
                                        'style'=>'cursor:pointer;',
                                        'data-target'=>'#m_modal_1',
                                        'data-toggle'=>'modal'

                                        ]) ?>
                                  
                                <?php } else { ?>

                                      Remark : 

                                     <?= Html::a($models->remark_all,FALSE, ['value'=>Url::to([
                                        'project/remark',
                                        'project'=> (string)$models->_id,
                                        'location' => 'quote'
            
                                        ]),
                                        'class' => 'editRemark',
                                        'id'=>'editRemark',
                                        'style'=>'cursor:pointer;',
                                        'data-target'=>'#m_modal_1',
                                        'data-toggle'=>'modal'

                                        ]) ?>

                                <?php } ?>

                              </span>
                            </td>
             
                          </tr>

                          <tr>
                            <td colspan="4" class="text-left"><span style="font-size: 15px;font-weight: bold;">Sub-Total</span></td>
                            <td class="text-right"><span style="font-size: 15px;"><?= $subTotal = number_format((float)$sumTot,2,'.',','); ?></span></td>
                          </tr>
                          <tr>
                            <td colspan="4" class="text-left">
                              <span style="font-size: 15px;">

                                <?php if ($models->in_percentage_dis == 'No') { ?>


                                  <?= Html::a(empty($models->discount) ? 'Discount': 'Discount ( '.$models->currency.' '.$models->discount.' )',FALSE, ['value'=>Url::to([
                                    'project/discount',
                                    'project'=> (string)$models->_id,
                                    'location' => 'quote'
        
                                    ]),
                                    'class' => 'editDiscount',
                                    'id'=>'editDiscount',
                                    'style'=>'cursor:pointer;',
                                    'data-target'=>'#m_modal_5',
                                    'data-toggle'=>'modal'



                                    ]) ?>

                                  
                                <?php } else { ?>


                              <?= Html::a(empty($models->discount) ? 'Discount': 'Discount ( '.$models->discount.' % )',FALSE, ['value'=>Url::to([
                                    'project/discount',
                                    'project'=> (string)$models->_id,
                                    'location' => 'quote'
        
                                    ]),
                                    'class' => 'editDiscount',
                                    'id'=>'editDiscount',
                                    'style'=>'cursor:pointer;',
                                    'data-target'=>'#m_modal_5',
                                    'data-toggle'=>'modal'



                                    ]) ?>


                                <?php } ?>


                                    </span>

                                  </td>

                            <td  class="text-right">
                              <span style="font-size: 15px;" class="text-green">

                                <?php if (empty($models->discount)) { ?>

                                    <?= '0.00'; ?>
                                    
                                <?php } else { ?>


                                        <?php if ($models->in_percentage_dis == 'No') { ?>

                                            <span style="font-size: 15px;" class="">

                                              - <?php $dis = $models->discount;

                                                $subDis = $dis;

                                                echo number_format((float)$subDis,2,'.',',');
                                                

                                               ?>
                                            </span>


                                        <?php } else { ?>


                                            <span style="font-size: 15px;" class="">
                                              - <?php $dis = $models->discount / 100;

                                                $subDis = $sumTot * $dis;

                                                echo number_format((float)$subDis,2,'.',',');
                                                

                                               ?>
                                            </span>



                                        <?php } ?>






                                <?php } ?>


                          
                  
                              </span>
                            </td>
                          </tr>

                          <tr>
                            <td colspan="4" class="text-left">
                              <span style="font-size: 15px;"> 

                              <?= Html::a(empty($models->type_tax) ? 'Tax' : $models->type_tax,FALSE, ['value'=>Url::to([
                                    'project/tax',
                                    'project'=> (string)$models->_id,
                                    'location' => 'quote'
        
                                    ]),
                                    'class' => 'editTax',
                                    'id'=>'editTax',
                                    'style'=>'cursor:pointer;',
                                    'data-target'=>'#m_modal_5',
                                    'data-toggle'=>'modal'

                                    ]) ?>

                              <?= Html::a(empty($models->tax) ? '%' : $models->tax.'%',FALSE, ['value'=>Url::to([
                                    'project/tax',
                                    'project'=> (string)$models->_id,
                                    'location' => 'quote'
        
                                    ]),
                                    'class' => 'editTax',
                                    'id'=>'editTax',
                                    'style'=>'cursor:pointer;',
                                    'data-target'=>'#m_modal_5',
                                    'data-toggle'=>'modal'

                                    ]) ?>




                            </span>
                          </td>
                            <td class="text-right">
                              <span style="font-size: 15px;" class="text-red">

                                <?php if (empty($models->discount)) { ?>



                                  <?php $tax = $models->tax / 100;

                                  $subTax = $sumTot * $tax;

                                  echo number_format((float)$subTax,2,'.',','); ?>
                               
                                <?php } else { ?>


                                  <?php $tax = $models->tax / 100;

                                  $val = $sumTot - $subDis;


                                  $subTax = $val * $tax;

                                  echo number_format((float)$subTax,2,'.',','); ?>



                                <?php } ?>



                              </span></td>
                          </tr>


                          <tr>
                            <td colspan="4" class="text-left"><span style="font-size: 20px;font-weight: bold;">Total</span></td>
                            <td class="text-right">
                              <span style="font-size: 20px;">
                                <b>

                              <?php if (empty($models->discount)) { ?>
                                
                                <?= $sumTax = number_format((float)$subTax + $sumTot,2,'.',','); ?>


                              <?php } else { ?>

                                <?php $val = $sumTot - $subDis; ?>


                                <?= $sumTax = number_format((float)$subTax + $val,2,'.',','); ?>

                              <?php } ?>


                              </b>
                            </span>
                          </td>
                          </tr>

                        </table>
                        <br>
                        <?php if ($country_user == 129) { ?>

                          <?php if ($sumTax < 200) { ?>

                          <span class="text-red">* Order Is Less Than RM200.00, Extra Processing Fee Of RM50.00 Will Be Charged Upon Checkout.</span>

                          <?php } else { ?>

                          <?php } ?>


                        <?php } elseif ($country_user == 209 || $country_user == 100 || $country_user == 168 || $country_user == 230 || $country_user == 188 || $country_user == 36 || $country_user == 116 || $country_user == 32) { ?>

                          <?php if ($sumTax < 100) { ?>

                          <span class="text-red">* Order Is Less Than 100.00 USD, Extra Processing Fee Of 20.00 USD Will Be Charged. Upon Checkout.</span>


                          <?php } else { ?>

                          <?php } ?>



                        <?php } else { ?>

                          <?php if ($sumTax < 100) { ?>

                          <span class="text-red">* Order Is Less Than 100.00 USD, Extra Processing Fee Of 20.00 USD Will Be Charged. Upon Checkout.</span>


                          <?php } else { ?>

                          <?php } ?>


                        
                        <?php } ?>

                    </div>
                    <div class="print">
                        
                                    <?= Html::a('QUOTE', 
                                      [
                                      'project/archive', 
                                      'project' => (string)$models->_id,
                                      'total' => (string)$sumTax,
                                      'location' => 'quote'

                                      ], 
                                      [
                                          'class' => 'btn btn-primary',
              
                                      ]) ?>



                    </div>




                </page>

            </body>


        </div>
      </div>
    </section>


