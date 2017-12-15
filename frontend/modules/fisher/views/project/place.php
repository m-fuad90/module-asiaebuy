    <?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;


$this->title = 'Confirm';
$this->params['breadcrumbs'][] = $this->title;


$baseUrl = Url::to('@paypal');


$detailJson = json_encode($show,JSON_PRETTY_PRINT);


?>

<div class="row service-box margin-bottom-40">

    <div class="col-md-12 col-sm-12">

        <h2><?= Html::encode($this->title) ?></h2>

          <div class="panel panel-default">

              <div class="panel-heading">#<?= $model[0]['myRFQ']; ?>
                </div>

              <div class="panel-body">

                  <table class="table">

                      <thead>
                          <tr>
                              <th>Default Address</th>

                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>
                                  <dl>
                                      <dt>Name : </dt>
                                      <dd><?= $model[0]['name']; ?></dd>
                                      <?php if (empty($model[0]['company_name'])) { ?>
                                          
                                      <?php } else { ?>
                                      <dt>Company : </dt>
                                      <dd><?= $model[0]['company_name']; ?></dd>
                                      <?php } ?>

                                      <dt>Address : </dt>
                                      <dd>
                                          <?= $model[0]['address']; ?>,<?= $model[0]['postcode']; ?>,<?= $model[0]['city']; ?>
                                      <dt>Province</dt>
                                      <dd><?= $model[0]['province']; ?><dd>
                                      <dt>Country</dt>
                                      <dd>
                                          <?= $model[0]['country']; ?>
                                      </dd>
                                      <dt>Contact : </dt>
                                      <dd><?= $model[0]['contact_no']; ?></dd>
                                      <dt>Email : </dt>
                                      <dd><?= $model[0]['email']; ?></dd>
                                  </dl>
                                        <?php if ($model[0]['diff_add_info'] == 'No') { ?>
                                                
                                        <?php } else { ?>

                                        <b>Different Address</b>
                                        <dl class="dl-horizontal">
                                            <dt>PIC : </dt>
                                            <dd><?= $model[0]['diff_name'] ?></dd>
                                            <?php if (empty($model[0]['diff_company'])) { ?>
                                                
                                            <?php } else { ?>
                                            <dt>Company : </dt>
                                            <dd><?= $model[0]['diff_company']; ?></dd>
                                            <?php } ?>

                                            <dt>Address : </dt>
                                            <dd><?= $model[0]['diff_address'] ?>,<?= $model[0]['diff_postcode'] ?>,<?= $model[0]['diff_city'] ?></dd>
                                            <dt>Province</dt>
                                            <dd><?= $model[0]['diff_province'] ?></dd>
                                            <dt>Country</dt>
                                            <dd><?= $model[0]['diff_country'] ?></dd>

                                        <?php } ?>



                                  
                              </td>
                              <td>
                                  <dl>
                                      <dt>Validity : </dt>
                                      <dd><?= $model[0]['validity'] ?></dd>
                                      <dt>Lead Time : </dt>
                                      <dd><?= $model[0]['lead_time'] ?></dd>
                                  </dl>
                              </td>

                          </tr>
                      </tbody>
                    
                  </table>

        <?php $i=0; foreach ($data as $key => $value) { $i++;?>

                <div class="panel panel-default">

                    <div class="panel-heading">
                        No : <?php echo $i; ?>
                        <span class="pull-right">Price / Unit. : <?= $value['price'] ?> (<?= $model[0]['currency']; ?>)</span>
                      </div>

                    <div class="panel-body">

                        <table class="table">
                            <thead>
                              <tr>
                                <th>Item Info</th>
                                <th>Quantity</th>
                                <th>Price Info</th>
                              </tr>
                            </thead>
                            <tbody>
                            <tr>
                              <td>

                                  <dl>
                                      <dt>Catalog No :</dt>
                                      <dd><?= $value['catalog_no']; ?></dd>
                                      <dt>Price :</dt>
                                      <dd><?= $value['price']; ?></dd>
                                      <dt>Description :</dt>
                                      <dd><?= $value['description']; ?></dd>
                                      <dt>Specification : </dt>
                                      <dd><?= $value['specification'];?></dd>
                                  </dl>
                                </td>
                                <td>
                                    <dt>Quantity : </dt>
                                    <dd><?= $value['quantity'];?></dd>
                                </td>
                                <td>
                                    <dl>
                                        <dt>Price : </dt>
                                        <dd>
                                          <?php $tot = $value['price'] * $value['quantity'];?>
                                          <?php echo number_format((float)$tot,2,'.',','); ?>

                                            
                                        </dd>
                                        <?php if ($value['discount_per_item'] == 'Yes') { ?>
                                          <dt>Discount 
                                          <?php if ($value['discount_per_item'] == 'Yes') { ?>

                                              <?php if ($value['in_percentage'] == 'Yes') { ?>


                                                      ( <?= $value['discount_per_item_value']; ?>%
                                                      <?php $tempVal = $value['price'] *  $value['quantity']; ?>) :

                                                      <?php $totDisPerItem = $tempVal * ($value['discount_per_item_value'] / 100); ?>

                                              <?php } else { ?>

                                                    <?php if ($value['per_item'] == 'Yes') { ?>

                                                        
                                                        ( <?= number_format((float)$value['discount_per_item_value'],2,'.',','); ?> x <?= $value['quantity']; ?> ) :
                                                        <?php $totDisPerItem = $value['discount_per_item_value'] *  $value['quantity']; ?>

                                                    <?php } else { ?>

                                                      
                                                        ( <?= number_format((float)$value['discount_per_item_value'],2,'.',','); ?> ) :

                                                        <?php $totDisPerItem = $value['discount_per_item_value']; ?>

                                                    <?php } ?>

                                              <?php } ?>

                                          <?php } else { ?>

                                            <?php $totDisPerItem = 0; ?>

                                          <?php } ?>
                                          </dt>
                                          <dd>
                                            
                                              <?php if ($value['discount_per_item'] == 'Yes') { ?>

                                                  <?php if ($value['in_percentage'] == 'Yes') { ?>

                                                                ( <?= number_format((float)$totDisPerItem,2,'.',','); ?> )

                                                  <?php } else { ?>

                                                      <?php if ($value['per_item'] == 'Yes') { ?>

                                                              ( <?= number_format((float)$totDisPerItem,2,'.',','); ?> )

                                                      <?php } else { ?>

                                                              ( <?= number_format((float)$totDisPerItem,2,'.',','); ?> )

                                                      <?php } ?>

                                                  <?php } ?>

                                                  
                                              <?php } else { ?>

                                                      <?php $totDisPerItem = 0; ?>

                                              <?php } ?>


                                          </dd>

                                        <?php } else { ?>

                                        <?php } ?>
                                        <dt>
                                          Shipping Charge 
                                            <?php if ($value['freight_per_item'] == 'Yes') { ?>

                                                ( <?=  number_format((float)$value['freight'],2,'.',','); ?> x  <?= $value['quantity']; ?> ) :

                                                <?php $totFreight = $value['freight'] * $value['quantity']; ?>
                                      
                                            <?php } else { ?>

                                                ( <?= number_format((float)$value['freight'],2,'.',','); ?> ) :

                                                <?php $totFreight = $value['freight']; ?>

                                            <?php } ?>
                                           
                                        </dt>
                                        <dd>
                                              <?php if ($value['freight_per_item'] == 'Yes') { ?>

                                                    <?= number_format((float)$totFreight,2,'.',','); ?>
                 
                                                    <?php  $totItem =  number_format((float)$tot - $totDisPerItem + $totFreight,2,'.',','); ?>
                                                  
                                                    <?php $sumTot += $tot - $totDisPerItem + $totFreight; ?>
                                          
                                                <?php } else { ?>

                                                    <?= number_format((float)$totFreight,2,'.',','); ?>
                                                  
                                                    <?php $totItem =  number_format((float)$tot - $totDisPerItem + $totFreight,2,'.',','); ?>
                                              
                                                    <?php $sumTot += $tot - $totDisPerItem + $totFreight; ?>

                                                <?php } ?>
                                        </dd>




                                    </dl>

                                    <hr>

                                    <dl>
                                      <dt>TOTAL : </dt>
                                      <dd><?= $totItemAll = $totItem; ?></dd>
                                    </dl>




                                </td>
                            </tr>
                          </tbody>
                        </table>





                    </div>

                </div>
        <?php } ?>






              </div>
    </div>


    </div>
    <div class="col-md-12 col-sm-12">


                <div class="panel panel-default">

                    <div class="panel-heading">Order Summary</div>

                    <div class="panel-body">

                        <dl>
                            <dt>Subtotal</dt>
                            <dd><?php echo number_format((float)$sumTot,2,'.',','); ?></dd>
                            <?php if (empty($model[0]['discount'])) { ?>
                                
                            <?php } else { ?>

                              <dt>

                                <?php if ($model[0]['in_percentage_dis'] == 'No') { ?>


                                  <?= empty($model[0]['discount']) ? '<dt class="">Discount :</dt>': '<dt class="">Discount ( '.$model[0]['currency'].' '.$model[0]['discount'].' ) : </dt>'; ?>

                                  
                                <?php } else { ?>


                                    <?= empty($model[0]['discount']) ? '<dt class="">Discount : </dt>': '<dt class="">Discount ( '.$model[0]['discount'].' % ) :</dt>'; ?>


                                <?php } ?>



                              </dt>
                              <dd>
                                <?php if (empty($model[0]['discount'])) { ?>

                                    <?= '0.00'; ?>
                                    
                                <?php } else { ?>


                                        <?php if ($model[0]['in_percentage_dis'] == 'No') { ?>


                                              - <?php $dis = $model[0]['discount'];

                                                $subDis = $dis;

                                                echo number_format((float)$subDis,2,'.',',');
                                                

                                               ?>
                       


                                        <?php } else { ?>


                                              - <?php $dis = $model[0]['discount'] / 100;

                                                $subDis = $sumTot * $dis;

                                                echo number_format((float)$subDis,2,'.',',');
                                                

                                               ?>
                               


                                        <?php } ?>


                                <?php } ?>


                              </dd>

                            <?php } ?>


                            <?php if (empty($model[0]['type_tax'])) { ?>

                               

                            <?php } else { ?>


                            <dt>

                              <?php echo empty($model[0]['type_tax']) ? 'Tax' : $model[0]['type_tax']; ?>

                              <?php echo empty($model[0]['tax']) ? '%': $model[0]['tax'].'%' ?> :


                            </dt>
                            <dd>
                                <?php if (empty($model[0]['discount'])) { ?>

                                  <?php $tax = $model[0]['tax'] / 100;

                                  $subTax = $sumTot * $tax;

                                  echo number_format((float)$subTax,2,'.',','); ?>
                               
                                <?php } else { ?>

                                  <?php $tax = $model[0]['tax'] / 100;

                                  $val = $sumTot - $subDis;


                                  $subTax = $val * $tax;

                                  echo number_format((float)$subTax,2,'.',','); ?>

                                <?php } ?>



                            </dd>


                            <?php } ?>

                            <dt>Total</dt>
                            <dd>
                              

                              <?php if (empty($model[0]['discount'])) { ?>
                                
                                <?= $sumTax = number_format((float)$subTax + $sumTot,2,'.',','); ?>


                              <?php } else { ?>

                                <?php $val = $sumTot - $subDis; ?>


                                <?= $sumTax = number_format((float)$subTax + $val,2,'.',','); ?>

                              <?php } ?>



                            </dd>
                            <br>

                            <?php if ($country_user == 129) { ?>

                                <?php if ($sumTax < 200) { ?>

                                  <dt style="color: red;">Order Is Less Than RM200.00, Extra Processing Fee Of RM50.00 Will Be Charged. </dt>
                                  <dt>Final Total : </dt>
                                  <dd><?php echo $sumTax+50.00; ?></dd>

                                <?php } else { ?>

                                <?php } ?>


                            <?php } elseif ($country_user == 209 || $country_user == 100 || $country_user == 168 || $country_user == 230 || $country_user == 188 || $country_user == 36 || $country_user == 116 || $country_user == 32) { ?>


                                <?php if ($sumTax < 100) { ?>

                                  <dt style="color: red;">Order Is Less Than 100.00 USD, Extra Processing Fee Of 20.00 USD Will Be Charged. </dt>
                                  <dt>Final Total : </dt>
                                  <dd><?php echo $sumTax+20.00; ?></dd>

                                <?php } else { ?>

                                <?php } ?>


                            <?php } else { ?>

                                <?php if ($sumTax < 100) { ?>

                                  <dt style="color: red;">Order Is Less Than 100.00 USD, Extra Processing Fee Of 20.00 USD Will Be Charged. </dt>
                                  <dt>Final Total : </dt>
                                  <dd><?php echo $sumTax+20.00; ?></dd>

                                <?php } else { ?>

                                <?php } ?>




                            <?php } ?>




                            

                        </dl>

                        <table class="table">
                            <tr>
                                <td>
                                  <?= Html::a('UNDO ORDER', [
                                  'project/undo',
                                  'id' => (string)$newProject_id,
                                ], ['class'=>'btn btn-primary']) ?>
                                  
                                </td>
                                <td>
                                    <div id="paypal-button-container" class="pull-right"></div>
                                </td>
                            </tr>
                        </table>


                    </div>

                </div>
 
    </div>

        <?php foreach ($show as $key_show => $value_show) { ?>

          <?php $value_show['name']; ?>
          <br>
          <?php $value_show['price']; ?>
          <br>
          <?php $value_show['currency']; ?>
          <br>
          <?php $value_show['description']; ?>
          <br>
          <br>

          <?php round($value_show['price'] * $value_show['quantity'],2); ?>
          <?php $priceTotal += round($value_show['price'] * $value_show['quantity'],2); ?>


        <?php } ?>


        <br>
        <?php if (empty($model[0]['discount'])) { ?>

            <?php $subDisPaypal = '0.00'; ?>

        <?php } else { ?>

            <?php if ($model[0]['in_percentage_dis'] == 'No') { ?>

                  <?php $dis = $model[0]['discount'];

                          $subDis = $dis;

                           number_format((float)$subDis,2,'.',',');

                          $subDisPaypal = round($subDis,2);
                          

                         ?>

            <?php } else { ?>


                  <?php $dis = $model[0]['discount'] / 100;

                    $subDis = $priceTotal * $dis;

                     number_format((float)$subDis,2,'.',',');

                    $subDisPaypal = round($subDis,2);
                    

                   ?>

            <?php } ?>


        <?php } ?>
        <br>
        <?php if (empty($model[0]['type_tax'])) { ?>


          <?php $subTaxPaypal = '0.00'; ?>
           

        <?php } else {?>
              <?php if (empty($model[0]['discount'])) { ?>

                          <?php $tax = $model[0]['tax'] / 100;

                            $subTax = $priceTotal * $tax;

                           number_format((float)$subTax,2,'.',','); 

                          $subTaxPaypal = round($subTax,2);



                          ?>
               
              <?php } else { ?>

                          <?php $tax = $model[0]['tax'] / 100;

                            $val = $priceTotal - $subDis;


                            $subTax = $val * $tax;

                             number_format((float)$subTax,2,'.',','); 

                            $subTaxPaypal = round($subTax,2);



                            ?>

              <?php } ?>


        <?php } ?>
        <br>
                              <?php if (empty($model[0]['discount'])) { ?>
                                  
                                  <?php $sumTax = number_format((float)$subTax + $priceTotal,2,'.',','); ?>

                                  <?php $totalPay = round($subTax+$priceTotal,2); ?>


                              <?php } else { ?>

                                    <?php $val = $priceTotal - $subDis; ?>


                                    <?php $sumTax = number_format((float)$subTax + $val,2,'.',','); ?>

                                    <?php $totalPay = round($subTax+$val,2); ?>

                              <?php } ?>

                            <br>

                            <?php if ($country_user == 129) { ?>

                                <?php if ($totalPay < 200) { ?>

                                  <?php $charge =  '50.00'; ?>

                                <?php } else { ?>

                                  <?php $charge =  '0.00'; ?>

                                <?php } ?>


                            <?php } elseif ($country_user == 209 || $country_user == 100 || $country_user == 168 || $country_user == 230 || $country_user == 188 || $country_user == 36 || $country_user == 116 || $country_user == 32) { ?>


                                <?php if ($totalPay < 100) { ?>

                                  <?php $charge = '20.00'; ?>

                                <?php } else { ?>

                                  <?php $charge =  '0.00'; ?>

                                <?php } ?>


                            <?php } else { ?>

                                <?php if ($totalPay < 100) { ?>

                                  <?php $charge = '20.00'; ?>

                                <?php } else { ?>

                                  <?php $charge =  '0.00'; ?>

                                <?php } ?>


                      

                            <?php } ?>


</div>




<script src="https://www.paypalobjects.com/api/checkout.js"></script>
      <script>
        paypal.Button.render({

            env: 'production',
            //env: 'sandbox',

            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create
            client: {
                //sandbox:    'AaClFWfUpTbAUct7_St5dRPNgl4x_J0jMQU5XU70KkPitCffxFAhZ_NgXtM40EDY__6fkdz5S2CjZRLq',
              production:  'AdR0126xOc6UlLuQQCVZphLOZ5uUCa7SY04kTkhD5eKLQK3WWzglK2FMkOM0-fEXnwRroC3wc0ZzR5Vm',

            },

          style: {
              label: 'paypal',
              size:  'medium',    // small | medium | large | responsive
              shape: 'rect',     // pill | rect
              color: 'gold',     // gold | blue | silver | black
              tagline: false    
          },


            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,

            // payment() is called when the button is clicked
            payment: function(data, actions) {


                
                // Make a call to the REST api to create the payment
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { 
                                  total: '<?php echo round($priceTotal - $subDisPaypal + $subTaxPaypal + $charge,2); ?>', 
                                  currency: '<?php echo $model[0]['currency'];?>',
                                  details:  {
                                      subtotal: '<?php echo $priceTotal; ?>',
                                      discount: '<?php echo $subDisPaypal; ?>',
                                      tax: '<?php echo $subTaxPaypal; ?>',
                                      handling_fee: '<?php echo $charge; ?>'
                          
                
                                    }

                                },
                                item_list: {
                                  items: <?php echo $detailJson; ?>
                                }
                            }
                        ]
                    }
                });
            },



            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function(data, actions) {

                // Make a call to the REST api to execute the payment // get
                return actions.payment.execute().then(function(paymentDetails) {

                  var total_final = JSON.stringify(paymentDetails.transactions[0].amount.total).replace(/\"/g, "");
                  var handling_fee = JSON.stringify(paymentDetails.transactions[0].amount.details.handling_fee).replace(/\"/g, "");
                  var transacId = JSON.stringify(paymentDetails.transactions[0].related_resources[0].sale.id).replace(/\"/g, "");

                  window.location = "<?php echo $baseUrl; ?>/transaction?transacId="+transacId+"&total_final="+total_final+"&handling_fee="+handling_fee+"&paymentID="+data.paymentID+"&payerID="+data.payerID+"&paymentToken="+data.paymentToken+"&project=<?php echo (string)$newProject_id; ?>";


               
                  

                });


            }


        }, '#paypal-button-container');

    </script>