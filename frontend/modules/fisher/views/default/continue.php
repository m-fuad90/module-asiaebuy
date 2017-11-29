    <?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

$this->title = 'RFQ Information';

?>
<div class="row service-box margin-bottom-40">

    <?php $form = ActiveForm::begin([
        'enableClientScript' => false,

    ]); ?>



    <div class="col-md-8 col-sm-8">

        <h2 class=""><?= Html::encode($this->title) ?></h2>


        <table class="table">
            <tr>
                <th>Name</th>
                <td><?= $model->name ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= $model->email ?></td>
            </tr>
            <tr>
                <th>Contact No</th>
                <td><?= $model->contact_no ?></td>
            </tr>
            <?php if (empty($model->company_name)) { ?>

                
            <?php } else { ?>

            <tr>
                <th>Company Name</th>
                <td><?= $model->company_name ?></td>
            </tr>

            <?php } ?>

            <tr>
                <th>Address</th>
                <td><?= $model->address ?>, <?= $model->postcode ?>, <?= $model->city ?></td>
            </tr>
            <tr>
                <th>Province</th>
                <td><?= $model->province ?></td>
            </tr>
            <tr>
                <th>Country</th>
                <td><?= $model->country ?></td>
            </tr>
            <?php if ($user->diff_add_info == 'Yes') { ?>

            <?php } else { ?>


            <?php } ?>

            

        </table>


        <h2 class="">Address Book</h2>

        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Address</th>
                    <th>PIC</th>
                </tr>
            </thead>
            <tbody>

                <?php $i=-1; foreach ($address as $key => $value_address) { $i++;?>
                <tr>
                    <td>
                        <input type="radio" name="Project[diff_add_info]" value="<?= $value_address['address_id']; ?>">
                    </td>
                    <td>
                        <dl>
                            <dt>Name : </dt>
                            <dd>
                                <?= empty($value_address['lastname']) ? '' : $value_address['lastname']; ?>
                                <?= empty($value_address['firstname']) ? '' : $value_address['firstname']; ?>
                            </dd>
                        </dl>

                    </td>

                    <td>
                        <dl>
                            <?php if (empty($value_address['company'])) { ?>
                       
                            <?php } else { ?>

                                <dt>Company :</dt>
                                <dd><?= empty($value_address['company']) ? '' : $value_address['company']; ?></dd>

                            <?php } ?>
                            <dt>
                                Address :
                            </dt>
                            <dd>
                                <?= empty($value_address['address_1']) ? '' : $value_address['address_1']; ?>,
                                <?= empty($value_address['address_2']) ? '' : $value_address['address_2']; ?>,
                                <?= empty($value_address['city']) ? '' : $value_address['city']; ?>,
                                <?= empty($value_address['postcode']) ? '' : $value_address['postcode']; ?>,
                                <?= empty($value_address['zone_name']) ? '' : $value_address['zone_name']; ?>,
                                <?= empty($value_address['country_name']) ? '' : $value_address['country_name']; ?>,
                            </dd>
                        </dl>


                        
                        <br>
                        
                        
                        

                    </td>

                </tr>


                    
                <?php } ?>
            </tbody>
        </table>





    </div>


    <div class="col-md-4 col-sm-4">

        <table class="table table-hover table-bordered">
            <thead class="thead-default">
                <tr>
                    <th>No</th>
                    <th>Catalog No</th>
                    <th>Qty</th>
  
                </tr>
            </thead>
            <tbody>
                <?php $i=0; foreach ($items as $key => $item) { $i++;?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $item['catalog_no']; ?></td>
                        <td><?= $item['quantity']; ?></td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>




         <?= $form->field($model, 'status')->hiddenInput(['class' => 'form-control','value'=>'Submit'])->label(false) ?>

        <button class="btn btn-primary">SUBMIT</button>



    </div>

    <?php ActiveForm::end(); ?>

</div>






