<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAssetModule;
use common\widgets\Alert;
use common\models\Notification;
use common\models\Message;
use yii\bootstrap\Modal;

$notifyCustomer = Notification::notifyCustomer();
$notifyCustomerNeedToConfirm = Notification::notifyCustomerNeedToConfirm();

$msgBuyer = Message::msgBuyer();

AppAssetModule::register($this);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="corporate">
<?php $this->beginBody() ?>
    <!-- BEGIN TOP BAR -->
    <div class="pre-header">
        <div class="container">
            <div class="row">
                <!-- BEGIN TOP BAR LEFT PART -->
                <div class="col-md-4 col-sm-4 additional-shop-info">
  
                </div>
                <!-- END TOP BAR LEFT PART -->
                <?php if (Yii::$app->user->isGuest == 'Guest') { ?>
                <!-- BEGIN TOP BAR MENU -->
                <div class="col-md-8 col-sm-8 additional-nav">

                        
                    <ul class="list-unstyled list-inline pull-right">
                      
                        <li><?= Html::a('Register', ['/site/register'], ['class' => '']) ?></li>
                        <li><?= Html::a('Login', ['/site/logon-redirect','param'=> base64_encode(Yii::$app->session->id)], ['class' => '']) ?></li>
               
                    </ul>
                </div>
                <!-- END TOP BAR MENU -->
                <?php } else { ?>
                <!-- BEGIN TOP BAR MENU -->
                <div class="col-md-8 col-sm-8 additional-nav">
                    <ul class="list-unstyled list-inline pull-right">
                        <li>
                            <?= Html::a('myRFQ', ['/fisher/project/rfq'], ['class' => '']) ?>
                        </li>
                        <li>
                            <?= Html::a('myQuotation', ['/fisher/project/quotation'], ['class' => '']) ?>
                            <?php if (count($notifyCustomerNeedToConfirm) == 0) { ?>

                            <?php } else { ?>

                                <span class="badge"><?php echo count($notifyCustomerNeedToConfirm); ?></span> 

                            <?php } ?>
                        </li>
                        <li>
                            <?= Html::a('myOrder', ['/fisher/project/order'], ['class' => '']) ?>
                        </li>
                        <li>
                            <?= Html::a('Cart', ['/fisher/default/cart','param'=>base64_encode(Yii::$app->user->identity->email)], ['class' => '']) ?>
                        </li>
                        <li>

                          <?php if (count($notifyCustomer) == 0) { ?>




                              <i class="fa fa-bell" style="color: #fff;"></i>

                          <?php } else { ?>


                              <?= Html::a('<i class="fa fa-bell"></i><span class="badge">'.count($notifyCustomer).'</span>', ['/fisher/project/order'], ['class' => 'dropdown-toggle','data-toggle'=>'dropdown']) ?>

                                <ul class="dropdown-menu">
                                    <li>
                                    <?php foreach ($notifyCustomer as $key => $value) { ?>

                                        <?= Html::a($value['message'], 
                                          [
                                            $value['path'], 
                                            'id' => (string)$value['_id'],
                                            'module' => $value['module']
                                          ], ['class' => '']) ?>

                                    <?php } ?>
                                    </li>


                                </ul>


                          <?php } ?>


                            
                        </li>
                        <li>
                            <?php if (count($msgBuyer) == 0) { ?>




                                <i class="fa fa-bell" style="color: #fff;"></i>

                            <?php } else { ?>


                                <?= Html::a('<i class="fa fa-envelope-o"></i><span class="badge">'.count($msgBuyer).'</span>', ['/fisher/project/order'], ['class' => 'dropdown-toggle','data-toggle'=>'dropdown']) ?>

                                  <ul class="dropdown-menu">
                                      <li>
                                      <?php foreach ($msgBuyer as $key_msg => $value_msg) { ?>

                                          <?= Html::a('New Message : ' .$value_msg['messages'], 
                                            [
                                              '/fisher/default/message', 
                                              'id' => (string)$value_msg['_id'],
          
                                            ], ['class' => '']) ?>

                                      <?php } ?>
                                      </li>


                                  </ul>


                            <?php } ?>
                        </li>
                        <li>
                            <?= Html::a(Yii::$app->user->identity->username, ['/site/account'], ['class' => '']) ?>
      
                            <?= Html::a('[ Logout ]', ['/site/exit'], ['data-method'=>'POST','class' => '']) ?>
                        </li>


                    </ul>
                </div>
                <!-- END TOP BAR MENU -->

                <?php } ?>
            </div>
        </div>        
    </div>
    <!-- END TOP BAR -->
    <!-- BEGIN HEADER -->
    <div class="header">
      <div class="container">
        <a class="site-logo" href="<?php echo Yii::$app->request->baseUrl; ?>/fisher"><img src="<?php echo Yii::$app->request->baseUrl; ?>/theme/assets/corporate/img/logos/ab.png" alt="AsiaEBuy-X"></a>

        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

        <!-- BEGIN NAVIGATION -->
        <div class="header-navigation pull-right font-transform-inherit">
          <ul>

        
 



          </ul>
        </div>
        <!-- END NAVIGATION -->
      </div>
    </div>
    <!-- Header END -->

    <div class="main">
      <div class="container">

           
        <!--<div class="row quote-v1 margin-bottom-30">
          <div class="col-md-9">
            <span>Welcome To AsiaEBuy X</span>
          </div>

        </div>
        <!-- END BLOCKQUOTE BLOCK -->


        <!-- BEGIN STEPS -->
        <div class="row margin-bottom-40 front-steps-wrapper front-steps-count-3">
          <div class="col-md-4 col-sm-4 front-step-col">
            <div class="front-step front-step1">
              <h2>Step 1 :</h2>
              <p>Request Quotation</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 front-step-col">
            <div class="front-step front-step2">
              <h2>Step 2 :</h2>
              <p>Make An Order</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 front-step-col">
            <div class="front-step front-step3">
              <h2>Step 3 : </h2>
              <p>Proceed Payment</p>
            </div>
          </div>
        </div>
        <!-- END STEPS -->


        <?= $content ?>

      </div>
    </div>

    <!-- BEGIN PRE-FOOTER -->
    <div class="pre-footer">
      <div class="container">
        <div class="row">
          <!-- BEGIN BOTTOM ABOUT BLOCK -->
          <div class="col-md-4 col-sm-6 pre-footer-col">
            <h2>Information</h2>
            <p><?= Html::a('About Us', ['/site/about'], ['class' => '']) ?></p>
            <p><?= Html::a('Privacy Policy', ['/site/policy'], ['class' => '']) ?></p>
            <p><?= Html::a('Terms & Conditions', ['/site/term'], ['class' => '']) ?></p>
            <p><?= Html::a('Contact Us', ['/site/contact'], ['class' => '']) ?></p>





        </div>
      </div>
    </div>
    <!-- END PRE-FOOTER -->


        <!-- BEGIN FOOTER -->
    <div class="footer">
      <div class="container">
        <div class="row">
          <!-- BEGIN COPYRIGHT -->
          <div class="col-md-4 col-sm-4 padding-top-10">
            Asiaebuy Sdn Bhd © 2017

          </div>
          <!-- END COPYRIGHT -->


        </div>
      </div>
    </div>
    <!-- END FOOTER -->


                        




<?php $this->endBody() ?>
</body>
</html>

<?php 
Modal::begin([
            'header' => 'AsiaEBuy',
            'id'     => 'model',
            'size'   => 'model-lg',
    ]);
    
    echo "<div id='modelContent'></div>";
    
    Modal::end();
?>

<?php $this->endPage() ?>
