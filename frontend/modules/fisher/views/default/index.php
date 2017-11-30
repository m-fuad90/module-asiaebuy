<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;



$this->title = 'Fisher Brand';
?><!-- BEGIN: Subheader -->


<!-- BEGIN SERVICE BOX -->   
<div class="row service-box margin-bottom-40">

            <?php if(Yii::$app->session->hasFlash('rqf_submit')) { ?>
                <div class="alert alert-success">
                    
                     <?php echo  Yii::$app->session->getFlash('rqf_submit'); ?>
                </div>
            <?php } ?>
    


     <div class="col-md-8 col-sm-8">


        <p>
        <marquee onmouseover="this.stop();" onmouseout="this.start();">Due to systems update at Chicago (IL, USA), our service might be interrupted from 11:00pm - 1:00am (GMT-6).</marquee></p>

        

        <iframe src="https://www.fishersci.com" height="700px" width="100%"></iframe>
     </div>

     <div class="col-md-4 col-sm-4">

            <h2 class="">My RFQ</h2>


            <?php $form = ActiveForm::begin([
                'enableClientScript' => false,
                'options' => [
                    'class' => 'm-form m-form--fit'
                 ]
            ]); ?>

            <?= $form->field($model, 'catalog_no')->textInput(['class' => 'form-control m-input m-input--air'])->label('Catalog No') ?>


            <?= $form->field($model, 'quantity')->textInput([
            'class' => 'form-control m-input m-input--air',
            'type' => 'number',

            ])->label('Quantity') ?>


            <?= Html::submitButton($model->isNewRecord ? 'Add To Cart' : 'Add', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary pull-right']) ?>


            <?php ActiveForm::end(); ?>

            <p class="padding-top-30"></p>

            <h2 class="">RFQ Cart</h2>

            <?php if(Yii::$app->session->hasFlash('success_added')) { ?>
                <div class="alert alert-success">
                    
                     <?php echo  Yii::$app->session->getFlash('success_added'); ?>
                </div>
            <?php } ?>

            <table class="table table-hover table-bordered">
                <thead class="thead-default">
                    <tr>
                        <th>No</th>
                        <th>Catalog No</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=0; foreach ($items as $key => $item) { $i++;?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $item['catalog_no']; ?></td>
                            <td><?= $item['quantity']; ?></td>
                            <td>
             
                                <?= Html::a('<i class="fa fa-remove"></i>', Url::to([
                                    'default/delete','id'=>(string)$item->_id,

                                    ]), ['data-method' => 'POST','class'=>'btn btn-danger']) ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <?php if (empty($items)) { ?>
   
            <?php } else { ?>

            <?php } ?>




            <?php if (Yii::$app->user->isGuest == 'Guest') { ?>


                <?php if (empty($items)) { ?>

                    <input class="btn btn-primary" type="button" value="Ask For Quotation" disabled="disabled">
       
                <?php } else { ?>

                    <?= Html::a('Ask For Quotation', ['default/guest'], ['class' => 'btn btn-primary']) ?>

                <?php } ?>


            <?php } else { ?>

                <?php if (empty($items)) { ?>

                    <input class="btn btn-primary" type="button" value="Ask For Quotation" disabled="disabled">
       
                <?php } else { ?>


                    <?php if (empty($progressProject->_id)) { ?>

                        <?= Html::a('Ask For Quotation', ['default/project'], ['class' => 'btn btn-primary']) ?>
                     
                    <?php } else { ?>

                        <?= Html::a('Ask For Quotation', ['default/continue','project'=>(string)$progressProject->_id], ['class' => 'btn btn-primary']) ?>

                    <?php } ?>

                <?php } ?>


    
            <?php } ?>





         
     </div>

</div>
<!-- END SERVICE BOX -->