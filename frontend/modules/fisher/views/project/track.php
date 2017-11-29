    <?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

$this->title = 'Track Order';
$this->params['breadcrumbs'][] = $this->title;

?>

<!-- begin::Body -->
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
    <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver    m-container m-container--responsive m-container--xxl m-page__container">
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title ">
                            <?= Html::encode($this->title) ?>
                        </h3>
                    </div>

                </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-content">

                <?php $i=0; foreach ($models as $key => $model) { $i++;?>
                        <!--begin:: Widgets/Stats-->
                        <div class="m-portlet ">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text m--font-info">
                                            #<?= $model['myRFQ'] ?>
                                        </h3>



                                    </div>
                                </div>
                                <div class="m-portlet__head-tools">

                                    Place On : <?= $model['date_create'] ?>

                                </div>
                            </div>

                            <div class="m-portlet__body  m-portlet__body--no-padding">
                                <div class="row m-row--no-padding m-row--col-separator-xl">

                                    <div class="col-md-12 col-lg-7 col-xl-7">
                                        <!--begin::Total Profit-->
                                        <div class="m-widget24">
                                            <div class="m-widget24__item">
                                                <h4 class="m-widget24__title">
                                                    <?= $model['name']; ?>
                                                </h4>
                                                <br>
                                                <span class="m-widget24__desc">
                                                    <?= $model['company_name']; ?>
                                                </span>
                                                <br>
                                                <span class="m-widget24__desc">
                                                    <?= $model['address']; ?>,<?= $model['postcode']; ?>,<?= $model['city']; ?>,
                                                    <?= $model['province']; ?>
                                                </span>
                                                <br>
                                                <span class="m-widget24__desc">
                                                    <?= $model['contact_no']; ?>
                                                </span>
                                                <br>
                                                <span class="m-widget24__desc m--font-primary">
                                                    <?= $model['email']; ?>
                                                </span>
                                                <div class="m--space-30"></div>





 
                                            </div>




                                        </div>

                                        <?php if ($model['diff_add_info'] == 'No') { ?>
                                                            
                                        <?php } else { ?>
                                        <div class="col-md-12 col-lg-12 col-xl-12">
                                            <!--begin:: Widgets/Stats2-1 -->
                                            <div class="m-widget1">
                                                <div class="m-widget1__item">
                                                    <div class="row m-row--no-padding align-items-center">
                                                        <div class="col">
                                                            <h3 class="m-widget1__title">
                                                                Different Address
                                                            </h3>
             
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="m-widget1__item">
                                                    <div class="row m-row--no-padding align-items-center">
                                                        <div class="col">
                                                            <span class="m-list-search__result-item-icon">
                                                                <i class="flaticon-users m--font-warning"></i>
                                                            </span>
                                                            <span class="m-list-search__result-item-text">
                                                                : <?= $model['diff_name'] ?>
                                                            </span>
                                                            <br>
                                                            <span class="m-list-search__result-item-icon">
                                                                <i class="flaticon-truck m--font-success"></i>
                                                            </span>
                                                            <span class="m-list-search__result-item-text">
                                                                : <?= $model['diff_address'] ?>,<?= $model['diff_postcode'] ?>,<?= $model['diff_city'] ?>,<?= $model['diff_province'] ?>,<?= $model['diff_country'] ?>
                                                            </span>
                                                            <br>
                                                            <span class="m-list-search__result-item-icon">
                                                                <i class="fa fa-phone m--font-info"></i>
                                                            </span>
                                                            <span class="m-list-search__result-item-text">
                                                                : <?= $model['diff_contact_no'] ?>
                                                            </span>

                                                        </div>

                                                    </div>
                                                </div>


                  
                                            </div>
                                            <!--end:: Widgets/Stats2-1 -->



                                        </div>

                                        <?php } ?>

                                        <div class="m-widget24">
                                            <div class="m-widget24__item">


                                                <?php if (empty($model['reason_revise'])) { ?>
                                                  
                                                <?php } else { ?>

                                                    <span class="m-widget24__desc m--font-danger"> ( This Quotation Has Been Revise ! <b>Reason : <?= $model['reason_revise'] ?></b> )</span>

                                                <?php } ?>

                                            </div>
                                        </div>


                                        <div class="m--space-30"></div>


                                        <!--end::Total Profit-->
                                    </div>
                                    <div class="col-md-12 col-lg-3 col-xl-3">
                                        
                                        <div class="m-widget1">
                                            <div class="m-widget1__item">
                                                <div class="row m-row--no-padding align-items-center">
                                                    <div class="col">
                                                        <h3 class="m-widget1__title">
                                                            Catalog No
                                                        </h3>
         
                                                    </div>
                                                    <div class="col m--align-right">
                                                        <h3 class="m-widget1__title">
                                                            Quantity
                                                        </h3>
                                 
         
                                                    </div>
                                                </div>
                                            </div>


                                            <?php foreach ($model['data'] as $key => $data) { ?>
                                            <div class="m-widget1__item">
                                                <div class="row m-row--no-padding align-items-center">
                                                    <div class="col">
                                                        <span class="m-widget1__desc">
                                                            <?= $data['catalog_no']; ?>
                                                        </span>
                                                    </div>
                                                    <div class="col m--align-right">
       
                                                        <span class="m-widget1__number m--font-info">
                                                            <?= $data['quantity']; ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>


                                        </div>
                                        
                                    </div>
                                    <div class="col-md-12 col-lg-2 col-xl-2">
                                        
                                        <div class="m-widget1">
                                            <div class="m-widget1__item">
                                                <div class="row m-row--no-padding align-items-center">
                                                    <div class="col">



                                                        
         
                                                    </div>

                                                </div>
                                            </div>





                                        </div>
                                        
                                    </div>






                                </div>
                            </div>
                        </div>
                        <!--end:: Widgets/Stats-->

            
                                <!--begin::Portlet-->
                                <div class="m-portlet">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    Order Tracking
                                                </h3>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="m-portlet__body">
                                        <!--begin::Section-->
                                        <div class="m-section">

                                            <div class="row">

                                        <?php foreach ($status as $key_status => $value_status) { ?>
                                            
                                            <?php if ($value_status['in_time_status'] == $value_status['item'][0]['status']) { ?>

                                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                                            <span class="m-section__heading m-badge m-badge--success m-badge--wide">
                                                                <?= $value_status['item'][0]['status']; ?>
                                                            </span>
                                                            
                                                    </div>

                                            <?php } else { ?>

                                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                                        <span class="m-section__heading m-badge m-badge--wide">
                                                            Processing
                                                        </span>
                                                    
                                                    </div>

                                            <?php } ?>

                                                    <?php if ($value_status['in_time_status'] == 'Cancel') { ?>

                                                            <div class="col-md-8 col-lg-8 col-xl-8">
                                                                    <span class="m-section__heading m-badge m-badge--danger m-badge--wide">
                                                                        <?= $value_status['item'][1]['status']; ?>
                                                                    </span>
                                                                    
                                                            </div>


                                                    <?php } else { ?>





                                            <?php if ($value_status['in_time_status'] == $value_status['item'][1]['status']) { ?>

                                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                                            <span class="m-section__heading m-badge m-badge--success m-badge--wide">
                                                                <?= $value_status['item'][1]['status']; ?>
                                                            </span>
                                                            
                                                    </div>

                                            <?php } else { ?>

                                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                                        <span class="m-section__heading m-badge m-badge--wide">
                                                            Shipped
                                                        </span>
                                                    
                                                    </div>

                                            <?php } ?>
                                            <?php if ($value_status['in_time_status'] == $value_status['item'][2]['status']) { ?>

                                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                                            <span class="m-section__heading m-badge m-badge--success m-badge--wide">
                                                                <?= $value_status['item'][2]['status']; ?>
                                                            </span>
                                                            
                                                    </div>

                                            <?php } else { ?>

                                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                                        <span class="m-section__heading m-badge m-badge--wide">
                                                            Delivered
                                                        </span>
                                                    
                                                    </div>

                                            <?php } ?>


                                            <?php } ?>


                                        <?php } ?>






                                                
                                            </div>


                                            
                                            <div class="m-section__content">
                                                <!--begin::Preview-->
                                                <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
                                                    <div class="m-demo__preview">
                                                        <div class="m-list-timeline">
                                                            <div class="m-list-timeline__items">


                                                    <?php foreach ($status as $key_status => $value_status) { ?>


                                                        <?php foreach ($value_status['detail'] as $key_details => $value_details) { ?>


                                                                <div class="m-list-timeline__item">
                                                                    <span class="m-list-timeline__badge"></span>
                                                                    <span class="m-list-timeline__text">
                                                                            <?= $value_details['status'] ?>
                                                                            <?php if ($value_status['in_time_status'] == 'Cancel') { ?>
                                                                            <br>
                                                                            <?= $value_details['refund'] ?>

                                                                            <?php } ?>


                                                                    </span>
                                                                    <span class="m-list-timeline__time">
                                                                        <?= $value_details['date'] ?>
                                                                    </span>
                                                                </div>
                   



                                                        <?php } ?>




                                                    <?php } ?>


 

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Preview-->

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <h3 class="m-subheader__title ">
                                    Item Details
                                </h3>
                                <br>


                                <?php  foreach ($model['data']  as $key => $value) { ?>
                                <!--begin::Portlet-->
                              <div class="m-portlet ">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text m--font-info">
                                                    Catalog No : <?= $value['catalog_no']; ?>
                                                </h3>
                                            </div>
                                        </div>
                                            <div class="m-portlet__head-tools">

                                         
                                                Price : <?= $model[0]['currency']; ?> <?=  number_format((float)$value['price'],2,'.',','); ?> / Unit

                                            </div>
                                    </div>

                                    <div class="m-portlet__body  m-portlet__body--no-padding">
                                        <div class="row m-row--no-padding m-row--col-separator-xl">

                                            <div class="col-md-12 col-lg-9 col-xl-9">

                                                <div class="m-widget24">
                                                    <div class="m-widget24__item">
                                                        <h4 class="m-widget24__title">
                                                            <?= $value['item']; ?>
                                                        </h4>
                                                        <br>
                                                        <span class="m-widget24__desc">
                                                            <?= $value['specification']; ?>
                                                        </span>
                                                        <br>
                                                        <span class="m-widget24__desc">
                                                            <?= $value['description']; ?>
                                                        </span>
                                                        <br>
                                                        <span class="m-widget24__desc">
                                                            <?= $value['remark']; ?>
                                                        </span>
                                                        
         
                                                    </div>


                                                </div>




                                                  <div class="col-md-12 col-lg-12 col-xl-12">
                                                    <!--begin:: Widgets/Stats2-1 -->
                                                    <div class="m-widget1">
                                                        <div class="m-widget1__item">
                                                            <div class="row m-row--no-padding align-items-center">
                                                                <div class="col">
                                                                    <h3 class="m-widget1__title">
                                                                        Shipping & Discount
                                                                    </h3>
                     
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="m-widget1__item">
                                                            <div class="row m-row--no-padding align-items-center">
                                                                <div class="col">
                                                                    <?php if ($value['freight_per_item'] == 'Yes') { ?>


                                                                      <span class="m-list-search__result-item-text">
                                                                          Shipping Charge :
                                                                      </span>
                                                                      <span class="m-list-search__result-item-text ">
                                                                          <?= $model[0]['currency']; ?>
                                                                          <span class="m--font-danger"><?=  number_format((float)$value['freight'],2,'.',','); ?> x  <?= $value['quantity']; ?></span>
                                                                          <?php $totFreight = $value['freight'] * $value['quantity']; ?>
                                                                      </span>


                                                                    <?php } else { ?>

                                                                      <span class="m-list-search__result-item-text">
                                                                          Shipping Charge :
                                                                      </span>
                                                                      <span class="m-list-search__result-item-text">
                                                                          <?= $model[0]['currency']; ?>
                                                                          <span class="m--font-danger"><?= number_format((float)$value['freight'],2,'.',','); ?></span>
                                                                      </span>

                                                                    <?php } ?>
                                                                    <br>
                                                                 <?php if ($value['discount_per_item'] == 'Yes') { ?>

                                                                <span class="m-list-search__result-item-text">
                                                                    Discount :
                                                                </span>

                                                                  <?php if ($value['in_percentage'] == 'Yes') { ?>

                                                                      <span class="m--font-success"><?= $value['discount_per_item_value']; ?>%</span>
                                                                      <?php $tempVal = $value['price'] *  $value['quantity'];

                                                                      $totDisPerItem = $tempVal * ($value['discount_per_item_value'] / 100); ?>



                                                                  <?php } else { ?>


                                                                      <?php if ($value['per_item'] == 'Yes') { ?>


                                                                          <span class="m--font-success"><?= $model[0]['currency']; ?><?= number_format((float)$value['discount_per_item_value'],2,'.',','); ?> x <?= $value['quantity']; ?></span>
                                                                          <?php $totDisPerItem = $value['discount_per_item_value'] *  $value['quantity']; ?>


                                                                      <?php } else { ?>


                                                                          <span class="m--font-success"><?= $model[0]['currency']; ?> <?= number_format((float)$value['discount_per_item_value'],2,'.',','); ?></span>

                                                                            <?php $totDisPerItem = $value['discount_per_item_value']; ?>


                                                                      <?php } ?>

                                                                  <?php } ?>


                                                            <?php } else { ?>

                                                            <?php } ?>
                            
                                                        
             

                                                                </div>

                                                            </div>
                                                        </div>
                          
                                                    </div>
                                                    <!--end:: Widgets/Stats2-1 -->
                                                </div>

                                            </div>



                                            <div class="col-md-12 col-lg-3 col-xl-3">
                                                
                                                <div class="m-widget1">
                                                    <div class="m-widget1__item">
                                                        <div class="row m-row--no-padding align-items-center">
                                                            <div class="col">
                                                                <h3 class="m-widget1__title">
                                                                    Quantity
                                                                </h3>
                 
                                                            </div>
                                                            <div class="col m--align-right">
                                                                <h3 class="m-widget1__title">
                                                                    TOTAL
                                                                </h3>
                                         
                 
                                                            </div>
                                                        </div>
                                                    </div>


                                                    
                                                    <div class="m-widget1__item">
                                                        <div class="row m-row--no-padding align-items-center">
                                                            <div class="col">

                                                                <span class="m-widget1__number">
                                    
                                                                  <?= $quantity = $value['quantity']; ?>
                                                                </span>
                                                            </div>
                                                            <div class="col m--align-right">
                                                                <h3 class="m-widget1__title">
                                                                    <?php $tot = $value['price'] * $quantity;?>
                                                                    <?php echo number_format((float)$tot,2,'.',','); ?>
                                                                </h3>
                                                                <br>

                                                       <?php if ($value['discount_per_item'] == 'Yes') { ?>

                                                            <?php if ($value['in_percentage'] == 'Yes') { ?>

                                                                  <h3 class="m-widget1__title ">
                                                                    (<span class="m--font-success"><?= number_format((float)$totDisPerItem,2,'.',','); ?></span>)
                                                                   
                                                                  </h3>
                                                                  <br>

                                                           <?php } else { ?>


                                                                <?php if ($value['per_item'] == 'Yes') { ?>

                                                                        <h3 class="m-widget1__title ">
                                                                        (<span class="m--font-success"><?= number_format((float)$totDisPerItem,2,'.',','); ?></span>)
                                                                        </h3>
                                                                        <br>


                                                                <?php } else { ?>

                                                                    
                                                                        <h3 class="m-widget1__title ">
                                                                        (<span class="m--font-success"><?= number_format((float)$totDisPerItem,2,'.',','); ?></span>)
                                                                        </h3>
                                                                        <br>

                                                                

                                                                <?php } ?>




                                                           <?php } ?>

                                                            
                                                       <?php } else { ?>

                                                       <?php } ?>



                                                            <?php if ($value['freight_per_item'] == 'Yes') { ?>

                                                            <h3 class="m-widget1__title m--font-danger">

                                                                <?= number_format((float)$totFreight,2,'.',','); ?>

                                                            </h3>
                                                            <br>
                                                            <h3 class="m-widget1__number">
                                                                <ins><?= number_format((float)$tot - $totDisPerItem + $totFreight,2,'.',','); ?></ins>
                                                            </h3>

                                                                <?php $sumTot += $tot - $totDisPerItem + $totFreight; ?>



                                                            <?php } else { ?>

                                                            <h3 class="m-widget1__title m--font-danger">
                                                                <?= number_format((float)$value['freight'],2,'.',','); ?>
                                                            </h3>
                                                            <br>
                                                            <h3 class="m-widget1__number">
                                                                <ins><?= number_format((float)$tot - $totDisPerItem + $value['freight'],2,'.',','); ?></ins>
                                                            </h3>

                                                                <?php $sumTot += $tot - $totDisPerItem + $value['freight']; ?>


                                                            <?php } ?>




                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>






                                        </div>

                                    </div>
                                </div>



                                <?php } ?>


                <div class="m-portlet ">




                    <div class="m-portlet__body  m-portlet__body--no-padding">
                          <div class="row m-row--no-padding m-row--col-separator-xl">

                              <div class="col-md-12 col-lg-12 col-xl-12">


                                  <div class="m-widget1">
                                          <div class="m-widget1__item">
                                              <div class="row m-row--no-padding align-items-center">
                                                  <div class="col">
                                                      <h3 class="m-widget1__title">
                                                          Sub-Total
                                                      </h3>
       
                                                  </div>
                                                  <div class="col m--align-right">
                                                      <h3 class="m-widget1__title">
                                                          <?= $subTotal = number_format((float)$sumTot,2,'.',','); ?>
                                                      </h3>
                               
       
                                                  </div>
                                              </div>
                                          </div>

                                          <?php if (empty($model['discount'])) { ?>


                                          <?php } else { ?>

                                              <?php if ($model['in_percentage_dis'] == 'No') { ?>

                                                  <div class="m-widget1__item">
                                                      <div class="row m-row--no-padding align-items-center">
                                                          <div class="col">
                                                              <h3 class="m-widget1__title">
                                                                  Discount
                                                              </h3>
               
                                                          </div>
                                                          <div class="col m--align-right">
                                                              <h3 class="m-widget1__title m--font-success">
                                                                  <?php $dis = $model['discount'];

                                                                  $subDis = $dis;

                                                                  echo number_format((float)$subDis,2,'.',',');
                                                                  

                                                                 ?>
                                                              </h3>
                                       
               
                                                          </div>
                                                      </div>
                                                  </div>




                                              <?php } else { ?>



                                                  <div class="m-widget1__item">
                                                      <div class="row m-row--no-padding align-items-center">
                                                          <div class="col">
                                                              <h3 class="m-widget1__title">
                                                                  Discount %
                                                              </h3>
               
                                                          </div>
                                                          <div class="col m--align-right">
                                                              <h3 class="m-widget1__title m--font-success">
                                                                  <?php $dis = $model['discount'] / 100;

                                                $subDis = $sumTot * $dis;

                                                echo number_format((float)$subDis,2,'.',',');
                                                

                                               ?>
                                                              </h3>
                                       
               
                                                          </div>
                                                      </div>
                                                  </div>




                                              <?php } ?>


                                          <?php } ?>

                                          <div class="m-widget1__item">
                                              <div class="row m-row--no-padding align-items-center">
                                                  <div class="col">
                                                      <h3 class="m-widget1__title">

                                                          <?php echo empty($model['type_tax']) ? '': $model['type_tax']; ?>
                                                          <?php echo empty($model['tax']) ? '': $model['tax'].'%' ?>
                                                
                                                      </h3>
       
                                                  </div>
                                                  <div class="col m--align-right">
                                                      <h3 class="m-widget1__title m--font-danger">


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


                       
                                                      </h3>
                               
       
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="m-widget1__item">
                                              <div class="row m-row--no-padding align-items-center">
                                                  <div class="col">
                                                      <h3 class="m-widget1__title">
                                                          TOTAL
                                                      </h3>
       
                                                  </div>
                                                  <div class="col m--align-right">
                                                      <h3 class="m-widget1__title ">

                                                          <?php if (empty($model['discount'])) { ?>
                                
                                                              <?= $sumTax = number_format((float)$subTax + $sumTot,2,'.',','); ?>

                                                              <?php 


                                                              $totalPay = round($subTax+$sumTot,2); ?>


                                                            <?php } else { ?>

                                                              <?php $val = $sumTot - $subDis; ?>


                                                              <?= $sumTax = number_format((float)$subTax + $val,2,'.',','); ?>

                                                              <?php $totalPay = round($subTax+$val,2); ?>

                                                            <?php } ?>


                                                          
                                                      </h3>
                               
       
                                                  </div>
                                              </div>
                                          </div>



                                          <div class="m--space-20"></div>


                                          



                                    </div>


                              </div>

                          </div>
                    </div>



                </div>







                                <?php } ?>





            </div>
        </div>
    </div>
</div>
            <!-- end::Body -->






